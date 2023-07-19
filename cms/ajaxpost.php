<?php require_once('config.php');
$allData = $_POST['allData'];
print_r($allData);
$i = 1;
foreach ($allData as $key => $value) {
    $sql = "UPDATE IdleStateKaleidoscope SET VideoOrder =".$i." WHERE id=".$value;
    $conn->query($sql);
    $i++;
}

?>


