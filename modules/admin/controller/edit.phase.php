<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador para editar una Fase
 *
 */

$page['name'] = 'Editar Fase';
$page['code'] = 'adminEditPhase';


if (isset($_GET['edit_phase']))
{
  $msg = [];

  if (!isset($_POST['title']) || empty($_POST['title']))
  {
    $msg[] = 'Debe ingresar un título';
  }


  if (!isset($_POST['content']) || empty($_POST['content']))
  {
    $msg[] = 'Debe ingresar un contenido';
  }

  if (empty($msg))
  {
    $phase_id = escape($_GET['phase_id']);
    $data = [
      'title' => escape($_POST['title']),
    ];

    $bbcode = $_POST['content'] ?? '';
    // Parsear el BBCode
    $parser->parse($bbcode);
    //
    $bbcode = cleanString($bbcode);
    $bbcode = str_replace('\n', '', $bbcode);
    $bbcode = str_replace('\r', '[br]', $bbcode);
    $bbcode = str_replace('\r\n', '[br]', $bbcode);
    $bbcode = str_replace('\n\r', '[br]', $bbcode);

    $data['content'] = $bbcode;

    if (loadClass('admin/phase')->updatePhase($phase_id, $data))
    {
      $msg[] = 'La fase se ha editado correctamente';
    }
    else
    {
      $msg[] = 'No se ha editado la fase';
    }
    setToast([$msg]);
    redirect('admin/edit.phase', ['phase_id' => $phase_id]);
    exit;
  }
  setToast([$msg]);
  redirect('admin/phases');
  exit;
}
else
{
  $msg = [];
  if (isset($_GET['phase_id']) and  !empty($_GET['phase_id']))
  {
    $phase_id = escape($_GET['phase_id']);

    if ($phase = loadClass('admin/phase')->getPhaseById($phase_id))
    {
    }
    else
    {
      $msg[] = 'La fase no existe';
    }
  }
  else
  {
    $msg[] = 'No se ha enviado el ID de la fase';
  }

  if (!empty($msg))
  {
    setToast([$msg]);
    redirect('admin/phases');
    exit;
  }
}
