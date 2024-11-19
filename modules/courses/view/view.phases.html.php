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
      Entrenamiento
    </div>
  </div>

  <div class="item-row">
    <?php foreach ($phases as $phase): ?>
      <div id="phase<?= $phase['id'] ?>" class="course-item" style="display: flex; flex-direction: column; align-items: center;max-width: max-content;" onclick="location.href='<?= gLink('courses/view.phase', ['phase_id' => $phase['id']]) ?>'">

        <div class="course-image">
          <img src="<?= $config['phases_url'] . '/' . $phase['image'] ?>">
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>