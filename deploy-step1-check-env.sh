#!/bin/bash
# 步骤1：检查服务器环境

echo "========================================"
echo "  步骤1：检查服务器环境"
echo "========================================"

echo ""
echo "1. 检查PHP版本（需要7.4+）："
php -v

echo ""
echo "2. 检查MySQL版本（需要5.7+）："
mysql -V

echo ""
echo "3. 检查Nginx："
nginx -v

echo ""
echo "4. 检查Node.js（用于图片上传服务）："
node -v
npm -v

echo ""
echo "5. 检查网站目录："
ls -la /www/wwwroot/api.yaozijin.com

echo ""
echo "========================================"
echo "  环境检查完成"
echo "========================================"
