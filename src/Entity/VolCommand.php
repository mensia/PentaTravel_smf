<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VolCommand
 *
 * @ORM\Table(name="vol_command")
 * @ORM\Entity
 */
class VolCommand
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
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     */
    private $idUser;

    /**
     * @var int
     *
     * @ORM\Column(name="prix", type="integer", nullable=false)
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity=Agence::class, inversedBy="volcommands")
     */
    private $agence;

    /**
     * @ORM\ManyToOne(targetEntity=Vol::class, inversedBy="volcommands")
     */
    private $Vol;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(int $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getIdAgence(): ?int
    {
        return $this->idAgence;
    }

    public function setIdAgence(int $idAgence): self
    {
        $this->idAgence = $idAgence;

        return $this;
    }

    public function getIdVol(): ?int
    {
        return $this->idVol;
    }

    public function setIdVol(int $idVol): self
    {
        $this->idVol = $idVol;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getAgence(): ?agence
    {
        return $this->agence;
    }

    public function setAgence(?agence $agence): self
    {
        $this->agence = $agence;

        return $this;
    }

    public function getVol(): ?vol
    {
        return $this->Vol;
    }

    public function setVol(?vol $Vol): self
    {
        $this->Vol = $Vol;

        return $this;
    }


}
