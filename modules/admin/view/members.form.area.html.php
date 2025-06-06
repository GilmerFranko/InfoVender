<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista del formulario encargado de editar y agregar rangos
 *
 *
 */

$expirationDate = $member['pp_expiration'];
$currentDate = time();
$daysLeft = ceil(($expirationDate - $currentDate) / (60 * 60 * 24));

?>

<style>
  .user-card {
    background: white;
    border-radius: 10px;
    box-shadow: var(--card-shadow);
    overflow: hidden;
    margin: 20px auto;
    max-width: 900px;
  }

  .user-header {
    background: linear-gradient(135deg, #38a37f, #00897b);
    color: white;
    padding: 20px;
    position: relative;
    margin-bottom: 20px;
  }

  .user-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 40px;
    margin-right: 20px;
    color: var(--primary);
  }

  .user-info {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
  }

  .expiration-badge {
    position: absolute;
    top: 20px;
    right: 20px;
    background: white;
    color: #333;
    padding: 8px 15px;
    border-radius: 20px;
    font-weight: bold;
    box-shadow: var(--card-shadow);
  }

  .expiration-card {
    background: white;
    border-radius: 10px;
    box-shadow: var(--card-shadow);
    overflow: hidden;
    margin: 20px 0;
  }

  .card-tabs {
    display: flex;
    border-bottom: 2px solid #eee;
  }

  .card-tab {
    flex: 1;
    text-align: center;
    padding: 15px;
    cursor: pointer;
    transition: all 0.3s;
    background: var(--light-bg);
  }

  .card-tab.active {
    background: white;
    border-bottom: 3px solid var(--primary);
    font-weight: bold;
    color: var(--primary);
  }

  .tab-content {
    padding: 25px;
    display: none;
  }

  .tab-content.active {
    display: block;
  }

  .days-counter {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 20px 0;
  }

  .days-btn {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: var(--primary);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    cursor: pointer;
    border: none;
    transition: transform 0.2s;
  }

  .days-btn:hover {
    transform: scale(1.1);
  }

  .days-input {
    width: 80px;
    margin: 0 15px;
    text-align: center;
    font-size: 28px;
    font-weight: bold;
    border: none;
    border-bottom: 2px solid var(--primary);
    outline: none;
  }

  .calendar-container {
    display: flex;
    justify-content: center;
    margin-top: 20px;
  }

  .date-display {
    text-align: center;
    padding: 15px;
    background: #e3f2fd;
    border-radius: 8px;
    margin-top: 20px;
  }

  .new-date {
    font-size: 20px;
    font-weight: bold;
    color: var(--primary);
  }


  .btn-extend:hover {
    background: #00897b;
  }

  .info-icon {
    color: var(--primary);
    vertical-align: middle;
    margin-left: 5px;
    cursor: pointer;
  }
</style>

<div class="user-card">
  <div class="user-header">
    <div class="expiration-badge">
      <i class="material-icons tiny">timer</i>
      <?= $daysLeft > 0 ? "Días restantes: $daysLeft" : "¡Cuenta expirada!" ?>
      <br>
      <small>Vence el <?= date('d/m/Y', $expirationDate); ?> <?= $expirationDate ?></small>
    </div>

    <div class="user-info">
      <div class="user-avatar">
        <i class="material-icons">person</i>
      </div>
      <div>
        <h4 style="margin:0"><?php echo $member['name']; ?></h4>
        <p style="margin:0"><?php echo $member['email']; ?></p>
      </div>
    </div>
  </div>

  <div class="card-content">
    <form action="javascript:admin.forms.save('Member', '<?php echo $member['member_id']; ?>');" id="form-Members" method="post">
      <!-- Campos de edición básica -->
      <div class="row">
        <div class="input-field col s12 m6">
          <i class="material-icons prefix">person</i>
          <input name="member[<?php echo $member['member_id']; ?>][]" id="name<?php echo $member['member_id']; ?>" type="text" class="validate" data-key="name" value="<?php echo $member['name']; ?>" required>
          <label class="active" for="name<?php echo $member['member_id']; ?>">Nombre de usuario</label>
        </div>

        <div class="input-field col s12 m6">
          <i class="material-icons prefix">email</i>
          <input name="member[<?php echo $member['member_id']; ?>][]" id="email<?php echo $member['member_id']; ?>" data-key="email" type="email" class="validate" value="<?php echo $member['email']; ?>" required>
          <label class="active" for="email<?php echo $member['member_id']; ?>">Email</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12 m6">
          <i class="material-icons prefix">lock</i>
          <input name="member[<?php echo $member['member_id']; ?>][]" id="password<?php echo $member['member_id']; ?>" data-key="password" type="password" class="validate">
          <label for="password<?php echo $member['member_id']; ?>">Contrase&ntilde;a</label>
        </div>

        <!-- Teléfono -->
        <div class="input-field col s12 m6">
          <i class="material-icons prefix">phone</i>
          <input name="member[<?php echo $member['member_id']; ?>][]" id="num_phone<?php echo $member['member_id']; ?>" type="tel" class="validate" value="<?php echo $member['num_phone']; ?>" data-key="num_phone" required>
          <label for="num_phone<?php echo $member['member_id']; ?>">Teléfono</label>
        </div>

        <div class="row">
          <div class="input-field col s12 m9">
            <input type="hidden" id="memberGroup<?php echo $member['member_id']; ?>" name="member[<?php echo $member['member_id']; ?>][]" data-key="group_id" value="<?php echo $member['group_id']; ?>" />
            <select data-placeholder="<?php echo $member['g_title']; ?>" class="browser-default" onchange="$('#memberGroup<?php echo $member['member_id']; ?>').val($(this).val())">
              <?php while ($group = $groups['data']->fetch_assoc())
              { ?>

                <option value="<?php echo $group['g_id']; ?>" <?php if ($group['g_id'] == $member['group_id']) echo 'selected="selected"'; ?>><?php echo $group['g_title']; ?></option>
              <?php } ?>
              <optgroup label="Otro">
                <option value="0" <?php if ($member['group_id'] == '0') echo 'selected="selected"'; ?>>No activado</option>
              </optgroup>
            </select>
            <label for="memberGroup<?php echo $member['member_id']; ?>" class="active">Rango</label>
          </div>

          <div class="input-field col s12 m3">
            <label>
              <input name="member[<?php echo $member['member_id']; ?>][]" id="banned<?php echo $member['member_id']; ?>" type="checkbox" class="filled-in" data-key="banned" id="memberBanned" value="1" <?php echo $member['banned'] > 0 ? 'checked="checked"' : ''; ?>>
              <span>Suspendido</span>
            </label>
          </div>
        </div>

        <!-- Botón de guardar -->
        <div class="row" style="margin-top: 30px">
          <div class="col s12 center">
            <button type="submit" name="save" class="waves-effect waves-light btn-large blue darken-3">
              <i class="material-icons left">save</i> Guardar todos los cambios
            </button>
          </div>
        </div>
    </form>

    <form action="javascript:admin.forms.save('edit.timeexpiration', '<?php echo $member['member_id']; ?>');" id="form-Members" method="post">
      <!-- Sección de extensión de tiempo -->
      <div class="expiration-card">
        <h5 style="padding: 20px 25px 0; margin-bottom: 0">Extender tiempo de acceso <i class="material-icons info-icon" title="Amplía la duración de la cuenta de usuario">info_outline</i></h5>

        <div class="card-tabs">
          <div class="card-tab active" data-tab="_">
            <i class="material-icons">add</i> Añadir días
          </div>
          <div class="card-tab" data-tab="specific-date">
            <i class="material-icons">event</i> Fecha específica
          </div>
        </div>

        <div class="tab-content active" id="_-tab">
          <div class="days-counter">
            <input type="number" id="add_days<?= $member['member_id'] ?>" name="edit.timeexpiration[<?php echo $member['member_id']; ?>][]" class="days-input">
          </div>

          <p style="text-align: center; margin-top: -10px">días adicionales</p>

          <div class="date-display">
            <p style="margin: 5px 0">La nueva fecha de expiración será:</p>
            <p class="new-date" id="calculated-date"><?= date('d/m/Y', strtotime($expirationDate)) ?></p>
          </div>
        </div>

        <div class="tab-content" id="specific-date-tab">
          <div class="calendar-container">
            <div class="input-field" style="width: 300px">
              <i class="material-icons prefix">calendar_today</i>
              <input id="expiration_date<?= $member['member_id'] ?>" name="edit.timeexpiration[<?php echo $member['member_id']; ?>][]" type="date" class="datepicker">
              <label for="expiration_date<?= $member['member_id'] ?>">Seleccione fecha de expiración</label>
            </div>
          </div>
        </div>

        <div style="text-align: center; padding: 0 25px 25px">
          <button type="button" name="save" class="waves-effect waves-light btn btn-extend">
            <i class="material-icons left">update</i> Aplicar extensión
          </button>
        </div>
      </div>

    </form>
  </div>
</div>

<script>
  id_add_days = '#add_days' + <?= $member['member_id'] ?>;
  id_expiration_date = '#expiration_date' + <?= $member['member_id'] ?>;

  $(document).ready(function() {
    M.updateTextFields()
    // Inicializar datepicker
    /* $('.datepicker').datepicker({
      format: 'd/m/yyyy',
      autoClose: true,
      minDate: new Date(),
      defaultDate: new Date(<?= $expirationDate * 1000 ?>),
    }); */

    // Cambiar entre pestañas
    $('.card-tab').click(function() {
      $('.card-tab').removeClass('active');
      $(this).addClass('active');

      $('.tab-content').removeClass('active');
      $('#' + $(this).data('tab') + '-tab').addClass('active');
    });


    $(id_add_days).on('input', function() {
      var days = parseInt($(this).val()) || 0;
      if (days < 1) $(this).val(1);
      calculateNewDate();
    });

    // Calcular nueva fecha
    function calculateNewDate() {
      var daysToAdd = parseInt($(id_add_days).val()) || 0;
      var expirationDate = new Date(<?= $expirationDate * 1000 ?>);
      expirationDate.setDate(expirationDate.getDate() + daysToAdd);

      var formattedDate = formatDate(expirationDate);
      $('#calculated-date').text(formattedDate);
    }

    // Función para formatear fecha
    function formatDate(date) {
      return date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();
    }

    // Inicializar la vista
    calculateNewDate();

    // Botón de aplicar extensión
    $('.btn-extend').click(function(e) {

      if (!$(id_add_days).val() && !$(id_expiration_date).val()) {
        alert('Debe seleccionar una fecha de expiración o ingresar días adicionales');
        e.preventDefault();
        return;
      }

      var tab = $('.card-tab.active').data('tab');
      var message = '';

      // Obtener referencias actualizadas a los elementos
      var $addDays = $(id_add_days);
      var $expirationDate = $(id_expiration_date);

      if (tab === '_') {
        var days = $addDays.val();
        message = `¿Extender la cuenta por ${days} días adicionales?`;

        // Asignación CORRECTA de data-key (2 métodos válidos)
        $addDays.attr('data-key', 'expiration_date'); // Método 1 - más confiable
        // $addDays.data('key', 'expiration_date');   // Método 2 - usa .data() de jQuery

        $expirationDate.removeAttr('data-key');

      } else {
        var date = $('#selected-date').text();
        message = `¿Establecer ${date} como nueva fecha de expiración?`;

        $expirationDate.attr('data-key', 'expiration_date');
        $addDays.removeAttr('data-key');
      }

      // Debug: Verificar en consola
      console.log('add_days data-key:', $addDays.attr('data-key'));
      console.log('expiration_date data-key:', $expirationDate.attr('data-key'));

      if (confirm(message)) {
        // Enviar formulario
        admin.forms.save('edit.timeexpiration', '<?php echo $member['member_id']; ?>');
        // Ocultar el panel de edición
        admin.forms.get('Member', '', true);
      }
    });
  });
</script>