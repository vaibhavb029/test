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
define( 'DB_NAME', 'deskera' );

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
define( 'AUTH_KEY',         'oM+i?Uyj= CeaTOs~2?>1Dk`OH4$l*VIch^{9BoE|wC|q82Go~{%zhIw[aP.tg,x' );
define( 'SECURE_AUTH_KEY',  'Y9%X}B,UPOS_{d<*,4G4s47LKjrQKlZL]5O2u.w?Wx7q*%L4&`-ojol =c4v)IaQ' );
define( 'LOGGED_IN_KEY',    'P~C;AaxQQ}6:t>zA#^@d!]z*y)|S!ZC44L %_ak_@nJFdXV`SMK&5MN,Ju;JJKfa' );
define( 'NONCE_KEY',        '~Df@raB8)h.8AmO0*?#Yg^ffp3lk;A7|ibSd*R ,hK<q;Y{M +0H|Nx,:l5: 9#s' );
define( 'AUTH_SALT',        'i~/KkCAG~5vGj1X&fJyj|~LSc^)q~PDMI)|4u6S{`{{K)tPmsl:U-usq2%VLoXo=' );
define( 'SECURE_AUTH_SALT', '%)t_>~KhBp-,%Gtav9-w&n3(r|AdBw9SV7I:RE+Y:D!t;cg_ ln>w-%TJ9+J>?y^' );
define( 'LOGGED_IN_SALT',   'y8$m_ |_&gQ4uNXMr<2CF3xtO]h;NJKiH@{*OXK)2j<WQ/{Imw725zxb;ZqFQ_Jw' );
define( 'NONCE_SALT',       '$qIIAo>-3C0AOV$k~,r xtK%5m+m8J;Kj=H>LsnUF%z4Rm)R2SS]Gu38cO+S_D.0' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
