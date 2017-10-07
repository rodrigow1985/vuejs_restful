<?php
/**
 * @web http://www.jc-mouse.net/
 * @author jc mouse
 */
class PeopleDB {

    protected $mysqli;
    const LOCALHOST = 'www.midulcedanna.com.ar';
    const USER = 'rodrigo';
    const PASSWORD = 'rodrigow';
    const DATABASE = 'restfulPrueba';

    /**
     * Constructor de clase
     */
     var $personas;
    public function __construct() {
      try{
            //conexión a base de datos
            $this->mysqli = new mysqli(self::LOCALHOST, self::USER, self::PASSWORD, self::DATABASE);
        }catch (mysqli_sql_exception $e){
            //Si no se puede realizar la conexión
            http_response_code(500);
            exit;
        }


      $this->personas = array(
        array(
          id => 0,
          nombre => 'Rodrigo',
          apellido => 'Weichert',
          edad => '32'
        ),
        array(
          id => 1,
          nombre => 'Blanca',
          apellido => 'Lastra',
          edad => '64'
        ),
        array(
          id => 2,
          nombre => 'Alberto',
          apellido => 'Weichert',
          edad => '62'
        ),
        array(
          id => 3,
          nombre => 'Gonzalo',
          apellido => 'Weichert',
          edad => '24'
        ),
        array(
          id => 4,
          nombre => 'Daniela',
          apellido => 'Casals',
          edad => '29'
        )
      );
    }

    /**
     * obtiene un solo registro dado su ID
     * @param int $id identificador unico de registro
     * @return Array array con los registros obtenidos de la base de datos
     */
    public function getPeople($id){
      $stmt = $this->mysqli->prepare("SELECT * FROM personas WHERE id=? ; ");
      $stmt->bind_param('s', $id);
      $stmt->execute();
      $result = $stmt->get_result();
      $peoples = $result->fetch_all(MYSQLI_ASSOC);
      $stmt->close();
      return $peoples;
      /*foreach ($this->personas as $key => $val) {
        if ($val['id'] == $id) {
           return $val;
        }
      }
      return false;*/
    }

    /**
     * obtiene todos los registros de la tabla "people"
     * @return Array array con los registros obtenidos de la base de datos
     */
    public function getPeoples(){
      $result = $this->mysqli->query('SELECT * FROM personas');
      $peoples = $result->fetch_all(MYSQLI_ASSOC);
      $result->close();

      return $peoples;
      //return $this->personas;
    }

    /**
     * añade un nuevo registro en la tabla persona
     * @param String $name nombre completo de persona
     * @return bool TRUE|FALSE
     */
    public function insert($persona){
      //array_push($this->personas, $persona);
      $stmt = $this->mysqli->prepare("INSERT INTO personas(nombre, apellido, edad) VALUES (?, ?, ?); ");
      $stmt->bind_param('ssi', $persona->nombre, $persona->apellido, $persona->edad);
      $r = $stmt->execute();
      $stmt->close();
      //return $r;
      return true;
    }

    /**
     * Actualiza registro dado su ID
     * @param int $id Description
     */
    public function update($id, $persona) {
      if($this->checkID($id)){
        try {
          $stmt = $this->mysqli->prepare('UPDATE personas SET nombre= ?, apellido= ?, edad= ? WHERE id= ? ;');
          $stmt->bind_param('ssii', $persona->nombre, $persona->apellido, $persona->edad, $id);
          echo $stmt->error;
          $stmt->execute();
          $stmt->close();
          return true;
          } catch (Exception $e) {
              echo 'ERROR:'.$e->getMessage();
            }
          }
      return false;
        /*if($this->getPeople($id)){
          foreach ($this->personas as $key => $val) {
            if ($val['id'] == $id) {
              $this->personas = array_replace($this->personas, array($key => $persona));
            }
          }

          return true;
        }
        return false;*/
    }

    /**
      * verifica si un ID existe
      * @param int $id Identificador unico de registro
      * @return Bool TRUE|FALSE
      */
    public function checkID($id){
        $stmt = $this->mysqli->prepare("SELECT * FROM personas WHERE id=?");
        $stmt->bind_param("s", $id);
        if($stmt->execute()){
            $stmt->store_result();
            if ($stmt->num_rows == 1){
                return true;
            }
        }
        return false;
    }

    /**
     * elimina un registro dado el ID
     * @param int $id Identificador unico de registro
     * @return Bool TRUE|FALSE
     */
    public function delete($id) {
      /*foreach ($this->personas as $key => $val) {
        if ($val['id'] == $id) {
           unset($this->personas[$key]);
        }
      }*/
      $stmt = $this->mysqli->prepare("DELETE FROM personas WHERE id = ? ; ");
      $stmt->bind_param('s', $id);
      $r = $stmt->execute();
      $stmt->close();
      return true;
    }

}
