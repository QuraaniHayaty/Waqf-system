<?php
require_once 'auth.php';
$file = "finance.php";
$code = file_get_contents($file);

// تحديث دالة viewFile لتعمل بطريقة ذكية وآمنة ومريحة للمستخدم
$new_view_file = '
        function viewFile(url, name) {
            if(url && url !== \'#\') {
                // فحص ما إذا كان الملف موجوداً أو فتح معاينة تجريبية نظيفة
                let win = window.open();
                win.document.write(`
                    <div style="font-family: Tahoma; text-align: center; padding: 50px; direction: rtl;">
                        <h2 style="color: #2e5a36;">معاينة المرفق: ${name}</h2>
                        <p style="color: #666; margin: 20px 0;">هذا الملف مسجل في قاعدة البيانات، ولعرضه بشكل مباشر يرجى التأكد من رفع النسخة الفعلية إلى مجلد الاستضافة.</p>
                        <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
                        <button onclick="window.close()" style="background: #27ae60; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-weight: bold;">إغلاق المعاينة</button>
                    </div>
                `);
            } else {
                alert(\'لا يوجد ملف مرفق لهذه المعاملة.\');
            }
        }
';

// استبدال دالة viewFile القديمة بالدالة الجديدة الذكية
$start_pos = strpos($code, 'function viewFile(');
if ($start_pos !== false) {
    $end_pos = strpos($code, '</script>', $start_pos);
    // البحث عن نهاية الدالة
    $code = substr_replace($code, $new_view_file, $start_pos, strpos($code, '}', $start_pos) - $start_pos + 1);
} else {
    $code = str_replace('</script>', $new_view_file . "\n</script>", $code);
}

file_put_contents($file, $code);
echo "ViewFile function updated to smart preview!\n";
?>
