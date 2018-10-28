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
          <span class="sidebar-nav__item-text"><?=HOME?></span>
        </a>
      </li>
      <li class="sidebar-nav__item">
        <a class="sidebar-nav__link" href="home_storage.php">
          <span class="sidebar-nav__item_icon ua-icon-folder"></span>
          <span class="sidebar-nav__item-text"><?=DOCUMENTS?></span>
        </a>
        <ul class="sidebar-subnav" style="display: none;">
          <li class="sidebar-subnav__item"><a class="sidebar-subnav__link" href="home_storage.php"><?=All.' '.DOCUMENTS?></a></li>
          
          <?php

            require_once("config/parameters.php");
            require_once("config/connection.php");

            $users_nick = $_SESSION['nick'];

             $query = $mysql->prepare("SELECT * FROM category ORDER BY id DESC");
            $query->execute();
            $result = $query->fetchAll();

            foreach ($result as $row):
          ?>
            <li class="sidebar-subnav__item"><a class="sidebar-subnav__link" href="home_storage_category.php?category=<?=$row['id']?>"><span class="mdi mdi-trending-neutral"></span> <?=$row['name']?></a></li>
          <?php endforeach; ?>

        </ul>
      </li>
      <!-- <li class="sidebar-nav__item">
        <a class="sidebar-nav__link" href="home_news.php">
          <span class="sidebar-nav__item_icon ua-icon-calendar"></span>
          <span class="sidebar-nav__item-text">Noticias</span>
        </a>
      </li> -->
      <?php if($_SESSION['role'] == "ADMIN" OR $_SESSION['role'] == "EDITOR"): ?>
        <li class="sidebar-nav__item">
          <a class="sidebar-nav__link" href="category.php">
            <span class="mdi mdi-flag sidebar-section-nav__item-icon"></span>
            <span class="sidebar-nav__item-text">Admin - <?=CATEGORY?></span>
          </a>
          <ul class="sidebar-subnav" style="display: none;">
            <li class="sidebar-subnav__item"><a class="sidebar-subnav__link" href="category.php"><?=CATEGORY?></a></li>
            <li class="sidebar-subnav__item"><a class="sidebar-subnav__link" href="category_new.php"><?=Create?></a></li>
          </ul>
        </li>
        <li class="sidebar-nav__item">
          <a class="sidebar-nav__link" href="users.php">
            <span class="mdi mdi-account-multiple sidebar-section-nav__item-icon"></span>
            <span class="sidebar-nav__item-text">Admin - <?=USERS?></span>
          </a>
          <ul class="sidebar-subnav" style="display: none;">
            <li class="sidebar-subnav__item"><a class="sidebar-subnav__link" href="users.php"><?=USERS?></a></li>
            <li class="sidebar-subnav__item"><a class="sidebar-subnav__link" href="users_new.php"><?=Create?></a></li>
          </ul>
        </li>
        <li class="sidebar-nav__item">
          <a class="sidebar-nav__link" href="storage.php">
            <span class="sidebar-nav__item_icon ua-icon-folder"></span>
            <span class="sidebar-nav__item-text">Admin - <?=DOCUMENTS?></span>
          </a>
          <ul class="sidebar-subnav" style="display: none;">
            <li class="sidebar-subnav__item"><a class="sidebar-subnav__link" href="storage.php"><?=DOCUMENTS?></a></li>
            <li class="sidebar-subnav__item"><a class="sidebar-subnav__link" href="storage_new.php"><?=Create?></a></li>
          </ul>
        </li>
        <!-- <li class="sidebar-nav__item">
          <a class="sidebar-nav__link" href="news.php">
            <span class="sidebar-nav__item_icon ua-icon-calendar"></span>
            <span class="sidebar-nav__item-text">Admin - Noticias</span>
          </a>
          <ul class="sidebar-subnav" style="display: none;">
            <li class="sidebar-subnav__item"><a class="sidebar-subnav__link" href="news.php">Noticia</a></li>
            <li class="sidebar-subnav__item"><a class="sidebar-subnav__link" href="news_new.php">Crear nueva</a></li>
          </ul>
        </li> -->
      <?php endif; ?>
      <li class="sidebar-nav__item">
        <a class="sidebar-nav__link" href="my_account.php">
          <span class="sidebar-nav__item_icon ua-icon-person"></span>
          <span class="sidebar-nav__item-text"><?=ChangePassword?></span>
        </a>
      </li>
      <li class="sidebar-nav__item">
        <a class="sidebar-nav__link" href="auth/logout.php">
          <span class="sidebar-nav__item_icon ua-icon-close"></span>
          <span class="sidebar-nav__item-text"><?=SignOff?></span>
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
