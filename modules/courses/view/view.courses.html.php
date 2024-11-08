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
      Cátalogo
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
      <?php require Core::view('course.c', 'courses'); ?>
    <? endforeach; ?>
  </div>
</section>