<?php
namespace App\Objet;
use PDO;

class Connect
{    
    public static function getPDO() {       
        $db = new PDO('mysql:host=localhost;dbname=Blog;charset=utf8','fabrice', 'Frbrl7C90848467');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);       
   
       return $db;
    }   
}
?>
