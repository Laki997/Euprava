<?php 

session_start();

if (isset($_SESSION['email'])){
    header('Location: home.php');
}

include_once('functions.php');
$error='';

// if (isset($_SESSION['email'])){
//     header('Location: home.php');
// }


if ($_SERVER['REQUEST_METHOD'] ==='POST'){

    

    $users = readUsers();

    foreach($users as $user){
        $userData = explode(' ', $user);
        if ($userData[4] === $_POST['email'] && password_verify($_POST['password'], $userData[6])){
            $_SESSION['name'] = $userData[0];
            $_SESSION['lastname'] = $userData[1];
            $_SESSION['email'] = $userData[4];
            $_SESSION['jmbg'] = $userData[2];
            $_SESSION['datum'] = $userData[3];
            $_SESSION['datumVakcine'] = $userData[5];
            $_SESSION['grad'] = $userData[7];
            $_SESSION['drzava'] = $userData[8];
            $_SESSION['vakcina'] = $userData[9];

            header("Location: home.php");
        }
    }
    

$error="The combination of email and password is not valid";
    
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Login</title>
</head>
<body>

<form class="form-login" action="login.php" method="POST">
<h1>Login na vas nalog</h1>
<div class="myinput-login">
 Email:<input class="input-login-email" type="email" name="email" required>
<br></br>
Password:<input class="input-login" type="password" name="password" required>
<br></br>
<h2><?php echo $error; ?></h2>
</div>

<input class="login-button" type="submit" value="Login">




</form>
    
</body>
</html>