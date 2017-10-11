<?php
// E.Porcq  fonc_oracle.php  12/10/2009 maj du 11/10/2016

/* Exemple
$conn = OuvrirConnexion('ETU000', 'ETU000','info');
*/

//---------------------------------------------------------------------------------------------
function OuvrirConnexion($session, $mdp, $instance)
{
  //$conn = @oci_connect($session, $mdp,$instance); // @ évite l'affichage du message d'erreur
  //$conn = oci_connect($session, $mdp, $instance, "WE8ISO8859P15"); // @ évite l'affichage du message d'erreur
    $conn = oci_connect($session, $mdp, $instance, "AL32UTF8");
    if (!$conn) { //si pas de connexion retourne une erreur
        $e = oci_error();
        exit;
    }
    return $conn;
}
//---------------------------------------------------------------------------------------------
function OuvrirConnexion2($session, $mdp, $instance)
{
    $conn = @oci_connect($session, $mdp, $instance);
    if (!$conn) { //si pas de connexion retourne une erreur
        $e = oci_error();
        //avec un message pour pouvoir revenir à la page de connexion
        echo "<br>Votre nom d'utilisateur ou votre mot de passe est &eacute;ronn&eacute;e, veuillez vous reconnecter...<br>";
        echo "<form action = 'p1202_1.htm' method='post' enctype='application/x-www-form-urlencoded'>
				<input type='submit' value='Retour'>
		  </form>";
        exit;
    }
    return $conn;
}
//---------------------------------------------------------------------------------------------
function PreparerRequete($conn, $req)
{
    $cur = oci_parse($conn, $req);

    if (!$cur) {
        $e = oci_error($conn);
        print htmlentities($e['message']);
        exit;
    }
    return $cur;
}
//---------------------------------------------------------------------------------------------
function ExecuterRequete($cur)
{
    $r = oci_execute($cur, OCI_DEFAULT);
  //echo "<br>résultat de la requête: $r<br />";
    if (!$r) {
        $e = oci_error($r);
        echo htmlentities($e['message']);
        exit;
    }
    return $r;
}
//---------------------------------------------------------------------------------------------
function FermerConnexion($conn)
{
    oci_close($conn);
}
//---------------------------------------------------------------------------------------------
function LireDonnees1($cur, &$tab)
{
    $nbLignes = oci_fetch_all($cur, $tab, 0, -1, OCI_FETCHSTATEMENT_BY_ROW|OCI_ASSOC); //OCI_FETCHSTATEMENT_BY_ROW, OCI_ASSOC, OCI_NUM
    //$nbLignes = oci_fetch_all($cur, $tab, 0, -1, OCI_FETCHSTATEMENT_BY_COLUMN|OCI_ASSOC); //OCI_FETCHSTATEMENT_BY_ROW, OCI_ASSOC, OCI_NUM
    //$nbLignes = oci_fetch_all($cur, $tab,0,-1,OCI_FETCHSTATEMENT_BY_ROW|OCI_NUM); //OCI_FETCHSTATEMENT_BY_ROW, OCI_ASSOC, OCI_NUM
    //$nbLignes = oci_fetch_all($cur, $tab,0,-1,OCI_FETCHSTATEMENT_BY_COLUMN|OCI_NUM); //OCI_FETCHSTATEMENT_BY_ROW, OCI_ASSOC, OCI_NUM
    return $nbLignes;
}
//---------------------------------------------------------------------------------------------
function LireDonnees2($cur, &$tab)
{
    $nbLignes = oci_fetch_all($cur, $tab, 0, -1, OCI_FETCHSTATEMENT_BY_COLUMN|OCI_ASSOC);
    return $nbLignes;
}
//---------------------------------------------------------------------------------------------
function LireDonnees3($cur, &$tab)
{
    $nbLignes = 0;
    $i=0;
    while ($row = oci_fetch ($cur)) {
        $tab[$nbLignes][$i] = oci_result($cur, 'VAL'); // respecter la casse
        $tab[$nbLignes][$i+1] = oci_result($cur, 'TYPE');
        $tab[$nbLignes][$i+2] = oci_result($cur, 'COULEUR');
        $nbLignes++;
    }
    return $nbLignes;
}
//---------------------------------------------------------------------------------------------
// fonctions autres
function AfficherDonnee1($tab, $nbLignes)
{
    if ($nbLignes > 0) {
        echo '<table border=\"1\" id="client" class="tablesorter">';
        echo '<thead> <tr class ="tablesorter-headerRow">';
        foreach ($tab as $key => $val) {  // lecture des noms de colonnes
            echo "<th>$key</th>\n";
        }
        echo "</tr> </thead> \n";
        echo '<tbody>';
        for ($i = 0; $i < $nbLignes; $i++) { // balayage de toutes les lignes
            echo "<tr>\n";
            foreach ($tab as $data) { // lecture des enregistrements de chaque colonne
                echo "<td>$data[$i]</td>\n";
            }
            echo "</tr>\n";
        }
        echo "</tbody> </table>\n";
    } else {
        echo "Pas de ligne<br />\n";
    }
    echo "$nbLignes Lignes lues<br />\n";
}
//---------------------------------------------------------------------------------------------
function AfficherDonnee2($tab)
{
    foreach ($tab as $ligne) {
        foreach ($ligne as $valeur) {
            echo $valeur." ";
        }
        echo "<br/>";
    }
}
//---------------------------------------------------------------------------------------------
function AfficherDonnee3($tab, $nb)
{
    for ($i=0; $i<$nb; $i++) {
        echo $tab[$i][0]." ".$tab[$i][1]." ".$tab[$i][2]."\n";
    }
}
//---------------------------------------------------------------------------------------------
function AfficherTab($tab)
{
    print_r($tab);
}
//---------------------------------------------------------------------------------------------
function CompterNbLigne($cur){
    return oci_num_rows($cur);
}
?>
