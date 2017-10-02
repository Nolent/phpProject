<!--  E.Porcq	e95.php 20/09/2010 -->

<!-- maison : http://localhost:8082/support_php/prof/e95.php -->

<?php
function remplirOption($tab,$nbLignes)
{
	for ($i=0;$i<$nbLignes;$i++)
	{
		$tab[$i]["NOM"] = utf8_encode($tab[$i]["NOM"]);
		echo '<option value='.$tab[$i]['CODE_ISO'].'>'.$tab[$i]['NOM'];
		echo '</option>';
	}
}
function ListePays()
{
	include ("fonc_oracle.php");
	$login = 'ETU2_53';
	$mdp = 'ETU2_53';
	$instance = 'spartacus.iutc3.unicaen.fr:1521/info.iutc3.unicaen.fr';
	// ce code ne doit pas être dans le <select> … </select>
	$conn = OuvrirConnexion($login, $mdp,$instance);
	$req = 'SELECT * FROM CDI_PAYS order by nom';
	$cur = PreparerRequete($conn,$req);
	$res = ExecuterRequete($cur);
	$nbLignes = LireDonnees1($cur,$tab); // Attention, pas &$tab
	FermerConnexion($conn);
	if (!empty($_POST))
	{
		if (isset($_POST['coureur']))
		{
			$cour = $_POST['coureur'];
			echo ("Pays $cour sélectionné");
		}
	}
	remplirOption($tab,$nbLignes);
}
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
	if (!empty($_POST['prenom']) && $_POST['prenom'] != "prenom")
	$prenom = $_POST['prenom'] ;
	else
	{
		echo "le prénom est vide <br />";
		$erreur = true;
	}
	if (isset($_POST['localite']))
	$localite = $_POST['localite'] ;
	else
	{
		echo "le mot de passe est vide <br />";
		$erreur = true;
	}
	if (isset($_POST['type']) )
	$type = $_POST['type'];
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

	if ($erreur == false)
	{
		echo "NOM : $nom <br />";
		echo "PRENOM : $prenom <br />";
		echo "PAYS : $pays <br />";
		echo "VILLE : $localite <br />";
		echo "TYPE : $type <br />";

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
	include ("utils.php");
	include ("formclient.htm")	 ;
}
else{
	echo 'pas bon';
}
?>
