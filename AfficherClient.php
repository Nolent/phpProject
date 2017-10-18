<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Affichage client</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  </head>
  <body>
    <script	src="./javascript/javascript.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.29.0/js/jquery.tablesorter.js"> </script>



    <?php
    include 'accesTable.php';

    $conn = connect();

    $req = "select * from CDI_CLIENT order by cl_nom";
    $cur = PreparerRequete($conn, $req);
    ExecuterRequete($cur);
    $tab;
    $nbLigne = LireDonnees2($cur, $tab);
    AfficherDonnee1($tab, $nbLigne);
    ?>

    <script type="text/javascript">
      $(function(){
        $("#client").tablesorter();
      });
    </script>
  </body>
</html>
