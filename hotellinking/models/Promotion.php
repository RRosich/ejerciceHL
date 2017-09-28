<?php

require_once '../db/Conexion.php';
session_start();
class Promotion
{
    private static $instancia;
    private $dbh;

    private function __construct()
    {

        $this->dbh = Conexion::singleton_conexion();

    }

    public static function singleton_promotion()
    {

        if (!isset(self::$instancia)) {

            $miclase = __CLASS__;
            self::$instancia = new $miclase;

        }

        return self::$instancia;

    }

    public function updatePromotion($idPromo, $redeem)
    {

        try {
            $sql = "UPDATE promotion SET redeem = ? WHERE id =?";
            $query = $this->dbh->prepare($sql);
            $query->bindParam(1,$redeem);
            $query->bindParam(2,$idPromo);

            if($query->execute())
            {
                return TRUE;

            }

        }catch(PDOException $e){

            print "Error!: " . $e->getMessage();

        }

    }

    public function createPromotion($promoCode,$nick, $redeem)
    {

        try {
            $sql = "INSERT INTO promotion (promoCode, redeem, userId)VALUES (?, ?, (SELECT id FROM user WHERE nombre like ?))";
            $query = $this->dbh->prepare($sql);
            $query->bindParam(1,$promoCode);
            $query->bindParam(2,$redeem);
            $query->bindParam(3,$nick);

            if($query->execute())
            {
                return TRUE;
            }
        }catch(PDOException $e){

            print "Error!: " . $e->getMessage();

        }

    }

    public function getPromotionByUser($nick)
    {

        try {
            $_SESSION['promos'] = null;
            $sql = "SELECT * from promotion WHERE userId = (select id from user where nombre like ?)";
            $query = $this->dbh->prepare($sql);
            $query->bindParam(1,$nick);
            $query->execute();

            if($query->rowCount() > 0)
            {

                $fila  = $query->fetchAll();
                $_SESSION['promos'] = $fila;
                return TRUE;

            }

        }catch(PDOException $e){

            print "Error!: " . $e->getMessage();

        }

    }



    // Evita que el objeto se pueda clonar
    public function __clone()
    {

        trigger_error('Esta clase utiliza un patrón singleton, la clonación está deshabilitada', E_USER_ERROR);

    }


}