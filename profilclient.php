<!DOCTYPE html>

<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=bddagrur2', 'root', '');

if(isset($_GET['IDClient']) AND $_GET['IDClient'] > 0) {
   $getid = intval($_GET['IDClient']);
   $requser = $bdd->prepare('SELECT * FROM espaceclient WHERE IDClient = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
?>

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
         <a href="formclient.php">S'inscrire</a>
      </ul>

<!-- -->
	<div align="center">
		<h2>Bienvenue <?php echo $userinfo['pseudo']; ?></h2>
      <br/>
		
      
      <table class="contenu">
         <tr>Bonjour <?php echo $userinfo['pseudo'];  ?> ! </tr>
      </table>

         <?php
         if(isset($_SESSION['IDClient']) AND $userinfo['IDClient'] == $_SESSION['IDClient']) {
         ?>
         <br />

         <a id="edit" href="editionprofilclient.php">Editer mon profil</a>
         <a id="edit" href="deconnexion.php">Se déconnecter</a>
         <?php
         }
         ?>
	</div>
</body>
</html>
<?php   
}
?>