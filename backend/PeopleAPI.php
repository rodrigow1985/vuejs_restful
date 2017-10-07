<?php
require_once 'PeopleDB.php';
class PeopleAPI {

    public function API(){
      $this->cors();

      //header('Content-Type: application/JSON');


      $method = $_SERVER['REQUEST_METHOD'];
      switch ($method) {
      case 'GET'://consulta
          //echo 'GET';
          $this->getPeoples();
          break;
      case 'POST'://inserta
          //echo 'POST';
          $this->savePeople();
          break;
      case 'PUT'://actualiza
          //echo 'PUT';
          $this->updatePeople();
          break;
      case 'DELETE'://elimina
          //echo 'DELETE';
          $this->deletePeople();
          break;
      default://metodo NO soportado
          echo 'METODO NO SOPORTADO';
          break;
      }
    }


    function cors() {
      // Allow from any origin
      if (isset($_SERVER['HTTP_ORIGIN'])) {
          header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
          header('Access-Control-Allow-Credentials: true');
          header('Access-Control-Max-Age: 86400');    // cache for 1 day
      }
      // Access-Control headers are received during OPTIONS requests
      if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
          if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
              header("Access-Control-Allow-Methods:  GET, PUT, POST, DELETE, OPTIONS'");
          if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
              header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
          exit(0);
      }
  }
    /**
   * función que segun el valor de "action" e "id":
   *  - mostrara una array con todos los registros de personas
   *  - mostrara un solo registro
   *  - mostrara un array vacio
   */
   function getPeoples(){
     if($_GET['action']=='peoples'){
       $db = new PeopleDB();
       if(isset($_GET['id'])){//muestra 1 solo registro si es que existiera ID
         $response = $db->getPeople($_GET['id']);
         echo json_encode($response,JSON_PRETTY_PRINT);
       } else { //muestra todos los registros
         $response = $db->getPeoples();
         echo json_encode($response,JSON_PRETTY_PRINT);
       }
     } else {
       $this->response(400);
     }
   }

   /**
  * metodo para guardar un nuevo registro de persona en la base de datos
  */
 function savePeople(){
   if($_GET['action']=='peoples'){
     //Decodifica un string de JSON
     $obj = json_decode( file_get_contents('php://input') );
     $objArr = (array)$obj;
     if (empty($objArr)){
       $this->response(422,"error","Nothing to add. Check json");
     }else if(isset($obj->nombre)){
       $people = new PeopleDB();
       $respuesta = $people->insert( $obj );
       //print_r($people->personas);
       $this->response(200,"success","new record added");
     }else{
       //$this->response(422,"error","The property is not defined");
     }
   } else {
     $this->response(400);
   }
 }

 /**
  * Actualiza un recurso
  */
 function updatePeople() {
   if( isset($_GET['action']) && isset($_GET['id']) ){
     if($_GET['action']=='peoples'){
       $obj = json_decode( file_get_contents('php://input') );
       $objArr = (array)$obj;
       if (empty($objArr)){
           $this->response(422,"error","Nothing to add. Check json");
       }else if(isset($_GET['id'])){
           $db = new PeopleDB();
           $db->update($_GET['id'], $obj);
           $this->response(200,"success","Record updated");
       }else{
           $this->response(422,"error","The property 'id' is not defined");
       }
       exit;
     }
   }
   $this->response(400);
 }

 /**
 * elimina persona
 */
function deletePeople(){
    if( isset($_GET['action']) && isset($_GET['id']) ){
        if($_GET['action']=='peoples'){
            $db = new PeopleDB();
            $db->delete($_GET['id']);
            //print_r($db->personas);
            $this->response(204);// 204 devuelve como respuesta "No Content" si es correcto. No devuelve resultado
            exit;
        }
    }
    $this->response(400);
}

 /**
 * Respuesta al cliente
 * @param int $code Codigo de respuesta HTTP
 * @param String $status indica el estado de la respuesta puede ser "success" o "error"
 * @param String $message Descripcion de lo ocurrido
 */
 function response($code, $status="", $message="") {
    http_response_code($code);
    if( !empty($status) && !empty($message) ){
        $response = array("status" => $status ,"message"=>$message);
        echo json_encode($response,JSON_PRETTY_PRINT);
    }
 }

}//end class

?>
