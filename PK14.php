<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Buscar Episodios De Pokemon</title>
    <link rel="stylesheet" href="../ModelosEstilos/CSS2.css">
</head>

<body>
    <form action='PK14.php' method='post' style="text-align: center;">
        Nº Temporada-><input type="number" name="temp" min=1 max="30">
        Nº Episodio-><input type="number" name="idep" min=1 max="2000">
        <input type="text" name="cen" placeholder="Censura (Si/No)">
        <input type="text" name="nombretemp" placeholder="Temporada">
        <input type="text" name="saga" placeholder="Saga"><br><br>
        <input type="submit" name="buscarep" value="Buscar Episodio">
    </form> <?php try { if (isset($_POST["buscarep"])) { $con = new PDO("mysql:host=localhost; dbname=pokemondb", "root", "");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); $con->exec("set character set utf8");
        $res = $con->prepare("SELECT * FROM episodios WHERE temp=? OR idep=? OR cen=? OR nombretemp=? OR saga=?");
        $res->bindParam(1, $_POST["temp"]); $res->bindParam(2, $_POST["idep"]); $res->bindParam(3, $_POST["cen"]);
        $res->bindParam(4, $_POST["nombretemp"]); $res->bindParam(5, $_POST["saga"]); $res->execute();
        echo "<table><tr><th>Generación</th><th>Episodio</th><th>Opening</th><th>Temporada</th><th>Saga</th></tr>";
        while ($c = $res->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td align='center'><Img src='imgtiposygen/Generacion " . $c["gen"] . ".png'></td>
                <td bgcolor='black' align='center' style='color: white'>" . $c["temp"] . "ª Temporada<br><br>Episodio " .
                $c["idep"] . ": " . $c["nombreepisodio"];
            if ($c["cen"] != "No") { echo "<br><br>(Censurado)"; }
            echo "<br><br><Img src='imgepisodios/Episodio " . $c["idep"] . ".png' width='275px'></td>
                <td bgcolor='orange' align='center'>" . $c["opening"] . "<br><br><Img src='imgarcosysagas/Opening " . $c["nop"] .
                ".png' width='275px'></td><td align='center'>" . $c["temp"] . "ª Temporada: " . $c["nombretemp"] . "<br><br>
                <Img src='imgarcosysagas/Temporada " . $c["temp"] . ".png' width='275px'></td><td align='center'>Serie " .
                $c["saga"] . "<br><br><Img src='imgarcosysagas/Serie " . $c["saga"] . ".png' width='275px'></td></tr>";
        } echo "</table>"; $res->closeCursor();
    }
} catch (Exception $e) { echo "¡Error! " . $e->getMessage(); } finally { $con = null; } ?> </body>

</html>
