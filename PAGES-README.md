# 恒信资本官网 - 独立页面说明

## 页面结构

网站现在包含以下独立页面，每个页面都可以独立编辑和自定义内容：

```
website-capital-final/
├── index.html          (首页 - 已更新导航链接)
├── services.html       (业务范围 - 可编辑)
├── cases.html          (成功案例 - 可编辑)
├── advantages.html     (服务优势 - 可编辑)
├── news.html           (行业资讯 - 可编辑)
├── faq.html            (常见问题 - 可编辑)
├── contact.html        (联系我们 - 可编辑)
├── css/
│   ├── style.css       (共享样式)
│   └── page-custom.css (独立页面自定义样式)
├── js/
│   └── main.js         (共享脚本)
└── images/             (图片文件夹)
```

## 各页面可编辑区域

### 1. services.html (业务范围)

**可编辑区域：**
- `services-list` - 业务模块列表（4个业务卡片，每个包含图标、标题、描述、图片、功能列表）
- `services-details` - 业务详情扩展（核心优势、收费说明、风险提示）
- `services-process` - 服务流程（4个步骤：需求沟通、方案设计、审核放款、后续服务）

**每个业务模块包含：**
- 图片
- 图标
- 标题
- 描述
- 功能列表
- 按钮

### 2. cases.html (成功案例)

**可编辑区域：**
- `cases-filter` - 筛选标签（全部、上市公司、企业摆账、银行存款、应收账款）
- `cases-list` - 案例卡片列表（9个案例，每个包含图片、标题、类型、金额、周期、描述）
- `cases-stats` - 案例统计（服务企业、管理规模、成功率、满意度）

**每个案例卡片包含：**
- 图片
- 标题
- 业务类型
- 资金规模
- 服务周期
- 案例描述
- 日期

### 3. advantages.html (服务优势)

**可编辑区域：**
- `advantages-core` - 核心优势（8个优势模块：快速响应、安全可靠、专业团队、灵活定制、资金雄厚、高效执行、信誉保障、贴心服务）
- `advantages-why` - 为什么选择我们（左侧图片+右侧4个理由）
- `advantages-partners` - 合作伙伴（6个合作伙伴图标）

**每个优势模块包含：**
- 图标
- 标题
- 描述
- 功能列表

### 4. news.html (行业资讯)

**可编辑区域：**
- `news-categories` - 资讯分类（全部、行业动态、政策解读、业务知识、公司新闻）
- `news-featured` - 精选资讯（2个大图展示）
- `news-list` - 资讯列表（9篇文章，每篇包含图片、标题、摘要、日期）
- `news-pagination` - 分页
- `news-subscribe` - 订阅区域

**每篇资讯包含：**
- 图片
- 分类标签
- 标题
- 摘要
- 发布日期

### 5. faq.html (常见问题)

**可编辑区域：**
- `faq-search` - 搜索框
- `faq-categories` - FAQ分类（全部、亮资业务、过桥资金、摆账业务、应收账款、一般问题）
- `faq-list` - FAQ列表（5个分类，每个包含多个问答）
- `faq-more` - 更多问题联系区域

**每个FAQ条目包含：**
- 问题
- 答案（支持段落、列表、表格）

### 6. contact.html (联系我们)

**可编辑区域：**
- `contact-info` - 联系信息卡片（电话、邮箱、地址、微信）
- `contact-details` - 联系详情（左侧表单+右侧二维码和工作时间）
- `contact-map` - 地图位置
- `contact-quick-nav` - 快速导航

**联系信息包含：**
- 联系电话
- 电子邮箱
- 公司地址
- 微信二维码
- 在线咨询表单
- 地图位置

## 如何编辑页面

### 方法1：直接编辑HTML

1. 打开对应的 `.html` 文件
2. 找到 `data-section` 属性的 `div` 元素
3. 在可编辑区域内修改内容

示例：
```html
<div class="editable-section" data-section="services-list">
    <!-- 在这里添加或编辑业务模块 -->
    <article class="service-custom-card" data-module-id="1">
        <!-- 模块内容 -->
    </article>
</div>
```

### 方法2：添加新模块

复制现有的模块代码，修改其中的内容：

```html
<!-- 复制这个结构来添加新的业务模块 -->
<article class="service-custom-card" data-module-id="新ID">
    <div class="service-custom-image">
        <img src="images/新图片.jpg" alt="描述">
        <div class="service-custom-overlay">
            <i class="fas fa-图标"></i>
        </div>
    </div>
    <div class="service-custom-content">
        <div class="service-custom-icon">
            <i class="fas fa-图标"></i>
        </div>
        <h3 class="service-custom-title">新标题</h3>
        <p class="service-custom-desc">新描述</p>
        <ul class="service-custom-list">
            <li><i class="fas fa-check"></i> 功能1</li>
            <li><i class="fas fa-check"></i> 功能2</li>
        </ul>
    </div>
</article>
```

## 样式说明

### 共享样式 (style.css)
- 导航栏样式
- 按钮样式
- 页脚样式
- 客服组件样式
- 响应式布局基础

### 页面自定义样式 (page-custom.css)
- 各页面的独特样式
- 可编辑区域的卡片样式
- 页面特定的布局和动画

## 图片要求

各页面需要的图片（放在 `images/` 文件夹）：

### services.html
- `service-listed.jpg` - 上市公司类业务
- `service-baizhang.jpg` - 企业/个人摆账
- `service-deposit.jpg` - 银行存款类
- `service-receivable.jpg` - 应收账款融资

### cases.html
- `case-1.jpg` 到 `case-9.jpg` - 案例图片

### advantages.html
- `why-choose-us.jpg` - 为什么选择我们配图

### news.html
- `news-featured-1.jpg`, `news-featured-2.jpg` - 精选资讯大图
- `news-1.jpg` 到 `news-9.jpg` - 资讯配图

### contact.html
- `wechat-qr.png` - 微信二维码（已存在）

## 注意事项

1. **保持结构完整**：编辑时不要删除外层容器 `.editable-section`
2. **图片路径**：使用相对路径 `images/图片名.jpg`
3. **图标使用**：使用 Font Awesome 图标类，如 `fas fa-check`
4. **响应式设计**：所有页面都支持移动端适配
5. **SEO优化**：每个页面都有独立的 title、description、keywords

## 技术特性

- **模块化设计**：每个内容块都是独立的模块
- **响应式布局**：适配桌面、平板、手机
- **平滑动画**：悬停效果和过渡动画
- **无障碍支持**：ARIA 标签和键盘导航
- **SEO友好**：语义化HTML和元标签
