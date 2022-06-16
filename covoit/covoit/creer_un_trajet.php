<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>D'où pars tu</title>
    <link href="creer_un_trajet.css" rel="stylesheet">
</head>

<?php include("bdd.php");session_start();?>

<?php

$radio= !empty($_POST['radio']) ? $_POST['radio'] : NULL;
$adress = !empty($_POST['adress']) ? $_POST['adress'] : NULL;

if(!empty($_POST)){
    if(empty($_POST['adress'])) {}
    else if(!isset($_POST['radio'])){}
    else{
        $_SESSION['adress'] = $adress;
        $_SESSION['radio'] = $radio;
        header("location: creer_un_trajet_1.php");
    }
    
}


?>

<body style="background-color: #161920;">
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
                <h1 class="question">D'où pars-tu ?</h1>
                <div class="aller_retour">
                    <div class="aller">
                        <input type="radio" id="radio" name="radio" value="aller"
                            checked>
                        <label>Aller</label>
                    </div>
                    <div class="retour">
                        <input type="radio" id="radio" name="radio" value="retour">
                        <label>Retour</label>
                    </div>
                </div>
                <input class="donnee" type="text" name="adress" placeholder="Lieu de départ" value="<?php if(!empty($_POST['adress'])) { echo htmlspecialchars($_POST['adress'], ENT_QUOTES); } ?>" required>
                <div class="align_button">
                    <div class="next">
                        <input type="submit" name="submit" value="Suivant" class="button"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>



</html>