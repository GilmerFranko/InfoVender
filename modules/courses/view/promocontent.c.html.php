<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Componente de un Contenido Promocional
 *
 *
 */
if ($pm['type'] == 'png' or $pm['type'] == 'jpg')
{
  $file = "<img src=\"" . $config['courses_url'] . '/' . $pm['file'] . "\" class=\"responsive-img promo-image\" data-image-url=\"" . $config['courses_url'] . '/' . $pm['file'] . "\" alt=\"Promo Image\">";
}
elseif ($pm['type'] == 'mp4')
{
  // Código para manejar videos MP4 con imagen generada y reproducción
  $file = "<div class=\"course-image\">
              <video id=\"videoPromo{$pm['id']}\" 
                     src=\"" . $config['courses_url'] . '/' . $pm['file'] . "\" 
                     class=\"promo-video responsive-video\" 
                     style=\"display:none;\" 
                     preload=\"auto\" controls></video>

              <canvas id=\"videoCanvas{$pm['id']}\" width=\"320\" height=\"180\" style=\"display:none;\"></canvas>

              <img id=\"promoImage{$pm['id']}\" 
                   src=\"\" 
                   alt=\"Promo Image\" 
                   class=\"responsive-img promo-video\" 
                   data-video-id=\"videoPromo{$pm['id']}\" 
                   data-video-id2=\"{$pm['id']}\" 
                   data-video-url=\"" . $config['courses_url'] . '/' . $pm['file'] . "\">
            </div>";
}

?>

<div id="promoContent<?= $pm['id'] ?>" style="display: flex; flex-direction: column; align-items: center; max-width: max-content; position: relative;">
  <div class="course-image">
    <?= $file ?>
    <?php if ($pm['type'] == 'mp4'): ?>
      <button class="btn play-button" onclick="playVideo(<?= $pm['id'] ?>)">
        <i class="material-icons">play_arrow</i>
      </button>
    <?php endif; ?>
  </div>
</div>

<div id="imageModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4); max-height: 100vh; backdrop-filter:blur(5px);">
  <div class="modal-content" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #ffffff08; padding: 20px;max-width: 90%; max-height: 90%; overflow: auto; text-align: center;">
    <span class="close-modal" style="position: absolute; top: 10px; right: 25px; font-size: 35px; font-weight: bold; cursor: pointer; color: red !important;">&times;</span>
    <img id="modalImage" src="" alt="Modal Image" style="max-width: 100%; max-height: calc(100vh - 100px); display: block; margin: 0 auto;">
    <a id="downloadLink" href="" download="" style="display: block; margin-top: 10px; padding: 8px 16px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 4px;">Descargar</a>
  </div>
</div>