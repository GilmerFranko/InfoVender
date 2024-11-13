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

class Course extends Model
{
  /** Optiene todos los cursos */
  public function getAllCourses($params = [], $limit = 20)
  {
    $where = [];

    // Filtrar por nombre
    if (!empty($params['name']))
    {
      $where[] = 'c.`name` LIKE "%' . $params['name'] . '%"';
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
    $data['pages'] = Core::model('paginator', 'core')->pageIndex(array('admin', 'courses', null, $params), $data['total'], $limit);

    // Construir la consulta SQL final con paginación
    $query = $this->db->query(
      'SELECT * 
        FROM `courses` AS c
        ' . $where_clause . '
        ORDER BY 
            c.`created_at` ' . $order_by . '
        LIMIT ' . $data['pages']['limit']
    );
    error_log('SELECT * 
        FROM `courses` AS c
        ' . $where_clause . '
        ORDER BY 
            c.`created_at` ' . $order_by . '
        LIMIT ' . $data['pages']['limit']);
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


  /**
   * Crea un nuevo curso
   * @param array $contact
   * @return bool
   */
  public function newCourse(array $data): bool
  {
    // Generar el slug a partir del título
    $slug = loadClass('core/extra')::generateSlug($data['name']);

    // Añadir un sufijo único para evitar colisiones (puedes usar ID, timestamp, etc.)
    $uniqueId = substr(md5(time()), 0, 6);  // 4 caracteres aleatorios

    // Combinar el slug y el sufijo para generar la URL
    $url = $slug . '.' . $uniqueId;

    $data['slug'] = $url;

    if ($r = loadClass('core/db')->smartInsert('courses', $data))
    {
      return $r;
    }
    return false;
  }

  /**
   * Actualiza un registro en la tabla courses con los datos proporcionados.
   *
   * @param int $id El ID del registro a actualizar
   * @param array $data Los datos del nuevo registro.
   * @return bool true si se pudo actualizar, false si no.
   */
  public function updateCourse($course_id, $data): bool
  {
    $query = loadClass('core/db')->smartInsert('courses', $data, ['id', $course_id]);

    if ($query === true)
    {
      return true;
    }
    else
    {
      return false;
    }
  }


  /**
   * Actualiza la imagen de un Curso en la base de datos.
   *
   * @param int $course_id El ID del Curso a actualizar.
   * @param array $image La imagen a subir.
   * @return bool true si se pudo actualizar, false si no.
   */
  public function updateImage($course_id, $image): bool
  {
    global $config;

    // Elimina la imagen antig del Curso
    $image_contact = loadClass('core/db')->getColumns('courses', array('image'), array('id', $course_id));

    if (loadClass('core/extra')->deleteImage($image_contact['image'], $config['courses_path']))
    {
      $upload = loadClass('core/extra')->uploadImage($image, $config['courses_path']);

      if ($upload != false)
      {
        $query = loadClass('core/db')->smartInsert('courses', ['image' => $upload], ['id', $course_id]);

        if ($query == true)
        {
          return true;
        }
        else
        {
          error_log('Error al actualizar la imagen del curso');
          return false;
        }
      }
      else
      {
        return false;
      }
    }
    return false;
  }

  /**
   * Elimina un Curso de la base de datos y su imagen asociada.
   *
   * @param int $course_id El ID del Curso a eliminar.
   * @return bool true si se pudo eliminar, false si no.
   */
  public function deleteCourse($course_id): array
  {
    global $config;

    // Obtener la imagen actual del curso
    $image_contact = loadClass('core/db')->getColumns('courses', ['image'], ['id', $course_id]);

    // Eliminar la imagen del curso
    if (!loadClass('core/extra')->deleteImage($image_contact['image'], $config['courses_path']))
    {
      error_log('Error al eliminar la imagen del curso');
      return ['status' => false, 'msg' => 'Error al eliminar la imagen del curso'];
    }

    // Eliminar el curso de la base de datos
    $query = loadClass('core/db')->deleteRow('courses', $course_id);

    if ($query)
    {
      return ['status' => true, 'msg' => 'Curso eliminado correctamente'];
    }
    else
    {
      error_log('Error al eliminar el curso de la base de datos');
      return ['status' => false, 'msg' => 'Error al eliminar el curso de la base de datos'];
    }
  }
}
