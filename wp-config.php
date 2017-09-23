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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'rafapeartree');

/** MySQL database password */
define('DB_PASSWORD', 'Carolzinha1!');

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
 define('AUTH_KEY',         '?P`jYvX16Y--U-L/b%I-ey=; t_gYNh%aSp>m-A)&`*t:W80_d5:pVlL+NnwHL+3');
 define('SECURE_AUTH_KEY',  'ymb=aB-$qxcBdV>SE16P-Rg<b.0;s>uhrW8~B0dOy3;ZZN,|Z~T-k,fwB5]B`.:v');
 define('LOGGED_IN_KEY',    'a&5RcW[V8Aj8~~<IxB)RN`L%oy&=.6w%uCfN^x*OQ~3)WdU6n&)|l6{6ZLj%g-3-');
 define('NONCE_KEY',        '|{h-*+.io[Qt:5N^L&6?w28z&|OTb|b?zZ.[[;HCv2AJG4IU+1`p$+D=z<WZF> X');
 define('AUTH_SALT',        '>r^n6JLer|gswz $)&a#58>NR;k7`x|F05Jg9<|6G+i<U5V^h^kp D+/Uw+v>3#+');
 define('SECURE_AUTH_SALT', 'ZK:|G6:i5-{(J2_(Z@l[oO+fd %=WJX~sShN-`:eQ2PT+1(#~k,Ai&5)-nwfwy!L');
 define('LOGGED_IN_SALT',   'BXfZaw&o]g]wY[LMfglb3U!rPSM&;:#f(4sHc^>=30G-q+5$~Ni$dc3EI=F/|CKA');
 define('NONCE_SALT',       'q/mJt&}~||m#il-R8,9NX3|SQjj;~OeCR=Z/zE 0*q3KE-6p|uT-^4dkau.E7|w.');

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
