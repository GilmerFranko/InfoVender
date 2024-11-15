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

<div id="course<?= $course['id'] ?>" style="display: flex; flex-direction: column; align-items: center;max-width: max-content;" onclick="location.href='<?= gLink('courses/view.course', ['course_id' => $course['id']]) ?>'">

  <div class="course-image">
    <div class="card-action" style="position: relative;top: 0px;left: 50px;z-index: 1;text-align: right;">
      <a class="btn btn-small waves-effect waves-light blue" href="<?= gLink('admin/edit.course', ['course_id' => $course['id']]) ?>">
        <i class="material-icons">edit</i>
      </a>
    </div>
    <img src="<?= $config['courses_url'] . '/' . $course['image'] ?>">
  </div>
  <div class="card-content">
    <strong class="course-name"><?= $course['name'] ?></strong>
  </div>
</div>