<div id="contentProducts">
  <table class="striped responsive-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Estado</th>
        <th>Fecha</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($products['rows'] > 0)
      {
        foreach ($products['data'] as $product): ?>
          <tr>
            <td><?php echo $product['id']; ?></td>
            <td><?php echo $product['name']; ?></td>
            <td><?php echo $product['price']; ?></td>
            <td><?php echo $product['status'] == 0 ? 'Desactivado' : 'Activo'; ?></td>
            <td><?php echo date('Y-m-d H:i:s', $product['created_at']); ?></td>
            <td>
              <a href="<?= gLink('admin/edit.product', ['product_id' => $product['id']]) ?>" class="btn-floating btn-small waves-effect waves-light blue"><i class="material-icons">edit</i></a>
              <a href="#deleteProductModal" class="btn-floating btn-small waves-effect waves-light red modal-trigger" onclick="setDeleteProduct(<?= $product['id']; ?>)"><i class="material-icons">delete</i></a>
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
  <!--paginador-->
  <?php echo $products['pages']['paginator']; ?>
  <!--fin_paginador-->
</div>