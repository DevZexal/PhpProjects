<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GradeApp</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="bg-white">

<div class="container mt-5">

<h1 class="mb-4">Calcola la media voti</h1>

<!-- FORM FILTRI -->
<form method="post" class="row g-3 mb-4" action="GradeApp.php">
    <div class="col-md-4">
        <label for="cognome" class="form-label">Cognome</label>
        <input type="text" name="cognome" id="cognome" class="form-control"
               placeholder="Inserisci il cognome"
               value="<?php echo getInput('cognome'); ?>">
    </div>

    <div class="col-md-4">
        <label for="classe" class="form-label">Classe</label>
        <input type="text" name="classe" id="classe" class="form-control"
               placeholder="Es. 3BIT"
               value="<?php echo getInput('classe') ?>">
    </div>

    <div class="col-md-4">
        <label for="materia" class="form-label">Materia</label>
        <input type="text" name="materia" id="materia" class="form-control"
               placeholder="Es. Matematica"
               value="<?php echo getInput('materia'); ?>">
    </div>

    <div class="col-12 text-end">
        <button type="submit" class="btn btn-primary">Calcola media</button>
        <a href="GradeApp.php" class="btn btn-secondary">Reset</a>
    </div>
</form>

    <?php

    function getInput($name){
        return isset($_POST[$name]) ? $_POST[$name] : null;
    }

    function calcolaMedie($cognome = null, $classe = null, $materia = null){
        $file = file("random-grades.csv");

        $voti = [];

        // Raggruppa i voti filtrati
        for($i = 1; $i < count($file); $i++){
            $riga = str_getcsv($file[$i], ",", '"', "\\");

            if ($cognome && $cognome !== "" && $cognome != $riga[0]) continue;
            if ($classe  && $classe !== ""  && $classe != $riga[2]) continue;
            if ($materia && $materia !== "" && $materia != $riga[3]) continue;

            $studente = $riga[0];
            $materiaRiga = $riga[3];
            $voto = (float)$riga[5];

            $voti[$studente][$materiaRiga][] = $voto;
        }

        return $voti;
    }


    $cognome = $_POST["cognome"] ?? null;
    $classe  = $_POST["classe"] ?? null;
    $materia = $_POST["materia"] ?? null;

    $voti = [];

    if($cognome || $classe || $materia){
        $voti = calcolaMedie($cognome, $classe, $materia);

        if(empty($voti)){
            echo "<div class='alert alert-warning'>Nessun dato trovato.</div>";
        } else {

            if($classe && !$cognome){
                echo "<h3 class='mt-4'>Tabella classe: <strong>$classe</strong></h3>";

                // Trova tutte le materie presenti nella classe
                $tutteMaterie = [];
                foreach($voti as $studente => $materie){
                    foreach(array_keys($materie) as $m){
                        $tutteMaterie[$m] = true;
                    }
                }
                $tutteMaterie = array_keys($tutteMaterie);

                echo "<table class='table table-bordered text-center'>";
                echo "<thead><tr><th>Studente</th>";

                foreach($tutteMaterie as $m){
                    echo "<th>$m</th>";
                }
                echo "<th>Media Generale</th></tr></thead><tbody>";

                // Righe studenti
                foreach($voti as $studente => $materie){
                    echo "<tr><td><strong>$studente</strong></td>";

                    $somma = 0; $count = 0;
                    foreach($tutteMaterie as $m){
                        if(isset($materie[$m])){
                            $mediaMateria = array_sum($materie[$m]) / count($materie[$m]);
                            echo "<td>" . number_format($mediaMateria, 2) . "</td>";
                            $somma += array_sum($materie[$m]);
                            $count += count($materie[$m]);
                        } else {
                            echo "<td>-</td>";
                        }
                    }

                    $mediaGenerale = $count ? $somma / $count : 0;
                    echo "<td><strong>" . number_format($mediaGenerale, 2) . "</strong></td></tr>";
                }

                echo "</tbody></table>";
            }

            else {
                foreach($voti as $studente => $materie){
                    echo "<h3 class='mt-4'>Studente: <strong>$studente</strong></h3>";

                    $sommaGenerale = 0;
                    $countGenerale = 0;

                    echo "<table class='table table-striped'>";
                    echo "<thead><tr><th>Materia</th><th>Media</th></tr></thead><tbody>";

                    foreach($materie as $nomeMateria => $votiMateria){
                        $mediaMateria = array_sum($votiMateria) / count($votiMateria);
                        $sommaGenerale += array_sum($votiMateria);
                        $countGenerale += count($votiMateria);

                        echo "<tr><td>$nomeMateria</td><td>" . number_format($mediaMateria, 2) . "</td></tr>";
                    }

                    echo "</tbody></table>";

                    $mediaGenerale = $sommaGenerale / $countGenerale;
                    echo "<p><strong>Media generale:</strong> " . number_format($mediaGenerale, 2) . "</p>";
                }
            }
        }
    }
    ?>



</div>

</body>
</html>
