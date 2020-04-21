<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjetRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(
 * fields={"titre"},
 * message="Un autre projet possède deja ce titre, merci de le modifier"
 * )
 * 
 */
class Projet
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
     * @ORM\Column(type="string", length=255)
     */
    private $sousTitre;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $resume;

    /**
     * @ORM\Column(type="text")
     */
    private $texte;

    /**
     * @ORM\Column(type="string", length=300)
     */
    private $lien;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="boolean")
     */
    private $actif;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProjetCategorie", inversedBy="projets")
     */
    private $categorie;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ProjetTag", inversedBy="projets")
     */
    private $tag;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     */
    private $url;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ImageProjet", mappedBy="projet", cascade="persist", orphanRemoval=true)
     * @ORM\JoinColumn(name="projet_id", referencedColumnName="id", nullable=true)
     */
    private $imageSlider;

    /**
     * @ORM\Column(type="integer")
     */
    private $place;


    public function __construct()
    {
        $this->tag = new ArrayCollection();
        $this->imageSlider = new ArrayCollection();
    }

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

    public function getSousTitre(): ?string
    {
        return $this->sousTitre;
    }

    public function setSousTitre(string $sousTitre): self
    {
        $this->sousTitre = $sousTitre;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(string $texte): self
    {
        $this->texte = $texte;

        return $this;
    }

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(string $lien): self
    {
        $this->lien = $lien;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    public function getCategorie(): ?ProjetCategorie
    {
        return $this->categorie;
    }

    public function setCategorie(?ProjetCategorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return Collection|ProjetTag[]
     */
    public function getTag(): Collection
    {
        return $this->tag;
    }

    public function addTag(ProjetTag $tag): self
    {
        if (!$this->tag->contains($tag)) {
            $this->tag[] = $tag;
        }

        return $this;
    }

    public function removeTag(ProjetTag $tag): self
    {
        if ($this->tag->contains($tag)) {
            $this->tag->removeElement($tag);
        }

        return $this;
    }

    /**
     * @return Collection|ImageProjet[]
     */
    public function getImageSlider(): Collection
    {
        return $this->imageSlider;
    }

    public function addImageSlider(ImageProjet $imageSlider): self
    {
        if (!$this->imageSlider->contains($imageSlider)) {
            $this->imageSlider[] = $imageSlider;
            $imageSlider->setProjet($this);
        }

        return $this;
    }

    public function removeImageSlider(ImageProjet $imageSlider): self
    {
        if ($this->imageSlider->contains($imageSlider)) {
            $this->imageSlider->removeElement($imageSlider);
            // set the owning side to null (unless already changed)
            if ($imageSlider->getProjet() === $this) {
                $imageSlider->setProjet(null);
            }
        }

        return $this;
    }

    public function getPlace(): ?int
    {
        return $this->place;
    }

    public function setPlace(int $place): self
    {
        $this->place = $place;

        return $this;
    }


    


}
