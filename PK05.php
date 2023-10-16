<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Buscar Evolucion Pokemon</title>
    <link rel="stylesheet" href="../ModelosEstilos/CSS2.css">
</head>

<body>
    <form action='PK05.php' method='post' style="text-align: center;">
        <input type="text" name="tipop" placeholder="Tipo 1 y 2">
        <input type="text" name="ev" placeholder="Evolucion Pokemon">
        <br><br><input type="submit" name="buscaev" value="Buscar Evolucion">
    </form> <?php try { if (isset($_POST["buscaev"])) { $con = new PDO("mysql:host=localhost; dbname=pokemondb", "root", "");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); $con->exec("set character set utf8");
        $res = $con->prepare("SELECT * FROM evoluciones WHERE tipo1=? OR tipo2=? OR ev0=? OR ev1=? OR ev2=?");
        $tipo = $_POST["tipop"]; $ev = $_POST["ev"]; $res->bindParam(1, $tipo); $res->bindParam(2, $tipo); $res->bindParam(3, $ev);
        $res->bindParam(4, $ev); $res->bindParam(5, $ev); $res->execute();
        echo "<table><tr><th>Pokemon</th><th colspan='2'>Evolucion y Metodo</th><th colspan='2'>Evolucion 2 y Metodo</th></tr>";
        while ($c = $res->fetch(PDO::FETCH_ASSOC)) { echo "<tr><td bgcolor='white' align='center'>" . $c["ev0"];
            if ($c["fev0"] != "No") {
                echo " Forma " . $c["fev0"] . "<br><br><Img src='imgtiposygen/" . $c["tipo1"] . ".gif'>";
                if ($c["tipo2"] != "No") { echo " <Img src='imgtiposygen/" . $c["tipo2"] . ".gif'>"; }
                echo "<br><br><Img src='imgformas/" . $c["ev0"]; if ($c["fr"]!='No'){ echo " De "; } else {echo " Forma ";}
                echo $c["fev0"] . ".png' width='275px' height='275px'>";
            } else { echo "<br><br><Img src='imgtiposygen/" . $c["tipo1"] . ".gif'>";
                if ($c["tipo2"] != "No") { echo " <Img src='imgtiposygen/" . $c["tipo2"] . ".gif'>"; }
                echo "<br><br><Img src='imgpokemon/" . $c["ev0"] . ".png' width='275px' height='275px'>";
            } echo "</td><td bgcolor='lightblue' align='center'>"; if ($c["metodoev1"] != "No") { echo "- " . $c["metodoev1"] . " ->";
            } else { echo "<Img src='imglugares/Logo%20Pokemon.png' width='275px' height='275px'>"; }
            echo "</td><td bgcolor='lightgreen' align='center'>";
            if ($c["ev1"] == "No") { echo "<Img src='imglugares/Logo%20Pokemon.png' width='275px' height='275px'>"; }
            else { if ($c["fev1"] != "No") {
                    echo $c["ev1"] . " Forma " . $c["fev1"] . "<br><br><Img src='imgtiposygen/" . $c["tp1ev1"] . ".gif'>";
                    if ($c["tp2ev1"] != "No") { echo " <Img src='imgtiposygen/" . $c["tp2ev1"] . ".gif'>"; }
                    echo "<br><br><Img src='imgformas/" . $c["ev1"]; if ($c["ev1"] != "Urshifu") {
                        if ($c["fr"]!='No'){ echo " De "; } else {echo " Forma ";}
                        echo $c["fev1"] . ".png' width='275px' height='275px'>";
                    } else { echo " " . $c["fev1"] . ".png' width='275px' height='275px'>"; }
                } else { echo $c["ev1"] . "<br><br><Img src='imgtiposygen/" . $c["tp1ev1"] . ".gif'>";
                    if ($c["tp2ev1"] != "No") { echo " <Img src='imgtiposygen/" . $c["tp2ev1"] . ".gif'>"; }
                    echo "<br><br><Img src='imgpokemon/" . $c["ev1"] . ".png' width='275px' height='275px'>";
                }
            } echo "</td><td bgcolor='lightblue' align='center'>"; if ($c["metodoev2"] != "No") { echo "- " . $c["metodoev2"] . " ->"; }
            else { echo "<Img src='imglugares/Logo%20Pokemon.png' width='275px' height='275px'>"; }
            echo "</td><td bgcolor='lightgreen' align='center'>";
            if ($c["ev2"] == "No") { echo "<Img src='imglugares/Logo%20Pokemon.png' width='275px' height='275px'>"; }
            else { if ($c["fev2"] != "No") {
                    echo $c["ev2"] . " Forma " . $c["fev2"] . "<br><br><Img src='imgtiposygen/" . $c["tp1ev2"] . ".gif'>";
                    if ($c["tp2ev2"] != "No") { echo " <Img src='imgtiposygen/" . $c["tp2ev2"] . ".gif'>"; }
                    echo "<br><br><Img src='imgformas/" . $c["ev2"] . " De " . $c["fev2"] . ".png' width='275px' height='275px'>";
                } else { echo $c["ev2"] . "<br><br><Img src='imgtiposygen/" . $c["tp1ev2"] . ".gif'>";
                    if ($c["tp2ev2"] != "No") { echo " <Img src='imgtiposygen/" . $c["tp2ev2"] . ".gif'>"; }
                    echo "<br><br><Img src='imgpokemon/" . $c["ev2"] . ".png' width='275px' height='275px'>";
                }
            } echo "</td></tr>";
        } echo "</table>"; $res->closeCursor();
    }
} catch (Exception $e) { echo "¡Error! " . $e->getMessage(); } finally { $con = null; } ?>
</body>

</html>
