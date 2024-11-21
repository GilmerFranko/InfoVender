<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de la página de los cursos del top20
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
      <?= $page['name'] ?>
    </div>

    <div class="ls-filters">
      Filtros:
      <a href=""> 🔥Hot🔥 </a>
      <a href="<?= gLink('catalogo/top20') ?>"> ( top 20 ) </a> |
      <a href="<?= gLink('catalogo/buscar', ['search' => $params['search'] ?? '', 'order_by' => 'asc']) ?>"> Ultimos Publicados </a> |
      <a href="#" id="btn-search"> Buscar </a>
    </div>
    <div id="search-form" class="hide">
      <form action="<?= gLink('catalogo/buscar') ?>" method="get" style="display: flex; align-items: center;">
        <div class="input-field" style="flex-grow: 1;">
          <i class="material-icons prefix">search</i>
          <input id="search" type="text" class="validate" name="search">
          <label for="search">Buscar</label>
        </div>
        <button class="btn waves-effect waves-light" type="submit" style="margin-left: 10px;">Buscar</button>
      </form>
    </div>
  </div>

  <br><br>
  <? if ($courses['rows'] > 0): ?>
    <?php // $courses['pages']['paginator'] 
    ?>
    <div class="item-row">
      <? foreach ($courses['data'] as $course): ?>
        <?php require Core::view('course.c', 'courses'); ?>
      <? endforeach; ?>
    </div>
    <?= $courses['pages']['paginator'] ?>
  <? else: ?>
    <span class="flow-text center-align">No se han encontrado resultados</span>
  <? endif; ?>
</section>


<?php require Core::view('footer', 'core'); ?>

<script>
  $("#btn-search").on('click', function() {
    $("#search-form").toggleClass('hide');
  });
</script>