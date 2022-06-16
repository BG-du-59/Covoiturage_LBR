<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Mes informations</title>
    </head>


    <?php

        session_start();
        include "bdd.php";
        include "mail_envoie.php";


        // nombre de compte au total

        $compte_total="SELECT count(id_personne) from compte";
        $result_compte_total= mysqli_query($link_login, $compte_total);
        $NB_compte_total = implode("",mysqli_fetch_assoc($result_compte_total));

        // nb de trajet creer par édition

        $trajet_edition="SELECT num_edition,COUNT(num_edition) as nb_trajet from trajet GROUP by num_edition";
        $result_trajet_edition = mysqli_query($link_login, $trajet_edition);

        // nb total de place disponible

        $nb_place_dispo ="SELECT SUM(nb_passager) FROM trajet_conducteur";
        $result_nb_place_dispo=mysqli_query($link_login, $nb_place_dispo);
        $nb_place_dispo = implode("",mysqli_fetch_assoc($result_nb_place_dispo));
    ?>

    <body class="auth_class">
        <div class="container login-container">
            <table>
                <tr>
                    <td>Compte créer depuis le lancement : </td>
                    <td><?php echo $NB_compte_total?></td>
                </tr>
                    <?php 
                        if(mysqli_num_rows($result_trajet_edition) == 0){
                            ?>
                            <tr>
                            <?php echo "<td>"."Il n'y a aucune compte"."</td>"; ?>
                            </tr>
                        <?php
                        }   
                        else{
                            while($row=mysqli_fetch_assoc($result_trajet_edition)){
                                echo '<tr>';
                                echo "<td> nombre de trajet de l'édtion <strong>".$row['num_edition']."</strong> : </td>";
                                echo "<td>".$row['nb_trajet']."</td>";
                                echo '</tr>';
                                
                            }
                        }

                    ?>
                <tr>
                    <td>
                        Nombre total de place disponible :
                    </td>
                    <td> <?php echo $nb_place_dispo?></td>
                </tr>
            </table>
        </div>
   </body>
</html>