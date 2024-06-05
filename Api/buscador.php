<?php
include("vistas/inicioHtml.html");
?>
<link rel="stylesheet" href="vistas/css/buscador.css">
    <?php
    include ("vistas/nav.php");
    ?>
    <br>
    <br>
    <br>
    <form action="listaResultados.php" method="post">

        <input type="text" name="pelicula" placeholder="Nombre de película">
        <input type="text" name="año" placeholder="Año">
        <select  name="tipo" id="tipo">
            <option value=""></option>
            <option value="movie">Movie</option>
            <option value="series">Series</option>
            <option value="game">Game</option>
        </select>
        <input type="submit" value="Buscar">
    </form>

    <?php
    include("vistas/finHtml.html");
    ?>