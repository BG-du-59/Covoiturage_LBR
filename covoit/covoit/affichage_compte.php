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
    
    ?>

    <body class="auth_class">
        <div class="container login-container">
            <table>
                <?php 
                        $recup_compte ="SELECT * FROM compte ORDER BY id_personne ASC";
                        $result_compte = mysqli_query($link_login, $recup_compte);
                        if(mysqli_num_rows($result_compte) == 0)
                        echo "<p>"."Il n'y a aucune compte"."</p>";
                        else{
                            while($row = mysqli_fetch_assoc($result_compte)){
                                $personne = mysqli_query($link_login, "SELECT nom,prenom,email,phone FROM compte WHERE id_personne='".$row['id_personne']."'");
                                $personne = mysqli_fetch_assoc($personne);

                                ?>
                                <!-- affcihage des informations necessaires d'un compte sans mot de passe -->
                                <tr>
                                    <td><?php echo $personne['nom']?></td>
                                    <td><?php echo $personne['prenom']?></td>
                                    <td><?php echo $personne['email']?></td>
                                    <td><?php echo $personne['phone']?></td>
                                    <td><button name="<?php echo "id_".$row['id_personne'];?>" type="button" value="TEST">
                                   <!-- <?php
                                        $mail= "SELECT email FROM compte WHERE(id_personne ='".$id_per."') ";
                                        $result_mail = mysqli_query($link_login, $mail);
                                        $mail_exp = implode("",mysqli_fetch_assoc($result_mail));
                                        $mail_compte_sup=e_mail($mail_exp,"ton compte est supprimer sale merde par l'admin","VOTRE COMPTE A ETE SUPPRIME");
                                        if($mail_compte_sup===1){
                                            $supprimer ="DELETE from compte WHERE(id_personne = '".$id_per."')";
                                            $result_supprimer= mysqli_query($link_login, $supprimer);
                                            $supprimer_trajet = "DELETE FROM demande WHERE(id_personne ='".$id_per."')";
                                        }
                                    ?> -->
                                    
                                    SUPP COMPTE</button></td>
                                    
                                </tr> 
                                <?php

                            }
                        }
                ?>
           </table>
        </div>
   </body>
</html>