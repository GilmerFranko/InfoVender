<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Este modelo se encarga de gestionar lo relacionado con los productos
 *
 *
 */

class Product extends Model
{
  /** Optiene todos los productos */
  public function getAllProducts($params = [], $limit = 20)
  {
    $where = [];

    // Filtrar por nombre
    if (!empty($params['name']))
    {
      $where[] = 'p.`name` LIKE "%' . $params['name'] . '%"';
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
    $data['pages'] = Core::model('paginator', 'core')->pageIndex(array('admin', 'products', null, $params), $data['total'], $limit);

    // Construir la consulta SQL final con paginación
    $query = $this->db->query(
      'SELECT * 
        FROM `products` AS p
        ' . $where_clause . '
        ORDER BY 
            p.`created_at` ' . $order_by . '
        LIMIT ' . $data['pages']['limit']
    );
    error_log('SELECT * 
        FROM `products` AS p
        ' . $where_clause . '
        ORDER BY 
            p.`created_at` ' . $order_by . '
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
   * Obtiene el producto por su ID
   * @param int $id
   * @return array|null
   */
  public function getProductById(int $id): ?array
  {
    $query = $this->db->query(
      'SELECT * 
       FROM `products` AS p 
       WHERE p.`id` = ' . intval($id)
    );

    if ($query && $query->num_rows > 0)
    {
      return $query->fetch_assoc();
    }

    return null;
  }

  /**
   * Verifica si un slug ya existe en la tabla products
   * @param string $slug El slug a verificar
   * @return bool
   */
  public function isSlugAvailable(string $slug, $product_id = null): bool
  {
    $where = 'WHERE p.`slug` = "' . $slug . '"';

    if ($product_id != null)
      $where .= ' AND p.`id` != ' . intval($product_id);

    $query = $this->db->query(
      'SELECT COUNT(*) 
       FROM `products` AS p 
       ' . $where . '
       '
    );

    if ($query && $query->num_rows > 0)
    {
      list($count) = $query->fetch_row();

      return $count == 0;
    }

    return false;
  }

  /**
   * Crea un nuevo producto
   * @param array $data
   * @return int
   */
  public function newProduct(array $data): int
  {
    // Generar el slug a partir del título
    $slug = loadClass('core/extra')::generateSlug($data['name']);

    // Añadir un sufijo único para evitar colisiones (puedes usar ID, timestamp, etc.)
    $uniqueId = substr(md5(time()), 0, 6);  // 4 caracteres aleatorios

    // Combinar el slug y el sufijo para generar la URL
    $url = $slug . '.' . $uniqueId;

    $data['slug'] = $url;

    if ($r = loadClass('core/db')->smartInsert('products', $data))
    {
      return $r;
    }
    return 0;
  }

  /**
   * Actualiza un registro en la tabla products con los datos proporcionados.
   *
   * @param int $id El ID del registro a actualizar
   * @param array $data Los datos del nuevo registro.
   * @return bool true si se pudo actualizar, false si no.
   */
  public function updateProduct($id, $data): bool
  {
    $query = loadClass('core/db')->smartInsert('products', $data, ['id', $id]);

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
            $config['products_path']
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
              loadClass('core/extra')->deleteImage($img, $config['products_path']);
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

  /**
   * Actualiza la imagen de un Producto en la base de datos.
   *
   * @param int $product_id El ID del Producto a actualizar.
   * @param array $image La imagen a subir.
   * @return bool true si se pudo actualizar, false si no.
   */
  public function updateImage($product_id, $image): bool
  {
    global $config;

    // Optiene la direccion de la imagen actual del Producto
    $image_contact = loadClass('core/db')->getColumns('products', array('image'), array('id', $product_id));

    // Elimina la imagen actual del Producto
    if (loadClass('core/extra')->deleteImage($image_contact['image'], $config['products_path']))
    {
      // Sube la nueva imagen al servidor
      $upload = loadClass('core/extra')->uploadImage($image, $config['products_path']);

      // Actualiza la imagen en la base de datos
      if ($upload != false)
      {
        $query = loadClass('core/db')->smartInsert('products', ['image' => $upload], ['id', $product_id]);

        if ($query == true)
        {
          return true;
        }
        else
        {
          error_log('Error al actualizar la imagen del Producto');
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
   * Elimina un producto de la base de datos y su imagen asociada.
   *
   * @param int $id El ID del producto a eliminar.
   * @return bool true si se pudo eliminar, false si no.
   */
  public function deleteProduct($id): array
  {
    global $config;

    // Obtener la imagen actual del producto
    $image_product = loadClass('core/db')->getColumns('products', ['image'], ['id', $id]);

    // Eliminar la imagen del producto
    if (!loadClass('core/extra')->deleteImage($image_product['image'], $config['products_path']))
    {
      error_log('Error al eliminar la imagen del producto');
      return ['status' => false, 'msg' => 'Error al eliminar la imagen del producto'];
    }

    // Eliminar el producto de la base de datos
    $query = loadClass('core/db')->deleteRow('products', $id);

    if ($query)
    {
      return ['status' => true, 'msg' => 'Producto eliminado correctamente'];
    }
    return ['status' => false, 'msg' => 'Error al eliminar el producto de la base de datos'];
  }
}
