<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de la página de todos los productos
 *
 *
 */

require Core::view('head', 'core');
?>

<!-- Modal de confirmar eliminación de Producto -->
<div id="deleteProductModal" class="modal">
  <div class="modal-content">
    <input id="id_product" type="hide">
    <h4>Confirmar eliminación</h4>
    <p>¿Estás seguro de que deseas eliminar este producto? Esta acción no se puede deshacer.</p>
    <div class="row">
      <div class="input-field col s12">
        <input id="password" name="password" type="password" class="validate" required>
        <label for="password">Ingresa tu contraseña para confirmar</label>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat">Cancelar</a>
    <a href="#" class="modal-action waves-effect waves-green btn-flat" onclick="confirmDelete($('#id_product').val())">Eliminar</a>
  </div>
</div>

<section id="adminProducts">
  <!-- BUSCADOR -->
  <div class="row" style="margin-top: 30px;">
    <div class="col s12">
      <form class="white" action="<?php echo Core::model('extra', 'core')->generateUrl('admin', 'products'); ?>" method="get">
        <div class="input-field col s12 m6">
          <i class="material-icons prefix">search</i>
          <input id="search" name="search" type="search" value="<?php echo $search; ?>">
          <label for="search">Buscar...</label>
        </div>
        <div class="input-field col s12 m3">
          <button type="submit" class="btn waves-effect waves-light teal darken-1">Buscar</button>
        </div>
      </form>
    </div>
  </div>
  <div class="col s4">
    <a href="<?php echo Core::model('extra', 'core')->generateUrl('admin', 'new.product'); ?>" class="btn waves-effect waves-light green" title="Crear nuevo producto">
      <i class="material-icons left">add</i> Nuevo producto
    </a>
  </div>
  <!-- ./BUSCADOR -->
  <blockquote>Resultado: <?php echo $products['total']; ?></blockquote>

  <div class="sectionProducts">
    <?php include Core::view('products.area'); ?>
  </div>

</section>

<!-- Footer -->
<?php require Core::view('footer', 'core'); ?>
<!-- / Footer -->

<script>
  function setDeleteProduct(product_id) {
    document.getElementById('id_product').value = product_id;
    $('#deleteProductModal').modal('open');
  }

  function confirmDelete(product_id) {
    var password = document.getElementById('password').value;
    if (!password) {
      M.toast({
        html: 'Por favor ingresa tu contraseña',
        classes: 'red darken-1'
      });
      return;
    }

    $.ajax({
      url: '<?= gLink('admin/delete.product', ['deleteProduct' => true]) ?>',
      type: 'POST',
      data: {
        product_id: product_id,
        password: password,
        token: '<?= $session->token ?>',
        ajax: true
      },
      dataType: 'json',
      success: function(data) {
        console.log(data)
        if (data.success) {
          M.toast({
            html: data.msg,
            classes: 'green darken-1'
          });
          window.location.href = '<?= gLink('admin/products') ?>';
        } else {
          M.toast({
            html: data.msg,
            classes: 'red darken-1'
          });
        }
      },
      error: function(xhr, status, error) {
        console.log(xhr)
        console.log(status)
        console.log(error)
        M.toast({
          html: 'Ocurrió un error al eliminar el producto',
          classes: 'red darken-1'
        });
      }
    });
  }
</script>
<!-- JS adicional -->
<script type="text/javascript" src="<?php echo $config['base_url']; ?>/static/js/admin.js" />
</script>