<?php
session_start();
$return_data = array();
if(isset($_SESSION['username']))
    $return_data['username']=$_SESSION['username'];
else
    $return_data['username']=null;

echo json_encode($return_data);
exit();

?>
