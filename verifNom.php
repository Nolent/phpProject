<?php
function verifTiret($nom)
{
    $motif = '/^-|-$/';
    $res1 = preg_match($motif, $nom);


    $motif = '/(--)([a-zA-Z]*)(--)/';
    $res2 = preg_match($motif, $nom);


    if ($res1 == 0 && $res2 == 0) {
        return 0;
    } else {
        return 1;
    }
}

function verifEspace($nom)
{
    $motif = '/^ | $/';
    return preg_match($motif, $nom);
}

function verifLettres($nom)
{
    $motif = '/[^a-zA-Z\- \'áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]/';
    return preg_match($motif, $nom);
}


function verifAll($nom)
{
    if (verifLettres($nom) == 0 && verifEspace($nom)==0 && verifTiret($nom)==0) {
        return 0;
    }
    return 1;
}
echo verifAll("ro-beé-rt");
