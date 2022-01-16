<h1>Parametre</h1>

<h2>Mon compte <?= $_SESSION['user_mail'] ?></h2>
<hr>
<h3>Modifier les droits des autres utilisateurs</h3>

<?php
    // S'il y a plus ou égale à 2 utilisateurs on affiche les autres utlisateurs
    if($utilisateurs->rowCount() >= 2){ 

            // Je parcours ce tableau PHP
            foreach ($liste_utilisateur as $utilisateur){

                 // Pour afficher que uniquement les autres utlisateurs, on verifie l'id du super admin 
                if($utilisateur->getId() !=$_SESSION['id']){
?>
                    <form class="w-25" action="index.php?p=user_update" method="POST">
            
                    <?php
                        echo "<input type='hidden' name='id' id='id' value='".$utilisateur->getId()."'>";
                        echo  " <label for='user'>".$utilisateur->getMail()." :</label>" ;
                    ?>
                        <select  class="form-select" name="user">
                        <?php
                             // Je parcours ce tableau PHP
                            foreach ($liste_role as $role) {
                               
                                if($role->getId() == $utilisateur->getUser_admin()){
                                         echo "<option value='".$role->getId()."' selected>".$role->getRole()."</option>";        
                                }
                                else{
                                     // Pour afficher  uniquement les roles à part celui du Super Admin, on verifi l'id du role
                                    if($role->getId() !=3){
                                        echo "<option value='".$role->getId()."'>".$role->getRole()."</option>";
                                    }
                                }
                            }
                        ?>
                        </select>
                        <br>
                        <input type='submit' name='update_user' value='Mettre à jour' class='btn btn-primary'>
                     </form>
            
                <?php
                echo "<hr>";
                }
            }
    } else{
        echo "<p>Il n'y a aucune d'utilisateur à part vous </p>";
    }
?>

