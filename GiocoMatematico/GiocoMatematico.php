<?php
session_start();

// Funzioni ------------------------------------------

function inizializzaGioco() {
    $_SESSION['numeri'] = [30, 35, 60, 135, 77];
    $_SESSION['mosse'] = 0;
    $_SESSION['messaggio'] = " ";
}

function filtraNumeri($numeri, $divisore) {
    $risultato = [];

    foreach ($numeri as $n) {
        if ($n % $divisore !== 0) {
            $risultato[] = $n;
        }
    }

    return $risultato;
}

function applicaDivisore($divisore) {
    if ($divisore <= 1) {
        $_SESSION['messaggio'] = "Inserisci un numero maggiore di 1.";
        return;
    }

    $_SESSION['mosse']++;

    // uso la funzione senza lambda
    $_SESSION['numeri'] = filtraNumeri($_SESSION['numeri'], $divisore);

    if (empty($_SESSION['numeri'])) {
        $_SESSION['messaggio'] = "Hai vinto! Hai eliminato tutti i numeri in {$_SESSION['mosse']} mosse.";
    } else {
        $_SESSION['messaggio'] = "Divisore $divisore applicato.";
    }
}

function resetGioco() {
    session_destroy();
    session_start();
    inizializzaGioco();
}



// MAIN -----------------------------------------
if (!isset($_SESSION['numeri'])) {
    inizializzaGioco();
}

if (isset($_POST['azione'])) {

    if ($_POST['azione'] === "dividi") {
        $divisore = intval($_POST['divisore']);
        applicaDivisore($divisore);
    }

    if ($_POST['azione'] === "reset") {
        resetGioco();
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sminatore Matematico Base</title>
</head>
<body>

<h1>Sminatore Matematico</h1>

<p><strong>Numeri rimasti:</strong><br>
    <?php
    if (!empty($_SESSION['numeri'])) {
        echo implode(" ", $_SESSION['numeri']);
    } else {
        echo "Nessun numero rimasto";
    }
    ?>
</p>

<p><strong>Mosse effettuate:</strong> <?= $_SESSION['mosse'] ?></p>

<p><strong><?= $_SESSION['messaggio'] ?></strong></p>

<?php if (!empty($_SESSION['numeri'])): ?>
    <form method="POST">
        <input type="number" name="divisore" placeholder="Inserisci un divisore" required>
        <button type="submit" name="azione" value="dividi">Cancella</button>
    </form>
<?php endif; ?>

<form method="POST">
    <button type="submit" name="azione" value="reset">Reset</button>
</form>

</body>
</html>
