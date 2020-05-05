<?php
$con = mysqli_connect("localhost","root","","payment");
if(mysqli_connect_errno()){
print_alert('error', 'failed to connect to mysql');
die();
}
?>