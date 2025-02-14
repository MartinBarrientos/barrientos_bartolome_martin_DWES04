<?php
require_once __DIR__.'/../../core/databaseSingleton.php';
require_once __DIR__.'/../../models/entidades/articulo.php';
require_once __DIR__.'/../../models/DTO/articuloDTO.php';
class ArticuloDAO{
    private $db;
    public function __construct(){
        $this->db = DatabaseSingleton::getInstance();
    }
    //metodos para interactuar con la bd donde se instanciara la conexion y la consulta 
    public function getAllArticulos() {
        //consulta
        $conection= $this->db->getConnection();
        $consulta = "SELECT * FROM articulos INNER JOIN specs on articulos.id_articulo = specs.id_articulo";
        $statement = $conection->query($consulta);
        //recogemos la consulta
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC);
        $articuloObjArray = [];
        //instanciamos la clase articuloDTO y guardamos en el array
        foreach($resultado as $articulo){
            $articuloObj = new ArticuloDTO($articulo['id_articulo'],$articulo['nombre'], $articulo['descripcion'], $articulo['precio'], $articulo['stock'], $articulo['categoria'], $articulo['disponible']);
            array_push($articuloObjArray, $articuloObj->jsonSerialize());
        }
        //devolvemos el array de objetos
        return $articuloObjArray;
    }
    public function getArticulosById($id) {
        //consulta
        $conection = $this->db->getConnection();
        $consulta = "SELECT * FROM articulos INNER JOIN specs on articulos.id_articulo = specs.id_articulo WHERE articulos.id_articulo=$id";
        $statement = $conection->query($consulta);
        //recogemos la consulta
        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach($resultado as $articulo){
            $articuloObj = new ArticuloDTO($articulo['id_articulo'],$articulo['nombre'], $articulo['descripcion'], $articulo['precio'], $articulo['stock'], $articulo['categoria'], $articulo['disponible']);
            return $articuloObj->jsonSerialize();
        }
    }
    public function nuevoArticulo($data) {
        $nombre = $data['nombre'];
        $descripcion = $data['descripcion'];
        $precio = $data['precio'];

        $conection = $this->db->getConnection();
        $consulta = "INSERT INTO articulos (nombre, descripcion, precio) VALUES('$nombre', '$descripcion', $precio)";
        $statement = $conection->query($consulta);

        $id_articulo = $conection->lastInsertId();
        $stock = $data['stock'];
        $categoria = $data['categoria'];
        $disponible = $data['disponible'];
        $consulta2 = "INSERT INTO specs (id_articulo, stock, categoria, disponible) VALUES ( $id_articulo, $stock, '$categoria', $disponible)";
        $statement = $conection->query($consulta2);
        
        //lo metemos en el modelo de datos y lo mostramos
        $articulo = new Articulo($id_articulo, $nombre, $descripcion, $precio, $stock, $categoria, $disponible);
        return $articulo->jsonSerialize();
    }
    public function actualizarArticulo($id, $data) {
        $conection = $this->db->getConnection();
        //consulta para coger los datos segun el id del articulo
        $consultaSelect = "SELECT * FROM articulos INNER JOIN specs on articulos.id_articulo = specs.id_articulo WHERE articulos.id_articulo=$id";
        $statement = $conection->query($consultaSelect);
        $resultado = $statement->fetch(PDO::FETCH_ASSOC);
        //creamos el objeto entidad articulo
        $articulo = new Articulo($id, $resultado['nombre'], $resultado['descripcion'], $resultado['precio'], $resultado['stock'], $resultado['categoria'], $resultado['disponible']);
        //seteamos los valores usando sus getters        
        $articulo->setNombre($data['nombre'] ?? $articulo->getNombre());
        $articulo->setDescripcion($data['descripcion'] ?? $articulo->getDescripcion());
        $articulo->setPrecio($data['precio'] ?? $articulo->getPrecio());
        $articulo->setStock($data['stock'] ?? $articulo->getStock());
        $articulo->setDisponible($data['disponible'] ?? $articulo->getDisponible());
        $articulo->setCategoria($data['categoria'] ?? $articulo->getCategoria());
        //serializamos el objeto
        $articuloSerializado = $articulo->jsonSerialize();

        //consulta update a la base de datos tabla 1
        $consulta ="UPDATE articulos SET nombre = '{$articuloSerializado['nombre']}', descripcion = '{$articuloSerializado['descripcion']}' , precio ={$articuloSerializado['precio']}  WHERE articulos.id_articulo =$id";
        $statement = $conection->query($consulta);
        //consulta update a la base de datos tabla 2
        $consulta2 = "UPDATE specs SET stock={$articuloSerializado['stock']}, categoria='{$articuloSerializado['categoria']}', disponible={$articuloSerializado['disponible']} WHERE specs.id_articulo= $id";
        $statement = $conection->query($consulta2);
        //retornamos el articulo actualizado
        return $articuloSerializado;

    }
    public function eliminarArticulo($id) {
        $conection = $this->db->getConnection();
        $consulta = "DELETE FROM articulos where id_articulo=$id";
        $statement = $conection->query($consulta);
        //si han sido afectadas mas de una fila quiere decri que se ha eliminado, devolvemos true
        if($statement->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }
}