<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador principal para crear un Curso
 *
 *
 */

$page['name'] = 'Nuevo curso';
$page['code'] = 'adminNewCourse';


// COMPROBAR SI SE HA ESPECIFICADO ACCION Y TIPO
if (isset($_GET['do']))
{
  // ACCIÓN SOBRE PALABRAS
  if ($_GET['do'] == 'new')
  {
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

    if (!isset($msg))
    {

      $course = [
        'name' => cleanString($_POST['name']),
        'recommended_description' => cleanString($_POST['recommended_description']),
        'segmentation' => cleanString($_POST['segmentation']),
        'suggested_daily_investment' => cleanString($_POST['suggested_daily_investment']),
        'pdf_link' => cleanString($_POST['pdf_link']),
        'video_link' => cleanString($_POST['video_link']),
        'status' => (isset($_POST['status']) and !is_int($_POST['status'])) ? cleanString($_POST['status']) : 1,
        'created_at' => time()
      ];

      if ($image_url = loadClass('core/extra')->uploadImage($_FILES['image'], $config['courses_path']))
      {
        $course['image'] = $image_url;

        $result = loadClass('admin/course')->newCourse($course);

        if ($result)
        {
          $msg[] = 'El curso se ha creado correctamente';
        }
        else
        {
          $msg[] = 'No se ha podido crear el curso';
          // Elimina imagen subida
          loadClass('core/extra')->deleteImage($image_url, $config['courses_path']);
        }
      }
      else
      {
        $msg[] = 'No se ha podido cargar la imagen';
        // Elimina imagen subida
        loadClass('core/extra')->deleteImage($image_url, $config['courses_path']);
      }
    }
    // Mostrar mensajes de error o éxito
    setToast([$msg]);

    // Recargar la página
    redirect('admin/courses');
  }
}
