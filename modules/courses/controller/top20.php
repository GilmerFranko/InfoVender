<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador de la página de vista de los cursos del top20
 *
 *
 */

$page['name'] = 'Top 20';
$page['code'] = 'viewCoursesTop20';

$params = [];

if (isset($_GET['order_by']))
{
  $params['order_by'] = escape($_GET['order_by']);
}


$courses = loadClass('courses/courses')->getAllCoursesTop20($params);
