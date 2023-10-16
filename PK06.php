<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Evoluciones Pokemon</title>
    <link rel="stylesheet" href="../ModelosEstilos/CSS2.css">
</head>

<body> <?php $con = new mysqli("localhost", "root", "", "pokemondb"); if (!($res = $con->stmt_init())) { die(mysqli_connect_error());}
if (!isset($_GET["pag"])) { $pag = 1; } else { $pag = $_GET["pag"]; } $resultadopag = 100;
$res->prepare("select count(*) as 'total' from evoluciones"); $res->execute(); $res->bind_result($total);
$fila = $res->fetch(); $numpag = ceil($total / $resultadopag); $pagactual = ($pag - 1) * $resultadopag;
$res->prepare("select * from evoluciones LIMIT " . $pagactual . ", " . $resultadopag); $res->execute();
$res->bind_result($id, $fr, $tipo1, $tipo2, $ev0, $fev0, $metodoev1, $tp1ev1, $tp2ev1, $ev1, $fev1, $metodoev2, $tp1ev2, $tp2ev2,
$ev2, $fev2); echo "<table><tr><th>Pokemon</th><th colspan='2'>Evolucion y Metodo</th><th colspan='2'>Evolucion 2 y Metodo</th></tr>";
while ($res->fetch()) { echo "<tr><td bgcolor='white' align='center'>" . $ev0;
    if ($fev0 != "No") {
        echo " Forma " . $fev0 . "<br><br><Img src='imgtiposygen/" . $tipo1 . ".gif'>";
        if ($tipo2 != "No") { echo " <Img src='imgtiposygen/" . $tipo2 . ".gif'>"; }
        echo "<br><br><Img src='imgformas/" . $ev0; if ($fr!='No'){ echo " De "; } else {echo " Forma ";}
        echo $fev0 . ".png' width='275px' height='275px'>";
    } else { echo "<br><br><Img src='imgtiposygen/" . $tipo1 . ".gif'>";
        if ($tipo2 != "No") { echo " <Img src='imgtiposygen/" . $tipo2 . ".gif'>"; }
        echo "<br><br><Img src='imgpokemon/" . $ev0 . ".png' width='275px' height='275px'>";
    } echo "</td><td bgcolor='lightblue' align='center'>"; if ($metodoev1 != "No") { echo "- " . $metodoev1 . " ->";
    } else { echo "<Img src='imglugares/Logo%20Pokemon.png' width='275px' height='275px'>"; }
    echo "</td><td bgcolor='lightgreen' align='center'>";
    if ($ev1 == "No") { echo "<Img src='imglugares/Logo%20Pokemon.png' width='275px' height='275px'>"; }
    else { if ($fev1 != "No") {
            echo $ev1 . " Forma " . $fev1 . "<br><br><Img src='imgtiposygen/" . $tp1ev1 . ".gif'>";
            if ($tp2ev1 != "No") { echo " <Img src='imgtiposygen/" . $tp2ev1 . ".gif'>"; }
            echo "<br><br><Img src='imgformas/" . $ev1; if ($ev1 != "Urshifu") {
                if ($fr!='No'){ echo " De "; } else {echo " Forma ";} echo $fev1 . ".png' width='275px' height='275px'>";
            } else { echo " " . $fev1 . ".png' width='275px' height='275px'>"; }
        } else { echo $ev1 . "<br><br><Img src='imgtiposygen/" . $tp1ev1 . ".gif'>";
            if ($tp2ev1 != "No") { echo " <Img src='imgtiposygen/" . $tp2ev1 . ".gif'>"; }
            echo "<br><br><Img src='imgpokemon/" . $ev1 . ".png' width='275px' height='275px'>";
        }
    } echo "</td><td bgcolor='lightblue' align='center'>"; if ($metodoev2 != "No") { echo "- " . $metodoev2 . " ->"; }
    else { echo "<Img src='imglugares/Logo%20Pokemon.png' width='275px' height='275px'>"; }
    echo "</td><td bgcolor='lightgreen' align='center'>";
    if ($ev2 == "No") { echo "<Img src='imglugares/Logo%20Pokemon.png' width='275px' height='275px'>"; }
    else { if ($fev2 != "No") {
            echo $ev2 . " Forma " . $fev2 . "<br><br><Img src='imgtiposygen/" . $tp1ev2 . ".gif'>";
            if ($tp2ev2 != "No") { echo " <Img src='imgtiposygen/" . $tp2ev2 . ".gif'>"; }
            echo "<br><br><Img src='imgformas/" . $ev2 . " De " . $fev2 . ".png' width='275px' height='275px'>";
        } else { echo $ev2 . "<br><br><Img src='imgtiposygen/" . $tp1ev2 . ".gif'>";
            if ($tp2ev2 != "No") { echo " <Img src='imgtiposygen/" . $tp2ev2 . ".gif'>"; }
            echo "<br><br><Img src='imgpokemon/" . $ev2 . ".png' width='275px' height='275px'>";
        }
    } echo "</td></tr>";
} echo "</table><br><br><div id='pag' style='text-align: center'>";
if ($pag != 1) { echo " <a href='PK06.php?pag=" . ($pag - 1) . "'><</a> <a href='PK06.php?pag=1'>1</a> "; }
for ($i = $pag - 1; $i < $pag + 2; $i++) { if ($i > 1 && $i <= $numpag) { echo " <a href='PK06.php?pag=" . $i . "'>$i</a> "; } }
if ($pag != $numpag) { echo " ... <a href='PK06.php?pag=$numpag'>$numpag</a> <a href='PK06.php?pag=" . ($pag + 1) . "'>></a>"; }
echo "<br><br></div>"; $res->close(); ?> </body>

</html>
