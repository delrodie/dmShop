<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AlbumRepository")
 */
class Album
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $prixVente;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nonSticke;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sticke;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $distribue;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pochette;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Artiste", inversedBy="albums")
     */
    private $artiste;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $stock;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getPrixVente(): ?int
    {
        return $this->prixVente;
    }

    public function setPrixVente(?int $prixVente): self
    {
        $this->prixVente = $prixVente;

        return $this;
    }

    public function getNonSticke(): ?int
    {
        return $this->nonSticke;
    }

    public function setNonSticke(?int $nonSticke): self
    {
        $this->nonSticke = $nonSticke;

        return $this;
    }

    public function getSticke(): ?int
    {
        return $this->sticke;
    }

    public function setSticke(?int $sticke): self
    {
        $this->sticke = $sticke;

        return $this;
    }

    public function getDistribue(): ?int
    {
        return $this->distribue;
    }

    public function setDistribue(?int $distribue): self
    {
        $this->distribue = $distribue;

        return $this;
    }

    public function getPochette(): ?string
    {
        return $this->pochette;
    }

    public function setPochette(?string $pochette): self
    {
        $this->pochette = $pochette;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getArtiste(): ?Artiste
    {
        return $this->artiste;
    }

    public function setArtiste(?Artiste $artiste): self
    {
        $this->artiste = $artiste;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(?int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }
}
