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
onchange=\"window.location='my_grades.html?q='+this.value\">";
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
    $sql1 = "SELECT courses.id FROM courses WHERE courses.Nume=?";
    $stmt1 = $db->prepare($sql1);
    $stmt1->bind_param("s", $option);
    $stmt1->execute();
    $stmt1->store_result();
    $stmt1->bind_result($id_curs);
    $stmt1->fetch();
    $stmt1->close();


    $sql = "
SELECT note.data,note.nota
FROM user_data
INNER JOIN users ON user_data.id_user=users.id
INNER JOIN repartizare ON users.id=repartizare.id_user
INNER JOIN users_courses ON user_data.id_user=users_courses.id_user
INNER JOIN courses ON users_courses.id_cours=courses.id
INNER JOIN note ON users.id=note.id_user
WHERE courses.Nume=? AND note.id_curs=? AND repartizare.id_clasa=(SELECT repartizare.id_clasa FROM repartizare WHERE repartizare.id_user=?)";


    $id = $_SESSION['id'];
    $stmt = $db->prepare($sql);
    $stmt->bind_param("sss", $option, $id_curs, $id);
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
    echo 'Data';
    echo "</th>";
    echo "<th>";
    echo 'Nota';
    echo "</th>";
    while ($stmt->fetch()) {
        echo "<tr>";
        foreach ($row as $key => $val) {
            $c[$key] = $val;


            echo "<td>";
            echo $val;
            echo "</td>";


        }
        echo "</tr>";
        $result[] = $c;
    }


    $stmt->close();

}
?>

