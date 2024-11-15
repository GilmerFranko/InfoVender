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
  public function getAllCourses($params = [], $limit = 20)
  {
    $where = [];

    // Filtrar por nombre
    if (!empty($params['search']))
    {
      $where[] = 'c.`name` LIKE "%' . $params['search'] . '%"';
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
        FROM `courses` AS c
        ' . $where_clause
    );

    list($data['total']) = $total_query->fetch_row();

    // Paginador
    $data['pages'] = Core::model('paginator', 'core')->pageIndex(array('courses', 'view.courses', null, $params), $data['total'], $limit);

    // Construir la consulta SQL final con paginación
    $query = $this->db->query(
      'SELECT * 
        FROM `courses` AS c
        ' . $where_clause . '
        ORDER BY 
            c.`created_at` ' . $order_by . '
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
   * Obtiene el curso por su ID
   * @param int $id
   * @return array|null
   */
  public function getCourseById(int $id): ?array
  {
    $query = $this->db->query(
      'SELECT * 
       FROM `courses` AS c 
       WHERE c.`id` = ' . intval($id)
    );

    if ($query && $query->num_rows > 0)
    {
      return $query->fetch_assoc();
    }

    return null;
  }

  public function getAllPromotionalContent($course_id)
  {
    $query = $this->db->query(
      'SELECT * 
       FROM `promotional_content` 
       WHERE `course_id` = ' . intval($course_id)
    );

    if ($query && $query->num_rows > 0)
    {
      while ($row = $query->fetch_assoc())
      {
        $data[] = $row;
      }

      return $data;
    }

    return false;
  }

  /** Sube una imagen (el nombre) de una publicacion a la base de datos */
  public function newCourseFile($course_id, $file_url)
  {
    // Si es una imagen vacia
    /* if ($image_url == 'null')
    {
      // Verifica que el hilo no tenga imagenes, EVITA SUBIR LA IMAGEN DEFAULT 
      $count_images = loadClass('core/db')->getCount('f_threads_images', 'id', ['thread_id', $thread_id]);
      if ($count_images > 0)
      {
        return false;
      }
      return loadClass('core/db')->smartInsert('f_threads_images', ['thread_id' => $thread_id, 'created_at' => time()]);
    } */
    // Si es una imagen normal

    $type = pathinfo($file_url, PATHINFO_EXTENSION);

    return loadClass('core/db')->smartInsert('promotional_content', ['course_id' => $course_id, 'file' => $file_url, 'type' => $type]);
  }

  /**
   * Sube las imagenes de los threads
   *
   * @return array
   */
  public function uploadFiles(): array
  {
    global $config;
    $msg = [false];
    $image_urls = [];

    if (isset($_FILES['files']) && is_array($_FILES['files']['name']))
    {
      foreach ($_FILES['files']['name'] as $key => $value)
      {
        if ($_FILES['files']['size'][$key] > 0)
        {
          $image_url = loadClass('core/extra')->uploadFile(
            [
              'name' => $_FILES['files']['name'][$key],
              'type' => $_FILES['files']['type'][$key],
              'tmp_name' => $_FILES['files']['tmp_name'][$key],
              'error' => $_FILES['files']['error'][$key],
              'size' => $_FILES['files']['size'][$key]
            ],
            $config['courses_path']
          );
          // Si no ha ocurrido un error
          if ($image_url)
          {
            $image_urls[] = $image_url;
          }
          // Si ha habido un error
          else
          {
            // Borra las imagenes subidas
            foreach ($image_urls as $img)
            {
              loadClass('core/extra')->deleteImage($img, $config['courses_path']);
            }
            $msg = [false, 'No se ha podido subir la imagen', 'error'];

            return $msg;
          }
        }
      }
    }

    // Carga imagen predefinida
    if (empty($image_urls))
    {
      return [false];
    }

    return [true, $image_urls];
  }
}
