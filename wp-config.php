<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'fsportal_fsportal');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'password');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '&1Kvbxv@5*l$5I*^HNRZIrN;C&(nHqGdG13)$[ 5!FcACU-r@vox1x$4.*jgGL=+');
define('SECURE_AUTH_KEY',  ' 1]jl{po^2K-7V),gc6h~FHu|2o7Ts2L7:wPVQ[gPPrWi@scl-+XQg%y(Ls)E+AW');
define('LOGGED_IN_KEY',    'gA_!GvXxRr!E{D+2$Zc50 N{|6io<RYI@MOap|Mp^l0hr~K[<KJAJQ]0x+aV&[f ');
define('NONCE_KEY',        'bE*!G3IyUN<8kkdan?xt]R~.oMVBF7llk;y)RV9:o-C9YCVRI13lpO:2+kg/l|Qk');
define('AUTH_SALT',        '4.9lA_,TaEWH6dDLg/jB - %~NidfzrK,G/*z]m[L}rX@b0,CVvUDZ:CDl>WkUq[');
define('SECURE_AUTH_SALT', '9Wlvk.dN*%(ckTyI;.ivP)X)4U5[w,OfW] pcE=U_^hwXj!)>}VaB!:kh6[3(Vk^');
define('LOGGED_IN_SALT',   'rzXdpP,fEP_dqZiC1U|*y5B?>Y!d!)Xx-9G5j|Fls+_]24g%+&)RI}[lh*tO/z==');
define('NONCE_SALT',       '[E2Q^U`&O^MZCSJ]A1Lr>@n6Wi5Q4b8~0Nh[8vX;eb0q^5]d]jp3&liQb..O.|.#');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
