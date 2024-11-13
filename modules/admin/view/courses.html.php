<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de la página de todos los Cursos
 *
 *
 */

require Core::view('head', 'core');
?>

<!-- Modal de confirmar eliminación de Curso -->
<div id="deleteCourseModal" class="modal">
  <div class="modal-content">
    <input id="id_course" type="hide">
    <h4>Confirmar eliminación</h4>
    <p>¿Estás seguro de que deseas eliminar este Curso? Esta acción no se puede deshacer.</p>
    <div class="row">
      <div class="input-field col s12">
        <input id="password" name="password" type="password" class="validate" required>
        <label for="password">Ingresa tu contraseña para confirmar</label>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat">Cancelar</a>
    <a href="#" class="modal-action waves-effect waves-green btn-flat" onclick="confirmDelete($('#id_course').val())">Eliminar</a>
  </div>
</div>

<section id="adminCourses">
  <!-- BUSCADOR -->
  <div class="row" style="margin-top: 30px;">
    <div class="col s12">
      <form class="white" action="<?php echo Core::model('extra', 'core')->generateUrl('admin', 'courses'); ?>" method="get">
        <div class="input-field col s12 m6">
          <i class="material-icons prefix">search</i>
          <input id="search" name="search" type="search" value="<?php echo $search; ?>">
          <label for="search">Buscar...</label>
        </div>
        <div class="input-field col s12 m3">
          <button type="submit" class="btn waves-effect waves-light teal darken-1">Buscar</button>
        </div>
      </form>
    </div>
  </div>
  <div class="col s4">
    <a href="<?php echo Core::model('extra', 'core')->generateUrl('admin', 'new.course'); ?>" class="btn waves-effect waves-light green" title="Crear nuevo curso">
      <i class="material-icons left">add</i> Nuevo curso
    </a>
  </div>
  <!-- ./BUSCADOR -->
  <blockquote>Resultado: <?php echo $courses['total']; ?></blockquote>

  <div class="sectionCourses">
    <?php include Core::view('courses.area'); ?>
  </div>

</section>

<!-- Footer -->
<?php require Core::view('footer', 'core'); ?>
<!-- / Footer -->

<script>
  function setDeleteCourse(course_id) {
    document.getElementById('id_course').value = course_id;
    $('#deleteCourseModal').modal('open');
  }

  function confirmDelete(course_id) {
    var password = document.getElementById('password').value;
    if (!password) {
      M.toast({
        html: 'Por favor ingresa tu contraseña',
        classes: 'red darken-1'
      });
      return;
    }

    $.ajax({
      url: '<?= gLink('admin/delete.course', ['deleteCourse' => true]) ?>',
      type: 'POST',
      data: {
        course_id: course_id,
        password: password,
        token: '<?= $session->token ?>',
        ajax: true
      },
      dataType: 'json',
      success: function(data) {
        console.log(data)
        if (data.success) {
          M.toast({
            html: data.msg,
            classes: 'green darken-1'
          });
          window.location.href = '<?= gLink('admin/courses') ?>';
        } else {
          M.toast({
            html: data.msg,
            classes: 'red darken-1'
          });
        }
      },
      error: function(xhr, status, error) {
        console.log(xhr)
        console.log(status)
        console.log(error)
        M.toast({
          html: 'Ocurrió un error al eliminar el tema',
          classes: 'red darken-1'
        });
      }
    });
  }
</script>
<!-- JS adicional -->
<script type="text/javascript" src="<?php echo $config['base_url']; ?>/static/js/admin.js" />
</script>