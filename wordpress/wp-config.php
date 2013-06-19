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
define('DB_NAME', 'wp_diplom');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '1');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '(>HKf+U)vl~XuI$=&HR)4c i2Owy~,cK]*ot*#@!3{;u{)iB=J708d78n<-Xz,L-');
define('SECURE_AUTH_KEY',  '#)(Z5CD]K|c#hIPO@:DKVD$-E-RcHOIi=,)[kPV-^q:~[-Yr++HgD|!:$|Ci+i:K');
define('LOGGED_IN_KEY',    'h`7.!{aHgA522&G[Y8(+bFYMF9+!v2tc} sdXKqv<,-E3IOJ2P_hD(Q<I`hIcD`M');
define('NONCE_KEY',        ']QF|jk&tO%!|aE*h&UBn9^aK198SEki9dSI*|{;}EAVk%X29V{;D`|eY5PH8 Twy');
define('AUTH_SALT',        'o d_auxrx`[$ss-e%yF;n)0X7iAJoutJOol{CYX>US2Gey~Fd<k-}QZ2SX?XSs`L');
define('SECURE_AUTH_SALT', 'RvAvnzWr`]-@|*s|od7,t2jw[rOJS -V|`t3LhQ9%eV2eq{<1x[DO32)F+qu0ZM.');
define('LOGGED_IN_SALT',   '`8OSfN5h.2D+Z~d#>(csSz]iDSqIJxLh^Q>=TNe#yOr,*S}mStj/sE-7-&?<W=Mn');
define('NONCE_SALT',       'pP}f Lj[+5{.Ov[+r%zse?8`1dMQ!+5!>HhdvVfHUy5y*wF|JiZg,_bE+2W#ZQo[');

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
