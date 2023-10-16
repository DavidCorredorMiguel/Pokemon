<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Buscar Videojuegos De PK</title>
    <link rel="stylesheet" href="../ModelosEstilos/CSS2.css">
</head>

<body>
    <form action='PK11.php' method='post' style="margin-left: 10px; text-align: center;">
        <input type="text" name="sagajuego" placeholder="Saga Juegos">
        Generación Juegos-><input type="number" name="gj" min="1" max="9">
        <input type="text" name="nombrejuego" placeholder="Juego">
        <input type="text" name="plataforma" placeholder="Plataforma">
        <input type="text" name="genero" placeholder="Genero">
        <input type="text" name="pokemon" placeholder="Pokemon">
        Generación-><input type="number" name="gen" min="1" max="9">
        <input type="text" name="tipoNPC" placeholder="Tipo NPC">
        <br><br><input type="submit" name="buscarjuego" value="Buscar Videojuego">
    </form> <?php try { if (isset($_POST["buscarjuego"])) { $con = new PDO("mysql:host=localhost; dbname=pokemondb", "root", "");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); $con->exec("set character set utf8");
        $res = $con->prepare("SELECT * FROM videojuegos WHERE sagajuego=? OR gj=? OR nombrejuego=? OR plataforma1=?
            OR plataforma2=? OR plataforma3=? OR genero=? OR gen=? OR pokemon=? OR tipoNPC=?"); $plataforma = $_POST["plataforma"];
        $res->bindParam(1, $_POST["sagajuego"]); $res->bindParam(2, $_POST["gj"]); $res->bindParam(3, $_POST["nombrejuego"]);
        $res->bindParam(4, $plataforma);$res->bindParam(5, $plataforma); $res->bindParam(6, $plataforma);
        $res->bindParam(7, $_POST["genero"]); $res->bindParam(8, $_POST["pokemon"]); $res->bindParam(9, $_POST["gen"]);
        $res->bindParam(10, $_POST["tipoNPC"]); $res->execute();
        echo "<table><tr><th>Saga, Generación, Videojuego y Plataforma/s</th>
            <th>Género, Desarrollador y Editor</th><th>Pokemon</th><th>Personaje No Jugable (NPC)</th></tr>";
        while ($c = $res->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td>Saga " . $c["sagajuego"] . "<br><br><Img src='imgtiposygen/Generacion " . $c["gj"] . ".png'><br><br>" .
                $c["nombrejuego"] . " (" . $c["plataforma1"];
            if ($c["plataforma2"] != "Ninguna") { echo " / " . $c["plataforma2"]; }
            if ($c["plataforma3"] != "Ninguna") { echo " / " . $c["plataforma3"]; }
            echo ")<br><br><img src='imgjuegos/" . $c["nombrejuego"] . $c["imgc"] . "' width='425px' height='425px'>
                </td><td bgcolor='lightgreen'>Género/s: " . $c["genero"] . "<br><br>Desarrollador: " .
                $c["desarrollador"] . "<br><br>Editor: " . $c["editor"] . "</td><td>";
            if ($c["pokemon"] != "Generacion") {
                echo $c["pokemon"] . "<br><br><Img src='imgpokemon/" . $c["pokemon"] . ".png' width='425px' height='425px'>";
            } else { echo "Toda/Hasta Generación <Img src='imgtiposygen/Generacion " .$c["gen"] . ".png'>"; } echo "</td><td>";
            if ($c["NPC"] != "No" && $c["NPC"] != "NPC") {
                echo $c["NPC"]." (".$c["tipoNPC"].")<br><br><Img src='imgpersonajes/" . $c["NPC"] .".png' width='425px' height='425px'>";
            } else { echo "<Img src='imglugares/Logo%20Pokemon.png' width='425px' height='425px'>"; } echo "</td></tr>";
        } echo "</table>"; $res->closeCursor();
    }
} catch (Exception $e) { echo "¡Error! " . $e->getMessage(); } finally { $con = null; } ?>
</body>

</html>
