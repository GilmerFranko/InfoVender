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

<div id="course<?= $course['id'] ?>" class="course-item" style="display: flex; flex-direction: column; align-items: center;max-width: max-content;" onclick="location.href='<?= gLink('courses/view.course', ['course_id' => $course['id']]) ?>'">

  <div class="course-image">
    <?php if ($session->is_admod): ?>
      <div class="course-card-action" style="position: absolute;margin-top: 0px;margin-left: 227px;z-index: 1;text-align: right;">
        <a class="btn btn-small waves-effect waves-light blue" href="<?= gLink('admin/edit.course', ['course_id' => $course['id']]) ?>">
          <i class="material-icons">edit</i>
        </a>
      </div>
    <?php endif; ?>
    <img src="<?= $config['courses_url'] . '/' . $course['image'] ?>">
  </div>
  <div class="card-content center" style="margin-top:8px;">
    <strong class="course-name"><?= $course['name'] ?></strong>
  </div>
</div>