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
define( 'DB_NAME', 'tupaca-test' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '(8&)D`GOo3N*7.+o7F!6s{k$VKJPI@(FTF/jcZNmkyE7)I[%fJC!wWp2qL%Rc)D5' );
define( 'SECURE_AUTH_KEY',  'oXvx4ZxzFgT+?/T}?qjs ]~:dGL%oOxtau3xr4ST(5XhGo:@-pj?>CIm8(N1.i/*' );
define( 'LOGGED_IN_KEY',    '9a{9^?A+kwB]{T[ikAjW6U_%pFf6=CI,#y=gRzJ$bcO)!e`2hnR&_|K7Z^G*^^?K' );
define( 'NONCE_KEY',        ']Nzp IoZr<,h;YuopCzQ4-g@th4n1bddY-D[D#hLQe?QLy:@kTGJ];n^vSQI =bZ' );
define( 'AUTH_SALT',        '5_SBOHz}Yohvfg:wUdD{4vgTJR|!jU7dGj@<oY-c6JyA}zMJ831M@JkNd`uW%Kb!' );
define( 'SECURE_AUTH_SALT', 'G|/*Hu/}<[:iYFk}Y}GJ_2|@>p[;DP)1o3~jg{8?J,t)ccFrqO,:swtm K4&7EDm' );
define( 'LOGGED_IN_SALT',   'v[6gDGJ#HCOK3N<,W`l:Fu`3@IMR1zc|0XFRZy?[?+7}$9Z85C1,<vthd5@=b&)?' );
define( 'NONCE_SALT',       'YdggKv-0JPt:YphQ$_-!&aXmE8EVZZ^qO0lFNOn,`R<Af/^%%&I !]djG1$t1]1r' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'tupaca_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
