<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User extends BaseUser
{

    const ROLE_DEFAULT = 'ROLE_ADMIN';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nomrep;

    /**
     * @ORM\Column(type="string", length=8)
     */
    private $codrep;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Clientes", mappedBy="representante")
     */
    private $clientes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cabepedv", mappedBy="representante")
     */
    private $pedidos;


    public function getNomrep(): ?string
    {
        return $this->nomrep;
    }

    public function setNomrep(?string $nomrep): self
    {
        $this->nomrep = $nomrep;

        return $this;
    }

    public function getCodrep(): ?string
    {
        return $this->codrep;
    }

    public function setCodrep(string $codrep): self
    {
        $this->codrep = $codrep;

        return $this;
    }

    public function __construct()
    {
        parent::__construct();
        // your own logic
        // Inicializamos ciertas variables
        $this->enabled = true;
        $this->roles = [ 'ROLE_ADMIN'];
        $this->clientes = new ArrayCollection();
        $this->pedidos = new ArrayCollection();
    }

    /**
     * @return Collection|Clientes[]
     */
    public function getClientes(): Collection
    {
        return $this->clientes;
    }

    public function addCliente(Clientes $cliente): self
    {
        if (!$this->clientes->contains($cliente)) {
            $this->clientes[] = $cliente;
            $cliente->setRepresentante($this);
        }

        return $this;
    }

    public function removeCliente(Clientes $cliente): self
    {
        if ($this->clientes->contains($cliente)) {
            $this->clientes->removeElement($cliente);
            // set the owning side to null (unless already changed)
            if ($cliente->getRepresentante() === $this) {
                $cliente->setRepresentante(null);
            }
        }

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
            $pedido->setRepresentante($this);
        }

        return $this;
    }

    public function removePedido(Cabepedv $pedido): self
    {
        if ($this->pedidos->contains($pedido)) {
            $this->pedidos->removeElement($pedido);
            // set the owning side to null (unless already changed)
            if ($pedido->getRepresentante() === $this) {
                $pedido->setRepresentante(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
      return $this->getNomrep();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
