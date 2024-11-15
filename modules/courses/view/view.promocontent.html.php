<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de la página de cursos
 *
 *
 */
// HEADER
require Core::view('head', 'core');
?>

<!-- Header -->
<?php require Core::view('menu', 'core'); ?>
<!-- / Header -->



<section class="" id="viewsCourses" style="padding: 0 0px">
  <div class="center">
    <div class="title antiqua">
      <?= $course['name'] ?>
    </div>
  </div>
  <hr style="max-width: 400px;">

  <div class="center">
    <div class="antiqua" style="font-size: 2rem;">
      Contenido Promocional
    </div>
  </div>
  <br>
  <? if ($promotionalContents != false): ?>
    <div style="display: flex;gap: 40px;justify-content: center;">
      <? foreach ($promotionalContents as $pm): ?>
        <?php require Core::view('promocontent.c', 'courses'); ?>
      <? endforeach; ?>
    </div>
  <? else: ?>
    <span class="flow-text center-align">No se han encontrado resultados</span>
  <? endif; ?>
</section>


<?php require Core::view('footer', 'core'); ?>

<script>
  $("#btn-search").on('click', function() {
    $("#search-form").toggleClass('hide');
  });
</script>


<style>
  /* Estilos para que el video ocupe todo el contenedor */
  .promo-video {
    width: 100%;
    height: auto;
    background-color: #2d2d2d33;
  }

  /* Estilo para el botón de play */
  .play-button {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    font-size: 30px;
    border-radius: 25%;
  }
</style>

<script>
  // Función para reproducir el video al hacer click en el botón de play
  function playVideo(id) {
    const video = document.getElementById('videoPromo' + id);
    const playButton = document.querySelector(`#promoContent${id} .play-button`);

    video.play();
    playButton.style.display = 'none'; // Ocultar el botón de play
  }
</script>