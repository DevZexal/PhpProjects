<?php

    function printText($text){
        echo $text;
    };

    $cn = mysqli_connect("127.0.0.1", "root", "", "lib4", 3306);


    if($cn->connect_error != 0){
        echo "Connessione al server fallita";
        echo $cn->connect_error;
        exit();
    }

    # variabili
    $autoreXXX = "Dante";

    # Query 1

    echo "<h2>Query 1</h2>";

    $sql = "select DISTINCT g.nome as NomeGenere, a.nome as NomeAutore, a.cognome as CognomeAutore 
        from autore a
        join libro l on a.ID = l.id_autore
        join librogenere lg on l.ISBN = lg.idLibro
        join genere g on lg.idGenere = g.ID
        WHERE a.nome = '$autoreXXX'";

    $res = $cn->query($sql);

    if ($res && $res->num_rows > 0) {
        $row = $res->fetch_assoc();
        printText("Generi dei libri scritti da {$row['NomeAutore']} {$row['CognomeAutore']}:");
        do {
            printText(" - " . $row['NomeGenere']);
        } while ($row = $res->fetch_assoc());
    }
    $res->free_result();

    # Query 2
    


?>