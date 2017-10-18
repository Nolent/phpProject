<?php
function verifTiretNom($nom)
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

function verifTiretPrenom($nom)
{
    if (verifTiretNom($nom) == 0) {
        if (preg_match('/--/', $nom) == 0) {
            return 0;
        }
    }return 1;
}

function verifApostropheDouble($nom)
{
    $motif = '/\'\'/';
    return preg_match($motif, $nom);
}

function ajoutApostrophe($nom)
{
    $nom = preg_replace('#\'#', '\'\'', $nom);
    return $nom;
}

function verifEspace($nom)
{
    $motif = '/^ | $|[a-zA-Z]  [a-zA-Z]/';
    return preg_match($motif, $nom);
}

function verifLettres($nom)
{
    $motif = '/[^a-zA-Z\- \'áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]/';
    //motif modifié a partir de https://www.developpez.net/forums/d1270761/webmasters-developpement-web/javascript-ajax-typescript-dart/javascript/regex-accents-espaces-caracteres-separation/
    return preg_match($motif, $nom);
}


function verifAllNom($nom)
{
    if (verifLettres($nom) == 0 && verifEspace($nom)==0 && verifTiretNom($nom)==0 && verifApostropheDouble($nom)==0) {
        return 0;
    }
    return 1;
}

function verifAllPrenom($nom)
{
    if (verifAllNom($nom)==0) {
        return verifTiretPrenom($nom);
    }return 1;
}

function convertAccent($nom)
{
    $url = $nom;
    $url = preg_replace('#Ç#', 'C', $url);
    $url = preg_replace('#ç#', 'c', $url);
    $url = preg_replace('#è|é|ê|ë#', 'e', $url);
    $url = preg_replace('#È|É|Ê|Ë#', 'E', $url);
    $url = preg_replace('#à|á|â|ã|ä|å#', 'a', $url);
    $url = preg_replace('#@|À|Á|Â|Ã|Ä|Å#', 'A', $url);    //recuperer ici : https://openclassrooms.com/forum/sujet/enlever-accents-des-caracteres-accentues
    $url = preg_replace('#ì|í|î|ï#', 'i', $url);
    $url = preg_replace('#Ì|Í|Î|Ï#', 'I', $url);
    $url = preg_replace('#ð|ò|ó|ô|õ|ö#', 'o', $url);
    $url = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'O', $url);
    $url = preg_replace('#ù|ú|û|ü#', 'u', $url);
    $url = preg_replace('#Ù|Ú|Û|Ü#', 'U', $url);
    $url = preg_replace('#ý|ÿ#', 'y', $url);
    $url = preg_replace('#Ý#', 'Y', $url);
    $url = preg_replace('#æ|Æ#', 'ae', $url);
    $url = preg_replace('#œ|Œ#', 'oe', $url);

    return $url;
}

function majuscule($nom)
{
    $nom = explode('-', $nom);

    for ($i=0; $i < count($nom); $i++) {
        $nom[$i] = convertAccent(mb_substr($nom[$i], 0, 1)).mb_substr($nom[$i], 1, null);
        $nom[$i] = strtoupper(mb_substr($nom[$i], 0, 1)).mb_substr($nom[$i], 1, null);
    }
    $nom = implode('-', $nom);

    return $nom;
}

function verifAndConvert($nom, $type = false) //true = prenom, false == nom de famille
{
    if ($type) {
        if (verifAllPrenom($nom)==0 && count($nom) < 25) {
            $nom = strtolower($nom);
            $nom = majuscule($nom);
            $nom = ajoutApostrophe($nom);
            return $nom;
        }
    } else {
        if (verifAllNom($nom)==0 && count($nom) < 25) {
            $nom = strtoupper(convertAccent($nom));
            return ajoutApostrophe($nom);
        }
    }
    return 1;
}

function verifAndConvertVille($nom)
{
    if (verifAllPrenom($nom) == 0) {
        $nom = verifAndConvert($nom);
        echo "$nom";
        if ($nom != 0) {
            echo "$nom";
            return $nom;
        }
    } return 1;
}
echo verifAndConvertVille('double--de');
function verifAndConvertAll($nom, $prenom, $localite)
{
    $tab = array();

    $tab['nom'] = verifAndConvert($nom);
    $tab['prenom'] = verifAndConvert($prenom, true);
    $tab['localite'] = verifAndConvertVille($localite);

    return $tab;
}

function verifChiffre($value)
{
    $motif = '/[^0-9]/';

    if (preg_match($motif, $value) != 0 || (intval($value)>=99999 || intval($value)<0 )) {
        return 1;
    }
    return 0;
}
