<?php

$id = 'Q7744';
$link = "https://www.wikidata.org/wiki/Special:EntityData/" . $id . ".json";
$objet = json_decode(file_get_contents($link));
$objetV2 = $objet->entities->$id->claims;
//print_r($objet);


function getLabelById($Identifiant)
{

    $link = "https://www.wikidata.org/wiki/Special:EntityData/" . $Identifiant . ".json";
    $objet = json_decode(file_get_contents($link));
    return $objet->entities->$Identifiant->labels->fr->value;
}


//_________________Avoir l'image_____________________
if (isset($objetV2->P18[0]->mainsnak->datavalue->value)) {
    $filename = ($objetV2->P18[0]->mainsnak->datavalue->value);
    $safeFilename = str_replace(" ", "_", $filename);
    $md5SafeFilename = md5($safeFilename);
    $filenameForUpload = "https://upload.wikimedia.org/wikipedia/commons/" . substr($md5SafeFilename, 0, 1) . "/" . substr($md5SafeFilename, 0, 2) . "/" . $safeFilename;
} else {
    echo "Aucune image n'existe pour ce marker";
    //Donner une image avec une croix
}
//echo "<img height=200px width = auto src='".$filenameForUpload."' >";


//_________________Avoir le nom_____________________

if (isset($objetV2->P1559[0]->mainsnak->datavalue->value->text)) {
    $nameInOriginalState = $objetV2->P1559[0]->mainsnak->datavalue->value->text;
} else {
    $nameInOriginalState = "Le nom de cette personne n'est pas défini";
}
//print_r("\nNom : ".$nameInOriginalState);


//_________________Avoir la date de naissance + lieu_____________________
if (isset($objetV2->P569[0]->mainsnak->datavalue->value->time)) {
    $dateOfBirth = (date('d-m-Y ', strtotime($objetV2->P569[0]->mainsnak->datavalue->value->time)));
} else {
    $dateOfBirth = "La date de naissance est inconnu";
}
if (isset($objetV2->P19[0]->mainsnak->datavalue->value->id)) {
    $birthPlaceID = ($objetV2->P19[0]->mainsnak->datavalue->value->id);
    $birthPlace = getLabelById($birthPlaceID);
} else {
    $birthPlace = "L'endroit de naissance est inconnu";
}
//print_r("\nLieu de naissance : ".$birthPlace);


//__________________Avoir la date de mort + lieu_____________________
if (isset($objetV2->P570[0]->mainsnak->datavalue->value->time)) {
    $dateOfDeath = (date('d-m-Y ', strtotime($objetV2->P570[0]->mainsnak->datavalue->value->time)));
} else {
    $dateOfDeath = "La date de décès est inconnu";
}

if (isset($objetV2->P20[0]->mainsnak->datavalue->value->id)) {
    $deathPlace = getLabelById($objetV2->P20[0]->mainsnak->datavalue->value->id);
//print_r("\nLieu de décès : ".$deathPlace);
} else {
    $deathPlace = "L'endroit du décès est inconnu";
}
//_________________description_____________________

print_r("<br/>Nom : {$nameInOriginalState}");
echo "<br/><img height=200px width = auto src='" . $filenameForUpload . "' >";
print_r("<br/>Née le:{$dateOfBirth}");
print_r("<br/>Lieu de naissance : " . $birthPlace);
print_r("<br/>Décédé le:{$dateOfDeath}");
print_r("<br/>Lieu de décès : {$deathPlace}");