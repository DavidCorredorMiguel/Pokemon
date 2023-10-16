<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Videojuegos De Pokemon</title>
    <link rel="stylesheet" href="../ModelosEstilos/CSS2.css">
</head>

<body> <?php require_once "../ModelosEstilos/PokM04.php"; $m = new PokM04(); $v = array();
if (isset($_POST["saga"])) { $v = $m->getSaga(); } if (isset($_POST["juego"])) { $v = $m->getJuego(); }
if (isset($_POST["plataforma"])) { $v = $m->getPlataforma(); } if (isset($_POST["genero"])) { $v = $m->getGenero(); }
if (isset($_POST["tipoNPC"])) { $v = $m->getTipoNPC(); }if (isset($_POST["genj"])) { $v = $m->getGeneracionJuego(); }
if (isset($_POST["gen"])) { $v = $m->getGeneracion(); } echo "<form action='PK10.php' method='post'><select name='sagav'>";
foreach ($m->sacaSaga() as $sagajuego) { echo "<option value='$sagajuego'>" . $sagajuego . "</option>"; }
echo "</select><input type='submit' value='Buscar Saga Juego' name='saga'><select name='juegov'>";
foreach ($m->sacaJuego() as $juego) { echo "<option value='$juego'>" . $juego . "</option>"; }
echo "</select><input type='submit' value='Buscar Juego' name='juego'><select name='plataformav'>";
foreach ($m->sacaPlataforma() as $plataforma) { echo "<option value='$plataforma'>" . $plataforma . "</option>"; }
echo "</select><input type='submit' value='Buscar Plataforma' name='plataforma'><br><br><select name='generov'>";
foreach ($m->sacaGenero() as $genero) { echo "<option value='$genero'>" . $genero . "</option>"; }
echo "</select><input type='submit' value='Buscar Genero' name='genero'><select name='tipoNPCv'>";
foreach ($m->sacaTipoNPC() as $tipoNPC) { echo "<option value='$tipoNPC'>NPC (Personaje No Jugador): " . $tipoNPC . "</option>"; }
echo "</select><input type='submit' value='Buscar Tipo De NPC' name='tipoNPC'><select name='genjv'>";
foreach ($m->sacaGeneracionJuego() as $generacionj) { echo "<option value='$generacionj'>$generacionj ª Generacion</option>"; }
echo "</select><input type='submit' value='Buscar Juego Por Generacion' name='genj'><br><br><select name='genv'>";
foreach ($m->sacaGeneracion() as $generacion) { echo "<option value='$generacion'>Pokemon $generacion ª Generacion</option>"; }
echo "</select><input type='submit' value='Buscar Generacion Pokemon' name='gen'></form><br>";
if (isset($_POST["saga"]) || isset($_POST["juego"]) || isset($_POST["plataforma"]) || isset($_POST["genero"])
    || isset($_POST["tipoNPC"]) || isset($_POST["gen"]) || isset($_POST["genj"])) {
    echo "<table><tr><th>Saga, Generación, Videojuego y Plataforma/s</th>
        <th>Género, Desarrollador y Editor</th><th>Pokemon</th><th>Personaje No Jugable (NPC)</th></tr>";
    foreach ($v as $c) {
        echo "<tr><td>Saga " . $c["sagajuego"] . "<br><br><Img src='imgtiposygen/Generacion " .
            $c["gj"] . ".png'><br><br>" . $c["nombrejuego"] . " (" . $c["plataforma1"];
        if ($c["plataforma2"] != "Ninguna") { echo " / " . $c["plataforma2"]; }
        if ($c["plataforma3"] != "Ninguna") { echo " / " . $c["plataforma3"]; }
        echo ")<br><br><img src='imgjuegos/" . $c["nombrejuego"] . $c["imgc"] . "' width='425px' height='425px'></td>
            <td bgcolor='lightgreen'>Género/s: " . $c["genero"] . "<br><br>Desarrollador: " . $c["desarrollador"]
            . "<br><br>Editor: " . $c["editor"] . "</td><td>";
        if ($c["pokemon"] != "Generacion"){
            echo $c["pokemon"] . "<br><br><Img src='imgpokemon/" . $c["pokemon"] . ".png' width='425px' height='425px'>";
        } else { echo "Toda/Hasta Generación <Img src='imgtiposygen/Generacion " . $c["gen"] . ".png'>"; } echo "</td><td>";
        if ($c["NPC"] != "No" && $c["NPC"] != "NPC") {
            echo $c["NPC"] ." (". $c["tipoNPC"] . ")<br><br><Img src='imgpersonajes/" . $c["NPC"] .".png' width='425px' height='425px'>";
        } else { echo "<Img src='imglugares/Logo%20Pokemon.png' width='425px' height='425px'>"; } echo "</td></tr>";
    } echo "</table>";
} ?> </body>

</html>
