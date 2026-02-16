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

    # Query 1

    $sql = "select DISTINCT g.nome as NomeGenere, a.nome as NomeAutore, a.cognome as CognomeAutore 
        from autore a
        join libro l on a.ID = l.id_autore
        join librogenere lg on l.ISBN = lg.idLibro
        join genere g on lg.idGenere = g.ID
        where a.nome = 'Dante';";

    $result = $cn->query($sql);

    $row = $result->fetch_array();

    echo "I generi associati ai libri scritti dall'autore " . $row['NomeAutore'] . " " . $row['CognomeAutore']. ' sono:';
    while($row != null){
        echo '<br>';
        echo $row['NomeGenere'];
        $row = $result->fetch_array();
    }

    $result->free_result();

    # Query 2
    


?>