<?php

include 'connection.php';
$username = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST["password2"];
$email = $_POST["email"];
$nume = $_POST["nume"];
$prenume = $_POST["prenume"];
$id_judet = $_POST["id_judet"];
$localitate = $_POST["localitate"];
$scoala = $_POST["scoala"];
$status = $_POST["status"];
$result1="SELECT email From users Where email=? Limit 1";
$stmt=$db->prepare($result1);
$stmt->bind_param("s",$email);
$stmt->execute();
$stmt->bind_result($email);
$stmt->store_result();
$rnum=$stmt->num_rows;

$result3="SELECT utilizator From users Where username=? Limit 1";
$stmt1=$db->prepare($result1);
$stmt1->bind_param("s",$username);
$stmt1->execute();
$stmt1->bind_result($username);
$stmt1->store_result();
$rnum1=$stmt1->num_rows;

if ($password != $password2){
    echo '<script language="javascript">';
    echo 'alert("Parolele introduse sunt diferite, incearca din nou.")';
    echo '</script>';
    redirect("signup.html");
}
else if($rnum!=0){
    echo '<script language="javascript">';
    echo 'alert("Exista deja un cont inregistrat cu acest email.")';
    echo '</script>';
    redirect("main.html");
}
else if($rnum1!=0){
    echo '<script language="javascript">';
    echo 'alert("Acest username este deja utilizat.")';
    echo '</script>';
    redirect("signup.html");
}
else {
    if($status=='e'){
        $redirect='student_main.html';
    }
    else{
        $redirect='teacher_main.html';
    }
    $query = "INSERT INTO users (utilizator,email,parola,tip_utilizator,redirect) VALUES ('$username','$email','$password','$status','$redirect')";
    mysqli_query($db, $query);
    $result = $db->query("SELECT id FROM users WHERE users.email='$email'");
    $row = $result->fetch_assoc();
    $id_user = $row["id"];
    $id_user = intval($id_user);

    $query1 = "INSERT INTO user_data (id_user,nume,prenume,judet,localitate,scoala) VALUES('$id_user','$nume','$prenume','$id_judet','$localitate','$scoala')";
    mysqli_query($db, $query1);
    redirect("main.html");
    $_SESSION['message'] = 'Contul a fost creat cu succes, acum te poti loga';

}



?>