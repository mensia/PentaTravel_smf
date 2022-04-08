<?php

namespace App\Entity;

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


}
