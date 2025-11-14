<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    private ?Categorie $id_categorie = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $definition = null;

    #[ORM\Column(length: 255)]
    private ?string $utilisation = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $stock = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    /**
     * @var Collection<int, Avis>
     */
    #[ORM\ManyToMany(targetEntity: Avis::class, inversedBy: 'produits')]
    private Collection $avis;

    #[ORM\Column(length: 255)]
    private ?string $image_mini1 = null;

    #[ORM\Column(length: 255)]
    private ?string $image_mini2 = null;

    #[ORM\Column(length: 255)]
    private ?string $image_mini3 = null;

    #[ORM\Column]
    private ?float $nombreAvisParProduit = null;

    #[ORM\Column(length: 255)]
    private ?string $compositions = null;

    #[ORM\Column(length: 255)]
    private ?string $presentation = null;

    public function __construct()
    {
        $this->avis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCategorie(): ?Categorie
    {
        return $this->id_categorie;
    }

    public function setIdCategorie(?Categorie $id_categorie): static
    {
        $this->id_categorie = $id_categorie;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDefinition(): ?string
    {
        return $this->definition;
    }

    public function setDefinition(string $definition): static
    {
        $this->definition = $definition;

        return $this;
    }

    public function getUtilisation(): ?string
    {
        return $this->utilisation;
    }

    public function setUtilisation(string $utilisation): static
    {
        $this->utilisation = $utilisation;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getStock(): ?string
    {
        return $this->stock;
    }

    public function setStock(string $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Avis>
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    // Méthode corrigée/renommée
    public function addAvis(Avis $avi): static 
    {
        if (!$this->avis->contains($avi)) {
            $this->avis->add($avi);
        }

        return $this;
    }

    // Méthode corrigée/renommée
    public function removeAvis(Avis $avi): static
    {
        $this->avis->removeElement($avi);

        return $this;
    }

    public function getImageMini1(): ?string
    {
        return $this->image_mini1;
    }

    public function setImageMini1(string $image_mini1): static
    {
        $this->image_mini1 = $image_mini1;

        return $this;
    }

    public function getImageMini2(): ?string
    {
        return $this->image_mini2;
    }

    public function setImageMini2(string $image_mini2): static
    {
        $this->image_mini2 = $image_mini2;

        return $this;
    }

    public function getImageMini3(): ?string
    {
        return $this->image_mini3;
    }

    public function setImageMini3(string $image_mini3): static
    {
        $this->image_mini3 = $image_mini3;

        return $this;
    }

    public function getNombreAvisParProduit(): ?float
    {
        return $this->nombreAvisParProduit;
    }

    public function setNombreAvisParProduit(float $nombreAvisParProduit): static
    {
        $this->nombreAvisParProduit = $nombreAvisParProduit;

        return $this;
    }

    public function getCompositions(): ?string
    {
        return $this->compositions;
    }

    public function setCompositions(string $compositions): static
    {
        $this->compositions = $compositions;

        return $this;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(string $presentation): static
    {
        $this->presentation = $presentation;

        return $this;
    }
}