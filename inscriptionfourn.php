<!DOCTYPE html>

<?php

$bdd = new PDO('mysql:host=127.0.0.1;dbname=bddagrur2', 'root', '');

if(isset($_POST['forminscription'])) {
   $pseudo = htmlspecialchars($_POST['pseudo']);
   $mail = htmlspecialchars($_POST['mail']);
   $mail2 = htmlspecialchars($_POST['mail2']);
   $mdp = sha1($_POST['mdp']);
   $mdp2 = sha1($_POST['mdp2']);
   $nom=htmlspecialchars($_POST['nom']);
   $prenom=htmlspecialchars($_POST['prenom']);
   $nomste=htmlspecialchars($_POST['nomste']);
   $adresseste=htmlspecialchars($_POST['adresseste']);
   $nomresp=htmlspecialchars($_POST['nomresp']);
   $prenomresp=htmlspecialchars($_POST['prenomresp']);



   if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']) AND !empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['nomste']) AND !empty($_POST['adresseste']) AND !empty($_POST['nomresp'])AND !empty($_POST['prenomresp'])) {
      $pseudolength = strlen($pseudo);
      if($pseudolength <= 255) {
         if($mail == $mail2) {
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
               $reqmail = $bdd->prepare("SELECT * FROM espacefournisseur WHERE mail = ?");
               $reqmail->execute(array($mail));
               $mailexist = $reqmail->rowCount();
               if($mailexist == 0) {
                  if($mdp == $mdp2) {
                     $insertmbr = $bdd->prepare("INSERT INTO espacefournisseur(pseudo, mail, motdepasse,Nom,Prenom,NomSte,AdresseSte,PrenRespProd,NomRespProd) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
                     $insertmbr->execute(array($pseudo, $mail, $mdp,$nom,$prenom,$nomste,$adresseste,$nomresp,$prenomresp));
                     $erreur = "Votre compte a bien été créé ! <a id ="indication" href =\"connexion.php\">Me connecter</a>";
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
	<title>Inscription fournisseur</title>
</head>


<body>
<!--MENU-->
<ul id="menu">
			<br><br>
    		<a href="index.html" id="accueil">Accueil</a>
			<a href="pageconnex.html" id="connect">Se connecter</a>
			<span id="barre">|</span>
			<a href="inscriptionfourn.php">S'inscrire</a>
</ul>
<!---->

<!--FORMULAIRE-->
<div id ="formulaire" align="center">
<br/><br/>
	<table>
	<tr>
		<td align="left">
			<label id="prod">Nom : </label>
		</td>
		<td>
		<input id ="inputprod" type='text' name='nom' value="<?php if (isset($nom)) {echo $nom;} ?>"" /></br>
		</td>
	</tr>
	<tr>
		<td align="left">
			<label id="prod">Prénom : </label>
		</td>
		<td>
		<input id="inputprod" type='text' name='prenom' value="<?php if (isset($prenom)) {echo $prenom;} ?>"" /></br>
		</td>
	</tr>
	<tr>
		<td align="left">
			<label id="prod">Nom de la société :</label>
		</td>
		<td>
		<input id="inputprod" type='text' name='nomste' value="<?php if (isset($nomste)) {echo $nomste;} ?>"" /></br>
		</td>
	</tr>
	<tr>
		<td align="left">
			<label id="prod">Adresse de la société : </label>
		</td>
		<td>
		<input id="inputprod" type='text' name='adresseste' value="<?php if (isset($adresseste)) {echo $adresseste;} ?>"" /></br>
		</td>
	</tr>
	
<!--RESPONSABLE-->
	
	<tr>
		<td align="left">
			<label>Nom du responsable :</label> 
		</td>
		<td>
		<input id="inputprod" type='text' name='nomresp' value="<?php if (isset($nomresp)) {echo $nomresp;} ?>"" /></br>
		</td>
	</tr>
	<tr>
		<td align="left">
		<label>Prénom du responsable : </label>
		</td>
		<td>
		<input id="inputprod" type='text' name='prenomresp' value="<?php if (isset($prenomresp)) {echo $prenomresp;} ?>"" /></br>
		</td>
	</tr>
	
<!--IDENTIFICATION-->
	
	<tr>
		<td align="left">	
				<label>Identifiant : </label>
		</td>
		<td><input id="inputprod" type='text' name='pseudo' value="<?php if (isset($pseudo)) {echo $pseudo;} ?>"/></br>
		</td>
	</tr>
	<tr>		
			<td align="left">
			<label>Mail : </label>
			</td>
			<td>
			<input id="inputprod" type='email' name='mail' value="<?php if (isset($mail)) {echo $mail;} ?>"/></br>
			</td>
		</tr>
		<tr>
				<td align="left">
				<label for="mail2">Confirmation du mail :</label>
				</td>
				<td>
				<input id ="mail2" type="email" placeholder="Mail de confirmation" name="mail2" value="<?php if (isset($mail2)) {echo $mail2;} ?>">
				</td>
		</tr>			
		<tr>
		<td align="left">
		<label> Votre mot de passe :</label>
		</td>
		<td>
		<input id="inputprod" type="password" name="mdp" id="pass" /></br>
		</td>
		</tr>

		<tr>
			<td align="left">
			<label for="mdp2">Confirmer votre mot de passe :</label>
			</td>
			<td>
			<input id ="mdp2" type="password" placeholder="Mot de passe de confirmation" name="mdp2">
			</td>
		</tr>

		<tr>
		<td></td>

		<td>
			<input id="valider" type="submit" id="submit" value="Valider" name="forminscription"></BR>
		</td>
		</tr>    	
	</table>
 
</form>

<?php
		if (isset($erreur)) {
			echo'<font color="red" id="erreur">'.$erreur."</font>";
		}
	?>
</div>
</body>
</html>