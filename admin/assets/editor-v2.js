/**
 * CMS可视化编辑器核心 v2.0
 * Yao资金网网站内容管理系统 - 升级版
 * 
 * 功能特性：
 * 1. 新增/删除页面功能
 * 2. 元素级编辑（文本、图片、链接、样式）
 * 3. 图片上传/替换功能
 * 4. 富文本编辑器修复
 * 5. 实时预览
 */

// 获取URL参数
const urlParams = new URLSearchParams(window.location.search);
const pageId = urlParams.get('page');

// 页面配置
const pageConfigs = {
    index: {
        name: '首页',
        file: 'index.html',
        fields: [
            { section: 'hero', title: 'Hero区域', icon: 'fa-home', fields: [
                { name: 'heroTitle', label: '主标题', type: 'text', required: true },
                { name: 'heroSubtitle', label: '副标题', type: 'textarea' },
                { name: 'heroButtonText', label: '按钮文字', type: 'text' },
                { name: 'heroButtonLink', label: '按钮链接', type: 'text' }
            ]},
            { section: 'stats', title: '统计数据', icon: 'fa-chart-bar', fields: [
                { name: 'stat1Number', label: '统计1-数字', type: 'text' },
                { name: 'stat1Label', label: '统计1-标签', type: 'text' },
                { name: 'stat2Number', label: '统计2-数字', type: 'text' },
                { name: 'stat2Label', label: '统计2-标签', type: 'text' },
                { name: 'stat3Number', label: '统计3-数字', type: 'text' },
                { name: 'stat3Label', label: '统计3-标签', type: 'text' },
                { name: 'stat4Number', label: '统计4-数字', type: 'text' },
                { name: 'stat4Label', label: '统计4-标签', type: 'text' }
            ]},
            { section: 'services', title: '服务介绍', icon: 'fa-briefcase', fields: [
                { name: 'servicesTitle', label: '区域标题', type: 'text' },
                { name: 'servicesSubtitle', label: '区域副标题', type: 'textarea' },
                { name: 'service1Title', label: '服务1-标题', type: 'text' },
                { name: 'service1Content', label: '服务1-内容', type: 'richtext' },
                { name: 'service2Title', label: '服务2-标题', type: 'text' },
                { name: 'service2Content', label: '服务2-内容', type: 'richtext' },
                { name: 'service3Title', label: '服务3-标题', type: 'text' },
                { name: 'service3Content', label: '服务3-内容', type: 'richtext' },
                { name: 'service4Title', label: '服务4-标题', type: 'text' },
                { name: 'service4Content', label: '服务4-内容', type: 'richtext' }
            ]},
            { section: 'cases', title: '成功案例', icon: 'fa-trophy', fields: [
                { name: 'casesTitle', label: '区域标题', type: 'text' },
                { name: 'casesSubtitle', label: '区域副标题', type: 'textarea' }
            ]},
            { section: 'advantages', title: '服务优势', icon: 'fa-star', fields: [
                { name: 'advantagesTitle', label: '区域标题', type: 'text' },
                { name: 'advantagesSubtitle', label: '区域副标题', type: 'textarea' }
            ]},
            { section: 'faq', title: '常见问题', icon: 'fa-question-circle', fields: [
                { name: 'faqTitle', label: '区域标题', type: 'text' },
                { name: 'faqSubtitle', label: '区域副标题', type: 'textarea' }
            ]}
        ]
    },
    faq: {
        name: '常见问题',
        file: 'faq.html',
        fields: [
            { section: 'header', title: '页面头部', icon: 'fa-heading', fields: [
                { name: 'pageTitle', label: '页面标题', type: 'text', required: true },
                { name: 'pageSubtitle', label: '页面副标题', type: 'textarea' }
            ]},
            { section: 'faq', title: 'FAQ内容', icon: 'fa-question-circle', fields: [
                { name: 'faqTitle', label: 'FAQ区域标题', type: 'text' },
                { name: 'faqSubtitle', label: 'FAQ区域副标题', type: 'textarea' }
            ]}
        ]
    },
    news: {
        name: '行业资讯',
        file: 'news.html',
        fields: [
            { section: 'header', title: '页面头部', icon: 'fa-heading', fields: [
                { name: 'pageTitle', label: '页面标题', type: 'text', required: true },
                { name: 'pageSubtitle', label: '页面副标题', type: 'textarea' }
            ]},
            { section: 'content', title: '资讯列表', icon: 'fa-newspaper', fields: [
                { name: 'newsTitle', label: '列表标题', type: 'text' },
                { name: 'newsSubtitle', label: '列表副标题', type: 'textarea' }
            ]}
        ]
    },
    services: {
        name: '业务范围',
        file: 'services.html',
        fields: [
            { section: 'header', title: '页面头部', icon: 'fa-heading', fields: [
                { name: 'pageTitle', label: '页面标题', type: 'text', required: true },
                { name: 'pageSubtitle', label: '页面副标题', type: 'textarea' }
            ]},
            { section: 'listed', title: '上市公司类', icon: 'fa-chart-line', fields: [
                { name: 'listedTitle', label: '标题', type: 'text' },
                { name: 'listedContent', label: '内容', type: 'richtext' },
                { name: 'listedImage', label: '图片URL', type: 'image' }
            ]},
            { section: 'baizhang', title: '企业/个人摆账', icon: 'fa-hand-holding-usd', fields: [
                { name: 'baizhangTitle', label: '标题', type: 'text' },
                { name: 'baizhangContent', label: '内容', type: 'richtext' },
                { name: 'baizhangImage', label: '图片URL', type: 'image' }
            ]},
            { section: 'deposit', title: '银行存款类', icon: 'fa-university', fields: [
                { name: 'depositTitle', label: '标题', type: 'text' },
                { name: 'depositContent', label: '内容', type: 'richtext' },
                { name: 'depositImage', label: '图片URL', type: 'image' }
            ]},
            { section: 'receivable', title: '应收账款融资', icon: 'fa-file-invoice-dollar', fields: [
                { name: 'receivableTitle', label: '标题', type: 'text' },
                { name: 'receivableContent', label: '内容', type: 'richtext' },
                { name: 'receivableImage', label: '图片URL', type: 'image' }
            ]}
        ]
    },
    cases: {
        name: '成功案例',
        file: 'cases.html',
        fields: [
            { section: 'header', title: '页面头部', icon: 'fa-heading', fields: [
                { name: 'pageTitle', label: '页面标题', type: 'text', required: true },
                { name: 'pageSubtitle', label: '页面副标题', type: 'textarea' }
            ]},
            { section: 'stats', title: '案例统计', icon: 'fa-chart-bar', fields: [
                { name: 'statClients', label: '服务企业数', type: 'text' },
                { name: 'statAmount', label: '管理资金规模', type: 'text' },
                { name: 'statSuccess', label: '成功率', type: 'text' },
                { name: 'statSatisfaction', label: '客户满意度', type: 'text' }
            ]}
        ]
    },
    contact: {
        name: '联系我们',
        file: 'contact.html',
        fields: [
            { section: 'header', title: '页面头部', icon: 'fa-heading', fields: [
                { name: 'pageTitle', label: '页面标题', type: 'text', required: true },
                { name: 'pageSubtitle', label: '页面副标题', type: 'textarea' }
            ]},
            { section: 'contact', title: '联系信息', icon: 'fa-phone', fields: [
                { name: 'contactPhone', label: '联系电话', type: 'text' },
                { name: 'contactName', label: '联系人', type: 'text' },
                { name: 'contactEmail', label: '电子邮箱', type: 'text' },
                { name: 'contactAddress', label: '公司地址', type: 'textarea' }
            ]},
            { section: 'hours', title: '工作时间', icon: 'fa-clock', fields: [
                { name: 'workHours', label: '工作时间', type: 'textarea' }
            ]}
        ]
    }
};


    advantages: {
        name: '优势介绍',
        file: 'advantages.html',
        fields: [
            { section: 'header', title: '页面头部', icon: 'fa-heading', fields: [
                { name: 'pageTitle', label: '页面标题', type: 'text', required: true },
                { name: 'pageSubtitle', label: '页面副标题', type: 'textarea' }
            ]},
            { section: 'content', title: '优势内容', icon: 'fa-star', fields: [
                { name: 'advantage1Title', label: '优势1-标题', type: 'text' },
                { name: 'advantage1Content', label: '优势1-内容', type: 'richtext' },
                { name: 'advantage2Title', label: '优势2-标题', type: 'text' },
                { name: 'advantage2Content', label: '优势2-内容', type: 'richtext' },
                { name: 'advantage3Title', label: '优势3-标题', type: 'text' },
                { name: 'advantage3Content', label: '优势3-内容', type: 'richtext' },
                { name: 'advantage4Title', label: '优势4-标题', type: 'text' },
                { name: 'advantage4Content', label: '优势4-内容', type: 'richtext' }
            ]}
        ]
    },
    privacy: {
        name: '隐私政策',
        file: 'privacy.html',
        fields: [
            { section: 'header', title: '页面头部', icon: 'fa-heading', fields: [
                { name: 'pageTitle', label: '页面标题', type: 'text', required: true },
                { name: 'pageSubtitle', label: '页面副标题', type: 'textarea' }
            ]},
            { section: 'content', title: '隐私内容', icon: 'fa-shield-alt', fields: [
                { name: 'content', label: '隐私政策内容', type: 'richtext' }
            ]}
        ]
    },
    compliance: {
        name: '合规声明',
        file: 'compliance.html',
        fields: [
            { section: 'header', title: '页面头部', icon: 'fa-heading', fields: [
                { name: 'pageTitle', label: '页面标题', type: 'text', required: true },
                { name: 'pageSubtitle', label: '页面副标题', type: 'textarea' }
            ]},
            { section: 'content', title: '合规内容', icon: 'fa-balance-scale', fields: [
                { name: 'content', label: '合规声明内容', type: 'richtext' }
            ]}
        ]
    },
    sitemap: {
        name: '网站地图',
        file: 'sitemap.html',
        fields: [
            { section: 'header', title: '页面头部', icon: 'fa-heading', fields: [
                { name: 'pageTitle', label: '页面标题', type: 'text', required: true },
                { name: 'pageSubtitle', label: '页面副标题', type: 'textarea' }
            ]}
        ]
    }
};

//// 默认数据
const defaultData = {
    index: {
        heroTitle: '专业资金解决方案\n助力企业稳健发展',
        heroSubtitle: '提供上市公司短拆、企业摆账、银行存款、应收账款融资等全方位资金服务，以专业实力和丰富经验，为您的企业发展保驾护航。',
        heroButtonText: '立即咨询',
        heroButtonLink: 'contact.html',
        stat1Number: '10',
        stat1Label: '年行业经验',
        stat2Number: '500',
        stat2Label: '服务企业',
        stat3Number: '100',
        stat3Label: '亿资金规模',
        stat4Number: '99',
        stat4Label: '%客户满意度',
        servicesTitle: '核心业务领域',
        servicesSubtitle: '涵盖上市公司、企业摆账、银行存款、应收账款融资等全方位资金服务',
        service1Title: '上市公司类',
        service1Content: '<ul><li>短拆、股票解质押过桥</li><li>募集账户归还过桥、产业基金备案过桥</li><li>股票质押、定增、协议转让、代持</li><li>财务报表优化、降负债</li></ul>',
        service2Title: '企业/个人摆账',
        service2Content: '<ul><li>长短期定存摆账、云信票据实摆</li><li>过账实趴、抵押类资金过桥</li><li>实缴验资、资金证明、银行保函</li><li>贸易增量、显账亮资</li></ul>',
        service3Title: '银行存款类',
        service3Content: '<ul><li>时点冲量、日均业务</li><li>月末冲量</li><li>一年期定期存款</li><li>三年期定期存款</li></ul>',
        service4Title: '应收账款融资',
        service4Content: '<ul><li>置换云信票据</li><li>可拆分流转支付</li><li>融资贴现、准入宽松</li><li>不看征信、包容执行诉讼主体</li></ul>',
        casesTitle: '成功案例',
        casesSubtitle: '多年来，我们已成功服务数百家企业，累计管理资金规模超百亿',
        advantagesTitle: '服务优势',
        advantagesSubtitle: '专业、高效、安全',
        faqTitle: '常见问题',
        faqSubtitle: '解答您关于资金业务的常见疑问'
    },
    services: {
        pageTitle: '业务范围',
        pageSubtitle: '专业资金服务，助力企业发展',
        listedTitle: '上市公司类',
        listedContent: '<p>为上市公司提供全方位的资金解决方案，包括短拆、股票解质押过桥、募集账户归还过桥等服务。</p>',
        listedImage: 'images/service-listed.jpg',
        baizhangTitle: '企业/个人摆账',
        baizhangContent: '<p>提供长短期定存摆账、云信票据实摆、过账实趴等服务，满足企业各类资金展示需求。</p>',
        baizhangImage: 'images/service-baizhang.jpg',
        depositTitle: '银行存款类',
        depositContent: '<p>提供时点冲量、日均业务、月末冲量、定期存款等服务，帮助企业优化财务报表。</p>',
        depositImage: 'images/service-deposit.jpg',
        receivableTitle: '应收账款融资',
        receivableContent: '<p>通过置换云信票据、融资贴现等方式，帮助企业盘活应收账款，解决资金周转问题。</p>',
        receivableImage: 'images/service-receivable.jpg'
    },
    cases: {
        pageTitle: '成功案例',
        pageSubtitle: '多年行业经验，服务数百家企业',
        statClients: '500+',
        statAmount: '100亿',
        statSuccess: '98%',
        statSatisfaction: '99%'
    },
    contact: {
        pageTitle: '联系我们',
        pageSubtitle: '专业团队，随时为您服务',
        contactPhone: '13552883008',
        contactName: '王总',
        contactEmail: 'wanglizhongguo@126.com',
        contactAddress: '北京市朝阳区金融街88号',
        workHours: '周一至周五：9:00 - 18:00\n周六：9:00 - 12:00\n周日及节假日休息'
    },
    faq: {
        pageTitle: '常见问题',
        pageSubtitle: '解答您关于资金业务的常见疑问',
        faqTitle: '常见问题',
        faqSubtitle: '我们整理了客户最常问的问题，希望能帮助您更好地了解我们的服务'
    },
    news: {
        pageTitle: '行业资讯',
        pageSubtitle: '了解最新金融动态与行业资讯',
        newsTitle: '行业资讯',
        newsSubtitle: '为您提供最新的金融行业动态、政策解读和市场分析'
    }
};

let currentData = {};
let isDirty = false;
let tinymceEditors = [];
let selectedElement = null;
let currentEditMode = null;

// 操作历史栈（用于撤回/重做功能）
let undoStack = [];
let redoStack = [];
const MAX_HISTORY_SIZE = 50; // 最大历史记录数量

// 初始化
document.addEventListener('DOMContentLoaded', function() {
    if (!pageId || !pageConfigs[pageId]) {
        alert('页面参数错误');
        window.location.href = 'index.html';
        return;
    }

    // 检查登录
    if (localStorage.getItem('cms_logged_in') !== 'true') {
        window.location.href = 'login.html';
        return;
    }

    // 设置页面标题
    const config = pageConfigs[pageId];
    document.getElementById('pageTitle').textContent = `编辑${config.name}`;
    document.getElementById('viewPageBtn').href = `../${config.file}`;

    // 加载数据
    loadData();

    // 渲染表单
    renderForm();

    // 初始化预览
    initPreview();

    // 加载图片库
    loadImageLibrary();
});

// 加载数据
function loadData() {
    const saved = localStorage.getItem(`cms_data_${pageId}`);
    if (saved) {
        currentData = JSON.parse(saved);
    } else {
        currentData = { ...defaultData[pageId] };
    }
}

// 渲染表单
function renderForm() {
    const config = pageConfigs[pageId];
    const container = document.getElementById('editForm');
    
    let html = '';
    config.fields.forEach((section, index) => {
        html += `
            <div class="section-block">
                <div class="section-header">
                    <h4 class="section-title">
                        <i class="fas ${section.icon}"></i>
                        ${section.title}
                    </h4>
                    <button class="section-toggle" onclick="toggleSection(this)">
                        <i class="fas fa-chevron-up"></i>
                    </button>
                </div>
                <div class="section-content">
        `;

        section.fields.forEach(field => {
            const value = currentData[field.name] || '';
            html += renderField(field, value);
        });

        html += '</div></div>';
    });

    container.innerHTML = html;

    // 初始化富文本编辑器
    initRichTextEditors();

    // 绑定输入事件
    bindInputEvents();
}

// 渲染字段
function renderField(field, value) {
    const required = field.required ? '<span class="required">*</span>' : '';
    
    switch(field.type) {
        case 'textarea':
            return `
                <div class="form-group">
                    <label class="form-label">${field.label}${required}</label>
                    <textarea class="form-textarea" name="${field.name}" rows="3">${escapeHtml(value)}</textarea>
                </div>
            `;
        case 'richtext':
            return `
                <div class="form-group">
                    <label class="form-label">${field.label}${required}</label>
                    <textarea class="form-richtext" id="editor_${field.name}" name="${field.name}" rows="6">${value}</textarea>
                </div>
            `;
        case 'image':
            return `
                <div class="form-group">
                    <label class="form-label">${field.label}${required}</label>
                    <input type="text" class="form-input" name="${field.name}" value="${escapeHtml(value)}" placeholder="图片URL">
                    <div class="image-upload-area" onclick="openImageLibraryForField('${field.name}')" style="margin-top: 8px;">
                        <i class="fas fa-image"></i>
                        <p>点击选择图片</p>
                        ${value ? `<img src="${value}" class="image-preview" onerror="this.style.display='none'">` : ''}
                    </div>
                </div>
            `;
        default:
            return `
                <div class="form-group">
                    <label class="form-label">${field.label}${required}</label>
                    <input type="text" class="form-input" name="${field.name}" value="${escapeHtml(value)}">
                </div>
            `;
    }
}

// 初始化富文本编辑器
function initRichTextEditors() {
    // 销毁之前的编辑器实例
    tinymceEditors.forEach(editor => {
        if (editor && !editor.removed) {
            editor.remove();
        }
    });
    tinymceEditors = [];

    // 初始化新的编辑器
    document.querySelectorAll('.form-richtext').forEach(textarea => {
        tinymce.init({
            selector: `#${textarea.id}`,
            plugins: 'lists link image code table fontsize fontfamily',
            toolbar: 'undo redo | formatselect | fontfamily fontsize | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist | forecolor backcolor | link image | code',
            menubar: false,
            height: 250,
            branding: false,
            promotion: false,
            language: 'zh_CN',
            
            // 字体大小选项
            fontsize_formats: '12px 14px 16px 18px 20px 24px 28px 32px 36px 48px',
            
            // 字体选项
            font_family_formats: '宋体=simsun;微软雅黑=microsoft yahei;黑体=simhei;楷体=kaiti;Arial=arial;',
            
            setup: function(editor) {
                tinymceEditors.push(editor);
                
                // 在编辑器获得焦点时保存状态（用于撤回）
                editor.on('focus', function() {
                    saveStateToHistory();
                });
                
                editor.on('change input NodeChange', function() {
                    markDirty();
                });
            }
        });
    });
}

// 绑定输入事件
function bindInputEvents() {
    document.querySelectorAll('.form-input, .form-textarea').forEach(input => {
        // 在输入前保存状态（用于撤回）
        input.addEventListener('focus', function() {
            // 保存当前状态到历史栈
            saveStateToHistory();
        });
        input.addEventListener('input', markDirty);
    });
}

// 标记有未保存更改
function markDirty() {
    isDirty = true;
    document.getElementById('saveStatus').className = 'status unsaved';
    document.getElementById('saveStatus').innerHTML = '<i class="fas fa-circle"></i><span>有未保存的更改</span>';
}

// 保存当前状态到历史栈（用于撤回功能）
function saveStateToHistory() {
    const state = {
        data: JSON.parse(JSON.stringify(currentData)),
        timestamp: new Date().getTime()
    };
    
    // 如果栈已满，移除最旧的状态
    if (undoStack.length >= MAX_HISTORY_SIZE) {
        undoStack.shift();
    }
    
    undoStack.push(state);
    
    // 清空重做栈（新操作后重做栈失效）
    redoStack = [];
    
    // 更新按钮状态
    updateUndoRedoButtons();
}

// 撤回上一步操作
function undo() {
    if (undoStack.length === 0) return;
    
    // 将当前状态保存到重做栈
    const currentState = {
        data: JSON.parse(JSON.stringify(currentData)),
        timestamp: new Date().getTime()
    };
    redoStack.push(currentState);
    
    // 从历史栈弹出上一步状态并恢复
    const previousState = undoStack.pop();
    currentData = previousState.data;
    
    // 重新渲染表单
    renderForm();
    
    // 标记为有未保存更改
    markDirty();
    
    // 更新按钮状态
    updateUndoRedoButtons();
    
    showToast('已撤回上一步操作', 'success');
}

// 重做操作
function redo() {
    if (redoStack.length === 0) return;
    
    // 将当前状态保存到历史栈
    const currentState = {
        data: JSON.parse(JSON.stringify(currentData)),
        timestamp: new Date().getTime()
    };
    undoStack.push(currentState);
    
    // 从重做栈弹出状态并恢复
    const nextState = redoStack.pop();
    currentData = nextState.data;
    
    // 重新渲染表单
    renderForm();
    
    // 标记为有未保存更改
    markDirty();
    
    // 更新按钮状态
    updateUndoRedoButtons();
    
    showToast('已重做操作', 'success');
}

// 更新撤回/重做按钮状态
function updateUndoRedoButtons() {
    const undoBtn = document.getElementById('undoBtn');
    const redoBtn = document.getElementById('redoBtn');
    
    if (undoBtn) {
        undoBtn.disabled = undoStack.length === 0;
    }
    if (redoBtn) {
        redoBtn.disabled = redoStack.length === 0;
    }
}

// 标记已保存
function markSaved() {
    isDirty = false;
    document.getElementById('saveStatus').className = 'status saved';
    document.getElementById('saveStatus').innerHTML = '<i class="fas fa-check-circle"></i><span>所有更改已保存</span>';
}

// 切换区块
function toggleSection(btn) {
    const content = btn.closest('.section-block').querySelector('.section-content');
    const icon = btn.querySelector('i');
    content.classList.toggle('collapsed');
    icon.classList.toggle('fa-chevron-up');
    icon.classList.toggle('fa-chevron-down');
}

// 收集表单数据
function collectData() {
    const data = { ...currentData };
    
    // 收集普通字段
    document.querySelectorAll('.form-input, .form-textarea').forEach(input => {
        data[input.name] = input.value;
    });

    // 收集富文本字段
    tinymceEditors.forEach(editor => {
        if (editor && !editor.removed) {
            const name = editor.getElement().name;
            data[name] = editor.getContent();
        }
    });

    return data;
}

// 保存数据
function saveData() {
    showLoading('正在保存...');
    
    const data = collectData();
    data.lastModified = new Date().toISOString();
    data.published = false;

    localStorage.setItem(`cms_data_${pageId}`, JSON.stringify(data));
    currentData = data;
    markSaved();
    
    hideLoading();
    showToast('保存成功', 'success');
    
    // 更新最后更新时间
    localStorage.setItem('cms_last_update', new Date().toISOString());
}

// 发布页面
function publishPage() {
    if (!confirm('确定要发布页面吗？这将更新网站上的实际内容。')) {
        return;
    }

    showLoading('正在发布...');
    
    // 先保存到本地
    saveData();
    
    // 收集数据
    const data = collectData();
    data.page = pageId;
    data.pageName = pageConfigs[pageId].name;
    data.published = true;
    data.publishedAt = new Date().toISOString();
    data.lastModified = new Date().toISOString();
    
    // 调用后端发布API
    fetch('api/publish.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            // 添加到已编辑页面列表
            const pagesIndex = JSON.parse(localStorage.getItem('cms_pages_index') || '[]');
            const config = pageConfigs[pageId];
            if (!pagesIndex.includes(config.file)) {
                pagesIndex.push(config.file);
                localStorage.setItem('cms_pages_index', JSON.stringify(pagesIndex));
            }

            hideLoading();
            showToast('页面发布成功！', 'success');
            
            // 刷新预览
            refreshPreview();
        } else {
            hideLoading();
            showToast('发布失败: ' + result.message, 'error');
        }
    })
    .catch(error => {
        hideLoading();
        console.error('发布错误:', error);
        showToast('发布失败: ' + error.message, 'error');
    });
}

// 加载默认数据
function loadDefaultData() {
    if (!confirm('确定要重置为默认数据吗？这将丢失所有自定义修改。')) {
        return;
    }

    // 保存当前状态到历史栈（用于撤回）
    saveStateToHistory();

    currentData = { ...defaultData[pageId] };
    renderForm();
    markDirty();
    showToast('已重置为默认数据', 'success');
}

// 取消编辑
function cancelEdit() {
    if (isDirty) {
        if (!confirm('有未保存的更改，确定要离开吗？')) {
            return;
        }
    }
    window.location.href = 'index.html';
}

// 初始化预览
function initPreview() {
    const config = pageConfigs[pageId];
    const frame = document.getElementById('previewFrame');
    frame.src = `../${config.file}`;
    
    // 监听iframe加载完成
    frame.onload = function() {
        setupPreviewInteraction();
    };
}

// 设置预览交互
function setupPreviewInteraction() {
    const frame = document.getElementById('previewFrame');
    const frameDoc = frame.contentDocument || frame.contentWindow.document;
    
    if (!frameDoc) return;
    
    // 为可编辑元素添加标记
    const editableSelectors = 'h1, h2, h3, h4, h5, h6, p, span, a, button, img, li, .service-v2-title, .service-v2-desc, .service-v2-list li';
    
    frameDoc.querySelectorAll(editableSelectors).forEach((el, index) => {
        // 跳过导航和页脚
        if (el.closest('nav') || el.closest('footer') || el.closest('.navbar') || el.closest('.footer')) {
            return;
        }
        
        el.classList.add('editable-element');
        el.setAttribute('data-element-id', `el_${index}`);
        el.setAttribute('data-element-type', el.tagName.toLowerCase());
        
        // 添加点击事件
        el.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            selectElement(this);
        });
    });
    
    // 添加样式
    const style = frameDoc.createElement('style');
    style.textContent = `
        .editable-element {
            position: relative;
            cursor: pointer;
            transition: all 0.2s;
        }
        .editable-element:hover {
            outline: 2px dashed #3b82f6;
            outline-offset: 4px;
        }
        .editable-element.selected {
            outline: 2px solid #3b82f6;
            outline-offset: 4px;
        }
        .editable-element::after {
            content: attr(data-element-type);
            position: absolute;
            top: -24px;
            left: 0;
            background: #3b82f6;
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 11px;
            opacity: 0;
            transition: opacity 0.2s;
            pointer-events: none;
            white-space: nowrap;
            z-index: 10000;
        }
        .editable-element:hover::after,
        .editable-element.selected::after {
            opacity: 1;
        }
    `;
    frameDoc.head.appendChild(style);
}

// 选择元素
function selectElement(element) {
    // 取消之前的选择
    deselectElement();
    
    selectedElement = element;
    element.classList.add('selected');
    
    // 显示元素工具栏
    showElementToolbar(element);
}

// 取消选择元素
function deselectElement() {
    if (selectedElement) {
        selectedElement.classList.remove('selected');
        selectedElement = null;
    }
    document.getElementById('elementToolbar').classList.remove('show');
}

// 显示元素工具栏
function showElementToolbar(element) {
    const toolbar = document.getElementById('elementToolbar');
    const frame = document.getElementById('previewFrame');
    const frameRect = frame.getBoundingClientRect();
    const elementRect = element.getBoundingClientRect();
    
    // 计算相对于视口的位置
    const top = frameRect.top + elementRect.top + window.scrollY;
    const left = frameRect.left + elementRect.right + 10;
    
    toolbar.style.top = `${top}px`;
    toolbar.style.left = `${left}px`;
    toolbar.classList.add('show');
}

// 编辑元素文本
function editElementText() {
    if (!selectedElement) return;
    
    currentEditMode = 'text';
    const currentText = selectedElement.textContent;
    
    document.getElementById('elementEditTitle').innerHTML = '<i class="fas fa-font" style="color: #3b82f6; margin-right: 8px;"></i>编辑文本';
    document.getElementById('elementEditBody').innerHTML = `
        <div class="form-group">
            <label class="form-label">文本内容</label>
            <textarea class="form-textarea" id="elementTextInput" rows="6">${escapeHtml(currentText)}</textarea>
        </div>
    `;
    
    document.getElementById('elementEditModal').classList.add('show');
}

// 编辑元素图片
function editElementImage() {
    if (!selectedElement) return;
    
    currentEditMode = 'image';
    const currentSrc = selectedElement.tagName.toLowerCase() === 'img' 
        ? selectedElement.src 
        : selectedElement.style.backgroundImage.replace(/url\(['"]?([^'"]*)['"]?\)/i, '$1');
    
    document.getElementById('elementEditTitle').innerHTML = '<i class="fas fa-image" style="color: #3b82f6; margin-right: 8px;"></i>更换图片';
    document.getElementById('elementEditBody').innerHTML = `
        <div class="form-group">
            <label class="form-label">图片URL</label>
            <input type="text" class="form-input" id="elementImageInput" value="${escapeHtml(currentSrc || '')}">
        </div>
        <div class="image-upload-area" onclick="openImageLibraryForElement()">
            <i class="fas fa-images"></i>
            <p>从图片库选择</p>
        </div>
        ${currentSrc ? `<img src="${currentSrc}" class="image-preview" onerror="this.style.display='none'">` : ''}
    `;
    
    document.getElementById('elementEditModal').classList.add('show');
}

// 编辑元素链接
function editElementLink() {
    if (!selectedElement) return;
    
    currentEditMode = 'link';
    const currentHref = selectedElement.tagName.toLowerCase() === 'a' 
        ? selectedElement.href 
        : '';
    
    document.getElementById('elementEditTitle').innerHTML = '<i class="fas fa-link" style="color: #3b82f6; margin-right: 8px;"></i>编辑链接';
    document.getElementById('elementEditBody').innerHTML = `
        <div class="form-group">
            <label class="form-label">链接地址</label>
            <input type="text" class="form-input" id="elementLinkInput" value="${escapeHtml(currentHref)}" placeholder="https://example.com">
        </div>
        <div class="form-group">
            <label class="form-label">打开方式</label>
            <select class="form-select" id="elementLinkTarget">
                <option value="_self">当前窗口</option>
                <option value="_blank">新窗口</option>
            </select>
        </div>
    `;
    
    document.getElementById('elementEditModal').classList.add('show');
}

// 编辑元素样式
function editElementStyle() {
    if (!selectedElement) return;
    
    currentEditMode = 'style';
    const computedStyle = window.getComputedStyle(selectedElement);
    
    document.getElementById('elementEditTitle').innerHTML = '<i class="fas fa-paint-brush" style="color: #3b82f6; margin-right: 8px;"></i>编辑样式';
    document.getElementById('elementEditBody').innerHTML = `
        <div class="form-group">
            <label class="form-label">文字颜色</label>
            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                <input type="color" class="form-input" id="elementColor" value="#000000" style="width: 60px; padding: 4px;">
                <input type="text" class="form-input" id="elementColorText" value="${rgbToHex(computedStyle.color)}" placeholder="#000000" style="flex: 1;">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">字体大小</label>
            <input type="text" class="form-input" id="elementFontSize" value="${computedStyle.fontSize}" placeholder="16px">
        </div>
        <div class="form-group">
            <label class="form-label">对齐方式</label>
            <select class="form-select" id="elementTextAlign">
                <option value="left" ${computedStyle.textAlign === 'left' ? 'selected' : ''}>左对齐</option>
                <option value="center" ${computedStyle.textAlign === 'center' ? 'selected' : ''}>居中</option>
                <option value="right" ${computedStyle.textAlign === 'right' ? 'selected' : ''}>右对齐</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">加粗</label>
            <select class="form-select" id="elementFontWeight">
                <option value="normal">正常</option>
                <option value="bold" ${computedStyle.fontWeight === 'bold' || parseInt(computedStyle.fontWeight) >= 700 ? 'selected' : ''}>加粗</option>
            </select>
        </div>
    `;
    
    document.getElementById('elementEditModal').classList.add('show');
}

// 删除元素
function deleteElement() {
    if (!selectedElement) return;
    
    if (!confirm('确定要删除这个元素吗？')) {
        return;
    }
    
    // 保存当前状态到历史栈（用于撤回）
    saveStateToHistory();
    
    selectedElement.remove();
    deselectElement();
    markDirty();
    showToast('元素已删除', 'success');
}

// 保存元素编辑
function saveElementEdit() {
    if (!selectedElement) return;
    
    // 保存当前状态到历史栈（用于撤回）
    saveStateToHistory();
    
    switch(currentEditMode) {
        case 'text':
            const newText = document.getElementById('elementTextInput').value;
            selectedElement.textContent = newText;
            break;
        case 'image':
            const newSrc = document.getElementById('elementImageInput').value;
            if (selectedElement.tagName.toLowerCase() === 'img') {
                selectedElement.src = newSrc;
            } else {
                selectedElement.style.backgroundImage = `url('${newSrc}')`;
            }
            break;
        case 'link':
            const newHref = document.getElementById('elementLinkInput').value;
            const newTarget = document.getElementById('elementLinkTarget').value;
            if (selectedElement.tagName.toLowerCase() === 'a') {
                selectedElement.href = newHref;
                selectedElement.target = newTarget;
            } else {
                // 将元素包裹在链接中
                const link = document.createElement('a');
                link.href = newHref;
                link.target = newTarget;
                selectedElement.parentNode.insertBefore(link, selectedElement);
                link.appendChild(selectedElement);
            }
            break;
        case 'style':
            const color = document.getElementById('elementColorText').value;
            const fontSize = document.getElementById('elementFontSize').value;
            const textAlign = document.getElementById('elementTextAlign').value;
            const fontWeight = document.getElementById('elementFontWeight').value;
            
            selectedElement.style.color = color;
            selectedElement.style.fontSize = fontSize;
            selectedElement.style.textAlign = textAlign;
            selectedElement.style.fontWeight = fontWeight;
            break;
    }
    
    closeElementEdit();
    markDirty();
    showToast('修改已应用', 'success');
}

// 关闭元素编辑
function closeElementEdit() {
    document.getElementById('elementEditModal').classList.remove('show');
    currentEditMode = null;
}

// 刷新预览
function refreshPreview() {
    const frame = document.getElementById('previewFrame');
    frame.src = frame.src;
    
    // 重新设置交互
    setTimeout(setupPreviewInteraction, 1000);
}

// 打开图片库
function openImageLibrary() {
    document.getElementById('imageLibraryModal').classList.add('show');
    loadImageLibrary();
}

// 关闭图片库
function closeImageLibrary() {
    document.getElementById('imageLibraryModal').classList.remove('show');
}

// 为字段打开图片库
let currentImageField = null;
let currentImageElement = null;

function openImageLibraryForField(fieldName) {
    currentImageField = fieldName;
    currentImageElement = null;
    openImageLibrary();
}

function openImageLibraryForElement() {
    currentImageField = null;
    currentImageElement = selectedElement;
    openImageLibrary();
}

// 加载图片库
function loadImageLibrary() {
    const container = document.getElementById('imageLibrary');
    const images = JSON.parse(localStorage.getItem('cms_image_library') || '[]');
    
    if (images.length === 0) {
        container.innerHTML = '<p style="text-align: center; color: #9ca3af; padding: 40px;">暂无图片，请先上传</p>';
        return;
    }
    
    container.innerHTML = images.map(img => `
        <div class="image-library-item" onclick="selectImage('${img.url}')">
            <img src="${img.url}" alt="${img.name}" loading="lazy">
        </div>
    `).join('');
}

// 选择图片
function selectImage(url) {
    // 保存当前状态到历史栈（用于撤回）
    saveStateToHistory();
    
    if (currentImageField) {
        // 更新表单字段
        const input = document.querySelector(`[name="${currentImageField}"]`);
        if (input) {
            input.value = url;
            markDirty();
            
            // 更新预览
            const previewArea = input.nextElementSibling;
            if (previewArea) {
                const existingPreview = previewArea.querySelector('.image-preview');
                if (existingPreview) {
                    existingPreview.src = url;
                    existingPreview.style.display = 'block';
                } else {
                    const img = document.createElement('img');
                    img.src = url;
                    img.className = 'image-preview';
                    previewArea.appendChild(img);
                }
            }
        }
    } else if (currentImageElement) {
        // 更新元素图片
        if (currentImageElement.tagName.toLowerCase() === 'img') {
            currentImageElement.src = url;
        } else {
            currentImageElement.style.backgroundImage = `url('${url}')`;
        }
        
        // 更新编辑框中的值
        const imageInput = document.getElementById('elementImageInput');
        if (imageInput) {
            imageInput.value = url;
        }
    }
    
    closeImageLibrary();
    showToast('图片已选择', 'success');
}

// 处理图片上传 - 使用服务器上传
function handleImageUpload(event) {
    const file = event.target.files[0];
    if (!file) return;
    
    // 验证文件类型
    const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!allowedTypes.includes(file.type)) {
        showToast('不支持的文件类型', 'error');
        return;
    }
    
    // 验证文件大小 (5MB)
    if (file.size > 5 * 1024 * 1024) {
        showToast('文件大小超过5MB限制', 'error');
        return;
    }
    
    // 显示上传中
    showLoading('正在上传图片...');
    
    // 创建 FormData
    const formData = new FormData();
    formData.append('image', file);
    
    // 上传到服务器
    fetch('api/case/upload.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        hideLoading();
        
        if (data.success) {
            const url = data.data.url;
            
            // 保存到图片库 (只存储URL，不存储Base64)
            const images = JSON.parse(localStorage.getItem('cms_image_library') || '[]');
            images.unshift({
                url: url,
                name: file.name,
                size: file.size,
                uploadedAt: new Date().toISOString()
            });
            localStorage.setItem('cms_image_library', JSON.stringify(images.slice(0, 50))); // 最多保存50张
            
            // 重新加载图片库
            loadImageLibrary();
            
            // 自动选择新上传的图片
            selectImage(url);
            
            showToast('图片上传成功', 'success');
        } else {
            showToast(data.message || '上传失败', 'error');
        }
    })
    .catch(error => {
        hideLoading();
        console.error('上传错误:', error);
        showToast('上传失败: ' + error.message, 'error');
    });
}

// 显示加载状态
function showLoading(text = '正在加载...') {
    document.querySelector('.loading-text').textContent = text;
    document.getElementById('loadingOverlay').classList.add('show');
}

// 隐藏加载状态
function hideLoading() {
    document.getElementById('loadingOverlay').classList.remove('show');
}

// 显示提示
function showToast(message, type = 'success') {
    const toast = document.getElementById('toast');
    const toastMessage = document.getElementById('toastMessage');
    
    toast.className = `toast ${type}`;
    toastMessage.textContent = message;
    
    const icon = toast.querySelector('i');
    icon.className = type === 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-circle';

    toast.classList.add('show');
    
    setTimeout(() => {
        toast.classList.remove('show');
    }, 3000);
}

// HTML转义
function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// RGB转Hex
function rgbToHex(rgb) {
    if (!rgb || rgb === 'rgba(0, 0, 0, 0)') return '#000000';
    if (rgb.startsWith('#')) return rgb;
    
    const rgbValues = rgb.match(/\d+/g);
    if (!rgbValues) return '#000000';
    
    return '#' + rgbValues.slice(0, 3).map(x => {
        const hex = parseInt(x).toString(16);
        return hex.length === 1 ? '0' + hex : hex;
    }).join('');
}

// 页面离开提示
window.addEventListener('beforeunload', function(e) {
    if (isDirty) {
        e.preventDefault();
        e.returnValue = '';
    }
});

// 键盘快捷键
document.addEventListener('keydown', function(e) {
    if (e.ctrlKey || e.metaKey) {
        switch(e.key) {
            case 's':
                e.preventDefault();
                saveData();
                break;
            case 'z':
                // Ctrl+Z 撤回
                if (!e.shiftKey) {
                    e.preventDefault();
                    undo();
                }
                break;
            case 'y':
                // Ctrl+Y 重做
                e.preventDefault();
                redo();
                break;
        }
        
        // Ctrl+Shift+Z 重做（另一种常见快捷键）
        if (e.key === 'z' && e.shiftKey) {
            e.preventDefault();
            redo();
        }
    }
    if (e.key === 'Escape') {
        closeImageLibrary();
        closeElementEdit();
        deselectElement();
    }
});
