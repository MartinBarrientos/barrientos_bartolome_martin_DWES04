<?php
class ArticuloDTO implements JsonSerializable
{
    private $id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $categoria;
    private $disponible;
    public function __construct($id, $nombre, $descripcion, $precio, $stock, $categoria, $disponible)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->stock = $stock;
        $this->categoria = $categoria;
        $this->disponible = $disponible;
    }
    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
    //getters
    public function getId()
    {
        return $this->id;
    }
    public function getNombre()
    {
        return $this->nombre;
    }    
    public function getDescripcion()
    {
        return $this->descripcion;
    }    
    public function getPrecio()
    {
        return $this->precio;
    }   
    public function getStock()
    {
        return $this->stock;
    }   
    public function getCategoria()
    {
        return $this->categoria;
    }    
    public function getDisponible()
    {
        return $this->disponible;
    }
}
