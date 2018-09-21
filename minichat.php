<?php
session_start();
// Connexion à la base de données
try
{
$bdd_s = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
$reponse_s = $bdd_s->query('SELECT pseudo FROM minichat ORDER BY ID DESC LIMIT 1');
while ($donnees_s = $reponse_s->fetch())
{
    $_SESSION['pseudo']=$donnees_s['pseudo'];
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mini-chat</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </head>
    <style>
        form
        {
            display:block;
            margin-right: auto;
            margin-left: auto;
            
        }
        img
        {
            display:block;
            margin-top: 50px;
            width:100%;
        }
        body
        {
            background-color: #191919;
        }
        label
        {
            display:block;
            color: #E41F16;
            margin-left: 240px;
        }
        p
        {
            color: white;
        }
        strong
        {
            color : #E41F16;
        }
        section
        {
            display:block;
            margin-top: 50px; 
        }
        input
        {
           display:block;
           margin-left: 190px;
           
        }
        button
        {
            display:block;
            margin-left: 235px;           
        }

    </style>
    <body>
            <div class="container">
                <div class="row">

                    <div class="col-lg-6">
                        <img src="logo_teamRocket.jpg" alt="Logo team Rocket"/>
                            <form action="minichat_post.php" method="post">
                            <p>
                                <label for="pseudo">Pseudo : </label> <input type="text" name="pseudo" value="<?php echo $_SESSION['pseudo'] ?>" id="pseudo" /><br />
                                <label for="message">Message : </label> <input type="text" name="message" id="message" /><br /><br />

                                <button type="submit" value="Envoyer" class="btn btn-outline-danger" />Envoyer</button>
                            </p>
                        </form>
                    </div>  
                


                    <div class="col-lg-6 col-lg-offset-6">
                        <section>
                            <?php
                            try
                            {
                            $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
                            }
                            catch(Exception $e)
                            {
                                    die('Erreur : '.$e->getMessage());
                            }
                            // Récupération des 10 derniers messages
                            $reponse = $bdd->query('SELECT pseudo, message, DATE_FORMAT(date_ajout,\'%d/%m/%Y %H:%i:%s\') AS date_fr FROM minichat ORDER BY ID DESC LIMIT 0, 10');

                            // Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
                            while ($donnees = $reponse->fetch())
                            {
                                echo '<p> [' . $donnees['date_fr'] . '] <strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> : ' . htmlspecialchars($donnees['message']) . '</p>';
                            }

                            $reponse->closeCursor();

                            ?>
                        </section>
                    </div>
                </div>   
               
            </div>
    </body>
</html>