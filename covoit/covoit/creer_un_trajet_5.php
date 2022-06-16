<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>D'ou pars tu</title>
    <link href="creer_un_trajet.css" rel="stylesheet">
</head>

<?php include("bdd.php");session_start();?>

<?php
$description = !empty($_POST['description']) ? $_POST['description'] : "";

if(!empty($_POST)) {
        $_SESSION['description'] = $description;
        header("location: creer_un_trajet_6.php");
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
                <h1 class="question">Veux -tu ajouter une description ? (facultatif)</h1>
                <input class="donnee" type="text" name="description" value="<?php if(!empty($_POST['description'])) { echo htmlspecialchars($_POST['description'], ENT_QUOTES); } ?>">
                <div class="align_button">
                    <a class="next" href="creer_un_trajet_6.php">
                        <input type="submit" value="Suivant" class="button">
                    </a>
                    <a class="previous" href="creer_un_trajet_4.php">
                        <input type="button" value="Précédent" class="button">
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>