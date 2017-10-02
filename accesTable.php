<?php
require 'fonc_oracle.php';


function ajoutClient($nom, $prenom, $pays, $localite, $type, $emp_enum, $ca = null)
{
    $conn = OuvrirConnexion('ETU2_53', 'ETU2_53', 'spartacus.iutc3.unicaen.fr');
    $req = "insert into CDI_CLIENT value (count(*),$nom,$prenom,$pays,$localite,$ca,$type, $emp_enum)";
    $cur = PreparerRequete($conn, $req);
    $res = ExecuterRequete($cur);
}
