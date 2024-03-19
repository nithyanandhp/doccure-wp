<?php
# Database Configuration
define( 'DB_NAME', 'wp_dreamstechno1' );
define( 'DB_USER', 'dreamstechno1' );
define( 'DB_PASSWORD', 'gr6zV1UvkGzZT92a5gPe' );
define( 'DB_HOST', '127.0.0.1:3306' );
define( 'DB_HOST_SLAVE', '127.0.0.1:3306' );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = 'wp_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         '%PjZG+s{|5;XzJ4NrSnl+K{5Q=;XZ-C-6j)>$k8-Y q%V)C)|1,T6E1fGr/pBqQ<');
define('SECURE_AUTH_KEY',  'JW52m5;xYT^l;x&IaQn8U@Ta.ww>-S-G);@^!-+BPTbYN_Sq&P>ywSjZlmLd[-p}');
define('LOGGED_IN_KEY',    ']lc{mrXwd6vg@A- /c2PcMqDB4^s=+35p3#o_/#?QJQ8:z@Uy6g_hwQ+,[>Ep{W@');
define('NONCE_KEY',        '%scz&4n5CYjOWkp-SRI_`7LM+[T-z}oX6*^_GPcJ)oiL%B&;-G$K!x*v*%[FLW)n');
define('AUTH_SALT',        '5PM#qbtK(#I4(Ssh?%ZQCoVF]g7l$}r:N4$_gQ+H@=s&P61KAz.6]DrQ9R1J,.UK');
define('SECURE_AUTH_SALT', '9LM:cc@-*w+CHVRo#V;TkY|>+(9[.-]&VzKq]p*Q}<%_c}:gX|b+q+KtQ=>r+y q');
define('LOGGED_IN_SALT',   'xu9sA+D%YfW4,TS{w513L&b?UC]f@ufai@hYz+ZedIT:gzFyErol,%^+:Ge35;s]');
define('NONCE_SALT',       '}Dm2||.5A}N[x>[I|F$S,S{5qzb1~t`T6I-wVc48a?xB#^Mt;;C-q=WBa:Ylh)q.');


# Localized Language Stuff

define( 'WP_CACHE', TRUE );

define( 'WP_AUTO_UPDATE_CORE', false );

define( 'PWP_NAME', 'dreamstechno1' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

define( 'WPE_APIKEY', 'dba6ec3bb80e6b39ee87364ca969601edbcb8bdf' );

define( 'WPE_CLUSTER_ID', '101271' );

define( 'WPE_CLUSTER_TYPE', 'pod' );

define( 'WPE_ISP', true );

define( 'WPE_BPOD', false );

define( 'WPE_RO_FILESYSTEM', false );

define( 'WPE_LARGEFS_BUCKET', 'largefs.wpengine' );

define( 'WPE_SFTP_PORT', 2222 );

define( 'WPE_SFTP_ENDPOINT', '' );

define( 'WPE_LBMASTER_IP', '' );

define( 'WPE_CDN_DISABLE_ALLOWED', true );

define( 'DISALLOW_FILE_MODS', FALSE );

define( 'DISALLOW_FILE_EDIT', FALSE );

define( 'DISABLE_WP_CRON', false );

define( 'WPE_FORCE_SSL_LOGIN', false );

define( 'FORCE_SSL_LOGIN', false );

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define( 'WPE_EXTERNAL_URL', false );

define( 'WP_POST_REVISIONS', FALSE );

define( 'WPE_WHITELABEL', 'wpengine' );

define( 'WP_TURN_OFF_ADMIN_BAR', false );

define( 'WPE_BETA_TESTER', false );

umask(0002);

$wpe_cdn_uris=array ( );

$wpe_no_cdn_uris=array ( );

$wpe_content_regexs=array ( );

$wpe_all_domains=array ( 0 => 'dreamstechno1.wpengine.com', 1 => 'dreamstechno1.wpenginepowered.com', );

$wpe_varnish_servers=array ( 0 => 'pod-101271', );

$wpe_special_ips=array ( 0 => '35.197.192.76', );

$wpe_netdna_domains=array ( );

$wpe_netdna_domains_secure=array ( );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( 'default' =>  array ( 0 => 'unix:///tmp/memcached.sock', ), );
define('WPLANG','');

# WP Engine ID


# WP Engine Settings






# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', __DIR__ . '/');
require_once(ABSPATH . 'wp-settings.php');
