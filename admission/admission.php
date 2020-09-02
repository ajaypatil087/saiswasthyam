<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMISSION</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">
    <link rel="stylesheet" href="../header/main.css">
    <style>
        section{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            height: 89vh;
            padding-top: 0rem;
        }


        section .formBody{
            width: 40vw;
            padding: 1rem;
            border-radius: 15px;
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
            background: rgba(0,0,0,.6);
        }

        .formTitle{
            font-weight: bolder;
            font-size: 1.8rem;
            color: white;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 2px black;
        }

        @media only screen and (max-width: 600px){
            section .formBody{
                width: 80vw;
            }
            
            .formTitle{
                margin-top: 0rem;
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
        include("../php/sms.php");
        if(empty($_POST['name'])){
            $name = "";
        }
        else{
            $name = strtoupper(test_input($_POST["name"]));
        }

        if(empty($_POST['pno'])){
            $pno = "";
        }
        else{
            $pno = test_input($_POST["pno"]);
        }

        if(empty($_POST['idNum'])){
            $idNum = "";
        }
        else{
            $idNum = strtoupper(test_input($_POST["idNum"]));
        }

        if(empty($_POST['dob'])){
            $dob = "";
        }
        else{
            $dob = test_input($_POST["dob"]);
        }

        if(empty($_POST['doj'])){
            $doj = "";
        }
        else{
            $doj = test_input($_POST["doj"]);
        }

        if(empty($_POST['bGrp'])){
            $bGrp = "";
        }
        else{
            $bGrp = test_input($_POST["bGrp"]);
        }

        if(empty($_POST['gender'])){
            $gender = "";
        }
        else{
            $gender = test_input($_POST["gender"]);
        }
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        include("../header/header.html");
    ?>
    <section>
        <div class="formBody" data-aos="fade-right">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                <div class="formTitle text-center">
                    ADMISSION FORM
                </div>

                <div class="input-container">
                    <input type="text" name="name" value="<?php echo $name; ?>" class="text-uppercase" required/>
                    <label><i class="far fa-user"></i> FULL NAME</label>		
                </div>

                <div class="input-container">
                    <input type="number" name="pno" value="<?php echo $pno; ?>" min="0" required/>
                    <label><i class="fas fa-mobile-alt"></i> CONTACT NUMBER</label>		
                </div>

                <div class="input-container">
                    <input type="text" name="idNum" class="text-uppercase"  value="<?php echo $idNum; ?>"/>
                    <label><i class="fas fa-address-card"></i> ID PROOF</label>		
                </div>

                <div class="input-container">
                    <input type="date" name="dob" value="<?php echo $dob; ?>" required/>
                    <label class="myLabel"><i class="fas fa-calendar-alt"></i> DATE OF BIRTH</label>		
                </div>

                <div class="input-container">
                    <input type="date" name="doj" value="<?php echo $doj; ?>" required/>
                    <label class="myLabel"><i class="fas fa-calendar-alt"></i> DATE OF JOINING</label>		
                </div>

                <div class="input-container">
                    <select name="bGrp" required>
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
                    <select name="gender" required>
                        <option value="MALE">MALE</option>
                        <option value="FEMALE">FEMALE</option>
                    </select>
                    <label class="myLabel">GENDER</label>
                </div>

                <div class="text-center">
                    <button type="submit" name="submit" class="myBtn submit">SUBMIT</button>
                </div>
            </form>
        </div>
    </section>
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
    <?php
        if(isset($_POST['submit'])){
            if($name == "" && $pno == "" && $dob == "" && $doj == "" && $bGrp == "" && $gender == ""){
                ?>

                <script>alert("Fill all Required Fields!");</script>

                <?php
            }
            else{
                $query = "SELECT * FROM customer WHERE (names = '$name' AND pno = '$pno')";
                $result = mysqli_query($connect,$query);
                $count = mysqli_num_rows($result);
                if($count >= 1)
                {
                    ?>

                    <script>alert("This Customer is Already exist!");</script>

                    <?php
                }
                else{
                    $query = "INSERT INTO customer(names, pno, idNum, dob, doj, bGrp,gender) 
                    VALUES ('$name','$pno','$idNum','$dob','$doj','$bGrp','$gender')";

                    $result = mysqli_query($connect,$query);

                    if($result){
                        $arr = explode(" ",$name);
                        $msg = $arr[0]." WELCOME TO SAI SWASTHYAM FITNESS CLUB";
                        sms($pno,$msg);

                        ?>
                            <script>
                                alert("NEW CUSTOMER REGISTERED!");
                                window.location.href="../home/home.php";
                            </script>
                        <?php
                    }
                    else{
                        ?>
                        <script>
                            alert("There was an error! please try again");
                            window.location.href="admission.php";
                        </script>
                    <?php
                    }
                }
            }
        }
    ?>
</body>
</html>