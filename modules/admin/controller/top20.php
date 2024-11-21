<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco
 *=======================================================
 *
 * @Description Controlador para gestionar el Top 20 de cursos
 */

$page['name'] = 'Top 20 Cursos';
$page['code'] = 'adminTopCourses';

$msg = [];
$action = $_POST['action'] ?? null;

// Cargar el modelo de cursos
$topCoursesModel = loadClass('admin/course');
$coursesModel = loadClass('admin/course');

// Manejar acciones
if ($action === 'add')
{
  $courseId = intval($_POST['course_id'] ?? 0);

  if (!$coursesModel->getCourseById($courseId))
  {
    $msg = 'El curso no existe.';
  }
  elseif ($topCoursesModel->countTopCourses() >= 20)
  {
    $msg = 'El Top 20 ya está completo.';
  }
  elseif ($topCoursesModel->isInTop($courseId))
  {
    $msg = 'El curso ya está en el Top 20.';
  }
  else
  {
    $topCoursesModel->addToTop($courseId);
    $msg = 'Curso agregado al Top 20 exitosamente.';
  }

  echo json_encode(['success' => empty($msg), 'message' => $msg]);
  exit;
}

if ($action === 'remove')
{
  $courseId = intval($_POST['course_id'] ?? 0);

  if (!$topCoursesModel->isInTop($courseId))
  {
    $msg = 'El curso no está en el Top 20.';
  }
  else
  {
    $topCoursesModel->removeFromTop($courseId);
    $msg = 'Curso eliminado del Top 20 exitosamente.';
  }

  echo json_encode(['success' => empty($msg), 'message' => $msg]);
  exit;
}

if ($action === 'search')
{
  $query = trim($_POST['query'] ?? '');

  if (strlen($query) < 3)
  {
    echo json_encode([]);
    exit;
  }

  $results = $coursesModel->searchCoursesNotInTop($query);
  echo json_encode($results);
  exit;
}

if ($action === 'move')
{
  $courseId = intval($_POST['course_id'] ?? 0);
  $direction = $_POST['direction'] ?? '';  // Puede ser 'up' o 'down'

  if (!$topCoursesModel->isInTop($courseId))
  {
    $msg = ['success' => false, 'message' => 'El curso no está en el Top 20.'];
  }
  else
  {
    // Obtener el curso y su posición
    $course = $topCoursesModel->getCourseByIdInTop($courseId);

    // Optener la posicicion más baja actual
    $lowestPosition = $topCoursesModel->getLowestPosition();

    if ($course)
    {
      $currentPosition = $course['position'];
      // Lógica para mover el curso
      if ($direction === 'up' && $currentPosition > 1)
      {
        $topCoursesModel->moveCourseUp($courseId, $currentPosition);
        $msg = ['success' => true, 'message' => 'Curso movido hacia arriba.'];
      }
      elseif ($direction === 'down' && $currentPosition < 20 and $lowestPosition > $currentPosition)
      {
        $topCoursesModel->moveCourseDown($courseId, $currentPosition);
        $msg = ['success' => true, 'message' => 'Curso movido hacia abajo.'];
      }
      else
      {
        $msg = ['success' => false, 'message' => 'El curso no puede moverse más en esa dirección.'];
      }
    }
    else
    {
      $msg = ['success' => false, 'message' => 'El curso no está en el Top 20.'];
    }
  }
  echo json_encode(['success' => $msg['success'], 'message' => $msg['message']]);
  exit;
}

// Obtener datos para mostrar en la página
$topCourses = $topCoursesModel->getTopCourses();
$availableCourses = $coursesModel->getAvailableCoursesNotInTop();

// Mostrar mensajes en caso de redirección
if (!empty($msg))
{
  setToast($msg);
}
