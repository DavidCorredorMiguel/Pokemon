<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Evoluciones Pokemon</title>
    <link rel="stylesheet" href="../ModelosEstilos/CSS2.css">
</head>

<body> <?php require_once "../ModelosEstilos/PokM02.php"; $m = new PokM02(); $v = array();
if (isset($_POST["tipof"])) { $v = $m->getTipo(); } if (isset($_POST["metev1"])) { $v = $m->getMetodosEv1(); }
if (isset($_POST["metev2"])) { $v = $m->getMetodosEv2(); } if (isset($_POST["b1"])) { $v = $m->getSinEv(); }
if (isset($_POST["b2"])) { $v = $m->getFormasReg(); }
foreach ($m->c1() as $c1) foreach ($m->c2() as $c2) foreach ($m->c3() as $c3) foreach ($m->c4() as $c4) {
    echo "Pokemon Sin Evolucion: $c1 | Con Evolucion: $c2 | Sin 2ª Evolucion: $c3 | Con 2ª Evolucion: $c4<hr>";
} echo "<form action='PK04.php' method='post'><select name='tipov'>";
foreach ($m->sacaTipo() as $tipo) { echo "<option value='$tipo'>$tipo</option>"; }
echo "</select><input type='submit' value='Buscar Por Tipo' name='tipof'><select name='metodoev1v'>";
foreach ($m->sacaMetodoEv1() as $metev1) { echo "<option value='$metev1'>$metev1</option>"; }
echo "</select><input type='submit' value='Buscar Metodo Ev 1' name='metev1'><select name='metodoev2v'>";
foreach ($m->sacaMetodoEv2() as $metev2) { echo "<option value='$metev2'>$metev2</option>"; }
echo "</select><input type='submit' value='Buscar Metodo Ev 2' name='metev2'>
<input type='submit' name='b1' value='Sin Ev'> <input type='submit' name='b2' value='Forma Regional'></form><br>";
if (isset($_POST["tipof"]) || isset($_POST["metev1"]) || isset($_POST["metev2"]) || isset($_POST["b1"]) || isset($_POST["b2"])) {
    echo "<table><tr><th>Pokemon</th><th colspan='2'>Evolucion y Metodo</th><th colspan='2'>Evolucion 2 y Metodo</th></tr>";
    foreach ($v as $c) { echo "<tr><td bgcolor='white' align='center'>" . $c["ev0"];
        if ($c["fev0"] != "No") {
            echo " Forma " . $c["fev0"] . "<br><br><Img src='imgtiposygen/" . $c["tipo1"] . ".gif'>";
            if ($c["tipo2"] != "No") { echo " <Img src='imgtiposygen/" . $c["tipo2"] . ".gif'>"; }
            echo "<br><br><Img src='imgformas/" . $c["ev0"]; if ($c["fr"]!='No'){ echo " De "; } else {echo " Forma ";}
            echo $c["fev0"] . ".png' width='275px' height='275px'>";
        } else { echo "<br><br><Img src='imgtiposygen/" . $c["tipo1"] . ".gif'>";
            if ($c["tipo2"] != "No") { echo " <Img src='imgtiposygen/" . $c["tipo2"] . ".gif'>"; }
            echo "<br><br><Img src='imgpokemon/" . $c["ev0"] . ".png' width='275px' height='275px'>";
        } echo "</td><td bgcolor='lightblue' align='center'>"; if ($c["metodoev1"] != "No") { echo "- " . $c["metodoev1"] . " ->";
        } else { echo "<Img src='imglugares/Logo%20Pokemon.png' width='275px' height='275px'>"; }
        echo "</td><td bgcolor='lightgreen' align='center'>";
        if ($c["ev1"] == "No") { echo "<Img src='imglugares/Logo%20Pokemon.png' width='275px' height='275px'>"; }
        else { if ($c["fev1"] != "No") {
                echo $c["ev1"] . " Forma " . $c["fev1"] . "<br><br><Img src='imgtiposygen/" . $c["tp1ev1"] . ".gif'>";
                if ($c["tp2ev1"] != "No") { echo " <Img src='imgtiposygen/" . $c["tp2ev1"] . ".gif'>"; }
                echo "<br><br><Img src='imgformas/" . $c["ev1"]; if ($c["ev1"] != "Urshifu") {
                    if ($c["fr"]!='No'){ echo " De "; } else {echo " Forma ";} echo $c["fev1"] . ".png' width='275px' height='275px'>";
                } else { echo " " . $c["fev1"] . ".png' width='275px' height='275px'>"; }
            } else { echo $c["ev1"] . "<br><br><Img src='imgtiposygen/" . $c["tp1ev1"] . ".gif'>";
                if ($c["tp2ev1"] != "No") { echo " <Img src='imgtiposygen/" . $c["tp2ev1"] . ".gif'>"; }
                echo "<br><br><Img src='imgpokemon/" . $c["ev1"] . ".png' width='275px' height='275px'>";
            }
        } echo "</td><td bgcolor='lightblue' align='center'>"; if ($c["metodoev2"] != "No") { echo "- " . $c["metodoev2"] . " ->"; }
        else { echo "<Img src='imglugares/Logo%20Pokemon.png' width='275px' height='275px'>"; }
        echo "</td><td bgcolor='lightgreen' align='center'>";
        if ($c["ev2"] == "No") { echo "<Img src='imglugares/Logo%20Pokemon.png' width='275px' height='275px'>"; }
        else { if ($c["fev2"] != "No") {
                echo $c["ev2"] . " Forma " . $c["fev2"] . "<br><br><Img src='imgtiposygen/" . $c["tp1ev2"] . ".gif'>";
                if ($c["tp2ev2"] != "No") { echo " <Img src='imgtiposygen/" . $c["tp2ev2"] . ".gif'>"; }
                echo "<br><br><Img src='imgformas/" . $c["ev2"] . " De " . $c["fev2"] . ".png' width='275px' height='275px'>";
            } else { echo $c["ev2"] . "<br><br><Img src='imgtiposygen/" . $c["tp1ev2"] . ".gif'>";
                if ($c["tp2ev2"] != "No") { echo " <Img src='imgtiposygen/" . $c["tp2ev2"] . ".gif'>"; }
                echo "<br><br><Img src='imgpokemon/" . $c["ev2"] . ".png' width='275px' height='275px'>";
            }
        } echo "</td></tr>";
    } echo "</table>";
} ?> </body>

</html>
