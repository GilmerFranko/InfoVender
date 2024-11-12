<?php defined('VCO') || exit;
/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @Description Extension de Vista de la página de cursos
 */
?>
<br>
<style>
  .buttons-options {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .button-option {
    margin: 0 1rem;
  }

  .button-option a {
    border-radius: 50px;
    background-color: #278D46;
    color: #fff;
    font-size: 18px;
    padding: 1rem 2rem;
    border: none;
    cursor: pointer;
  }

  .button-option a:hover {
    background-color: #1e8e5c;
  }
</style>

<div class="buttons-options">
  <!-- Boton descargar -->
  <div class="button-option">
    <a href="<?= $config['courses_url'] . '/' . $course['pdf'] ?>" target="_blank">Descargar PDF</a>
  </div>
  <!-- Boton Drive Videos-->
  <div class="button-option">
    <a href="<?= $config['courses_url'] . '/' . $course['video'] ?>" target="_blank">Ver Video</a>
  </div>
</div>
<!--</section>-->