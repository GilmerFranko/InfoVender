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
if ($sModule != 'admin')
{
?>
	<footer class="page-footer darken-2 center" style="margin-bottom: 40px; margin-top:40px; font-size:12px;">
		<div class="footer-copyright">
			<div class="container">
				<img src="<?php echo $config['images_url'] . '/logo.png' ?>" width="216" style="margin: 20px;">
				<div class="row center-align">
					<div class="col s12" style="display: flex;align-items: center;justify-content: center;">
						<div style="margin: 0 20px">
							<?php if (!empty($config['facebook_url'])): ?>
								<a href="<?= $config['facebook_url'] ?>"><img src="<?php echo $config['images_url'] . '/facebook-logo.png' ?>" width="35" alt="facebook-logo"></a>
							<?php endif; ?>
							<?php if (!empty($config['instagram_url'])): ?>
								<a href="<?= $config['instagram_url'] ?>"><img src="<?php echo $config['images_url'] . '/instagram-logo.webp' ?>" width="35" alt="instagram-logo"></a>
							<?php endif; ?>
							<?php if (!empty($config['tiktok_url'])): ?>
								<a href="<?= $config['tiktok_url'] ?>"><img src="<?php echo $config['images_url'] . '/tiktok-logo.png' ?>" width="35" alt="tiktok-logo"></a>
							<?php endif; ?>
							<a href="<?= gLink('contactanos') ?>"><img src="<?php echo $config['images_url'] . '/whatsapp.png' ?>" width="35" alt="whatsapp-logo"></a>
						</div>
					</div>
				</div>
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
						<?php if (!empty($config['facebook_url'])): ?>
							<a href="<?= $config['facebook_url'] ?>">Facebook</a><br>
						<?php endif; ?>
						<?php if (!empty($config['instagram_url'])): ?>
							<a href="<?= $config['instagram_url'] ?>">Instagram</a><br>
						<?php endif; ?>
						<?php if (!empty($config['tiktok_url'])): ?>
							<a href="<?= $config['tiktok_url'] ?>">Tiktok</a><br>
						<?php endif; ?>
						<a href="<?= gLink('contactanos') ?>">Whatsapp</a><br>
					</div>
				</div>
			</div>
		</div>
	</footer>
<?php } ?>
</body>

</html>
<?php

?>