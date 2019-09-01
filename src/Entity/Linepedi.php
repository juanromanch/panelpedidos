<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LinepediRepository")
 */
class Linepedi
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $unidades;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cabepedv", inversedBy="lineas")
     */
    // TODO modificar restricción en clave foranea en linepedi.pedido delete y update a cascade en mysql
    private $pedido;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Articulo", inversedBy="lineasdepedidos")
     */
    private $articulo;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getUnidades(): ?int
    {
        return $this->unidades;
    }

    public function setUnidades(int $unidades): self
    {
        $this->unidades = $unidades;

        return $this;
    }

    public function getPedido(): ?Cabepedv
    {
        return $this->pedido;
    }

    public function setPedido(?Cabepedv $pedido): self
    {
        $this->pedido = $pedido;

        return $this;
    }

    public function getArticulo(): ?Articulo
    {
        return $this->articulo;
    }

    public function setArticulo(?Articulo $articulo): self
    {
        $this->articulo = $articulo;

        return $this;
    }


    public function __construct()
    {
        // your own logic
        // Inicializamos ciertas variables
        $this->unidades = 1;
    }

}
