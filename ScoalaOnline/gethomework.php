<?php
include 'connection.php';
$option = $_GET['q'];


if ($option == "cursuri") {
    $sql = "SELECT  courses.Nume FROM ((users_courses INNER JOIN users ON users_courses.id_user=users.id)
INNER JOIN courses ON users_courses.id_cours=courses.id) WHERE users.id=?";
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
    echo "<select name='grades' 
onchange=\"window.location='homework.html?q='+this.value\">";
    echo "<option value=''>";
    echo 'Selecteaza materia';
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

    $sql = "SELECT teme.`data`,teme.data_limita,teme.titlu,teme.descriere,teme.id
FROM teme
INNER JOIN clase ON teme.id_clasa=clase.Id
INNER JOIN courses ON teme.id_curs=courses.id
INNER JOIN repartizare ON clase.Id=repartizare.id_clasa
WHERE courses.Nume=? AND repartizare.id_clasa=(SELECT repartizare.id_clasa FROM repartizare WHERE repartizare.id_user=?) AND repartizare.id_user=?
AND teme.`status`='undone'
";

    $id = $_SESSION['id'];
    $stmt = $db->prepare($sql);
    $stmt->bind_param("sss", $option, $id, $id);
    $stmt->execute();
    $meta = $stmt->result_metadata();
    while ($field = $meta->fetch_field()) {
        $params[] = &$row[$field->name];
    }

    call_user_func_array(array($stmt, 'bind_result'), $params);
    echo "<br>";
    echo "<table style='width:100%;'>";
    echo "<tr>";
    echo "<th>";
    echo 'Data adaugarii temei:';
    echo "</th>";
    echo "<th>";
    echo 'Data limita pentru tema';
    echo "</th>";
    echo "<th>";
    echo 'Titlu';
    echo "</th>";
    echo "<th>";
    echo 'Descriere';
    echo "</th>";
    echo "<th>";
    echo 'Upload';
    echo "</th>";
    $k = 0;
    while ($stmt->fetch()) {
        echo "<tr>";
        foreach ($row as $key => $val) {
            $c[$key] = $val;
            if ($k < 4) {
                echo "<td>";
                echo $val;
                echo "</td>";
                $k = $k + 1;
            } else {
                $k = 0;
                $id = $val;
            }

        }
        echo "</tr>";
        echo "<tr>";
        echo "<td>";
        echo "<form action=\"upload.php\" method=\"POST\" enctype=\"multipart/form-data\">";
        echo "<label for=\"myfile\">Select files:</label>";
        echo "<input type=\"file\" id=\"fileToUpload\" name=\"fileToUpload\" multiple>>";
        echo "<input type='hidden' id='custID' name='custID' value='$val'>";
        echo "<input type=\"submit\">";
        echo "</form>";
        echo "</td>";
        echo "<td>";
        echo "</td>";
        echo "</tr>";
        $result[] = $c;
    }


    $stmt->close();

}
?>

