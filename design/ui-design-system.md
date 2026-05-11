# 资金业务官网 - UI设计系统

## 1. 设计理念

### 整体风格
- **定位**：高端金融服务平台
- **调性**：专业、稳重、可信、高端
- **视觉语言**：杂志感排版、大量留白、克制动效

### 设计原则
1. **克制** - 少即是多，避免过度设计
2. **层次** - 通过 typography 和 spacing 建立视觉层级
3. **质感** - 微妙的纹理和光影营造高端感
4. **留白** - 大量负空间让内容呼吸

---

## 2. 色彩系统

### 主色调
| 名称 | 色值 | 用途 |
|------|------|------|
| 背景主色 | `#FDFBF7` | 页面背景、大面积底色 |
| 背景次色 | `#FFFFFF` | 卡片、内容区域 |
| 文字主色 | `#1A1A1A` | 标题、重要文字 |
| 文字次色 | `#4A4A4A` | 正文、描述 |
| 文字辅助 | `#787774` | 辅助说明、元信息 |

### 点缀色
| 名称 | 色值 | 用途 |
|------|------|------|
| 深褐主色 | `#5C4033` | CTA按钮、重点强调 |
| 深褐悬停 | `#4A3428` | 按钮悬停状态 |
| 浅褐背景 | `#F5F0EB` | 区块背景、标签 |
| 金色点缀 | `#B8956A` | 装饰元素、高亮 |
| 边框色 | `#E8E4DF` | 分割线、边框 |
| 淡灰边框 | `#EAEAEA` | 卡片边框 |

### 语义色
| 名称 | 色值 | 用途 |
|------|------|------|
| 成功 | `#346538` / `#EDF3EC` | 成功状态 |
| 警告 | `#956400` / `#FBF3DB` | 警告提示 |
| 信息 | `#1F6C9F` / `#E1F3FE` | 信息提示 |

---

## 3. 字体系统

### 字体家族
```css
/* 标题字体 - 优雅衬线 */
--font-display: 'Playfair Display', 'Lyon Text', 'Newsreader', serif;

/* 正文字体 - 清晰无衬线 */
--font-body: 'SF Pro Display', 'Geist Sans', 'Helvetica Neue', sans-serif;

/* 数据/标签 - 等宽 */
--font-mono: 'SF Mono', 'JetBrains Mono', monospace;
```

### 字号规范

| 级别 | 字体 | 大小 | 字重 | 行高 | 字间距 | 用途 |
|------|------|------|------|------|--------|------|
| Hero | Playfair | 72px / 4.5rem | 500 | 1.1 | -0.02em | 首屏大标题 |
| H1 | Playfair | 48px / 3rem | 500 | 1.15 | -0.02em | 页面主标题 |
| H2 | Playfair | 36px / 2.25rem | 500 | 1.2 | -0.01em | 区块标题 |
| H3 | Playfair | 28px / 1.75rem | 500 | 1.25 | 0 | 子区块标题 |
| H4 | Geist Sans | 20px / 1.25rem | 600 | 1.3 | 0 | 卡片标题 |
| Body Large | Geist Sans | 18px / 1.125rem | 400 | 1.6 | 0 | 引导段落 |
| Body | Geist Sans | 16px / 1rem | 400 | 1.6 | 0 | 正文 |
| Small | Geist Sans | 14px / 0.875rem | 400 | 1.5 | 0 | 辅助文字 |
| Caption | Geist Sans | 12px / 0.75rem | 500 | 1.4 | 0.05em | 标签、元信息 |

---

## 4. 间距系统

### 基础单位
- 基础单位：`4px`
- 间距比例：4, 8, 12, 16, 24, 32, 48, 64, 96, 128

### 区块间距
| 场景 | 数值 | 用途 |
|------|------|------|
| Section Y | 120px / 7.5rem | 主要区块上下间距 |
| Section Y (compact) | 80px / 5rem | 紧凑区块间距 |
| Container X | 48px / 3rem | 容器左右内边距 |
| Content gap | 64px / 4rem | 内容块之间间距 |
| Element gap | 24px / 1.5rem | 元素之间间距 |
| Text gap | 16px / 1rem | 文字元素间距 |

### 容器规范
```css
/* 最大宽度 */
--container-max: 1280px;
--container-narrow: 960px;
--container-wide: 1440px;

/* 内边距 */
--container-padding: 48px;
--container-padding-mobile: 24px;
```

---

## 5. 组件规范

### 5.1 按钮

#### 主按钮 (Primary)
```css
background: #5C4033;
color: #FFFFFF;
padding: 16px 32px;
border-radius: 6px;
font-size: 16px;
font-weight: 500;
transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);

/* Hover */
background: #4A3428;
transform: scale(0.98);
```

#### 次按钮 (Secondary)
```css
background: transparent;
color: #5C4033;
border: 1px solid #5C4033;
padding: 16px 32px;
border-radius: 6px;

/* Hover */
background: #F5F0EB;
```

#### 文字按钮 (Text)
```css
background: transparent;
color: #5C4033;
padding: 8px 0;
border-bottom: 1px solid #5C4033;

/* Hover */
color: #4A3428;
```

### 5.2 卡片

#### 业务卡片 (Bento Card)
```css
background: #FFFFFF;
border: 1px solid #EAEAEA;
border-radius: 12px;
padding: 40px;
transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);

/* Hover */
box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
transform: translateY(-4px);
```

#### 数据卡片 (Stat Card)
```css
background: #F5F0EB;
border-radius: 12px;
padding: 32px;
text-align: center;
```

### 5.3 标签

```css
background: #F5F0EB;
color: #5C4033;
padding: 6px 12px;
border-radius: 9999px;
font-size: 12px;
font-weight: 500;
letter-spacing: 0.05em;
text-transform: uppercase;
```

### 5.4 输入框

```css
background: #FFFFFF;
border: 1px solid #E8E4DF;
border-radius: 8px;
padding: 16px 20px;
font-size: 16px;
transition: border-color 0.2s;

/* Focus */
border-color: #5C4033;
outline: none;
```

### 5.5 导航

#### Header 导航
```css
background: rgba(253, 251, 247, 0.9);
backdrop-filter: blur(12px);
border-bottom: 1px solid rgba(232, 228, 223, 0.5);
padding: 20px 48px;
position: sticky;
top: 0;
z-index: 100;
```

#### 导航链接
```css
color: #4A4A4A;
font-size: 15px;
font-weight: 500;
padding: 8px 16px;
transition: color 0.2s;

/* Hover */
color: #5C4033;
```

---

## 6. 动效规范

### 6.1 入场动画

```css
/* 基础入场 */
@keyframes fadeUp {
  from {
    opacity: 0;
    transform: translateY(24px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
```

### 6.2 悬停效果

```css
/* 卡片悬停 */
transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);

/* 按钮悬停 */
transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
```

### 6.3 列表交错动画

```css
animation-delay: calc(var(--index) * 100ms);
```

### 6.4 缓动函数

```css
--ease-out-expo: cubic-bezier(0.16, 1, 0.3, 1);
--ease-out-quart: cubic-bezier(0.25, 1, 0.5, 1);
```

---

## 7. 响应式断点

| 断点 | 宽度 | 说明 |
|------|------|------|
| Desktop XL | 1440px+ | 大屏优化 |
| Desktop | 1280px | 标准桌面 |
| Laptop | 1024px | 小屏桌面/平板横屏 |
| Tablet | 768px | 平板竖屏 |
| Mobile | 640px | 手机横屏 |
| Mobile SM | 480px | 手机竖屏 |

---

## 8. 阴影规范

```css
/* 卡片阴影 - 极淡 */
--shadow-card: 0 2px 8px rgba(0, 0, 0, 0.04);
--shadow-card-hover: 0 4px 24px rgba(0, 0, 0, 0.06);

/* 悬浮阴影 */
--shadow-float: 0 8px 32px rgba(0, 0, 0, 0.08);
```

---

*设计系统版本: v1.0*
*创建日期: 2025-04-20*
*设计师: 设计-优优*
