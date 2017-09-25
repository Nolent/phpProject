<?php
function verifTiret($nom)
{
    $motif = "/^-|-$/";
    $res1 = preg_match($motif, $nom);
    echo "res1 =$res1 <br/>";

    $motif = "/(--)*(--)/";
    $res2 = preg_match($motif, $nom);
    echo "res2 = $res2 <br />";
}

verifTiret("Robert");
