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
  public function newCourse(array $data): int
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
    return 0;
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

  /**
   * Obtiene los cursos del Top 20
   * @return array
   */
  public function getTopCourses(): array
  {
    $query = $this->db->query(
      'SELECT tc.course_id, c.name, c.image, tc.*
             FROM `top_courses` AS tc
             JOIN `courses` AS c ON tc.course_id = c.id
             ORDER BY tc.position ASC'
    );

    $data = [];
    if ($query && $query->num_rows > 0)
    {
      while ($row = $query->fetch_assoc())
      {
        $data[] = $row;
      }
    }

    return $data;
  }

  /**
   * Cuenta los cursos en el Top 20
   * @return int
   */
  public function countTopCourses(): int
  {
    $query = $this->db->query('SELECT COUNT(*) AS total FROM `top_courses`');
    list($total) = $query->fetch_row();
    return intval($total);
  }

  /**
   * Verifica si un curso ya está en el Top 20
   * @param int $courseId
   * @return bool
   */
  public function isInTop(int $courseId): bool
  {
    $query = $this->db->query(
      'SELECT 1 
             FROM `top_courses` 
             WHERE `course_id` = ' . intval($courseId)
    );

    return $query && $query->num_rows > 0;
  }

  /**
   * Agrega un curso al Top 20
   * @param int $courseId
   * @return bool
   */
  public function addToTop(int $courseId): bool
  {
    if ($this->countTopCourses() >= 20)
    {
      error_log('El Top 20 ya está completo.');
      return false;
    }

    // Determinar la nueva posición
    $position = $this->countTopCourses() + 1;

    $query = $this->db->query(
      'INSERT INTO `top_courses` (`course_id`, `position`) 
             VALUES (' . intval($courseId) . ', ' . intval($position) . ')'
    );

    return $query !== false;
  }

  /**
   * Elimina un curso del Top 20
   * @param int $courseId
   * @return bool
   */
  public function removeFromTop(int $courseId): bool
  {
    $query = $this->db->query(
      'DELETE FROM `top_courses` 
             WHERE `course_id` = ' . intval($courseId)
    );

    if ($query)
    {
      $this->reorderTopPositions();
      return true;
    }

    return false;
  }

  /**
   * Reordena las posiciones del Top 20
   * @return void
   */
  private function reorderTopPositions(): void
  {
    $query = $this->db->query(
      'SELECT `course_id` 
             FROM `top_courses` 
             ORDER BY `position` ASC'
    );

    if ($query && $query->num_rows > 0)
    {
      $position = 1;
      while ($row = $query->fetch_assoc())
      {
        $this->db->query(
          'UPDATE `top_courses` 
                     SET `position` = ' . $position . ' 
                     WHERE `course_id` = ' . intval($row['course_id'])
        );
        $position++;
      }
    }
  }

  /**
   * Obtiene los cursos disponibles que no están en el Top 20
   * @return array
   */
  public function getAvailableCoursesNotInTop(): array
  {
    $query = $this->db->query(
      'SELECT c.id, c.name 
             FROM `courses` AS c
             WHERE c.id NOT IN (
                 SELECT tc.course_id 
                 FROM `top_courses` AS tc
             )
             AND c.status = 1
             ORDER BY c.name ASC'
    );

    $data = [];
    if ($query && $query->num_rows > 0)
    {
      while ($row = $query->fetch_assoc())
      {
        $data[] = $row;
      }
    }

    return $data;
  }


  public function searchCoursesNotInTop(string $query): array
  {
    $sql = "
        SELECT id, name 
        FROM courses 
        WHERE name LIKE '%" . $query . "%' 
        AND id NOT IN (SELECT course_id FROM top_courses)
        LIMIT 10
    ";

    $query = $this->db->query($sql);
    if ($query and $query->num_rows > 0)
    {
      while ($row = $query->fetch_assoc())
      {
        $data[] = $row;
      }
      return $data;
    }
    return [];
  }
  public function moveCourseUp($courseId, $currentPosition)
  {
    // Mover el curso hacia arriba (intercambiar con el curso anterior)
    $previousPosition = $currentPosition - 1;

    // Escapar valores para evitar inyecciones SQL
    $courseId = (int) $courseId;
    $previousPosition = (int) $previousPosition;

    // Realizar la actualización del curso que estaba en la posición anterior
    $query1 = "UPDATE top_courses SET position = position + 1 WHERE position = $previousPosition";
    $this->db->query($query1);

    // Actualizar la posición del curso actual
    $query2 = "UPDATE top_courses SET position = position - 1 WHERE course_id = $courseId";
    $this->db->query($query2);
  }

  public function moveCourseDown($courseId, $currentPosition)
  {
    // Mover el curso hacia abajo (intercambiar con el curso siguiente)
    $nextPosition = $currentPosition + 1;

    // Escapar valores para evitar inyecciones SQL
    $courseId = (int) $courseId;
    $nextPosition = (int) $nextPosition;

    // Realizar la actualización del curso que estaba en la posición siguiente
    $query1 = "UPDATE top_courses SET position = position - 1 WHERE position = $nextPosition";
    $this->db->query($query1);

    // Actualizar la posición del curso actual
    $query2 = "UPDATE top_courses SET position = position + 1 WHERE course_id = $courseId";
    $this->db->query($query2);
  }

  public function getCourseByIdInTop($courseId)
  {
    // Escapar el valor del ID del curso para evitar inyecciones SQL
    $courseId = (int) $courseId;  // Asegúrate de que el ID sea un número entero

    // Consulta directa
    $query = "SELECT id, position FROM top_courses WHERE course_id = $courseId AND position <= 20 LIMIT 1";
    // Ejecutar la consulta
    $result = $this->db->query($query);

    // Verificar si la consulta ha devuelto algún resultado
    if ($result && $result->num_rows > 0)
    {
      return $result->fetch_assoc(); // Devuelve el curso como un array asociativo
    }

    // Si no se encuentra el curso en el Top 20, retorna false
    return false;
  }

  // Optiene la posicion más baja actual
  public function getLowestPosition(): int
  {
    $query = $this->db->query('SELECT position FROM top_courses ORDER BY position DESC LIMIT 1');
    return $query->num_rows > 0 ? $query->fetch_assoc()['position'] : 20;
  }
}
