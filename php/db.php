<?php
    $connect = mysqli_connect('localhost','root','');
	$db = mysqli_select_db($connect,'gym');
	date_default_timezone_set("Asia/Kolkata");
	$date = date("Y-m-d");
	/*if($db)
		{
			echo "<br>db selected<br>";
		}
		else
		{
			echo "<br>db select error<br>";
		}
	*/

?>