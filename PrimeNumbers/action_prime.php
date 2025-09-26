<html>
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
                    echo $num."<br>";
                }
            }
            $num++;
        }

//        for($i = 0; $i < count($n_primi); $i++){
//                echo $n_primi[$i]."<br>";
//        }


    ?>

    <br>
    <a type="button" href="Prime.html"><button>Torna alla home</button></a>

</html>