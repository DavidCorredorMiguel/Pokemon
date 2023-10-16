<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Buscar Equipos De Pokemon</title>
    <link rel="stylesheet" href="../ModelosEstilos/CSS2.css">
</head>

<body>
    <form action='PK17.php' method='post' style="text-align: center">
        <input type="text" name="teq" placeholder="Tipo Pokemon Equipo">
        Generación-><input type="number" name="gen" min="1" max="9">
        <input type="text" name="region" placeholder="Region">
        <input type="text" name="nombrejuego" placeholder="Juego">
        <input type="text" name="plataforma" placeholder="Plataforma">
        <input type="text" name="titulo" placeholder="Titulo">
        <br><br><input type="submit" name="buscareq" value="Buscar Equipo">
    </form> <?php try { if (isset($_POST["buscareq"])) { $con = new PDO("mysql:host=localhost; dbname=pokemondb", "root", "");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); $con->exec("set character set utf8");
        $res = $con->prepare("SELECT * FROM equipos where teq1 = ? or teq2 = ? or teq3 = ? or teq4 = ? or teq5 = ? or teq6 = ?
            or teq7 = ? or teq8 = ? or teq9 = ? or teq10 = ? or teq11 = ? or gen = ? or region = ? OR nombrejuego=? OR plataforma=?
            or titulo = ?"); $teq = $_POST["teq"]; $res->bindParam(1, $teq); $res->bindParam(2, $teq); $res->bindParam(3, $teq);
        $res->bindParam(4, $teq); $res->bindParam(5, $teq); $res->bindParam(6, $teq); $res->bindParam(7, $teq);$res->bindParam(8, $teq);
        $res->bindParam(9, $teq); $res->bindParam(10, $teq);$res->bindParam(11, $teq); $res->bindParam(12, $_POST["gen"]);
        $res->bindParam(13, $_POST["region"]); $res->bindParam(14, $_POST["nombrejuego"]); $res->bindParam(15, $_POST["plataforma"]);
        $res->bindParam(16, $_POST["titulo"]); $res->execute();
        require_once "../ModelosEstilos/PokM06.php"; $modelo = new PokM06(); $vector = array(); $tpeq = $modelo->sacaTipoEq();
        echo "<table><tr><th>Generación y Region</th><th>Juego</th><th>Equipo</th><th>Tipos</th></tr>";
        while ($c = $res->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td align='center'><Img src='imgtiposygen/Generacion ".$c["gen"] .".png'><br><br>" .$c["region"]. "<br><br>";
            if ($c["region"] == "Desconocida") { echo "<Img src='imglugares/Logo%20Pokemon.png' width='375px' height='375px'>"; }
            else { echo "<Img src='imglugares/" . $c["region"] . ".png' width='375px' height='375px'>"; }
            echo "</td><td align='center'>" . $c["nombrejuego"] . " (" . $c["plataforma"] . ")<br><br><img src='imgjuegos/" .
                $c["nombrejuego"] . $c["imgc"] . "' width='375px' height='375px'></td><td align='center'>" . $c["nombreeq"] .
                "<br><br><Img src='imgtiposygen/" . $c["nombreeq"] . ".png' width='275px'></td><td align='center'>" .
                $c["personaje"] . " (" . $c["titulo"] . ")<br><br>";
            if ($c["teq1"] != "Todos Sin Hada" && $c["teq1"] != "Todos") {
                for ($f = 1; $f < 12; $f++) { if ($c["teq".$f]!="No") { echo "<Img src='imgtiposygen/".$c["teq".$f]. ".gif'> "; } }
            }
            if ($c["teq1"]=="Todos Sin Hada"){foreach($tpeq as $teq){if($teq !="Hada"){echo"<Img src='imgtiposygen/$teq.gif'> "; } } }
            if ($c["teq1"] == "Todos") { foreach ($tpeq as $teq) { echo "<Img src='imgtiposygen/$teq.gif'> "; } }
            echo "<br><br><img src='imgpersonajes/" . $c["personaje"] . ".png' width='375px' height='375px'></td></tr>";
        } echo "</table>"; $res->closeCursor();
    }
} catch (Exception $e) { echo "¡Error! " . $e->getMessage(); } finally { $con = null; } ?> </body>

</html>
