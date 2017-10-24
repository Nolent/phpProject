<!--  E.Porcq	e95.php 20/09/2010 -->

<!-- maison : http://localhost:8082/support_php/prof/e95.php -->

<?php
include ('accesTable.php');
include 'utils.php';
$conn = connect();

$erreur = true;
if (!empty($_POST )) {
//if ( isset ($_POST["nom"]) && isset($_POST["prenom"]) )
    $erreur = false;
    if (!empty($_POST['nom'])) {
        $nom = $_POST['nom'];
    } else {
        $erreur = true;
    }
    if (!empty($_POST['prenom'])) {
        $prenom = $_POST['prenom'] ;
    } else {
        $erreur = true;
    }
    if (!empty($_POST['localite'])) {
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
    if (!empty($_POST['nomBase'])) {
        $prenom = $_POST['nomBase'] ;
    } else {
        $erreur = true;
    }
    if (!empty($_POST['prenomBase'])) {
        $prenom = $_POST['prenomBase'] ;
    } else {
        $erreur = true;
    }
    if (!empty($_POST['localiteBase'])) {
        $prenom = $_POST['localiteBase'] ;
    } else {
        $erreur = true;
    }
    if ($erreur == false) {
        include ('verifNom.php');

        $nom = verifAndConvert($nom);
        $prenom = verifAndConvert($prenom, true);
        $localite = verifAndConvertVille($localite);
        $nomBase = verifAndConvert($nomBase);
        $prenomBase = verifAndConvert($prenomBase, true);
        $localiteBase = verifAndConvertVille($localiteBase);

        if ($nom != 1 && $prenom != 1 && $localite != 1 && verifChiffre($ca) == 0) {
<<<<<<< HEAD
            $req = "select cl_numero from cdi_client where cl_nom = '$nom' and cl_prenom='$prenom' and cl_localite = '$localite'";
            $cur = PreparerRequete($conn, $req);
            ExecuterRequete($cur);
            $nbLignes;
            $tab;
            $nbLignes = LireDonnees2($cur, $tab);
            if ($nbLignes == 0) {
                updateClient($nom, $prenom, $pays, $localite, $type, $ca);
                include ("modifClient.htm");
                echo '<script>alert("Modification réussie")</script>';
=======
            if ($nomBase != 1 && $prenomBase != 1 && $localiteBase != 1) {
                $req = "select cl_numero from cdi_client where cl_nom = '$nom' and cl_prenom='$prenom' and cl_localite = '$localite'";
                $cur = PreparerRequete($conn, $req);
                ExecuterRequete($cur);
                $nbLignes;
                $tab;
                $nbLignes = LireDonnees2($cur, $tab);
                if ($nbLignes == 0) {
                    updateClient($nom, $prenom, $pays, $localite, $type, $ca, $nomBase, $prenomBase, $localiteBase);
                    include ("modifClient.htm");
                    echo '<script>alert("Modification réussie")</script>';
                } else {
                    include ("modifClient.htm");
                    echo '<script>alert("Client déjà présent")</script>';
                }
>>>>>>> ba6421c8d56be3c3543c4dd20ad97fd3a0c25113
            } else {
                $erreur = true;
            }
        } else {
            $erreur = true;
            if ($tab['nom'] == 1) {
                echo '<script>alert("Charactere interdit dans nom")</script>';
            } elseif ($tab['prenom'] == 1) {
                echo '<script>alert("Charactere interdit dans prenom")</script>';
            } elseif ($localite == 1) {
                echo '<script>alert("Charactere interdit dans ville")</script>';
            } else {
                echo '<script>alert("Il ne peut y avoir que des nombres dans CA")</script>';
            }
        }
    }
}
if ($erreur == true) {
    include ("modifClient.htm");
} else {
}
