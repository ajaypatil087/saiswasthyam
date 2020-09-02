<!DOCTYPE html>
<html lang="en">
<head>
<?php
session_start();
if($_SESSION['log'] != 1){
    session_destroy();
    header("location: ../login.php");
}
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMS SERVICES</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="../header/main.css">
    <style>
        .main-container{
            height: 80vh;
            width: 100vw;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;

        }
        .main-container div{
            margin: 1rem;
        }
        .opBar{
            padding: 5px;
            width: 100vw;
            height: 2rem;
        }

        .opBar .myBtn{
            width: 4rem;
            padding: 0;
        }
        .balance{
            font-size: 1.5rem;
            font-weight: bold;
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgb(230,230,230);
        }

        @media only screen and (max-width: 600px){
            .balance{
                font-size: 1rem;
                width: auto;
                height: 3rem;
                flex-wrap: wrap;
            }
        }
    </style>
</head>
<body>
    <?php
    include("../header/header.html");
    $api_key = '45F4E7592348BD';

    $api_url = "http://webmsg.smsbharti.com/app/miscapi/".$api_key."/getBalance/true/";

    $credit_balance = file_get_contents( $api_url);
    $data = explode("}",$credit_balance = explode(",",$credit_balance)[2]);
    ?>
    <main>
        <section class="opBar">
            <button class="myBtn" onclick="window.history.back();"><i class="fas fa-arrow-left"></i></button>
        </section>
        <section class="main-container" data-aos="fade-left">
            <div class="balance">
                <?php echo $data[0]; ?>
            </div>
            <div>
                <a href="http://webmsg.smsbharti.com/app/Dashboard" target="_blank"><button class="btn btn-lg btn-primary">SERVICE DASHBOARD</button></a>
            </div>
            <div>
                <a href="" target="_blank"><button class="btn btn-lg btn-danger">SMS RECHARGE</button></a>
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
</body>
</html>