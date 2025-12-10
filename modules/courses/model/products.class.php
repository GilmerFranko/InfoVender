<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Este modelo se encarga de gestionar lo relacionado con los "productos para revender"
 *
 *
 */

class Products extends Model
{
  /** Optiene todos los productos */
  public function getAllProducts($params = [], $limit = 20, $onlyactive = true)
  {
    $where = [];

    // Filtrar por nombre
    if (!empty($params['search']))
    {
      $where[] = 'p.`name` LIKE "%' . $params['search'] . '%"';
    }

    if ($onlyactive)
    {
      $where[] = 'p.`status` = 1';
    }

    // Ordenar por fecha (ascendente o descendente)
    $order_by = !empty($params['order_by']) && in_array($params['order_by'], ['asc', 'desc'])
      ? $params['order_by']
      : 'desc';

    // Construir la cláusula WHERE
    $where_clause = !empty($where) ? 'WHERE ' . implode(' AND ', $where) : '';

    // Consulta para obtener el total de resultados (sin límite de paginación)
    $total_query = $this->db->query(
      'SELECT COUNT(*) 
        FROM `products` AS p
        ' . $where_clause
    );

    list($data['total']) = $total_query->fetch_row();

    // Paginador
    $data['pages'] = Core::model('paginator', 'core')->pageIndex(array('products', 'view.products', null, $params), $data['total'], $limit);

    // Construir la consulta SQL final con paginación
    $query = $this->db->query(
      'SELECT * 
        FROM `products` AS p
        ' . $where_clause . '
        ORDER BY 
            p.`created_at` ' . $order_by . '
        LIMIT ' . $data['pages']['limit']
    );

    // Contar el total de resultados
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


  /**
   * Obtiene el producto por su ID
   * @param int $id
   * @return array|null
   */
  public function getProductById(int $id): ?array
  {
    $query = $this->db->query(
      'SELECT * 
       FROM `products` AS c 
       WHERE c.`id` = ' . intval($id)
    );

    if ($query && $query->num_rows > 0)
    {
      return $query->fetch_assoc();
    }

    return null;
  }
}
