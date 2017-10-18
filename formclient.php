<!--  E.Porcq	e95.php 20/09/2010 -->

<!-- maison : http://localhost:8082/support_php/prof/e95.php -->

<?php
include ('accesTable.php');
$conn = connect();


function remplirOption($tab, $nbLignes)
{
    for ($i=0; $i<$nbLignes; $i++) {
        $tab[$i]["NOM"] = utf8_encode($tab[$i]["NOM"]);
        if ($tab[$i]['NOM']=="FRANCE") {
            echo '<option value='.$tab[$i]['NOM'].' selected >'.$tab[$i]['NOM'];
        } else {
            echo '<option value='.$tab[$i]['NOM'].'>'.$tab[$i]['NOM'];
        }
        echo '</option>';
    }
}
function ListePays()
{
    $login = 'ETU2_53';
    $mdp = 'ETU2_53';
    $instance = 'spartacus.iutc3.unicaen.fr:1521/info.iutc3.unicaen.fr';
    // ce code ne doit pas être dans le <select> … </select>
    global $conn;
    $req = 'SELECT * FROM CDI_PAYS order by nom';
    $cur = PreparerRequete($conn, $req);
    $res = ExecuterRequete($cur);
    $nbLignes = LireDonnees1($cur, $tab); // Attention, pas &$tab
    if (!empty($_POST)) {
        if (isset($_POST['pays'])) {
            $cour = $_POST['pays'];
            echo ("Pays $cour sélectionné");
        }
    }
    remplirOption($tab, $nbLignes);
}
$erreur = true;
if (!empty($_POST )) {
//if ( isset ($_POST["nom"]) && isset($_POST["prenom"]) )
    $erreur = false;
    if (!empty($_POST['nom']) && $_POST['nom'] != "nom ?") {
        $nom = $_POST['nom'];
    } else {
        $erreur = true;
    }
    if (!empty($_POST['prenom']) && $_POST['prenom'] != "prenom") {
        $prenom = $_POST['prenom'] ;
    } else {
        $erreur = true;
    }
    if (!empty($_POST['localite']) && $_POST['localite'] != "ville") {
        $localite = $_POST['localite'] ;
    } else {
        $erreur = true;
    }
    if (isset($_POST['type'])) {
        $type = $_POST['type'];
    } else {
        $erreur = true;
    }
    if (isset($_POST['pays'])) {
        $pays = $_POST['pays'];
    } else {
        $erreur = true;
    }
    if ((!isset($_POST["CA"]) || empty($_POST["CA"])) || $_POST["type"] == "Particulier") {
        $ca = null;
    } elseif (!empty($_POST['CA'])) {
        $ca = $_POST["CA"];
    } else {
        $erreur = true;
    }

    if ($erreur == false) {
        include ('verifNom.php');

        $nom = verifAndConvert($nom);
        $prenom = verifAndConvert($prenom, true);
        $localite = verifAndConvert($localite);

        if ($nom != 1 && $prenom != 1 && $localite != 1 && verifChiffre($ca) == 0) {
          $req = "select cl_numero from cdi_client where cl_nom = '$nom' and cl_prenom='$prenom' and cl_localite = '$localite'";
          $cur = PreparerRequete($conn, $req);
          ExecuterRequete($cur);
          $nbLignes;
          $tab;
          $nbLignes = LireDonnees2($cur,$tab);
          if($nbLignes == 0){
            ajoutClient($nom, $prenom, $pays, $localite, $type, $ca);
            include ("formclient.htm");
            echo '<script>alert(Entrée dans la base réussie)</script>';
          }
          else{
            include ("formclient.htm");
            echo '<script>alert("Client déjà présent")</script>';
          }
        } else {
            //FermerConnexion($conn);
            $erreur = true;
            if ($nom == 1) {
                echo '<script>alert("Charactere interdit dans nom")</script>';
            } elseif ($prenom == 1) {
                echo '<script>alert("Charactere interdit dans prenom")</script>';
            } elseif ($localite != 1) {
                echo '<script>alert("Charactere interdit dans ville")</script>';
            } else {
                echo '<script>alert("Il ne peut y avoir que des nombres dans CA")</script>';
            }
        }
    }
}
if ($erreur == true) {
    include ("utils.php");
    include ("formclient.htm");
} else {
}
?>
