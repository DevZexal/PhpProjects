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

<body class="bg-black">


<!-- Contenitore risposta -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Card -->
            <div class="card shadow-lg rounded-4">
                <div class="card-body p-4">

                    <h2 class="text-center mb-4" style="color: #ff9900">Risultato</h2>

                    <div class="risultato text-center">
                    <?php
                        function isPrime($num) {
                                if ($num <= 1) {
                                    return false;
                                }
                                for ($i = 2; $i < $num; $i++) {
                                    if ($num % $i == 0) {
                                        return false;
                                    }
                                }

                                return true;
                        }

                    //    $n = $_POST["n"];
                        $A = $_POST["A"];
                        $B = $_POST["B"];

                    //    $n_primi = [];

                        $num = 1;
                        while($num <= $B){
                            if($num >= $A) {
                                if (isPrime($num)) {
                                    //$n_primi[] = $num;
                                    echo $num."&nbsp";
                                }
                            }
                            $num++;
                        }

                //        for($i = 0; $i < count($n_primi); $i++){
                //                echo $n_primi[$i]."<br>";
                //        }


                    ?>
                    </div>

                    <!-- Bottone torna indietro -->
                    <div class="text-center mt-3">
                        <a href="Prime.html" class="btn btn-lg rounded-pill">
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