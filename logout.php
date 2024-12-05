<?php
session_start();
session_destroy();
header("Location: shopping_center.php");
?>