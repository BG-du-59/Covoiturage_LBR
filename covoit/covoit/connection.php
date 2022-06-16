<!doctype html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>LRB-Covoiturage-system</title>

    <!-- SCRIPT -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    <!--My CSS-->
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Favicon -->


</head>

<?php include('bdd.php') ?>

<?php
      $id = !empty($_POST['id']) ? $_POST['id'] : NULL;
      $password = !empty($_POST['password']) ? $_POST['password'] : NULL;
      $requete_connexion = "SELECT id_personne FROM compte WHERE nom = '".$id."' AND passw = '".$password."'";
      $result = mysqli_query($link_login, $requete_connexion);


      if(!empty($_POST)){
            if(empty($_POST['id'])){}
            else if(empty($_POST['password'])){}

            // Donn�es CORRECTES : redirige vers la page trajet
            else if(mysqli_num_rows($result) == 1){
                session_start();
                $session = mysqli_fetch_assoc($result);
                $_SESSION['login'] = $session["id_personne"];
                header("Location: accueil_client.php");
            }
            else if(mysqli_num_rows($result) == 0){
                $message="Identifiant ou mot de passe invalide";
            }
      }
      ?>

<body style="background-color: #161920" >

<!--Header-->
<div id="overlay" onclick="off()"></div>

<nav class="navbar navbar-expand-lg navbar-dark header" >
    <a class="nav-link navbar-toggler " href="#"><img src="LRB_blanc_petit.png" > <span class="sr-only">(current)</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item d-none d-lg-block">
                <a class="nav-link" href="#"><img src="LRB_blanc.png" > <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item link form-inline active">
                <a class="nav-link" href="#" >Covoiturage</a>
            </li>
            <li class="nav-item dropdown form-inline">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    info
                </a>
                <div class="dropdown-menu" id="dropdown" aria-labelledby="navbarDropdown">
                    <div class="dropdown-divider"></div>
                    <a class="menu dropdown-item" id="menu"  href="#">Comment ça marche</a>
                    <a class="menu dropdown-item" id="menu1"  href="#">Info Sanitaire</a>
                    <a class="menu dropdown-item" id="menu2"  href="#">Date Festivals</a>
                    <div class="dropdown-divider"></div>
                </div>
            </li>

        </ul>
        <ul class="navbar nav ">
            <li class="nav-item form-inline">
                <a class="nav-link disabled" href="#">Mes Trajets</a>
            </li>
            <li class="nav-item form-inline">
                <a class="nav-link " href="#" onclick="on()"><img src="profile_picture.png" > <span class="sr-only">(current)</span></a>
            </li>
        </ul>

    </div>
</nav>

<!--Main-->

<section class="vh-100 gradient-custom" id="connection">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center" style="z-index: 5;">

                        <div class="mb-md-5 mt-md-4 pb-5" >

                            <h2 class="fw-bold mb-2 text-uppercase" >Se Connecter</h2>
                            <p class="text-white-50 mb-5">Entrez vote identifiant et mot de passe pour vous connecter</p>

                            <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="post">

                            <div class="form-outline form-white mb-4">
                                <input type="text" id="typeEmailX" class="form-control form-control-lg" placeholder="E-Mail" name="id"  value="<?php if(!empty($_POST['id'])) { echo htmlspecialchars($_POST['id'], ENT_QUOTES); } ?>" required>
                            </div>

                            <div class="form-outline form-white mb-4">
                                <input type="password" id="typePasswordX" class="form-control form-control-lg" placeholder="Mot de passe" name="password" value="<?php if(!empty($_POST['password'])) { echo htmlspecialchars($_POST['password'], ENT_QUOTES); } ?>" required>
                            </div>

                            <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Mot de passe oublié</a></p>

                            <input class="btn btn-outline-light btn-lg px-5" style="background-color: #AF001E" type="submit" name="submit" value="Identification" />
                            </p>
                            <?php if(!empty($message)) :
                                echo '<div style="text-align: center ;margin-top: 4px; font-size: 20px;font-weight: bold; color: white; text-decoration: underline;">  '.$message.' </div>';
                            endif; ?>
                            </p>
                            </form>

                            <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-facebook" viewBox="0 0 16 16" >
                                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                                    <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                                </svg>
                            </div>

                        </div>

                        <div>
                            <p class="mb-0">Pas de compte? <a href="inscription.php" class="text-white-50 fw-bold">s'inscrire</a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="index.js"></script>


</body>
</html>
