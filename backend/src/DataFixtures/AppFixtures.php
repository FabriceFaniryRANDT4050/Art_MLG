<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Client;
use App\Entity\Categorie;
use App\Entity\Produit;
use App\Entity\Avis;
use App\Entity\Commande;
use App\Entity\Paiement;
use App\Entity\Contact;
use App\Entity\Temoignage;
use App\Entity\Articles;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use DateTimeImmutable;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        /* ==========================================
         * USERS
         * ========================================== */
        for ($i = 0; $i < 3; $i++) {
            $u = new User();
            $u->setEmail($faker->unique()->email());
            $u->setRoles(['ROLE_ADMIN']);
            $u->setPassword(password_hash('password123', PASSWORD_DEFAULT));
            $manager->persist($u);
        }

        /* ==========================================
         * CLIENTS
         * ========================================== */
        $clients = [];
        for ($i = 0; $i < 15; $i++) {
            $c = new Client();
            $c->setNom($faker->lastName());
            $c->setPrenom($faker->firstName());
            $c->setEmail($faker->unique()->email());
            $c->setPassword(password_hash('client123', PASSWORD_DEFAULT));
            $c->setAdresse($faker->address());
            $c->setTelephone($faker->phoneNumber());
            $c->setCreatedAt(DateTimeImmutable::createFromMutable(
                $faker->dateTimeBetween('-1 year', 'now')
            ));

            $manager->persist($c);
            $clients[] = $c;
        }

        /* ==========================================
         * CATEGORIES
         * ========================================== */
        $categories = [];
        for ($i = 0; $i < 6; $i++) {
            $cat = new Categorie();
            $cat->setNom($faker->word());
            $cat->setType($faker->randomElement(['Bio', 'Artisanal', 'Naturel', 'Local']));
            $cat->setDescription($faker->sentence(10));
            $cat->setCreatedAt(DateTimeImmutable::createFromMutable(
                $faker->dateTimeBetween('-2 year', 'now')
            ));

            $manager->persist($cat);
            $categories[] = $cat;
        }

        /* ==========================================
         * PRODUITS
         * ========================================== */
        $produits = [];
        for ($i = 0; $i < 25; $i++) {
            $p = new Produit();
            $p->setIdCategorie($faker->randomElement($categories));
            $p->setNom($faker->words(3, true));
            $p->setDefinition($faker->sentence(8));
            $p->setUtilisation($faker->sentence(6));
            $p->setPrix($faker->randomFloat(2, 3, 200));
            $p->setStock((string) $faker->numberBetween(10, 300));
            $p->setImage("image_$i.jpg");
            $p->setImageMini1("mini1_$i.jpg");
            $p->setImageMini2("mini2_$i.jpg");
            $p->setImageMini3("mini3_$i.jpg");
            $p->setNombreAvisParProduit(0);
            $p->setCompositions($faker->sentence(5));
            $p->setPresentation($faker->sentence(15));

            $manager->persist($p);
            $produits[] = $p;
        }

        /* ==========================================
         * AVIS
         * ========================================== */
        $avisList = [];
        for ($i = 0; $i < 40; $i++) {
            $a = new Avis();
            $a->setIdClient($faker->randomElement($clients));
            $a->setDatePost(DateTimeImmutable::createFromMutable(
                $faker->dateTimeBetween('-1 year', 'now')
            ));
            $a->setEtoiles($faker->randomFloat(1, 1, 5));
            $a->setTitre($faker->sentence(3));
            $a->setContenu($faker->sentence(20));

            $manager->persist($a);
            $avisList[] = $a;
        }

        /* ==========================================
         * PRODUIT + AVIS (many to many)
         * ========================================== */
        foreach ($avisList as $av) {
            $prod = $faker->randomElement($produits);
            $prod->setNombreAvisParProduit($prod->getNombreAvisParProduit() + 1);
            // Doctrine va gérer l’insertion dans produit_avis automatiquement
            $prod->addAvis($av);
        }

        /* ==========================================
         * COMMANDES & PAIEMENTS
         * ========================================== */
        foreach ($clients as $cl) {
            for ($i = 0; $i < rand(1, 3); $i++) {
                $cmd = new Commande();
                $cmd->setIdClient($cl);
                $cmd->setCreatedAt(DateTimeImmutable::createFromMutable(
                    $faker->dateTimeBetween('-6 months', 'now')
                ));
                $cmd->setTotal($faker->randomFloat(2, 20, 400));
                $cmd->setStatut($faker->randomElement([
                    'En attente', 'Confirmé', 'Payé', 'Livré'
                ]));

                $manager->persist($cmd);

                // Paiement associé (unique)
                $pay = new Paiement();
                $pay->setIdCommande($cmd);
                $pay->setMethode($faker->randomElement([
                    'Mobile Money', 'Espèces', 'Carte bancaire'
                ]));
                $pay->setCeratedAt(DateTimeImmutable::createFromMutable(
                    $faker->dateTimeBetween('-6 months', 'now')
                ));
                $pay->setMontant($cmd->getTotal());

                $manager->persist($pay);
            }
        }

        /* ==========================================
         * CONTACTS
         * ========================================== */
        for ($i = 0; $i < 20; $i++) {
            $con = new Contact();
            $con->setIdClient($faker->randomElement($clients));
            $con->setMessages($faker->sentence(15));
            $con->setCreatedAt(DateTimeImmutable::createFromMutable(
                $faker->dateTimeBetween('-6 months', 'now')
            ));

            $manager->persist($con);
        }

        /* ==========================================
         * TEMOIGNAGES
         * ========================================== */
        for ($i = 0; $i < 12; $i++) {
            $t = new Temoignage();
            $t->setIdClient($faker->randomElement($clients));
            $t->setContenu($faker->sentence(20));
            $t->setImage("temoignage_$i.jpg");
            $t->setCreatedAt(DateTimeImmutable::createFromMutable(
                $faker->dateTimeBetween('-2 months', 'now')
            ));

            $manager->persist($t);
        }

        /* ==========================================
         * ARTICLES
         * ========================================== */
        for ($i = 0; $i < 15; $i++) {
            $art = new Articles();
            $art->setTitre($faker->sentence(4));
            $art->setContenu($faker->sentence(25));
            $art->setImage("article_$i.jpg");
            $art->setAuteur($faker->name());
            $art->setCreatedAt(DateTimeImmutable::createFromMutable(
                $faker->dateTimeBetween('-3 months', 'now')
            ));

            $manager->persist($art);
        }

        /* ==========================================
         * SAVE TO DATABASE
         * ========================================== */
        $manager->flush();
    }
}
