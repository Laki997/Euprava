<?php 

$file = 'users.txt';

function saveUser($user){

 global $file;
 try {
     $fs = fopen($file, "a");
     foreach($user as $prop){
         fwrite($fs,$prop . ' ');
     }

     fwrite($fs, "\n");
     fclose($fs);
 } catch (Exception $e){
     echo "Save exception: " . e->getMessage();
 }

}

function readUsers(){
    global $file;
    try{
        $fs = fopen($file, "r");
        $users=[];
        while (($line = fgets($fs)) !==false){
            $user = $line;
            array_push($users,$user);
        }

        fclose($fs);
        return $users;
    } catch (Exception $e){
        echo "Read exception". $e->getMessage();
    }
}



?>
