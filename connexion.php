<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Connexion</title>
</head>

      <?php include('bdd.php') ?>

      <?php 
      $id = !empty($_POST['id']) ? $_POST['id'] : NULL;
      $password = !empty($_POST['password']) ? $_POST['password'] : NULL;
      $requete_connexion = "SELECT id_personne FROM compte WHERE nom = '".$id."' AND passw = '".$password."'";
      $result = mysqli_query($link_login, $requete_connexion);

      
      if(!empty($_POST)){
            if(empty($_POST['id']))
                echo("manque id");
            else if(empty($_POST['password']))
                echo("manque password");

            // Données CORRECTES : redirige vers la page trajet
            else if(mysqli_num_rows($result) == 1){
                session_start();
                $session = mysqli_fetch_assoc($result);
                $_SESSION['login'] = $session["id_personne"];
                header("Location: page.php");
            }
            else if(mysqli_num_rows($result) == 0){
                $message="Identifiant ou mot de passe invalide";
            }
      } 
      ?>

<body>

    <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="post">
        <label>Identifiant</label>
        <input type="text" name="id" id="id" value="<?php if(!empty($_POST['id'])) { echo htmlspecialchars($_POST['id'], ENT_QUOTES); } ?>" required>

        <label>Mot de passe</label>
        <input type="text" name="password" id="password" value="<?php if(!empty($_POST['password'])) { echo htmlspecialchars($_POST['password'], ENT_QUOTES); } ?>" required>

        <input type="submit" name="submit" value="Identification" />
          </p>
                  <?php if(!empty($message)) :
                      echo '<div style="text-align: center ;margin-top: 4px; font-size: 20px;font-weight: bold; color: white; text-decoration: underline;">  '.$message.' </div>';
                  endif; ?>
          </p>
    </form>

</body>
</html>