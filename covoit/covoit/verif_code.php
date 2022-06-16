<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Mes informations</title>
    </head>

    <!--My CSS-->
            <link rel="stylesheet" href="password_pages.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


<?php

    session_start();

    $verif_code = !empty($_POST['code']) ? $_POST['code'] : NULL;

    if (!empty($_POST)) {
        if (empty($_POST['code'])) {
        } else {
            if ($verif_code !== $_SESSION['code']) {
                echo "<script>alert(\"Le code est invalide\")</script>";
            }
            else{
                header("Location: reinit_mdp.php");
            }
        }
    }
    

?>
<body class="auth_class">
        <div class="container login-container">
            <div class="row">
                <div class="col-md-12 login-form">
                    <div class="login_form_in">
                        <h1 class="auth_title text-left">Saississez le code reçu</h1>
                        <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="post">
                            <div class="alert alert-danger bg-soft-primary border-0" role="alert">
                                <h1> adresse mail : <?php echo $_SESSION['mail']?></h1>
                            </div>
                           </br>
                            <div class="form-floating">
                                <label class="code" for="code">Rentrez le code reçu par mail:</label>
                                <input type="text" class="form-control" id="code" name="code" placeholder=" _  _  _  _  _  _" value="<?php if(!empty($_POST['code'])) { echo htmlspecialchars($_POST['code'], ENT_QUOTES); }?>" required>
                            </div>

                            </br>
                            <div class="form-group">
                                <input type="submit" id="submit" name="submit" value="Valider le code" class="btn btn-danger btn-lg btn-block">
                            </div>
                            <div class="form-group other_auth_links">
                                <a class="" href="">Annuler</a>
                                <a class="" href="">Renvoyer un code</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
   </body>

</html>
