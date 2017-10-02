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
        return preg_match('/--/', $nom);
    }return 1;
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
    if (verifLettres($nom) == 0 && verifEspace($nom)==0 && verifTiretNom($nom)==0) {
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

    return $url;
}

function verifAndConvert($nom, $type = false) //true = prenom, false == nom de famille
{
    if ($type) {
        if (verifAllPrenom($nom)==0) {
            $nom = strtolower(convertAccent($nom));
            $nom[0] = strtoupper($nom[0]);
            return $nom;
        }
    } else {
        if (verifAllNom($nom)==0) {
            return strtoupper(convertAccent($nom));
        }
    }
    return 1;
}
