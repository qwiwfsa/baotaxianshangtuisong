# 恒信资本CMS管理系统

简化版CMS系统，提供表单式页面编辑功能。

## 功能特性

### 1. 页面管理
- 列出所有11个页面
- 显示页面名称、描述、最后修改时间
- 一键进入编辑页面

### 2. 表单式编辑
- 每个页面独立的编辑表单
- 支持编辑内容：
  - 页面标题
  - 副标题
  - 正文内容（富文本编辑器）
  - 图片URL
  - 按钮文字和链接
- 实时预览功能

### 3. 数据存储
- 使用JSON文件存储页面数据
- 每个页面一个JSON文件
- 数据格式统一规范

### 4. 保存发布
- 保存按钮：保存到JSON文件
- 发布按钮：标记为已发布
- 备份功能：自动保存历史版本

## 文件结构

```
admin/
├── index.html          # 管理后台首页（页面列表）
├── login.html          # 登录页面
├── editor.html         # 通用编辑页面
├── api/
│   ├── save.php        # 保存数据API
│   ├── publish.php     # 发布页面API
│   └── load.php        # 加载数据API
├── data/               # JSON数据存储
│   ├── index.json
│   ├── services.json
│   ├── cases.json
│   ├── contact.json
│   └── backup/         # 自动备份
└── assets/
    └── cms.js          # 前端数据集成脚本
```

## 使用说明

### 登录
1. 访问 `admin/login.html`
2. 默认账号：`admin`
3. 默认密码：`admin123`

### 编辑页面
1. 在管理后台首页点击"编辑"按钮
2. 在左侧表单中修改内容
3. 右侧实时预览效果
4. 点击"保存"保存更改
5. 点击"发布"更新网站

### 支持的页面
- 首页 (index)
- 业务范围 (services)
- 成功案例 (cases)
- 案例详情 (case-detail)
- 服务优势 (advantages)
- 行业资讯 (news)
- 常见问题 (faq)
- 联系我们 (contact)
- 隐私政策 (privacy)
- 合规声明 (compliance)
- 网站地图 (sitemap)

## 数据格式

```json
{
  "page": "index",
  "heroTitle": "主标题",
  "heroSubtitle": "副标题",
  "heroButtonText": "按钮文字",
  "heroButtonLink": "按钮链接",
  "lastModified": "2026-04-21 10:00:00",
  "published": true,
  "publishedAt": "2026-04-21 10:00:00"
}
```

## 技术栈

- 前端：HTML5, CSS3, JavaScript
- 富文本编辑器：TinyMCE
- 后端：PHP
- 数据存储：JSON文件

## 注意事项

1. 确保 `admin/data/` 目录有写入权限
2. 定期备份 `admin/data/` 目录
3. 富文本编辑器需要联网加载
4. 建议使用现代浏览器访问

## 更新日志

### v1.0.0 (2026-04-21)
- 初始版本发布
- 支持首页、业务范围、案例、联系页面的编辑
- 实现表单式编辑和实时预览
- 添加自动备份功能
