<!DOCTYPE html>
<?php

session_start();



$bdd = new PDO('mysql:host=127.0.0.1;dbname=bddagrur2', 'root', '');

if (isset($_POST['formconnexion'])) {
  $mailconnect=htmlspecialchars($_POST['mailconnect']);
  $mdpconnect=sha1($_POST['mdpconnect']);
  if (!empty($mailconnect) AND !empty($mdpconnect)) {
    $requser= $bdd->prepare("SELECT * FROM espacefournisseur WHERE mail = ? AND motdepasse = ?");
    $requser->execute(array($mailconnect,$mdpconnect));
    $userexist = $requser->rowCount();

    if ($userexist==1) {
      $userinfo = $requser -> fetch();
      $_SESSION['ID']=$userinfo['ID'];
      $_SESSION['pseudo']=$userinfo['pseudo'];
      $_SESSION['mail']=$userinfo['mail'];
      header("Location: profil.php?id=".$_SESSION['ID']);
    }

    else {
      $erreur="Mauvais mail ou mot de passe";
    }
  }
  else {
    $erreur = "Tous les champs doivent être complétés !";
  }
}
?>
<html>
<head>
<meta charset = "UTF-8"/>
<link rel="stylesheet" type="text/css" href="pageconnexstyle.css">

<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
	<title>Page de connexion | Espace Fournisseur</title>

</head>
<body>
		<ul id="menu">
			<br><br>
    		<a href="index.html" id="accueil">Accueil</a>
			<a href="pageconnex.html" id="connect">Se connecter</a>
			<span id="barre">|</span>
			<a href="formfourn.php">S'inscrire</a>
  		</ul>

  		<img id="identclient" src="identificationclient.gif">

  		<img id="brush" src="noixfourn.gif">



  <div id="conteneurclient">
  	<img id="iconemdp" src="mdp.gif">
    <img id="iconeuser" src="user.gif">

  </div>

<!-- Ombre du bouton connexion-->
  <div id="ombrebouton">

  </div>

  <!--FORMULAIRE-->
  <form id="login" method="POST" action="">
    <fieldset id="inputs"><!-- éléments pour se connecter -->
        <input id="username"  name= "mailconnect" type="email" placeholder="Email" autofocus required></BR>   <!--Placeholder c'est le nom qd personne tape genre carré username dedans-->
     </fieldset>

     <fieldset id="inputs">
        <input id="password" name="mdpconnect" type="password" placeholder="Mot de passe" required></BR>
    </fieldset>
    <fieldset id="actions"><!--Actions du style :"Connexion" se connecter -->
        <input type="submit" name="formconnexion" id="submit" value="Connexion"></BR>
        <a id="mdp" href="">Mot de passe oublié ?</a>
    </fieldset>
</form>

</body>
</html>