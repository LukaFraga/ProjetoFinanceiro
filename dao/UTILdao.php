<?php

class UtilDAO
{

    public static function IniciarSessao()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public static function CriarSessao($idUser)
    {
        //self pois usará recurso dessa classe static
        self::IniciarSessao();

        //Criar a sessão
        $_SESSION['cod'] = $idUser;
    }


    public static function CodigoLogado()
    {
        //self pois usará recurso dessa classe static
        self::IniciarSessao();
        return  $_SESSION['cod'];
    }

    public static function VerLogado()
    {
        self::IniciarSessao();
        if (!isset($_SESSION['cod'])) {
            header('location: login.php');
            exit;
        }
    }

    public static function Deslogar()
    {
        self::IniciarSessao();
        unset($_SESSION['cod']);
        //session_destroy();

        header('location: login.php');
        exit;
    }
}
