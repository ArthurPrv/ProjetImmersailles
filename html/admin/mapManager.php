<?php
session_start();
if (!isset($_SESSION['Profil'])) {
    header('location:../Index.php');
} elseif ($_SESSION['Profil'] != 'Administrateur') {
    header("location:../Index.php");
}


?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<?php
include("header.php");
?>

<body style=" background-color: rgba(255,203,72,0.25);">

<!-- AJOUT DE CARTE DANS LA BDD-->
<div style=" display: flex;justify-content: center;align-content: center;align-items: center;">
    <div class="bg-dark rounded border border-warning m-5 " style="width: 800px;   ">
        <h2 class="title text-center text-white">AJOUT CARTE</h2>
        <div>

            <form method="post" action="mapManagerRecieve.php">
                <div class="text-center">
                    <input class="bg-transparent border-3" name="year" placeholder="Année" id="year" type="number">
                    <input class="bg-transparent border-3" placeholder="Niveaux (3 caractères max)" name="lvl" id="lvl">
                    <select class="bg-transparent border-3" name="plan" class="">
                        <option disabled="disabled" selected="selected" value="../images/Carte.png">Carte</option>
                        <option value="del">Supprimer</option>

                        <?php //Choisir une carte dans le fichier ../images/plans/nomdel'imge
                        $dir = opendir("../../images/plans") or die('Erreur de listage : le répertoire n\'existe pas');
                        while ($element = readdir($dir)) {
                            if ($element != ".." && $element != ".") {
                                echo("<option value='../images/plans/" . $element . "'>" . $element . "</option>");
                            }
                        }
                        ?>
                    </select>
                    <br>
                    <img id="headImg" style="max-width: 400px; max-height: 400px; margin-top: 3%">
                </div>
                <br/>
                <button class="" style="background-color: #1e7e34; margin: 0 46% 0 46% " type="submit">Ajouter</button>

            </form>


        </div>

    </div>

    <script>
        window.onload = function () {
            $("select")
                .change(function () {
                    //$("#imgContainer").attr("src",$( "select option:selected" ).val());
                    //$("#headImg").html('<img id="image" src="$( "select option:selected" ).val()">');
                    // $("#image").attr("src",$( "select option:selected" ).val());
                    //$("#headImg").css("background", ' grey center /cover no-repeat url(../' + $("select option:selected").val() + ')');
                    //$("#headImg").css("background-size", "contain");
                    if ($("select option:selected").val() !== "del") {
                        $("#headImg").attr("src", "../" + $("select option:selected").val());

                    }
                    //var image = document.getElementById("headImage");
                    //var str = '<img id="image" src="$( "select option:selected" ).val()">';


                })
                .change();

            //'url('+$( "select option:selected" ).val()+ ')'
        };
    </script>

    <script src="../../js/select2.min.js"></script>
    <script src="../../js/minJquery.js"></script>
    <script src="../../js/global.js"
    </form>
    <script async src="../../js/googleTagManager.js"></script>
    </form>
</div>
</div>
</div>


<div class="fixed-bottom">
    <?php

    include '../footer.php';
    ?></div>
</body>