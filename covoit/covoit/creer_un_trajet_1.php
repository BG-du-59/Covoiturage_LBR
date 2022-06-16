<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>D'ou pars tu</title>
    <link href="creer_un_trajet.css" rel="stylesheet">
</head>

<?php include("bdd.php"); session_start();?>

<?php
$date = !empty($_POST['date_heure_depart']) ? $_POST['date_heure_depart'] : NULL;

if(!empty($_POST)) {
    if (!empty($_POST['date_heure_depart'])) {
        $_SESSION['date_heure_depart'] = $date;
        header("location: creer_un_trajet_2.php");
    }
}
?>


<body style="background-color: #161920" ;>
    <div style="min-height: 720px; height : auto;">
        <header id="entete">
            <div id="logo">
                <img src="image\logoBLANC_1.png" id="image">
            </div>
            <div id="trajet_compte">
                <button type="button" id="bouton_mestrajets">Mes trajets</button>
                <button type="button" id="se_co"><img src="image\moncompte2.png" id="image2"></button>
            </div>
        </header>
        <div class="corps">
            <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="post">
                <h1 class="question">Quand pars-tu?</h1>
                <input class="donnee" type="date" name="date_heure_depart" id = "date_heure_depart"  value="<?php if(!empty($_POST['date_heure_depart'])) { echo htmlspecialchars($_POST['date_heure_depart'], ENT_QUOTES); } ?>" required>
                <div class="align_button">
                    <div class="next" >
                        <input type="submit" name="submit" value="Suivant" class="button"/>
                    </div><!--
                    <a class="previous" href="creer_un_trajet.php">
                        <input type="button" value="Précédent" class="button">
                    </a>-->
                </div>
            </form>
        </div>
    </div>
</body>

</html>