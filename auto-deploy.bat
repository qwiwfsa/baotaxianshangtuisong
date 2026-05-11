@echo off
chcp 65001 >nul
setlocal enabledelayedexpansion

echo ==========================================
echo   宏都资本网站 - 一键部署到宝塔服务器
echo ==========================================
echo.

set SERVER_IP=47.95.236.85
set SERVER_USER=root
set WEB_ROOT=/www/wwwroot/www.yaozijin.com/hongdu
set SSH_KEY=%USERPROFILE%\.ssh\id_rsa_baota
set LOCAL_DIR=%~dp0
set ZIP_FILE=%LOCAL_DIR%..\hongdu_deploy.zip
set SQL_FILE=%LOCAL_DIR%hongdu_backup_20260511.sql

echo [配置信息]
echo   服务器: %SERVER_IP%
echo   网站目录: %WEB_ROOT%
echo   SSH密钥: %SSH_KEY%
echo   本地压缩包: %ZIP_FILE%
echo   数据库备份: %SQL_FILE%
echo.

REM ===== 步骤1: 检查文件 =====
echo ===== 步骤1: 检查本地文件 =====
if not exist "%ZIP_FILE%" (
    echo [错误] 找不到压缩包: %ZIP_FILE%
    echo 请先运行压缩步骤
    goto :error
)
echo [OK] 压缩包已就绪

if not exist "%SQL_FILE%" (
    echo [警告] 找不到数据库备份: %SQL_FILE%
    echo 将跳过数据库导入
    set SKIP_SQL=1
) else (
    echo [OK] 数据库备份已就绪
)

echo.

REM ===== 步骤2: 测试SSH连接 =====
echo ===== 步骤2: 测试SSH连接 =====
ssh -i "%SSH_KEY%" -o StrictHostKeyChecking=no -o ConnectTimeout=10 -p 22 %SERVER_USER%@%SERVER_IP% "echo SSH_OK" 2>nul
if errorlevel 1 (
    echo [错误] SSH连接失败！请检查:
    echo   1. 服务器SSH是否开启
    echo   2. 安全组是否允许本机IP
    echo   3. SSH端口是否为22
    goto :error
)
echo [OK] SSH连接正常
echo.

REM ===== 步骤3: 上传压缩包 =====
echo ===== 步骤3: 上传压缩包到服务器 =====
echo 正在上传 %ZIP_FILE% ...
scp -i "%SSH_KEY%" -o StrictHostKeyChecking=no -P 22 "%ZIP_FILE%" %SERVER_USER%@%SERVER_IP%:/tmp/hongdu_deploy.zip
if errorlevel 1 (
    echo [错误] 上传压缩包失败
    goto :error
)
echo [OK] 压缩包上传完成
echo.

REM ===== 步骤4: 上传数据库备份 =====
if "%SKIP_SQL%"=="1" goto :skip_sql_upload
echo ===== 步骤4: 上传数据库备份 =====
scp -i "%SSH_KEY%" -o StrictHostKeyChecking=no -P 22 "%SQL_FILE%" %SERVER_USER%@%SERVER_IP%:/tmp/hongdu_backup.sql
if errorlevel 1 (
    echo [警告] 数据库备份上传失败，继续部署
) else (
    echo [OK] 数据库备份上传完成
)
echo.
:skip_sql_upload

REM ===== 步骤5: 在服务器上解压部署 =====
echo ===== 步骤5: 服务器端解压部署 =====
ssh -i "%SSH_KEY%" -o StrictHostKeyChecking=no -p 22 %SERVER_USER%@%SERVER_IP% "cd /www/wwwroot/www.yaozijin.com/hongdu && unzip -o /tmp/hongdu_deploy.zip && echo DEPLOY_UNZIP_OK"
if errorlevel 1 (
    echo [错误] 解压部署失败
    goto :error
)
echo [OK] 文件解压完成
echo.

REM ===== 步骤6: 设置文件权限 =====
echo ===== 步骤6: 设置文件权限 =====
ssh -i "%SSH_KEY%" -o StrictHostKeyChecking=no -p 22 %SERVER_USER%@%SERVER_IP% "chown -R www:www %WEB_ROOT% && chmod -R 755 %WEB_ROOT% && chmod -R 777 %WEB_ROOT%/cms/uploads %WEB_ROOT%/admin/data %WEB_ROOT%/uploads && echo PERM_OK"
if errorlevel 1 (
    echo [警告] 权限设置可能不完整
) else (
    echo [OK] 文件权限设置完成
)
echo.

REM ===== 步骤7: 导入数据库 =====
if "%SKIP_SQL%"=="1" goto :skip_sql_import
echo ===== 步骤7: 导入数据库 =====
echo 请输入宝塔MySQL密码 (hongdu用户):
set /p MYSQL_PASS="密码: "
ssh -i "%SSH_KEY%" -o StrictHostKeyChecking=no -p 22 %SERVER_USER%@%SERVER_IP% "mysql -u hongdu -p%MYSQL_PASS% hongdu < /tmp/hongdu_backup.sql && echo SQL_IMPORT_OK"
if errorlevel 1 (
    echo [警告] 数据库导入失败，请手动导入
) else (
    echo [OK] 数据库导入完成
)
echo.
:skip_sql_import

REM ===== 步骤8: 清理临时文件 =====
echo ===== 步骤8: 清理临时文件 =====
ssh -i "%SSH_KEY%" -o StrictHostKeyChecking=no -p 22 %SERVER_USER%@%SERVER_IP% "rm -f /tmp/hongdu_deploy.zip /tmp/hongdu_backup.sql && echo CLEANUP_OK"
echo [OK] 临时文件清理完成
echo.

REM ===== 完成 =====
echo ==========================================
echo   部署完成！
echo ==========================================
echo.
echo 网站地址: https://www.yaozijin.com/
echo 管理后台: https://www.yaozijin.com/admin/
echo.
goto :end

:error
echo.
echo ==========================================
echo   部署失败！请检查错误信息
echo ==========================================
pause
exit /b 1

:end
pause
exit /b 0
