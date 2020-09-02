<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if($_SESSION['log'] != 1){
    session_destroy();
    header("location: ../login.php");
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="../header/main.css">
    <style>
        main{
            padding: 0;
            margin: 0;
            height: 89vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .mainBox{
            min-width: 50vw;
            height: 80vh;
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            background-color: rgba(0,0,0,.7);
            justify-content: space-around;
            align-items: center;
            border: 0px solid red;
        }
        .box-container{
            width: 100%;
            color: white;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            flex-direction: row;
            justify-content: space-around;
        }

        .dp{
            color: black;
            font-size: 8rem;
            padding: 0rem;
            border-radius: 50%;
            background-color: rgba(240,240,240,.99);
        }

        .dp span{
            padding: 2rem;
        }

        .content{
            display: flex;
            flex-direction: row;
        }

        td{
            padding: 10px;
            align-items: center;
            justify-content: center;
            border-bottom: 1px solid rgba(150, 150, 150, .8);
        }

        .active{
            color: green;
        }

        .inactive{
            color: red;
        }

        .btn-container{
            display: flex;
            width: 60%;
            flex-direction: row;
            justify-content: space-around;
            align-items: center;
        }
        .Pbtn{
            width: 8vw;
        }

        .fees-container{
            width: 100vw;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: absolute;
            top: 0;
            z-index: 1;
            background: rgba(61, 60, 60,.99);
        }
        .fees-container span{
            color: red;
            font-size: 3rem;
            font-weight: bold;
            position: absolute;
            top: 1px;
            right: 10px;
            cursor: pointer;
        }

        .fees-container span:hover{
            text-shadow: 2px 2px 2px black;
        }
        .fees-container span:active{
            text-shadow: -2px -2px 2px black;
        }
        .fees-container .title{
            text-shadow: 2px 2px 5px black, -2px -2px 5px black;
            margin: 1rem 0 1rem 0;
        }
        .list-container{
            max-height: 85vh;
            width: 60vw;
            display: flex;
            justify-items: center;
            align-items: center;
            overflow: auto;
        }

        .list-container td{
            font-size: 1.3rem;
        }
        #amt{
            padding-right: 3rem;
        }

        .fadeIn{
            animation: fadeIn .3s ease-in-out;
        }

        @keyframes fadeIn{
            from{
                height: 0vh;
                width: 50vw;
            }
            to{
                height: 100vh;
                width: 100vw;
            }
        }
        @media only screen and (max-width: 600px){
            .mainBox{
                min-width: 85vw;
                height: 85vh;
                flex-direction: column;
                flex-wrap: wrap;
            }

            .box-container{
                flex-direction: column;
                font-size: 1.3rem;
            }

            .dp{
                font-size: 6.5rem;
                margin-bottom: 0px;
            }

            td{
                padding: 5px;
            }

            .btn-container{
                width: 100%;
            }

            .Pbtn{
                width: 20vw;
            }
        }
    </style>
</head>
<body>
    <?php
        include("../php/db.php");
        include("../header/header.html");

        $slNo = $_GET['id'];
        $query = "SELECT amt,dates FROM fees WHERE slNo = '$slNo'";
        $result = mysqli_query($connect,$query);
    ?>
    <main>
        <section class="fees-container" style="display: none;">
            <span class="closeBtn">&times;</span>
            <div class="text-center text-light title"><h3>PAYMENT HISTORY</h3></div>
            <div class="list-container">
                <table class="text-light" align="center">
                    <?php
                        while($row = mysqli_fetch_array($result)){
                    ?>
                    <tr>
                        <td id="amt"><?php echo $row['amt']; ?></td>
                        <td><?php echo $row['dates']; ?></td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
            </div>
        </section>
        <section class="mainBox" data-aos="fade-left">
            <div class="box-container">
                <?php
                $query = "SELECT * FROM customer WHERE slNo='$slNo'";
                $result = mysqli_query($connect,$query);
                $row = mysqli_fetch_array($result);
                ?>
                <div class="dp"><span><i class="fas fa-user"></i></span></div>
                <!--<div class="dp"><img src="../images/pc.jpg" width="200" height="205" style="border-radius: 50%;" alt="pic"></div>-->
                <div class="content">
                    <table border="0" align="center">
                        <tr>
                            <td><?php echo $row['names']; ?></td>
                            <td><i class="fas fa-user"></i></td>
                        </tr>
                        <tr>
                            <td><span class="text-uppercase"><?php echo $row['pno']; ?></span></td>
                            <td><i class="fas fa-phone-alt"></i></td>
                        </tr>
                        <tr>
                            <td><?php echo $row['idNum']; ?></td>
                            <td><i class="fas fa-address-card"></i></td>
                        </tr>
                        <tr>
                            <td><?php echo $row['doj']; ?></td>
                            <td><i class="fas fa-calendar-alt"></i></td>
                        </tr>   
                        <tr>
                            <td><?php echo $row['dob']; ?></td>
                            <td><i class="fas fa-baby"></i></td>
                        </tr>
                        <tr>
                            <td><?php echo $row['gender']; ?></td>
                            <td><i class="fas fa-venus-mars"></i></td>
                        </tr>
                        <tr>
                            <td><?php echo $row['bGrp']; ?></td>
                            <td><i class="fas fa-tint" style="color: red;"></i></td>
                        </tr>
                        <tr>
                            <td><?php $status = $row['status']; echo $status; ?></td>
                            <td>
                                <?php 
                                    if($status == 'active' || $status == 'ACTIVE'){
                                    ?>
                                        <i class="fas fa-circle active"></i>
                                    <?php
                                    }
                                    else{
                                    ?>
                                        <i class="fas fa-circle inactive"></i>
                                    <?php
                                    }
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="btn-container">
                <button class="myBtn Pbtn back" onclick="window.history.back();"><i class="fas fa-arrow-left"></i></button>
                <button class="myBtn Pbtn fees"><i class="fas fa-rupee-sign"></i></button>
                <button class="myBtn Pbtn edit" onclick="<?php echo("window.location.href='custUpdate.php?slNo=$slNo'"); ?>"><i class="fas fa-user-edit"></i></button> 
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
            $(".fees").click(function(){
                $(".fees-container").addClass("fadeIn");
                $(".fees-container").show();
            });

            $(".closeBtn").click(function(){
                $(".fees-container").removeClass("fadeIn");
                $(".fees-container").hide();
            });

        });
    </script>
</body>
</html>