<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Episodios De Pokemon</title>
    <link rel="stylesheet" href="../ModelosEstilos/CSS2.css">
</head>

<body> <?php $con = new mysqli("localhost", "root", "", "pokemondb"); if (!($res = $con->stmt_init())) { die(mysqli_connect_error());}
if (!isset($_GET["pag"])) { $pag = 1; } else { $pag = $_GET["pag"]; } $resultadopag = 200;
$res->prepare("select count(*) as 'total' from episodios"); $res->execute(); $res->bind_result($total);
$fila = $res->fetch(); $numpag = ceil($total / $resultadopag); $pagactual = ($pag - 1) * $resultadopag;
$res->prepare("select * from episodios LIMIT " . $pagactual . ", " . $resultadopag); $res->execute();
$res->bind_result($idep, $gen, $temp, $nombretemp, $cen, $nombreepisodio, $saga, $nop, $opening);
echo "<table><tr><th>Generación</th><th>Episodio</th><th>Opening</th><th>Temporada</th><th>Saga</th></tr>";
while ($res->fetch()) {
    echo "<tr><td align='center'><Img src='imgtiposygen/Generacion " . $gen . ".png'></td>
        <td bgcolor='black' align='center' style='color: white'>" . $temp . "ª Temporada<br><br>Episodio " . $idep . ": " .
        $nombreepisodio;
    if ($cen != "No") { echo "<br><br>(Censurado)"; }
    echo "<br><br><Img src='imgepisodios/Episodio " . $idep . ".png' width='275px'></td><td bgcolor='orange' align='center'>". $opening .
        "<br><br><Img src='imgarcosysagas/Opening " . $nop . ".png' width='275px'></td><td align='center'>" . $temp . "ª Temporada: " .
        $nombretemp . "<br><br><Img src='imgarcosysagas/Temporada " . $temp . ".png' width='275px'></td><td align='center'>Serie " .
        $saga . "<br><br><Img src='imgarcosysagas/Serie " . $saga . ".png' width='275px'></td></tr>";
} echo "</table><br><br><div id='pag' style='text-align: center'>";
if ($pag != 1) { echo " <a href='PK15.php?pag=" . ($pag - 1) . "'><</a> <a href='PK15.php?pag=1'>1</a> "; }
for ($i = $pag - 1; $i < $pag + 2; $i++) { if ($i > 1 && $i <= $numpag) { echo " <a href='PK15.php?pag=" . $i . "'>$i</a> "; } }
if ($pag != $numpag) { echo " ... <a href='PK15.php?pag=$numpag'>$numpag</a> <a href='PK15.php?pag=" . ($pag + 1) . "'>></a>"; }
echo "<br><br></div>"; $res->close(); ?> </body>

</html>
