<?php
session_start();;
$connection=new mysqli('localhost','root',"",'allphptricks');
if($connection){
    echo "";
}else{
    echo "error".mysqli_connect_error();
}
?>