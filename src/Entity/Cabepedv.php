<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CabepedvRepository")
 */
class Cabepedv
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observaciones;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="pedidos")
     */
    private $representante;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Clientes", inversedBy="pedidos")
     */
    private $cliente;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Linepedi", mappedBy="pedido")
     */
    private $lineas;

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(?string $observaciones): self
    {
        $this->observaciones = $observaciones;

        return $this;
    }
    // Al instanciar la clase, ponemos como fecha la actual en los formularios.
    public function __construct()
    {
        $this->fecha = new \DateTime('now');
        $this->lineas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRepresentante(): ?User
    {
        return $this->representante;
    }

    public function setRepresentante(?User $representante): self
    {
        $this->representante = $representante;

        return $this;
    }

    public function getCliente(): ?Clientes
    {
        return $this->cliente;
    }

    public function setCliente(?Clientes $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * @return Collection|Linepedi[]
     */
    public function getLineas(): Collection
    {
        return $this->lineas;
    }

    public function addLinea(Linepedi $linea): self
    {
        if (!$this->lineas->contains($linea)) {
            $this->lineas[] = $linea;
            $linea->setPedido($this);
        }

        return $this;
    }

    public function removeLinea(Linepedi $linea): self
    {
        if ($this->lineas->contains($linea)) {
            $this->lineas->removeElement($linea);
            // set the owning side to null (unless already changed)
            if ($linea->getPedido() === $this) {
                $linea->setPedido(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getCliente()->getNomcli();
    }
}
