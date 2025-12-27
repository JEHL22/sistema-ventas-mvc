<nav class="col-md-2 bg-light sidebar p-3">
    <h4>Datos</h4>
    <ul class="nav flex-column">
        <li class="nav-item">
            <form action="mainController.php?option=dashboard&section=categorias" method="post">
                <input type="hidden" name="section" value="categorias">
                <button class="nav-link btn btn-link" type="submit">CATEGORÍAS</button>
            </form>
        </li>
        <li class="nav-item">
            <form action="mainController.php?option=dashboard&section=clientes" method="post">
                <input type="hidden" name="section" value="clientes">
                <button class="nav-link btn btn-link" type="submit">CLIENTES</button>
            </form>
        </li>
        <li class="nav-item">
            <form action="mainController.php?option=dashboard&section=detallespedidos" method="post">
                <input type="hidden" name="section" value="detallespedidos">
                <button class="nav-link btn btn-link" type="submit">DETALLES PEDIDOS</button>
            </form>
        </li>
        <li class="nav-item">
            <form action="mainController.php?option=dashboard&section=empleados" method="post">
                <input type="hidden" name="section" value="empleados">
                <button class="nav-link btn btn-link" type="submit">EMPLEADOS</button>
            </form>
        </li>
        <li class="nav-item">
            <form action="mainController.php?option=dashboard&section=expedidores" method="post">
                <input type="hidden" name="section" value="expedidores">
                <button class="nav-link btn btn-link" type="submit">EXPEDIDORES</button>
            </form>
        </li>
        <li class="nav-item">
            <form action="mainController.php?option=dashboard&section=pedidos" method="post">
                <input type="hidden" name="section" value="pedidos">
                <button class="nav-link btn btn-link" type="submit">PEDIDOS</button>
            </form>
        </li>
        <li class="nav-item">
            <form action="mainController.php?option=dashboard&section=productos" method="post">
                <input type="hidden" name="section" value="productos">
                <button class="nav-link btn btn-link" type="submit">PRODUCTOS</button>
            </form>
        </li>
        <li class="nav-item">
            <form action="mainController.php?option=dashboard&section=proveedores" method="post">
                <input type="hidden" name="section" value="proveedores">
                <button class="nav-link btn btn-link" type="submit">PROVEEDORES</button>
            </form>
        </li>
    </ul>
    <!-- Botón de Logout -->
    <form class="mt-auto" method="POST" action="../controllers/mainController.php?option=logout">
        <button class="btn btn-outline-danger mt-3" type="submit">Logout</button>
    </form>
</nav>
