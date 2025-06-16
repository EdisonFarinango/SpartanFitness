<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['id_usuario'])) {
    // No hay sesión iniciada, redirigir al login
    header("Location: ../Vista/login.php");
    exit;
}

// Verificar que el rol sea 'encargado'
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'encargado') {
    echo "No tienes permisos para acceder a esta página.";
    exit;
}

$nombreUsuario = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Usuario';
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Gimnasio Spartan Fitness - Dashboard</title>
<link rel="icon" href="../Public/logo.png" type="image/png">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
<style>
  body, html {
    height: 100%;
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }
  header {
    position: fixed;
    top: 0; left: 0; right: 0;
    height: 56px;
    background-color: #dc3545;
    color: white;
    display: flex;
    align-items: center;
    padding: 0 1rem;
    z-index: 1030;
  }
  #btnToggleSidebar {
    background: transparent;
    border: none;
    color: white;
    font-size: 1.4rem;
    cursor: pointer;
    margin-right: 1rem;
  }
  #sidebar {
    position: fixed;
    top: 56px;
    left: 0;
    bottom: 0;
    width: 250px;
    background-color: #263238;
    color: white;
    overflow-y: auto;
    transition: width 0.3s ease;
  }
  #sidebar.collapsed {
    width: 70px;
  }
  /* Menú lateral */
  #sidebar .nav-link, #sidebar .btn-toggle {
    color: white;
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    white-space: nowrap;
    border: none;
    background: none;
    width: 100%;
    text-align: left;
  }
  #sidebar .nav-link i, #sidebar .btn-toggle i {
    width: 24px;
    margin-right: 10px;
    font-size: 1.1rem;
    text-align: center;
  }
  #sidebar.collapsed .nav-link span.text-label,
  #sidebar.collapsed .btn-toggle span.text-label {
    display: none;
  }
  /* Ocultar icono de flecha cuando sidebar está colapsado */
  #sidebar.collapsed .btn-toggle i.fas.fa-chevron-down {
    display: none;
  }
  /* Hover y activo */
  #sidebar .nav-link:hover,
  #sidebar .btn-toggle:hover,
  #sidebar .nav-link.active,
  #sidebar .btn-toggle.active {
    background-color: #C62828;
    border-radius: 4px;
    color: white;
  }
  /* Submenú */
  #sidebar .collapse .nav-link {
    padding-left: 3rem;
    background-color: #37474F;
  }
  /* Contenido principal */
  #content {
    margin-top: 56px;
    margin-left: 250px;
    padding: 1.5rem;
    transition: margin-left 0.3s ease;
    min-height: calc(100vh - 56px - 40px);
  }
  #sidebar.collapsed ~ #content {
    margin-left: 70px;
  }
  footer {
    position: fixed;
    bottom: 0; left: 0; right: 0;
    height: 40px;
    background-color: #212529;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1030;
    transition: left 0.3s ease;
    padding: 0 1rem;
  }
  #sidebar.collapsed ~ footer {
    left: 70px;
  }
  /* Botón perfil a la derecha mejorado */
  .profile-btn {
    margin-left: auto;
    display: flex;
    align-items: center;
    background: white;
    color: #dc3545;
    font-weight: 600;
    border-radius: 30px;
    padding: 0.3rem 0.8rem;
    font-size: 0.9rem;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  .profile-btn:hover {
    background-color: #f8d7da;
    color: #a71d2a;
  }
  .profile-btn i {
    margin-right: 0.5rem;
    font-size: 1.2rem;
  }
  /* Responsive */
  @media (max-width: 768px) {
    #sidebar {
      transform: translateX(-100%);
      width: 250px !important;
      z-index: 1040;
    }
    #sidebar.show {
      transform: translateX(0);
    }
    #sidebar.collapsed {
      width: 250px !important;
    }
    #content {
      margin-left: 0 !important;
    }
    #sidebar.collapsed ~ #content {
      margin-left: 0 !important;
    }
    footer {
      left: 0 !important;
    }
    #sidebar.collapsed ~ footer {
      left: 0 !important;
    }
  }</style>
</head>
<body>
<head>
  </head>
<header>
    <button id="btnToggleSidebar" aria-label="Toggle sidebar">
        <i class="fas fa-bars"></i>
    </button>
    <img src="../Public/logo.png" alt="Logo Gym" class="rounded-circle me-2" style="width:40px; height:40px; object-fit:cover;" />
    <h5 class="mb-0">Spartan Fitness🏋️</h5>

    <!-- Botón perfil mejorado -->
    <button class="profile-btn" id="profileBtn" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-user-circle"></i> <?php echo htmlspecialchars($nombreUsuario); ?>
    </button>

    </ul>
</header>

<nav id="sidebar" class="">
  <ul class="nav flex-column">
    <li>
      <button class="btn-toggle nav-link text-start w-100 d-flex align-items-center" data-bs-toggle="collapse" data-bs-target="#submenuClientes" aria-expanded="false" aria-controls="submenuClientes">
        <i class="fas fa-user"></i><span class="text-label"> Clientes &amp; Membresías</span>
        <i class="fas fa-chevron-down ms-auto"></i>
      </button>
      <div class="collapse" id="submenuClientes">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
          <li><a href="#" class="nav-link" data-page="registrar-membresia">Registrar Membresía</a></li>
          <li><a href="#" class="nav-link" data-page="ver-membresias">Ver Membresías</a></li>
          <li><a href="#" class="nav-link" data-page="buscar-cliente">Buscar Cliente</a></li>
        </ul>
      </div>
    </li>
    <li>
      <button class="btn-toggle nav-link text-start w-100 d-flex align-items-center" data-bs-toggle="collapse" data-bs-target="#submenuVentas" aria-expanded="false" aria-controls="submenuVentas">
        <i class="fas fa-shopping-cart"></i><span class="text-label"> Ventas</span>
        <i class="fas fa-chevron-down ms-auto"></i>
      </button>
      <div class="collapse" id="submenuVentas">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
          <li><a href="#" class="nav-link" data-page="nueva-venta">Nueva Venta</a></li>
          <li><a href="#" class="nav-link" data-page="historial-ventas">Historial de Ventas</a></li>
          <li><a href="#" class="nav-link" data-page="consultar-stock">Consultar Stock</a></li>
        </ul>
      </div>
    </li>
    <li>
      <button class="btn-toggle nav-link text-start w-100 d-flex align-items-center" data-bs-toggle="collapse" data-bs-target="#submenuReportes" aria-expanded="false" aria-controls="submenuReportes">
        <i class="fas fa-chart-bar"></i><span class="text-label"> Reportes Básicos</span>
        <i class="fas fa-chevron-down ms-auto"></i>
      </button>
      <div class="collapse" id="submenuReportes">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
          <li><a href="#" class="nav-link" data-page="resumen-diario">Resumen Diario</a></li>
          <li><a href="#" class="nav-link" data-page="actividad-fecha">Actividad por Fecha</a></li>
        </ul>
      </div>
    </li>
    <li>
      <button class="btn-toggle nav-link text-start w-100 d-flex align-items-center" data-bs-toggle="collapse" data-bs-target="#submenuCuenta" aria-expanded="false" aria-controls="submenuCuenta">
        <i class="fas fa-cog"></i><span class="text-label"> Mi Cuenta</span>
        <i class="fas fa-chevron-down ms-auto"></i>
      </button>
      <div class="collapse" id="submenuCuenta">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li>
            <a href="#" class="d-flex align-items-center w-100 px-3 py-2" style="color: white; text-decoration: none; border-radius: 4px; transition: background 0.3s;" data-page="perfil" onmouseover="this.style.background='#C62828'" onmouseout="this.style.background='transparent'">
              <i class="fas fa-user-cog me-2"></i>
              <span class="text-label">Perfil / Cambiar Contraseña</span>
            </a>
            </li>
            <li>
            <a href="cerrar_sesion.php" class="d-flex align-items-center w-100 px-3 py-2 text-danger" style="text-decoration: none; border-radius: 4px; transition: background 0.3s;" data-page="logout" onmouseover="this.style.background='#f8d7da'" onmouseout="this.style.background='transparent'">
              <i class="fas fa-sign-out-alt me-2"></i>
              <span class="text-label">Cerrar Sesión</span>
            </a>
            </li>

        </ul>
      </div>
    </li>
  </ul>
</nav>

<main id="content">
  <div id="pageContent">
    <h2>Bienvenido a FitEcuador Gym</h2>
    <p>Selecciona una opción en el menú para comenzar.</p>
  </div>
</main>

<footer>
  &copy; 2025 Gimnasio FitEcuador - Todos los derechos reservados
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const sidebar = document.getElementById('sidebar');
  const btnToggle = document.getElementById('btnToggleSidebar');
  const content = document.getElementById('content');
  const navLinks = sidebar.querySelectorAll('a.nav-link');
  const btnToggles = sidebar.querySelectorAll('.btn-toggle');

  // Toggle sidebar collapsed (desktop) or show/hide (mobile)
  btnToggle.addEventListener('click', () => {
    if(window.innerWidth <= 768) {
      sidebar.classList.toggle('show');
    } else {
      sidebar.classList.toggle('collapsed');
      updateNavLabels();
    }
  });

  // Manejar clicks en botones que abren submenús
  btnToggles.forEach(btn => {
    btn.addEventListener('click', e => {
      e.preventDefault();
      // Si sidebar está colapsado, expandir y no abrir submenu
      if(sidebar.classList.contains('collapsed')) {
        sidebar.classList.remove('collapsed');
        updateNavLabels();
      } else {
        // Toggle submenu con Bootstrap Collapse
        const collapseEl = document.querySelector(btn.getAttribute('data-bs-target'));
        const bsCollapse = bootstrap.Collapse.getInstance(collapseEl);
        if(bsCollapse) {
          bsCollapse.toggle();
        } else {
          new bootstrap.Collapse(collapseEl, { toggle: true });
        }
      }
    });
  });

  // Manejar clicks en enlaces para carga dinámica
  navLinks.forEach(link => {
    link.addEventListener('click', e => {
      e.preventDefault();

      // Ignorar clicks en enlaces que abren submenus
      if(link.classList.contains('btn-toggle')) return;

      // Cambiar active class
      navLinks.forEach(l => l.classList.remove('active'));
      link.classList.add('active');

      // Obtener página para cargar
      const page = link.dataset.page;
      loadPage(page);

      // Cerrar sidebar en móvil
      if(window.innerWidth <= 768) {
        sidebar.classList.remove('show');
      }
    });
  });
function loadPage(page) {
    $('#pageContent').html(`
        <div class="text-center py-5">
            <div class="spinner-border text-danger mb-3" role="status"></div>
            <p>Cargando ${page}...</p>
        </div>
    `);

    fetch(`${page}.php`)
        .then(response => {
            if (!response.ok) throw new Error("Página no encontrada");
            return response.text();
        })
        .then(html => {
            $('#pageContent').html(html);
        })
        .catch(err => {
            $('#pageContent').html(`<div class="alert alert-danger">Error al cargar: ${page}</div>`);
        });
}

  // Ocultar texto etiquetas si sidebar está colapsado y cerrar submenús
  function updateNavLabels() {
    if(sidebar.classList.contains('collapsed')) {
      sidebar.querySelectorAll('.text-label').forEach(span => {
        span.style.display = 'none';
      });
      // Cerrar todos los submenús abiertos
      document.querySelectorAll('#sidebar .collapse.show').forEach(collapseEl => {
        const bsCollapse = bootstrap.Collapse.getInstance(collapseEl);
        if(bsCollapse) bsCollapse.hide();
      });
    } else {
      sidebar.querySelectorAll('.text-label').forEach(span => {
        span.style.display = 'inline';
      });
    }
  }

  updateNavLabels();

  // Cerrar sidebar móvil si se cambia tamaño
  window.addEventListener('resize', () => {
    if(window.innerWidth > 768) {
      sidebar.classList.remove('show');
    }
  });
</script>

</body>
</html>
