<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco
 *=======================================================
 *
 * @Description Vista de la página de los Top 20 con buscador dinámico
 */

require Core::view('head', 'core');
?>

<section id="adminTopCourses">
  <div class="card-panel teal lighten-5 teal-text flow-text center-align">
    <strong>Gestionar Top 20 Cursos</strong>
  </div>
  <div class="container">
    <div class="row">
      <!-- Lista de Top 20 -->
      <div class="col s12 m8">
        <ul class="collection with-header">
          <li class="collection-header">
            <h5 class="center-align">Cursos en el Top 20</h5>
          </li>
          <?php if (!empty($topCourses)): ?>
            <?php foreach ($topCourses as $course): ?>
              <li id="li-<?= $course['course_id'] ?>" class="collection-item">
                <span><?= $course['position'] ?>. <?= $course['name'] ?></span>
                <br>
                <a href="#" class="btn-flat move-course" data-id="<?= $course['course_id'] ?>" data-action="up" title="Mover arriba">
                  <i class="material-icons">arrow_upward</i>
                </a>
                <a href="#" class="btn-flat move-course" data-id="<?= $course['course_id'] ?>" data-action="down" title="Mover abajo">
                  <i class="material-icons">arrow_downward</i>
                </a>
                <a href="#" class="btn-flat red-text remove-course" data-id="<?= $course['course_id'] ?>" title="Eliminar curso">
                  <i class="material-icons">delete</i>
                </a>
              </li>
            <?php endforeach; ?>
          <?php else: ?>
            <li class="collection-item center-align">No hay cursos en el Top 20 actualmente.</li>
          <?php endif; ?>
        </ul>
      </div>

      <!-- Buscador dinámico -->
      <div class="col s12 m4">
        <div class="card hoverable z-depth-1">
          <div class="card-content">
            <h5 class="center-align">Buscar y Agregar Curso</h5>
            <div class="input-field">
              <input type="text" id="course-search" placeholder="Buscar curso...">
            </div>
            <ul class="collection" id="search-results">
              <!-- Resultados dinámicos -->
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  $(document).ready(function() {
    // Búsqueda de cursos
    $('#course-search').on('input', function() {
      const query = $(this).val();

      if (query.length > 2) {
        $.ajax({
          url: '<?= gLink('admin/top20') ?>',
          method: 'POST',
          data: {
            action: 'search',
            query
          },
          success: function(response) {
            let results = JSON.parse(response);
            let html = '';

            if (results.length) {
              results.forEach(course => {
                html += `
                  <li class="collection-item">
                    <span>${course.name}</span>
                    <a href="#" class="secondary-content add-course" data-id="${course.id}" title="Agregar al Top 20">
                      <i class="material-icons green-text">add</i>
                    </a>
                  </li>
                `;
              });
            } else {
              html = '<li class="collection-item">No se encontraron resultados</li>';
            }

            $('#search-results').html(html);
          }
        });
      } else {
        $('#search-results').html('');
      }
    });

    // Agregar curso
    $(document).on('click', '.add-course', function(e) {
      e.preventDefault();
      const courseId = $(this).data('id');

      $.ajax({
        url: '<?= gLink('admin/top20') ?>',
        method: 'POST',
        data: {
          action: 'add',
          course_id: courseId
        },
        success: function(response) {
          const result = JSON.parse(response);
          M.toast({
            html: result.message,
            classes: result.success ? 'green' : 'red'
          });

          if (result.success) {
            location.reload();
          }
        }
      });
    });

    // Eliminar curso
    $(document).on('click', '.remove-course', function(e) {
      e.preventDefault();
      const courseId = $(this).data('id');

      $.ajax({
        url: '<?= gLink('admin/top20') ?>',
        method: 'POST',
        data: {
          action: 'remove',
          course_id: courseId
        },
        success: function(response) {
          const result = JSON.parse(response);
          M.toast({
            html: result.message,
            classes: result.success ? 'green' : 'red'
          });

          if (result.success) {
            location.reload();
          }
        }
      });
    });

    // Mover curso hacia arriba o abajo
    $(document).on('click', '.move-course', function(e) {
      e.preventDefault();
      const courseId = $(this).data('id');
      const direction = $(this).data('action'); // 'up' o 'down'

      $.ajax({
        url: '<?= gLink('admin/top20') ?>',
        method: 'POST',
        data: {
          action: 'move',
          course_id: courseId,
          direction: direction
        },
        success: function(response) {
          const result = JSON.parse(response);
          M.toast({
            html: result.message,
            classes: result.success ? 'green' : 'red'
          });

          if (result.success) {
            // Seleccionar el elemento actual
            const currentItem = $('#li-' + courseId);

            if (direction === 'up') {
              // Mover hacia arriba: intercambiar con el elemento anterior
              const previousItem = currentItem.prev('li.collection-item');
              if (previousItem.length) {
                currentItem.insertBefore(previousItem);
              }
            } else if (direction === 'down') {
              // Mover hacia abajo: intercambiar con el siguiente elemento
              const nextItem = currentItem.next('li.collection-item');
              if (nextItem.length) {
                currentItem.insertAfter(nextItem);
              }
            }

            // Actualizar posiciones visualmente
            updatePositions();
          }
        }
      });
    });

    // Actualizar las posiciones de los cursos en la lista
    function updatePositions() {
      $('ul.collection li.collection-item').each(function(index) {
        const positionSpan = $(this).find('span').first();
        const courseName = positionSpan.text().split('. ')[1]; // Mantener el nombre intacto
        positionSpan.text((index + 1) + '. ' + courseName);
      });
    }


  });
</script>

<style>
  .collection-item {
    background-color: #fff !important;
  }

  .collection,
  .collection .collection-item {
    border: none !important;
  }
</style>

<?php require Core::view('footer', 'core'); ?>