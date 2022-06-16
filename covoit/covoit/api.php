</html>
<!doctype html>
<html>

  <head>
     <title>api</title>
  </head>

  <body>
     <script src="api.js"></script>
     <?php
      include('bdd.php');
      session_start();
      $adress = !empty($_POST['adress']) ? $_POST['adress'] : NULL;
      $date = !empty($_POST['date']) ? $_POST['date'] : NULL; ?>
  </body>
  <div id="root" class style ="min-height: 720px; height: auto;">
  <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="post"></form>
    <?php $variableAPasser1="3 rue du faubourg notre dame, lille";
          $variableAPasser2="27 rue colson, Lille";?>
    <script>
        var variableRecuperee1 = <?php echo json_encode($variableAPasser1);?>;
        var variableRecuperee2 = <?php echo json_encode($variableAPasser2);?>;
        address1 = coordonnees(variableRecuperee1);
        address2 = coordonnees(variableRecuperee2);
    </script>
    <button id="calcul" onclick="console.log(distance(address1, address2))" style="width:100px; height:50px"></button>
    </div>

</html>