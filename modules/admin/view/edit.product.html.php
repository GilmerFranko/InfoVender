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

?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/default.min.css" />
<script src="https://cdn.jsdelivr.net/npm/sceditor@3/minified/sceditor.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sceditor@3/minified/formats/bbcode.min.js"></script>
<section id="adminNewProduct">
  <div class="card-panel green lighten-4 green-text text-darken-4 flow-text center-align"><?= $page['name'] ?></div>
  <div class="sectionProducts container">
    <div class="row">
      <form class="col s12" id="newProductForm" method="POST" action="<?= Core::model('extra', 'core')->generateUrl('admin', 'edit.product', null, ['edit_product' => true, 'product_id' => $product['id']]); ?>" enctype="multipart/form-data">

        <div class="input-field">
          <label for="name">Nombre</label>
          <input type="text" name="name" id="name" value="<?= $product['name'] ?>" required>
        </div>

        <div class="input-field">
          <label for="description">Descripción</label>
          <textarea name="description" id="description" class="materialize-textarea wysiwyg-editor" required><?= bbbr2nl($product['description']) ?></textarea>
        </div>

        <div class="input-field">
          <label for="price">Precio</label>
          <input type="number" name="price" id="price" value="<?= $product['price'] ?>" required>
        </div>

        <div class="input-field">
          <label for="image">Imagen: puedes dejar vacío para conservar la actual</label>
          <input id="image" type="file" name="image">
        </div>

        <br>
        <button class="btn waves-effect waves-light green" type="submit"><i class="material-icons right notranslate">send</i>Actualizar producto</button>
      </form>
    </div>
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
    height: '200px',
  });
</script>