<?php
include 'connection.php';

$user = $_POST['numeElev'];
$idClasa = $_SESSION['idClasa'];
$idCours=$_SESSION['idCours'];
$sql="SELECT users.id FROM users WHERE users.email=? OR users.utilizator=?;";
$stmt = $db->prepare($sql);
$stmt->bind_param("ss", $user, $user);
$stmt->execute();
$stmt->bind_result($idUser);
$stmt->fetch();
$stmt->close();
$repartizare="INSERT INTO repartizare(repartizare.id_user,repartizare.id_clasa) VALUES ('$idUser','$idClasa')";
mysqli_query($db, $repartizare);
$curs="INSERT INTO users_courses(users_courses.id_user,users_courses.id_cours) VALUES('$idUser','$idCours')";
mysqli_query($db, $curs);
echo "<script type='text/javascript'> document.location = 'create_classroom.html'; </script>";

?>