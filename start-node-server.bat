@echo off
chcp 65001 >nul
echo ========================================
echo   CMS图片上传服务器启动脚本
echo ========================================
echo.

REM 检查Node.js是否安装
node --version >nul 2>&1
if errorlevel 1 (
    echo [错误] 未检测到Node.js，请先安装Node.js
    pause
    exit /b 1
)

echo [信息] Node.js版本:
node --version
echo.

REM 检查依赖是否安装
if not exist "node_modules\express" (
    echo [信息] 正在安装依赖 (express, multer, cors)...
    npm install express multer cors
    if errorlevel 1 (
        echo [错误] 依赖安装失败
        pause
        exit /b 1
    )
    echo [信息] 依赖安装完成
) else (
    echo [信息] 依赖已安装
)

echo.
echo [信息] 正在启动服务器...
echo ========================================
node server.js

pause
