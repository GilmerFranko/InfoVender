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

<section class="container" id="viewsCourses" style="padding: 0 20px">
  <div class="center">
    <div class="title">
      <h1><strong>Cátalogo</strong></h1>
    </div>

    <div class="ls-filters">
      Filtros:
      <a href=""> 🔥Hot🔥 </a>
      <a href=""> ( top 20 ) </a> |
      <a href=""> Ultimos Publicados </a> |
      <a href=""> Buscar </a>
    </div>
  </div>
  <br><br>
  <div class="row">
    <? foreach ($courses['data'] as $course): ?>
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
    <? endforeach; ?>
  </div>
</section>

<style>
  .ls-filters {
    color: #38a37f !important;
    font-size: 18px;
    font-weight: 600;

    a {
      color: #38a37f !important;
      font-weight: 600;
    }
  }

  .item-course {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .course-image {
    img {
      width: 270px;
    }
  }

  .row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 0fr));
    gap: 1.5rem;
    justify-items: center;
    justify-content: space-evenly;
  }


  .item-course .card-content {
    text-align: center;
  }

  .course-name {
    font-size: 18px;
    font-weight: 600;
  }
</style>