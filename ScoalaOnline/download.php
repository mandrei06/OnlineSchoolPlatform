<?php
if ($handle = opendir('uploads/')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            if ($_POST["custID1"]) {
                include 'connection.php';
                $fileId = $_POST['custID1'];

                $sql="SELECT user_homework.`file` FROM user_homework WHERE user_homework.id=?;";
                $stmt = $db->prepare($sql);
                $stmt->bind_param("s", $fileId);
                $stmt->execute();
                $stmt->bind_result($file);
                $stmt->fetch();
                $file = 'uploads/' . $file;

                if (!file_exists($file)) { // file does not exist
                    die('file not found');
                } else {
                    header("Cache-Control: public");
                    header("Content-Description: File Transfer");
                    header("Content-Disposition: attachment; filename=$file");
                    header("Content-Type: image/jpg");
                    header("Content-Transfer-Encoding: binary");

                    // read the file from disk
                    readfile($file);
                }
                echo "<script type='text/javascript'> document.location = 'seeHomeworks.html'; </script>";

            }
        }
    }
    closedir($handle);
}
?>