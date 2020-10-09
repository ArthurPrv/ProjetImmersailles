<?php
session_start();

?>
<head>


        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


        <!-- Bootstrap CSS -->

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
              integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">


        <link rel="stylesheet" type="text/css" href="../css/timeline.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"
                type="text/javascript"></script>

        <link href='https://fonts.googleapis.com/css?family=Oxygen:400,300' rel='stylesheet' type='text/css'>
    </head>


    <?php
    if(isset($_SESSION['Profil'])){
if ($_SESSION['Profil'] == 'Administrateur') {
    ?>

    <header>
        <div class="d-inline-block w-100 text-white bg-dark ">
            <h1 class="w-45  d-inline-block">
                <img src="../images/logo_mini.png" class="w-auto">Immersailles - Admin</h1>
            <h1 class="w-45 d-inline-block float-right">
                <a href="Apropos.php" class="text-white font-weight-lighter">A propos</a>
                <img src="../images/logo_mini.png" class="w-auto">
                <a href="deconnexion.php"><img src="../images/logo_mini.png" class="w-auto"></a>
            </h1>

        </div>

    </header>
    <?php
}
else if ($_SESSION['Profil'] == 'Contributeur'){
    ?>
    <header>
    <div class="d-inline-block w-100 text-white bg-dark ">
        <h1 class="w-45  d-inline-block">
            <img src="../images/logo_mini.png" class="w-auto">Immersailles - Histoire</h1>
        <h1 class="w-45 d-inline-block float-right">
            <a href="Apropos.php" class="text-white font-weight-lighter">A propos</a>
            <img src="../images/logo_mini.png" class="w-auto">
            <a href="deconnexion.php"><img src="../images/logo_mini.png" class="w-auto"></a>
        </h1>

    </div>
</header>
    <?php
}}
else{
    ?>
<header>
    <div class="d-inline-block w-100 text-white bg-dark ">
        <h1 class="w-45  d-inline-block">
            <img src="../images/logo_mini.png" class="w-auto">Immersailles </h1>
        <h1 class="w-45 d-inline-block float-right">
            <a href="Apropos.php" class="text-white font-weight-lighter">A propos</a>
            <img src="../images/logo_mini.png" class="w-auto">
          <a href="connexion.php">
                <img src="../images/profil2.png" class="w-auto" >
            </a>
        </h1>

    </div>
</header>
<?php
}
?>
