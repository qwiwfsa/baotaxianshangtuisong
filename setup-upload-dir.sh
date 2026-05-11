#!/bin/bash
# 设置图片上传目录权限脚本

SERVER_IP="47.95.236.85"
UPLOAD_DIR="/www/wwwroot/47.95.236.85/uploads"

echo "设置图片上传目录..."

# 创建上传目录
ssh root@$SERVER_IP "mkdir -p $UPLOAD_DIR"

# 设置目录权限（www用户需要有写入权限）
ssh root@$SERVER_IP "chown -R www:www $UPLOAD_DIR"
ssh root@$SERVER_IP "chmod -R 755 $UPLOAD_DIR"

# 检查PHP配置
echo "检查PHP上传配置..."
ssh root@$SERVER_IP "grep -E 'upload_max_filesize|post_max_size' /www/server/php/*/etc/php.ini"

echo "设置完成！"
echo "上传目录: $UPLOAD_DIR"
echo "请确保PHP配置允许上传至少5MB的文件"
