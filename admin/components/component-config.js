/**
 * CMS组件系统配置
 * 定义所有可用组件及其属性
 */

const ComponentConfig = {
    // 基础组件
    basic: {
        name: '基础组件',
        icon: 'fa-cube',
        components: {
            text: {
                name: '文本',
                icon: 'fa-font',
                description: '普通文本内容',
                fields: [
                    { name: 'content', label: '文本内容', type: 'richtext', default: '请输入文本内容' },
                    { name: 'align', label: '对齐方式', type: 'select', options: ['left', 'center', 'right'], default: 'left' },
                    { name: 'color', label: '文字颜色', type: 'color', default: '#333333' },
                    { name: 'fontSize', label: '字体大小', type: 'select', options: ['14px', '16px', '18px', '20px', '24px', '28px', '32px'], default: '16px' }
                ]
            },
            image: {
                name: '图片',
                icon: 'fa-image',
                description: '单张图片展示',
                fields: [
                    { name: 'src', label: '图片地址', type: 'image', default: '' },
                    { name: 'alt', label: '替代文本', type: 'text', default: '' },
                    { name: 'width', label: '宽度', type: 'text', default: '100%' },
                    { name: 'height', label: '高度', type: 'text', default: 'auto' },
                    { name: 'align', label: '对齐方式', type: 'select', options: ['left', 'center', 'right'], default: 'center' },
                    { name: 'link', label: '链接地址', type: 'text', default: '' }
                ]
            },
            button: {
                name: '按钮',
                icon: 'fa-square',
                description: '可点击按钮',
                fields: [
                    { name: 'text', label: '按钮文字', type: 'text', default: '点击按钮' },
                    { name: 'link', label: '链接地址', type: 'text', default: '#' },
                    { name: 'type', label: '按钮样式', type: 'select', options: ['primary', 'secondary', 'success', 'danger', 'outline'], default: 'primary' },
                    { name: 'size', label: '按钮大小', type: 'select', options: ['small', 'medium', 'large'], default: 'medium' },
                    { name: 'align', label: '对齐方式', type: 'select', options: ['left', 'center', 'right'], default: 'center' },
                    { name: 'newWindow', label: '新窗口打开', type: 'checkbox', default: false }
                ]
            },
            imageText: {
                name: '图文展示',
                icon: 'fa-newspaper',
                description: '图片与文字并排展示',
                fields: [
                    { name: 'image', label: '图片', type: 'image', default: '' },
                    { name: 'title', label: '标题', type: 'text', default: '标题' },
                    { name: 'content', label: '内容', type: 'richtext', default: '请输入内容' },
                    { name: 'layout', label: '布局', type: 'select', options: ['image-left', 'image-right', 'image-top'], default: 'image-left' },
                    { name: 'imageWidth', label: '图片宽度', type: 'text', default: '40%' }
                ]
            },
            imageList: {
                name: '列表多图',
                icon: 'fa-images',
                description: '多张图片列表展示',
                fields: [
                    { name: 'images', label: '图片列表', type: 'imageList', default: [] },
                    { name: 'columns', label: '列数', type: 'select', options: ['2', '3', '4', '5'], default: '3' },
                    { name: 'gap', label: '间距', type: 'select', options: ['8px', '16px', '24px', '32px'], default: '16px' },
                    { name: 'showCaption', label: '显示标题', type: 'checkbox', default: false }
                ]
            },
            articleList: {
                name: '文章列表',
                icon: 'fa-list',
                description: '文章列表展示',
                fields: [
                    { name: 'category', label: '文章分类', type: 'select', options: [], default: 'all' },
                    { name: 'limit', label: '显示数量', type: 'select', options: ['3', '5', '6', '8', '10'], default: '6' },
                    { name: 'showImage', label: '显示图片', type: 'checkbox', default: true },
                    { name: 'showDate', label: '显示日期', type: 'checkbox', default: true },
                    { name: 'showSummary', label: '显示摘要', type: 'checkbox', default: true },
                    { name: 'layout', label: '布局', type: 'select', options: ['card', 'list'], default: 'card' }
                ]
            },
            carousel: {
                name: '轮播多图',
                icon: 'fa-sliders-h',
                description: '图片轮播展示',
                fields: [
                    { name: 'images', label: '轮播图片', type: 'imageList', default: [] },
                    { name: 'height', label: '高度', type: 'text', default: '400px' },
                    { name: 'autoplay', label: '自动播放', type: 'checkbox', default: true },
                    { name: 'interval', label: '切换间隔(秒)', type: 'select', options: ['3', '5', '7', '10'], default: '5' },
                    { name: 'showDots', label: '显示指示点', type: 'checkbox', default: true },
                    { name: 'showArrows', label: '显示箭头', type: 'checkbox', default: true }
                ]
            },
            video: {
                name: '在线视频',
                icon: 'fa-video',
                description: '嵌入在线视频',
                fields: [
                    { name: 'type', label: '视频来源', type: 'select', options: ['url', 'embed'], default: 'url' },
                    { name: 'url', label: '视频地址', type: 'text', default: '' },
                    { name: 'embed', label: '嵌入代码', type: 'textarea', default: '' },
                    { name: 'width', label: '宽度', type: 'text', default: '100%' },
                    { name: 'height', label: '高度', type: 'text', default: '400px' },
                    { name: 'autoplay', label: '自动播放', type: 'checkbox', default: false },
                    { name: 'controls', label: '显示控制条', type: 'checkbox', default: true }
                ]
            }
        }
    },
    
    // 排版组件
    layout: {
        name: '排版组件',
        icon: 'fa-th-large',
        components: {
            container: {
                name: '自由容器',
                icon: 'fa-square-o',
                description: '自由布局容器',
                fields: [
                    { name: 'width', label: '宽度', type: 'select', options: ['100%', '90%', '80%', '1200px', '1000px', '800px'], default: '100%' },
                    { name: 'padding', label: '内边距', type: 'select', options: ['0', '16px', '24px', '32px', '48px', '64px'], default: '24px' },
                    { name: 'bgColor', label: '背景颜色', type: 'color', default: '#ffffff' },
                    { name: 'bgImage', label: '背景图片', type: 'image', default: '' },
                    { name: 'borderRadius', label: '圆角', type: 'select', options: ['0', '4px', '8px', '12px', '16px', '24px'], default: '0' }
                ],
                allowChildren: true
            },
            floating: {
                name: '悬浮容器',
                icon: 'fa-clone',
                description: '悬浮在页面上的容器',
                fields: [
                    { name: 'position', label: '位置', type: 'select', options: ['top-left', 'top-right', 'bottom-left', 'bottom-right'], default: 'bottom-right' },
                    { name: 'offsetX', label: '水平偏移', type: 'text', default: '20px' },
                    { name: 'offsetY', label: '垂直偏移', type: 'text', default: '20px' },
                    { name: 'width', label: '宽度', type: 'text', default: '300px' },
                    { name: 'bgColor', label: '背景颜色', type: 'color', default: '#ffffff' },
                    { name: 'shadow', label: '阴影', type: 'checkbox', default: true }
                ],
                allowChildren: true
            },
            tabs: {
                name: '横向标签',
                icon: 'fa-folder',
                description: '横向标签切换',
                fields: [
                    { name: 'tabs', label: '标签页', type: 'tabList', default: [{title: '标签1', content: ''}, {title: '标签2', content: ''}] },
                    { name: 'activeColor', label: '激活颜色', type: 'color', default: '#3b82f6' },
                    { name: 'tabPosition', label: '标签位置', type: 'select', options: ['top', 'bottom'], default: 'top' }
                ]
            },
            tabsVertical: {
                name: '纵向标签',
                icon: 'fa-columns',
                description: '纵向标签切换',
                fields: [
                    { name: 'tabs', label: '标签页', type: 'tabList', default: [{title: '标签1', content: ''}, {title: '标签2', content: ''}] },
                    { name: 'activeColor', label: '激活颜色', type: 'color', default: '#3b82f6' },
                    { name: 'tabWidth', label: '标签宽度', type: 'text', default: '150px' }
                ]
            },
            columns: {
                name: '多列排版',
                icon: 'fa-th',
                description: '多列内容排版',
                fields: [
                    { name: 'columns', label: '列数', type: 'select', options: ['2', '3', '4', '5'], default: '2' },
                    { name: 'gap', label: '列间距', type: 'select', options: ['16px', '24px', '32px', '48px'], default: '24px' },
                    { name: 'equalHeight', label: '等高列', type: 'checkbox', default: true }
                ],
                allowChildren: true
            },
            imageTabs: {
                name: '图片标签',
                icon: 'fa-images',
                description: '带图片的标签切换',
                fields: [
                    { name: 'tabs', label: '标签页', type: 'imageTabList', default: [] },
                    { name: 'imagePosition', label: '图片位置', type: 'select', options: ['top', 'left'], default: 'top' }
                ]
            },
            collapse: {
                name: '折叠标签',
                icon: 'fa-compress',
                description: '可折叠的内容区域',
                fields: [
                    { name: 'items', label: '折叠项', type: 'collapseList', default: [{title: '标题1', content: ''}] },
                    { name: 'accordion', label: '手风琴模式', type: 'checkbox', default: false },
                    { name: 'bordered', label: '显示边框', type: 'checkbox', default: true }
                ]
            },
            accordion: {
                name: '手风琴',
                icon: 'fa-bars',
                description: '手风琴式折叠面板',
                fields: [
                    { name: 'items', label: '面板项', type: 'collapseList', default: [{title: '标题1', content: ''}] },
                    { name: 'iconPosition', label: '图标位置', type: 'select', options: ['left', 'right'], default: 'right' },
                    { name: 'expandFirst', label: '默认展开第一项', type: 'checkbox', default: true }
                ]
            },
            fullWidth: {
                name: '通栏排版',
                icon: 'fa-arrows-alt-h',
                description: '全宽通栏布局',
                fields: [
                    { name: 'bgColor', label: '背景颜色', type: 'color', default: '#f5f7fa' },
                    { name: 'bgImage', label: '背景图片', type: 'image', default: '' },
                    { name: 'padding', label: '内边距', type: 'select', options: ['32px', '48px', '64px', '80px', '100px'], default: '64px' },
                    { name: 'contentWidth', label: '内容宽度', type: 'select', options: ['100%', '90%', '1200px', '1000px'], default: '1200px' }
                ],
                allowChildren: true
            }
        }
    },
    
    // 互动组件
    interactive: {
        name: '互动组件',
        icon: 'fa-hand-pointer',
        components: {
            chat: {
                name: '在线客服',
                icon: 'fa-comments',
                description: '在线客服悬浮按钮',
                fields: [
                    { name: 'type', label: '客服类型', type: 'select', options: ['phone', 'wechat', 'qq', 'custom'], default: 'phone' },
                    { name: 'phone', label: '电话号码', type: 'text', default: '' },
                    { name: 'wechat', label: '微信号', type: 'text', default: '' },
                    { name: 'qq', label: 'QQ号', type: 'text', default: '' },
                    { name: 'qrCode', label: '二维码图片', type: 'image', default: '' },
                    { name: 'position', label: '位置', type: 'select', options: ['left', 'right'], default: 'right' },
                    { name: 'text', label: '按钮文字', type: 'text', default: '在线咨询' }
                ]
            },
            form: {
                name: '在线表单',
                icon: 'fa-wpforms',
                description: '自定义表单',
                fields: [
                    { name: 'title', label: '表单标题', type: 'text', default: '在线留言' },
                    { name: 'fields', label: '表单字段', type: 'formFields', default: [
                        {name: 'name', label: '姓名', type: 'text', required: true},
                        {name: 'phone', label: '电话', type: 'text', required: true}
                    ]},
                    { name: 'submitText', label: '提交按钮文字', type: 'text', default: '提交' },
                    { name: 'successMessage', label: '提交成功提示', type: 'text', default: '提交成功，我们会尽快联系您！' }
                ]
            },
            message: {
                name: '留言提交',
                icon: 'fa-envelope',
                description: '简单留言表单',
                fields: [
                    { name: 'title', label: '标题', type: 'text', default: '留言咨询' },
                    { name: 'subtitle', label: '副标题', type: 'text', default: '请填写以下信息，我们会尽快回复您' },
                    { name: 'fields', label: '显示字段', type: 'checkboxGroup', options: ['name', 'phone', 'email', 'company', 'content'], default: ['name', 'phone', 'content'] },
                    { name: 'submitText', label: '提交按钮', type: 'text', default: '提交留言' }
                ]
            },
            qrcode: {
                name: '二维码',
                icon: 'fa-qrcode',
                description: '展示二维码',
                fields: [
                    { name: 'image', label: '二维码图片', type: 'image', default: '' },
                    { name: 'title', label: '标题', type: 'text', default: '扫码关注' },
                    { name: 'description', label: '描述', type: 'textarea', default: '' },
                    { name: 'align', label: '对齐方式', type: 'select', options: ['left', 'center', 'right'], default: 'center' },
                    { name: 'size', label: '尺寸', type: 'select', options: ['120px', '150px', '180px', '200px'], default: '150px' }
                ]
            },
            search: {
                name: '全站搜索',
                icon: 'fa-search',
                description: '站内搜索框',
                fields: [
                    { name: 'placeholder', label: '占位文字', type: 'text', default: '请输入搜索关键词' },
                    { name: 'buttonText', label: '按钮文字', type: 'text', default: '搜索' },
                    { name: 'width', label: '宽度', type: 'text', default: '100%' },
                    { name: 'style', label: '样式', type: 'select', options: ['default', 'rounded', 'minimal'], default: 'default' }
                ]
            },
            share: {
                name: '分享网站',
                icon: 'fa-share-alt',
                description: '社交分享按钮',
                fields: [
                    { name: 'platforms', label: '分享平台', type: 'checkboxGroup', options: ['wechat', 'weibo', 'qq', 'qzone', 'link'], default: ['wechat', 'weibo', 'qq'] },
                    { name: 'align', label: '对齐方式', type: 'select', options: ['left', 'center', 'right'], default: 'center' },
                    { name: 'showText', label: '显示文字', type: 'checkbox', default: true }
                ]
            },
            login: {
                name: '会员登录',
                icon: 'fa-user',
                description: '会员登录框',
                fields: [
                    { name: 'title', label: '标题', type: 'text', default: '会员登录' },
                    { name: 'showRegister', label: '显示注册链接', type: 'checkbox', default: true },
                    { name: 'showForgot', label: '显示忘记密码', type: 'checkbox', default: true },
                    { name: 'redirect', label: '登录后跳转', type: 'text', default: '' }
                ]
            },
            vote: {
                name: '在线投票',
                icon: 'fa-poll',
                description: '在线投票组件',
                fields: [
                    { name: 'title', label: '投票标题', type: 'text', default: '您对我们的服务满意吗？' },
                    { name: 'options', label: '选项', type: 'voteOptions', default: [{text: '非常满意'}, {text: '满意'}, {text: '一般'}] },
                    { name: 'multiple', label: '多选', type: 'checkbox', default: false },
                    { name: 'showResult', label: '显示结果', type: 'checkbox', default: true }
                ]
            }
        }
    }
};

// 导出配置
if (typeof module !== 'undefined' && module.exports) {
    module.exports = ComponentConfig;
}
