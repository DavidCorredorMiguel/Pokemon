<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Episodios De Pokemon</title>
    <link rel="stylesheet" href="../ModelosEstilos/CSS2.css">
</head>

<body> <?php require_once "../ModelosEstilos/PokM05.php"; $m = new PokM05(); $v = array();
if (isset($_POST["temp"])) { $v = $m->getTemporada(); } if (isset($_POST["opening"])) { $v = $m->getOpening(); }
if (isset($_POST["ar"])) { $v = $m->getnombretemp(); } if (isset($_POST["sa"])) { $v = $m->getSaga(); }
if (isset($_POST["cen"])){ $v = $m->getCen(); } foreach($m->c() as $cen){ echo "Episodios Censurados: ".$cen; }
foreach ($m->c1() as $c1) foreach ($m->c2() as $c2) foreach ($m->c3() as $c3) foreach ($m->c4() as $c4) foreach ($m->c5() as $c5)
foreach ($m->c6() as $c6) foreach ($m->c7() as $c7) foreach ($m->c8() as $c8) {
    echo " | Serie El Comienzo: $c1 | Oro y Plata: $c2 | Rubi y Zafiro: $c3 | Diamante y Perla: $c4 | Negro y Blanco: $c5
        | XY: $c6 | Sol y Luna: $c7 | Viajes Pokemon: $c8 | Episodios: " . ($c1 + $c2 + $c3 + $c4 + $c5 + $c6 + $c7 + $c8) . "<hr>";
} echo "<form action='PK13.php' method='post'><select name='tempv'>";
foreach ($m->sacaTemporada() as $temporada) { echo "<option value='$temporada'>" . $temporada . "ª</option>"; }
echo "</select><input type='submit' value='Buscar Temporada' name='temp'><select name='openingv'>";
foreach ($m->sacaOpening() as $opening) { echo "<option value='$opening'>$opening</option>"; }
echo "</select><input type='submit' value='Buscar Opening' name='opening'><select name='nombretempv'>";
foreach ($m->sacaNTemp() as $nombretemp) { echo "<option value='$nombretemp'>$nombretemp</option>"; }
echo "</select><input type='submit' value='Buscar Temp' name='ar'><select name='sagav'>";
foreach ($m->sacaSagas() as $saga) { echo "<option value='$saga'>Serie $saga</option>"; }
echo "</select><input type='submit' value='Buscar Saga' name='sa'> <input type='submit' value='Censurados' name='cen'></form><br>";
if (isset($_POST["temp"]) || isset($_POST["opening"]) || isset($_POST["ar"]) || isset($_POST["sa"]) || isset($_POST["cen"])) {
    echo "<table><tr><th>Generación</th><th>Episodio</th><th>Opening</th><th>Temporada</th><th>Saga</th></tr>";
    foreach ($v as $c) {
        echo "<tr><td align='center'><Img src='imgtiposygen/Generacion " . $c["gen"] . ".png'></td>
            <td bgcolor='black' align='center' style='color: white'>" . $c["temp"] . "ª Temporada<br><br>Episodio " . $c["idep"] .
            ": " . $c["nombreepisodio"]; if ($c["cen"] != "No") { echo "<br><br>(Censurado)"; }
        echo "<br><br><Img src='imgepisodios/Episodio " . $c["idep"] . ".png' width='275px'></td>
            <td bgcolor='orange' align='center'>" . $c["opening"] . "<br><br><Img src='imgarcosysagas/Opening " . $c["nop"] .
            ".png' width='275px'></td><td align='center'>" . $c["temp"] . "ª Temporada: " . $c["nombretemp"] . "<br><br>
            <Img src='imgarcosysagas/Temporada " . $c["temp"] . ".png' width='275px'></td><td align='center'>Serie " .
            $c["saga"] . "<br><br><Img src='imgarcosysagas/Serie " . $c["saga"] . ".png' width='275px'></td></tr>";
    } echo "</table>";
} ?> </body>

</html>