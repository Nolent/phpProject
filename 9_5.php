<!--  E.Porcq	e95.php 20/09/2010 -->

<!-- maison : http://localhost:8082/support_php/prof/e95.php -->

<?php
$erreur = true;
if ( !empty($_POST ))
//if ( isset ($_POST["nom"]) && isset($_POST["prenom"]) )
{
	echo"<pre>";
	print_r($_POST);
	echo "</PRE>";
	echo "décodage sur le serveur <br />";

	$erreur = false;
	if (!empty($_POST['nom']) && $_POST['nom'] != "nom ?")
    $nom = $_POST['nom'];
	else
	{
		echo "le nom est vide <br />";
		$erreur = true;
	}
	if (!empty($_POST['prenom']) && $_POST['prenom'] != "")
		$prenom = $_POST['prenom'] ;
	else
	{
		echo "le prénom est vide <br />";
		$erreur = true;
	}
	if (!empty($_POST['courriel']) && $_POST['courriel'] != "courriel ?")
		$courriel = $_POST['courriel'] ;
	else
	{
		echo "le courriel est vide <br />";
		$erreur = true;
	}
	if (!empty($_POST['gouts']) && $_POST['gouts'] != "quoi d'autre ? ?")
		$gouts = $_POST['gouts'] ;
	else 
	{
		echo "les autres gouts ne sont pas remplis <br />";
		$erreur = true;
	}
	if (!empty($_POST['code']))
		$code = $_POST['code'] ;
	else
	{
		echo "le mot de passe est vide <br />";
		$erreur = true;
	}
	if (isset($_POST['civilite']) )
		$civ = $_POST['civilite'];
	else
	{
		echo "la civilité n'a pas été cochée <br />";
		$erreur = true;
	}
	if (isset($_POST['pays']) )
		$pays = $_POST['pays'];
	else
	{
		echo "le pays n'a pas été sélectionné <br />";
		$erreur = true;
	}
	if (isset($_POST['preference']) )
		$pref = $_POST['preference'];
	else
	{
		echo "aucune case n'a pas été cochée <br />";
		$erreur = true;
	}


	if (!empty($_POST['discret']) )
		$val = $_POST['discret'];

	if ($erreur == false)
	{
		echo "NOM : $nom <br />";
		echo "PRENOM : $prenom <br />";
		echo "CIVILITE : $civ <br />";
		echo "PAYS : $pays <br />";
		echo "Gouts : $gouts <br />";
		$gouts = stripslashes($gouts);
		echo "Gouts : $gouts<br>";
		echo "caché : $val<br>";
		foreach ($pref as $val)
			echo $val.'<br/>';

		$fic1 = $_FILES['fichier']['name'];
		$fic2 = $_FILES['fichier']['type'];
		$fic3 = $_FILES['fichier']['size'];
		$fic4 = $_FILES['fichier']['tmp_name'];
		$fic5 = $_FILES['fichier']['error'];

		echo "fic1 : $fic1<br>";
		echo "fic2 : $fic2<br>";
		echo "fic3 : $fic3<br>";
		echo "fic4 : $fic4<br>";
		echo "fic5A : $fic5<br>";

		$result=move_uploaded_file($fic4,$fic1);
		if($result==TRUE)
		  echo "<hr /><big>Le  transfert est réalisé !</big>";
		else
		  echo "<hr /> Erreur de transfert n°",$fic5;

	}
}
if ($erreur == true)
{
	include ("util_chap9.php");
	include ("9_5.htm")	 ;
}
else{
	echo '<script>document.location="https://www.iutc3.unicaen.fr/c3"</script>';
}
?>
