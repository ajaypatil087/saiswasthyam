<?php
function sms($to,$msg){
    $api_key = '45F4E7592348BD';
    $contacts = $to;
    $from = 'SAISTL';
    $sms_text = urlencode($msg);

    //Submit to server
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, "http://webmsg.smsbharti.com/app/smsapi/index.php");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "key=".$api_key."&campaign=0&routeid=35&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text);
    $response = curl_exec($ch);
    curl_close($ch);
    echo $response;
}
if(isset($_POST['sms'])){
    $to = $_POST['pno'];
    $msg = $_POST['body'];
    sms($to,$msg);
}
?>