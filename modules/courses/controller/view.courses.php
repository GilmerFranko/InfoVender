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

$courses = loadClass('courses/courses')->getAllCourses();
