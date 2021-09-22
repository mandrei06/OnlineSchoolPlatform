<?php
include 'connection.php';
$option = $_GET['q'];

if ($option == "cursuri") {
    $sql = "SELECT  clase.Nume FROM ((repartizare INNER JOIN users ON repartizare.id_user=users.id)
INNER JOIN clase ON repartizare.id_clasa=clase.id) WHERE users.id=?";
    $id = $_SESSION['id'];
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $meta = $stmt->result_metadata();
    while ($field = $meta->fetch_field()) {
        $params[] = &$row[$field->name];
    }

    call_user_func_array(array($stmt, 'bind_result'), $params);
    echo "<br>";
    echo "<select name='classroom' 
onchange=\"window.location='seeHomeworks.html?q='+this.value\">";
    echo "<option value=''>";
    echo 'Selectează clasa';
    while ($stmt->fetch()) {
        foreach ($row as $key => $val) {
            $c[$key] = $val;

            echo "</option>";
            echo "<option value='$val'>";
            echo $val;
            echo "</option>";


        }

        $result[] = $c;
    }

    echo "</select>";
    echo "<div size=\"50px\" id=\"txtHint\">";
    echo "</div>";

    $stmt->close();


} else {

    $sql2 = "SELECT user_data.`nume`,user_data.prenume,teme.titlu,user_homework.`file`,user_homework.id
FROM user_homework
INNER JOIN teme ON user_homework.id_tema=teme.id
INNER JOIN clase ON teme.id_clasa=clase.Id
INNER JOIN user_data ON user_homework.id_user=user_data.id_user
WHERE teme.id_clasa=(SELECT clase.Id WHERE clase.Id_Profesor=?&& clase.Nume=?);";//aici adaugi sa fie teme.status='undone' sa afisezi doar temele nefacute si eventual creezi o arhiva

    $id = $_SESSION['id'];
    $stmt1 = $db->prepare($sql2);
    $stmt1->bind_param("ss", $id, $option);
    $stmt1->execute();
    $meta1 = $stmt1->result_metadata();
    while ($field1 = $meta1->fetch_field()) {
        $params1[] = &$row1[$field1->name];
    }

    call_user_func_array(array($stmt1, 'bind_result'), $params1);
    echo "<br>";
    echo "<table style='width:100%;'>";
    echo "<tr>";
    echo "<th>";
    echo 'Nume:';
    echo "</th>";
    echo "<th>";
    echo 'Prenume';
    echo "</th>";
    echo "<th>";
    echo 'Titlu';
    echo "</th>";
    echo "<th>";
    echo 'Download';
    echo "</th>";
    echo "<th>";
    echo 'Acordati o nota';
    echo "</th>";
    echo "</tr>";
    $k = 0;
    $j = 0;
    while ($stmt1->fetch()) {
        echo "<tr>";
        foreach ($row1 as $key1 => $val1) {
            $c[$key1] = $val1;
            if ($k < 3) {
                echo "<td>";
                echo $val1;
                echo "</td>";
                $k = $k + 1;
            } else {
                $j = $j + 1;
                if ($j == 2)
                    $k = 0;
                if ($j == 1)
                    $nume1 = $val1;
                if ($j == 2) {
                    $id1 = $val1;
                    $j = 0;
                }
            }

        }
        echo "<td>";
        echo "<a href='http://localhost/ScoalaOnline/uploads/$nume1' target=\"_blank\">";
        echo "Download";
        echo "</a>";
        echo "</td>";
        echo "<td>";
        echo "<form method='post' action='getClassroomsForG.php'>";
        echo "<input type=\"text\" id=\"nota\" name=\"nota\" >";
        echo "<input type='hidden' id='id1' name='id1' value='$id1'>";
        echo "<button type=\"submit\">";
        echo "Notează";
        echo "</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
        $result[] = $c;

    }
    echo "</table>";


    $stmt1->close();



}
if (isset($_POST["nota"])) {
    $nota=$_POST['nota'];
    $id12=$_POST['id1'];
    $sql10="SELECT user_homework.id_tema,user_homework.id_user FROM user_homework WHERE user_homework.id=?;";
    $stmt = $db->prepare($sql10);
    $stmt->bind_param("s",$id12);
    $stmt->execute();
    $stmt->bind_result($idTema,$idUser);
    $stmt->fetch();
    $stmt->close();

    $sql11="SELECT teme.id_curs FROM teme WHERE teme.id=?;";
    $stmt = $db->prepare($sql11);
    $stmt->bind_param("s",$idTema);
    $stmt->execute();
    $stmt->bind_result($idCours);
    $stmt->fetch();
    $stmt->close();

    $querry="INSERT INTO note(note.DATA,note.id_user,note.id_curs,note.id_tema,note.nota) VALUES(CURRENT_DATE(),$idUser,'$idCours',$idTema,'$nota');";
    mysqli_query($db, $querry);
    $querry1="UPDATE teme SET teme.`status`=\"done\" WHERE teme.id='$idTema'";
    mysqli_query($db, $querry1);

    echo "<script>";
    echo "window.alert('Tema a fost notata!' )";
    echo "</script>";
    echo "<script type='text/javascript'> document.location = 'seeHomeworks.html'; </script>";


}
?>

