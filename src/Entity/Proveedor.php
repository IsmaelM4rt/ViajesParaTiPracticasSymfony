<?php

namespace App\Entity;

use App\Repository\ProveedorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProveedorRepository::class)
 */
class Proveedor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", length=100)
     */
    private $nombre;

    /**
     * @ORM\Column(type="text", length=100)
     */
    private $mail;

    /**
     * @ORM\Column(type="text", length=20)
     */
    private $telefono;

    /**
     * @ORM\Column(type="integer")
     */
    private $tipo;
   
    /**
     * @ORM\Column(type="integer")
     */
    private $activo;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creado;

    /**
     * @ORM\Column(type="datetime")
     */
    private $editado;

    // GETTERS y SETTERS
    public function getid()
	{
		return $this->id;
	}

	public function setnombre($nombre='')
	{
		$this->nombre = $nombre;
		return true;
	}

	public function getnombre()
	{
		return $this->nombre;
	}

	public function setmail($mail='')
	{
		$this->mail = $mail;
		return true;
	}

	public function getmail()
	{
		return $this->mail;
	}

	public function settelefono($telefono='')
	{
		$this->telefono = $telefono;
		return true;
	}

	public function gettelefono()
	{
		return $this->telefono;
	}

	public function settipo($tipo='')
	{
		$this->tipo = $tipo;
		return true;
	}

	public function gettipo()
	{
		return $this->tipo;
	}

	public function setactivo($activo='')
	{
		$this->activo = $activo;
		return true;
	}

	public function getactivo()
	{
		return $this->activo;
	}

	public function setcreado($creado='')
	{
		$this->creado = $creado;
		return true;
	}

	public function getcreado()
	{
		return $this->creado;
	}

	public function seteditado($editado='')
	{
		$this->editado = $editado;
		return true;
	}

	public function geteditado()
	{
		return $this->editado;
	}
}
