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

        if (stripos($userAgent, 'Android') !== false &&
            stripos($userAgent, 'Mobile') === false) {
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

        // 获取当前页面名称
        $currentPage = basename($_SERVER['PHP_SELF']);

        // 如果是移动设备且不在mobile目录，重定向
        if ($deviceType === 'mobile' && strpos($_SERVER['REQUEST_URI'], '/mobile/') === false) {
            $mobilePage = $basePath . 'mobile/' . $currentPage;
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . $mobilePage)) {
                header('Location: ' . $mobilePage);
                exit;
            }
        }

        // 如果是桌面设备且在mobile目录，重定向回桌面版
        if ($deviceType === 'desktop' && strpos($_SERVER['REQUEST_URI'], '/mobile/') !== false) {
            $desktopPage = str_replace('/mobile/', '/', $_SERVER['REQUEST_URI']);
            header('Location: ' . $desktopPage);
            exit;
        }
    }
}
