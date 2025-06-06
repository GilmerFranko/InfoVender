<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Controlador principal de los creditos
 *
 *
 */
// Si es VIP MUESTRA EL CATALOGO DE CURSOS
if ($session->is_vip or $session->is_admod)
{
  include Core::controller('view.courses', 'courses');
  include Core::view('view.courses', 'courses');
}
// Si no es VIP, muestra la vista de invitado
else
{
  // HEADER
  require Core::view('head', 'core');
  // MENU
  require Core::view('menu', 'core');
?>


  <section class="section-default center">
    <br>
    <h5>¡Bienvenido a <?= $config['script_name'] ?></h5>
    <p>Para disfrutar de todas las funcionalidades, te invitamos a que renueves tu cuenta.</p>
    <a href="https://api.whatsapp.com/send?phone=<?= $config['num_phone'] ?>&text=Hola,%20necesito%20renovar%20mi%20cuenta" class="btn btn-large green" target="_blank">Renovar cuenta por WhatsApp</a>
  </section>


  <!-- FOOTER -->
<?php require Core::view('footer', 'core');
}
?>