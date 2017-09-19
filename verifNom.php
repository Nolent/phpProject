<?php
function verifTiret($nom)
{
    $motif = "/^(\-)|-$|(--)[a-Z](--)/";
    $res = preg_match($motif, $nom);
    echo "$res";
    return $res;
}

verifTiret("-Robert");
