<!--  E.Porcq	util_chap9.php 20/09/2010 -->
<?php
function verifierText($n)
{
    if (!empty($_POST[$n])) {
        $var = $_POST[$n];
        if ($var <> "") {
            echo $var;
        }
    } else {
        echo "";
    }
}
function cocherRadio($civ, $n)
{
    if (isset($_POST[$civ])) {
        if ($_POST[$civ] == $n) {
            echo "checked";
        }
    }
}
function VerifierSelect($pa, $n)
{
    if (isset($_POST[$pa])) {
        if ($_POST[$pa] == $n) {
            echo "selected";
        }
    }
}
function cocherCase($pref, $n)
{
    if (isset($_POST[$pref])) {
        foreach ($_POST[$pref] as $val) {
            if ($n == $val) {
                echo "checked";
            }
        }
    }
}

function remplirOptionPays($tab, $nbLignes)
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
    //$login = 'ETU2_53';
    //$mdp = 'ETU2_53';
    //$instance = 'spartacus.iutc3.unicaen.fr:1521/info.iutc3.unicaen.fr';
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
    remplirOptionPays($tab, $nbLignes);
}

function ListeClient()
{
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
