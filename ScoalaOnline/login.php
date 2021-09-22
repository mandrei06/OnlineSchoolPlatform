<?php
include 'connection.php';
$user = $_POST['user'];
$parola = $_POST['parola'];

session_start();

$result = $db->query("SELECT * From users Where (email='$user' OR utilizator='$user') AND parola='$parola'  Limit 1");
$rnum1 = $result->num_rows;
$row = $result->fetch_assoc();
$redirect = $row["redirect"];
$id = $row['id'];
if ($rnum1 != 0) {
    $_SESSION['username'] = $user;
    $_SESSION['password'] = $parola;
    $_SESSION['id'] = $id;
    redirect("$redirect");
} else{
    echo "<script>";
    echo "window.alert('Nume sau parola gresita')";
    echo "</script>";
    echo "<script type='text/javascript'> document.location = 'main.html'; </script>";

}

?>
