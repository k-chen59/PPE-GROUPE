<!DOCTYPE html>

<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=bddagrur2', 'root', '');

if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM espacefournisseur WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
?>
<!-- PROFIL DU FOURNISSEUR -->
<html>

<head>
	<title>Profil de <?php echo $userinfo['pseudo']; ?></title>
   <meta charset = "UTF-8"/>
   <link rel="stylesheet" type="text/css" href="editionprofil.css" media="all">
   <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
</head>

<body>

<!-- -->
<ul id="menu">
         <br><br>
         <a href="index.html" id="accueil">Accueil</a>
         <a href="deconnexion.php" id="connect">Se deconnecter</a>
         <span id="barre">|</span>
         <a href="formfourn.php">S'inscrire</a>
      </ul>

<!-- -->
	<div align="center">
		<h2 style="font-family: 'Open Sans Condensed'"">Bienvenue <?php echo $userinfo['pseudo']; ?><br/></h2>

      <div id ="contenu">
		<p style="font-family: 'Open Sans Condensed'""> Pseudo : <?php echo $userinfo['pseudo']; ?></p>
         <br />
        <p style="font-family: 'Open Sans Condensed'""> Mail : <?php echo $userinfo['mail']; ?></p>
         <br />
         <?php
         if(isset($_SESSION['ID']) AND $userinfo['ID'] == $_SESSION['ID']) {
         ?>
         <br />
         <a style="font-family: 'Open Sans Condensed'" id="edit" href="editionprofil.php">Editer mon profil</a>
         <a style="font-family: 'Open Sans Condensed'" id="edit" href="deconnexion.php">Se déconnecter</a>
         <?php
         }
         ?>
      </div>
	</div>
</body>
</html>
<?php   
}
?>