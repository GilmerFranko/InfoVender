<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador de la página de vista de un curso
 *
 *
 */

$page['name'] = 'Cursos';
$page['code'] = 'viewCourses';

$msg = [];

if (!isset($_GET['course_id']))
{
  $msg = 'No se ha enviado el ID del curso.';
}

$courseId = intval($_GET['course_id']);

if (!$course = loadClass('courses/courses')->getCourseById($courseId))
{
  $msg = 'El curso no existe.';
}

if (empty($msg))
{
}
else
{
  setToast($msg);
  redirect('courses/view.courses');
  exit;
}
