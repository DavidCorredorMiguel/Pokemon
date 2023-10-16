<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Equipos De Pokemon</title>
    <link rel="stylesheet" href="../ModelosEstilos/CSS2.css">
</head>

<body> <?php require_once "../ModelosEstilos/PokM06.php"; $m = new PokM06(); $v = array();
if (isset($_POST["gen"])) { $v = $m->getGen(); } if (isset($_POST["region"])) { $v = $m->getRegion(); }
if (isset($_POST["njuego"])) { $v = $m->getNJuego(); } if (isset($_POST["equipo"])) { $v = $m->getNEquipo(); }
if (isset($_POST["teq"])) { $v = $m->getTipoEq(); } if (isset($_POST["titulo"])) { $v = $m->getTitulo(); }
$tpeq = $m->sacaTipoEq(); echo "<form action='PK16.php' method='post'><select name='genv'>";
foreach ($m->sacagen() as $gen) { echo "<option value='$gen'>" . $gen . "ª</option>"; }
echo "</select><input type='submit' value='Buscar Generación' name='gen'><select name='regionv'>";
foreach ($m->sacaRegion() as $region) { echo "<option value='$region'>$region</option>"; }
echo "</select><input type='submit' value='Buscar Región' name='region'><select name='njuegov'>";
foreach ($m->sacaJuego() as $njuego) { echo "<option value='$njuego'>$njuego</option>"; }
echo "</select><input type='submit' value='Buscar Juego' name='njuego'><select name='plataformav'>";
foreach ($m->sacaPlataforma() as $plataforma) { echo "<option value='$plataforma'>" . $plataforma . "</option>"; }
echo "</select><input type='submit' value='Buscar Plataforma' name='plataforma'><select name='nombreeqv'>";
foreach ($m->sacaEquipo() as $nombreeq) { echo "<option value='$nombreeq'>$nombreeq</option>"; }
echo "</select><input type='submit' value='Buscar Equipo' name='equipo'><br><br><select name='teqv'>";
foreach ($tpeq as $teq) { echo "<option value='$teq'>$teq</option>"; }
echo "</select><input type='submit' value='Buscar Tipo Pokemon' name='teq'><select name='titulov'>";
foreach ($m->sacaTitulo() as $titulo) { echo "<option value='$titulo'>$titulo</option>"; }
echo "</select><input type='submit' value='Buscar Titulo' name='titulo'></form><br>";
if (isset($_POST["gen"]) || isset($_POST["region"]) || isset($_POST["njuego"]) || isset($_POST["equipo"]) || isset($_POST["teq"])
    || isset($_POST["titulo"])) { echo "<table><tr><th>Generación y Region</th><th>Juego</th><th>Equipo</th><th>Tipos</th></tr>";
    foreach ($v as $c) {
        echo "<tr><td align='center'><Img src='imgtiposygen/Generacion ". $c["gen"] . ".png'><br><br>" . $c["region"] . "<br><br>";
        if ($c["region"] == "Desconocida") { echo "<Img src='imglugares/Logo%20Pokemon.png' width='375px' height='375px'>"; }
        else { echo "<Img src='imglugares/" . $c["region"] . ".png' width='375px' height='375px'>"; }
        echo "</td><td align='center'>" . $c["nombrejuego"] . " (" . $c["plataforma"] . ")<br><br><img src='imgjuegos/" .
            $c["nombrejuego"] . $c["imgc"] . "' width='375px' height='375px'></td><td align='center'>" . $c["nombreeq"] .
            "<br><br><Img src='imgtiposygen/" . $c["nombreeq"] . ".png' width='275px'></td><td align='center'>" .
            $c["personaje"] . " (" . $c["titulo"] . ")<br><br>";
        if ($c["teq1"] != "Todos Sin Hada" && $c["teq1"] != "Todos") {
            for ($f = 1; $f < 12; $f++) { if ($c["teq".$f]!="No") { echo "<Img src='imgtiposygen/" . $c["teq".$f] . ".gif'> "; } }
        }
        if ($c["teq1"]=="Todos Sin Hada"){ foreach($tpeq as $teq) { if($teq !="Hada"){ echo"<Img src='imgtiposygen/$teq.gif'> "; } } }
        if ($c["teq1"] == "Todos") { foreach ($tpeq as $teq) { echo "<Img src='imgtiposygen/$teq.gif'> "; } }
        echo "<br><br><img src='imgpersonajes/" . $c["personaje"] . ".png' width='375px' height='375px'></td></tr>";
    } echo "</table>";
} ?> </body>

</html>
