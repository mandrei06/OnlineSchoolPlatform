<?php
if ($_POST["custID"]) {
    include 'connection.php';
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

// Check if file already exists
//if (file_exists($target_file)) {
//    echo "<script>";
//    echo "window.alert(\"Acest fișier exista in baza de date!\")";
//    echo "</script>";
//    $uploadOk = 0;
//}

// Check file size
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "<script>";
        echo "window.alert(\"Fișierul depășește mărimea permisă(5000kb)!\")";
        echo "</script>";
        $uploadOk = 0;
    }

// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "<script>";
        echo "window.alert(\"Scuze, sunt acceptate doar fișiere de tip JPG, JPEG, PNG & GIF!\")";
        echo "</script>";
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<script>";
        echo "window.alert(\"Fișierul tău NU s-a încărcat!\")";
        echo "</script>";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

            echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
            $idT = $_POST['custID'];
            echo $idT;
            $id = $_SESSION['id'];
            $sql = "UPDATE teme SET teme.`status`='done' WHERE teme.id=?;";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("s", $idT);
            $stmt->execute();
            $stmt->close();

            $sql2 = "INSERT INTO user_homework (user_homework.id_tema,user_homework.id_user,user_homework.`file`)
VALUES (?,?,?);";
            $stmt = $db->prepare($sql2);
            $stmt->bind_param("sss", $idT,$id,basename($_FILES["fileToUpload"]["name"]) );
            $stmt->execute();
            $stmt->close();
            echo "<script>";
            echo "window.alert(\"Tema a fost încărcată cu succes!\")";
            echo "</script>";
        } else {
            echo "<script>";
            echo "window.alert(\"Eroare la încărcarea temei!\")";
            echo "</script>";
        }
    }
    echo "<script type='text/javascript'> document.location = 'homework.html'; </script>";

} else {
    echo "<script>";
    echo "window.alert(\"Eroare de script!\")";
    echo "</script>";
    echo "<script type='text/javascript'> document.location = 'homework.html'; </script>";

}
?>