<?php
include 'connection.php';
//print
$query2 = ("SELECT chat.`from`,chat.message,chat.created FROM chat WHERE chat.id_clasa=(SELECT chat.id_clasa FROM chat WHERE chat.id_user=?);");
$stmt = $db->prepare($query2);
$stmt->bind_param("s", $id);
$stmt->execute();
$meta1 = $stmt->result_metadata();
while ($field1 = $meta1->fetch_field()) {
    echo "<div class='msg'>";
    echo "<p>";
    echo "$field1->from";
    echo "</p>";
    echo "$field1->message";
    echo "</div>";
}


$stmt->close();
?>