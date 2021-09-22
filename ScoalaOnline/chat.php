<?php
include 'connection.php';

$result = array();
$message = isset($_POST['message']) ? $_POST['message'] : null;
$sql1 = "SELECT user_data.nume,user_data.prenume FROM user_data WHERE user_data.id_user=?";
$id = $_SESSION['id'];
$id_clasa = $_SESSION['idClasa1'];
$id_curs = $_SESSION['idCours1'];
$stmt1 = $db->prepare($sql1);
$stmt1->bind_param("s", $id);
$stmt1->execute();
$stmt1->bind_result($nume, $prenume);
$stmt1->fetch();
$stmt1->close();
$from = $nume . " " . $prenume;


$query = "INSERT INTO chat (chat.message,chat.`from`,chat.id_user,chat.id_clasa,chat.id_curs) VALUES ('$message','$from','$id','$id_clasa','$id_curs');";
mysqli_query($db, $query);
echo "<script>";
echo "window.alert('Mesajul a fost adăugat!')";
echo "</script>";
echo "<script type='text/javascript'> document.location = 'chat1.html'; </script>";


?>