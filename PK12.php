<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Videojuegos De Pokemon</title>
    <link rel="stylesheet" href="../ModelosEstilos/CSS2.css">
</head>

<body> <?php $con = new mysqli("localhost", "root", "", "pokemondb"); if (!($res = $con->stmt_init())) { die(mysqli_connect_error());}
if (!isset($_GET["pag"])) { $pag = 1; } else { $pag = $_GET["pag"]; } $resultadopag = 150;
$res->prepare("select count(*) as 'total' from videojuegos"); $res->execute(); $res->bind_result($total);
$fila = $res->fetch(); $numpag = ceil($total / $resultadopag); $pagactual = ($pag - 1) * $resultadopag;
$res->prepare("select * from videojuegos LIMIT " . $pagactual . ", " . $resultadopag); $res->execute();
$res->bind_result($id, $sagajuego, $gj, $nombrejuego, $imgc, $plataforma1, $plataforma2, $plataforma3, $genero, $desarrollador, $editor,
$pokemon, $gen, $tipoNPC, $NPC);
echo "<table><tr><th>Saga, Generación, Videojuego y Plataforma/s</th>
<th>Género, Desarrollador y Editor</th><th>Pokemon</th><th>Personaje No Jugable (NPC)</th></tr>";
while ($res->fetch()) {
    echo "<tr><td>Saga " . $sagajuego . "<br><br><Img src='imgtiposygen/Generacion " . $gj . ".png'><br><br>" . $nombrejuego . " (" .
        $plataforma1;
    if ($plataforma2 != "Ninguna") { echo " / " . $plataforma2; } if ($plataforma3 != "Ninguna") { echo " / " . $plataforma3; }
    echo ")<br><br><img src='imgjuegos/" . $nombrejuego . $imgc . "' width='425px' height='425px'></td>
        <td bgcolor='lightgreen'>Género/s: " . $genero . "<br><br>Desarrollador: " . $desarrollador . "<br><br>Editor: " . $editor .
        "</td><td>";
    if ($pokemon != "Generacion") { echo $pokemon . "<br><br><Img src='imgpokemon/" . $pokemon . ".png' width='425px' height='425px'>";}
    else { echo "Toda/Hasta Generación <Img src='imgtiposygen/Generacion " . $gen . ".png'>"; } echo "</td><td>";
    if ($NPC != "No" && $NPC != "NPC") {
        echo $NPC . " (" . $tipoNPC . ")<br><br><Img src='imgpersonajes/" . $NPC . ".png' width='425px' height='425px'>";
    } else { echo "<Img src='imglugares/Logo%20Pokemon.png' width='425px' height='425px'>"; } echo "</td></tr>";
} echo "</table><br><br><div id='pag' style='text-align: center'>";
if ($pag != 1) { echo " <a href='PK12.php?pag=" . ($pag - 1) . "'><</a> <a href='PK12.php?pag=1'>1</a> "; }
for ($i = $pag - 1; $i < $pag + 2; $i++) { if ($i > 1 && $i <= $numpag) { echo " <a href='PK12.php?pag=" . $i . "'>$i</a> "; } }
if ($pag != $numpag) { echo " ... <a href='PK12.php?pag=$numpag'>$numpag</a> <a href='PK12.php?pag=" . ($pag + 1) . "'>></a>"; }
echo "<br><br></div>"; $res->close(); ?> </body>

</html>
