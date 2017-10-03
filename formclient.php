<!--  E.Porcq	e95.php 20/09/2010 -->

<!-- maison : http://localhost:8082/support_php/prof/e95.php -->


<?php
include 'accesTable.php';
include 'verifNom.php';

function remplirOption($tab, $nbLignes)
{
    for ($i=0; $i<$nbLignes; $i++) {
        $tab[$i]["NOM"] = utf8_encode($tab[$i]["NOM"]);
        echo '<option value='.$tab[$i]['CODE_ISO'].'>'.$tab[$i]['NOM'];
        echo '</option>';
    }
}
function ListePays()
{
    global $conn;
    $req = 'SELECT * FROM CDI_PAYS order by nom';
    $cur = PreparerRequete($conn, $req);
    $res = ExecuterRequete($cur);
    $nbLignes = LireDonnees1($cur, $tab); // Attention, pas &$tab

    if (!empty($_POST)) {
        if (isset($_POST['coureur'])) {
            $cour = $_POST['coureur'];
            echo ("Pays $cour sélectionné");
        }
    }
    remplirOption($tab, $nbLignes);
}
$erreur = true;
if (!empty($_POST )) {
//if ( isset ($_POST["nom"]) && isset($_POST["prenom"]) )
    echo"<pre>";
    print_r($_POST);
    echo "</PRE>";
    echo "décodage sur le serveur <br />";

    $erreur = false;
    if (!empty($_POST['nom']) && $_POST['nom'] != "nom ?") {
        $nom = $_POST['nom'];
    } else {
        echo "le nom est vide <br />";
        $erreur = true;
    }
    if (!empty($_POST['prenom']) && $_POST['prenom'] != "prenom") {
        $prenom = $_POST['prenom'] ;
    } else {
        echo "le prénom est vide <br />";
        $erreur = true;
    }
    if (isset($_POST['localite'])) {
        $localite = $_POST['localite'] ;
    } else {
        echo "le mot de passe est vide <br />";
        $erreur = true;
    }
    if (isset($_POST['type'])) {
        $type = $_POST['type'];
    } else {
        echo "la civilité n'a pas été cochée <br />";
        $erreur = true;
    }
    if (isset($_POST['pays'])) {
        $pays = $_POST['pays'];
    } else {
        echo "le pays n'a pas été sélectionné <br />";
        $erreur = true;
    }

    if ($erreur == false) {
        echo "NOM : $nom <br />";
        echo "PRENOM : $prenom <br />";
        echo "PAYS : $pays <br />";
        echo "VILLE : $localite <br />";
        echo "TYPE : $type <br />";

        $tab = verifAndConvertAll($nom, $prenom, $localite);
        if ($tab['nom'] != 1 && $tab['prenom'] != 1 && $tab['localite'] !=1) {
            ajoutClient($tab['nom'], $tab['prenom'], $pays, $tab['localite'], $type );
        }
    }
}
FermerConnexion($conn);
if ($erreur == true) {
    include ("utils.php");
    include ("formclient.htm")   ;
} else {
    echo 'pas bon';
}
?>
