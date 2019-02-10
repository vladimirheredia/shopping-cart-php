<?php
$username = null;
$password = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(!empty($_POST["username"]) && !empty($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        if($username == 'vheredia' && $password == 'password') {
            session_start();
            $_SESSION["authenticated"][0] = 'true';
            $_SESSION["authenticated"][1] = $username;
            if($_GET['checkout']){
                header('Location: checkout.php');
            }else{
                header('location: ../index.php');
            }
            
        }
        else {
            header('Location: login.php');
        }
        
    } else {
        header('Location: login.php');
    }
}