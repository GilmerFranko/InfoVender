<?php defined('VCO') || exit;

/**
 *=======================================================
 *  SYC Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador principal de pagina que muestra los cursos
 *
 *
 */

$page['name'] = 'Cursos';
$page['code'] = 'adminCourses';

// PREFERENCIAS DE BÚSQUEDAS
$search = '';
if (isset($_REQUEST['search']))
{
  // DEFINIR
  $search = htmlspecialchars($_REQUEST['search']);
  $_SESSION['courses']['search'] = $search;
}
else
{
  if (isset($_SESSION['search']))
  {
    $search = $_SESSION['courses']['search'];
  }
}

// REDIRIGIR
if ((isset($_POST['search']) && !empty($_POST['search'])) || (isset($_SESSION['courses']['search']) && !isset($_GET['search'])))
{
  if (!isset($_POST['ajax']) && !empty($search))
  {
    Core::model('extra', 'core')->generateUrl('admin', 'courses', null, array('search' => $search), true);
  }
}


if ((!isset($_POST['ajax'])) or (isset($_POST['ajax']) && isset($_GET['page'])))
{
  $search = isset($_GET['search']) ? escape($_GET['search']) : '';
  $params = array();
  if ($search != '')
    $params['name'] = $search;


  // Optiene todos los Cursos
  $courses = loadClass('admin/course')->getAllCourses($params);
  if (isset($_POST['ajax']))
  {
    echo '1: ';
    require Core::view('courses.area', 'admin');
    exit;
  }
}
