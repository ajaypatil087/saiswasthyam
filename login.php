<!DOCTYPE html>
<html lang="en">
<head>
<?php
session_start();
include("php/db.php");
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="header/main.css">
    <style>
        html,body{
            margin: 0;
            padding: 0;
        }

        .header{
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100vw;
            height: 11vh;
            color: white;
            flex-direction: column;
            background-color: rgba(0,0,0,.5);
            padding-bottom: 0rem;
        }

        .header .logo{
            padding-top: .6rem;
            font-size: 2rem;
            font-family: logoFont;
            color: orange;
        }

        .header .minLogo{
            font-family: sans-serif;
            font-size: .9rem;
        }

        section{
            height: 89vh;
            width: 100vw;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-flow: column;
        }

        .login{
            width: 9rem;
        }
        @media only screen and (max-width: 600px){
            .header .logo{
                font-size: 1.6rem;
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <?php
        if(empty($_POST['uname'])){
            $uname = "";
        }
        else{
            $uname = test_input($_POST["uname"]);
        }

        if(empty($_POST['pass'])){
            $pass = "";
        }
        else{
            $pass = test_input($_POST["pass"]);
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>
    <main>
        <header class="header">
            <div class="logo">SAI SWASTHYAM</div>
            <div class="minLogo">FITNESS CENTER</div>
        </header>
        <section data-aos="fade-right">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                <div class="input-container">
                    <input type="text" name="uname" value="<?php echo $uname; ?>" required=""/>
                    <label>User Name</label>		
                </div>
                <div class="input-container">
                    <input type="password" name="pass" id="password" required=""/>
                    <label>PASSWORD</label>		
                </div>
                <div class="input-conainer text-center">
                    <button class="login myBtn" type="submit" name="submit">LOGIN <i class="fas fa-sign-in-alt"></i></button>
                </div>
            </form>
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
    <?php

        if(isset($_POST['submit'])){
            if($uname !="" && $pass != ""){
                $query = "SELECT * FROM user WHERE uname = '$uname' AND pass = '$pass'";
                $result = mysqli_query($connect,$query);
                $count = mysqli_num_rows($result);
                if($count == 1){
                    $_SESSION['log'] = 1;
                    header("location: home/home.php");
                }
                else{
                    session_destroy();
                    ?>
                        <script>
                            alert("Wrong Username or Password");
                        </script>
                    <?php
                }
            }
        }
    ?>
</body>
</html>