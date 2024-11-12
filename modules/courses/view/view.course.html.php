<?php defined('VCO') || exit;
/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @Description Vista de la página de cursos
 */
// HEADER
require Core::view('head', 'core');
?>

<!-- Header -->
<?php require Core::view('menu', 'core'); ?>
<!-- / Header -->

<section style="padding: 2rem; color: #fff; background-color: #000;">
  <p class="antiqua center" style="font-size: 60pt; margin:0;">Facebook Ads Real Estate</p>

  <div style="display: flex;justify-content: center;align-items: flex-start;">
    <!-- Imagen del curso -->
    <div style="">
      <img class="course_img" src="<?= $config['courses_url'] . '/' . $course['image'] ?>" alt="Curso Facebook Ads Real Estate">
    </div>
    <!-- Descripción del curso -->
    <div class="item_course_info">
      <p>Formato: <span class="text-cian">Video y PDF</span></p>
      <p>Segmentación: <span class="text-cian">Inmobiliarias y +Advitange</p>
      <p>Inversión diaria sugerida: <span class="text-cian">$12 USD</span></p>
      <hr style="border: 1px solid #fff; margin-top: 40px">
      <h2 style="font-size: 1.5rem; font-weight: bold; text-align: left;">Descripción recomendada:</h2>
      <p class="recomendation-description">
        DEJA DE PERDER DINERO segmentando mal!<br>
        SI USAS ESTAS PALABRAS ESTÁS SEGMENTANDO MAL<br>
        Bienes raíces, inversiones inmobiliarias, casas, departamentos, créditos hipotecarios...<br>
        Aprende por fin a segmentar tus Campañas Publicitarias de forma correcta para que te lleguen los CLIENTES bien calificados.<br><br>
        ¿QUÉ INCLUYE?
        Curso Grupal EXCLUSIVO Agentes Bienes Raíces<br>
        Escuela virtual con el curso de Facebook Ads + actualizaciones de algoritmos de Facebook<br>
        Grupo de WhatsApp para seguimiento post curso
      </p>
    </div>
  </div>

  <br>
  <?php require Core::view('courses.options', 'courses'); ?>
</section>

<style>
  .item_course_info {
    margin-left: 2rem;
    font-size: 24px;
    text-align: left;
    max-width: 500px;
    font-family: Arial;
    font-weight: 800;

    .text-cian {
      color: #5CE1E6 !important;
    }

    p {
      margin: 0 !important;
    }
  }

  .course_img {
    width: 400px;
  }

  .recomendation-description {
    text-align: left;
    font-size: 1rem;
    line-height: 1.5;
    background: white;
    color: black;
    font-weight: 100;
    font-size: 12px;
    padding: 5px;
  }
</style>


<?php require Core::view('footer', 'core'); ?>