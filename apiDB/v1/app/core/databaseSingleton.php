<?php
class DatabaseSingleton{
    private static $instance;
    private $conexion;
    private $config = [];
    public function __construct(){
        $this->cargarConf();
        $this->conexion = new PDO(
            "mysql:host={$this->config['host']};dbname={$this->config['db_name']};charset=utf8mb4",
            $this->config['user'],
            $this->config['password']
        );
    }

    private function cargarConf(){
        $archivoJson = file_get_contents(__DIR__.'/../../config/db-connect.json');
        $this->config = json_decode($archivoJson, associative: true);
    }
    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function getConnection(){
        return $this->conexion;
    }
}
