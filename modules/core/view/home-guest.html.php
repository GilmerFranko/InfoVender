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
// HEADER
require Core::view('head', 'core');
// MENU
require Core::view('menu-guest', 'core');
?>

<style type="text/css">
	section {
		min-height: inherit !important;
		margin: 0px !important;
		padding: 20px;
	}

	section {
		color: var(--grey-200) !important;
	}

	.carousel {
		height: 310px !important;
	}

	body section blockquote {
		font-weight: 900;
		font-style: normal;
		text-decoration: none;
		text-align: center;
		padding-left: 50px;
		padding-right: 50px;
		font-size: 30px
	}

	@media only screen and (max-width : 768px) {
		.descriptive-notice {
			font-size: 16px;
		}
	}

	.descriptive-notice {
		color: white;
	}

	@media only screen and (max-width : 768px) {
		.heading-base-heading {
			font-size: 32px;
		}
	}

	.heading-base-heading {
		color: var(--orange);
		text-align: center;
		font-weight: 900;
		color: var(--orange);
		/*text-align: center;*/
	}

	#miembros,
	#partidas {
		width: 120px;
		display: inline-block;
	}
</style>
<section class="content component usn_cmp_splitcomponent custom-bg" id="main" style="margin: 40px 0px !important;">
	<div class="container">
		<div class="row">
			<!-- Imagen -->
			<div class="col s12 m6 present-home-guest">
				<div class="image">
					<img src="<?php echo $config['images_url'] . '/present-home-guest.png' ?>" alt="Ganar dinero jugando Video Juegos" class="responsive-img">
				</div>
			</div>
			<!-- Texto -->
			<div class="col s12 m6">
				<div class="info text-center" bis_skin_checked="1" style="font-weight: 900; ">
					<h1 class="heading-base-heading">Gana dinero jugando video juegos</h1>
					<p class="secondary-heading base-secondary-heading" style="color: white;text-align: center;letter-spacing: 3px;">1VS1 ONLINE</p>
					<div class="text base-text" style="font-weight: 400;" bis_skin_checked="1">
						<p>Te ayudamos a ganar dinero simplemente jugando a tus Video Juegos favoritos</p>
					</div>
					<div class="center-align">
						<a href="<?php echo $extra->generateUrl('members', 'login'); ?>">
							<button class="btn btn-primary btn-lc align-btn-on-menu">Iniciar sesión</button>
						</a>
						<a href="<?php echo $extra->generateUrl('members', 'register'); ?>">
							<button class="btn btn-blue btn-lc align-btn-on-menu">Registrarse</button>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<br>
<section>
	<blockquote class="descriptive-notice">
		Nuestra plataforma ofrece asistencia 24/7 x 365, nuestros
		<strong>referis se encargarán de que todos tus juegos sean 100% legales sin ningún tipo de inconvenientes</strong>
	</blockquote>
</section>

<br>
<section class="content component usn_cmp_pods custom-bg" id="games">
	<div class="container">
		<!-- Introduction -->
		<div class="component-introduction row justify-content-center text-center" bis_skin_checked="1" style="
			display: flex;
			justify-content: center;
			">
			<div class="col" bis_skin_checked="1">
				<h2 class="heading c1-heading heading-base-heading " style="">Juegos disponibles</h2>
				<div class="text c2-text" bis_skin_checked="1">
					<p>Descubre torneos con premios en metálico de los videojuegos más populares</p>
				</div>
			</div>
		</div>
		<!--// Introduction -->

		<!-- Carousel -->
		<?php if ($games) : ?>
			<div class="component-main row">
				<div class="carousel">
					<?php foreach ($games as $game) : ?>
						<a class="carousel-item" href="#one!"><img src="<?php echo $config['games_url'] . '/' . $game['image_url'] ?>" style="height: 250px;" alt=""></a>
					<?php endforeach ?>
				</div>
			</div>
		<?php endif ?>
		<!--// Carousel -->
		<br>
		<br>
		<div class="row" style="text-align: center; font-size: 24px; font-weight: 100; letter-spacing: 1px;">
			<div class="col s12 m6">
				<strong class="text-primary" id="miembros">+100,000</strong> <span class="text-white">Miembros</span>
			</div>
			<div class="col s12 m6">
				<strong class="text-primary" id="partidas">+15,000</strong> <span class="text-white">Partidas diarias</span>
			</div>
		</div>
		<div class="component-main row">
			<div class="carousel" style="height: 150px !important;">
				<img src="<?php echo $config['images_url'] . '/logo2/playstation5.png' ?>" class="carousel-item" alt="" style="width: 64px; height: auto;">
				<img src="<?php echo $config['images_url'] . '/logo2/xbox.png' ?>" class="carousel-item" alt="" style="width: 64px; height: auto;">
				<img src="<?php echo $config['images_url'] . '/logo2/ios.png' ?>" class="carousel-item" alt="" style="width: 64px; height: auto;">
				<img src="<?php echo $config['images_url'] . '/logo2/android.png' ?>" class="carousel-item" alt="" style="width: 64px; height: auto;">
			</div>
		</div>



		<!-- Outro -->
		<div class="component-outro row justify-content-center center-align" bis_skin_checked="1" style="display: flex;justify-content: center;
		">
			<div class="col" bis_skin_checked="1">
				<p class="link">
					<a class="waves-effect waves-light btn btn-small btn-primary c2-btn-bg c2-btn-bg-solid c2-btn-bg-hover-solid c2-btn-text c2-btn-borders" href="<?php echo gLink('members/login') ?>">
						<i class="icon usn_ion-md-trophy before"></i>¡JUEGA AHORA!
					</a>
				</p>
			</div>
		</div>
		<!--// Outro -->
	</div>
</section>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		var elems = document.querySelectorAll('.carousel');
		var instances = M.Carousel.init(elems, {
			numVisible: 3,
			indicators: false,
			fullWidth: false,
			padding: 10,
			dist: 2,
			shift: 2,
			duration: 2,
			interval: 2,
			autoplay: true, // **Aquí se agrega la propiedad autoplay**
		});
		$('.carousel').carousel({
			padding: 200
		});

		$('.carousel').carousel({
			padding: 200
		});
		autoplay();

		function autoplay() {
			$('.carousel').carousel('next');
			$('.carousel').carousel('next');
			setTimeout(autoplay, 3000);
		}
	});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		// Función para formatear números con comas
		function numberWithCommas(x) {
			return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		}

		// Función para verificar si un elemento está en el viewport
		function isElementInViewport(el) {
			const rect = el.getBoundingClientRect();
			return (
				rect.top >= 0 &&
				rect.left >= 0 &&
				rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
				rect.right <= (window.innerWidth || document.documentElement.clientWidth)
			);
		}

		// Animación para los miembros
		function animateMiembros() {
			anime({
				targets: '#miembros',
				innerHTML: [100000, 200000],
				easing: 'easeOutExpo',
				round: 1,
				duration: 5000,
				update: function(anim) {
					document.querySelector('#miembros').innerHTML = "+" + numberWithCommas(anim.animations[0].currentValue);
				}
			});
		}

		// Animación para las partidas
		function animatePartidas() {
			anime({
				targets: '#partidas',
				innerHTML: [15000, 20000],
				easing: 'easeOutExpo',
				round: 1,
				duration: 10000,
				update: function(anim) {
					document.querySelector('#partidas').innerHTML = "+" + numberWithCommas(anim.animations[0].currentValue);
				}
			});
		}

		let animatedMiembros = false;
		let animatedPartidas = false;

		// Escuchar el evento de scroll
		window.addEventListener('scroll', function() {
			const miembrosEl = document.getElementById('miembros');
			const partidasEl = document.getElementById('partidas');

			if (isElementInViewport(miembrosEl) && !animatedMiembros) {
				animateMiembros();
				animatedMiembros = true;
			}

			if (isElementInViewport(partidasEl) && !animatedPartidas) {
				animatePartidas();
				animatedPartidas = true;
			}
		});
	});
</script>


<br>

<!-- FOOTER -->
<?php require Core::view('footer', 'core'); ?>