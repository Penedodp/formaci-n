
    <?php
    include("vistas/inicioHtml.html");
    include ("vistas/nav.php");
    ?>
    <br>
    <br>
    <?php

    include ("controlador/connBd.php");

    $usuarioID = $_GET['i'];

    
    $sql = "SELECT id_pelicula FROM favoritas WHERE id_usuario = $usuarioID";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        
        echo '<table class="table table-striped">
                <thead>
                    <tr>
                    <th>Título</th>
                    <th>Año</th>
                    <th>Tipo</th>
                    </tr>
                </thead>
                <tbody>';

        
        while ($row = $result->fetch_assoc()) {
            $peliculaID = $row['id_pelicula'];
            
            $url = "https://www.omdbapi.com/?apikey=fe8a7565&i=$peliculaID";
            $respuesta = file_get_contents($url);
            $datosPelicula = json_decode($respuesta, true);
            if ($datosPelicula['Response'] == 'True') {
                echo '<tr>';
                echo '<td>' . $datosPelicula['Title'] . '</td>';
                echo '<td>' . $datosPelicula['Year'] . '</td>';
                echo '<td>' . $datosPelicula['Type'] . '</td>';
                echo '</tr>';
            }
        }
        echo '</tbody></table>';
    } else {
        echo "No se encontraron películas favoritas para este usuario.";
    }

  
    $conexion->close();

    include("vistas/finHtml.html");
    ?>

   
