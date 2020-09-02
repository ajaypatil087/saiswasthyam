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
    <title>Reminder</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="../header/main.css">
    <style>
        .opBar{
            width: 100vw;
            min-height: 5vh;
            margin-top: 1vh;
            padding: 0 1rem 0 1rem;
            background-color: transparent;
            display: flex;
            flex-wrap: wrap;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            border: 0px solid red;
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

        .list-container{
            height: 83vh;
            width: 100vw;
            padding: 1vh 10px;
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            flex-direction: column;
            flex-wrap: nowrap;
            overflow-x: auto;
            border: 0px solid red;
        }

        .list-container .cust-container{
            min-height: 3rem;
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
        }

        .cust-container .avatar{
            width: 3%;
            font-size: 2rem;
            border-radius: 15px 0 0 15px;
            padding-left: .5rem;
        }

        .cust-container .name{
            border: 0px solid white;
            flex-wrap: wrap;
            font-size: 1.2rem;
            width: 88%;
        }

        .cust-container .pno{
            border: 0px solid red;
            overflow: wrap;
            font-size: 1.2rem;
            width: 9%;
        }

        .cust-container .send{
            width: 4%;
            height: 3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            border-radius: 0 15px 15px 0;
            cursor: pointer;
            background-color: rgb(146, 146, 146);
        }
        .cust-container .send:hover{
            background-color: rgb(75, 216, 75);
        }
        .cust-container .hidden{
            display: none;
        }

        .btns{
            width: 10rem;
            padding: 0;
            margin: 0;
            height: 5vh;
            font-size: 1rem;
        }


        @media only screen and (max-width: 600px){
            .opBar{
                padding: 0 .7rem 0 .5rem;
            }
            .btns{
                width: auto;
                padding: 0 15px 0 10px;
                font-size: 1rem;
            }
            .cust-container .name{
                width: 60%;
            }

            .search > div > input:focus,
            .search > div > input:not(:placeholder-shown) {
                width: 12rem;
            }

            .cust-container .name{
                width: 70%;
            }
            .cust-container .send{
                width: 12%;
            }
        }
    </style>
</head>
<body>
    <?php
        include("../php/db.php");
        include("../php/sms.php");
        include("../header/header.html");
        $start = date("Y-m-d", strtotime("first day of this month"));
        $end = date("Y-m-d", strtotime("last day of this month"));
        $query = "SELECT * FROM customer WHERE customer.status = 'ACTIVE' AND customer.slNo 
        NOT IN(SELECT fees.slNo FROM fees WHERE customer.slNo = fees.slNo AND (fees.dates >= '$start' AND fees.dates <= '$end')) 
        ORDER BY customer.names";
        $result = mysqli_query($connect,$query);
    ?>
    <section class="opBar">
        <div>
            <button class="myBtn btns" onclick="history.back();"><i class="fas fa-arrow-left"></i></button>
        </div>
        <div class="search">
            <div>
                <input type="text" id="search" placeholder="Search . . ." required>
            </div>
        </div>
    </section>
    <main>
        <section class="list-container" data-aos="fade-right">
            <?php
                while($row = mysqli_fetch_array($result)){
                    $id = $row['slNo'];
            ?>
            <div class="cust-container">
                <div class="avatar"><i class="fas fa-user"></i></div>
                <div class="name text-center"><?php echo $row['names']; ?></div>
                <div class="send" id="<?php echo $row['pno']; ?>"><i class="fas fa-paper-plane"></i></div>
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
            $(".send").click(function(){
                $(this).empty();
                let pno = $(this).attr("id");
                let body = "REMINDER FROM SAI SWASTHYAM FITNESS CLUB - TO PAY THE FEES";
                sms(pno,body);
                $(this).append("<i class='fas fa-check-circle'></i>");
                $(this).css("background-color","rgb(75, 216, 75)");
                $(this).unbind();
            });

            function sms(pno,body){
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        return this.responseText;
                    }
                };
                xhttp.open("POST", "../php/sms.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("sms=1"+"&pno="+pno+"&body="+body);
            }

        });
    </script>
</body>
</html>