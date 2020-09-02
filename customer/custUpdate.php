<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="../header/main.css">
    <style>
        main{
            height: 89vh;
            width: 100vw;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .main-box{
            min-height: 85vh;
            width: 50vw;
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, .7);
        }

        .main-box h2{
            margin-bottom: 1.5rem;
        }
        .input-container{
            width: 60%;
        }


        .status{
            border-radius: 15px;
            color: white;
            font-weight: bold;
            margin-bottom: 1rem;
            cursor: pointer;
            font-size: 1.1rem;
            text-shadow: 1px 1px 2px black;
        }
        .active{
            background-color: lime;
        }
        .inactive{
            background: rgb(255, 31, 20);
        }

        .btn-container{
            display: flex;
            flex-direction: row;
            width: 50%;
            justify-content: space-between;
            align-items: center;
        }

        .back, .update{
            width: 8rem;
        }

        @media only screen and (max-width: 600px){
            .main-box{
                min-height: 85vh;
                min-width: 90vw;
            }
            .main-box h2{
                font-size: 1.7rem;
            }
            .input-container{
                width: 85%;
            }

            .btn-container{
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <?php
        session_start();
        if($_SESSION['log'] != 1){
            session_destroy();
            header("location: ../login.php");
        }
        include("../php/db.php");
        include("../header/header.html");

        $slNo = $_GET['slNo'];
        $query = "SELECT * FROM customer WHERE slNo = '$slNo'";
        $result = mysqli_query($connect,$query);
        $row = mysqli_fetch_array($result);
    ?>
    <main>
        <section class="loader">
            <div class="loading">
                <img src="../images/bar.png" alt="loading.."></br>
                <div>LOADING..</div>
            </div>
        </section>
        <section class="main-box" data-aos="fade-right">
            <h2 class="text-light">UDATE INFORMATION <i class="fas fa-user-edit"></i></h2>
            <div class="hidden slNo"><?php echo $slNo; ?></div>
            <div class="input-container">
                <input type="text" name="name" id="name" class="text-uppercase" value="<?php echo $row['names']; ?>" required/>
                <label>NAME</label>
            </div>
            <div class="input-container">
                <input type="text" name="pno" id="pno" value="<?php echo $row['pno']; ?>" required/>
                <label>CONTACT NUMBER</label>
            </div>
            <div class="input-container">
                <input type="text" name="idNum" class="text-uppercase" id="idNum" value="<?php echo $row['idNum']; ?>" required/>
                <label><i class="fas fa-address-card"></i> ID PROOF</label>		
            </div>

            <div class="input-container">
                <input type="date" name="dob" id="dob" value="<?php echo $row['dob']; ?>" required/>
                <label class="myLabel"><i class="fas fa-calendar-alt"></i> DATE OF BIRTH</label>		
            </div>

            <div class="input-container">
                <input type="date" name="doj" id="doj" value="<?php echo $row['doj']; ?>" required/>
                <label class="myLabel"><i class="fas fa-calendar-alt"></i> DATE OF JOINING</label>		
            </div>

            <div class="input-container">
                <select name="bGrp" id="bGrp" required>
                    <option value="<?php echo $row['bGrp']; ?>"><?php echo $row['bGrp']; ?></option>
                    <option value="O +ve">O +ve</option>
                    <option value="O -ve">O -ve</option>
                    <option value="A +ve">A +ve</option>
                    <option value="A -ve">A -ve</option>
                    <option value="B +ve">B +ve</option>
                    <option value="B -ve">B -ve</option>
                    <option value="AB +ve">AB +ve</option>
                    <option value="AB -ve">AB -ve</option>
                </select>
                <label class="myLabel"><i style="color: red;" class="fas fa-tint"></i> BLOOD GROUP</label>		
            </div>

            <div class="input-container">
                <select name="gender" id="gender" required>
                    <?php
                        if($row['gender'] == 'MALE'|| $row['gender'] == 'male'){
                    ?>
                        <option value="MALE">MALE</option>
                        <option value="FEMALE">FEMALE</option>
                        <?php
                        }
                        else{
                        ?>
                        <option value="FEMALE">FEMALE</option>
                        <option value="MALE">MALE</option>
                        <?php
                        }
                        ?>
                </select>
                <label class="myLabel">GENDER</label>
            </div>
            <div class="text-center">
                <?php
                    if($row['status']=='ACTIVE' || $row['status'] == 'active'){
                        ?>
                        <button class="status inactive">INACTIVE <i class="fas fa-user-times"></i></button>
                        <?php
                    }
                    else{
                        ?>
                        <button class="status active">ACTIVE <i class="fas fa-user-plus"></i></button>
                        <?php
                    }
                ?>
            </div>
            <div class="text-center btn-container">
                <button class="myBtn back" onclick="window.history.back();"><i class="fas fa-arrow-left"></i></button>
                <button type="submit" class="myBtn update">UPDATE</button>
            </div>
        </section>
    </main>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init({
          duration : 900
      });
    </script>
    <script>
        $(document).ready(function(){
           $(".update").click(function(){
               let slNo = $(".slNo").text();
                let name = $("#name").val();
                let pno = $("#pno").val();
                let idNum = $("#idNum").val();
                let dob = $("#dob").val();
                let doj = $("#doj").val();
                let bGrp = $("bGrp").val();
                let gender = $("#gender").val();
                update(slNo,name,pno,idNum,dob,doj,bGrp,gender);
           });

           $(".active").click(function(){
                let slNo = $(".slNo").text();
                let status = "ACTIVE";
                updateStatus(slNo,status);
           });

           $(".inactive").click(function(){
                let slNo = $(".slNo").text();
                let status = "INACTIVE";
                updateStatus(slNo,status);
           });

            function loadStart(){
                $(".loader").css("display","flex");
            }

            function loadStop(){
                $(".loader").css("display","none");
            }


            function updateStatus(slNo,status) {
                loadStart();
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200){
                        loadStop();
                        if(this.responseText == 1){
                            alert("Customer Information Updated!");
                            window.location.href = "custProfile.php?id="+slNo;
                        }
                        else{
                            alert(this.responseText);
                        }
                    }
                };
                xhttp.open("POST", "update.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("slNo="+slNo+"&status="+status);
            }


            function update(slNo,name,pno,idNum,dob,doj,bGrp,gender) {
                loadStart();
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200){
                        loadStop();
                        if(this.responseText == 1){
                            alert("Customer Information Updated!");
                            window.location.href = "custProfile.php?id="+slNo;
                        }
                        else{
                            alert(this.responseText);
                        }
                    }
                };
                xhttp.open("POST", "update.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("slNo="+slNo+"&name="+name+"&pno="+pno+"&idNum="+idNum+"&dob="+dob+"&doj="+doj+"&bGrp="+bGrp+"&gender="+gender);
            }
        });
    </script>
</body>
</html>