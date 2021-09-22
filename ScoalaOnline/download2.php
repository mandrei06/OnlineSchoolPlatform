<?php
include 'connection.php';
$fileId = $_POST['custID1'];
$sql = "SELECT user_homework.`file` FROM user_homework WHERE user_homework.id=?;";
$stmt = $db->prepare($sql);
$stmt->bind_param("s", $fileId);
$stmt->execute();
$stmt->bind_result($file);
$stmt->fetch();
$file = 'uploads/' . $file;

$file_extension = end(explode('.', $file));
$file_name = end(explode('/', $file));
switch ($file_extension) {
    case 'jpg':
        header('Content-Type: image/jpeg');
        header('Content-Disposition: attachment; filename=' . $file_name);
        header('Pragma: no-cache');
        readfile($file);
        break;
    case 'png':
        header('Content-Type: image/png');
        header('Content-Disposition: attachment; filename=' . $file_name);
        header('Pragma: no-cache');
        readfile($file);
        break;
    case 'pdf':
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename=' . $file_name);
        header('Pragma: no-cache');
        readfile($file);
        break;
}

?>