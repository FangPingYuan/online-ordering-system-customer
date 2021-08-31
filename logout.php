<?php
session_start();
unset($_SESSION['e_mail']);
unset($_SESSION['shop']);
session_destroy();
?>
