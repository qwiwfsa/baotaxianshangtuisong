# Node.js 图片上传服务器使用说明

## 概述

由于老板电脑没有安装PHP，但已安装Node.js v24.14.0，现已创建Node.js服务器来替代PHP处理图片上传功能。

## 创建的文件

1. **server.js** - Node.js上传服务器主文件
2. **start-node-server.bat** - Windows启动脚本

## 修改的文件

以下文件中的上传地址已从 `api/upload.php` 或 `api/case/upload.php` 改为 `http://localhost:3000/api/upload`：

1. `admin/assets/editor-v2.js`
2. `admin/case-edit.html`
3. `admin/test-upload.html`
4. `admin/components/news/article-edit.html`
5. `admin/test-cms-v2.html`

## 使用方法

### 方法一：使用启动脚本（推荐）

1. 双击运行 `start-node-server.bat`
2. 脚本会自动检查并安装依赖（express, multer, cors）
3. 服务器启动后会显示访问地址

### 方法二：手动启动

```bash
# 进入网站目录
cd website-capital-final

# 安装依赖（首次使用）
npm install express multer cors

# 启动服务器
node server.js
```

## 服务器信息

- **端口**: 3000
- **上传接口**: http://localhost:3000/api/upload
- **图片访问**: http://localhost:3000/cms/uploads/图片文件名
- **上传目录**: cms/uploads/

## 功能特性

- ✅ 支持 JPG, PNG, GIF, WebP 格式
- ✅ 最大文件大小: 5MB
- ✅ 自动生成唯一文件名
- ✅ 跨域支持 (CORS)
- ✅ 静态文件服务（可直接访问上传的图片）

## 前端使用示例

```javascript
const formData = new FormData();
formData.append('image', file);

fetch('http://localhost:3000/api/upload', {
    method: 'POST',
    body: formData
})
.then(response => response.json())
.then(data => {
    if (data.success) {
        console.log('图片URL:', data.data.url);
    }
});
```

## 注意事项

1. 使用CMS上传功能前，必须先启动Node.js服务器
2. 服务器启动后会一直运行，直到手动关闭（按Ctrl+C）
3. 上传的图片保存在 `cms/uploads/` 目录下
4. 如果端口3000被占用，需要修改server.js中的PORT变量

## 故障排除

### 问题：无法连接到服务器
- 检查服务器是否已启动
- 检查端口3000是否被其他程序占用

### 问题：上传失败
- 检查文件大小是否超过5MB
- 检查文件格式是否为支持的图片格式
- 查看服务器控制台错误信息

### 问题：跨域错误
- 服务器已配置CORS，如仍有问题请检查浏览器安全设置
