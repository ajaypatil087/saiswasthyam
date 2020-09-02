<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FEES REGISTRY</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="../header/main.css">
    <style>
        .opBar{
            width: 99vw;
            min-height: 5vh;
            padding: 1vh 20px 1vh 20px;
            background-color: transparent;
            display: flex;
            flex-wrap: wrap;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            border: 0px solid red;
        }

        .Fbtn{
            width: 5vw;
            padding: 0;
        }

        .search > div {
            display: inline-block;
            position: relative;
        }
        
        .search > div:after {
            content: "";
            background: white;
            width: 4px;
            height: 12px;
            position: absolute;
            top: 21px;
            right: -2px;
            transform: rotate(135deg);
        }
        
        .search > div > input {
            color: white;
            font-size: 16px;
            background: transparent;
            width: 25px;
            height: 25px;
            padding: 10px;
            border: solid 3px white;
            outline: none;
            border-radius: 35px;
            transition: width 0.5s;
        }
        
        .search > div > input::placeholder {
            color: #efefef;
            opacity: 0;
            transition: opacity 150ms ease-out;
        }
        
        .search > div > input:focus::placeholder {
            opacity: 1;
        }
        
        .search > div > input:focus,
        .search > div > input:not(:placeholder-shown) {
            width: 250px;
        }


        .main-container{
            height: 81vh;
            width: 100vw;
            padding: 1vh 1vh;
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            flex-direction: column;
            flex-wrap: nowrap;
            overflow-x: auto;
            border: 0px solid red;
        }

        .main-container .list-container{
            min-height: 3rem;
            padding: .5rem;
            width: 100%;
            color: white;
            border-radius: 15px;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            background-color: #1e1f1e;
            justify-content: space-between;
            align-items: center;
            margin-bottom: .3rem;
            cursor: pointer;
        }

        .list-container .name{
            border: 0px solid white;
            flex-wrap: wrap;
            font-size: 1;
            width: 35%;
            
        }

        .list-container .pno{
            border: 0px solid red;
            overflow: wrap;
            font-size: 1;
            
        }



        @media only screen and (max-width: 600px){
            .Fbtn{
                width: 16vw;
            }

            .search > div > input:focus,
            .search > div > input:not(:placeholder-shown) {
                width: 11rem;
            }
            .main-container{
                padding: 1vh 3px;
            }

            .list-container .name{
                width: 33%;
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
        $query = "SELECT customer.slNo, customer.names, customer.pno, fees.slNo,fees.amt,fees.dates FROM customer, fees 
        WHERE customer.slno = fees.slNo ORDER BY dates DESC";
        $result = mysqli_query($connect,$query);
?>
    <main>
        <section class="opBar">
            <button class="myBtn Fbtn" onclick="window.history.back();"><i class="fas fa-arrow-left"></i></button>
            <div class="search">
                <div>
                    <input type="text" id="search" placeholder="Search . . ." required>
                </div>
            </div>
        </section>
        <section class="main-container">
            <?php  
            while($row = mysqli_fetch_array($result)){
            ?>
            <div class="list-container">
                <div class="name text-center"><?php echo $row['names']; ?></div>
                <div class="pno text-center"><?php echo $row['pno']; ?></div>
                <div class="text-center"><?php echo $row['amt']."/-"; ?></div>
                <div class="hidden"><?php echo $row['dates']; ?></div>
            </div>
            <?php
            }
            ?>
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
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".main-container .list-container").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        })
    </script>
</body>
</html>