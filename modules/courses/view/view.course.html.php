<?php defined('VCO') || exit;
/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @Description Vista de la página de cursos
 */
// HEADER
require Core::view('head', 'core');
?>

<!-- Header -->
<?php require Core::view('menu', 'core'); ?>
<!-- / Header -->

<section style="padding: 2rem; color: #fff; background-color: #000;">
  <p class="antiqua center" style="font-size: 60pt; margin:0;"><?= $course['name'] ?></p>

  <div style="display: flex;justify-content: center;align-items: flex-start;">
    <!-- Imagen del curso -->
    <div style="">
      <img class="course_img" src="<?= $config['courses_url'] . '/' . $course['image'] ?>" alt="Curso <?= $course['name'] ?>">
    </div>
    <!-- Descripción del curso -->
    <div class="item_course_info">
      <p>Formato:
        <span class="text-cian">
          <?= !is_null($course['pdf_link']) && !is_null($course['video_link']) ? 'Video y PDF' : (!is_null($course['pdf_link']) ? 'PDF' : (!is_null($course['video_link']) ? 'Video' : 'No disponible')) ?>
        </span>
      </p>
      <p>Segmentación: <span class="text-cian"><?= $course['segmentation'] ?></p>
      <p>Inversión diaria sugerida: <span class="text-cian">$<?= $course['suggested_daily_investment'] ?> USD</span></p>
      <hr style="border: 1px solid #fff; margin-top: 40px">
      <h2 style="font-size: 1.5rem; font-weight: bold; text-align: left;">Descripción recomendada:</h2>
      <div class="recomendation-description">
        <?= tobr($parser->getAsHTML()) ?>
      </div>
    </div>
  </div>

  <br>
  <?php require Core::view('courses.options', 'courses'); ?>
</section>

<style>
  .item_course_info {
    margin-left: 2rem;
    font-size: 24px;
    text-align: left;
    max-width: 500px;
    font-family: Arial;
    font-weight: 800;

    .text-cian {
      color: #5CE1E6 !important;
    }

    p {
      margin: 0 !important;
    }
  }

  .course_img {
    width: 400px;
  }

  .recomendation-description {
    text-align: left;
    font-size: 1rem;
    line-height: 1.5;
    background: white;
    color: black;
    font-weight: 100;
    font-size: 12px;
    padding: 5px;
  }
</style>


<?php require Core::view('footer', 'core'); ?>