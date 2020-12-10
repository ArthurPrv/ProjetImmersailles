<!-- permet de se déconnecter et de supprimer les données stockées dans $_SESSION -->

<?php
session_start();
session_destroy();

header("location:Index.php");
?>