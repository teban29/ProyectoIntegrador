<!-- Botón de hamburguesa para el sidebar -->
<button class="sidebar-toggle" onclick="toggleSidebar()">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF">
        <path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm540-453h100v-107H700v107Zm0 186h100v-106H700v106ZM160-240h460v-480H160v480Zm540 0h100v-107H700v107Z"/>
    </svg>
</button>

<div class="sidebar sidebar-hidden">
    <ul class="sidebar-menu">
        <li class="sidebar-item">
            <a href="{{ route('gestion.index') }}">
                <img src="{{ asset('img/dashboard.png') }}" alt="Dashboard Icon" class="sidebar-icon">Inicio Gestión
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('usuarios.index') }}">
                <img src="{{ asset('img/usuarios.png') }}" alt="Usuarios Icon" class="sidebar-icon">Usuarios
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('servicios.index') }}">
                <img src="{{ asset('img/services.png') }}" alt="Servicios Icon" class="sidebar-icon">Servicios
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('categorias.index') }}">
                <img src="{{ asset('img/categorias.png') }}" alt="Categorías Icon" class="sidebar-icon">Categorías
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('productos.index') }}">
                <img src="{{ asset('img/productos.png') }}" alt="Productos Icon" class="sidebar-icon">Productos
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('admin.citas.index') }}">
                <img src="{{ asset('img/citas.png') }}" alt="Citas Icon" class="sidebar-icon">Citas
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('marcas.index') }}">
                <img src="{{ asset('img/marcas.png') }}" alt="Marcas Icon" class="sidebar-icon">Marcas
            </a>
        </li>
    </ul>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar');
        const content = document.querySelector('.content');
        
        // Toggle visibility classes
        sidebar.classList.toggle('sidebar-hidden');
        sidebar.classList.toggle('sidebar-visible');

        if (content) {
            content.classList.toggle('sidebar-hidden');
            content.classList.toggle('sidebar-visible');
        }
    }
</script>
