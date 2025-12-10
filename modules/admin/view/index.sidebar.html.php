<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Vista del sidebar de la administración
 *
 *
 */

?>
<style>
  .new-alert .material-icons {
    animation: growShrinkRotate 3s infinite;
    color: white !important;
  }

  .new-alert {
    color: white !important;
  }

  @keyframes growShrinkRotate {
    0% {
      transform: scale(1) rotate(0deg);
    }

    50% {
      transform: scale(1.2) rotate(180deg);
    }

    100% {
      transform: scale(1) rotate(360deg);
    }
  }
</style>
<li class="grey darken-4">
  <ul class="collapsible collapsible-accordion">
    <li <?php if ($sModule == 'admin')
        {
          echo ' class="active"';
        } ?>>
      <a class="collapsible-header white-text waves-effect waves-blue "><i class="material-icons white-text">settings_applications</i>Admin <i class="material-icons right white-text" style="margin-right:0;">arrow_drop_down</i></a>
      <div class="collapsible-body z-depth-1">
        <ul>
          <li><a href="#" class="waves-effect waves-blue grey-text">Sistema</a></li>
          <li <?php if ($sSection == 'configuration')
              {
                echo ' class="active"';
              } ?>>
            <a class="waves-effect waves-blue" href="<?php echo $extra->generateUrl('admin', 'configuration'); ?>">
              <i class="material-icons">settings</i>
              Configuraci&oacute;n
            </a>
          </li>
          <li <?php if ($sSection == 'members')
              {
                echo ' class="active"';
              } ?>>
            <a class="waves-effect waves-blue" href="<?php echo $extra->generateUrl('admin', 'members'); ?>">
              <i class="material-icons">group</i>
              Usuarios
            </a>
          </li>
          <li <?php if ($sSection == 'groups')
              {
                echo ' class="active"';
              } ?>>
            <a class="waves-effect waves-blue" href="<?php echo $extra->generateUrl('admin', 'groups'); ?>">
              <i class="material-icons">stars</i>
              Grupos
            </a>
          </li>
          <li <?php if ($sSection == 'contacts')
              {
                echo ' class="active"';
              } ?>>
            <a class="waves-effect waves-blue" href="<?php echo $extra->generateUrl('admin', 'contacts'); ?>">
              <i class="material-icons">contact_mail</i>
              Contactos
            </a>
          </li>

          <li><a href="#" class="waves-effect waves-blue grey-text">Cursos</a></li>

          <li <?php if ($sSection == 'courses')
              {
                echo ' class="active"';
              } ?>>
            <a class="waves-effect waves-blue" href="<?php echo $extra->generateUrl('admin', 'courses'); ?>">
              <i class="material-icons">receipt</i>
              Cursos
            </a>
          </li>


          <li <?php if ($sSection == 'phases')
              {
                echo ' class="active"';
              } ?>>
            <a class="waves-effect waves-blue" href="<?php echo $extra->generateUrl('admin', 'phases'); ?>">
              <i class="material-icons">chrome_reader_mode
              </i>
              Fases
            </a>
          </li>

          <li <?php if ($sSection == 'top20')
              {
                echo ' class="active"';
              } ?>>
            <a class="waves-effect waves-blue" href="<?php echo $extra->generateUrl('admin', 'top20'); ?>">
              <i class="material-icons">whatshot
              </i>
              Top 20
            </a>
          </li>

          <li <?php if ($sSection == 'products')
              {
                echo ' class="active"';
              } ?>>
            <a class="waves-effect waves-blue" href="<?php echo $extra->generateUrl('admin', 'products'); ?>">
              <i class="material-icons">local_offer
              </i>
              Productos
            </a>
          </li>

        </ul>
      </div>
    </li>
  </ul>
</li>