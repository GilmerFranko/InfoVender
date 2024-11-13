<div id="contentCourses">
  <table class="striped responsive-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Segmentacion</th>
        <th>Precio sugerido</th>
        <th>Estado</th>
        <th>Fecha</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($courses['rows'] > 0)
      {
        foreach ($courses['data'] as $course): ?>
          <tr>
            <td><?php echo $course['id']; ?></td>
            <td><?php echo $course['name']; ?></td>
            <td><?php echo $course['segmentation']; ?></td>
            <td><?php echo $course['suggested_daily_investment']; ?></td>
            <td><?php echo $course['status'] == 0 ? 'Desactivado' : ($course['status'] > 1 ? 'Activo' : 'Pendiente'); ?></td>
            <td><?php echo date('Y-m-d H:i:s', $course['created_at']); ?></td>
            <td>
              <a href="<?= gLink('admin/edit.course', ['course_id' => $course['id']]) ?>" class="btn-floating btn-small waves-effect waves-light blue"><i class="material-icons">edit</i></a>
              <a href="#deleteCourseModal" class="btn-floating btn-small waves-effect waves-light red modal-trigger" onclick="setDeleteCourse(<?= $course['id']; ?>)"><i class="material-icons">delete</i></a>
            </td>
          </tr>
        <?php endforeach;
      }
      else
      { ?>
        <tr>
          <td colspan="7">No se han encontrado resultados</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <!--paginador-->
  <?php echo $courses['pages']['paginator']; ?>
  <!--fin_paginador-->
</div>