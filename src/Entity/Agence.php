<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Agence
 *
 * @ORM\Table(name="agence")
 * @ORM\Entity
 */
class Agence
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="id_prop", type="integer", nullable=false)
     */
    private $idProp;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=20, nullable=false)
     */
    private $nom;

    /**
     * @var int
     *
     * @ORM\Column(name="numero", type="integer", nullable=false)
     */
    private $numero;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_etoile", type="integer", nullable=false)
     */
    private $nbEtoile;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=20, nullable=false)
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity=Vol::class, mappedBy="agence")
     */
    private $vols;

    /**
     * @ORM\OneToMany(targetEntity=Volcommand::class, mappedBy="agence")
     */
    private $volcommands;

    public function __construct()
    {
        $this->vols = new ArrayCollection();
        $this->volcommands = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdProp(): ?int
    {
        return $this->idProp;
    }

    public function setIdProp(int $idProp): self
    {
        $this->idProp = $idProp;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getNbEtoile(): ?int
    {
        return $this->nbEtoile;
    }

    public function setNbEtoile(int $nbEtoile): self
    {
        $this->nbEtoile = $nbEtoile;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection<int, Vol>
     */
    public function getVols(): Collection
    {
        return $this->vols;
    }

    public function addVol(Vol $vol): self
    {
        if (!$this->vols->contains($vol)) {
            $this->vols[] = $vol;
            $vol->setAgence($this);
        }

        return $this;
    }

    public function removeVol(Vol $vol): self
    {
        if ($this->vols->removeElement($vol)) {
            // set the owning side to null (unless already changed)
            if ($vol->getAgence() === $this) {
                $vol->setAgence(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Volcommand>
     */
    public function getVolcommands(): Collection
    {
        return $this->volcommands;
    }

    public function addVolcommand(Volcommand $volcommand): self
    {
        if (!$this->volcommands->contains($volcommand)) {
            $this->volcommands[] = $volcommand;
            $volcommand->setAgence($this);
        }

        return $this;
    }

    public function removeVolcommand(Volcommand $volcommand): self
    {
        if ($this->volcommands->removeElement($volcommand)) {
            // set the owning side to null (unless already changed)
            if ($volcommand->getAgence() === $this) {
                $volcommand->setAgence(null);
            }
        }

        return $this;
    }


}
