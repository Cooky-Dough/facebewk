<?php
include ("./database connection.php");
$sql = "select * from post";
$stmt = $db->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
var_dump($result);
echo json_encode($result);
?>