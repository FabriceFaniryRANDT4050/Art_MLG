<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251111091941 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE employe_role (employe_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_F816450A1B65292 (employe_id), INDEX IDX_F816450AD60322AC (role_id), PRIMARY KEY(employe_id, role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materiel_service (materiel_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_59ECE10716880AAF (materiel_id), INDEX IDX_59ECE107ED5CA9E6 (service_id), PRIMARY KEY(materiel_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mode_paiement_paiement (mode_paiement_id INT NOT NULL, paiement_id INT NOT NULL, INDEX IDX_D324C168438F5B63 (mode_paiement_id), INDEX IDX_D324C1682A4C4478 (paiement_id), PRIMARY KEY(mode_paiement_id, paiement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE employe_role ADD CONSTRAINT FK_F816450A1B65292 FOREIGN KEY (employe_id) REFERENCES employe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employe_role ADD CONSTRAINT FK_F816450AD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE materiel_service ADD CONSTRAINT FK_59ECE10716880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE materiel_service ADD CONSTRAINT FK_59ECE107ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mode_paiement_paiement ADD CONSTRAINT FK_D324C168438F5B63 FOREIGN KEY (mode_paiement_id) REFERENCES mode_paiement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mode_paiement_paiement ADD CONSTRAINT FK_D324C1682A4C4478 FOREIGN KEY (paiement_id) REFERENCES paiement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employe ADD service_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B9ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('CREATE INDEX IDX_F804D3B9ED5CA9E6 ON employe (service_id)');
        $this->addSql('ALTER TABLE reservation ADD client_id INT DEFAULT NULL, ADD paiement_id INT DEFAULT NULL, ADD service_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495519EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849552A4C4478 FOREIGN KEY (paiement_id) REFERENCES paiement (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('CREATE INDEX IDX_42C8495519EB6921 ON reservation (client_id)');
        $this->addSql('CREATE INDEX IDX_42C849552A4C4478 ON reservation (paiement_id)');
        $this->addSql('CREATE INDEX IDX_42C84955ED5CA9E6 ON reservation (service_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employe_role DROP FOREIGN KEY FK_F816450A1B65292');
        $this->addSql('ALTER TABLE employe_role DROP FOREIGN KEY FK_F816450AD60322AC');
        $this->addSql('ALTER TABLE materiel_service DROP FOREIGN KEY FK_59ECE10716880AAF');
        $this->addSql('ALTER TABLE materiel_service DROP FOREIGN KEY FK_59ECE107ED5CA9E6');
        $this->addSql('ALTER TABLE mode_paiement_paiement DROP FOREIGN KEY FK_D324C168438F5B63');
        $this->addSql('ALTER TABLE mode_paiement_paiement DROP FOREIGN KEY FK_D324C1682A4C4478');
        $this->addSql('DROP TABLE employe_role');
        $this->addSql('DROP TABLE materiel_service');
        $this->addSql('DROP TABLE mode_paiement_paiement');
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B9ED5CA9E6');
        $this->addSql('DROP INDEX IDX_F804D3B9ED5CA9E6 ON employe');
        $this->addSql('ALTER TABLE employe DROP service_id');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495519EB6921');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849552A4C4478');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955ED5CA9E6');
        $this->addSql('DROP INDEX IDX_42C8495519EB6921 ON reservation');
        $this->addSql('DROP INDEX IDX_42C849552A4C4478 ON reservation');
        $this->addSql('DROP INDEX IDX_42C84955ED5CA9E6 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP client_id, DROP paiement_id, DROP service_id');
    }
}
