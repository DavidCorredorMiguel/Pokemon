<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Buscar Pokemon</title>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'>
    <link rel="stylesheet" href="../ModelosEstilos/CSS2.css">
    <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'></script>
</head>

<body>
    <form action='PK02.php' method='post' style="text-align: center;">
        <br>Nª Pokedex-><input type="number" name="id" min="1" max="2000">
        <input type="text" name="tipop" placeholder="Tipo 1 y 2">
        <input type="text" name="pokemon" placeholder="Pokemon">
        <input type="text" name="tipopok" placeholder="Tipo Pokemon">
        Generación-><input type="number" name="gen" min="1" max="9">
        <input type="text" name="region" placeholder="Region">
        <br><br><input type="submit" name="buscapok" value="Buscar Pokemon">
    </form> <?php try { if (isset($_POST["buscapok"])) { $con = new PDO("mysql:host=localhost; dbname=pokemondb", "root", "");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); $con->exec("set character set utf8"); $tipo = $_POST["tipop"];
        $res = $con->prepare("SELECT * FROM pokedex WHERE id=? OR gen=? OR region=? OR tipo1=? OR tipo2=? OR pokemon=?OR tipopok=?");
        $res->bindParam(1, $_POST["id"]); $res->bindParam(2, $_POST["gen"]); $res->bindParam(3, $_POST["region"]);
        $res->bindParam(4, $tipo); $res->bindParam(5, $tipo); $res->bindParam(6, $_POST["pokemon"]);
        $res->bindParam(7, $_POST["tipopok"]); $res->execute();
        echo "<table><tr align='center'><th>Generaciones y Regiones</th><th>Nº Pokedex y Pokemon</th><th>Forma/s</th></tr>";
        while ($c = $res->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td bgcolor='lightgreen' align='center'><Img src='imgtiposygen/Generacion " . $c["gen"] . ".png'> (" .
                $c["region"] . ")<br><br>";
            if ($c["region"] == "Desconocida") { echo "<Img src='imglugares/Logo%20Pokemon.png' width='475px' height='475px'>"; }
            else { echo "<Img src='imglugares/" . $c["region"] . ".png' width='475px' height='475px'>"; }
            echo "</td><td bgcolor='white' align='center'>Nº Pokedex " . $c["id"] . ": " . $c["pokemon"];
            if ($c["tipopok"] != "No") { echo " (Pokemon " . $c["tipopok"] . ")"; }
            echo "<br><Img src='imgtiposygen/" . $c["tipo1"] . ".gif'>";
            if ($c["tipo2"] != "No") { echo " <Img src='imgtiposygen/" . $c["tipo2"] . ".gif'>"; }
            echo "<br><br><Img src='imgpokemon/" . $c["pokemon"] . ".png' width='475px' height='475px'></td>
            <td bgcolor='orange' align='center'>";
            if ($c["fr1"] == "No") { echo "<Img src='imglugares/Logo%20Pokemon.png' width='475px' height='475px'>"; } else {
                echo "<div id='cc' class='carousel slide' data-ride='carousel'><div class='carousel-inner'>
                    <div class='carousel-item active'>" . $c["pokemon"] . " " . $c["fr1"] . "<br><img src='imgtiposygen/" .
                    $c["tipo1fr1"] . ".gif'>";
                if ($c["tipo2fr1"] != "No") { echo " <Img src='imgtiposygen/" . $c["tipo2fr1"] . ".gif'>"; }
                echo "<br><br><Img src='imgformas/" . $c["pokemon"] . " " . $c["fr1"] .".png' width='475px' height='475px'></div>";
                if ($c["pokemon"] != "Unown") {
                    for ($f = 2; $f <= 5; $f++) {
                        if ($c["fr" . $f] != "No") {
                            echo "<div class='carousel-item'>" . $c["pokemon"] . " " . $c["fr" . $f] . "<br><img src='imgtiposygen/" .
                                $c["tipo1fr" . $f] . ".gif'>";
                            if($c["tipo2fr" . $f]!="No"){ echo "<img src='imgtiposygen/" . $c["tipo2fr" . $f] . ".gif'>"; }
                            echo"<br><br><Img src='imgformas/".$c["pokemon"]." ".$c["fr".$f].".png' width='475px' height='475px'></div>";
                        }
                    }
                } else {
                    echo "<div class='carousel-item'>" . $c["pokemon"] . " Signo ?<br><img src='imgtiposygen/"
                        . $c["tipo1fr1"] . ".gif'><br><br><Img src='imgpokemon/" . $c["pokemon"] .
                        ".png' width='475px' height='475px'></div>";
                    for ($l = 65; $l <= 90; $l++) {
                        echo "<div class='carousel-item'>" . $c["pokemon"] . " Letra " . chr($l) .
                            "<br><img src='imgtiposygen/" . $c["tipo1fr1"] . ".gif'><br><br><Img src='imgformas/"
                            . $c["pokemon"] . " Letra " . chr($l) . ".png' width='475px' height='475px'></div>";
                    }
                }
                echo "</div><a class='carousel-control-prev' href='#cc' data-slide='prev'></a>
                    <a class='carousel-control-next' href='#cc' data-slide='next'></a></div></td></tr>";
            }
        } echo "</table>"; $res->closeCursor();
    }
} catch (Exception $e) { echo "¡Error! " . $e->getMessage(); } finally { $con = null; } ?>
</body>

</html>
