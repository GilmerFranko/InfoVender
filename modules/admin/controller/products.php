<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador principal de pagina que muestra los productos
 *
 *
 */

$page['name'] = 'Productos';
$page['code'] = 'adminProducts';

// PREFERENCIAS DE BÚSQUEDAS
$search = '';
if (isset($_REQUEST['search']))
{
  // DEFINIR
  $search = htmlspecialchars($_REQUEST['search']);
  $_SESSION['products']['search'] = $search;
}
else
{
  if (isset($_SESSION['search']))
  {
    $search = $_SESSION['products']['search'];
  }
}

// REDIRIGIR
if ((isset($_POST['search']) && !empty($_POST['search'])) || (isset($_SESSION['products']['search']) && !isset($_GET['search'])))
{
  if (!isset($_POST['ajax']) && !empty($search))
  {
    Core::model('extra', 'core')->generateUrl('admin', 'products', null, array('search' => $search), true);
  }
}


if ((!isset($_POST['ajax'])) or (isset($_POST['ajax']) && isset($_GET['page'])))
{
  $search = isset($_GET['search']) ? escape($_GET['search']) : '';
  $params = array();
  if ($search != '')
    $params['name'] = $search;


  // Optiene todos los Productos
  $products = loadClass('admin/product')->getAllProducts($params);
  if (isset($_POST['ajax']))
  {
    echo '1: ';
    require Core::view('products.area', 'admin');
    exit;
  }
}
