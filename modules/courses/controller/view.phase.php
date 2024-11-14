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

if (!isset($_GET['phase_id']))
{
  $_GET['phase_id'] = 1;
}

$phase_id = intval($_GET['phase_id']);

if (!$phase = loadClass('courses/phases')->getPhaseById($phase_id))
{
  $msg = 'La fase no existe.';
}

if (empty($msg))
{
  // Reemplazar tamaños
  $sizes = range(1, 10);
  foreach ($sizes as $size)
  {
    $phase['content'] = str_replace("[size=$size]", "[size=" . ($size + ($size * 4)) . "]", $phase['content']);
  }
  $parser->parse($phase['content']);
}
else
{
  setToast($msg);
  redirect('courses/view.phase');
  exit;
}
