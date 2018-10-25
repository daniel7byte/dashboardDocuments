<div class="sidebar__scroll">
  <div>
    <div class="sidebar__user">
      <div class="sidebar__user-avatar">
        <span class="sidebar__user-avatar-placeholder">
          <span class="ua-icon-avatar-placeholder"></span>
        </span>
      </div>
    </div>
    <ul class="sidebar-nav">
      <li class="sidebar-nav__item">
        <a class="sidebar-nav__link" href="home.php">
          <span class="sidebar-nav__item_icon ua-icon-home"></span>
          <span class="sidebar-nav__item-text">Inicio</span>
        </a>
      </li>
      <li class="sidebar-nav__item">
        <a class="sidebar-nav__link" href="home_storage.php">
          <span class="sidebar-nav__item_icon ua-icon-folder"></span>
          <span class="sidebar-nav__item-text">Documentos</span>
        </a>
      </li>
      <li class="sidebar-nav__item">
        <a class="sidebar-nav__link" href="home_news.php">
          <span class="sidebar-nav__item_icon ua-icon-calendar"></span>
          <span class="sidebar-nav__item-text">Noticias</span>
        </a>
      </li>
      <?php if($_SESSION['role'] == "ADMIN"): ?>
        <li class="sidebar-nav__item">
          <a class="sidebar-nav__link" href="users.php">
            <span class="mdi mdi-account-multiple sidebar-section-nav__item-icon"></span>
            <span class="sidebar-nav__item-text">Admin - Usuarios</span>
          </a>
          <ul class="sidebar-subnav" style="display: none;">
            <li class="sidebar-subnav__item"><a class="sidebar-subnav__link" href="users.php">Usuarios</a></li>
            <li class="sidebar-subnav__item"><a class="sidebar-subnav__link" href="users_new.php">Crear nuevo</a></li>
          </ul>
        </li>
        <li class="sidebar-nav__item">
          <a class="sidebar-nav__link" href="storage.php">
            <span class="sidebar-nav__item_icon ua-icon-folder"></span>
            <span class="sidebar-nav__item-text">Admin - Documentos</span>
          </a>
          <ul class="sidebar-subnav" style="display: none;">
            <li class="sidebar-subnav__item"><a class="sidebar-subnav__link" href="storage.php">Documentos</a></li>
            <li class="sidebar-subnav__item"><a class="sidebar-subnav__link" href="storage_new.php">Crear nuevo</a></li>
          </ul>
        </li>
        <li class="sidebar-nav__item">
          <a class="sidebar-nav__link" href="news.php">
            <span class="sidebar-nav__item_icon ua-icon-calendar"></span>
            <span class="sidebar-nav__item-text">Admin - Noticias</span>
          </a>
          <ul class="sidebar-subnav" style="display: none;">
            <li class="sidebar-subnav__item"><a class="sidebar-subnav__link" href="news.php">Noticia</a></li>
            <li class="sidebar-subnav__item"><a class="sidebar-subnav__link" href="news_new.php">Crear nueva</a></li>
          </ul>
        </li>
        <li class="sidebar-nav__item">
          <a class="sidebar-nav__link" href="zones.php">
            <span class="sidebar-nav__item_icon ua-icon-tasks"></span>
            <span class="sidebar-nav__item-text">Admin - Zonas</span>
          </a>
          <ul class="sidebar-subnav" style="display: none;">
            <li class="sidebar-subnav__item"><a class="sidebar-subnav__link" href="zones.php">Zonas</a></li>
            <li class="sidebar-subnav__item"><a class="sidebar-subnav__link" href="zones_new.php">Crear nueva</a></li>
          </ul>
        </li>
        <li class="sidebar-nav__item">
          <a class="sidebar-nav__link" href="report_list.php">
            <span class="sidebar-nav__item_icon ua-icon-list"></span>
            <span class="sidebar-nav__item-text">Reportes de lectura</span>
          </a>
        </li>
      <?php endif; ?>
      <?php if($_SESSION['role'] == "USER"): ?>
        <li class="sidebar-nav__item">
          <a class="sidebar-nav__link" href="#" onclick="create_report(<?=$_SESSION['id']?>);">
            <span class="sidebar-nav__item_icon ua-icon-check"></span>
            <span class="sidebar-nav__item-text">Reportar Lectura</span>
          </a>
        </li>
        <script>
          function create_report(id) {
            $.ajax({
            type: 'POST',
              url: 'report.php',
              data: {
                id: id
              },
              success: function(result){
                alert(result);
              }
            });
          }
        </script>
      <?php endif; ?>
      <li class="sidebar-nav__item">
        <a class="sidebar-nav__link" href="my_account.php">
          <span class="sidebar-nav__item_icon ua-icon-person"></span>
          <span class="sidebar-nav__item-text">Cambiar contraseña</span>
        </a>
      </li>
      <li class="sidebar-nav__item">
        <a class="sidebar-nav__link" href="auth/logout.php">
          <span class="sidebar-nav__item_icon ua-icon-close"></span>
          <span class="sidebar-nav__item-text">Cerrar sesión</span>
        </a>
      </li>
    </ul>
  </div>

  <div class="sidebar-nav__footer">
    <div class="sidebar__collapse">
      <span class="icon ua-icon-collapse-left-arrows"></span>
    </div>
  </div>
</div>