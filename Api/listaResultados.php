<?php
include ("vistas/inicioHtml.html");
include ("vistas/nav.php");
?>
<br>
<br>

<div class="container">
    <?php
    $tituloTabla = '<table class="table table-striped">
        <thead>
            <tr>
                <th>Título</th>
                <th>Año</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>';


    $pelicula = urlencode($_POST['pelicula']);
    $peliculaAño = urlencode($_POST['año']);
    $tipo = urlencode($_POST['tipo']);

    $url = "https://www.omdbapi.com/?apikey=fe8a7565&s=$pelicula";
    $urlAño = "https://www.omdbapi.com/?apikey=fe8a7565&s=$pelicula&y=$peliculaAño";
    $urlTipo = "https://www.omdbapi.com/?apikey=fe8a7565&s=$pelicula&y=$peliculaAño&type=$tipo";



    $respuesta = file_get_contents($url);
    $respuestaAño = file_get_contents($urlAño);
    $respuestaTipo = file_get_contents($urlTipo);


    $datos = json_decode($respuesta, true);
    $datosAño = json_decode($respuestaAño, true);
    $datosTipo = json_decode($respuestaTipo, true);

    if ($datos['Response'] == 'True' && $datosAño['Response'] == 'True' && $datosTipo['Response'] == 'True') {
        echo $tituloTabla;

        foreach ($datosTipo['Search'] as $pelicula) {

            foreach ($datosAño['Search'] as $peliculaAño) {

                if ($pelicula['imdbID'] == $peliculaAño['imdbID']) {
                    echo '<tr>';
                    echo '<td>' . $pelicula['Title'] . '</td>';
                    echo '<td>' . $pelicula['Year'] . '</td>';
                    echo '<td>' . $pelicula['Type'] . '</td>';
                    echo '<td><a href="fichaPelicula.php?i=' . $pelicula['imdbID'] . '" class="btn btn-outline-success">Ficha</a></td>';
                    echo '</tr>';
                }
            }
        }

        echo '</tbody></table>';
        echo '<p>Total de resultados encontrados: ' . $datos['totalResults'] . '</p>';
    } else {
        echo "No se encontraron resultados para la búsqueda.";
    }

    ?>
</div>
<?php
include ("vistas/finHtml.html");

?>