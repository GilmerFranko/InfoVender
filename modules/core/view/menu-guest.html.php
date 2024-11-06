<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Archivo que incluye parte de la cabecera
 */
?>
<header>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <nav class="nav-fixed darken-3">
    <div class="container">
      <!-- Menu para miembros -->
      <div class="nav-wrapper">
        <!-- IZQUIERDA -->
        <a href="#" data-target="user-menu" class="sidenav-trigger left hide-on-med-and-down" style="">
          <i class="material-icons notranslate">menu</i>
        </a>
        <div class="icons">

          <!-- Logo -->
          <a href="<?php echo $config['base_url'] ?>" class="left" style="font-weight: 600;">
            <img class="hide-on-small-only" src="<?php echo $config['images_url'] . '/kingsbeet.png' ?>" alt="" style="padding: 5px; width: 108px;">

            <!-- Para dispositivos móviles -->
            <img class="hide-on-med-and-up" src="<?php echo $config['images_url'] . '/kingsbeet.png' ?>" alt="" style="padding: 5px; width: 65px; margin-top: 8px;">
          </a>

          <a href="<?php echo $extra->generateUrl('members', 'register'); ?>">
            <button class="btn btn-blue hide-on-med-and-up right align-btn-on-menu btn-lc" style="">Registrarse</button>
            <button class="btn btn-blue hide-on-small-only right align-btn-on-menu btn-lc">Registrarse</button>
          </a>
          <a href="<?php echo $extra->generateUrl('members', 'login'); ?>">
            <!--<i class="material-icons right hide-on-med-and-up">account_circle</i>-->
            <button class="btn-small btn-primary hide-on-med-and-up right align-btn-on-menu btn-lc" style="">Iniciar sesión</button>
            <button class="btn btn-primary hide-on-small-only right align-btn-on-menu btn-lc">Iniciar sesión</button>
          </a>
          <!-- FIN DERECHA -->
        </div>
      </div>
    </div>
  </nav>
</header>
<style>
  .a-icon {
    width: 8.5vw;
  }

  .a-icon i {
    text-align: center;
  }

  nav {
    position: fixed;
    top: 0 !important;
    width: 100%;
  }
</style>