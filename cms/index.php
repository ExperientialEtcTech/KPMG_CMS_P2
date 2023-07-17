<?php
session_start();
if(!isset($_SESSION['username']))
{
    header("Location : login.php");
    exit;
} else {
    header("Location : select_template.php");
    exit;
}
?>
<script>

</script>