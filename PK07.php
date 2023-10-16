<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Movimientos Pokemon</title>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'>
    <link rel="stylesheet" href="../ModelosEstilos/CSS2.css">
    <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'></script>
</head>

<body> <?php require_once "../ModelosEstilos/PokM03.php"; $m = new PokM03(); $v = array();
if (isset($_POST["tipof"])) { $v = $m->getTipo(); } if (isset($_POST["tmovf"])) { $v = $m->gettiposmov(); }
if (isset($_POST["b1"])) { $v = $m->getFormas(); } if (isset($_POST["b2"])) { $v = $m->getGigamax(); }
foreach ($m->c1() as $c1) foreach ($m->c2() as $c2) { echo "<br>Movimientos Con Formas: $c1 | Movimientos Gigamax: $c2<hr>"; }
echo "<form action='PK07.php' method='post'><select name='tipov'>";
foreach ($m->sacaTipo() as $tipo) { echo "<option value='$tipo'>$tipo</option>"; }
echo "</select><input type='submit' value='Buscar Por Tipo' name='tipof'><select name='tmovv'>";
foreach ($m->sacatmov() as $tmov) { echo "<option value='$tmov'>$tmov</option>"; }
echo "</select><input type='submit' value='Buscar Tipo Movimiento' name='tmovf'>
    <input type='submit' name='b1' value='Movimientos Formas'><input type='submit' name='b2' value='Movimientos Gigamax'></form><br>";
if (isset($_POST["tipof"]) || isset($_POST["tmovf"]) || isset($_POST["b1"]) || isset($_POST["b2"]) || isset($_POST["b3"])) {
    echo "<table><tr><th>Generación, Tipo y Movimiento</th><th>Pokemon</th></tr>";
    foreach ($v as $c) {
        echo "<tr><td bgcolor='lightgreen'><Img src='imgtiposygen/Generacion " . $c["gen"] . ".png'><br><br><Img src='imgtiposygen/" .
            $c["tipo1"] . ".gif'><br><br><Img src='imgtiposygen/" . $c["tmov"] . ".gif'><br><br>" . $c["movimiento"];
        if ($c["objetomov"] != "No") { echo "<br>Necesario Llevar " . $c["objetomov"]; }
        if ($c["movnec"] != "No") { echo "<br>Necesario Conocer Movimiento " . $c["movnec"]; }
        echo "<br>Potencia: " . $c["pot"] . "<br>Precision: " . $c["prec"] . "<br>PP: " . $c["pp"] . "</td>
            <td align='center'>Usado Por " . $c["pokemon1"];
        if ($c["img"] != "No") {
            if ($c["me"] != "No" || $c["fre"] != "No" || $c["gm"] != "No") {
                echo "<br><br><Img src='imgformas/" . $c["pokemon1"] . ".png' width='650px' height='650px'>";
            } else { echo "<br><br><Img src='imgpokemon/" . $c["pokemon1"] . ".png' width='650px' height='650px'>"; }
        } else { echo " Pokemon<br><br><Img src='imglugares/Logo%20Pokemon.png' width='650px' height='650px'>"; } echo "</td></tr>";
    } echo "</table>";
} ?> </body>

</html>
