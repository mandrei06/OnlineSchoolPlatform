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
onchange=\"window.location='addHomework.html?q='+this.value\">";
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
    echo "<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#exampleModal1\">";
    echo "Adauga teme in aceasta clasă";
    echo "</button>";


}
?>

