<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador de la página de vista de las fases
 *
 *
 */

$page['name'] = 'Fases';
$page['code'] = 'viewPhases';

$params = [];

$phases = loadClass('courses/courses')->getAllPhases();
