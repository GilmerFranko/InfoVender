<?php defined('VCO') || exit;

/**
 *=======================================================
 *  VCO Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Configuración del sitio
 *
 *
 */

// La dirección principal del sitio, sin slash final.
$config['base_url']     = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . substr($_SERVER['PHP_SELF'], 0, -10);

// Dirección del sitio mediante carpetas, sin slash final.
$config['base_path']    = BG_DIR;

// Carpeta donde se alojan las imágenes del script
$config['images_url']   = $config['base_url'] . '/static/images';

// Dirección de avatares mediante url, sin el slash final.
$config['avatar_url']   = $config['base_url'] . '/filestore/uploads/avatar';

// Dirección del sitio mediante carpetas, sin el slash final.
$config['avatar_path']  = $config['base_path'] . 'filestore' . DS . 'uploads' . DS . 'avatar';

// Carpeta donde se alojan los archivos con correos
$config['bulkemails_path']   = $config['base_path'] . 'filestore' . DS . 'uploads' . DS . 'bulkemails';

// imagenes de los cursos
$config['courses_path']  = $config['base_path'] . 'filestore' . DS . 'uploads' . DS . 'courses';
$config['courses_url']   = $config['base_url'] . '/filestore/uploads/courses';

// Imagenes de las fases
$config['phases_path']  = $config['base_path'] . 'filestore' . DS . 'uploads' . DS . 'phases';
$config['phases_url']   = $config['base_url'] . '/filestore/uploads/phases';

// Foto predefinida para usuarios registrados
$config['default_male_profile_photo']   = 'default-male-avatar-profile.png';
$config['default_female_profile_photo'] = 'default-female-avatar-profile.png';
