<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>D'ou pars tu</title>
    <link href="creer_un_trajet.css" rel="stylesheet">
</head>

<?php include("bdd.php");session_start();?>

<?php 

$nb_passager = !empty($_POST['nb_passager']) ? $_POST['nb_passager'] : NULL;

if(!empty($_POST)) {
    if (!empty($_POST['nb_passager'])) {
        $_SESSION['nb_passager'] = $nb_passager;
        header("location: creer_un_trajet_4.php");
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
                <h1 class="question">Combien de passager prends-tu?</h1>
                <input class="donnee" type="number" name="nb_passager" value="<?php if(!empty($_POST['nb_passager'])) { echo htmlspecialchars($_POST['nb_passager'], ENT_QUOTES); } ?>" required>
                <div class="align_button">
                    <a class="next" href="creer_un_trajet_4.php">
                        <input type="submit" value="Suivant" class="button">
                    </a>
                    <a class="previous" href="creer_un_trajet_2.php">
                        <input type="button" value="Précédent" class="button">
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>