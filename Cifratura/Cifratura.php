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
                        <p class="text-muted">Traduttore da testo in morse e viceversa</p>
                    </div>

                    <!-- Form -->
                    <form action="Cifratura.php" method="post">

                        <!-- Input -->
                        <div class="mb-3">
                            <textarea type="text" class="form-control" name="text"
                                      placeholder="Inserisci il testo"><?php echo $text?></textarea>
                        </div>


                        <div class="d-flex justify-content-center gap-3 mb-3">
                            <button type="submit" name="toMorse" class="btn btn-primary px-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1"/>
                                </svg>
                            </button>

                            <input type="text" name="offset" class="form-control "style="max-width: 50px;">
                                <text></text>
                            </input>

                            <button type="submit" name="toText" class="btn btn-secondary px-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5"/>
                                </svg>
                            </button>
                        </div>


                        <div class="mb-3">
                            <textarea type="text" class="form-control text-box" name="cifratura"
                                   placeholder="Morse"><?php echo $cifratura;?></textarea>
                        </div>


                    </form>

                </div>
            </div>

        </div>
    </div>

</div>



</body>
</html>