<?php
include 'connection.php';
$idClasa = $_SESSION['idClasa1'];
$idCours = $_SESSION['idCours1'];
$idDataCurenta = date("Y-m-d");
$idDataLimita = date('Y-m-d', strtotime($_POST['deadline']));
$status = 'undone';
$nume = $_POST['titlu'];
$descriere = $_POST['description'];


$query1 = "INSERT INTO teme (teme.id_clasa,teme.id_curs,teme.data,teme.data_limita,teme.status,teme.titlu,teme.descriere)
 VALUES ('$idClasa','$idCours','$idDataCurenta','$idDataLimita','$status','$nume','$descriere')";
mysqli_query($db, $query1);
echo "<script>";
echo "window.alert('Tema a fost adaugată!')";
echo "</script>";

echo "<script type='text/javascript'> document.location = 'addHomework.html'; </script>";


?>