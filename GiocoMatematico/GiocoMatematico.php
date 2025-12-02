<?php
session_start();

// Funzioni -------------------------------------------------------------

function generaPrimi($diff) {
    $primiBase = [2,3,5,7,11,13,17,19,23,29,31,37,41,43,47,53,59,61,67,71,73];

    shuffle($primiBase);

    if ($diff == "facile") return array_slice($primiBase, 0, 3);
    if ($diff == "medio")  return array_slice($primiBase, 0, 7);
    return array_slice($primiBase, 0, 21);
}


function generaNumeri($primi) {
    $lista = [];
    for ($i = 0; $i < 30; $i++) {
        $p1 = $primi[array_rand($primi)];
        $p2 = $primi[array_rand($primi)];
        $k  = rand(7, 21);
        $lista[] = $p1 * $p2 * $k;
    }
    return $lista;
}

function iniziaGioco($diff) {
    $_SESSION['difficolta'] = $diff;
    $_SESSION['primi'] = generaPrimi($diff);
    $_SESSION['numeri'] = generaNumeri($_SESSION['primi']);
    $_SESSION['mosse'] = 0;
}

function applicaDivisore($d) {
    $_SESSION['mosse']++;

    $nuovi = [];
    foreach ($_SESSION['numeri'] as $n) {
        if ($n % $d != 0) $nuovi[] = $n;
    }
    $_SESSION['numeri'] = $nuovi;
}

function resetGioco() {
    session_unset();
    session_destroy();
    session_start();
}

// MAIN -----------------------------------------

if (isset($_POST['difficolta'])) {
    iniziaGioco($_POST['difficolta']);
}

if (isset($_POST['azione'])) {

    if ($_POST['azione'] == "dividi") {
        $div = intval($_POST['divisore']);

        if ($div > 1 && isset($_SESSION['numeri'])) {
            applicaDivisore($div);
        }
    }

    if ($_POST['azione'] == "reset") {
        resetGioco();
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>

<h1>Gioco Matematico</h1>

<?php if (!isset($_SESSION['numeri'])): ?>

    <h3>Scegli difficoltà:</h3>
    <form method="POST">
        <button name="difficolta" value="facile">Facile</button>
        <button name="difficolta" value="medio">Medio</button>
        <button name="difficolta" value="difficile">Difficile</button>
    </form>

<?php else: ?>

    <p><strong>Difficoltà:</strong> <?= $_SESSION['difficolta'] ?></p>


    <p><strong>Numeri rimasti (<?= count($_SESSION['numeri']) ?>):</strong><br>
        <?= implode(" ", $_SESSION['numeri']) ?>
    </p>

    <p><strong>Mosse:</strong> <?= $_SESSION['mosse'] ?></p>

    <?php if (!empty($_SESSION['numeri'])): ?>
        <form method="POST">
            <input type="number" name="divisore" placeholder="divisore" required>
            <button name="azione" value="dividi">DIVIDI</button>
        </form>
    <?php endif; ?>

    <form method="POST">
        <button name="azione" value="reset">Reset</button>
    </form>

<?php endif; ?>

</body>
</html>
