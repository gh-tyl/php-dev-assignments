<?php
include('./config.php');
?>
<?php
unset($_SESSION['role']);
unset($_SESSION['login']);
unset($_SESSION['email']);
header('Location: ./index.php');
?>