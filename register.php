<?php

require 'functions.php';
$email=$_POST['email'];
$password=$_POST['password'];
if(isset($_POST['reg'])){

    showRegPage();

}
if(isset($_POST['reg2'])){

    Registration($_POST['email'],$_POST['password']);
}

if(isset($_POST['login'])){


    makeLogin($email, $password);

}



?>