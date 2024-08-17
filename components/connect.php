<?php
   class Config{
      private $db_name = 'mysql:host=localhost;dbname=store_db';
      private $database = 'root';
      private $password = '';
      
      public $connect;
      function __construct()
      {
         try{
            $this->connect = new PDO($this->db_name,$this->database,$this->password);
            $this->connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,
            PDO::FETCH_ASSOC);
         }catch(PDOException $e){
            echo 'ERROR HERE : '.$e->getMessage();
         }
         return $this->connect;
      }

      function test_input($data){
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
         return $data;
      }
      function showMessage($type,$message){
         echo '
         <div class="alert alert-'.$type.' alert-dismissible fade show" role="alert">
         <strong>'.$message.'</strong>
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
         ';
      }
     
     

   }

?>