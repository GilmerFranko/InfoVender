<?php defined('VCO') || exit;
// Redirigir a catalogo
Core::model('extra', 'core')->redirectTo($config['base_url']);
exit;
/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================

 * @Description Controlador principal de la cuenta
 *
 *
 */

$page['name'] = 'Mi cuenta';
$page['code'] = 'memberAccount';
