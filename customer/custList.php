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
    <title>CUSTOMERS</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="../header/main.css">
    <style>
        .opBar{
            width: 100vw;
            min-height: 5vh;
            margin-top: 1vh;
            padding: 0 1.5rem 0 0;
            background-color: transparent;
            display: flex;
            flex-wrap: wrap;
            flex-direction: row;
            justify-content: flex-end;
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
            width: 5rem;
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

        @media only screen and (max-width: 600px){
            .search > div > input:focus,
            .search > div > input:not(:placeholder-shown) {
                width: 11rem;
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
        }
    </style>
</head>
<body>
    <main>
        <?php
            include("../php/db.php");
            include('../header/header.html');
            $query = "SELECT * FROM customer ORDER BY names";
            $result = mysqli_query($connect,$query);
        ?>
        <section class="opBar">
            <div class="search">
                <div>
                    <input type="text" id="search" placeholder="Search . . ." required>
                </div>
            </div>
        </section>
        <section class="list-container" data-aos="fade-right">
            <?php
                while($row = mysqli_fetch_array($result)){
                    $link = "window.location.href='custProfile.php?id=".$row['slNo']."'";
            ?>
            <div class="cust-container" onclick="<?php echo $link; ?>">
                <div class="avatar"><i class="fas fa-user"></i></div>
                <div class="name text-center"><?php echo $row['names']; ?></div>
                <div class="pno text-center"><?php echo $row['pno']; ?></div>
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
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".list-container .cust-container").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            $(".active").click(function(){
                $("#search").val("ACTIVE");
                $("#search").focus();
            });
            
        });


    </script>
</body>
</html>