<?php defined('VCO') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador principal de las acciones para Curso
 *
 *
 */

if (isset($_POST['ajax']) && isset($_POST['token']) && $session->checkToken($_POST['token']) === true)
{
  // Verifica si se ha pulsado el boton de eliminar Curso
  if (isset($_GET['deleteCourse']))
  {
    if (isset($_POST['course_id']) and !empty($_POST['course_id']))
    {
      $course_id = escape($_POST['course_id']);

      $password = isset($_POST['password']) ? escape($_POST['password']) : '';


      // VERIFICAR CONTRASEÑA
      if (password_verify($password, $session->memberData['password']) === true)
      {
        $response = loadClass('admin/course')->deleteCourse($course_id);

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
      $message = array('success' => false, 'msg' => 'No se ha podido eliminar el Curso');
    }
    echo json_encode($message);
  }
}
