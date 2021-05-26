<?php   
 class db {
     private $host = "localhost";
     private $user = "root";
     private $senha = "";
     private $database = "myschool";

     public function connection_mysql(){
        $connect = mysqli_connect($this->host,$this->user,$this->senha,$this->database);
         mysqli_set_charset($connect,'utf8');

         if(mysqli_connect_errno()){
             echo 'error'.mysqli_connect_error();   
         }

         return $connect;
     }
 }



?>