<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>D'ou pars tu</title>
    <link href="creer_un_trajet.css" rel="stylesheet">
</head>

<?php include("bdd.php");session_start();?>

<?php
$prix = !empty($_POST['prix']) ? $_POST['prix'] : NULL;

if(!empty($_POST)) {
    if (!empty($_POST['prix'])) {
        $_SESSION['prix'] = $prix;
        header("location: creer_un_trajet_5.php");
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
                <h1 class="question">Quelle est le prix du trajet par personne</h1>
                <input class="donnee" name="prix" type="text" value="<?php if(!empty($_POST['prix'])) { echo htmlspecialchars($_POST['prix'], ENT_QUOTES); } ?>">

                <div class="align_button">
                    <a class="next" href="creer_un_trajet_5.php">
                        <input type="submit" value="Suivant" class="button">
                    </a>
                    <a class="previous" href="creer_un_trajet_3.php">
                        <input type="button" value="Précédent" class="button">
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>