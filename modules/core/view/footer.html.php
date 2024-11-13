<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Archivo que incluye el pie de página
 *
 *
 */

if ($session->is_member == true)
{
	require Core::view('wallet.modal', 'wallet');
}

if ($config['debug_mode'] == 1): ?>
	<span id="performance-data" class="grey-text text-lighten-4 right" style="position: fixed;right: 0;    bottom: 80px; background: rgba(0, 0, 0, 0.5); padding: 5px 5px 0 5px;">
		<?php Core::model('debug', 'core')->show($config['debug_mode']); ?>
		<br>
		<?php if (isset($_SESSION['models_used'])): ?>
			<?php foreach ($_SESSION['models_used'] as $key => $value): ?>
				<?php echo $value ?><br>
			<?php endforeach ?>
		<?php endif ?>
		<?php unset($_SESSION['models_used']); ?>
		<?php debugHTML() ?>
	</span>

<?php endif; ?>

<?php
// No mostrar footer en game.html 
/*if ($sSection != 'game' and $sSection != 'bet.area' and $sSection != 'view_messages')
{
?>
	<footer class="page-footer darken-2 center" style="margin-bottom: 60px;">
		<div class="footer-copyright">
			<div class="container">

				<div class="footer-information row center-align">
					<div class="col s6">
						<h5>Sobre Nosotros</h5>
						<a href="<?php echo gLink('site/pages', array('name' => 'faqs')) ?>">Preguntas Frecuentes</a><br>
						<a href="<?php echo gLink('site/privacy_policy') ?>">Politica de privacidad</a><br>
						<a href="<?php echo gLink('site/terms_and_conditions') ?>">Terminos y Condiciones</a><br>
						<a href="<?php echo gLink('site/contact') ?>">Contácto</a>
					</div>
					<div class="col s6">
						<h5>Comunidad</h5>
						<a href="">Facebook</a><br>
						<a href="">Instagram</a><br>
						<a href="">Twich</a><br>
						<a href="">Discord</a><br>
					</div>
				</div>
			</div>
		</div>
	</footer>
<?php } */ ?>
</body>

</html>
<?php

?>