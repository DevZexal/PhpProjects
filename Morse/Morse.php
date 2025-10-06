<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Morse</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">

</head>
<body class="bg-black">

<?php

    $alfabeto =
            array(
                'a' => '.-',
                'b' => '-...',
                'c' => '-.-.',
                'd' => '-..',
                'e' => '.',
                'f' => '..-.',
                'g' => '--.',
                'h' => '....',
                'i' => '..',
                'j' => '.---',
                'k' => '-.-',
                'l' => '.-..',
                'm' => '--',
                'n' => '-.',
                'o' => '---',
                'p' => '.--.',
                'q' => '--.-',
                'r' => '.-.',
                's' => '...',
                't' => '-',
                'u' => '..-',
                'v' => '...-',
                'w' => '.--',
                'x' => '-..-',
                'y' => '-.--',
                'z' => '--..',
                ' ' => '|'
            );

    if(!isset($_POST["text"]))
        $text = "";

    if(!isset($_POST["morse"]))
        $morse = "";



    if(isset($_POST["text"]) && isset($_POST["toMorse"])){

        $text = strtolower($_POST["text"]);
        $morse = "";

        for ($i = 0; $i < strlen($text); $i++) {
            $char = $text[$i];
            if (isset($alfabeto[$char])) {
                $morse .= $alfabeto[$char] . " ";
            } else {
                $morse .= "? ";
            }
        }


    }
    else if (isset($_POST["morse"]) && isset($_POST["toText"])){

        $reverse = array_flip($alfabeto);
        $morse = trim($_POST["morse"]);

        $simboli = explode(" ", $morse);
        $text = "";

        for ($i = 0; $i < count($simboli); $i++) {
            $segno = trim($simboli[$i]);

            if ($segno == "|" || $segno == "/") {
                $text .= " ";
            } else if (isset($reverse[$segno])) {
                $text .= $reverse[$segno];
            } else if ($segno != "") {
                $text .= "?";
            }
        }

    }

?>

<div id="app">

    <!-- Per centrare tutto -->
    <div class="container row justify-content-center">
        <div class="col-lg-9 col-md-11">

            <div class="container card shadow-lg rounded-4 mt-3">
                <div class="card-body p-5">

                    <!-- Header -->
                    <div id="header" class="text-center mb-2">
                        <h1 class="fw-bold">Morse</h1>
                        <p class="text-muted">Traduttore da testo in morse</p>
                    </div>

                    <!-- Form -->
                    <form action="Morse.php" method="post">

                        <!-- Input -->
                        <div class="mb-3">
                            <textarea type="text" class="form-control" name="text"
                                      placeholder="Inserisci il testo"><?php echo $text?></textarea>
                        </div>


                        <div class="col">
                            <div class="row btn btn-primary mb-3">
                                <button type="submit" name="toMorse" class="btn">
                                    testo -> morse
                                </button>
                            </div>

                            <div class="row btn btn-primary mb-3">
                                <button type="submit" name="toText" class="btn">
                                    morse -> testo
                                </button>
                            </div>
                        </div>


                        <div class="mb-3">
                            <textarea type="text" class="form-control text-box" name="morse"
                                   placeholder="Morse"><?php echo $morse;?></textarea>
                        </div>


                    </form>

                </div>
            </div>

        </div>
    </div>

</div>



</body>
</html>