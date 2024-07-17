<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'Wordpresstest' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'h2OL]ht!J o`xlHw?Y|P^vA5>-rWzVnvuZ_VVABz9-$Rq@IvQz?!}HVD20):@]?M' );
define( 'SECURE_AUTH_KEY',  'ms< yT+IH.B,gvsl9W3HkSc,4/k=^7J(2a76D>qtQQ5cLjy|Fy@<0He-t,5BhnLR' );
define( 'LOGGED_IN_KEY',    '`kF-5b!n]$rg1w4^{hv?x2erIX=~X_J sTA.)u`:[2|!+F|>qOn4Yk?mem1`(IJ ' );
define( 'NONCE_KEY',        '>nlf1Xm~MZ54Hn?p/d6JE%xD7N!SYI##,SnQ]_fj&p.jkb%GP,0Rm&C%D>46kQe2' );
define( 'AUTH_SALT',        '6?>lfOi~[(]M^JRu[o<.dn-~[]e//c`(y>6=3WVK5AJHinI]w>%0C-E{l,USSEMq' );
define( 'SECURE_AUTH_SALT', 'firt(N*?Ti>rbMdQ<$ZwJc*!y@%@{!!Ykgz#F7}YwZ.%c#P>RoMV$WU]/T~GH!n8' );
define( 'LOGGED_IN_SALT',   '][f/.ofl$:j}]5fZ%1?/qoj0D${p#&v>wh`{ckN_}VDZPqS9Ad^[X^U5&}0ph!Wi' );
define( 'NONCE_SALT',       ' lL|/~-&UkS,(8fr#YW~;3gw6Ql/cv/Y!(hLUN)!rQ /YVe6eG8r0IEal1M| ZWq' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
