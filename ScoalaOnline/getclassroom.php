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
    echo "<select name='classroom' 
onchange=\"window.location='my_classroom.html?q='+this.value\">";
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
    $sql = "
SELECT user_data.nume,user_data.prenume,users.tip_utilizator
FROM user_data
INNER JOIN users ON user_data.id_user=users.id
INNER JOIN repartizare ON users.id=repartizare.id_user
INNER JOIN users_courses ON user_data.id_user=users_courses.id_user
INNER JOIN courses ON users_courses.id_cours=courses.id
WHERE courses.Nume=? AND repartizare.id_clasa=(SELECT repartizare.id_clasa FROM repartizare WHERE repartizare.id_user=?)";


    $id = $_SESSION['id'];
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ss", $option, $id);
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
    echo 'Nume';
    echo "</th>";
    echo "<th>";
    echo 'Prenume';
    echo "</th>";
    echo "<th>";
    echo 'Status';
    echo "</th>";
    while ($stmt->fetch()) {
        echo "<tr>";
        foreach ($row as $key => $val) {
            $c[$key] = $val;


            echo "<td>";
            if($val=='e')
                echo 'elev';
            elseif ($val=='p')
                echo 'profesor';
            else
                echo $val;
            echo "</td>";



        }
        echo "</tr>";
        $result[] = $c;
    }


    $stmt->close();

}
?>

