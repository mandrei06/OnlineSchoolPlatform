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
onchange=\"window.location='chat1.html?q='+this.value\">";
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



    $stmt->close();


} elseif ($option != null) {

    $sql2 = "SELECT clase.id,clase.Id_Materie
FROM user_data
INNER JOIN users ON user_data.id_user=users.id
INNER JOIN repartizare ON users.id=repartizare.id_user
INNER JOIN clase ON repartizare.id_clasa=clase.Id
WHERE clase.Nume=? AND repartizare.id_clasa=(SELECT repartizare.id_clasa FROM repartizare WHERE repartizare.id_user=? &&
 repartizare.id_clasa=(SELECT clase.Id WHERE clase.Id_Profesor=?&& clase.Nume=?))";
    $id = $_SESSION['id'];
    $stmt = $db->prepare($sql2);
    $stmt->bind_param("ssss", $option, $id, $id, $option);
    $stmt->execute();
    $stmt->bind_result($idClasa, $idCours);
    $stmt->fetch();
    $stmt->close();
    $_SESSION['idClasa1'] = $idClasa;
    $_SESSION['idCours1'] = $idCours;


    $query2 = ("SELECT chat.`from`,chat.message,chat.created FROM chat WHERE chat.id_clasa=(SELECT chat.id_clasa FROM chat WHERE chat.id_user=? LIMIT 1);");
    $stmt1 = $db->prepare($query2);
    $stmt1->bind_param("s", $id);
    $stmt1->execute();
    $meta = $stmt1->result_metadata();
    while ($field = $meta->fetch_field()) {
        $params[] = &$row[$field->name];
    }


    call_user_func_array(array($stmt1, 'bind_result'), $params);
    echo "<br>";
    echo "<table style='width:100%;'>";
    echo "<tr>";
    echo "<th>";
    echo 'Utilizator:';
    echo "</th>";
    echo "<th>";
    echo 'Mesaj';
    echo "</th>";
    echo "<th>";
    echo 'Data';
    echo "</th>";
    while ($stmt1->fetch()) {
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

    echo "</table>";

    $stmt1->close();
    echo "<br>";
    echo "<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#exampleModal2\">";
    echo "Trimite o intrebare.";
    echo "</button>";

}
?>

