<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Equipos De Pokemon</title>
    <link rel="stylesheet" href="../ModelosEstilos/CSS2.css">
</head>

<body> <?php $con = new mysqli("localhost", "root", "", "pokemondb"); if (!($res = $con->stmt_init())) { die(mysqli_connect_error());}
if (!isset($_GET["pag"])) { $pag = 1; } else { $pag = $_GET["pag"]; } $resultadopag = 50;
$res->prepare("select count(*) as 'total' from equipos"); $res->execute(); $res->bind_result($total);
$fila = $res->fetch(); $numpag = ceil($total / $resultadopag); $pagactual = ($pag - 1) * $resultadopag;
$res->prepare("select * from equipos LIMIT " . $pagactual . ", " . $resultadopag); $res->execute();
$res->bind_result($ideq, $gen, $region, $nombrejuego, $imgc, $plataforma, $nombreeq, $teq1, $teq2, $teq3, $teq4, $teq5, $teq6, $teq7,
$teq8, $teq9, $teq10, $teq11, $titulo, $personaje);
echo "<table><tr><th>Generación y Region</th><th>Juego</th><th>Equipo</th><th>Tipos</th></tr>";
require_once "../ModelosEstilos/PokM06.php"; $modelo = new PokM06(); $vector = array(); $tpeq = $modelo->sacaTipoEq();
while ($res->fetch()) {
    echo "<tr><td align='center'><Img src='imgtiposygen/Generacion ".$gen .".png'><br><br>" .$region. "<br><br>";
    if ($region == "Desconocida") { echo "<Img src='imglugares/Logo%20Pokemon.png' width='375px' height='375px'>"; }
    else { echo "<Img src='imglugares/" . $region . ".png' width='375px' height='375px'>"; }
    echo "</td><td align='center'>" . $nombrejuego . " (" . $plataforma . ")<br><br><img src='imgjuegos/" . $nombrejuego . $imgc .
        "' width='375px' height='375px'></td><td align='center'>" . $nombreeq . "<br><br><Img src='imgtiposygen/" . $nombreeq .
        ".png' width='275px'></td><td align='center'>" . $personaje . " (" . $titulo . ")<br><br>";
    if ($teq1 != "Todos Sin Hada" && $teq1 != "Todos") { if ($teq1!="No") { echo "<Img src='imgtiposygen/$teq1.gif'> "; }
        if ($teq2!="No") { echo "<Img src='imgtiposygen/$teq2.gif'> "; }if ($teq3!="No") { echo "<Img src='imgtiposygen/$teq3.gif'> "; }
        if ($teq4!="No") { echo "<Img src='imgtiposygen/$teq4.gif'> "; }if ($teq5!="No") { echo "<Img src='imgtiposygen/$teq5.gif'> "; }
        if ($teq6!="No") { echo "<Img src='imgtiposygen/$teq6.gif'> "; }if ($teq7!="No") { echo "<Img src='imgtiposygen/$teq7.gif'> "; }
        if ($teq8!="No") { echo "<Img src='imgtiposygen/$teq8.gif'> "; }if ($teq9!="No") { echo "<Img src='imgtiposygen/$teq9.gif'> "; }
        if ($teq10!="No"){ echo "<Img src='imgtiposygen/$teq10.gif'> ";}if ($teq11!="No"){ echo "<Img src='imgtiposygen/$teq11.gif'> "; }
    }
    if ($teq1=="Todos Sin Hada"){foreach($tpeq as $teq){if($teq !="Hada"){echo"<Img src='imgtiposygen/$teq.gif'> "; } } }
    if ($teq1 == "Todos") { foreach ($tpeq as $teq) { echo "<Img src='imgtiposygen/$teq.gif'> "; } }
    echo "<br><br><img src='imgpersonajes/" . $personaje . ".png' width='375px' height='375px'></td></tr>";
} echo "</table><br><br><div id='pag' style='text-align: center'>";
if ($pag != 1) { echo " <a href='PK18.php?pag=" . ($pag - 1) . "'><</a> <a href='PK18.php?pag=1'>1</a> "; }
for ($i = $pag - 1; $i < $pag + 2; $i++) { if ($i > 1 && $i <= $numpag) { echo " <a href='PK18.php?pag=" . $i . "'>$i</a> "; } }
if ($pag != $numpag) { echo " ... <a href='PK18.php?pag=$numpag'>$numpag</a> <a href='PK18.php?pag=" . ($pag + 1) . "'>></a>"; }
echo "<br><br></div>"; $res->close(); ?> </body>

</html>
