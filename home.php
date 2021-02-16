<?php 

session_start();

if (!isset($_SESSION['email'])){
    header('Location: login.php');
}

include_once('functions.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Vakcina</title>
</head>
<body>

<h2 class="home">Dobrodosao <?php echo $_SESSION['name']."e";?></h2>
<h3>Lista prijavljenih korisnika za vakcinisanje protiv COVID-19</h3>
<ul>
<?php 

$users = readUsers();
foreach ($users as $user){
    $userData = explode(' ', $user);
        echo "<li> <h4>Ime:</h4> $userData[0] <h4> Prezime:</h4> $userData[1] <h4> JMBG:</h4> $userData[2] <h4>Datum:</h4> $userData[3] <h4>Email:</h4> $userData[4] <h4>Datum vakcinisanja:</h4> $userData[5] <h4>Grad:</h4> $userData[7] <h4>Drzava:</h4> $userData[8] <h4>Vakcina:</h4> $userData[9] </li>";
    }


?>



</ul>

    
</body>
</html>