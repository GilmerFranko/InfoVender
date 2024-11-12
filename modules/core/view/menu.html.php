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
        <li style="display: inline-block;"><a href="<?php echo $extra->generateUrl('members', 'logout') ?>" class="white-text">Salir</a></li>
      </ul>
    </div>
  <?php endif ?>
  <nav class="black darken-3">
    <div class="nav-wrapper center" style="max-width: 1300px; margin:auto">
      <a href="#" class="text-logo center">LOGO</a>
      <br>
      <!-- Menú principal alineado al centro -->
      <ul class="center-align hide-on-med-and-down" style="display: flex; justify-content: space-between; gap: 2rem; margin-top:55px; margin-bottom: 35px;">
        <li><a href="<?= gLink('catalogo') ?>" class="white-text"><i class="material-icons left">attach_money</i>Catalogo$</a></li>
        <li><a href="<?= gLink('entrenamiento') ?>" class="white-text"><i class="material-icons left">school</i>Entrenamiento$</a></li>
        <li><a href="https://wa.me/<?= $config['num_phone'] ?>?text=Hola" class="white-text" target="_blank"><i class="material-icons left icon-light-green">whatsapp</i>WhatsApp$</a></li>
      </ul>
    </div>
  </nav>
</header>

<style>
  /* Estilos personalizados */
  .nav-wrapper {
    padding: 0 1rem;
  }

  .text-logo {
    font-weight: bold;
    font-size: 57pt !important;
    position: unset !important;
  }

  nav ul li a {
    font-size: 2rem !important;
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