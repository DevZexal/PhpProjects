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
    $dataXXX = "2025-01-01";
    $dataYYY = "2025-12-31";
    $stanzaXXX = "Main Hall";
    $libroXXX = "Divina Commedia";

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

    # Query 3

    echo "<h2>Query 3</h2>";

    $sql = "SELECT *
            FROM prestito
            WHERE Data_prestito BETWEEN '$dataXXX' AND '$dataYYY'";

    $res = $cn->query($sql);
    while ($row = $res->fetch_assoc()) {
        printText("Prestito {$row['Num_prestito']} - Data {$row['Data_prestito']}");
    }
    $res->free_result();

    # Query 4

    echo "<h2>Query 4</h2>";

    $sql = "SELECT DISTINCT a.nome, a.cognome
            FROM autore a
            JOIN libro l1 ON a.ID = l1.id_autore
            JOIN libro l2 ON a.ID = l2.id_autore AND l1.ISBN <> l2.ISBN
            JOIN librogenere lg1 ON l1.ISBN = lg1.idLibro
            JOIN librogenere lg2 ON l2.ISBN = lg2.idLibro
            JOIN genere g1 ON lg1.idGenere = g1.ID
            JOIN genere g2 ON lg2.idGenere = g2.ID
            WHERE g1.nome = 'Fantasy'
              AND g2.nome = 'Fantasy'";

    $res = $cn->query($sql);
    while ($row = $res->fetch_assoc()) {
        printText("Autore: {$row['nome']} {$row['cognome']}");
    }
    $res->free_result();


    # Query 6

    echo "<h2>Query 6</h2>";

    $sql = "SELECT l.Titolo
            FROM libro l
            JOIN editore e ON l.idEditore = e.ID
            JOIN nazione n ON e.nazione = n.ID
            WHERE n.nome = 'Italia'";

    $res = $cn->query($sql);
    while ($row = $res->fetch_assoc()) {
        printText($row['Titolo']);
    }
    $res->free_result();

    # Query 7

    echo "<h2>Query 7</h2>";

    $sql = "SELECT l.Titolo, c.Numero_copia
            FROM stanza s
            JOIN armadio a ON s.ID = a.num_stanza
            JOIN scaffale sc ON a.ID = sc.ID_Armadio
            JOIN copia c ON sc.Num = c.Num_scaffale
            JOIN libro l ON c.ISBN_LIBRO = l.ISBN
            WHERE s.nome = '$stanzaXXX'";

    $res = $cn->query($sql);
    while ($row = $res->fetch_assoc()) {
        printText("Libro: {$row['Titolo']} - Copia {$row['Numero_copia']}");
    }
    $res->free_result();


    # Query 8

    echo "<h2>Query 8</h2>";

    $sql = "SELECT DISTINCT a.nome, a.cognome
            FROM autore a
            JOIN libro l ON a.ID = l.id_autore
            JOIN editore e ON l.idEditore = e.ID
            WHERE a.id_nazione = e.nazione";

    $res = $cn->query($sql);
    while ($row = $res->fetch_assoc()) {
        printText("Autore: {$row['nome']} {$row['cognome']}");
    }
    $res->free_result();

    # Query 9

    echo "<h2>Query 9</h2>";

    $sql = "SELECT DISTINCT u.Nome, u.Cognome
            FROM utente u
            JOIN prestito p ON u.c_f = p.c_f
            JOIN copia c ON p.Num_copia = c.Numero_copia
            JOIN libro l ON c.ISBN_LIBRO = l.ISBN
            WHERE l.Titolo = '$libroXXX'";

    $res = $cn->query($sql);
    while ($row = $res->fetch_assoc()) {
        printText("Utente: {$row['Nome']} {$row['Cognome']}");
    }
    $res->free_result();

    

?>