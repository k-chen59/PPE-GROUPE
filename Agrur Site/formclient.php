<!DOCTYPE html>
<?php

$bdd = new PDO('mysql:host=127.0.0.1;dbname=bddagrur2', 'root', '');

if(isset($_POST['forminscription'])) {
   $pseudoclient = htmlspecialchars($_POST['pseudoclient']);
   $mailclient = htmlspecialchars($_POST['mailclient']);
   $mailclient2 = htmlspecialchars($_POST['mailclient2']);
   $mdpclient = sha1($_POST['mdpclient']);
   $mdpclient2 = sha1($_POST['mdpclient2']);
   $nomclient=htmlspecialchars($_POST['nomclient']);
   $prenomclient=htmlspecialchars($_POST['prenomclient']);
   $adresse=htmlspecialchars($_POST['adresse']);
   $nomrespachat=htmlspecialchars($_POST['nomrespachat']);
   



   if(!empty($_POST['pseudoclient']) AND !empty($_POST['mailclient']) AND !empty($_POST['mailclient2']) AND !empty($_POST['mdpclient']) AND !empty($_POST['mdpclient2']) AND !empty($_POST['nomclient']) AND !empty($_POST['prenomclient']) AND !empty($_POST['adresse']) AND !empty($_POST['nomrespachat'])) {
      $pseudolength = strlen($pseudoclient);
      if($pseudolength <= 255) {
         if($mailclient == $mailclient2) {
            if(filter_var($mailclient, FILTER_VALIDATE_EMAIL)) {
               $reqmail = $bdd->prepare("SELECT * FROM espaceclient WHERE mail = ?");
               $reqmail->execute(array($mailclient));
               $mailexist = $reqmail->rowCount();
               if($mailexist == 0) {
                  if($mdpclient == $mdpclient2) {
                     $insertmbr = $bdd->prepare("INSERT INTO espaceclient(pseudo, mail, motdepasse,NomClient,PrenomClient,AdresseClient,NomRespAchat) VALUES(?, ?, ?, ?, ?, ?, ?)");
                     $insertmbr->execute(array($pseudoclient, $mailclient, $mdpclient,$nomclient,$prenomclient,$adresse,$nomrespachat));
                     $erreur = "Votre compte a bien été créé ! <a href=\"espaceclient.php\">Me connecter</a>";
                  } else {
                     $erreur = "Vos mots de passes ne correspondent pas !";
                  }
               } else {
                  $erreur = "Adresse mail déjà utilisée !";
               }
            } else {
               $erreur = "Votre adresse mail n'est pas valide !";
            }
         } else {
            $erreur = "Vos adresses mail ne correspondent pas !";
         }
      } else {
         $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="inscription.css"/>
<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
	<title>Formulaire Client</title>
</head>
<body>
<!--MENU-->
<div id="page">
	<ul id="menu">
			<br><br>
    		<a href="index.html" id="accueil">Accueil</a>
			<a href="pageconnex.html" id="connect">Se connecter</a>
			<span id="barre">|</span>
			<a href="formclient.php">S'inscrire</a>
  	</ul>


<!--DEBUT FORMULAIRE-->
<div id="global" align="center">
		<div class="haut">
		<img class="logo" src="">

<form method ="POST" action ="">
	<img src ="inscriptionclient.gif" id="inscripfourn">
	<img id="brush" src="noixfourn.gif">
	<div id="carrefond">	
	</div>
	
<!--PRODUCTEUR-->
	<div id ="formulaire">
	<table>
	<br/><br/>
	<tr>
		<td align="right">
			<label id="prod">Nom : </label>
		</td>
		<td>
		<input id ="inputprod" type='text' name='nomclient' value="<?php if (isset($nomclient)) {echo $nomclient;} ?>"" /></br>
		</td>
	</tr>
	<tr>
		<td align="right">
			<label id="prod">Prénom : </label>
		</td>
		<td>
		<input id="inputprod" type='text' name='prenomclient' value="<?php if (isset($prenomclient)) {echo $prenomclient;} ?>"" /></br>
		</td>
	</tr>
	<tr>
		<td align="right">
			<label id="prod">Adresse: </label>
		</td>
		<td>
		<input id="inputprod" type='text' name='adresse' value="<?php if (isset($adresse)) {echo $adresse;} ?>"" /></br>
		</td>
	</tr>
	</table>
<!--RESPONSABLE-->
	<table>
	<tr>
		<td align="right">
			<label>Nom du responsable d'achat :</label> 
		</td>
		<td>
		<input id="inputprod" type='text' name='nomrespachat' value="<?php if (isset($nomrespachat)) {echo $nomrespachat;} ?>"" /></br>
		</td>
	</tr>
	</table>
<!--IDENTIFICATION-->
	<table>
	<tr>
		<td align="right">	
				<label>Identifiant : </label>
		</td>
		<td><input id="inputprod" type='text' name='pseudoclient' value="<?php if (isset($pseudoclient)) {echo $pseudoclient;} ?>"/></br>
		</td>
	</tr>
	<tr>		
			<td align="right">
			<label>Mail : </label>
			</td>
			<td>
			<input id="inputprod" type='email' name='mailclient' value="<?php if (isset($mailclient)) {echo $mailclient;} ?>"/></br>
			</td>
		</tr>
		<tr>
				<td align="right">
				<label for="mailclient2">Confirmation du mail :</label>
				</td>
				<td>
				<input id ="mailclient2" type="email" placeholder="Mail de confirmation" name="mailclient2" value="<?php if (isset($mailclient2)) {echo $mailclient2;} ?>">
				</td>
		</tr>			
		<tr>
		<td align="right">
		<label> Votre mot de passe :</label>
		</td>
		<td>
		<input id="inputprod" type="password" name="mdpclient" id="pass" /></br>
		</td>
		</tr>

		<tr>
			<td align="right">
			<label for="mdpclient2">Confirmer votre mot de passe :</label>
			</td>
			<td>
			<input id ="mdpclient2" type="password" placeholder="Mot de passe de confirmation" name="mdpclient2">
			</td>
		</tr>

		<tr>
		<td></td>

		<td>
			<input id="valider" type="submit" id="submit" value="Valider" name="forminscription"></BR>
		</td>
		</tr>

	</table>
	<?php
		if (isset($erreur)) {
			echo'<font color="red" id="erreur">'.$erreur."</font>";
		}
	?>
 </div>
</form>



</div> <!-- fin de page-->
</body>
</html>
