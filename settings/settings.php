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
    <title>SETTINGS</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="../header/main.css">
    <style>
        main{
            width: 100vw;
            height: 89vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .btn-container div{
            padding: .8rem;
        }


        div .myBtn{
            width: 21rem;
        }

        .auth, .passUpdate, .userUpdate{
            position: absolute;
            z-index: 1;
            width: 100vw;
            height: 100vh;
            top: 0;
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(255,255,255,.5);
        }
        
        .form-container{
            width: 40vw;
            height: 40vh;
            background: rgba(0,0,0,.9);
            padding: 3rem;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            border-radius: 14px;
        }

        .form-container .closeBtn{
            border: 0px solid white;
            color: red;
            font-size: 2rem;
            font-weight: bold;
            position: absolute;
            top: 30%;
            left: 67%;
            cursor: pointer;
        }

        .closeBtn:hover{
            text-shadow: 1px 1px 2px white;
        }

        @media only screen and (max-width: 600px){
            .form-container{
                width: 85vw;
            }

            .form-container .closeBtn{
                left: 82%;
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <?php
    include("../php/db.php");
    include("../php/sms.php");
    include("../header/header.html");
    $query = "SELECT * FROM user WHERE id='1'";
    $result = mysqli_query($connect,$query);
    while($row = mysqli_fetch_array($result)){
        $name = $row['uname'];
        $pno = $row['pno'];
    }

    ?>
    <main data-aos="fade-right">
        <section class="loader">
            <div class="loading">
                <img src="../images/bar.png" alt="loading.."></br>
                <div>LOADING..</div>
            </div>
        </section>

        <section class="btn-container">
            <div>
                <button class="myBtn username">CHANGE USERNAME <i class="fas fa-user-shield"></i></button>
            </div>
            <div>
                <button class="myBtn password">CHANGE PASSWORD <i class="fas fa-user-lock"></i></button>
            </div>
            <div>
                <button class="myBtn" onclick="window.location.href='smsService.php'">SMS SERVICES <i class="fas fa-sms"></i></button>
            </div>
        </section>

        <section class="auth user" style="display: none;">
           <div class="form-container">
               <div class="closeBtn">
                   <span>&times;</span>
               </div>
                <div class="input-container">
                    <input type="text" id="username1" name="name" required="" />
                    <label>USERNAME <i class="fas fa-user"></i></label>
                </div>
                <div class="input-container">
                    <input type="password" id="password1" name="password" required="" />
                    <label>PASSWORD <i class="fas fa-key"></i></label>
                </div>
                <div>
                    <button class="myBtn userAuth">Authenticate</button>
                </div>
           </div>
        </section>
        <section class="auth pass" style="display: none;">
           <div class="form-container">
               <div class="closeBtn">
                   <span>&times;</span>
               </div>
                <div class="input-container">
                    <input type="text" id="username2" name="name" required="" />
                    <label>USERNAME <i class="fas fa-user"></i></label>
                </div>
                <div class="input-container">
                    <input type="password" id="password2" name="password" required="" />
                    <label>PASSWORD <i class="fas fa-key"></i></label>
                </div>
                <div>
                    <button class="myBtn passAuth">Authenticate</button>
                </div>
           </div>
        </section>
        <section class="userUpdate" style="display: none;">
            <div class="form-container">
                <div>
                    <div class="input-container">
                        <input type="text" id="username" />
                        <label>NEW USERNAME</label>
                    </div>
                    <div>
                        <button class="myBtn updateUser">UPDATE USERNAME</button>
                    </div>
                </div>
            </div>
        </section>
        <section class="passUpdate" style="display: none;">
            <div class="form-container">
                <div>
                    <div class="input-container">
                        <input type="text" id="pass1" />
                        <label>PASSWORD</label>
                    </div>
                    <div class="input-container">
                        <input type="text" id="pass2" />
                        <label>RE-ENTER PASSWORD</label>
                    </div>
                    <div>
                        <button class="myBtn updatePass">UPDATE PASSWORD</button>
                    </div>
                </div>
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
            $(".username").click(function(){
                $(".user").show();
            });

            $(".password").click(function(){
                $(".pass").show();
            });
            
            $(".closeBtn").click(function(){
                $(".auth").hide();
            });

            $(".userAuth").click(function(){
                let username = $("#username1").val();
                let pass = $("#password1").val();
                if(username != "" || pass != "")
                    authenticate(1,1,username,pass);
                else
                    alert("Fill all the feilds"); 
            });

            $(".passAuth").click(function(){
                let username = $("#username2").val();
                let pass = $("#password2").val();
                if(username != "" || pass != "")
                    authenticate(1,2,username,pass);
                else
                    alert("Fill all the feilds");  
            });

            $(".updateUser").click(function(){
                let username = $("#username").val();
                authenticate(0,1,username,0);
            });

            $(".updatePass").click(function(){
                let pass1 = $("#pass1").val();
                let pass2 = $("#pass2").val();
                if(pass1 != pass2){
                    alert("password don't match");
                }
                else{
                    authenticate(0,2,0,pass1);
                }
            });
            function update(par){
                if(par == 1){
                    $(".userUpdate").show();
                }
                else{
                    $(".passUpdate").show();
                }
            }

            function authenticate(auth,par,username,pass) {
                loadStart();
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        loadStop();
                        if(this.responseText==1){
                            alert("Username Updated!");
                            $(".userUpdate").hide();
                            $(".auth").hide();

                            <?php
                            $msg = $name." USERNAME WAS UPDATED";
                            sms($pno,$msg);
                            ?>
                        }
                        else if(this.responseText==2){
                            alert("Password updated!");
                            $(".passUpdate").hide();
                            $(".auth").hide();

                            <?php
                            $msg = $name." YOUR PASSWORD WAS CHANGED";
                            sms($pno,$msg);
                            ?>
                        }
                        else if(this.responseText == 3){
                            alert("Incorrect Username or Password");
                            return;
                        }
                        else if(this.responseText == 4){
                            update(par);
                        }
                        else{
                            alert("There was some error! Please try again.");
                        }
                    }
                };
                xhttp.open("POST", "update.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("auth="+auth+"&par="+par+"&username="+username+"&pass="+pass);
            }

            function loadStart(){
                $(".loader").css("display","flex");
            }

            function loadStop(){
                $(".loader").css("display","none");
            }
        });

    </script>
</body>
</html>