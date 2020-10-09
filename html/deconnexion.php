<!-- permet de se déconnecter et de supprimer les onnées stocker dans $_SESSION -->

<?php
session_start();
session_destroy();

include("Index.php");
?>