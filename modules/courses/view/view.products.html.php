<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de la página de revendedores
 *
 *
 */
// HEADER
require Core::view('head', 'core');
?>

<!-- Header -->
<?php require Core::view('menu', 'core'); ?>
<!-- / Header -->



<section class="" id="viewsProducts" style="padding: 0 0px">
  <div class="center">
    <div class="title antiqua">
      Cátalogo
    </div>

    <div class="ls-filters">
      Filtros:
      <a href="<?= gLink('productos/buscar', ['search' => $params['search'] ?? '', 'order_by' => 'asc']) ?>" class="item-menu-filter"> Ultimos Publicados </a> |
      <a href="#" id="btn-search" class="item-menu-filter"> Buscar </a>
    </div>
    <div id="search-form" class="hide">
      <form action="<?= gLink('productos/buscar') ?>" method="get" style="display: flex; align-items: center;">
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
  <? if ($products['rows'] > 0): ?>
    <?php // $courses['pages']['paginator'] 
    ?>
    <div class="item-row">
      <? foreach ($products['data'] as $product): ?>
        <?php require Core::view('product.c', 'courses'); ?>
      <? endforeach; ?>
    </div>
    <?= $products['pages']['paginator'] ?>
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