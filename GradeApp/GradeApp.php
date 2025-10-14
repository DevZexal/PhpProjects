<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GradeApp</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">

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
               value="<?php echo isset($_GET['cognome']) ? $_GET['cognome'] : ''; ?>">
    </div>

    <div class="col-md-4">
        <label for="classe" class="form-label">Classe</label>
        <input type="text" name="classe" id="classe" class="form-control"
               placeholder="Es. 3BIT"
               value="<?php echo isset($_GET['classe']) ? $_GET['classe'] : ''; ?>">
    </div>

    <div class="col-md-4">
        <label for="materia" class="form-label">Materia</label>
        <input type="text" name="materia" id="materia" class="form-control"
               placeholder="Es. Matematica"
               value="<?php echo isset($_GET['materia']) ? $_GET['materia'] : ''; ?>">
    </div>

    <div class="col-12 text-end">
        <button type="submit" class="btn btn-primary">Calcola media</button>
        <a href="GradeApp.php" class="btn btn-secondary">Reset</a>
    </div>
</form>

<?php

    function calcolaMedia($cognome = null, $classe = null, $materia = null){
        $somma = 0;
        $count = 0;
        $media = 0;

        $file = file("random-grades.csv");
        for($i = 1; $i < count($file); $i++){
            $riga = explode(",", $file[$i]);

            if (isset($cognome) && $cognome !== "" && $cognome != $riga[0]) continue;
            if (isset($classe)  && $classe !== ""  && $classe != $riga[2]) continue;
            if (isset($materia) && $materia !== "" && $materia != $riga[3]) continue;

            $somma += $riga[5];
            $count++;
        }

        if($count > 0){
            $media = $somma / $count;

            echo "La media";
            echo (isset($cognome) && $cognome !== "") ? " di $cognome" : "";
            echo (isset($classe) && $classe !== "")  ? " della Classe $classe" : "";
            echo (isset($materia) && $materia !== "") ? " di $materia" : "";
            echo " e': " . $media;
        }

    }

    $cognome = $_POST["cognome"] ?? null;
    $classe  = $_POST["classe"] ?? null;
    $materia = $_POST["materia"] ?? null;


    if($cognome || $classe || $materia){
        calcolaMedia($cognome, $classe, $materia);
    }

?>

</div>

</body>
</html>
