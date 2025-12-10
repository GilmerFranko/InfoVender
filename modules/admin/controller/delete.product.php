<?php defined('VCO') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Este controlador se encarga de eliminar un Producto
 *
 *
 */

if (isset($_POST['ajax']) && isset($_POST['token']) && $session->checkToken($_POST['token']) === true)
{
  // Verifica si se ha pulsado el boton de eliminar Producto
  if (isset($_GET['deleteProduct']))
  {
    if (isset($_POST['product_id']) and !empty($_POST['product_id']))
    {
      $product_id = escape($_POST['product_id']);

      $password = isset($_POST['password']) ? escape($_POST['password']) : '';


      // VERIFICAR CONTRASEÑA
      if (password_verify($password, $session->memberData['password']) === true)
      {
        $response = loadClass('admin/product')->deleteProduct($product_id);

        if ($response['status'] === true)
        {
          $message = array('success' => true, 'msg' => $response['msg']);
          setToast([[$response['msg']]]);
        }
        else
        {
          $message = array('success' => false, 'msg' => $response['msg']);
        }
      }
      else
      {
        $message = array('success' => false, 'msg' => 'Contraseña incorrecta');
      }
    }
    else
    {
      $message = array('success' => false, 'msg' => 'No se ha podido eliminar el Producto');
    }
    echo json_encode($message);
  }
}
