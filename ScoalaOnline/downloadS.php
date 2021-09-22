<?php
if ($handle = opendir('uploads/')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            echo "<a href='downloadS1.php?file=".$entry."'>".$entry."</a>\n";
        }
    }
    closedir($handle);
}
?>