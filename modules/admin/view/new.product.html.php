<?php defined('VCO') || exit;

/**
 * ========================================================
 *  VCO Project
 *-------------------------------------------------------
 * @autor Gilmer Franco <gil2017.com@gmail.com>
 * ========================================================
 *
 * @Description Vista de nuevo producto
 *
 *
 */

require Core::view('head', 'core');

$useExampleValues = false; // Cambiar a true para usar valores de ejemplo

?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/default.min.css" />
<script src="https://cdn.jsdelivr.net/npm/sceditor@3/minified/sceditor.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sceditor@3/minified/formats/bbcode.min.js"></script>
<section id="adminNewProduct">
  <div class="card-panel green lighten-4 green-text text-darken-4 flow-text center-align"><?= $page['name'] ?></div>
  <br>
  <div class="sectionProducts container">
    <div class="row">
      <form class="col s12" id="newProductForm" method="POST" action="<?php echo Core::model('extra', 'core')->generateUrl('admin', 'new.product', null, array('do' => 'new')); ?>" enctype="multipart/form-data">

        <div class="input-field">
          <label for="name">Nombre</label>
          <input type="text" name="name" id="name" value="<?php echo $useExampleValues ? 'Ejemplo de Producto' : Core::model('extra', 'core')->getInputValue('name', 'post'); ?>" required>
        </div>

        <div class="grid-container" style="display: flex; ">
          <div class="grid-item">
            <p class="flow-text">
              <span class="grey-text" style="  font-size: 13px;"><?php echo str_replace('https://', '', $config['base_url']) ?>/producto/</span><span class="black-text"></span>
            </p>
          </div>
          <div class="grid-item">
            <div class="input-field">
              <label id="labelslug" for="slug" style="top: 10px">Slug <small>(opcional)</small></label>
              <input type="text" name="slug" id="slug" value="" style="font-size: 13px; height: 59px;" required>
            </div>
          </div>
        </div>

        <div class="input-field">
          <label for="description">Descripción</label>
          <textarea name="description" id="description" class="materialize-textarea wysiwyg-editor" required><?php echo $useExampleValues ? 'Descripción de ejemplo para el producto.' : Core::model('extra', 'core')->getInputValue('description', 'post'); ?></textarea>
        </div>

        <div class="input-field">
          <label for="price">Precio</label>
          <input type="number" name="price" id="price" value="<?php echo $useExampleValues ? '100' : Core::model('extra', 'core')->getInputValue('price', 'post'); ?>" required>
        </div>

        <div class="">
          <input id="image" type="file" name="image" required>
          <label for="image">Imagen</label>
        </div>

        <br>
        <button class="btn waves-effect waves-light green" type="submit"><i class="material-icons right notranslate">send</i>Crear nuevo producto</button>
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
    style: 'https://cdn.jsdelivr.net/npm/sceditor@3/minimized/themes/content/default.min.css',
    locale: 'es', // Ajusta el idioma si es necesario
    width: '100%',
    height: '200px',
  });

  $('#name').on('keyup', function() {
    var name = $(this).val();
    var slug = name.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
    var randomString = Math.floor(Math.random() * 1000).toString().substr(0, 3);
    $('#slug').val(slug + '-' + randomString);
    $('#labelslug').addClass('active');
  });
</script>