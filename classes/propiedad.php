<?php

namespace App;

class Propiedad {

    //base de datos
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];

    //errores
    protected static $errores = [];
    
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;


    //definir la conexion la base de datos
    public static function setDB($database){
        self::$db = $database;
    }

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '1';
    }

    public function guardar(){
        if (!is_null($this->id)) {
            //Actualizar
            $this->actualizar();
         } else{
            //Creando un nuevo registro
            $this->crear();
         }
     }

    public function crear(){
        //sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        //insertar en la base de datos
        $query = " INSERT INTO propiedades ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        $resultado = self::$db->query($query);

        if($resultado){
            //redireccionar al usuario
            header('Location: /admin?resultado=1');
        }
    }

    public function actualizar(){
       //sanitizar los datos
       $atributos = $this->sanitizarAtributos();

       $valores = [];
       foreach($atributos as $key => $value){
        $valores[] = "{$key}='{$value}'";
       }

       $query = "UPDATE propiedades SET ";
       $query .= join(', ', $valores );
       $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
       $query .= " LIMIT 1 ";

       $resultado = self::$db->query($query);

       if($resultado){
                //redireccionar al usuario
                header('Location: /admin?resultado=2');
            }
    }

    public function atributos(){
        $atributos = [];
        foreach(self::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key=> $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }  

    public function setImagen($imagen){
        //elimina la imagen previa
        if(isset($this->id)){
            //comprobar si existe el archivo
            $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
            if($existeArchivo){
                unlink(CARPETA_IMAGENES . $this->imagen);
            }
        }
        //asignar al a tributo de imagen el nombre de la imagen
        if($imagen){
            $this->imagen = $imagen;
        }
    }
    
    //validacion 
    public static function getErrores(){
        return self::$errores;
    }

    public function validar(){
        if(!$this->titulo){
            self::$errores[] = "Debes añadir un titulo";
        }
        if(!$this->precio){
            self::$errores[] = "El precio es obligatorio";
        }
        if( strlen($this->descripcion) < 50 ){
            self::$errores[] = "La descripcion es obligatoria y tiene que tener al menos 50 caracteres";
        }
        if(!$this->habitaciones){
            self::$errores[] = "El numero de habitaciones es obligatorio";
        }
        if(!$this->wc){
            self::$errores[] = "El numero de baños es obligatorio";
        }
        if(!$this->estacionamiento){
            self::$errores[] = "El numero de estacionamiento es obligatorio";
        }
        if(!$this->vendedorId){
            self::$errores[] = "Elige un vendedor";
        }
        if(!$this->imagen){
            self::$errores[] = 'La imagen es obligatoria';
        }
       return self::$errores;
    }

    //lista todas las propiedades
    public static function all(){
        $query = "SELECT * FROM propiedades";
        $resultado = self::consultaSQL($query);

        return $resultado;
    }

    //busca un registro por su id
    public static function find($id){
        $query = "SELECT * FROM propiedades WHERE id = $id";

        $resultado = self::consultaSQL($query);

        return array_shift($resultado);
    }

    public static function consultaSQL($query){
        //consultar la base de datos
        $resultado = self::$db->query($query);

        //iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = self::crearObjeto($registro);
        }

        //liberar memoria
        $resultado->free();

        //retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new self;

        foreach($registro as $key => $value) {
            if(property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    //sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar( $args = []){
        foreach($args as $key => $value){
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }
}