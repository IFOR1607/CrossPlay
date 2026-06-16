<?php 
    session_start();
    ob_start();
    if(!isset($_SESSION['is_login']) || $_SESSION['is_login'] !== true) {
        header('Location:../auth/login.php ');
        exit();
    }
?>

<link rel="stylesheet" href="../css/dashboard.css">
<?php include "../includes/sidebar.php";?>
<div class="main-content">
    <h1>mantap jiwa </h1>
</div>