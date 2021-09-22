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
onchange=\"window.location='catalog.html?q='+this.value\">";
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

    $sql2 = "
SELECT user_data.id,user_data.nume,user_data.prenume,courses.Nume,note.nota,note.`data`
FROM note
INNER JOIN user_data ON note.id_user=user_data.id_user
INNER JOIN courses ON note.id_curs=courses.id
INNER JOIN clase ON courses.id=clase.Id_Materie
WHERE clase.Nume=? AND clase.Id_Profesor=? ORDER BY user_data.nume,user_data.prenume DESC,courses.Nume,note.nota,note.`data`";
    $id = $_SESSION['id'];
    $stmt1 = $db->prepare($sql2);
    $stmt1->bind_param("ss", $option, $id);
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
    echo 'Materie';
    echo "</th>";
    echo "<th>";
    echo 'Notă:';
    echo "</th>";
    echo "<th>";
    echo 'Data:';
    echo "</th>";
    echo "</tr>";
    $counter = -1;
    $idStudent = -1;
    $previous=-1;
    $ok=-1;
    while ($stmt1->fetch()) {
        echo "<tr>";
        $counter_name = 0;
        foreach ($row1 as $key1 => $val1) {
            $c[$key1] = $val1;
            if ($counter <= 2 && $counter >= 0) {
                $counter += 1;
                $counter_name = 3;
                goto end;
            }
            if ($val1 == $idStudent && $counter_name < 3) {
                echo "<td>";
                echo "</td>";
                echo "<td>";
                echo "</td>";
                $ok=1;
                $counter = 1;
                goto end;
            } elseif ($counter_name != 0) {
                if ($ok==1 && $counter_name == 3 && $previous == $val1) {
                    $counter_name += 1;
                    echo "<td>";
                    echo "</td>";
                    $ok=2;
                    goto end;
                }
                if ($counter_name == 3) {
                    $previous = $val1;
                }
                echo "<td>";
                echo $val1;
                echo "</td>";
                $counter_name += 1;
            } else {
                $idStudent = $val1;
                $counter_name += 1;
            }
            end:;
        }
        echo "</tr>";
        $result[] = $c;

    }
    echo "</table>";


    $stmt1->close();


}
if (isset($_POST["nota"])) {
    $nota = $_POST['nota'];
    $id12 = $_POST['id1'];
    $sql10 = "SELECT user_homework.id_tema,user_homework.id_user FROM user_homework WHERE user_homework.id=?;";
    $stmt = $db->prepare($sql10);
    $stmt->bind_param("s", $id12);
    $stmt->execute();
    $stmt->bind_result($idTema, $idUser);
    $stmt->fetch();
    $stmt->close();

    $sql11 = "SELECT teme.id_curs FROM teme WHERE teme.id=?;";
    $stmt = $db->prepare($sql11);
    $stmt->bind_param("s", $idTema);
    $stmt->execute();
    $stmt->bind_result($idCours);
    $stmt->fetch();
    $stmt->close();

    $querry = "INSERT INTO note(note.DATA,note.id_user,note.id_curs,note.id_tema,note.nota) VALUES(CURRENT_DATE(),$idUser,'$idCours',$idTema,'$nota');";
    mysqli_query($db, $querry);
    $querry1 = "UPDATE teme SET teme.`status`=\"done\" WHERE teme.id='$idTema'";
    mysqli_query($db, $querry1);

    echo "<script>";
    echo "window.alert('Tema a fost notată!')";
    echo "</script>";
    echo "<script type='text/javascript'> document.location = 'catalog.html'; </script>";


}
?>

