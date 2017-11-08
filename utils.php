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

function remplirOptionPays($tab, $nbLignes, $ancienPays)
{
		$ancienPays = utf8_encode($ancienPays);
    for ($i=0; $i<$nbLignes; $i++) {
        $tab[$i]["NOM"] = utf8_encode($tab[$i]["NOM"]);
        if ($tab[$i]['NOM']==$ancienPays) {
            echo '<option value='.'1'.$tab[$i]['NOM'].' selected >'.$tab[$i]['NOM'];
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
    remplirOptionPays($tab, $nbLignes,$ancienPays);
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

function remplirType(){
	if (isset($_POST['type'])){
		switch ($_POST['type']) {
			case 'PME':
			echo '<option value="PME" selected> PME </option>';
			echo '<option value="Grand compte" > Grand compte </option>';
			echo '<option value="Administration" > Administration </option>';
			echo '<option value="Particulier" > Particulier </option>';
			break;
			case 'GrandCompte':
			echo '<option value="PME"  > PME </option>';
			echo '<option value="Grand compte"  selected> Grand compte </option>';
			echo '<option value="Administration" > Administration </option>';
			echo '<option value="Particulier"> Particulier </option>';
			break;
			case 'Particulier':
			echo '<option value="PME" > PME </option>';
			echo '<option value="Grand compte" > Grand compte </option>';
			echo '<option value="Administration"  > Administration </option>';
			echo '<option value="Particulier" selected> Particulier </option>';
			break;
			case 'Administration':
			echo '<option value="PME"> PME </option>';
			echo '<option value="Grand compte" > Grand compte </option>';
			echo '<option value="Administration" setected> Administration </option>';
			echo '<option value="Particulier" > Particulier </option>';
			break;
		}
	}
	else{
		echo '<option value="PME"  selected> PME </option>';
		echo '<option value="Grand compte" > Grand compte </option>';
		echo '<option value="Administration" > Administration </option>';
		echo '<option value="Particulier" selected> Particulier </option>';
	}
}
