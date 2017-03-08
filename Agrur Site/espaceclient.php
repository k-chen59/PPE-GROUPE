<!DOCTYPE html>
<?php

session_start();



$bdd = new PDO('mysql:host=127.0.0.1;dbname=bddagrur2', 'root', '');

if (isset($_POST['formconnexion'])) {
  $mailconnectclient=htmlspecialchars($_POST['mailconnectclient']);
  $mdpconnectclient=sha1($_POST['mdpconnectclient']);
  if (!empty($mailconnectclient) AND !empty($mdpconnectclient)) {
    $requser= $bdd->prepare("SELECT * FROM espaceclient WHERE mail = ? AND motdepasse = ?");
    $requser->execute(array($mailconnectclient,$mdpconnectclient));
    $userexist = $requser->rowCount();

    if ($userexist==1) {
      $userinfo = $requser -> fetch();
      $_SESSION['IDClient']=$userinfo['IDClient'];
      $_SESSION['pseudo']=$userinfo['pseudo'];
      $_SESSION['mail']=$userinfo['mail'];
      header("Location: profilclient.php?IDClient=".$_SESSION['IDClient']);
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
<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">

<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
  <title>Page de connexion | Espace Client</title>

</head>
<body>
    <ul id="menu">
      <br><br>
        <a href="index.html" id="accueil">Accueil</a>
      <a href="pageconnex.html" id="connect">Se connecter</a>
      <span id="barre">|</span>
      <a href="formclient.php">S'inscrire</a>
      </ul>

      <img id="identclient" src="identificationclient.gif">

      <img id="brush" src="noixclient.gif">



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
        <input id="username"  name= "mailconnectclient" type="email" placeholder="Email" autofocus required></BR>   <!--Placeholder c'est le nom qd personne tape genre carré username dedans-->
     </fieldset>

     <fieldset id="inputs">
        <input id="password" name="mdpconnectclient" type="password" placeholder="Mot de passe" required></BR>
    </fieldset>
    <fieldset id="actions"><!--Actions du style :"Connexion" se connecter -->
        <input type="submit" name="formconnexion" id="submit" value="Connexion"></BR>
        <a id="mdp" href="">Mot de passe oublié ?</a>
    </fieldset>
</form>

</body>
</html>