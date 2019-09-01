<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticuloRepository")
 */
class Articulo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $codart;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $codalt;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $descart;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $activo;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prcventa;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Linepedi", mappedBy="articulo")
     */
    private $lineasdepedidos;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodart(): ?string
    {
        return $this->codart;
    }

    public function setCodart(string $codart): self
    {
        $this->codart = $codart;

        return $this;
    }

    public function getCodalt(): ?string
    {
        return $this->codalt;
    }

    public function setCodalt(?string $codalt): self
    {
        $this->codalt = $codalt;

        return $this;
    }

    public function getDescart(): ?string
    {
        return $this->descart;
    }

    public function setDescart(?string $descart): self
    {
        $this->descart = $descart;

        return $this;
    }

    public function getActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(?bool $activo): self
    {
        $this->activo = $activo;

        return $this;
    }

    public function getPrcventa(): ?float
    {
        return $this->prcventa;
    }

    public function setPrcventa(?float $prcventa): self
    {
        $this->prcventa = $prcventa;

        return $this;
    }

    public function __construct()
    {
        // Inicializamos activo a true
        $this->activo = true;
        $this->lineasdepedidos = new ArrayCollection();
    }

    /**
     * @return Collection|Linepedi[]
     */
    public function getLineasdepedidos(): Collection
    {
        return $this->lineasdepedidos;
    }

    public function addLineasdepedido(Linepedi $lineasdepedido): self
    {
        if (!$this->lineasdepedidos->contains($lineasdepedido)) {
            $this->lineasdepedidos[] = $lineasdepedido;
            $lineasdepedido->setArticulo($this);
        }

        return $this;
    }

    public function removeLineasdepedido(Linepedi $lineasdepedido): self
    {
        if ($this->lineasdepedidos->contains($lineasdepedido)) {
            $this->lineasdepedidos->removeElement($lineasdepedido);
            // set the owning side to null (unless already changed)
            if ($lineasdepedido->getArticulo() === $this) {
                $lineasdepedido->setArticulo(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
      return $this->getCodalt() . ' - ' . $this->getDescart();
    }
}
