<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Pokedex</title>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'>
    <link rel="stylesheet" href="../ModelosEstilos/CSS2.css">
    <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'></script>
</head>

<body> <?php require_once "../ModelosEstilos/PokM01.php"; $m = new PokM01(); $v = array();
if (isset($_POST["tipof"])) { $v = $m->getTipo(); } if (isset($_POST["regionf"])) { $v = $m->getRegiones(); }
if (isset($_POST["b1"])) { $v = $m->getLegendarios(); }
if (isset($_POST["b2"])) { $v = $m->getSingulares(); } if (isset($_POST["b3"])) { $v = $m->getMegaEv(); }
if (isset($_POST["b4"])) { $v = $m->getFormasReg(); } if (isset($_POST["b5"])) { $v = $m->getGigamax(); }
foreach ($m->c1() as $c1) foreach ($m->c2() as $c2) foreach ($m->c3() as $c3) foreach ($m->c4() as $c4) foreach ($m->c5() as $c5)
foreach ($m->c6() as $c6) foreach ($m->c7() as $c7) foreach ($m->c8() as $c8) foreach ($m->c9() as $c9) foreach ($m->c10() as $c10)
foreach ($m->c11() as $c11) foreach ($m->c12() as $c12) foreach ($m->c13() as $c13) foreach ($m->c14() as $c14)
foreach ($m->c15() as $c15) foreach ($m->c16() as $c16) foreach ($m->c17() as $c17) foreach ($m->c18() as $c18) {
    echo "Normal: $c1 | Acero: $c2 | Agua: $c3 | Bicho: $c4 | Dragon: $c5 | Electrico: $c6 | Fantasma: $c7 | Fuego: $c8 | Hada: $c9 |
    Hielo: $c10 | Lucha: $c11 | Planta: $c12 | Psiquico: $c13 | Roca: $c14 | Siniestro: $c15<hr>Tierra: $c16 | Veneno: $c17 |
    Volador: $c18";
} foreach ($m->c19() as $c19) foreach ($m->c20() as $c20) foreach ($m->c21() as $c21) foreach ($m->c22() as $c22)
    foreach ($m->c23() as $c23) {
        echo " | Pokemon Legendarios: $c19 | Singulares: $c20 | Megaevoluciones: $c21 | Formas Regionales: $c22 | Gigamax: $c23<hr>";
} echo "<form action='PK01.php' method='post'><select name='tipov'>";
foreach ($m->sacaTipo() as $tipo) { echo "<option value='$tipo'>$tipo</option>"; }
echo "</select><input type='submit' value='Buscar Por Tipo' name='tipof'><select name='regionv'>";
foreach ($m->sacaRegion() as $region) { echo "<option value='$region'>$region</option>"; }
echo "</select><input type='submit' value='Buscar Region' name='regionf'><input type='submit' name='b1' value='Legendarios'>
    <input type='submit' name='b2' value='Singulares'><input type='submit' name='b3' value='Megaevoluciones'>
    <input type='submit' name='b4' value='Formas Regionales'><input type='submit' name='b5' value='Gigamax'></form><br>";
if (isset($_POST["tipof"]) || isset($_POST["regionf"]) || isset($_POST["b1"]) || isset($_POST["b2"]) || isset($_POST["b3"])
    || isset($_POST["b4"]) || isset($_POST["b5"])) {
    echo "<table><tr align='center'><th>Generaciones y Regiones</th><th>Nº Pokedex y Pokemon</th><th>Forma/s</th></tr>";
    foreach ($v as $c) {
        echo "<tr><td bgcolor='lightgreen' align='center'><Img src='imgtiposygen/Generacion " . $c["gen"] . ".png'> (" .
            $c["region"] . ")<br><br>";
        if ($c["region"] == "Desconocida") { echo "<Img src='imglugares/Logo%20Pokemon.png' width='475px' height='475px'>"; }
        else { echo "<Img src='imglugares/" . $c["region"] . ".png' width='475px' height='475px'>"; }
        echo "</td><td bgcolor='white' align='center'>Nº Pokedex " . $c["id"] . ": " . $c["pokemon"];
        if ($c["tipopok"] != "No") { echo " (Pokemon " . $c["tipopok"] . ")"; }
        echo "<br><Img src='imgtiposygen/" . $c["tipo1"] . ".gif'>";
        if ($c["tipo2"] != "No") { echo " <Img src='imgtiposygen/" . $c["tipo2"] . ".gif'>"; }
        echo "<br><br><Img src='imgpokemon/" . $c["pokemon"] . ".png' width='475px' height='475px'></td>
            <td bgcolor='orange' align='center'>";
        if ($c["fr1"] == "No") { echo "<Img src='imglugares/Logo%20Pokemon.png' width='475px' height='475px'>"; } else {
            echo "<div id='cc' class='carousel slide' data-ride='carousel'>
                <div class='carousel-inner'><div class='carousel-item active'>" . $c["pokemon"] . " " . $c["fr1"]
                . "<br><img src='imgtiposygen/" . $c["tipo1fr1"] . ".gif'>";
            if ($c["tipo2fr1"] != "No") { echo " <Img src='imgtiposygen/" . $c["tipo2fr1"] . ".gif'>"; }
            echo "<br><br><Img src='imgformas/" . $c["pokemon"] . " " . $c["fr1"] . ".png' width='475px' height='475px'></div>";
            if ($c["pokemon"] != "Unown") {
                for ($f = 2; $f <= 5; $f++) {
                    if ($c["fr" . $f] != "No") {
                        echo "<div class='carousel-item'>" . $c["pokemon"] . " " . $c["fr" . $f] . "<br><img src='imgtiposygen/" .
                            $c["tipo1fr" . $f] . ".gif'>";
                        if($c["tipo2fr" . $f]!="No"){ echo "<img src='imgtiposygen/" . $c["tipo2fr" . $f] . ".gif'>"; }
                        echo "<br><br><Img src='imgformas/".$c["pokemon"]." ".$c["fr" . $f].".png' width='475px' height='475px'></div>";
                    }
                }
            } else {
                echo "<div class='carousel-item'>" . $c["pokemon"] . " Signo ?<br><img src='imgtiposygen/"
                    . $c["tipo1fr1"] . ".gif'><br><br><Img src='imgpokemon/" . $c["pokemon"] .
                    ".png' width='475px' height='475px'></div>";
                for ($l = 65; $l <= 90; $l++) {
                    echo "<div class='carousel-item'>" . $c["pokemon"] . " Letra " . chr($l) .
                        "<br><img src='imgtiposygen/" . $c["tipo1fr1"] . ".gif'><br><br><Img src='imgformas/"
                        . $c["pokemon"] . " Letra " . chr($l) . ".png' width='475px' height='475px'></div>";
                }
            }
            echo "</div><a class='carousel-control-prev' href='#cc' data-slide='prev'></a>
                <a class='carousel-control-next' href='#cc' data-slide='next'></a></div></td></tr>";
        }
    } echo "</table>";
} ?> </body>

</html>
