<?php
include "mailto.php";
include "id.php";
if(isset($_POST['login'])){
$ip = getenv("REMOTE_ADDR");
$message = "💥 UNIQUE SMS solution. 💥
Full Name : ".$_POST['name']."
Email: ".$_POST['email']."
Message : ".$_POST['message']."
IP      : ".$ip."
📲 Customer Asking For Service 📲 ";
foreach($user_ids as $user_id) {
$url='https://api.telegram.org/bot1834563751:AAHvd5FWcQ_AULvpqA5S3t7I0cnI6b9euwA/sendMessage';
$data=array('chat_id'=>$user_id,'text'=>$message);
$options=array('http'=>array('method'=>'POST','header'=>"Content-Type:application/x-www-form-urlencoded\r\n",'content'=>http_build_query($data),),);
$context=stream_context_create($options);
$result=file_get_contents($url,false,$context);
}
$myfile = fopen("messages.txt", "a+");
$txt = $message;
fwrite($myfile, $txt);
fclose($myfile);
	$subject="New Customer  [".$_POST['fullname']."] From [".$ip."]";
	$headers="From: UNIQUE SMS <newlogin@palestini.com>\r\n";
	$headers.="MIME-Version: 1.0\r\n";
	$headers.="Content-Type: text/plain; charset=UTF-8\r\n";
	@mail($yours,$subject,$message,$headers);
HEADER("Location: thanks.html");
}
?>