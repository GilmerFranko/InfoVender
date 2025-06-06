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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/css/intlTelInput.css">
<style>
  input.iti__tel-input {
    height: 3rem !important;
    margin: 0 0 8px 0 !important;
  }
</style>
<section id="adminNewMember">
  <div class="card-panel green lighten-4 green-text text-darken-4 flow-text center-align"><?= $page['name'] ?></div>
  <div class="sectionCourses container">
    <form class="col s12" id="newMemberForm" method="POST" action="<?= gLink('admin/new.member'); ?>" enctype="multipart/form-data">
      <input type="hidden" name="register">
      <div class="row">
        <!-- Usuario -->
        <div class="input-field col s12 m6">
          <input type="text" name="name" id="name" required>
          <label for="name">Usuario</label>
        </div>
        <!-- Teléfono -->
        <div class="input-field col s12 m6">
          <input type="tel" name="num_phone" id="num_phone" style="margin: 0 0 8px 0 !important;" required>
          <input type="hidden" name="full_num_phone" id="full_num_phone">
        </div>
        <!-- Email -->
        <div class="input-field col s12 m6">
          <input type="email" name="email" id="email" required>
          <label for="email">Email</label>
        </div>
        <!-- Contraseña -->
        <div class="input-field col s12 m6">
          <input type="text" name="password" id="password" value="" required>
          <label for="password">Contraseña</label>
          <button class="btn waves-effect waves-light green" type="button" onclick="generateRandomPassword()">Generar contraseña aleatoria</button>
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

<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/intlTelInput.min.js"></script>
<script>
  const input = document.querySelector("#phone");
  window.intlTelInput(input, {
    loadUtils: () => import("https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/utils.js"),
  });
</script>

<script>
  $(document).ready(function() {
    const input = document.querySelector("#num_phone");
    iti = window.intlTelInput(input, {
      initialCountry: "mx",
      strictMode: true,
      loadUtils: () => import("https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/utils.js"),
    });

    // Evento de envío del formulario
    $('#newMemberForm').on('submit', function(event) {
      event.preventDefault(); // Previene que se envíe el formulario
      const namePattern = /^([a-zA-Z ]{4,30})$/isu;
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      const fullNumber = iti.getNumber(); // Obtiene el número completo (ej. +584121234567)
      $('#full_num_phone').val(fullNumber); // Asigna el valor al campo hidden
      const name = $('#name').val();
      const email = $('#email').val();
      if (!namePattern.test(name)) {
        M.toast({
          html: 'Nombre no válido',
          classes: 'red'
        });
        return;
      }
      if (!emailPattern.test(email)) {
        M.toast({
          html: 'Email no válido',
          classes: 'red'
        });
        return;
      }
      if (!iti.isValidNumber()) {
        M.toast({
          html: 'Número de teléfono inválido',
          classes: 'red'
        });
        return;
      }
      this.submit();
    });
  });

  function generateRandomPassword() {
    var length = 12;
    var chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    var password = '';
    for (var i = 0; i < length; i++) {
      var randomString = chars[Math.floor(Math.random() * chars.length)];
      password += randomString;
    }
    document.getElementById('password').value = password;
    M.updateTextFields()
  }
</script>
<?php require Core::view('footer', 'core'); ?>