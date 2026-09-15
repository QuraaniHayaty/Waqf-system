<?php
require_once 'auth.php';
$file = "finance.php";
$code = file_get_contents($file);

// استبدال دالة viewFile القديمة بدالة حقيقية تعرض الملف (PDF أو صورة) مباشرة في نافذة جديدة
$old_func = '        function viewFile(url, name) {
            let win = window.open();
            win.document.write(`
                <div style="font-family: Tahoma; text-align: center; padding: 40px; direction: rtl;">
                    <h2 style="color: #2e5a36;">معاينة المرفق: ${name}</h2>
                    <p style="color: #666; margin: 20px 0;">الملف مسجل بنجاح في النظام.</p>
                    <button onclick="window.close()" style="background: #27ae60; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-weight: bold;">إغلاق المعاينة</button>
                </div>
            `);
        }';

$new_func = '        function viewFile(url, name) {
            if(url && url !== \'#\') {
                let win = window.open();
                win.document.write(`
                    <!DOCTYPE html>
                    <html lang="ar" dir="rtl">
                    <head>
                        <meta charset="UTF-8">
                        <title>معاينة المرفق: ${name}</title>
                        <style>
                            body { margin: 0; font-family: Tahoma; background: #f4f6f9; display: flex; flex-direction: column; height: 100vh; }
                            header { background: #2e5a36; color: white; padding: 10px 20px; display: flex; justify-content: space-between; align-items: center; }
                            iframe { flex-grow: 1; border: none; width: 100%; height: calc(100vh - 50px); background: white; }
                        </style>
                    </head>
                    <body>
                        <header>
                            <span>📄 ${name}</span>
                            <button onclick="window.close()" style="background: #e74c3c; color: white; border: none; padding: 5px 12px; border-radius: 4px; cursor: pointer; font-weight: bold;">إغلاق</button>
                        </header>
                        <iframe src="${url}" onerror="document.body.innerHTML=\'<h3 style=\\\'text-align:center; margin-top:50px; color:#c0392b;\\\'>عذراً، لم يتم العثور على الملف الفعلي على السيرفر. تأكد من رفع الملف.</h3>\'"></iframe>
                    </body>
                    </html>
                `);
            } else {
                alert(\'لا يوجد ملف مرفق لهذه المعاملة.\');
            }
        }';

$code = str_replace($old_func, $new_func, $code);
file_put_contents($file, $code);
echo "Real file viewer updated successfully!\n";
?>
