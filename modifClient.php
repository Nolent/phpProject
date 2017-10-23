
<?php

function remplirOption($tab, $nbLignes)
{
    for ($i=0; $i<$nbLignes; $i++) {
        $tab[$i]["CL_NOM"] = utf8_encode($tab[$i]["CL_NOM"]);
        if ($tab[$i]['CL_NOM']=="FRANCE") {
            echo '<option value='.$tab[$i]['NOM'].' selected >'.$tab[$i]['NOM'];
        } else {
            echo '<option value='.$tab[$i]['NOM'].'>'.$tab[$i]['NOM'];
        }
        echo '</option>';
    }
}

function ListeClient()
{
    $login = 'ETU2_53';
    $mdp = 'ETU2_53';
    $instance = 'spartacus.iutc3.unicaen.fr:1521/info.iutc3.unicaen.fr';
    // ce code ne doit pas être dans le <select> … </select>
    global $conn;
    $req = 'SELECT * FROM CDI_CLIENT order by cl_nom';
    $cur = PreparerRequete($conn, $req);
    $res = ExecuterRequete($cur);
    $nbLignes = LireDonnees1($cur, $tab); // Attention, pas &$tab
    if (!empty($_POST)) {
        if (isset($_POST[''])) {
            $cour = $_POST[''];
            echo ("Client $cour sélectionné");
        }
    }
    remplirOption($tab, $nbLignes);
}
