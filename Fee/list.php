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
    <title>FEE</title>
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
        

        .btns{
            width: 10rem;
            padding: 0;
            margin: 0;
            height: 5vh;
            font-size: 1rem;
        }
        .list-container{
            height: 83vh;
            width: 100vw;
            padding: 3vh 10px;
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
            cursor: pointer;
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

        .cust-container:hover{
            border: 2px solid white;
        }

        .cust-container .hidden{
            display: none;
        }

        .form-container{
            display: none;
            z-index: 1;
            transition: all .5s ease-in-out;
        }


        .formOuter{
            width: 100vw;
            height: 89vh;
            top: 11vh;
            z-index: 2;
            position: absolute;
            display: flex;
            justify-content: center;
            align-items: center;  
            background-color: rgba(255,255,255,.5); 
        }

        .formInner{
            width: 40vw;
            height: 45vh;
            border-radius: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            box-shadow: 0 4px 8px 5px rgba(0, 0, 0, 0.2), 0 6px 20px 5px rgba(0, 0, 0, 0.19);
            background-color: rgb(71, 71, 70);
        }

        .closeBtn{
            height: auto;
            color: red;
            font-size: 3rem;
            font-weight: bold;
            cursor: pointer;
            position: absolute;
            top: 24%;
            right: 32%;
        }
        .closeBtn:hover{
            text-shadow: 2px 2px 2px black;
        }

        .formInner .name{
            padding-bottom: 2rem;
            font-size: 1.5rem;
            text-shadow: 2px 2px 5px black, -2px -2px 5px black;
            font-style: italic;
        }

        .input-container{
            width: 65%;
        }
        .input-container input[type=date]{
            width: 100%;
        }

        .formInner .paid{
            width: 7rem;
        }

        @media only screen and (max-width: 600px){
            .opBar{
                padding: 0 .7rem 0 .5rem;
            }
            .btns{
                width: 7.5rem;
                font-size: .8rem;
            }
            .search > div > input:focus,
            .search > div > input:not(:placeholder-shown) {
                width: 9rem;
            }
            .list-container{
                padding: 15px 3px;
            }
            .cust-container .avatar{
                width: 10%;
            }
            .cust-container .name{
                width: 59%;
            }

            .cust-container .pno{
                width: 31%;
            }

            .formInner{
                width: 85vw;
            }

            .closeBtn{
                right: 12%;
            }
        }
    </style>
</head>
<body>
    <main>
        <?php
            include("../php/db.php");
            include('../header/header.html');
            $start = date("Y-m-d", strtotime("first day of this month"));
            $end = date("Y-m-d", strtotime("last day of this month"));
            $query = "SELECT * FROM customer WHERE status='ACTIVE' AND customer.slNo 
            NOT IN(SELECT fees.slNo FROM fees WHERE fees.dates >= '$start' AND fees.dates <= '$end') ORDER BY customer.names";
            $result = mysqli_query($connect,$query);
        ?>
        <section class="opBar">
            <div>
                <button class="myBtn btns" onclick="window.location.href='feeReminder.php'">REMINDER <i class="fas fa-stopwatch"></i></button>
            </div>
            <div>
                <button class="myBtn btns" onclick="window.location.href='feesHistory.php'">REGISTER <i class="fas fa-list"></i></button>
            </div>
            <div class="search">
                <div>
                    <input type="text" id="search" placeholder="Search . . ." required>
                </div>
            </div>
        </section>
        <section class="loader">
            <div class="loading">
                <img src="../images/bar.png" alt="loading.."></br>
                <div>LOADING..</div>
            </div>
        </section>
        <div class="form-container">
            <section class="formOuter">
                <div class="formInner">
                    <div class="closeBtn text-danger">&times;</div>
                    <div class="text-light font-weight-bold name"></div>
                    <div class="input-container">
                        <input type="number" id="amount" required/>
                        <label>AMOUNT ₹</label>
                    </div>
                    <div class="input-container">
                        <input type="date" id="date" required />
                        <label class="myLabel">DATE</label>
                    </div>
                    <div><button class="myBtn paid">PAID</button></div>
                </div>
            </section>
        </div>
        <section class="list-container" data-aos="fade-right">
            <?php
                while($row = mysqli_fetch_array($result)){
                    $id = $row['slNo'];
            ?>
            <div class="cust-container" id="<?php echo $id; ?>">
                <div class="avatar"><i class="fas fa-user"></i></div>
                <div class="name text-center"><?php echo $row['names']; ?></div>
                <div class="pno text-center"><?php echo $row['pno']; ?></div>
                <div class="hidden slNo"><?php echo $row['slNo']; ?></div>
                <div class="hidden"><?php echo $row['bGrp']; ?></div>
                <div class="hidden"><?php echo $row['GENDER']; ?></div>
                <div class="hidden"><?php echo $row['status']; ?></div>
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
            var slNo,name;
            $(".cust-container").click(function(){
                $(".form-container").show();
                slNo = $(this).attr("id");
                let id = "#"+slNo;
                name = $(id+" .name").text();
                $(".formInner .name").text(name);
            });

            $(".closeBtn").click(function(){
                $(".form-container").hide();
            });

            $(".paid").click(function(){
                let amount = $("#amount").val();
                $("#amount").val("");
                let date = $("#date").val();
                if(amount === "" || date === ""){
                    alert("Fill the fields!");
                    return;
                }
                else if(amount<=0){
                    alert("Amount cannot be less then or equal to Zero");
                    return;
                }
                else{
                    paid(amount,date);
                    $(".form-container").hide();
                    $("#"+slNo).hide();
                }
            });

            function paid(amt,date) {
                loadStart();
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        loadStop();
                        if(this.responseText==1){
                            alert(name+" HAS PAID "+amt);
                        }
                        else{
                            alert("There was some error! Please try again.");
                        }
                    }
                };
                xhttp.open("POST", "paid.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("id="+slNo+"&amt="+amt+"&date="+date);
            }

            function loadStart(){
                $(".loader").css("display","flex");
            }

            function loadStop(){
                $(".loader").css("display","none");
            }

            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".list-container .cust-container").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

    </script>
</body>
</html>