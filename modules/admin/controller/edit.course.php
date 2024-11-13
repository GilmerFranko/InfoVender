<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador para editar un Curso
 *
 */

$page['name'] = 'Editar Curso';
$page['code'] = 'adminEditCourse';

// COMPROBAR SI SE HA ENVIADO EL FORMULARIO DE EDICIÓN
if (isset($_GET['edit_course']))
{
  $msg = [];

  if (!isset($_POST['name']) or empty($_POST['name']))
  {
    $msg[] = 'Debes introducir un nombre';
  }

  if (!isset($_POST['recommended_description']) or empty($_POST['recommended_description']))
  {
    $msg[] = 'Debes introducir una descripción';
  }

  if (!isset($_POST['segmentation']) or empty($_POST['segmentation']))
  {
    $msg[] = 'Debes introducir una segmentación';
  }

  if (!isset($_POST['suggested_daily_investment']) or empty($_POST['suggested_daily_investment']) or !is_numeric($_POST['suggested_daily_investment']))
  {
    $msg[] = 'Debes introducir una inversión diaria sugerida';
  }

  if (empty($_POST['pdf_link']) && empty($_POST['video_link']))
  {
    $msg[] = 'Debes introducir un enlace PDF o un enlace de video';
  }

  if (empty($msg))
  {
    $courseId = cleanInput($_GET['course_id']);
    $data = [
      'name' => cleanString($_POST['name']),
      'recommended_description' => cleanString($_POST['recommended_description']),
      'segmentation' => cleanString($_POST['segmentation']),
      'suggested_daily_investment' => cleanString($_POST['suggested_daily_investment']),
      'pdf_link' => cleanString($_POST['pdf_link']),
      'video_link' => cleanString($_POST['video_link']),
      'status' => (isset($_POST['status']) and !is_int($_POST['status'])) ? cleanString($_POST['status']) : 1,
    ];

    if (loadClass('admin/course')->updateCourse($courseId, $data))
    {
      $msg[] = 'El curso se ha editado correctamente';
    }
    // Verifica si se debe actualizar imagen
    elseif (isset($_FILES['image']) && $_FILES['image']['error'] == 0)
    {
      if (loadClass('admin/course')->updateImage($courseId, $_FILES['image']))
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
      $msg[] = 'No se ha editado el Curso';
    }
  }

  setToast([$msg]);
  redirect('admin/courses');
  exit;
}
else
{

  $msg = [];

  // Verificar si se ha pasado un ID válido para la edición
  if (!isset($_GET['course_id']) || !is_numeric($_GET['course_id']))
  {
    $msg = ['Has introducido un ID incorrecto'];
  }

  // Verifica que no haya errores
  if (empty($msg))
  {
    $courseId = (int)$_GET['course_id'];
    $course = loadClass('admin/course')->getCourseById($courseId);
  }
  else
  {
    setToast([$msg]);
    redirect('admin/contacts.views');
    exit;
  }
}
