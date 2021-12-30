<?php
session_start();
if (!isset($_SESSION['stud_id'])) { 
    header('Location: login.php'); 
}

?>