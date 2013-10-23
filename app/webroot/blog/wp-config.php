<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'db_vimbli_prod');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'vimblismart');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');


define('FS_METHOD', 'direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'F~`-KV]O6H^}5$4wT5<5qZc%;Unf50|{PX:h7Dy[O;c2qXlhT^q*/*I6(2q]: ,m');
define('SECURE_AUTH_KEY',  'c?q:Kzo`@ufc~*NM<>|ot2-gE`W8,|<^-.Vd*E#%2VI}}NX$Rztk>CiZ5-Ts}T$`');
define('LOGGED_IN_KEY',    '1K70Ce*tSRc*Slq*`+7N^UkZQ X|0xVC*/kjt%@{lfli3SS2X8S@0]:ynH@&Fr+r');
define('NONCE_KEY',        'X-_3<n(W{3$H~@NU4&O7-Do^m-AokB.?V5uTVuUAnnMuEG>;L-nHF-E|(7FX,Rx%');
define('AUTH_SALT',        'or&LB`9~}s^]qcMtuYFV4|@VkPmX-ZI_d}vHZ&_8rJ$~EZ6.05y .qO.7#<V)Vd_');
define('SECURE_AUTH_SALT', 'T-@ (d`#$L{+NRvqgrMQiGX*YdDmD<V$1a-5+ImzU?4lJ)HFH_|CFvyA@l]8FD|k');
define('LOGGED_IN_SALT',   '/R*t0fb;..h3U2:7!S4b1f{KLlfVM54@5](Hr[nfl:tu08%!/|n>1|,[MH|(8m]7');
define('NONCE_SALT',       '[A>F-VD=[N^/*=lEx43voM,4^o|p8xkuQe8QK.gbFmX&^9[WOoFz-4I%laJZQ}Mm');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

//define('WP_SITE_URL', bloginfo('url'));
