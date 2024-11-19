<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de los formularios de contacto
 *
 *
 */

require Core::view('head', 'core');
?>

<section id="adminContacts">
  <div class="center">
    <h2 class="title">Gestión de Fases</h2>
  </div>
  <!-- ./BUSCADOR -->
  <div id="contentPhase">
    <table class="striped responsive-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Título</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($phases['rows'] > 0)
        {
          foreach ($phases['data'] as $phase): ?>
            <tr>
              <td><?= $phase['id']; ?></td>
              <td><?= $phase['title']; ?></td>
              <td>
                <a class="btn-floating btn-small waves-effect waves-light blue" href="<?= gLink('admin/edit.phase', ['phase_id' => $phase['id']]) ?>"><i class="material-icons">edit</i></a>
                <!--<a class="btn-floating btn-small waves-effect waves-light red" href="<?= gLink('admin/phases', ['delete_phase' => true, 'phase_id' => $phase['id']]) ?>"><i class="material-icons">delete</i></a>-->
              </td>
            </tr>
          <?php endforeach;
        }
        else
        { ?>
          <tr>
            <td colspan="7">No se han encontrado resultados</td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</section>

<!-- Footer -->
<?php require Core::view('footer', 'core'); ?>
<!-- / Footer -->

<!-- JS adicional -->
<script type="text/javascript" src="<?php echo $config['base_url']; ?>/static/js/admin.js" />
</script>