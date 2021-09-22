<?php
include 'connection.php';
$option = $_GET['q'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['submit'])) {
    $numele = $_POST['numele'];
    $prenumele = $_POST['prenumele'];
    $judetul = $_POST['judetul'];
    $localitatea = $_POST['localitatea'];
    $scoala1 = $_POST['scoala1'];
    $sql1 = "UPDATE user_data SET user_data.nume='$numele', user_data.prenume='$prenumele', 
user_data.judet='$judetul', user_data.localitate='$localitatea', user_data.scoala='$scoala1' 
WHERE user_data.id_user = ?";
    $id = $_SESSION['id'];
    $stmt = $db->prepare($sql1);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->close();
    echo '<script language="javascript">';
    echo 'alert("Datele au fost modificate cu succes!")';
    echo '</script>';
    redirect('my_profile.html');
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['submit1'])) {
    $passw = $_SESSION['password'];
    $oldpass = $_POST['oldpass'];
    $newpass = $_POST['newpass'];
    $newpass1 = $_POST['newpass1'];
    if ($newpass != $newpass1) {
        echo '<script language="javascript">';
        echo 'alert("Parolele nu corespund!")';
        echo '</script>';
        redirect('my_profile.html');
    } elseif ($oldpass != $passw) {
        echo '<script language="javascript">';
        echo 'alert("Parola veche a fost introdus gresit!")';
        echo '</script>';
        redirect('my_profile.html');
    } else {
        $sql3 = "UPDATE users SET users.parola='$newpass' WHERE users.id = ?";
        $id = $_SESSION['id'];
        $stmt = $db->prepare($sql3);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->close();
        echo '<script language="javascript">';
        echo 'alert("Parola a fost schimbata!")';
        echo '</script>';
        redirect('my_profile.html');
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['submit2'])) {
    $newemail = $_POST['newemail'];
    $sql3 = "UPDATE users SET users.email='$newemail' WHERE users.id = ?";
    $id = $_SESSION['id'];
    $stmt = $db->prepare($sql3);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->close();
    echo '<script language="javascript">';
    echo 'alert("Emailul a fost schimbat!")';
    echo '</script>';
    redirect('my_profile.html');
}

if ($option == "DatePersonale") {
    $sql = "SELECT user_data.nume, user_data.prenume, user_data.judet, user_data.localitate, user_data.scoala
FROM user_data WHERE user_data.id_user = ?";
    $id = $_SESSION['id'];
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($nume, $prenume, $judet, $localitate, $scoala);
    $stmt->fetch();
    $stmt->close();

    echo "<form method=\"POST\" action='getcustomer.php'>";
    echo "<label>";
    echo 'Nume &nbsp';
    echo "</label>";
    echo "<br>";
    echo "<input name='numele' value='$nume' >";
    echo "</input>";

    echo "<br>";
    echo "<label>";
    echo 'Prenume &nbsp';
    echo "</label>";
    echo "<br>";
    echo "<input name='prenumele' value='$prenume' >";
    echo "</input>";

    echo "<br>";
    echo "<label>";
    echo 'Judet &nbsp';
    echo "</label>";
    echo "<br>";
    echo "<input name='judetul' value='$judet' >";
    echo "</input>";

    echo "<br>";
    echo "<label>";
    echo 'Localitate &nbsp';
    echo "</label>";
    echo "<br>";
    echo "<input name='localitatea' value='$localitate' >";
    echo "</input>";

    echo "<br>";
    echo "<label>";
    echo 'Scoala &nbsp';
    echo "</label>";
    echo "<br>";
    echo "<input name='scoala1' value='$scoala' >";
    echo "</input>";

    echo "<br>";
    echo "<br>";
    echo "<button type='submit' name='submit' class='btn btn-primary' style=\"width:130px;background-color: #007bff80; border-color: #0b2e13\">";
    echo 'Submit';
    echo "</button>";
    echo "</form>";


} elseif ($option == "Parola") {
    echo "<form method=\"POST\" action='getcustomer.php'>";

    echo "<br>";
    echo "<label>";
    echo 'Parola veche &nbsp';
    echo "</label>";
    echo "<br>";
    echo "<input type='password' name='oldpass'>";
    echo "</input>";

    echo "<br>";
    echo "<label>";
    echo 'Parola noua &nbsp';
    echo "</label>";
    echo "<br>";
    echo "<input type='password' name='newpass'>";
    echo "</input>";

    echo "<br>";
    echo "<label>";
    echo 'Repeta parola noua &nbsp';
    echo "</label>";
    echo "<br>";
    echo "<input type='password' name='newpass1'>";
    echo "</input>";

    echo "<br>";
    echo "<br>";
    echo "<button type='submit' name='submit1' class='btn btn-primary' style=\"width:130px;background-color: #007bff80; border-color: #0b2e13\">";
    echo 'Submit';
    echo "</button>";
    echo "</form>";
} elseif ($option = "Email") {
    $sql2 = "SELECT users.email FROM users WHERE users.id = ?";
    $id = $_SESSION['id'];
    $stmt = $db->prepare($sql2);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($email);
    $stmt->fetch();
    $stmt->close();

    echo "<form method=\"POST\" action='getcustomer.php'>";

    echo "<br>";
    echo "<label>";
    echo 'Editeaza adresa de email &nbsp';
    echo "</label>";
    echo "<br>";
    echo "<input type='email' value='$email' name='newemail'>";
    echo "</input>";


    echo "<br>";
    echo "<br>";
    echo "<button type='submit' name='submit2' class='btn btn-primary' style=\"width:130px;background-color: #007bff80; border-color: #0b2e13\">";
    echo 'Submit';
    echo "</button>";
    echo "</form>";


    $sql2 = "DELETE users.clasa FROM users WHERE clasa.id = $idClasa";

}
?>

