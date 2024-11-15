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
error_log(var_export($pm, 1));
if ($pm['type'] == 'png' or $pm['type'] == 'jpg')
{
  $file = "<img src=\"" . $config['courses_url'] . '/' . $pm['file'] . "\">";
}
elseif ($pm['type'] == 'mp4')
{
  $file = "<video id=\"videoPromo{$pm['id']}\" src=\"" . $config['courses_url'] . '/' . $pm['file'] . "\" class=\"promo-video\" controls></video>";
}
?>

<div id="promoContent<?= $pm['id'] ?>" style="display: flex; flex-direction: column; align-items: center; max-width: max-content; position: relative;">

  <div class="course-image">
    <?= $file ?>
    <?php if ($pm['type'] == 'mp4'): ?>
      <!-- Botón Play -->
      <button class="btn play-button" onclick="playVideo(<?= $pm['id'] ?>)">
        <i class="material-icons">play_arrow</i>
      </button>
    <?php endif; ?>
  </div>
</div>