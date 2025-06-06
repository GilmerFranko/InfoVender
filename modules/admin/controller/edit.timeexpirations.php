<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Este controlador solo se encarga de editar el Tiempo de Exiracion de un Usuario
 *
 *
 */



if (isset($_POST['ajax']))
{

  if (isset($_GET['do']) and $_GET['do'] == 'edit')
  {
    if (!empty($_POST['expiration_date']))
    {

      $memberID = (int) $_POST['id'];

      $expiration_date = $_POST['expiration_date'];

      error_log(var_export($_POST, 1));

      // Ptiene el usuario
      $m = loadClass('admin/members')->getMember($memberID);
      if ($m === false)
      {
        die('0:El usuario no existe');
      }

      // Optiene el tiempo de expiracion actual
      $expiration = $m['pp_expiration'];

      //Si se ingreso una fecha de expiracion exacta
      if (strtotime($expiration_date) !== false)
      {
        $expiration = strtotime($expiration_date);
      }
      // Si se desea sumar dias a la fecha de expiracion actual
      else
      {
        if ($expiration_date <= 0)
        {
          die('0:El n&uacute;mero de d&iacute;as debe ser mayor a cero');
        }

        $days = (int) $expiration_date;
        $expiration = strtotime("+{$days} days", $expiration);
        if ($expiration === false)
        {
          die('0:Fecha de expiraci&oacute;n inv&aacute;lida');
        }
        error_log($days);
      }


      // ACTUALIZAR
      if (Core::model('members', 'admin')->updateExpiration($m['member_id'], $expiration) === false)
      {
        die('0:Error al actualizar el tiempo de expiraci&oacute;n');
      }

      die('1:Tiempo de expiraci&oacute;n actualizado correctamente');
    }
    else
    {
      die('0:Los campos no pueden estar vac&iacute;os');
    }
  }
}
