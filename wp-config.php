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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'matmarket_place' );

/** MySQL database username */
define( 'DB_USER', 'dbuser' );

/** MySQL database password */
define( 'DB_PASSWORD', 'OSGgoyZtmQh0rFzO' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
define('FS_METHOD', 'direct');

define( 'SMTP_USER',   'charanjeetvisionvivante@gmail.com' );   
define( 'SMTP_PASS',   'yiroigadeqvhcjqv' );   
define( 'SMTP_HOST',   'smtp.gmail.com' );    
define( 'SMTP_FROM',   'charanjeetvisionvivante@gmail.com' ); 
define( 'SMTP_NAME',   'ibid' );    
define( 'SMTP_PORT',   '587' );                  
define( 'SMTP_SECURE', 'tls' );                
define( 'SMTP_AUTH',    true );                
define( 'SMTP_DEBUG',   0 ); 
define('DISABLE_WP_CRON', 'true');
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
define( 'AUTH_KEY',         'vz#%A0(>jLtyh]:n3,9Pc5n/:TWhK&lKHNkQ4xOHsKq]fCNmOUCWl6**H]K}.1Il' );
define( 'SECURE_AUTH_KEY',  't#w^Kw2&3SkE=W<M>PzT.)&3>gi*Z8SZf=qy@55TA&V)uKfBvV)@<PO8{JU1+:p<' );
define( 'LOGGED_IN_KEY',    'mJYR+Gi1DrU~K9CjtN>QO1QBddQ,`j#g`0Uc:>^I!kg/dn7^[i[]JKd2nU)<WNs<' );
define( 'NONCE_KEY',        'D/9&{FP0Yo&6&>4D58m(!l[]6-yn6r_6cj@w(Zc=fnM_-f0NYVS`)Q/KW4,dH4Q!' );
define( 'AUTH_SALT',        'ZjXV@N&]GHZ}K/9moPmH31!4hSe15STlsJ4:&1_z/W12A/}J[LB!iNQP$5c9Wi_z' );
define( 'SECURE_AUTH_SALT', 'lMI5oG?X(M[EvS!c@IQhxuw=^l->u;??8vB[I3.xAN~ bE,B !$h2df;gJV]wpp|' );
define( 'LOGGED_IN_SALT',   'R)@AXHL64JBI^:CNc5z+$K&0ioi:Rk$nr7W8RT,zYp}t=:u9IYC)q*(M4t ]**>^' );
define( 'NONCE_SALT',       '4s4p@)*545bp[b/M/<(}s,}nzE$(x:5DrzVo@W%xr!o:*h3dccaJT^5?0z/A>*a3' );

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
