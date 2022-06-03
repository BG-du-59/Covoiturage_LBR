<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>D'ou pars tu</title>
    <link href="creer_un_trajet.css" rel="stylesheet">
</head>

<?php include("bdd.php");session_start();?>

<?php 

$date = !empty($_POST['date_heure_depart']) ? $_POST['date_heure_depart'] : NULL;

if(!empty($_POST)){
    if(empty($_POST['date_heure_depart'])) {}

    else{
        $_SESSION['date_heure_depart'] = $_POST['date_heure_depart'];
        header("location : creer_un_trajet_2.php");
    }
}

?>


<body style="background-color: #161920" ;>
    <div style="min-height: 720px; height : auto;">
        </header>
        <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="post">
            <h1 class="question">Quand pars-tu?</h1>
            <input class="donnee" type="date" name="date_heure_depart" value="<?php if(!empty($_POST['date_heure_depart'])) { echo htmlspecialchars($_POST['date_heure_depart'], ENT_QUOTES); } ?>" required>
            <div class="align_button">
                <a class="next" href="creer_un_trajet_2.php">
                    <input type="submit" value="Suivant" class="button">
                </a>
                <a class="previous" href="creer_un_trajet.php">
                    <input type="button" value="Précédent" class="button">
                </a>
            </div>
        </form>
    </div>
</body>

</html>