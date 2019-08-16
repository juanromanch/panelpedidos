<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientesRepository")
 */
class Clientes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=8, nullable=true)
     */
    private $codcli;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $nomcli;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $dircli;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $pobcli;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $activo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="clientes")
     */
    private $representante;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cabepedv", mappedBy="cliente")
     */
    private $pedidos;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodcli(): ?string
    {
        return $this->codcli;
    }

    public function setCodcli(?string $codcli): self
    {
        $this->codcli = $codcli;

        return $this;
    }

    public function getNomcli(): ?string
    {
        return $this->nomcli;
    }

    public function setNomcli(?string $nomcli): self
    {
        $this->nomcli = $nomcli;

        return $this;
    }

    public function getDircli(): ?string
    {
        return $this->dircli;
    }

    public function setDircli(?string $dircli): self
    {
        $this->dircli = $dircli;

        return $this;
    }

    public function getPobcli(): ?string
    {
        return $this->pobcli;
    }

    public function setPobcli(?string $pobcli): self
    {
        $this->pobcli = $pobcli;

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

    public function __construct()
    {
        // Inicializamos activo a true
        $this->activo = true;
        $this->pedidos = new ArrayCollection();
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

    /**
     * @return Collection|Cabepedv[]
     */
    public function getPedidos(): Collection
    {
        return $this->pedidos;
    }

    public function addPedido(Cabepedv $pedido): self
    {
        if (!$this->pedidos->contains($pedido)) {
            $this->pedidos[] = $pedido;
            $pedido->setCliente($this);
        }

        return $this;
    }

    public function removePedido(Cabepedv $pedido): self
    {
        if ($this->pedidos->contains($pedido)) {
            $this->pedidos->removeElement($pedido);
            // set the owning side to null (unless already changed)
            if ($pedido->getCliente() === $this) {
                $pedido->setCliente(null);
            }
        }

        return $this;
    }
}
