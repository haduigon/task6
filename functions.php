

<?php


function makeLogin(string $email, string $password)
{
    $users = [];

    if (strlen($password) < 4) {

        $html=showLoginPage();
        $html .= '<h2 align="center">Input correct data</h2>';
        return;
    }

    if (file_exists('users.json')) {
        $users = json_decode(file_get_contents('users.json') ,true);
    }

    foreach ($users as $user) {
        if ($email === $user['email'] && md5($user['salt'] . $password . $user['salt']) === $user['password']) {
            $_SESSION['user'] = $user;

            showInputForm();
            return;
        }
    }

    $html = showLoginPage();
    $html .='<h2 align="center">Input correct data</h2>';
    echo $html;


}

function showInputForm($number='number')
{


    $html = '


<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link href="style.css" rel="stylesheet" type="text/css">
  <title></title>
   </head>
    <body >
                                     
             <form action="addphone.php" method="post">
                              <p>    
        

                         Input phone number: <input type="password" name="phone" />
                         <input style ="margin-top: 30px" type="submit" value="submit" name="submit"/>
                        <input type ="submit" name="logout" value="logout">
';
    echo $html;
}


function showLoginPage(){


    $html = '
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link href="style.css" rel="stylesheet" type="text/css">
  <title></title>
   </head>
    <body >
                                     
             <form action="register.php" method="post">
                              <p>    
                      Username:  <input type="text" name="email" />
                                             Password: <input type="password" name="password" />
                                      <input style="margin-top: 30px"  type="submit" value="login" name="login" />
                                <input style="margin-top: 10px" type="submit" value="register" name="reg"/>
';


    echo $html;
}


function showRegPage(){

    $html = ' 
<html> 
 <head> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
  <link href="style.css" rel="stylesheet" type="text/css"> 
  <title></title> 
   </head> 
    <body > 
                                      
             <form action="register.php" method="post"> 
                              <p>     
                  Username:  <input type="text" name="email" /> 
                      Password: <input type="password" name="password" /> 
                            <input style="margin-top: 30px"  type="submit" value="register" name="reg2" />';

    echo $html;

}



function Registration(string $email, string $password)
{
    $users = [];

    if (file_exists('users.json')) {
        $users[] = json_decode(file_get_contents('users.json') ,true);
    }

    foreach ($users as $user) {
        if ($user['email'] === $email) {

            return;
        }
    }

    $salt = RandomSalt();
    $users[] = $user = [
        'email' => $email,
        'salt' => $salt,
        'password' => md5($salt . $password . $salt)
    ];
    file_put_contents('users.json', json_encode($users));


    showInputForm();
}

function RandomSalt(int $length = 32)
{
    $abc = array_merge(
        range('a', 'z'),
        range('A', 'Z'),
        [0,1,2,3,4,5,6,7,8,9,'!','^','$','#','*']
    );

    $hash = '';

    $absLen = count($abc);

    for ($i = 0; $i < $length; $i++) {
        $index = rand(0, $absLen - 1);
        $hash .= $abc[$index];
    }

    return $hash;
}

function drawTable(array $array): void{
    $html = showInputForm();
    $html .= '<table border ="1">';
    $html .='<tbody>';


    foreach($array as $row){
        $html .="<th width = '50px'>$row</th> ";
    }
    $html .="<br>";
    $html .='</tbody>';
    $html .='</html>';
    echo $html;

}

?>





