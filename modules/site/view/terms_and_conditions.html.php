<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 * @Description Vista de contacto
 *
 *
 */

require Core::view('head', 'core');
?>

<!-- Header -->
<?php require Core::view('menu', 'core'); ?>
<!-- / Header -->

<!-- Body -->
<section id="termsAndConditions" class="container">
    <h3 class="center-align">Términos y Condiciones de Uso</h3>

    <div class="row">
        <div class="col s12">
            <p>Estos términos y condiciones rigen el uso del sitio web <strong style="font-weight:900;"><?php echo $config['script_name'] ?></strong>. Por favor, lee estos términos y condiciones con detenimiento antes de utilizar este sitio web.</p>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <h5>1. Uso del Sitio Web</h5>
            <p>El uso del sitio web se rige por las siguientes condiciones:</p>

            <ul>
                <li>El sitio web solo se puede utilizar para fines personales y no comerciales.</li>
                <li>No se permite la reproducción, distribución o modificación del contenido del sitio web sin el consentimiento previo por escrito de <strong style="font-weight:900;"><?php echo $config['script_name'] ?></strong>.</li>
                <li>No se permite el uso del sitio web para fines ilícitos o inmorales.</li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <h5>2. Responsabilidad</h5>
            <p><strong style="font-weight:900;"><?php echo $config['script_name'] ?></strong> no se hace responsable por:</p>

            <ul>
                <li>Daños directos o indirectos causados por el uso del sitio web.</li>
                <li>La precisión, integridad o actualidad de la información proporcionada en este sitio web.</li>
                <li>El contenido de los sitios web de terceros enlazados desde este sitio web.</li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <h5>3. Modificaciones</h5>
            <p>Nos reservamos el derecho de modificar estos términos y condiciones en cualquier momento sin previo aviso. La versión más reciente de estos términos y condiciones se publicará en este sitio web y entrará en vigor inmediatamente después de su publicación.</p>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <p>Si tienes alguna pregunta sobre estos términos y condiciones, contáctanos .</p>
        </div>
    </div>
</section>


<!-- Footer -->
<?php require Core::view('footer', 'core'); ?>
<!-- / Footer -->