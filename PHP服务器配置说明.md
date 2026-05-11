# PHP服务器配置说明

## 问题描述

"Failed to fetch" 错误是因为 **PHP服务器没有运行**。CMS后台需要PHP服务器来处理API请求（保存文章、加载数据等）。

## 解决方案

### 方案一：启动PHP开发服务器（推荐用于本地测试）

#### 方法1：使用提供的启动脚本
```bash
双击运行 start-server.bat
```

#### 方法2：手动启动
```bash
# 进入项目目录
cd website-capital-final

# 启动PHP内置服务器
php -S localhost:8080 -t .

# 然后访问 http://localhost:8080/admin/
```

### 方案二：安装集成环境（推荐用于生产环境）

#### 选项1：XAMPP
1. 下载：https://www.apachefriends.org/
2. 安装并启动Apache + MySQL
3. 将项目文件夹复制到 `C:\xampp\htdocs\`
4. 访问 `http://localhost/website-capital-final/admin/`

#### 选项2：WAMP
1. 下载：https://www.wampserver.com/
2. 安装并启动服务
3. 将项目文件夹复制到 `C:\wamp64\www\`
4. 访问 `http://localhost/website-capital-final/admin/`

#### 选项3：Laragon
1. 下载：https://laragon.org/
2. 安装并启动
3. 将项目文件夹复制到 `C:\laragon\www\`
4. 访问 `http://website-capital-final.test/`

### 方案三：使用本地存储模式（无需PHP）

**已自动启用**：当PHP服务器不可用时，系统会自动切换到本地存储模式，文章数据将保存在浏览器本地。

**注意**：本地存储模式的数据仅在当前浏览器有效，清除浏览器数据会丢失。

## 数据库配置

如果使用PHP服务器，需要配置数据库：

1. 编辑 `admin/api/config.php`
2. 修改以下配置：
```php
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');
define('DB_USER', 'root');
define('DB_PASS', '你的密码');
define('DB_NAME', '数据库名');
```

3. 首次访问时会自动创建数据表

## 测试API是否正常工作

启动PHP服务器后，访问：
```
http://localhost:8080admin/api/test.php
```

如果看到以下JSON响应，说明PHP服务器正常运行：
```json
{
  "status": "ok",
  "message": "API is working",
  "time": "2024-...",
  "php_version": "8.x.x"
}
```

## 常见问题

### Q: 提示"php不是内部或外部命令"
A: PHP未添加到系统PATH，需要安装PHP并配置环境变量

### Q: 端口8080被占用
A: 脚本会自动尝试8081端口，或手动指定其他端口：`php -S localhost:8082 -t .`

### Q: 数据库连接失败
A: 检查config.php中的数据库配置，确保MySQL服务已启动

### Q: 文章保存后刷新页面消失
A: 使用的是本地存储模式，数据保存在当前浏览器。如需持久化存储，请配置PHP+MySQL环境

## 技术支持

如有问题，请联系开发人员。
