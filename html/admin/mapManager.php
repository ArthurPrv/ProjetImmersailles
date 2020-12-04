<?php
session_start();
if (!isset($_SESSION['Profil'])) {
    header('location:../Index.php');
} elseif ($_SESSION['Profil'] != 'Administrateur') {
    header("location:../Index.php");
}


?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://colorlib.com/etc/regform/colorlib-regform-3/vendor/mdi-font/css/material-design-iconic-font.min.css"
      rel="stylesheet" media="all">
<link href="https://colorlib.com/etc/regform/colorlib-regform-3/vendor/font-awesome-4.7/css/font-awesome.min.css"
      rel="stylesheet" media="all">

<link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet">

<link href="https://colorlib.com/etc/regform/colorlib-regform-3/vendor/select2/select2.min.css" rel="stylesheet"
      media="all">
<link href="https://colorlib.com/etc/regform/colorlib-regform-3/vendor/datepicker/daterangepicker.css" rel="stylesheet"
      media="all">

<link href="https://colorlib.com/etc/regform/colorlib-regform-3/css/main.css" rel="stylesheet" media="all">
</head>

<div class="wrapper wrapper--w780">
    <div class="card card-3">
        <div class="card-heading" id="headImg"></div>
        <div class="card-body">
            <h2 class="title">GESTION CARTE</h2>
            <form method="post" action="mapManagerRecieve.php">
                <div class="input-group">
                    <input class="input--style-3" placeholder="Niveaux" name="lvl" id="lvl" type="number">
                </div>
                <div class="input-group">
                    <input class="input--style-3" name="year" placeholder="Année" id="year" type="number"><br/>
                </div>


                <div class="input-group">
                    <div class="rs-select2 js-select-simple select--no-search">
                        <select name="plan" class="">
                            <option disabled="disabled" selected="selected">Carte</option>
                            <?php //Choisir une carte dans le fichier ../images/plans/nomdel'imge
                            $dir = opendir("../../images/plans") or die('Erreur de listage : le répertoire n\'existe pas');
                            while ($element = readdir($dir)) {
                                if ($element != ".." && $element != ".") {
                                    echo("<option value='../images/plans/" . $element . "'>" . $element . "</option>");
                                }
                            }
                            ?>
                        </select>
                        <div class="select-dropdown"></div>
                    </div>
                </div>

                <div class="p-t-10">
                    <button class="btn btn--pill btn--green" type="submit">Submit</button>
                </div>


                <script>
                    window.onload = function () {
                        $("select")
                            .change(function () {
                                //$("#imgContainer").attr("src",$( "select option:selected" ).val());
                                //$("#headImg").html('<img id="image" src="$( "select option:selected" ).val()">');
                                // $("#image").attr("src",$( "select option:selected" ).val());
                                $("#headImg").css("background", ' grey center /cover no-repeat url(../' + $("select option:selected").val() + ')');
                                $("#headImg").css("background-size", "contain");

                                //var image = document.getElementById("headImage");
                                //var str = '<img id="image" src="$( "select option:selected" ).val()">';


                            })
                            .change();

                        //'url('+$( "select option:selected" ).val()+ ')'
                    };
                </script>

                <script src="https://colorlib.com/etc/regform/colorlib-regform-3/vendor/select2/select2.min.js"></script>
                <script src="https://colorlib.com/etc/regform/colorlib-regform-3/vendor/jquery/jquery.min.js"></script>
                <script src="https://colorlib.com/etc/regform/colorlib-regform-3/js/global.js"
            </form>
            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
            </form>
        </div>
    </div>
</div>

