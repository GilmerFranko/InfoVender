<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Componente de un curso
 *
 *
 */
?>

<div id="course<?= $course['id'] ?>" style="display: flex; flex-direction: column; align-items: center;max-width: max-content;">
  <a class="item-course" href="<?= gLink('courses/view', ['course_id' => $course['id']]) ?>">
    <div class="course-image">
      <img src="<?= $config['courses_url'] . '/' . $course['image'] ?>">
    </div>
    <div class="card-content">
      <strong class="course-name"><?= $course['name'] ?></strong>
    </div>
  </a>
</div>