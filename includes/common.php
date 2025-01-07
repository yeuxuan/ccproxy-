<?php
/*
 * @Author: yihua
 * @Date: 2025-01-04 17:32:11
 * @LastEditTime: 2025-01-05 18:10:04
 * @LastEditors: yihua
 * @Description: 
 * @FilePath: \ccproxy_end\includes\common.php
 * 💊物物而不物于物，念念而不念于念🍁
 * Copyright (c) 2025 by yihua, All Rights Reserved. 
 */
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    if (!(error_reporting() & $errno)) {
        return false;
    }
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

try {
    header("X-Frame-Options: DENY");
    header("X-XSS-Protection: 1; mode=block");
    header("X-Content-Type-Options: nosniff");
    header("Referrer-Policy: strict-origin-when-cross-origin");
    if($_SERVER['SERVER_PORT'] == '443') {
        header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
    }
    // error_reporting(0);
    if (defined('IN_CRONLITE')) {
        return null;
    }
    define('CACHE_FILE', 0);
    define('IN_CRONLITE', true);
    define('VERSION', '2.0.0');//版本号
    define('SYSTEM_ROOT', dirname(__FILE__).'/');//定义域名泛解析用于访问文件
    define('ROOT', dirname(SYSTEM_ROOT).'/');
    define('SYS_KEY', 'yihuaiccp');//定义一个常量
    define('CC_Defender', 1); //防CC攻击开关(1为session模式)
    define('is_defend', true); //防CC攻击开关(1为session模式)
    define('TIMESTAMP',time());
    date_default_timezone_set("PRC");
    $site_url = htmlspecialchars($_SERVER['HTTP_HOST'], ENT_QUOTES, 'UTF-8');
    $date = date('Y-m-d H:i:s');
    ini_set('session.cookie_httponly', 1);
    ini_set('session.cookie_secure', 1);
    ini_set('session.use_strict_mode', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.gc_maxlifetime', 3600);
    session_start();
    // session_regenerate_id(true); // 定期重新生成会话ID
    $islogin=-1;
    $scriptpath = filter_var(
        htmlspecialchars($_SERVER['SCRIPT_NAME'], ENT_QUOTES, 'UTF-8'),
        FILTER_SANITIZE_URL
    );
    $sitepath = substr($scriptpath, 0, strrpos($scriptpath, '/'));
    include_once(SYSTEM_ROOT.'function.php');
    include_once(SYSTEM_ROOT.'cache.php');
    //360安全
    $siteurl = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $sitepath . '/';
    if (is_file(SYSTEM_ROOT . '360safe/360webscan.php')) {
        include_once SYSTEM_ROOT . '360safe/360webscan.php';
        include_once SYSTEM_ROOT . '360safe/xss.php';
    }

    //判断是否开启防CC
    if (is_defend === true || CC_Defender === 3) {
        $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
                  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
        
        if (!$isAjax) {
            include_once(SYSTEM_ROOT.'txprotect.php');
        }
        
        if ((CC_Defender === 1 && !check_spider()) || CC_Defender === 3) {
            cc_defender();
        }
    }

    //判断
    if (!file_exists(ROOT . 'config.php')) {
        header('Content-type:text/html;charset=utf-8');
        //echo '你还没安装！<a href="install/">点此安装</a>';
        echo '<!DOCTYPE html> <html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN"> <head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>站点提示信息</title> <style type="text/css"> html{background:#eee;text-align: center;}body{background:#fff;color:#333;font-family:"微软雅黑","Microsoft YaHei",sans-serif;margin:2em auto;padding:1em 2em;max-width:700px;-webkit-box-shadow:10px 10px 10px rgba(0,0,0,.13);box-shadow:10px 10px 10px rgba(0,0,0,.13);opacity:.8}h1{border-bottom:1px solid #dadada;clear:both;color:#666;font:24px "微软雅黑","Microsoft YaHei",,sans-serif;margin:30px 0 0 0;padding:0;padding-bottom:7px}#error-page{margin-top:50px}h3{text-align:center}#error-page p{font-size:9px;line-height:1.5;margin:25px 0 20px}#error-page code{font-family:Consolas,Monaco,monospace}ul li{margin-bottom:10px;font-size:9px}a{color:#21759B;text-decoration:none;margin-top:-10px}a:hover{color:#D54E21}.button{background:#f7f7f7;border:1px solid #ccc;color:#555;display:inline-block;text-decoration:none;font-size:9px;line-height:26px;height:28px;margin:0;padding:0 10px 1px;cursor:pointer;-webkit-border-radius:3px;-webkit-appearance:none;border-radius:3px;white-space:nowrap;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;-webkit-box-shadow:inset 0 1px 0 #fff,0 1px 0 rgba(0,0,0,.08);box-shadow:inset 0 1px 0 #fff,0 1px 0 rgba(0,0,0,.08);vertical-align:top}.button.button-large{height:29px;line-height:28px;padding:0 12px}.button:focus,.button:hover{background:#fafafa;border-color:#999;color:#222}.button:focus{-webkit-box-shadow:1px 1px 1px rgba(0,0,0,.2);box-shadow:1px 1px 1px rgba(0,0,0,.2)}.button:active{background:#eee;border-color:#999;color:#333;-webkit-box-shadow:inset 0 2px 5px -3px rgba(0,0,0,.5);box-shadow:inset 0 2px 5px -3px rgba(0,0,0,.5)}table{table-layout:auto;border:1px solid #333;empty-cells:show;border-collapse:collapse}th{padding:4px;border:1px solid #333;overflow:hidden;color:#333;background:#eee}td{padding:4px;border:1px solid #333;overflow:hidden;color:#333} </style> </head> <body id="error-page"> <h3>站点提示信息</h3><h2>你还没安装！<a href="install/">点此安装</a><br></h2> </body> </html>';
        exit(0);
    }

    require ROOT.'config.php';

    if(!defined('SQLITE') && (!$dbconfig['user']||!$dbconfig['pwd']||!$dbconfig['dbname']))//检测安装
    {
        header('Content-type:text/html;charset=utf-8');
        //echo '你还没安装！<a href="install/">点此安装</a>';
        echo '<!DOCTYPE html> <html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN"> <head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>站点提示信息</title> <style type="text/css"> html{background:#eee;text-align: center;}body{background:#fff;color:#333;font-family:"微软雅黑","Microsoft YaHei",sans-serif;margin:2em auto;padding:1em 2em;max-width:700px;-webkit-box-shadow:10px 10px 10px rgba(0,0,0,.13);box-shadow:10px 10px 10px rgba(0,0,0,.13);opacity:.8}h1{border-bottom:1px solid #dadada;clear:both;color:#666;font:24px "微软雅黑","Microsoft YaHei",,sans-serif;margin:30px 0 0 0;padding:0;padding-bottom:7px}#error-page{margin-top:50px}h3{text-align:center}#error-page p{font-size:9px;line-height:1.5;margin:25px 0 20px}#error-page code{font-family:Consolas,Monaco,monospace}ul li{margin-bottom:10px;font-size:9px}a{color:#21759B;text-decoration:none;margin-top:-10px}a:hover{color:#D54E21}.button{background:#f7f7f7;border:1px solid #ccc;color:#555;display:inline-block;text-decoration:none;font-size:9px;line-height:26px;height:28px;margin:0;padding:0 10px 1px;cursor:pointer;-webkit-border-radius:3px;-webkit-appearance:none;border-radius:3px;white-space:nowrap;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;-webkit-box-shadow:inset 0 1px 0 #fff,0 1px 0 rgba(0,0,0,.08);box-shadow:inset 0 1px 0 #fff,0 1px 0 rgba(0,0,0,.08);vertical-align:top}.button.button-large{height:29px;line-height:28px;padding:0 12px}.button:focus,.button:hover{background:#fafafa;border-color:#999;color:#222}.button:focus{-webkit-box-shadow:1px 1px 1px rgba(0,0,0,.2);box-shadow:1px 1px 1px rgba(0,0,0,.2)}.button:active{background:#eee;border-color:#999;color:#333;-webkit-box-shadow:inset 0 2px 5px -3px rgba(0,0,0,.5);box-shadow:inset 0 2px 5px -3px rgba(0,0,0,.5)}table{table-layout:auto;border:1px solid #333;empty-cells:show;border-collapse:collapse}th{padding:4px;border:1px solid #333;overflow:hidden;color:#333;background:#eee}td{padding:4px;border:1px solid #333;overflow:hidden;color:#333} </style> </head> <body id="error-page"> <h3>站点提示信息</h3><h2>你还没安装！<a href="install/">点此安装</a><br></h2> </body> </html>';
        exit(0);
    }


    // //连接数据库
    include_once SYSTEM_ROOT . 'dbhelp.php';
    $DB= new SpringMySQLi($dbconfig['host'], $dbconfig['user'], $dbconfig['pwd'], $dbconfig['dbname']); 
    $sql = 'SELECT * FROM `sub_admin`';
    $count = $DB->select($sql) ?: array();
    $installcheck=count($count)>0?true:false;
    if ($installcheck == false) {
        @header('Content-Type: text/html; charset=UTF-8');
        exit('<script>alert("检测到您的数据库并未安装我们系统，自动为您跳转安装界面!");window.location.href="../install";</script>');
    }


    $password_hash='!@#%!s!0';
    include_once SYSTEM_ROOT . 'authcode.php';
    define('authcode', $authcode);

    include_once SYSTEM_ROOT . 'member.php';

    $clientip = x_real_ip();
    $cookiesid = isset($_COOKIE['mysid'])?$_COOKIE['mysid']:false;//获取mysid
    if (!$cookiesid || !preg_match('/^[0-9a-z]{32}$/i', $cookiesid)) {
        $cookiesid = bin2hex(random_bytes(16));
        setcookie('mysid', $cookiesid, [
            'expires' => time() + 604800,
            'path' => '/',
            'domain' => $_SERVER['HTTP_HOST'],
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Strict'
        ]);
    }

    $host = htmlspecialchars($_SERVER['HTTP_HOST'], ENT_QUOTES, 'UTF-8');

    $subconf = $DB->selectRow('SELECT * FROM sub_admin WHERE siteurl = "'.$host.'" limit 1');

    if($subconf==NULL) {
        sysmsg('<h2>您的站点没有绑定(只能绑定一个域名),请联系管理员，或者手动修改数据库表sub_admin的siteurl字段改成<b style="color:red;">'.$_SERVER['HTTP_HOST'].'</b><br/>', true);
        exit(0);
    }

    $userAgent = htmlspecialchars($_SERVER['HTTP_USER_AGENT'] ?? '', ENT_QUOTES, 'UTF-8');
    if (strpos($userAgent, 'QQ/') !== false) {
        include_once ROOT . 'jump.php';
        exit(0);
    }


    if(count($subconf)<=0){
        sysmsg('<h2>您的站点没有开通,请联系管理员.<br/>', true);
    }
    if ($subconf) {
        $conf = $subconf;
        if ($date > $conf['over_date']) {
            sysmsg('<h2>您的站点已到期,请联系管理员续费.<br/>', true);
        }
    }
    if ($subconf) {
        $conf = $subconf;
        if ($conf['state'] == 0) {
            sysmsg('<h2>您的站点违反规定,现已被管理员关闭.<br/>', true);
        }
    }
    //数据库更新
    // if ($install == false) {
    //     if (!($xxs['version'] >= VERSION)) {
    //         echo '您尚未更新数据库，请立即<a href="/install/updata.php">前往更新</a>';
    //         exit(0);
    //     }
    // }

    header_remove("X-Powered-By");
    
} catch (Exception $e) {
    // 记录错误但不显示详细信息给用户
    error_log($e->getMessage());
    sysmsg($e, true);
    exit(1);
}


