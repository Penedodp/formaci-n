<?php
include("vistas/inicioHtml.html");
?>
<link rel="stylesheet" href="vistas/css/fichapelicula.css">
    <?php
    include ("vistas/nav.php");
    ?>
    <br>
    <br>
    <?php
    if (isset($_GET['i'])) {

        $idPelicula = $_GET['i'];

        $url = "https://www.omdbapi.com/?apikey=fe8a7565&i=$idPelicula";

        $respuesta = file_get_contents($url);

        $datosPelicula = json_decode($respuesta, true);

        if ($datosPelicula['Response'] == 'True') {
            echo '<div class="container">';
            echo '<div class="table-container">';
            echo '<table class="table table-striped">';
            echo '<tr><th>Título</th><td>' . $datosPelicula['Title'] . '</td></tr>';
            echo '<tr><th>Elenco</th><td>' . $datosPelicula['Actors'] . '</td></tr>';
            echo '<tr><th>Director</th><td>' . $datosPelicula['Director'] . '</td></tr>';
            echo '<tr><th>Año</th><td>' . $datosPelicula['Year'] . '</td></tr>';
            echo '<tr><th>Estreno</th><td>' . $datosPelicula['Released'] . '</td></tr>';
            echo '<tr><th>Duración</th><td>' . $datosPelicula['Runtime'] . '</td></tr>';
            echo '<tr><th>Guión</th><td>' . $datosPelicula['Writer'] . '</td></tr>';
            echo '<tr><th>Sinopsis</th><td>' . $datosPelicula['Plot'] . '</td></tr>';
            echo '<tr><th>Genero</th><td>' . $datosPelicula['Genre'] . '</td></tr>';
            echo '<tr><th>País</th><td>' . $datosPelicula['Country'] . '</td></tr>';
            echo '<tr><th>Clasificación</th><td>' . $datosPelicula['Rated'] . '</td></tr>';
            echo '<tr><th>Premios</th><td>' . $datosPelicula['Awards'] . '</td></tr>';
            echo '<tr><th>Puntuación Metacritic</th><td>' . $datosPelicula['Metascore'] . '</td></tr>';
            echo '<tr><th>Puntuación IMDB</th><td>' . $datosPelicula['imdbRating'] . '</td></tr>';
            echo '<tr><th>Recaudación</th><td>' . $datosPelicula['BoxOffice'] . '</td></tr>';
            echo '<tr><th>Tipo</th><td>' . $datosPelicula['Type'] . '</td></tr>';
            echo '</table>';
            echo '</div>'; // Cierre de .table-container
            echo '<div class="poster">';
            echo "<img src='" . $datosPelicula['Poster'] . "' alt='Poster'>";
            echo '</div>'; // Cierre de .poster
            echo '</div>'; // Cierre de .container
        } else {
            echo "No se encontraron datos de esta película";
        }
    }
    ?>
    
    <?php
    include("vistas/finHtml.html");
    ?>