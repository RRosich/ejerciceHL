<?php
require_once '../models/Login.php';
require_once '../models/Promotion.php';

function login(){
$nuevoLogin = Login::singleton_login();
$promo = Promotion::singleton_promotion();
if(isset($_POST['nick']))
{
    $nick = $_POST['nick'];
    $password = $_POST['password'];
    $usuario = $nuevoLogin->login_users($nick,$password);

    if($usuario == TRUE)
    {
        $promo->getPromotionByUser($nick);
        header("Location:../views/home.php");
    }
    else
        {
            header("Location:../index.php?errorLogin=true");
        }
}
}

function signUp(){
    if(isset($_SESSION)){
        session_destroy();
    }
    session_start();
    $nuevoSingleton = Login::singleton_login();
    if(isset($_POST['nick']))
    {
        $nick = $_POST['nick'];
        $password = $_POST['password'];
        $usuario = $nuevoSingleton->sign_up_users($nick,password_hash($password, PASSWORD_DEFAULT));

        if($usuario == TRUE)
        {
            header("Location:../views/home.php");
        }
        else
        {
            header("Location:../index.php");
        }
    }
}

$_GET['method']();
?>