<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page_1779236367_b11833</title>
    <link rel="stylesheet" href="/css/style.min.css?v=20250514">
    <link rel="stylesheet" href="/css/page-custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/page-builder.css">
    <link rel="icon" href="/favicon-v2.png" type="image/x-icon">
    <style>
        .page-content { max-width: 1200px; margin: 0 auto; padding: 20px; padding-top: 84px; }
        .img-placeholder { display:flex; align-items:center; justify-content:center; background:#f3f4f6; color:#9ca3af; flex-direction:column; gap:8px; font-size:14px; }
        .img-placeholder i { font-size:32px; }
        .img-placeholder-banner { width:100%; height:100%; min-height:300px; }
        .img-placeholder-image { width:100%; min-height:200px; }
        .card-image.card-image-placeholder { display:flex; align-items:center; justify-content:center; background:#f3f4f6; color:#9ca3af; flex-direction:column; gap:8px; font-size:14px; min-height:180px; }
        .card-image.card-image-placeholder i { font-size:36px; }
        .banner-img, .image-module-img, .card-img { max-width:100%; }
    </style>
    <script>
    (function(){
        var xhr=new XMLHttpRequest();
        xhr.open("GET","admin/api/fetch-logo.php?t="+Date.now(),true);
        xhr.onload=function(){
            if(xhr.status>=200&&xhr.status<400){
                try{
                    var resp=JSON.parse(xhr.responseText);
                    if(resp.code===0&&resp.data){function fixPath(p){return p;}
                        if(resp.data.header_logo){
                            var hl=document.querySelector(".logo img");
                            if(hl)hl.src=fixPath(resp.data.header_logo);
                        }
                        if(resp.data.footer_logo){
                            var fl=document.querySelector(".footer-logo img");
                            if(fl)fl.src=fixPath(resp.data.footer_logo);
                        }
                    }
                }catch(e){}
            }
        };
        xhr.send();
    })();
    </script>
</head>
<body>
    <a href="#main-content" class="skip-link">跳转到主要内容</a>
    <?php require_once __DIR__ . '/includes/logo.php'; ?>
<?php include __DIR__ . '/includes/header.php'; ?>

    <main id="main-content"><div class="page-content"><div class="text-module" style="text-align: left;"><h2 class="module-title">标题文本</h2><div class="module-content">这里是内容文本，可以编辑修改。</div></div><div class="image-module layout-normal"><img src="data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22800%22%20height%3D%22400%22%20viewBox%3D%220%200%20800%20400%22%3E%3Crect%20fill%3D%22%23e5e7eb%22%20width%3D%22800%22%20height%3D%22400%22%2F%3E%3Ctext%20fill%3D%22%239ca3af%22%20font-family%3D%22sans-serif%22%20font-size%3D%2224%22%20text-anchor%3D%22middle%22%20x%3D%22400%22%20y%3D%22210%22%3EPlaceholder%3C%2Ftext%3E%3C%2Fsvg%3E" alt="图片描述" style="width: 100%;" class="image-module-img"></div><div class="button-module" style="text-align: center;"><a href="#" class="btn btn-primary btn-medium" >点击按钮</a></div></div></main>
    <div class="chat-widget" id="chatWidget" aria-label="联系电话">
        <button class="chat-widget-btn" id="chatWidgetBtn" aria-label="点击电话"><i class="fas fa-phone-alt"></i></button>
        <div class="chat-widget-phone-display"><span class="chat-widget-phone-text">13552883008</span></div>
    </div>
    <?php include __DIR__ . "/includes/footer.php"; ?>
    <script>document.addEventListener("error",function(e){if(e.target.tagName==="IMG"){e.target.style.display="none";var p=e.target.parentElement;if(p&&!p.querySelector(".img-placeholder")){var d=document.createElement("div");d.className="img-placeholder";d.innerHTML="<i class='fas fa-image'></i><span>Image Error</span>";p.appendChild(d)}}},true);</script>
    
    <script src="/assets/js/page-builder.js"></script>
    
    <script src="/js/main.js?v=20260610"></script>
</body>
</html>