 
<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=bddagrur2', 'root', '');

if(isset($_SESSION['IDClient'])) {
   $requser = $bdd->prepare("SELECT * FROM espacefclient WHERE IDClient = ?");
   $requser->execute(array($_SESSION['IDClient']));
   $user = $requser->fetch();
   if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo']) {
      $newpseudo = htmlspecialchars($_POST['newpseudo']);
      $insertpseudo = $bdd->prepare("UPDATE espaceclient SET pseudo = ? WHERE IDClient = ?");
      $insertpseudo->execute(array($newpseudo, $_SESSION['IDClient']));
      header('Location: profilclient.php?IDClient='.$_SESSION['IDClient']);
   }
   if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail']) {
      $newmail = htmlspecialchars($_POST['newmail']);
      $insertmail = $bdd->prepare("UPDATE espaceclient SET mail = ? WHERE IDClient = ?");
      $insertmail->execute(array($newmail, $_SESSION['ID']));
      header('Location: profilclient.php?IDClient='.$_SESSION['ID']);
   }
   if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
      $mdp1 = sha1($_POST['newmdp1']);
      $mdp2 = sha1($_POST['newmdp2']);
      if($mdp1 == $mdp2) {
         $insertmdp = $bdd->prepare("UPDATE espaceclient SET motdepasse = ? WHERE IDClient = ?");
         $insertmdp->execute(array($mdp1, $_SESSION['IDClient']));
         header('Location: profilclient.php?IDClient='.$_SESSION['IDClient']);
      } else {
         $msg = "Vos deux mdp ne correspondent pas !";
      }
   }
?>
<html>
   <head>
      <title> Modification de votre profil </title>
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="editionprofil.css">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
   </head>
   <body>
   <!-- -->
<ul id="menu">
         <br><br>
         <a href="index.html" id="accueil">Accueil</a>
         <a href="deconnexion.php" id="connect">Se deconnecter</a>
         <span id="barre">|</span>
         <a href="">S'inscrire</a>
      </ul>

<!-- -->
      <div align="center">
         <h2>Edition de mon profil</h2><br/><br/>
         <div align="center">
            <form method="POST" action="" enctype="multipart/form-data">
               <label  >Pseudo :</label>
               <input  id="inputprod" type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $user['pseudo']; ?>" /><br /><br />
               <label >Mail :</label>
               <input id="inputprod" type="text" name="newmail" placeholder="Mail" value="<?php echo $user['mail']; ?>" /><br /><br />
               <label >Mot de passe :</label>
               <input id="inputprod" type="password" name="newmdp1" placeholder="Mot de passe"/><br /><br />
               <label >Confirmation - mot de passe :</label>
               <input id="inputprod" type="password" name="newmdp2" placeholder="Confirmation du mot de passe" /><br /><br />
               <input id="valider" type="submit" value="Mettre à jour mon profil !" />
            </form>
            <?php if(isset($msg)) { echo $msg; } ?>
         </div>
      </div>
   </body>
</html>
<?php   
}else {
   header("Location: connexion.php");
}
?>