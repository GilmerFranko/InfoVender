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


?>




<section class="" id="viewsCourses" style="padding: 0 0px">
  <!--<div class="center">
    <div class="title antiqua">
      <?= $course['name'] ?>
    </div>
  </div>
  <hr style="max-width: 400px;">-->

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
    <span class="flow-text center-align">No se han encontrado contenido promocional</span>
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

  .responsive-img {
    max-width: 100%;
    height: auto;
    cursor: pointer;
    /* Cambiar el cursor al pasar por encima */
  }
</style>

<script>
  $(document).ready(function() {
    // Crear la imagen desde el fotograma inicial del video
    $('.promo-video').each(function() {
      let img = $(this);
      let videoId = img.data('video-id');
      if (videoId) {
        let video = document.getElementById(videoId);
        let canvas = document.getElementById(videoId.replace('videoPromo', 'videoCanvas'));
        let context = canvas.getContext('2d');

        video.addEventListener('canplay', function() {
          // Ajustar las dimensiones del canvas
          canvas.width = video.videoWidth / 4;
          canvas.height = video.videoHeight / 4;

          // Dibujar el fotograma en el canvas y asignarlo a la imagen
          context.drawImage(video, 0, 0, canvas.width, canvas.height);
          img.attr('src', canvas.toDataURL());
        });

        video.addEventListener('error', function() {
          console.error("Error al cargar el video:", video.src);
        });
      }
    });

    // Al hacer clic en la imagen, mostrar el video y reproducirlo
    $('.promo-video').click(function() {
      let video_id = $(this).data('video-id2')
      let img = $(this);

      let videoId = img.data('video-id');
      let video = document.getElementById(videoId);

      playVideo(video_id)

    });

    $('.promo-image').click(function() {
      var imageUrl = $(this).attr('src');
      $('#modalImage').attr('src', imageUrl);
      $('#downloadLink').attr('href', imageUrl);
      $('#downloadLink').attr('download', $(this).attr('alt').replace(/\s/g, '_') + '.png');
      $('#imageModal').show();
    });

    $('.close-modal').click(function() {
      $('#imageModal').hide();
    });

    // Cerrar el modal haciendo clic fuera de él
    $(window).click(function(event) {
      if (event.target == document.getElementById('imageModal')) {
        $('#imageModal').hide();
      }
    });
  });
</script>

<script>
  // Función para reproducir el video al hacer click en el botón de play
  function playVideo(id) {
    const video = document.getElementById('videoPromo' + id);
    const playButton = document.querySelector(`#promoContent${id} .play-button`);
    const video_img_id = '#promoImage' + id

    // Ocultar la imagen, mostrar el video y reproducirlo
    $(video_img_id).hide()
    $(video).show();
    video.play();
    playButton.style.display = 'none'; // Ocultar el botón de play
  }
</script>