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

<body> <?php $con = new mysqli("localhost", "root", "", "pokemondb"); if (!($res = $con->stmt_init())) { die(mysqli_connect_error());}
if (!isset($_GET["pag"])) { $pag = 1; } else { $pag = $_GET["pag"]; } $resultadopag = 100;
$res->prepare("select count(*) as 'total' from movimientos"); $res->execute(); $res->bind_result($total);
$fila = $res->fetch(); $numpag = ceil($total / $resultadopag); $pagactual = ($pag - 1) * $resultadopag;
$res->prepare("select * from movimientos LIMIT " . $pagactual . ", " . $resultadopag); $res->execute();
$res->bind_result($id, $img, $gen, $me, $fre, $gm, $tipo1, $tmov, $objetomov, $movimiento, $pot, $prec, $pp, $movnec,
$pokemon1); echo "<table><tr><th>Generación, Tipo y Movimiento</th><th>Pokemon</th></tr>";
while ($res->fetch()) {
    echo "<tr><td bgcolor='lightgreen'><Img src='imgtiposygen/Generacion " . $gen . ".png'><br><br><Img src='imgtiposygen/" . $tipo1 .
        ".gif'><br><br><Img src='imgtiposygen/" . $tmov . ".gif'><br><br>" . $movimiento;
    if ($objetomov != "No") { echo "<br>Necesario Llevar " . $objetomov; }
    if ($movnec != "No") { echo "<br>Necesario Conocer Movimiento " . $movnec; }
    echo "<br>Potencia: " . $pot . "<br>Precision: " . $prec . "<br>PP: " . $pp . "</td><td align='center'>Usado Por " . $pokemon1;
    if ($img != "No") {
        if ($me!="No" || $fre!="No" || $gm!="No") { echo "<br><br><Img src='imgformas/".$pokemon1.".png' width='650px' height='650px'>"; }
        else { echo "<br><br><Img src='imgpokemon/" . $pokemon1 . ".png' width='650px' height='650px'>"; }
    } else { echo " Pokemon<br><br><Img src='imglugares/Logo%20Pokemon.png' width='650px' height='650px'>"; } echo "</td></tr>";
} echo "</table><br><br><div id='pag' style='text-align: center'>";
if ($pag != 1) { echo " <a href='PK09.php?pag=" . ($pag - 1) . "'><</a> <a href='PK09.php?pag=1'>1</a> "; }
for ($i = $pag - 1; $i < $pag + 2; $i++) { if ($i > 1 && $i <= $numpag) { echo " <a href='PK09.php?pag=" . $i . "'>$i</a> "; } }
if ($pag != $numpag) { echo " ... <a href='PK09.php?pag=$numpag'>$numpag</a> <a href='PK09.php?pag=" . ($pag + 1) . "'>></a>"; }
echo "<br><br></div>"; $res->close(); ?> </body>

</html>
