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

}
