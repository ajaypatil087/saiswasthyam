<?php

include("../php/db.php");
if($_POST['status'] == "" || !isset($_POST['status'])){
    $slNo = $_POST['slNo'];
    $name = strtoupper($_POST['name']);
    $pno = $_POST['pno'];
    $idNum = strtoupper($_POST['idNum']);
    $dob = $_POST['dob'];
    $doj = $_POST['doj'];
    $bGrp = $_POST['bGrp'];
    $gender = $_POST['gender'];

    $query = "UPDATE customer SET names='$name', pno='$pno',idNum='$idNum',dob='$dob',doj='$doj',bGrp='$bGrp',gender='$gender' 
    WHERE slNo = '$slNo'";
    $result = mysqli_query($connect,$query);

    if($result){
        echo 1;
    }
    else{
        echo 0;
    }
}
else{
    $slNo = $_POST['slNo'];
    $status = $_POST['status'];
    $query = "UPDATE customer SET status = '$status' WHERE slNo = '$slNo'";
    $result = mysqli_query($connect,$query);

    if($result){
        echo 1;
    }
    else{
        echo 0;
    }
}

?>