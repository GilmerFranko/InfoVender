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
    flex-wrap: wrap;
  }

  .button-option {
    margin: 0 1rem;
    margin-bottom: 3rem;
  }

  @media (max-width: 600px) {
    .button-option a {
      font-size: 14px !important;
      padding: 0.8rem 1.5rem;
    }
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
    <a href="<?= $course['pdf_link'] ?>" target="_blank">IR AL DRIVE DEL CURSO</a>
  </div>
</div>

<br>


<?php require Core::view('view.promocontent', 'courses'); ?>

<!--</section>-->