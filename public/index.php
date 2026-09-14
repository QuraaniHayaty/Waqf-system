<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>وقف تعليم القرآن الكريم والعلوم الشرعية بقرية الروضة</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, sans-serif; }
        body { background-color: #f4f6f9; display: flex; height: 100vh; overflow: hidden; direction: rtl; text-align: right; }
        
        /* القائمة الجانبية الكلية */
        aside { width: 285px; height: 100vh; background-color: #fcfbf9; border-left: 1px solid #eae5dc; display: flex; flex-direction: column; justify-content: space-between; flex-shrink: 0; }
        
        /* الشعار ثابت في الأعلى ولا يتأثر بالتمرير */
        .sidebar-header { text-align: center; padding: 20px 10px 15px 10px; border-bottom: 1px solid #f0ece4; background-color: #fcfbf9; z-index: 10; }
        .sidebar-header img { max-width: 210px; height: auto; object-fit: contain; margin-bottom: 8px; }
        .sidebar-header h2 { font-size: 14px; color: #2c3e50; line-height: 1.4; font-weight: bold; }
        
        /* منطقة القوائم القابلة للتمرير (Scrollable) */
        .nav-container { flex-grow: 1; overflow-y: auto; padding: 15px 10px; }
        .nav-menu { list-style: none; }
        .nav-menu li { margin-bottom: 6px; }
        .nav-menu a { display: flex; align-items: center; padding: 11px 15px; color: #444; text-decoration: none; border-radius: 8px; font-size: 14px; transition: all 0.2s; }
        .nav-menu a:hover, .nav-menu a.active { background-color: #27ae60; color: #ffffff; }
        
        /* زر تسجيل الخروج ثابت في الأسفل */
        .logout-section { padding: 15px 20px; border-top: 1px solid #f0ece4; background-color: #fcfbf9; z-index: 10; }
        .logout-btn { display: flex; align-items: center; justify-content: center; padding: 11px; background-color: #e74c3c; color: white; text-decoration: none; border-radius: 8px; font-size: 14px; transition: background-color 0.2s; font-weight: bold; }
        .logout-btn:hover { background-color: #c0392b; }
        
        main { flex-grow: 1; display: flex; flex-direction: column; background-color: #f9fafb; overflow-y: auto; height: 100vh; }
        .top-banner { background-color: #27ae60; color: white; margin: 25px; padding: 30px; border-radius: 10px; display: flex; justify-content: space-between; align-items: center; }
        .banner-title h1 { font-size: 26px; margin-bottom: 8px; font-weight: bold; }
        .content-area { padding: 0 25px 25px 25px; color: #7f8c8d; font-size: 15px; }
    </style>
</head>
<body>
    <aside>
        <div class="sidebar-header">
            <img src="logo.png" alt="شعار الوقف">
            <h2>وقف تعليم القرآن الكريم والعلوم الشرعية بقرية الروضة</h2>
        </div>
        <div class="nav-container">
            <ul class="nav-menu">
                <li><a href="#" class="active">لوحة التحكم</a></li>
                <li><a href="#">بيانات عقارات الوقف</a></li>
                <li><a href="#">قائمة البرامج المستفيدة</a></li>
                <li><a href="#">عقود الإيجارات</a></li>
                <li><a href="#">الحسابات</a></li>
                <li><a href="#">قائمة واتساب</a></li>
                <li><a href="#">الإعدادات</a></li>
            </ul>
        </div>
        <div class="logout-section">
            <a href="#" class="logout-btn">تسجيل الخروج</a>
        </div>
    </aside>
    <main>
        <div class="top-banner">
            <div class="banner-title">
                <h1>لوحة التحكم</h1>
                <p>إدارة واستيراد السجلات بكفاءة عالية</p>
            </div>
        </div>
        <div class="content-area">
            <p>تم تثبيت الشعار في الأعلى وجعل القوائم وحدها قابلة للتمرير تماماً مثل نظام قرآني حياتي. أخبرني بأول قسم نبدأ برمجته الآن.</p>
        </div>
    </main>
</body>
</html>
