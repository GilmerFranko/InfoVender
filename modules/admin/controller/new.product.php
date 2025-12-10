<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador principal para crear un Producto
 *
 *
 */

$page['name'] = 'Nuevo producto';
$page['code'] = 'adminNewProduct';

// Obtener el valor de post_max_size de php.ini y convertirlo a bytes
$max_post_size = ini_get('post_max_size');
$max_post_size_bytes = convertToBytes($max_post_size);

// COMPROBAR SI SE HA ESPECIFICADO ACCION Y TIPO
if (isset($_GET['do']))
{
  // ACCIÓN SOBRE PALABRAS
  if ($_GET['do'] == 'new')
  {
    // Verificar si CONTENT_LENGTH está configurado y si excede el límite
    if (isset($_SERVER['CONTENT_LENGTH']) && (int)$_SERVER['CONTENT_LENGTH'] > $max_post_size_bytes)
    {
      $msg[] = 'El archivo es demasiado grande';
    }

    // Debe tener un nombre
    if (!isset($_POST['name']) or empty($_POST['name']))
    {
      $msg[] = 'Debes introducir un nombre';
    }

    // Debe tener una descripción
    if (!isset($_POST['description']) or empty($_POST['description']))
    {
      $msg[] = 'Debes introducir una descripción';
    }

    // Debe tener un precio válido
    if (!isset($_POST['price']) or empty($_POST['price']) or !is_numeric($_POST['price']))
    {
      $msg[] = 'Debes introducir un precio';
    }

    // Si no hay mensajes de error, proceder a crear el producto
    if (!isset($msg))
    {

      // Preparar los datos del producto
      $product = [
        'name' => cleanString($_POST['name']),

        'price' => cleanString($_POST['price']),
        'status' => (isset($_POST['status']) and !is_int($_POST['status'])) ? cleanString($_POST['status']) : 1,
        'created_at' => time()
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

      // Sube la imagen al servidor
      if ($image_url = loadClass('core/extra')->uploadImage($_FILES['image'], $config['products_path']))
      {

        // Asignar la direccion de la imagen al producto
        $product['image'] = $image_url;

        // Crear el nuevo producto
        $r_id = loadClass('admin/product')->newProduct($product);

        // Si se ha creado el producto
        if ($r_id)
        {
          // Devuelve mensaje de exito
          $msg[] = 'El producto se ha creado correctamente';
        }
        // Si no
        else
        {
          $msg[] = 'No se ha podido crear el producto';
          // Elimina imagen subida
          loadClass('core/extra')->deleteImage($image_url, $config['products_path']);
        }
      }
      else
      {
        $msg[] = 'No se ha podido cargar la imagen';
        // Elimina imagen subida
        loadClass('core/extra')->deleteImage($image_url, $config['products_path']);
      }
    }
    // Mostrar mensajes de error o éxito
    setToast([$msg]);

    // Recargar la página
    redirect('admin/products');
  }
}
