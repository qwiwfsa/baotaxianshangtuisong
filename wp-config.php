<?php
/**
 * WordPress 基础配置
 *
 * 本文件由配置工具生成，支持本地开发环境与阿里云服务器自动切换。
 *
 * @package WordPress
 */

// =============================================================================
// 数据库配置 - 双环境自动切换
// 通过检测服务器地址或主机名，自动选择对应的数据库配置
// =============================================================================
if ( $_SERVER['SERVER_ADDR'] == '::1' || $_SERVER['SERVER_ADDR'] == '127.0.0.1' || $_SERVER['HTTP_HOST'] == 'localhost' ) {
	// ===== 本地环境（XAMPP） =====
	define( 'DB_NAME',     'hongdu' );
	define( 'DB_USER',     'root' );
	define( 'DB_PASSWORD', '' );
	define( 'DB_HOST',     'localhost' );
} else {
	// ===== 阿里云服务器（宝塔面板） =====
	define( 'DB_NAME',     'hongdu' );
	define( 'DB_USER',     'hongdu' );
	define( 'DB_PASSWORD', 'fdsajkl' );
	define( 'DB_HOST',     'localhost' );
}

/** 数据库字符集 */
define( 'DB_CHARSET', 'utf8mb4' );

/** 数据库排序规则 */
define( 'DB_COLLATE', '' );

// =============================================================================
// 认证密钥与盐值（保持不变，来自原有配置）
// 用于加密 Cookie 和密码，请勿泄露
// =============================================================================
define( 'AUTH_KEY',         'jR}!_*}|BnKPW[/rw2?SaIW@H.=[l^ -9Q..SPw?h/vNPp~WUd[|ZimAt=V,M)Yu' );
define( 'SECURE_AUTH_KEY',  '-0#u[k{k@%Z:db;,e}]*8rm8pECLpD]<10*V8uPz{Ma=v;< jk35SNOGp]~F2q>.' );
define( 'LOGGED_IN_KEY',    'J*cYbIHp49Tn@Y{+)p]^k}tIPVkRZvaX26(-t77oPV%@k:#pd1d^|i{v,_/foH~Y' );
define( 'NONCE_KEY',        '}H|FoPpqDl##?@jkvA_W QdaSV4`lvJW@+@2,6%+5f!RP}3FeN%J@;BTQ-q_Pf!2' );
define( 'AUTH_SALT',        '.MtSWP]q62%iZgX&#f,o+_|Ez%`Ou<D-!sn3ua t`bmdT/]?]I`E]Mch.6%&Q7iR' );
define( 'SECURE_AUTH_SALT', 'Bt&R]b=;p:;.Ww9{i:1?+hqf.C}jG^*D$qceDR+XpoK>tg*l[-p3s=B>GPyd9u?(' );
define( 'LOGGED_IN_SALT',   'IpZ;C1no8wq>=#viEg7pX,:O<[Rw|wTNM~Dn`>Neg,S<UsiB0y8`HA_]TO7Maj_J' );
define( 'NONCE_SALT',       '4P,}@4De J-CcNMMBS~]RP9IWs;poP1Tx927|!ST)Xi[u2~UeU4B.5gy8c=l-Nl`' );

// =============================================================================
// 数据表前缀
// =============================================================================
$table_prefix = 'wp_';

// =============================================================================
// 调试模式
// =============================================================================
define( 'WP_DEBUG', false );

/* 如需添加自定义配置，请在此处添加 */

/* 停止编辑，开始发布！ */

/** WordPress 目录绝对路径 */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** 加载 WordPress 核心 */
require_once ABSPATH . 'wp-settings.php';
