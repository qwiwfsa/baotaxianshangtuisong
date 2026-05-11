/**
 * CMS图片上传服务器 (Node.js版本)
 * 替代PHP上传功能
 * 
 * 使用方法:
 * 1. 安装依赖: npm install express multer cors
 * 2. 启动服务器: node server.js
 * 3. 服务器运行在 http://localhost:3000
 */

const express = require('express');
const multer = require('multer');
const path = require('path');
const fs = require('fs');
const cors = require('cors');

const app = express();
const PORT = 3000;

// 启用CORS
app.use(cors({
    origin: '*',
    methods: ['GET', 'POST', 'OPTIONS'],
    allowedHeaders: ['Content-Type']
}));

// 确保上传目录存在
const uploadDir = path.join(__dirname, 'cms', 'uploads');
if (!fs.existsSync(uploadDir)) {
    fs.mkdirSync(uploadDir, { recursive: true });
}

// 配置multer存储
const storage = multer.diskStorage({
    destination: (req, file, cb) => {
        cb(null, uploadDir);
    },
    filename: (req, file, cb) => {
        // 生成唯一文件名: 日期_随机数.扩展名
        const dateStr = new Date().toISOString().slice(0, 10).replace(/-/g, '');
        const uniqueSuffix = Date.now() + '_' + Math.round(Math.random() * 1E9);
        const extension = path.extname(file.originalname);
        cb(null, `${dateStr}_${uniqueSuffix}${extension}`);
    }
});

// 配置multer
const upload = multer({ 
    storage: storage,
    limits: { 
        fileSize: 5 * 1024 * 1024 // 5MB
    },
    fileFilter: (req, file, cb) => {
        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (allowedTypes.includes(file.mimetype)) {
            cb(null, true);
        } else {
            cb(new Error('不支持的文件类型，只允许: image/jpeg, image/png, image/gif, image/webp'));
        }
    }
});

// 静态文件服务 - 提供上传的图片访问
app.use('/cms/uploads', express.static(uploadDir));

// 上传API
app.post('/api/upload', upload.single('image'), (req, res) => {
    try {
        if (!req.file) {
            return res.status(400).json({ 
                success: false, 
                message: '没有上传文件' 
            });
        }
        
        // 构建图片URL
        const url = `http://localhost:${PORT}/cms/uploads/${req.file.filename}`;
        
        res.json({
            success: true,
            message: '上传成功',
            data: {
                filename: req.file.filename,
                originalName: req.file.originalname,
                url: url,
                size: req.file.size,
                mimeType: req.file.mimetype
            }
        });
    } catch (error) {
        console.error('上传处理错误:', error);
        res.status(500).json({
            success: false,
            message: '服务器处理上传时出错: ' + error.message
        });
    }
});

// 错误处理中间件
app.use((error, req, res, next) => {
    if (error instanceof multer.MulterError) {
        // Multer错误
        if (error.code === 'LIMIT_FILE_SIZE') {
            return res.status(400).json({
                success: false,
                message: '文件大小超过限制，最大允许: 5MB'
            });
        }
        return res.status(400).json({
            success: false,
            message: '上传错误: ' + error.message
        });
    }
    
    if (error) {
        return res.status(400).json({
            success: false,
            message: error.message
        });
    }
    
    next();
});

// 健康检查API
app.get('/api/health', (req, res) => {
    res.json({
        success: true,
        message: '服务器运行正常',
        timestamp: new Date().toISOString()
    });
});

// 启动服务器
app.listen(PORT, '0.0.0.0', () => {
    console.log('========================================');
    console.log('  CMS图片上传服务器已启动');
    console.log('========================================');
    console.log(`  服务器地址: http://0.0.0.0:${PORT}`);
    console.log(`  上传接口: http://0.0.0.0:${PORT}/api/upload`);
    console.log(`  上传目录: ${uploadDir}`);
    console.log('========================================');
    console.log('  按 Ctrl+C 停止服务器');
    console.log('========================================');
});
