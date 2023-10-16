<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Buscar Movimientos</title>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'>
    <link rel="stylesheet" href="../ModelosEstilos/CSS2.css">
    <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'></script>
</head>

<body>
    <form action='PK08.php' method='post' style="text-align: center;">
        <br><input type="text" name="tipop" placeholder="Tipo">
        <input type="text" name="tmov" placeholder="Tipo Movimiento">
        <input type="text" name="pokemon1" placeholder="Pokemon">
        <input type="text" name="movimiento" placeholder="Movimiento">
        <br><br><input type="submit" name="buscapok" value="Buscar Movimiento">
    </form> <?php try { if (isset($_POST["buscapok"])) { $con = new PDO("mysql:host=localhost; dbname=pokemondb", "root", "");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); $con->exec("set character set utf8");
        $res = $con->prepare("SELECT * FROM movimientos WHERE tipo1=? OR tmov=? OR pokemon=? OR movimiento=?");
        $res->bindParam(1, $_POST["tipo1"]); $res->bindParam(2, $_POST["tmov"]); $res->bindParam(3, $_POST["pokemon1"]);
        $res->bindParam(4, $_POST["movimiento"]); $res->execute();
        echo "<table><tr><th>Generación, Tipo y Movimiento</th><th>Pokemon</th></tr>";
        while ($c = $res->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td bgcolor='lightgreen'><Img src='imgtiposygen/Generacion " . $c["gen"] . ".png'><br><br>
                <Img src='imgtiposygen/" . $c["tipo1"] . ".gif'><br><br><Img src='imgtiposygen/" . $c["tmov"] .
                ".gif'><br><br>" . $c["movimiento"];
            if ($c["objetomov"] != "No") { echo "<br>Necesario Llevar/Usar " . $c["objetomov"]; }
            if ($c["movnec"] != "No") { echo "<br>Necesario Conocer Movimiento " . $c["movnec"]; }
            echo "<br>Potencia: " . $c["pot"] . "<br>Precision: " . $c["prec"] . "<br>PP: " . $c["pp"] . "</td>
                <td align='center'>Usado Por " . $c["pokemon1"];
            if ($c["img"] != "No") {
                if ($c["me"] != "No" || $c["fre"] != "No" || $c["gm"] != "No") {
                    echo "<br><br><Img src='imgformas/" . $c["pokemon1"] . ".png' width='650px' height='650px'>";
                } else { echo "<br><br><Img src='imgpokemon/" . $c["pokemon1"] . ".png' width='650px' height='650px'>"; }
            } else { echo " Pokemon<br><br><Img src='imglugares/Logo%20Pokemon.png' width='650px' height='650px'>"; } echo "</td></tr>";
        } echo "</table>"; $res->closeCursor();
    }
} catch (Exception $e) { echo "¡Error! " . $e->getMessage(); } finally { $con = null; } ?> </body>

</html>
