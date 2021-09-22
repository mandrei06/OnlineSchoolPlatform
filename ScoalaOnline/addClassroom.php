<?php
include 'connection.php';
$classroomName = $_POST['numeClasa'];
$subject=$_POST['numeMaterie'];
$id = $_SESSION['id'];


$query1 = "INSERT INTO courses (courses.Nume,courses.Id_Profesor) VALUES ('$subject','$id')";
mysqli_query($db, $query1);


$query3="SELECT id FROM courses WHERE courses.Id_Profesor=? ORDER BY id DESC";
$stmt = $db->prepare($query3);
$stmt->bind_param("s", $id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($idCours);
$stmt->fetch();
$stmt->close();

$query = "INSERT INTO clase (clase.Nume, clase.Id_Profesor,clase.Id_Materie) VALUES ('$classroomName','$id','$idCours')";
mysqli_query($db, $query);


$query4 = "INSERT INTO users_courses (users_courses.id_user,users_courses.id_cours) VALUES ('$id',$idCours)";
mysqli_query($db, $query4);
$query5="SELECT id FROM clase WHERE clase.Id_Profesor=? ORDER BY id DESC";
$stmt = $db->prepare($query5);
$stmt->bind_param("s", $id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($idClasa);
$stmt->fetch();
$stmt->close();
$query6 = "INSERT INTO repartizare (repartizare.id_user,repartizare.id_clasa) VALUES ('$id',$idClasa)";
mysqli_query($db, $query6);

echo "<script>";
echo "window.alert('Clasa a fost adaugata!')";
echo "</script>";
echo "<script type='text/javascript'> document.location = 'create_classroom.html'; </script>";

?>