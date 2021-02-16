<?php

session_start();
if (isset($_SESSION['email'])){
    header('Location: home.php');
}

ini_set('display_errors','On');
error_reporting(E_ALL);

include_once('functions.php');

$error='';
$error2='';
$error3='';
$error4='';
$error5='';

 function userAlreadyExists($jmbg){
    $users = readUsers();
    foreach($users as $user){
        $userData = explode(' ', $user);
        if ($userData[2] === $jmbg){
            return true;
        }
    }
    return false;

}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
   

    if (userAlreadyExists($_POST['jmbg'])){
        $error ="User with that JMBG already exists";
    } elseif(strlen($_POST['jmbg']) !== 13){
        $error='JMBG must have 13 digits';
    } elseif(!is_numeric($_POST['jmbg'])){
        $error='JMBG can only contain numbers';
    } elseif(preg_match('/[^a-zA-Z]/', $_POST['name'])){
        $error2="Dozvoljena su samo slova";
    } elseif(preg_match('/[^a-zA-Z]/', $_POST['lastname'])){
        $error3="Dozvoljena su samo slova";
    } elseif(preg_match('/[^a-zA-Z]/', $_POST['drzava'])){
        $error4="Dozvoljena su samo slova";
    } elseif(preg_match('/[^a-zA-Z]/', $_POST['grad'])){
        $error5="Dozvoljena su samo slova";
    } else {

    $name = $_POST['name'];
    $lastName = $_POST['lastname'];
    $jmbg = $_POST['jmbg'];
    $datumRodjenja = $_POST['datum'];
    $email = $_POST['email'];
    $password = crypt($_POST['password'],PASSWORD_BCRYPT);
    $grad = $_POST['grad'];
    $drzava = $_POST['drzava'];
    $vakcina = $_POST['vakcina'];
    $datumVakcine = $_POST['datumVakcine'];

    $users = [
        'name' => $name,
        'lastname' => $lastName,
        'jmbg' => $jmbg,
        'datum' => $datumRodjenja,
        'email' =>$email,
        'datumVakcine' =>$datumVakcine,
        'password' => $password,
        'grad' => $grad,
        'drzava'=> $drzava,
        'vakcina' => $vakcina
        

    ];

    saveUser($users);
    header('Location: login.php');
        
    }

}

// }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Vakcinacija</title>
</head>
<body>


<h1>Iskazivanje interesovanje za vakcinisanje protiv COVID-19</h1>
<form action="index.php" method='POST'>


<div class="wrapper">
<label for="name">Ime</label> <input class="myinput" type="text" name='name' placeholder="Ime" required>
<h2><?php echo $error2; ?></h2>
<br></br>

<label for="lastname">Prezime</label> 
<input class="myinput" id="lale" type="text" name='lastname' placeholder="Prezime" required>
<h2><?php echo $error3; ?></h2>
<br></br>
<label for="jmbg">JMBG </label>
<input class="myinput" type="text" name='jmbg' placeholder="Jmbg" required>
<br></br>
<label for="datumRodjenja">Datum rodjenja</label> 
<input class="myinput" type="text" name='datum' placeholder="Datum rodjenja" required>
<br></br>
<label for="email">Email</label> 
<input class="myinput" type="email" name='email' placeholder="Email" required>
<br></br>
<label for="datumVakcine">Datum Vakcine</label>
<input  type="radio" name='datumVakcine' value="13.03.2021" required>13.03.2021
<input  type="radio" name='datumVakcine' value="14.03.2021" required>14.03.2021
<input  type="radio" name='datumVakcine' value="15.03.2021" required>15.03.2021
<br></br>
<br></br>
<label for="password">Password</label> 
<input class="myinput" type="password" name='password' placeholder="password" required>
<br></br>
<label for="grad">Grad</label> 
<input class="myinput" type="text" name='grad' placeholder="Grad" required>
<h2><?php echo $error5; ?></h2>
<br></br>
<label for="drzava">Drzava</label> 
<input class="myinput" type="text" name='drzava' placeholder="Drzava" required>
<h2><?php echo $error4; ?></h2>
<br></br>
<label for="vakcina">Vakcina</label> 
<div class="radio">
 <input  type="radio" name='vakcina' value="Fajzer" required>Fajzer
<input  type="radio" name='vakcina' value="Sputnjik V" required>Sputnjik V
<input  type="radio" name='vakcina' value="Sinopharm" required>Sinopharm

</div>
<h2><?php echo $error; ?></h2>

<input class="mybutton"type="submit" value='Potvrdi'>
</div>





</form>
    
</body>
</html>