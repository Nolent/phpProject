<?php
require 'fonc_oracle.php';


// ce code ne doit pas être dans le <select> … </select>

function connect()
{
    $login = 'ETU2_53';
    $mdp = 'ETU2_53';
    $instance = 'spartacus.iutc3.unicaen.fr:1521/info.iutc3.unicaen.fr';
    return OuvrirConnexion($login, $mdp, $instance);
}

function ajoutClient($nom, $prenom, $pays, $localite, $type, $ca)
{
    global $conn;
    //select * from cdi_client;insert into cdi_client(cl_numero,cl_nom,cl_prenom,cl_pays,cl_localite,cm_ca,cl_type) values (select concat("C",count(*)) as nbClient from cdi_client,"MICHEL","michel","F","PARIS",null,"Particulier");
    $req = "select 'C'||to_char(max(to_number(substr(cl_numero,2)))+1) from cdi_client";
    $cur = PreparerRequete($conn, $req);
    ExecuterRequete($cur);
    $tab;
    $nbLigne = LireDonnees2($cur, $tab);
    $nbClient = LireCle($tab, $nbLigne);
    if (isset($ca)) {
        $req = "insert into CDI_CLIENT (cl_numero,cl_nom,cl_prenom,cl_pays,cl_localite,cl_ca,cl_type) values ('$nbClient[0]','$nom','$prenom','$pays','$localite',$ca,'$type')";
    } else {
        $req = "insert into CDI_CLIENT (cl_numero,cl_nom,cl_prenom,cl_pays,cl_localite,cl_type) values ('$nbClient[0]','$nom','$prenom','$pays','$localite' ,'$type')";
    }
    $cur = PreparerRequete($conn, $req);
    ExecuterRequete($cur);
    $req = "commit";
    $cur = PreparerRequete($conn, $req);
    ExecuterRequete($cur);
}

function updateClient($nom, $prenom, $pays, $localite, $type, $ca, $nomBase, $prenomBase, $localiteBase)
{
    global $conn;
    //select * from cdi_client;insert into cdi_client(cl_numero,cl_nom,cl_prenom,cl_pays,cl_localite,cm_ca,cl_type) values (select concat("C",count(*)) as nbClient from cdi_client,"MICHEL","michel","F","PARIS",null,"Particulier");
    if (isset($ca)) {
    $req = "update CDI_CLIENT set cl_nom = '$nom', cl_prenom = '$prenom', cl_pays = '$pays', cl_localite = '$localite', cl_type = '$type', cl_ca = $ca where cl_numero = (select cl_numero from cdi_client where cl_nom = '$nomBase' and cl_prenom = '$prenomBase' and cl_localite='$localiteBase')";
  }
  else{
    $req = "update CDI_CLIENT set cl_nom = '$nom', cl_prenom = '$prenom', cl_pays = '$pays', cl_localite = '$localite', cl_type = '$type', cl_ca = null where cl_numero = (select cl_numero from cdi_client where cl_nom = '$nomBase' and cl_prenom = '$prenomBase' and cl_localite='$localiteBase')";
  }
    $cur = PreparerRequete($conn, $req);
    ExecuterRequete($cur);
    $req = "select * from cdi_client where cl_prenom = '$prenom' and cl_nom = '$nom' and cl_localite = '$localite'";
    $cur = PreparerRequete($conn, $req);
    ExecuterRequete($cur);
    $tab;
    $nbLigne = LireDonnees2($cur, $tab);
    if ($nbLigne > 1) {
      return 0;
    }else {
      $req = "commit";
      $cur = PreparerRequete($conn, $req);
      ExecuterRequete($cur);
      return 1;
    }
}

function supprClient($nom, $prenom, $localite){
  global $conn;
  $req = "delete from cdi_client where cl_nom = '$nom' and cl_prenom = '$prenom' and cl_localite = '$localite' ";
  $cur = PreparerRequete($conn, $req);
  ExecuterRequete($cur);
  $tab;
  $req = "commit";
  $cur = PreparerRequete($conn, $req);
  ExecuterRequete($cur);
}
