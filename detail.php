<?php

session_start();

$projet = $_SESSION['projets'];

$index = $_POST['detail'];

$projetselect = $projet[$index];

$nombre = count($projetselect['Activités']);

echo "<h2>" . $projetselect['nom'] . "</h2>" . "description: " . $projetselect['description'] . "<br>";
echo "<B><U>Nombre d'activités: </B></U>" . $nombre;
echo "<h3>Activités: </h3><ul>";

foreach ($projetselect['Activités'] as $pro) {
    echo " <li>Nom: " . $pro['nom'] . "<br>" . "Description: "  . $pro['Description'] . "<br> Date: " . $pro['date'] . "</li>";
}

echo "</ul>";
echo "<h3>Partenaire : </h3>";
foreach ($projetselect['partenaires'] as $partenaire) {
    echo " " . $partenaire . "<br>";
}
