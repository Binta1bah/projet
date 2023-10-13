<?php

session_start();

$projet = array(
    array(
        'nom' => 'Projet1', 'description' => 'Desc P1', 'Activités' => array(
            array('nom' => 'Activite_A', 'Description' => 'Desc Act_A', 'date' => '01-01-2023'),
            array('nom' => 'Activité_B', 'Description' => 'Desc Act_B', 'date' => '02-02-2023'),
            array('nom' => 'Activite_C', 'Description' => 'Desc Act_C', 'date' => '03-03-2023')

        ),
        'partenaires' => array('Bouh', 'Pape')

    ),


    array(
        'nom' => 'Projet2', 'description' => 'Desc P2', 'Activités' => array(
            array('nom' => 'Activite_W', 'Description' => 'Desc Act_W', 'date' => '04-04-2023'),
            array('nom' => 'Activité_X', 'Description' => 'Desc Act_X', 'date' => '05-05-2023')

        ),
        'partenaires' => array('Bouh', 'Pape')
    ),


    array(
        'nom' => 'Projet3', 'description' => 'Desc P3', 'Activités' => array(
            array('nom' => 'Activite_E', 'Description' => 'Desc Act_E', 'date' => '06-06-2023')
        ),
        'partenaires' => array('Bouh', 'Pape')
    ),

    array(
        'nom' => 'Projet4', 'description' => 'Desc P3', 'Activités' => array(
            array('nom' => 'Activite_F', 'Description' => 'Desc Act_F', 'date' => '07-07-2023'),
            array('nom' => 'Activité_G', 'Description' => 'Desc Act_G', 'date' => '08-08-2023'),
            array('nom' => 'Activite_H', 'Description' => 'Desc Act_H', 'date' => '09-09-2023'),
            array('nom' => 'Activité_I', 'Description' => 'Desc Act_I', 'date' => '10-10-2023')
        ),
        'partenaires' => array('Bouh', 'Pape')
    ),

);

if (!isset($_SESSION['projets'])) {
    $_SESSION['projets'] = $projet;
}

$projet = $_SESSION['projets'];


if (isset($_POST['ajouter'])) {

    $proj = $_POST['projet'];
    $nomact = $_POST['activite'];
    $descact = $_POST['desc'];
    $dateact = $_POST['date'];

    if ($proj == '' || $nomact == '' || $descact == '' || $dateact == '') {
        echo "Tous les champs sont obligatoire";
    } else {



        for ($i = 0; $i < count($projet); $i++) {
            if ($projet[$i]['nom'] == $proj) {
                $projet[$i]['Activités'][] = ['nom' => $nomact, 'Description' => $descact, 'date' => $dateact];
            }
        }
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="" method="post">
        <label for="">Selectionnez un projet </label>
        <select name="projet" id="projet">
            <?php foreach ($projet as $p) { ?>
                <option value="<?= $p['nom'] ?>"><?= $p['nom'] ?></option><?php } ?>
        </select><br><br>

        <label for="">Nom activité: </label>
        <input type="text" name="activite"><br><br>
        <label for="">Description: </label>
        <input type="text" name="desc"><br><br>
        <label for="">Date: </label>
        <input type="date" name="date"><br><br>
        <input type="submit" name="ajouter" value="Ajouter"><br><br>
    </form>

</body>

</html>


<?php




for ($i = 0; $i < count($projet); $i++) {
    $projet[$i]['nombre_activites'] = count($projet[$i]['Activités']);
}


for ($i = 0; $i < count($projet) - 1; $i++) {
    for ($j = 0; $j < count($projet) - $i - 1; $j++) {
        if ($projet[$j]['nombre_activites'] < $projet[$j + 1]['nombre_activites']) {
            // Échange des positions
            $temp = $projet[$j];
            $projet[$j] = $projet[$j + 1];
            $projet[$j + 1] = $temp;
        }
    }
}

for ($i = 0; $i < count($projet); $i++) {
    $nombre = count($projet[$i]['Activités']);

    echo "<h2>Nom projet:" . $projet[$i]['nom'] . "</h2><br>" . "description: " . $projet[$i]['description'] . "<br>";
    echo "<h3>Activités: </h3><ul>";
    echo "Nombre d'activités: " . $nombre;
    foreach ($projet[$i]['Activités'] as $pro) {
        echo " <li>Nom: " . $pro['nom'] . "<br>" . "Description: "  . $pro['Description'] . "<br> Date: " . $pro['date'] . "<br></li>";
    }

    // foreach ($projet[$i]['partenaires'] as $partenaire) {
    //     echo "Partenaire : " . $partenaire . "<br>";
    // }


    echo "</ul><br>";

    echo "<form action = 'detail.php' method = 'post' >";

    echo "<input type = 'hidden' name = 'detail' value = '$i'>";

    echo "<input type = 'submit'  value = 'Voir plus'  > <br>";

    echo "</form>";

    echo "<br>";

    $_SESSION['projets'] = $projet;
}


?>