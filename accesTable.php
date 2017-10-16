<?php
require 'fonc_oracle.php';

$login = 'ETU2_53';
$mdp = 'ETU2_53';
$instance = 'spartacus.iutc3.unicaen.fr:1521/info.iutc3.unicaen.fr';
// ce code ne doit pas être dans le <select> … </select>
$conn = OuvrirConnexion($login, $mdp, $instance);


function ajoutClient($nom, $prenom, $pays, $localite, $type, $ca)
{
    global $conn;
    //select * from cdi_client;insert into cdi_client(cl_numero,cl_nom,cl_prenom,cl_pays,cl_localite,cm_ca,cl_type) values (select concat("C",count(*)) as nbClient from cdi_client,"MICHEL","michel","F","PARIS",null,"Particulier");
    $req = "select * from CDI_CLIENT";
    $cur = PreparerRequete($conn, $req);
    ExecuterRequete($cur);
    $tab;
    $nbClient = LireDonnees2($cur, $tab);
    echo "nombre de clients : ".$nbClient."</br>";
    $nbClient++;
    if (isset($ca)) {
      $req = "insert into CDI_CLIENT (cl_numero,cl_nom,cl_prenom,cl_pays,cl_localite,cl_ca,cl_type) values ('$nbClient','$nom','$prenom','$pays','$localite',$ca,'$type')";
      echo "ca definie";
    } else {
      $req = "insert into CDI_CLIENT (cl_numero,cl_nom,cl_prenom,cl_pays,cl_localite,cl_type) values ('$nbClient','$nom','$prenom','$pays','$localite' ,'$type')";
      echo "ca non définie";
    }
    $cur = PreparerRequete($conn, $req);
    ExecuterRequete($cur);
    $req = "commit";
    $cur = PreparerRequete($conn, $req);
    ExecuterRequete($cur);
}
