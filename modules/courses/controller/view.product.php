<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador de la página de vista de un Producto
 *
 *
 */

$page['name'] = 'Productos';
$page['code'] = 'viewProducts';

$msg = [];

if (!isset($_GET['product_id']))
{
  $msg = 'No se ha enviado el ID del producto.';
}

$productId = $_GET['product_id'];

if (is_string($productId))
{
  if (!$product = loadClass('courses/products')->getProductBySlug($productId))
  {
    $msg = 'El producto no existe.';
  }
}
else
{
  if (!$product = loadClass('courses/products')->getProductById($productId))
  {
    $msg = 'El producto no existe.';
  }
}

if (empty($msg))
{
  $parser->parse($product['description']);
}
else
{
  setToast($msg);
  redirect('courses/view.products');
  exit;
}
