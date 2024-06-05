
<?php
include("vistas/inicioHtml.html");
include ("vistas/nav.php");
?>
<br>
<br>
<?php
include ("controlador/connBd.php");

$tituloTabla = '<table class="table table-striped">
<thead>
    <tr>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Teléfono</th>
        <th>Email</th>
        <th>Dirección</th>
        <th>Localidad</th>
        <th>Favoritas</th>
    </tr>
</thead>
<tbody>';

// Consulta SQL donde obtengo los usuarios o cualquier consulta sql, y despues lanzo consulta.
$sql = "SELECT * FROM usuarios";
$result = $conexion->query($sql);

//veo si hay resultados y si los hay creo la cabecera de tabla.
if ($result->num_rows > 0) {
    echo $tituloTabla;

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row["nombre"] . '</td>';
        echo '<td>' . $row["apellidos"] . '</td>';
        echo '<td>' . $row["telefono"] . '</td>';
        echo '<td>' . $row["email"] . '</td>';
        echo '<td>' . $row["direccion"] . '</td>';
        echo '<td>' . $row["localidad"] . '</td>';
        echo '<td> <a href="favoritas.php?i=' . $row["id"] . '" class="btn btn-outline-success">Favoritas</a></td>';
        echo '</tr>';
    }
    echo '</tbody></table>';
} else {
    echo "No se encontraron usuarios.";
}

include("vistas/finHtml.html");
?>


