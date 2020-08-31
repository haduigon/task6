<?php

require 'functions.php';

$t_number = $_POST['phone'];


if (is_null($t_number)){

    die;

}

if(is_numeric($t_number)){


    $t_numbers = json_decode(file_get_contents('phones.json'), true);
    $t_numbers[] =$t_number;
    file_put_contents('phones.json',json_encode($t_numbers));


    $numbers_final[]=json_decode(file_get_contents('phones.json'),true);
    foreach($numbers_final as $number_final){

        drawTable ($number_final);
    }
}
if(is_numeric($t_number)==false){
    $html=showInputForm();
    $html .='<h2 align="center"> Please, input only numbers  </h2>';
    echo $html;}


if($submit2 = $_POST['logout']){
    header("Location: /");
}




?>
