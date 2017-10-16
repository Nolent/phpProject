<!--  E.Porcq	16a.php 26/09/2009 maj 5/08/2017 Liste déroulante dynamique avec oci-->
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Essais de redirection</title>
</head>
<body>
  <div>
    <?php
    include ("fonc_oracle.php");
    $login = 'ETU2_53';
    $mdp = 'ETU2_53';
    $instance = 'spartacus.iutc3.unicaen.fr:1521/info.iutc3.unicaen.fr';
    // ce code ne doit pas être dans le <select> … </select>
    $conn = OuvrirConnexion($login, $mdp,$instance);
    $req = 'SELECT * FROM CDI_PAYS order by nom';
    $cur = PreparerRequete($conn,$req);
    $res = ExecuterRequete($cur);
    $nbLignes = LireDonnees1($cur,$tab); // Attention, pas &$tab
    FermerConnexion($conn);
    if (!empty($_POST))
    {
      if (isset($_POST['coureur']))
      {
        $cour = $_POST['coureur'];
        echo ("Pays $cour sélectionné");
      }
    }
    else
    include ("testd.htm");
    ?>
  </div>
  <div>
    <?php
    $nom = "Culé";
    $prenom = "Rolland";
    $pays = "FRANCE";
    $localite = "Caen";
    $type = "Administrateur";
    $login = 'ETU2_53';
    $mdp = 'ETU2_53';
    $instance = 'spartacus.iutc3.unicaen.fr:1521/info.iutc3.unicaen.fr';
    // ce code ne doit pas être dans le <select> … </select>
    $conn = OuvrirConnexion($login, $mdp,$instance);
    $req = "select * from CDI_CLIENT";
    $cur = PreparerRequete($conn, $req);
    ExecuterRequete($cur);
    $tab;
    $nbClient = LireDonnees2($cur, $tab);
    echo "nombre de clients : ".$nbClient."</br>";
    $nbClient++;
    if (isset($ca)) {
      $req = "insert into CDI_CLIENT (cl_numero,cl_nom,cl_prenom,cl_pays,cl_localite,cl_ca,cl_type) values ('C$nbClient','$nom','$prenom','$pays','$localite',$ca,'$type')";
      echo "ca definie";
    } else {
      $req = "insert into CDI_CLIENT (cl_numero,cl_nom,cl_prenom,cl_pays,cl_localite,cl_type) values ('C$nbClient','$nom','$prenom','$pays','$localite' ,'$type')";
      echo "ca non définie";
    }
    $cur = PreparerRequete($conn, $req);
    ExecuterRequete($cur);
    $req = "commit";
    $cur = PreparerRequete($conn, $req);
    ExecuterRequete($cur);

    FermerConnexion($conn);
    ?>
  </div>
</body>
</html>

<!-- on peut sélectionner un nom est récupérer le numéro du coureur -->
