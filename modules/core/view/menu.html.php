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
  <nav class="black darken-3">
    <div class="nav-wrapper container">
      <a href="#" class="brand-logo center">LOGO</a>
      <br>
      <!-- Menú principal alineado al centro -->
      <ul class="center-align hide-on-med-and-down" style="display: flex; justify-content: space-between; gap: 2rem; margin-top:30px">
        <li><a href="#catalogo" class="white-text"><i class="material-icons left">attach_money</i>Catalogo$</a></li>
        <li><a href="#entrenamiento" class="white-text"><i class="material-icons left">school</i>Entrenamiento$</a></li>
        <li><a href="#whatsapp" class="white-text"><i class="material-icons left icon-light-green">whatsapp</i>WhatsApp$</a></li>
      </ul>
    </div>
  </nav>
</header>

<style>
  /* Estilos personalizados */
  .nav-wrapper {
    padding: 0 1rem;
  }

  .brand-logo {
    font-weight: bold;
    font-size: 48px !important;
  }

  nav ul li a {
    font-size: 22px !important;
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