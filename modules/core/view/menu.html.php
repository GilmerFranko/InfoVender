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
  <?php if ($session->is_admod and $sModule != 'admin'): ?>
    <div class="top-nav" style="position: fixed; top: 0; right: 0; background: #23282d; z-index: 1000; width: 100%; text-align: right; padding: 8px 16px;">
      <ul style="list-style: none; margin: 0; padding: 0; display: inline-block;">
        <li style="display: inline-block; margin-right: 15px;"><a href="<?php echo $extra->generateUrl('admin', 'dashboard') ?>" class="white-text">Dashboard</a></li>
        <li style="display: inline-block; margin-right: 15px;"><a href="<?php echo $extra->generateUrl('admin', 'configuration') ?>" class="white-text">Configuración</a></li>
        <li style="display: inline-block; margin-right: 15px;"><a href="<?php echo $extra->generateUrl('admin', 'courses') ?>" class="white-text">Cursos</a></li>
        <li style="display: inline-block;"><a href="<?= gLink('members/logout', ['token' => $session->token]) ?>" class="white-text">Salir</a></li>
      </ul>
    </div>
  <?php endif ?>
  <nav class="black darken-3">
    <div class="nav-wrapper center" style="max-width: 1300px; margin:auto">
      <div class="center-align">
        <img src="<?= $config['images_url'] . DS . 'logo.png' ?>" class="png-logo center" alt="">
      </div>
      <?php if ($session->is_member): ?>
        <!-- Menú principal alineado al centro -->
        <ul class="center-align hide-on-med-and-down" style="display: flex; justify-content: space-between; gap: 2rem; margin-top:18px; margin-bottom: 35px;">
          <li><a href="<?= gLink('catalogo') ?>" class="white-text valign-wrapper"><img src="<?= $config['images_url'] . '/dollar.png' ?>" class="icon-menu-item" class="white-text" />Catalogo$</a></li>
          <li><a href="<?= gLink('entrenamiento') ?>" class="white-text valign-wrapper"><img src="<?= $config['images_url'] . '/birrete.png' ?>" class="icon-menu-item" class="white-text valign-wrapper" />Entrenamiento$</a></li>
          <li><a href="<?= gLink('revendedores') ?>" class="white-text valign-wrapper"><img src="<?= $config['images_url'] . '/birrete.png' ?>" class="icon-menu-item" class="white-text valign-wrapper" />Revendedores$</a></li>
          <li><a href="<?= gLink('contactanos') ?>" class="white-text valign-wrapper"><img src="<?= $config['images_url'] . '/whatsapp.png' ?>" class="icon-menu-item" class="white-text valign-wrapper" />WhatsApp$</a></li>
        </ul>
        <!-- Menú para dispositivos móviles -->
        <ul class="center-align hide-on-large-only" style="display: flex; align-items: center; gap: 1rem; margin-top:18px; margin-bottom: 35px;">
          <li><a href="<?= gLink('catalogo') ?>" class="white-text valign-wrapper"><img src="<?= $config['images_url'] . '/dollar.png' ?>" class="icon-menu-item" class="white-text valign-wrapper" />Catalogo$</a></li>
          <li><a href="<?= gLink('entrenamiento') ?>" class="white-text valign-wrapper"><img src="<?= $config['images_url'] . '/birrete.png' ?>" class="icon-menu-item" class="white-text valign-wrapper" />Entrenamiento$</a></li>
          <li><a href="<?= gLink('revendedores') ?>" class="white-text valign-wrapper"><img src="<?= $config['images_url'] . '/birrete.png' ?>" class="icon-menu-item" class="white-text valign-wrapper" />Revendedores$</a></li>
          <li><a href="<?= gLink('contactanos') ?>" class="white-text valign-wrapper"><img src="<?= $config['images_url'] . '/whatsapp.png' ?>" class="icon-menu-item" class="white-text valign-wrapper" />WhatsApp$</a></li>
        </ul>
      <?php else: ?>
        <ul class="center-align hide-on-med-and-down" style="display: flex; justify-content: space-between; gap: 2rem; margin-top:18px; margin-bottom: 35px;">
          <li><a href="<?= gLink('login') ?>" class="white-text"><i class="material-icons left">lock_open</i>Iniciar Sesión</a></li>
        </ul>
        <!-- Menú para dispositivos móviles -->
        <ul class="center-align hide-on-large-only" style="display: flex; flex-direction: column; align-items: center; gap: 1rem; margin-top:18px; margin-bottom: 35px;">
          <li><a href="<?= gLink('login') ?>" class="white-text"><i class="material-icons left">lock_open</i>Iniciar Sesión</a></li>
        </ul>
      <?php endif ?>
    </div>
  </nav>
</header>

<style>
  /* Estilos personalizados */
  .nav-wrapper {
    padding: 0 1rem;
  }

  .png-logo {
    display: block;
    position: unset !important;
    width: 100%;
    max-width: max-content;
  }

  @media (max-width: 600px) {
    .png-logo {
      width: 62vw;
    }
  }

  nav ul li a {
    font-size: 1.6rem;
    font-weight: 300;
  }

  /* Colores para los íconos */
  .icon-green {
    color: #4caf50;
    /* Verde para el ícono de Catalogo$ */
  }

  .icon-blue {
    color: #2196f3;
    /* Azul para el ícono de Entrenamiento$ */
  }

  .icon-light-green {
    color: #66bb6a;
    /* Verde claro para el ícono de WhatsApp$ */
  }
</style>