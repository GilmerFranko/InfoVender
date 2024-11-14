<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @autor Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista para editar una Fase
 *
 *
 */

require Core::view('head', 'core');

?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/default.min.css" />
<script src="https://cdn.jsdelivr.net/npm/sceditor@3/minified/sceditor.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sceditor@3/minified/formats/bbcode.min.js"></script>
<section id="adminEditPhase">
  <form class="col s12" id="ediPhaseForm" method="POST" action="<?= gLink('admin/edit.phase', ['edit_phase' => true, 'phase_id' => $phase['id']]); ?>" enctype="multipart/form-data">
    <div class="card-panel green lighten-4 green-text text-darken-4 flow-text center-align"><?= $page['name'] ?></div>
    <br>
    <div class="input-field">
      <label for="title">Titulo</label>
      <input type="text" name="title" id="title" value="<?= $phase['title'] ?>" required>
    </div>
    <br>
    <div class="input-field">
      <label for="content">Contenido</label>
      <textarea name="content" id="content" class="materialize-textarea wysiwyg-editor" style="width: 100%;" required><?= bbbr2nl($phase['content']) ?></textarea>
    </div>
    <br>
    <div class="center-align">
      <button class="btn waves-effect waves-light green" type="submit"><i class="material-icons right notranslate">send</i>Guardar</button>
    </div>
</section>


<!-- Footer -->
<?php require Core::view('footer', 'core'); ?>
<!-- / Footer -->

<!-- JS adicional -->
<script type="text/javascript" src="<?php echo $config['base_url']; ?>/static/js/admin.js" />
</script>
<script>
  // Inicializa SCEditor en el textarea
  const $textarea = $('.wysiwyg-editor');
  sceditor.create($textarea[0], {
    format: 'bbcode',
    style: 'https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/content/default.min.css',
    locale: 'es', // Ajusta el idioma si es necesario
    width: '100%',
    height: '400px',
  });
</script>