<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Este modelo se encarga de gestionar lo relacionado a las fases
 *
 *
 */

class Phases extends Model
{
  public function getPhaseById($id)
  {
    $query = $this->db->query('SELECT * FROM `phases` WHERE `id` = ' . intval($id));

    if ($query && $query->num_rows > 0)
    {
      return $query->fetch_assoc();
    }
    return false;
  }
}
