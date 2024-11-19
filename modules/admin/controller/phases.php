<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador principal de la pagina Fases
 *
 *
 */

$page['name'] = 'Fases';
$page['code'] = 'admninPhases';

if (isset($_GET['delete_phase']))
{
  //$phase_id = escape($_GET['phase_id']);
  $msg  = [];

  if (loadClass('admin/phase')->deletePhase($phase_id))
  {
    $msg[] = ['Fase eliminada correctamente'];
  }
  else
  {
    $msg[] = ['No se ha eliminado la fase'];
  }

  setToast($msg);
  redirect('admin/phases');
  exit;
}


$phases = loadClass('admin/phase')->getAllPhases();
