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
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'numero' );

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
define( 'AUTH_KEY',         'pKdtfl,fWJ@j66.!/3hC2E>%wyFR(vlGk6~H=b2*GM5b{p_jp!jYvM=E97N!Q+bY' );
define( 'SECURE_AUTH_KEY',  ']j_uQEw4iQ3lz~{oXD2OW}DIvt(-tKxMR$V]:{%|Iec@&<$eLmyu/vs:,9@|q?0T' );
define( 'LOGGED_IN_KEY',    'lN9R*k6nrURH3s^d iMtSkw.R.YtHp3_7k4*h}9/_+v(nkeA<pN$JG2KQY&y2[8 ' );
define( 'NONCE_KEY',        'R)tZWQYhl-(CcU?3zmt: 56`C<tkDs<5Z:V`RY&pIBw_Pg0VCAP<aM7H.<KnfRlZ' );
define( 'AUTH_SALT',        'DmjKM#%2?rN:Sw,Z%J5m6vi7V}=CaJ6Z[]Jaa@Qb&CEQ.i.3e~8KR- {q?hVM8T3' );
define( 'SECURE_AUTH_SALT', '^:eI&9l-9k:tdUo32&:VOv!j )n2V%)^EFDbT5.NB|n`Fx+*l0S)ZD[5|tyzti_*' );
define( 'LOGGED_IN_SALT',   'k-u:#P-|((JD6.D2ri56b<Pbzd~oQ}E 4o,H*&Ww#O=[HM)@[w|xJ2<Fn|C#xw*d' );
define( 'NONCE_SALT',       'IiFK$^<oE|*u.4PHO.!p|I=Vmf%m^71MbdB5d?ZV6+t8>l#ddn6]OEa_FnJ88=)r' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'ucM_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
