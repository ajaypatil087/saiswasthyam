<?php

include("../php/db.php");

$id = $_POST['id'];
$amt = $_POST['amt'];
$date = $_POST['date'];

$query = "INSERT INTO fees(slNo, amt, dates) VALUES ('$id','$amt','$date')";
$result = mysqli_query($connect,$query);
if($result){
    echo 1;
}
else{
    echo 0;
}

?>