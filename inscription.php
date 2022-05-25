<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Inscription</title>
</head>

      <?php include('bdd.php') ?>

      <?php 
      $nom = !empty($_POST['nom']) ? $_POST['nom'] : NULL;
      $prenom = !empty($_POST['prenom']) ? $_POST['prenom'] : NULL;
      $email = !empty($_POST['email']) ? $_POST['email'] : NULL;
      $phone = !empty($_POST['phone']) ? $_POST['phone'] : NULL;
      $adress = !empty($_POST['adress']) ? $_POST['adress'] : NULL;
      $passw1 = !empty($_POST['password1']) ? $_POST['password1'] : NULL;
      $passw2 = !empty($_POST['password2']) ? $_POST['password2'] : NULL;

      // CHECK SI EXISTE PAS : (nom et prenom identique) email telephone
      $requete_check_existe_pas = "SELECT id_personne FROM compte WHERE (nom = '".$nom."' AND prenom = '".$prenom."') OR email = '".$email."' OR phone = '".$phone."'";
      $result_exist_pas = mysqli_query($link_login, $requete_check_existe_pas);

      $requete_inscription = "INSERT INTO `compte`(`id_personne`, `nom`, `prenom`, `email`, `phone`, `adresse`, `passw`, `role_`) VALUES (0,'".$nom."','".$prenom."','".$email."','".$phone."','".$adress."','".$passw1."', 'festivalier')";

      if(!empty($_POST)){
            if(empty($_POST['nom'])){}
            else if(empty($_POST['prenom'])){}
            else if(empty($_POST['email'])){}
            else if(empty($_POST['phone'])){}
            else if(empty($_POST['adress'])){}
            else if(empty($_POST['password1'])){}
            else if(empty($_POST['password2'])){}
            else if($_POST['password1'] !== $_POST['password2'])
                echo "Les 2 mots de passes rentres sont differents.";

            // Donnees CORRECTES : redirige vers la page trajet
            else if(mysqli_num_rows($result_exist_pas) == 0) {
                echo $requete_inscription;
                $result = mysqli_query($link_login, $requete_inscription); // On inscrit le nouveau dans la bdd
                session_start();
                $result_exist = mysqli_query($link_login, $requete_check_existe_pas); // On r�cup�re l'id_personne du nouveau
                $session = mysqli_fetch_assoc($result_exist);
                $_SESSION['login'] = $session["id_personne"];
                header("Location: page.php");
            }
      } 
      ?>

<body>

    <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="post">
        <label>Nom</label>
        <input type="text" name="nom" id="nom" value="<?php if(!empty($_POST['nom'])) { echo htmlspecialchars($_POST['nom'], ENT_QUOTES); } ?>" required>

        <label>Prenom</label>
        <input type="text" name="prenom" id="prenom" value="<?php if(!empty($_POST['prenom'])) { echo htmlspecialchars($_POST['prenom'], ENT_QUOTES); } ?>" required>

        <label>Email</label>
        <input type="text" name="email" id="email" value="<?php if(!empty($_POST['email'])) { echo htmlspecialchars($_POST['email'], ENT_QUOTES); } ?>" required>

        <label>Telephone</label>
        <input type="text" name="phone" id="phone" value="<?php if(!empty($_POST['phone'])) { echo htmlspecialchars($_POST['phone'], ENT_QUOTES); } ?>" required>

        <label>Adresse</label>
        <input type="text" name="adress" id="adress" value="<?php if(!empty($_POST['adress'])) { echo htmlspecialchars($_POST['adress'], ENT_QUOTES); } ?>" required>

        <label>Mot de passe</label>
        <input type="text" name="password1" id="password1" value="<?php if(!empty($_POST['password1'])) { echo htmlspecialchars($_POST['password1'], ENT_QUOTES); } ?>" required>

        <label>Repetez le mot de passe</label>
        <input type="text" name="password2" id="password2" value="<?php if(!empty($_POST['password2'])) { echo htmlspecialchars($_POST['password2'], ENT_QUOTES); } ?>" required>


        <input type="submit" name="submit" value="Inscription" />
          </p>
                  <?php if(!empty($message)) :
                      echo '<div style="text-align: center ;margin-top: 4px; font-size: 20px;font-weight: bold; color: white; text-decoration: underline;">  '.$message.' </div>';
                  endif; ?>
          </p>
    </form>

</body>
</html>