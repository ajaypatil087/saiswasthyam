<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="../header/main.css">
    <style>
        section{
            height: 89vh;
            width: 100vw;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .btn-container{
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <main>
        <?php
            session_start();
            if($_SESSION['log'] != 1){
                session_destroy();
                header("location: ../login.php");
            }
            include('../header/header.html');
        ?>
        <section data-aos="fade-left">
            <div class="btn-container">
                <button class="myBtn" onclick="window.location.href='../admission/admission.php'">NEW ADMISSION <i class="fas fa-user-plus"></i></button>
            </div>
            <div class="btn-container">
                <button class="myBtn" onclick="window.location.href='../fee/list.php'">FEES <i class="fas fa-rupee-sign"></i></button>
            </div>
            <div class="btn-container">
                <button class="myBtn" onclick="window.location.href='../customer/custList.php'">CUSTOMERS <i class="fas fa-users"></i></button>
            </div>
            <div class="btn-container">
                <button class="myBtn" onclick="window.location.href='../notification/notification.php'">NOTIFICATIONS <i class="fas fa-sms"></i></button>
            </div>
            <div class="btn-container">
                <button class="myBtn" onclick="window.location.href='../settings/settings.php'">SETTING <i class="fas fa-tools"></i></button>
            </div>
            <div class="btn-container">
                <button class="myBtn" onclick="window.location.href = '../php/logout.php'">LOGOUT <i class="fas fa-sign-out-alt"></i></button>
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