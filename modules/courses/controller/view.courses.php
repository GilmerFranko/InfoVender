<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador de la página de vista de los cursos
 *
 *
 */

$page['name'] = 'Cursos';
$page['code'] = 'viewCourses';

$params = [];

if (isset($_GET['search']))
{
  $params['search'] = escape($_GET['search']);
}

if (isset($_GET['order_by']))
{
  $params['order_by'] = escape($_GET['order_by']);
}

$courses = loadClass('courses/courses')->getAllCourses($params);
