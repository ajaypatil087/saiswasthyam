<?php
include("../php/db.php");
$par = $_POST['par'];
$username = $_POST['username'];
$pass = $_POST['pass'];
$auth = $_POST['auth'];
if($auth == 1){
    $query = "SELECT * FROM user WHERE uname = '$username' AND pass = '$pass'";
    $result = mysqli_query($connect, $query);
    $count = mysqli_num_rows($result);
    if($count!=1){
        echo 3;
    }
    else{
        echo 4;
    }
}
else{
    if($par == 1){
        $query = "UPDATE user SET uname='$username' WHERE 1";
        $result = mysqli_query($connect,$query);
        if($result)
            echo 1;
    }
    elseif($par == 2){
        $query = "UPDATE user SET pass='$pass' WHERE 1";
        $result = mysqli_query($connect,$query);
        if($result)
            echo 2;
    }
    else{
            echo 5;
    }
}


?>