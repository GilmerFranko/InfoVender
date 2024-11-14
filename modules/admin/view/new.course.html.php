<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @autor Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de nuevo curso
 *
 *
 */

require Core::view('head', 'core');

$useExampleValues = true; // Cambiar a true para usar valores de ejemplo

?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/default.min.css" />
<script src="https://cdn.jsdelivr.net/npm/sceditor@3/minified/sceditor.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sceditor@3/minified/formats/bbcode.min.js"></script>
<section id="adminNewCourse">
  <div class="card-panel green lighten-4 green-text text-darken-4 flow-text center-align"><?= $page['name'] ?></div>
  <div class="sectionCourses container">
    <div class="row">
      <form class="col s12" id="newCourseForm" method="POST" action="<?php echo Core::model('extra', 'core')->generateUrl('admin', 'new.course', null, array('do' => 'new')); ?>" enctype="multipart/form-data">

        <div class="input-field">
          <label for="name">Nombre</label>
          <input type="text" name="name" id="name" value="<?php echo $useExampleValues ? 'Ejemplo de Curso' : Core::model('extra', 'core')->getInputValue('name', 'post'); ?>" required>
        </div>

        <div class="input-field">
          <label for="recommended_description">Descripción recomendada</label>
          <textarea name="recommended_description" id="recommended_description" class="materialize-textarea wysiwyg-editor" required><?php echo $useExampleValues ? 'Descripción de ejemplo para el curso.' : Core::model('extra', 'core')->getInputValue('recommended_description', 'post'); ?></textarea>
        </div>

        <div class="input-field">
          <label for="segmentation">Segmentación</label>
          <textarea name="segmentation" id="segmentation" class="materialize-textarea" required><?php echo $useExampleValues ? 'Segmentación de ejemplo.' : Core::model('extra', 'core')->getInputValue('segmentation', 'post'); ?></textarea>
        </div>

        <div class="input-field">
          <label for="suggested_daily_investment">Inversión diaria sugerida</label>
          <input type="number" name="suggested_daily_investment" id="suggested_daily_investment" value="<?php echo $useExampleValues ? '100' : Core::model('extra', 'core')->getInputValue('suggested_daily_investment', 'post'); ?>" required>
        </div>

        <div class="input-field">
          <label for="pdf_link">Enlace PDF</label>
          <input type="text" name="pdf_link" id="pdf_link" value="<?php echo $useExampleValues ? 'http://example.com/curso.pdf' : Core::model('extra', 'core')->getInputValue('pdf_link', 'post'); ?>">
        </div>

        <div class="input-field">
          <label for="video_link">Enlace de video</label>
          <input type="text" name="video_link" id="video_link" value="<?php echo $useExampleValues ? 'http://example.com/video.mp4' : Core::model('extra', 'core')->getInputValue('video_link', 'post'); ?>">
        </div>

        <div class="">
          <input id="image" type="file" name="image" required>
          <label for="image">Imagen</label>
        </div>

        <br>
        <button class="btn waves-effect waves-light green" type="submit"><i class="material-icons right notranslate">send</i>Crear nuevo curso</button>
      </form>
    </div>
  </div>
</section>

<!-- Footer -->
<?php require Core::view('footer', 'core'); ?>
<!-- / Footer -->

<!-- JS adicional -->
<script type="text/javascript" src="<?php echo $config['base_url']; ?>/static/js/admin.js"></script>
<script>
  // Inicializa SCEditor en el textarea
  const $textarea = $('.wysiwyg-editor');
  sceditor.create($textarea[0], {
    format: 'bbcode',
    style: 'https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/content/default.min.css',
    locale: 'es', // Ajusta el idioma si es necesario
    width: '100%',
    height: '200px',
  });
</script>