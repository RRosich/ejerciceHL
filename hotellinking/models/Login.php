<?php
/**
 * Created by PhpStorm.
 * User: Clase
 * Date: 28/09/2017
 * Time: 19:53
 */

require_once '../db/Conexion.php';
session_start();
class Login
{

    private static $instancia;
    private $dbh;

    private function __construct()
    {

        $this->dbh = Conexion::singleton_conexion();

    }

    public static function singleton_login()
    {

        if (!isset(self::$instancia)) {

            $miclase = __CLASS__;
            self::$instancia = new $miclase;

        }

        return self::$instancia;

    }

    public function login_users($nick,$password)
    {

        try {

            $sql = "SELECT * from user WHERE nombre = ?";
            $query = $this->dbh->prepare($sql);
            $query->bindParam(1,$nick);
            $query->execute();

            if($query->rowCount() == 1)
            {

                $fila  = $query->fetch();
                if(password_verify($password, $fila['password']))
                {
                    $_SESSION['nombre'] = $fila['nombre'];
                    return TRUE;
                }
                else{
                    return FALSE;
                }
            }

        }catch(PDOException $e){

            print "Error!: " . $e->getMessage();

        }

    }

    public function sign_up_users($nick,$password)
    {

        try {
            $sql = "INSERT INTO user (nombre, password)VALUES (?, ?)";
            $query = $this->dbh->prepare($sql);
            $query->bindParam(1,$nick);
            $query->bindParam(2,$password);
            echo "1";
            if($query->execute())
            {
                echo "2";
                $_SESSION['nombre'] = $nick;
                return TRUE;
            }
            echo "3";
        }catch(PDOException $e){

            print "Error!: " . $e->getMessage();

        }
        echo "4";
    }

    // Evita que el objeto se pueda clonar
    public function __clone()
    {

        trigger_error('Esta clase utiliza un patrón singleton, la clonación está deshabilitada', E_USER_ERROR);

    }

}