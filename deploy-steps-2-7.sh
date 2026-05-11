#!/bin/bash
# 部署步骤2-7 - 阿里云服务器部署脚本

SERVER_IP="47.95.236.85"
WEB_ROOT="/www/wwwroot/api.yaozijin.com"

echo "========================================"
echo "  恒信资本网站后台部署脚本"
echo "========================================"

# 步骤2：创建网站目录
echo ""
echo "【步骤2】创建网站目录..."
sudo mkdir -p $WEB_ROOT
sudo chown -R www:www $WEB_ROOT
echo "✅ 网站目录创建完成: $WEB_ROOT"

# 步骤4：设置文件权限（步骤3文件上传后执行）
echo ""
echo "【步骤4】设置文件权限..."
cd $WEB_ROOT

# 设置目录权限
sudo chown -R www:www $WEB_ROOT
sudo chmod -R 755 $WEB_ROOT

# 设置上传目录可写权限
sudo chmod -R 777 $WEB_ROOT/cms/uploads
sudo chmod -R 777 $WEB_ROOT/admin/data

# 设置PHP文件权限
sudo chmod -R 644 $WEB_ROOT/admin/api/*.php
sudo find $WEB_ROOT/admin/api -name "*.php" -exec chmod 644 {} \;

echo "✅ 文件权限设置完成"

# 步骤6：初始化数据库
echo ""
echo "【步骤6】初始化数据库..."
cd $WEB_ROOT
php admin/api/init-db.php
echo "✅ 数据库初始化完成"

# 步骤7：启动Node.js图片上传服务
echo ""
echo "【步骤7】启动Node.js图片上传服务..."
cd $WEB_ROOT

# 检查是否已安装依赖
if [ ! -d "$WEB_ROOT/node_modules" ]; then
    echo "正在安装Node.js依赖..."
    npm install express multer cors
fi

# 检查PM2是否安装
if ! command -v pm2 &> /dev/null; then
    echo "正在安装PM2..."
    npm install -g pm2
fi

# 停止已存在的服务
pm2 stop cms-upload-server 2>/dev/null || true
pm2 delete cms-upload-server 2>/dev/null || true

# 启动服务
pm2 start server.js --name "cms-upload-server"
pm2 save
pm2 startup

echo "✅ Node.js服务启动完成"
echo ""
pm2 status

echo ""
echo "========================================"
echo "  部署步骤2/4/6/7 执行完成"
echo "========================================"
echo ""
echo "⚠️  注意：步骤3（上传文件）和步骤5（Nginx配置）"
echo "   需要手动完成，请参考部署指南"
echo ""
echo "【下一步】"
echo "1. 上传文件到服务器: $WEB_ROOT"
echo "2. 配置Nginx（参考部署指南步骤5）"
echo ""
