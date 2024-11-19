<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de la página para descargar links de un curso
 *
 *
 */
// HEADER
require Core::view('head', 'core');
?>

<!-- Header -->
<?php require Core::view('menu', 'core'); ?>
<!-- / Header -->



<section class="" id="viewsDownload" style="padding: 0 0px">
  <div class="center">
    <div class="title antiqua">
      <?= $course['name'] ?>
    </div>
  </div>
  <hr style="max-width: 400px;">

  <div class="center">
    <div class="antiqua" style="font-size: 2rem;">
      Descargar archivos
    </div>
    <br>
    <a class="btn btn-download" href="<?= $course['pdf_link'] ?>">DESCARGAR PDF</a>
    <br><br>
    <a class="btn btn-download" href="<?= $course['video_link'] ?>">DESCARGAR VIDEOS</a>
  </div>



</section>