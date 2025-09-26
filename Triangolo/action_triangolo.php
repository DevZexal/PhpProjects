<html>


    <?php
    $n = $_POST["n"];

    $scelta = $_POST["forma"];

    if($scelta == "triangolo"){
        for($i = 1; $i <= $n; $i++){
            for($j = 1; $j <= $i; $j++){
                echo "*";
            }
            echo "<br>";
        }
    }
    elseif($scelta == "quadrato"){
        for($i = 1; $i <= $n; $i++){
            for($j = 1; $j <= $n; $j++){
                echo "*";
            }
            echo "<br>";
        }
    }
    elseif ($scelta == "triangolo_rovesciato"){
        for($i = 1; $i <= $n; $i++){
            for($j = 1; $j <= $n; $j++){
                if($j < $i){
                    echo "&nbsp&nbsp";
                }
                else{
                    echo "*";
                }
            }
            echo "<br>";
        }
    }
    elseif ($scelta == "cornice"){
        for($i = 1; $i <= $n; $i++){
            for($j = 1; $j <= $n; $j++){
                if($i == 1 || $i == $n || $j == 1 || $j == $n){
                    echo "*&nbsp";
                }
                else{
                    echo "&nbsp&nbsp&nbsp";
                }
            }
            echo "<br>";
        }
    }


    ?>

    <br>

    <a type="button" href="triangolo.html">Torna alla home</a>

</html>