<?php
header('Content-Type: application/octet-stream');
header('Content-Transfer-Encoding: binary');
$movie = "movies/".$_GET['movie'];
header('Content-Length: ' . filesize($movie));
readfile($movie);
exit;

?>