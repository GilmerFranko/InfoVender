<?php defined('VCO') || exit;
/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @Description Vista de la página de un Producto
 */
// HEADER
require Core::view('head', 'core');
?>

<!-- Header -->
<?php require Core::view('menu', 'core'); ?>
<!-- / Header -->

<section style="padding: 1rem; color: #fff; background-color: #000;">
  <p class="title antiqua center" style="margin: 4px 0;"><span style="background-color:#04349F;"><?= $product['name'] ?></span></p>

  <div id="courseDetailsMain">
    <!-- Imagen del producto -->
    <div style="">
      <?php if ($session->is_admod): ?>
        <div class="course-card-action" style="position: absolute;margin-top: 0px;margin-left: 227px;z-index: 1;text-align: right;">
          <a class="btn btn-small waves-effect waves-light blue" href="<?= gLink('admin/edit.product', ['product_id' => $product['id']]) ?>">
            <i class="material-icons">edit</i>
          </a>
        </div>
      <?php endif; ?>
      <img class="course_img" src="<?= $config['products_url'] . '/' . $product['image'] ?>" alt="producto <?= $product['name'] ?>" style="width: 50vw; max-width:400px;">
    </div>
    <!-- Descripción del producto -->
    <div class="item_course_info" style="font-weight: normal;">
      <p>Precio: <span class="text-cian">$<?= number_format($product['price'], 2, '.', ',') ?> USD</span></p>
      <hr style="border: 1px solid #fff; margin-top: 40px">
      <h2 style="font-size: 1.5rem; font-weight: bold; text-align: left;">Descripción:</h2>
      <div class="recomendation-description">
        <?= tobr($parser->getAsHTML()) ?>
      </div>
    </div>
  </div>
  <br><br>
  <div class="center">
    <a class="btn-ws" href="https://wa.me/<?= $config['num_phone'] ?>?text=Hola%20estoy%20interesado%20en%20comprar%20<?= str_replace(' ', '%20', $product['name']) ?>" target="_blank"><span style="vertical-align: middle;"><i class="material-icons" style="font-size: 35px;">whatsapp</i></span> &nbsp;Comprar via Whatsapp</a>
  </div>
  <br>
</section>

<style>
  .item_course_info {
    margin-left: 2rem;
    font-size: 24px;
    text-align: left;
    max-width: 500px;
    font-family: Arial;
    font-weight: 800;

    .text-cian {
      color: #5CE1E6 !important;
    }

    p {
      margin: 0 !important;
    }
  }

  .course_img {
    width: 400px;
  }

  .recomendation-description {
    text-align: left;
    font-size: 1rem;
    line-height: 1.5;
    background: white;
    color: black;
    /*font-weight: 100;*/
    font-size: 12px;
    padding: 5px;
  }

  ul,
  li {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  li {
    margin-left: 1rem;
    list-style-type: disc;
  }

  strong {
    font-weight: bold;
  }

  #courseDetailsMain {
    display: flex;
    justify-content: center;
    align-items: flex-start;
  }

  @media (max-width: 780px) {
    .item_course_info {
      margin-left: 10px;
      font-size: 18px;
    }

    #courseDetailsMain {
      flex-direction: column;
      align-items: center;
    }
  }

  .btn-ws {
    background-color: #25D366;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    font-size: 18px;
    display: inline-flex;
    align-items: center;
  }
</style>