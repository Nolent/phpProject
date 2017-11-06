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
        if ($type == "GrandCompte") {
          $type = "Grand compte";
        }
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

    $nomBase = $_POST['nomBase'];
    $prenomBase = $_POST['prenomBase'];
    $localiteBase = $_POST['localiteBase'];
    echo $nomBase.$prenomBase.$localiteBase;

    if (isset($_POST['EN'])){
      if ($erreur == false) {
        include ('verifNom.php');
        $nom = verifAndConvert($nom);
        $prenom = verifAndConvert($prenom, true);
        $localite = verifAndConvertVille($localite);

        if ($nom != 1 && $prenom != 1 && $localite != 1 && verifChiffre($ca) == 0) {
          if(updateClient($nom, $prenom, $pays, $localite, $type, $ca, $nomBase, $prenomBase, $localiteBase) == 0){
            echo '<script>alert("Client deja present")</script>';
          }else echo '<script>alert("Modification reussie")</script>';
          include ("modifClient.htm");
        } else {
          $erreur = true;
          if ($nom == 1) {
            echo '<script>alert("Charactere interdit dans nom")</script>';
          } elseif ($prenom == 1) {
            echo '<script>alert("Charactere interdit dans prenom")</script>';
          } elseif ($localite == 1) {
            echo '<script>alert("Charactere interdit dans ville")</script>';
          } else {
            echo '<script>alert("Il ne peut y avoir que des nombres dans CA")</script>';
          }
        }
      }
    } else if(isset($_POST['SU'])){
      if ($erreur == false) {
        include ('verifNom.php');
        $nomBase = verifAndConvert($nomBase);
        $prenomBase = verifAndConvert($prenomBase, true);
        $localiteBase = verifAndConvertVille($localiteBase);

        if ($nomBase != 1 && $prenomBase != 1 && $localiteBase != 1){
          supprClient($nomBase, $prenomBase, $localiteBase);
          include ("modifClient.htm");
        } else {
          $erreur = true;
          if ($nom == 1) {
            echo '<script>alert("Charactere interdit dans nom")</script>';
          } elseif ($prenom == 1) {
            echo '<script>alert("Charactere interdit dans prenom")</script>';
          } elseif ($localite == 1) {
            echo '<script>alert("Charactere interdit dans ville")</script>';
          } else {
            echo '<script>alert("Il ne peut y avoir que des nombres dans CA")</script>';
          }
        }
      }
    }

}
if ($erreur == true) {
    include ("modifClient.htm");
}
