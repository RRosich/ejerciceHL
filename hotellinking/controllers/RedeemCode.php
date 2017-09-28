<?php
/**
 * Created by PhpStorm.
 * User: Clase
 * Date: 28/09/2017
 * Time: 19:58
 */
require_once '../models/Promotion.php';
require_once '../utils/UniqueCodeGenerator.php';

function redeemCode()
{
    $promotion = Promotion::singleton_promotion();
    if(isset($_POST['idPromo']) and isset($_SESSION['nombre']))
    {
        $promoCode = $_POST['idPromo'];
        $transaction = $promotion->updatePromotion($promoCode,0);

        if($transaction == TRUE)
        {
            $promotion->getPromotionByUser($_SESSION['nombre']);
            header("Location:../views/home.php");
        }
        else
        {
            header("Location:../index.php?errorLogin=true");
        }
    }
}

function createRedeemCode()
{
    $promotion = Promotion::singleton_promotion();
    $keyGen = UniqueCodeGenerator::singleton_UniqueCodeGenerator();
    if(isset($_SESSION['nombre']))
    {
        $promoCode = $keyGen->getUniqueCodeString();
        $nick = $_SESSION['nombre'];
        echo $promoCode;
        echo "    ".$nick;
        $transaction = $promotion->createPromotion($promoCode,$nick,1);

        if($transaction == TRUE)
        {
            $promotion->getPromotionByUser($_SESSION['nombre']);
            header("Location:../views/home.php");
        }
        else
        {
            header("Location:../index.php?errorLogin=true");
        }
    }
}

$_GET['method']();

?>