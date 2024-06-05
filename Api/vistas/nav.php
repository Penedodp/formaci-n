<nav class="navbar navbar-expand-lg fixed-top" style="background-color: #333;">
    <div class="container-md d-flex justify-content-between align-items-center">
        <div>
            <a class="navbar-brand" href="index.php" style="color: #fff;">miweb.com</a>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="buscador.php" style="color: #fff;">Buscador</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="usuariosDatabase.php" style="color: #fff;">Usuarios</a>
                    </li>
                </ul>
            </div>
        </div>
        <div>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <p class="nav-link mb-0" style="color: #fff; font-size: 18px;">
                        <?php
                        session_start();
                        echo $_SESSION['nombre'] . " " . $_SESSION['apellidos'] . " " . $_SESSION['id'];
                        ?>
                    </p>
                </li>
            </ul>
        </div>
    </div>
</nav>

<br>
<br>
