<?php
/**
 * 设备检测类
 * 用于判断访问设备类型并重定向到对应版本
 */

class DeviceDetector {

    /**
     * 检测是否为移动设备
     */
    public static function isMobile() {
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';

        // 移动设备关键词
        $mobileKeywords = [
            'Mobile', 'Android', 'iPhone', 'iPad', 'iPod',
            'BlackBerry', 'Windows Phone', 'webOS', 'Opera Mini',
            'IEMobile', 'Mobile Safari'
        ];

        foreach ($mobileKeywords as $keyword) {
            if (stripos($userAgent, $keyword) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * 检测是否为平板设备
     */
    public static function isTablet() {
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';

        if (stripos($userAgent, 'iPad') !== false) {
            return true;
        }

        // Android 平板：包含 Android 但不含 Mobile，且有平板特征（Tablet 关键字或平板型号）
        if (stripos($userAgent, 'Android') !== false &&
            stripos($userAgent, 'Mobile') === false &&
            preg_match('/\b(?:tablet|tab\b|smt|gt-p|sch-i|kf\w+)/i', $userAgent)) {
            return true;
        }

        return false;
    }

    /**
     * 获取设备类型
     * @return string 'mobile', 'tablet', 'desktop'
     */
    public static function getDeviceType() {
        if (self::isTablet()) {
            return 'tablet';
        }

        if (self::isMobile()) {
            return 'mobile';
        }

        return 'desktop';
    }

    /**
     * 重定向到对应设备版本
     * @param string $basePath 基础路径
     */
    public static function redirect($basePath = '') {
        // 启动会话（如果尚未启动）
        if (session_status() === PHP_SESSION_NONE) {
            @session_start();
        }

        // 检查是否有强制参数
        if (isset($_GET['force_device'])) {
            $forceDevice = $_GET['force_device'];
            if (in_array($forceDevice, ['mobile', 'desktop'])) {
                $_SESSION['force_device'] = $forceDevice;
            }
        }

        // 如果有强制设备设置，使用强制设置
        if (isset($_SESSION['force_device'])) {
            $deviceType = $_SESSION['force_device'];
        } else {
            $deviceType = self::getDeviceType();
        }

        // 获取当前页面名
        $currentPage = basename($_SERVER['PHP_SELF']);

        // 如果是移动设备或平板且不在mobile目录，重定向到移动版
        if (in_array($deviceType, ['mobile', 'tablet']) && strpos($_SERVER['REQUEST_URI'], '/mobile/') === false) {
            // 优先尝试 .php，若不存在则尝试 .html（手机端是.html文件）
            // 注意: 路径前加 "/" 防止 DOCUMENT_ROOT 无尾斜杠导致路径拼接错误
            $mobilePage = $basePath . '/mobile/' . $currentPage;
            if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $mobilePage)) {
                $htmlPage = preg_replace('/\.php$/', '.html', $mobilePage);
                if ($htmlPage !== $mobilePage && file_exists($_SERVER['DOCUMENT_ROOT'] . $htmlPage)) {
                    $mobilePage = $htmlPage;
                }
            }
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . $mobilePage)) {
                header('Location: ' . $mobilePage . (!empty($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : ''));
                exit;
            }
        }

// 如果是桌面设备// 如果是桌面设备且在mobile目录，重定向回桌面版
        if ($deviceType === 'desktop' && strpos($_SERVER['REQUEST_URI'], '/mobile/') !== false) {
            $desktopPage = str_replace('/mobile/', '/', $_SERVER['REQUEST_URI']);
            header('Location: ' . $desktopPage);
            exit;
        }
    }
}
