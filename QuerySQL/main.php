<?php

    function printText($text){
        echo $text . "<br>";
    };

    $cn = mysqli_connect("127.0.0.1", "root", "", "lib4", 3306);


    if($cn->connect_error != 0){
        echo "Connessione al server fallita";
        echo $cn->connect_error;
        exit();
    }

    # variabili
    $autoreXXX = "Dante";
    $cognomeXXX = "Bianchi";

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

    echo "<h2>Query 2</h2>";

    $sql = "SELECT p.Num_prestito, c.Numero_copia, l.Titolo
            FROM utente u
            JOIN prestito p ON u.c_f = p.c_f
            JOIN copia c ON p.Num_copia = c.Numero_copia
            JOIN libro l ON c.ISBN_LIBRO = l.ISBN
            WHERE u.Cognome = '$cognomeXXX'";

    $res = $cn->query($sql);
    while ($row = $res->fetch_assoc()) {
        printText("Prestito {$row['Num_prestito']} - Copia {$row['Numero_copia']} - Libro: {$row['Titolo']}");
    }
    $res->free_result();



?>