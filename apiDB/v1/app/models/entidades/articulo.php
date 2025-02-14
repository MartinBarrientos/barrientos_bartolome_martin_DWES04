<?php
class Articulo implements JsonSerializable
{
    protected $id;
    protected $nombre;
    protected $descripcion;
    protected $precio;
    protected $stock;
    protected $categoria;
    protected $disponible;
    protected $articulos = array();

    //constructor
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
    //getters
    public function getArticulos()
    {
        return $this->articulos;
    }
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
    //setters
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
    public function setPrecio($precio)
    {

        $this->precio = $precio;
    }
    public function setStock($stock)
    {

        $this->stock = $stock;
    }
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }
    public function setDisponible($disponible)
    {
        $this->disponible = $disponible;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'descripcion' => $this->getDescripcion(),
            'precio' => $this->getPrecio(),
            'stock' => $this->getStock(),
            'categoria' => $this->getCategoria(),
            'disponible' => $this->getDisponible()
        ];
    }
}
