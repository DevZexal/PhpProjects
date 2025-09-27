<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risultato</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Stile css -->
    <style>
        body {
            font-family: "Andale Mono", monospace;
        }
        .risultato {
            font-size: 1.2rem;
        }
        .btn{
            background-color: #ff9900;
            color: #fff;
        }

        .btn:hover {
            background-color: #ffda6a;
            color: #1a1d20;
        }
    </style>
</head>

<!-- Sfondo nero -->
<body class="bg-black">

<!-- Contenitore risposta -->
<div class="container-sm py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Card -->
            <div class="card shadow-lg rounded-4">
                <div class="card-body p-5">

                    <!-- Titolo -->
                    <h2 class="text-center mb-4" style="color: #ff9900">Risultato</h2>


                    <div class="risultato">
                        <?php
                        $n = $_POST["n"];
                        $scelta = $_POST["forma"];

                        if ($scelta == "triangolo") {
                            for ($i = 1; $i <= $n; $i++) {
                                for ($j = 1; $j <= $i; $j++) {
                                    echo "*";
                                }
                                echo "<br>";
                            }
                        }
                        elseif ($scelta == "quadrato") {
                            for ($i = 1; $i <= $n; $i++) {
                                for ($j = 1; $j <= $n; $j++) {
                                    echo "*";
                                }
                                echo "<br>";
                            }
                        }
                        elseif ($scelta == "triangolo_rovesciato") {
                            for ($i = 1; $i <= $n; $i++) {
                                for ($j = 1; $j <= $n; $j++) {
                                    if ($j < $i) {
                                        echo "&nbsp;";
                                    } else {
                                        echo "*";
                                    }
                                }
                                echo "<br>";
                            }
                        }
                        elseif ($scelta == "cornice") {
                            for ($i = 1; $i <= $n; $i++) {
                                for ($j = 1; $j <= $n; $j++) {
                                    if ($i == 1 || $i == $n || $j == 1 || $j == $n) {
                                        echo "* ";
                                    } else {
                                        echo "&nbsp;&nbsp;";
                                    }
                                }
                                echo "<br>";
                            }
                        }
                        ?>
                    </div>


                    <!-- Bottone torna indietro -->
                    <div class="text-center mt-3">
                        <a href="triangolo.html" class="btn btn-lg rounded-pill">
                            Torna alla Home
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
