<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cifratura di Cesare</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">

</head>
<body class="bg-black">

<?php

if(!isset($_POST['text']))
    $text = "";

if(!isset($_POST['cifratura']))
    $cifratura = "";

if(isset($_POST['text']) && isset($_POST['toMorse'])) {

    $text = strtolower($_POST['text']);
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : "";
    $cifratura = "";

    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];

        // solo lettere alfabetiche
        if ($char >= 'a' && $char <= 'z') {
            $pos = ord($char) - ord('a');
            $nuovaPos = ($pos + $offset) % 26;
            $cifratura .= chr($nuovaPos + ord('a'));
        } else {
            // lascia invariati spazi, numeri e simboli
            $cifratura .= $char;
        }
    }
}

else if(isset($_POST['cifratura']) && isset($_POST['toText'])) {

    $cifratura = strtolower($_POST['cifratura']);
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : "";
    $text = "";

    for ($i = 0; $i < strlen($cifratura); $i++) {
        $char = $cifratura[$i];

        if ($char >= 'a' && $char <= 'z') {
            $pos = ord($char) - ord('a');
            $nuovaPos = ($pos - $offset + 26) % 26;
            $text .= chr($nuovaPos + ord('a'));
        } else {
            $text .= $char;
        }
    }
}

?>

<div id="app">

    <!-- Per centrare tutto -->
    <div class="container row justify-content-center">
        <div class="col-12" style="max-width: 1200px;">

            <div class="container card shadow-lg rounded-4 mt-3">
                <div class="card-body p-5">

                    <!-- Header -->
                    <div id="header" class="text-center mb-2">
                        <h1 class="fw-bold">Cifratura di Cesare</h1>
                        <p class="text-muted">Cripta o decripta un testo con un offset personalizzato</p>
                    </div>

                    <!-- Form -->
                    <form action="Cifratura.php" method="post">

                        <!-- Input -->
                        <div class="mb-3">
                            <textarea type="text" class="form-control" name="text"
                                      placeholder="Inserisci il Testo"><?php echo $text?></textarea>
                        </div>

                        <div class="d-flex justify-content-center align-items-center gap-3 mb-3">
                            <button type="submit" name="toMorse" class="btn btn-primary px-4">
                                Cripta
                            </button>

                            <input type="number" name="offset" class="form-control text-center"
                                   placeholder="offset" style="max-width: 100px;"
                                   value="<?php echo isset($_POST['offset']) ? $_POST['offset'] : ""; ?>">

                            <button type="submit" name="toText" class="btn btn-secondary px-4">
                                Decripta
                            </button>
                        </div>

                        <div class="mb-3">
                            <textarea type="text" class="form-control text-box" name="cifratura"
                                      placeholder="Testo cifrato"><?php echo $cifratura;?></textarea>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

</body>
</html>
