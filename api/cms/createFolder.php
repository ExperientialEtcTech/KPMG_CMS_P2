<?php
$data=json_decode(file_get_contents('php://input'), true);

$folder=$data['filePath']."\\".$data['addfoldername'];
if (!file_exists($folder)) {
    echo "Folder Created";
    mkdir($folder);
} else {
    echo "Folder Exists";
}
?>
