<?php 

if()
$donneesVolJSON = file_get_contents("php://input");
echo $donneesVolJSON;
$donneesVolAssoc = json_decode($donneesVolJSON, true);
echo $donneesVolAssoc["donneesVol"]["nom"];
echo "`\n";
echo $donneesVolAssoc["donneesVol"]["numero"];
?>