<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'university_test' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         '~=le;-K4Sv*waP&F%h:=$aq_AW!GbT@N{~fjUp>{Ptp2L}kG*P`Rtd9&vyQCE42F' );
define( 'SECURE_AUTH_KEY',  '?6#>(f0x?/fi^O2sWACJI!yqy:=Lyy:jwyL `|JP[2^> -^JAc7m-`_Vi9?+lAl;' );
define( 'LOGGED_IN_KEY',    'Z+:U1p{S2.LEODlzQTa1H@QBR;FO@8ntfMip*,]XZo75-u,cM5V_{Tqdr@2D~C}P' );
define( 'NONCE_KEY',        'L17RNWti[z-MD3B}f59*bMxhUKD!`bqEm2X3.#blcYoG1<JainE|.hRPLZo@sEX|' );
define( 'AUTH_SALT',        'Ka R)gL7{kp<(1Y8Q/I=3>vKh7mS?IG_$:0HB;>DTl<QRJR%_jvRZ$QwL(T4dBh$' );
define( 'SECURE_AUTH_SALT', ')GY%0L?p,<=3L~pQi_L%C=MI:Q4x_/H-6tl.6j7zq4adw2iU)w{B3F`LPZk6j;oB' );
define( 'LOGGED_IN_SALT',   '>Z630G<UbSOR+rrLS~(Rdy*3Ls*%.^JA`G/{et`H-OF]|&T!J#irs4- #]#~d#.2' );
define( 'NONCE_SALT',       'Lmf%XPs^qzr,<?CDIfSZ)%lBeDsN3!/w-g|^k+Xbr-{lj?4yPMg$<+C#4fxHY6gG' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
