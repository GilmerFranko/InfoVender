<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Componente de un producto
 *
 *
 */
?>

<div id="product<?= $product['id'] ?>" class="course-item" style="display: flex; flex-direction: column; align-items: center;max-width: max-content;" onclick="location.href='<?= gLink('courses/view.product', ['product_id' => $product['id']]) ?>'">

  <div class="course-image">
    <?php if ($session->is_admod): ?>
      <div class="course-card-action" style="position: absolute;margin-top: 0px;margin-left: 227px;z-index: 1;text-align: right;">
        <a class="btn btn-small waves-effect waves-light blue" href="<?= gLink('admin/edit.product', ['product_id' => $product['id']]) ?>">
          <i class="material-icons">edit</i>
        </a>
      </div>
    <?php endif; ?>
    <img src="<?= $config['products_url'] . '/' . $product['image'] ?>">
  </div>
  <div class="card-content center" style="margin-top:8px;">
    <strong class="course-name"><?= $product['name'] ?></strong>
    <p class="course-price">$<?= number_format($product['price'], 2, '.', ',') ?></p>
    <!--<p class="course-description"><?= ($product['description']) ?></p>-->
  </div>
</div>