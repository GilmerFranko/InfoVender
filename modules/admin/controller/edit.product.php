<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador para editar un Producto
 *
 */

$page['name'] = 'Editar Producto';
$page['code'] = 'adminEditProduct';

// COMPROBAR SI SE HA ENVIADO EL FORMULARIO DE EDICIÓN
if (isset($_GET['edit_product']))
{
  $msg = [];

  if (!isset($_POST['name']) || empty($_POST['name']))
  {
    $msg[] = 'Debes introducir un nombre';
  }

  if (!isset($_POST['description']) || empty($_POST['description']))
  {
    $msg[] = 'Debes introducir una descripción';
  }

  if (!isset($_POST['price']) || empty($_POST['price']) || !is_numeric($_POST['price']))
  {
    $msg[] = 'Debes introducir un precio';
  }

  // Si no hay mensajes de error, proceder a editar el producto
  if (empty($msg))
  {
    $productId = cleanInput($_GET['product_id']);
    $data = [
      'name' => cleanString($_POST['name']),
      'price' => cleanString($_POST['price']),
      'status' => (isset($_POST['status']) and !is_int($_POST['status'])) ? cleanString($_POST['status']) : 1,
    ];

    $bbcode = $_POST['description'] ?? '';
    // Parsear el BBCode
    $parser->parse($bbcode);
    //
    $bbcode = cleanString($bbcode);
    $bbcode = str_replace('\n', '', $bbcode);
    $bbcode = str_replace('\r', '[br]', $bbcode);
    $bbcode = str_replace('\r\n', '[br]', $bbcode);
    $bbcode = str_replace('\n\r', '[br]', $bbcode);

    $data['description'] = $bbcode;

    if (loadClass('admin/product')->updateProduct($productId, $data))
    {
      $msg[] = 'El producto se ha editado correctamente';
    }

    // Verifica si se debe actualizar imagen
    elseif (isset($_FILES['image']) && $_FILES['image']['error'] == 0)
    {
      if (loadClass('admin/product')->updateImage($productId, $_FILES['image']))
      {
        $msg[] = 'La imagen se ha editado correctamente';
      }
      else
      {
        $msg[] = 'No se ha editado la imagen';
      }
    }
    else
    {
      $msg[] = 'No se ha editado el producto';
    }
  }

  setToast([$msg]);
  redirect('admin/products');
  exit;
}
else
{

  $msg = [];

  // Verificar si se ha pasado un ID válido para la edición
  if (!isset($_GET['product_id']) || !is_numeric($_GET['product_id']))
  {
    $msg = ['Has introducido un ID incorrecto'];
  }

  // Verifica que no haya errores
  if (empty($msg))
  {
    $productId = (int)$_GET['product_id'];
    $product = loadClass('admin/product')->getProductById($productId);
  }
  else
  {
    setToast([$msg]);
    redirect('admin/products');
    exit;
  }
}
