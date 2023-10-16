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

<body> <?php $con = new mysqli("localhost", "root", "", "pokemondb"); if (!($res = $con->stmt_init())) { die(mysqli_connect_error());}
if (!isset($_GET["pag"])) { $pag = 1; } else { $pag = $_GET["pag"]; } $resultadopag = 100;
$res->prepare("select count(*) as 'total' from pokedex"); $res->execute(); $res->bind_result($total);
$fila = $res->fetch(); $numpag = ceil($total / $resultadopag); $pagactual = ($pag - 1) * $resultadopag;
$res->prepare("select * from pokedex LIMIT " . $pagactual . ", " . $resultadopag); $res->execute();
$res->bind_result($id, $gen, $region, $tipopok, $me, $fre, $gm, $tipo1, $tipo2, $pokemon, $tipo1fr1, $tipo2fr1, $fr1, $tipo1fr2,
$tipo2fr2, $fr2, $tipo1fr3, $tipo2fr3, $fr3, $tipo1fr4, $tipo2fr4, $fr4, $tipo1fr5, $tipo2fr5, $fr5);
echo "<table><tr align='center'><th>Generaciones y Regiones</th><th>Nº Pokedex y Pokemon</th><th>Forma/s</th></tr>";
while ($res->fetch()) {
    echo "<tr><td bgcolor='lightgreen' align='center'><Img src='imgtiposygen/Generacion " . $gen . ".png'> (" . $region . ")<br><br>";
    if ($region == "Desconocida") { echo "<Img src='imglugares/Logo%20Pokemon.png' width='475px' height='475px'>"; }
    else { echo "<Img src='imglugares/" . $region . ".png' width='475px' height='475px'>"; }
    echo "</td><td bgcolor='white' align='center'>Nº Pokedex ".$id.": ".$pokemon; if ($tipopok!="No") { echo " (Pokemon ".$tipopok.")"; }
    echo "<br><Img src='imgtiposygen/" . $tipo1 . ".gif'>"; if ($tipo2 != "No") { echo " <Img src='imgtiposygen/" . $tipo2 . ".gif'>"; }
    echo "<br><br><Img src='imgpokemon/" . $pokemon . ".png' width='475px' height='475px'></td><td bgcolor='orange' align='center'>";
    if ($fr1 == "No") { echo "<Img src='imglugares/Logo%20Pokemon.png' width='475px' height='475px'>"; } else {
        echo "<div id='cc' class='carousel slide' data-ride='carousel'><div class='carousel-inner'>
            <div class='carousel-item active'>" . $pokemon . " " . $fr1 . "<br><img src='imgtiposygen/" . $tipo1fr1 . ".gif'>";
        if ($tipo2fr1 != "No") { echo " <Img src='imgtiposygen/" . $tipo2fr1 . ".gif'>"; }
        echo "<br><br><Img src='imgformas/" . $pokemon . " " . $fr1 . ".png' width='475px' height='475px'></div>";
        if ($pokemon != "Unown") {
            if ($fr2 != "No") { echo "<div class='carousel-item'>".$pokemon." ".$fr2 . "<br><img src='imgtiposygen/".$tipo1fr2 .".gif'>";
                if ($tipo2fr2 != "No") { echo " <Img src='imgtiposygen/" . $tipo2fr2 . ".gif'>"; }
                echo "<br><br><Img src='imgformas/" . $pokemon . " " . $fr2 . ".png' width='475px' height='475px'></div>";
            }
            if ($fr3 != "No") { echo "<div class='carousel-item'>".$pokemon." ".$fr3. "<br><img src='imgtiposygen/".$tipo1fr3 . ".gif'>";
                if ($tipo2fr3 != "No") { echo " <Img src='imgtiposygen/" . $tipo2fr3 . ".gif'>"; }
                echo "<br><br><Img src='imgformas/" . $pokemon . " " . $fr3 . ".png' width='475px' height='475px'></div>";
            }
            if ($fr4 != "No") { echo "<div class='carousel-item'>".$pokemon." ".$fr4."<br><img src='imgtiposygen/". $tipo1fr4 . ".gif'>";
                if ($tipo2fr4 != "No") { echo " <Img src='imgtiposygen/" . $tipo2fr4 . ".gif'>"; }
                echo "<br><br><Img src='imgformas/" . $pokemon . " " . $fr4 . ".png' width='475px' height='475px'></div>";
            }
            if ($fr5 != "No") { echo "<div class='carousel-item'>".$pokemon." ".$fr5."<br><img src='imgtiposygen/". $tipo1fr5 . ".gif'>";
                if ($tipo2fr5 != "No") { echo " <Img src='imgtiposygen/" . $tipo2fr5 . ".gif'>"; }
                echo "<br><br><Img src='imgformas/" . $pokemon . " " . $fr5 . ".png' width='475px' height='475px'></div>";
            }
        } else {
            echo "<div class='carousel-item'>" . $pokemon . " Signo ?<br><img src='imgtiposygen/" . $tipo1fr1 . ".gif'><br><br>
                <Img src='imgpokemon/" . $pokemon . ".png' width='475px' height='475px'></div>";
            for ($l = 65; $l <= 90; $l++) {
                echo "<div class='carousel-item'>" . $pokemon . " Letra " . chr($l) . "<br><img src='imgtiposygen/" . $tipo1fr1 .
                    ".gif'><br><br><Img src='imgformas/" . $pokemon . " Letra " . chr($l) . ".png' width='475px' height='475px'></div>";
            }
        }
        echo "</div><a class='carousel-control-prev' href='#cc' data-slide='prev'></a>
            <a class='carousel-control-next' href='#cc' data-slide='next'></a></div></td></tr>";
    }
} echo "</table><br><br><div id='pag' style='text-align: center'>";
if ($pag != 1) { echo " <a href='PK03.php?pag=" . ($pag - 1) . "'><</a> <a href='PK03.php?pag=1'>1</a> "; }
for ($i = $pag - 1; $i < $pag + 2; $i++) { if ($i > 1 && $i <= $numpag) { echo " <a href='PK03.php?pag=" . $i . "'>$i</a> "; } }
if ($pag != $numpag) { echo " ... <a href='PK03.php?pag=$numpag'>$numpag</a> <a href='PK03.php?pag=" . ($pag + 1) . "'>></a>"; }
echo "<br><br></div>"; $res->close(); ?> </body>

</html>
