<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Este modelo se encarga de gestionar lo relacionado con los cursos
 *
 *
 */

class Courses extends Model
{
  /** Optiene todos los cursos */
  public function getAllCourses($params = [], $page = 1, $limit = 20)
  {
    $where = [];

    /* // Filtrar por fecha (ultimos subidos)
    if (!empty($params['by_date']))
    {
      $where[] = 'c.`created_at` = "' .  '"';
    } */

    // Ordenar por fecha (ascendente o descendente)
    $order_by = !empty($params['order_by']) && in_array($params['order_by'], ['asc', 'desc'])
      ? $params['order_by']
      : 'desc';

    // Construir la cláusula WHERE
    #$where_clause = !empty($where) ? 'WHERE ' . implode(' AND ', $where) : 'WHERE `status` = 1';

    // Consulta para obtener el total de resultados (sin límite de paginación)
    $total_query = $this->db->query(
      'SELECT COUNT(*) 
        FROM `courses` AS c'
    );

    list($data['total']) = $total_query->fetch_row();

    // Paginador
    $data['pages'] = Core::model('paginator', 'core')->pageIndex(array('forums', 'view.searches', null, $params), $data['total'], $limit);

    // Construir la consulta SQL final con paginación
    $query = $this->db->query(
      'SELECT * 
        FROM `courses` AS c
        ORDER BY 
            c.`created_at` ' . $order_by . ' 
        LIMIT ' . $data['pages']['limit']
    );

    $data['rows'] = $query->num_rows;

    // Obtener los resultados de la consulta
    if ($query && $data['rows'] > 0)
    {
      while ($row = $query->fetch_assoc())
      {
        $data['data'][] = $row;
      }
    }

    return $data;
  }
}
