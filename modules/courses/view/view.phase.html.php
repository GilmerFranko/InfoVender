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
  <p class="antiqua center" style="font-size: 60pt; margin:0;"><?= $phase['title'] ?></p>

  <div class="contentPhase">
    <?= tobr($parser->getAsHTML()) ?>
  </div>
</section>

<style>
  .contentPhase {}
</style>


<?php require Core::view('footer', 'core'); ?>