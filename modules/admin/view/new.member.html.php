<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @autor Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista de nuevo miembro
 *
 *
 */

require Core::view('head', 'core');

?>
<section id="adminNewMember">


  <div class="card-panel green lighten-4 green-text text-darken-4 flow-text center-align"><?= $page['name'] ?></div>
  <div class="sectionCourses container">
    <form class="col s12" id="newMemberForm" method="POST" action="<?= gLink('admin/new.member'); ?>" enctype="multipart/form-data">
      <input type="hidden" name="register">
      <div class="row">
        <div class="input-field col s12 m6">
          <input type="text" name="name" id="name" required>
          <label for="name">Usuario</label>
        </div>
        <div class="input-field col s12 m6">
          <input type="email" name="email" id="email" required>
          <label for="email">Email</label>
        </div>
        <div class="input-field col s12 m6">
          <input type="date" name="birthday" id="birthday" required>
          <label for="birthday">Fecha de nacimiento</label>
        </div>
        <div class="input-field col s12 m6">
          <select name="gender" id="gender" required>
            <option value="" disabled selected>Genero</option>
            <option value="0">Masculino</option>
            <option value="1">Femenino</option>
          </select>
          <label for="gender">Genero</label>
        </div>
        <div class="input-field col s12 m6">
          <input type="password" name="password" id="password" required>
          <label for="password">Contraseña</label>
        </div>
        <div class="input-field col s12 m6">
          <input type="date" name="pp_expiration" id="pp_expiration" value="<?php echo date('Y-m-d', strtotime('+1 year')); ?>" required>
          <label for="pp_expiration">Fecha de caducidad</label>
        </div>
      </div>
      <button class="btn waves-effect waves-light green" type="submit"><i class="material-icons right notranslate">send</i>Crear nuevo miembro</button>
    </form>
  </div>
</section>

<?php require Core::view('footer', 'core'); ?>