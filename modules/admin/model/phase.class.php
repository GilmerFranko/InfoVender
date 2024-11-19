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

class Phase extends Model
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


  /**
   * Actualiza un registro en la tabla phases con los datos proporcionados.
   *
   * @param int $phase_id El ID del registro a actualizar
   * @param array $data Los datos del nuevo registro.
   * @return bool true si se pudo actualizar, false si no.
   */
  public function updatePhase($phase_id, $data)
  {
    $query = loadClass('core/db')->smartInsert('phases', $data, ['id', $phase_id]);

    if ($query == true)
    {
      return true;
    }
    else
    {
      return false;
    }
  }


  /**
   * Obtiene todas las fases.
   *
   * @param array $params Filtros para la consulta.
   * @param int $limit El n mero de filas a obtener.
   * @return array|bool
   */
  public function getAllPhases()
  {
    $query = $this->db->query('SELECT `id`, `title`, `image` FROM `phases`');
    if ($query && $query->num_rows > 0)
    {
      $data['rows'] = $query->num_rows;
      while ($row = $query->fetch_assoc())
      {
        $data['data'][] = $row;
      }

      return $data;
    }

    return false;
  }


  /**
   * Elimina una fase.
   *
   * @param int $phase_id El identificador de la fase.
   * @return bool
   */
  public function deletePhase($phase_id)
  {
    return loadClass('core/db')->deleteRow('phases', $phase_id);
  }
}
