<?php
    session_start();
    if($_SESSION['is_login'] == false) {
        header('location:../../../auth/login.php');
        exit(); 
        }
        require_once dirname(__DIR__) . '../../../database/db.php'; 
        
    if(isset($_GET['id'])) {
        $id_kategori = $_GET['id'];
        
    }
?>

