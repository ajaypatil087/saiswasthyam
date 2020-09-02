<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOTIFICATIONS</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="../header/main.css">
    <style>
        .form-container{
            width: 100vw;
            height: 75vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        form{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .send{
            padding: 0;
            margin: 0;
            width: 8rem;
        }
        .sent{
            background-color: rgb(75, 216, 75);
        }
        textarea{
            width: 40vw;
            height: 50vh;
        }

        @media only screen and (max-width: 600px){
            textarea{
                width: 70vw;
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
    include("../header/header.html");

    if(empty($_POST['msg'])){
        $msg = "";
    }
    else{
        $msg = test_input($_POST["msg"]);
    }
    if(empty($_POST['to'])){
        $to = "";
    }
    else{
        $to = test_input($_POST['to']);
    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
   <main data-aos="fade-right">
        <section>
            <h2 class="text-primary bg-light font-weight-bold text-center">NOTIFICATIONS</h2>
            <div class="form-container">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                    <div class="input-container">
                        <select name="to" id="to" required="">
                            <option value="ALL">TO ALL CUSTOMERS</option>
                            <option value="ACTIVE">ONLY ACTIVE CUSTOMERS</option>
                        </select>
                    </div>
                    <div class="input-container">
                        <textarea name="msg" id="msg" placeholder="TEXT HERE.." required=""></textarea>
                    </div>
                    <div>
                        <button type="submit" name="submit" class="myBtn send">SEND <i class="fas fa-paper-plane"></i></button>
                    </div>
                </form>
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
<?php
if(isset($_POST['submit'])){
    $msg = $_POST['msg'];
    $to = $_POST['to'];
    if($msg != ""){
        if($to == "ALL"){
            $query = "SELECT pno FROM customer";
        }
        else{
            $query = "SELECT pno FROM customer WHERE status='ACTIVE'";
        }

        $result = mysqli_query($connect, $query);
        while($row = mysqli_fetch_array($result)){
            $to = $row['pno'];
            //sms($to,$msg);
        }

    ?>
        <script>
           let btn = document.querySelector(".send");
           btn.disabled = true;
           btn.innerHTML = "SENT <i class='fas fa-paper-plane'></i>";
        </script>
    <?php
    }
    
}

?>
    </body>
</html>