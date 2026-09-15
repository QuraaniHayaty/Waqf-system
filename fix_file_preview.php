<?php
require_once 'auth.php';
$file = "finance.php";
$code = file_get_contents($file);

// تعديل طريقة عرض ملف المصروف والتبرع في الجداول لاستخدام دالة viewFile الآمنة تماماً مثل عقود الإيجار
$old_exp_file_html = 'let fileLink = item.file_name ? `<a href="uploads/${item.file_name}" target="_blank" style="color:#0369a1; font-weight:bold; text-decoration:none;">📄 الفاتورة</a>` : \'<span style="color:#999;">لا يوجد</span>\';';
$new_exp_file_html = 'let fileLink = item.file_name ? `<a href="#" onclick="viewFile(\'uploads/${item.file_name}\', \'${item.file_name}\')" style="color:#0369a1; font-weight:bold; text-decoration:none;">📄 الفاتورة</a>` : \'<span style="color:#999;">لا يوجد</span>\';';

$code = str_replace($old_exp_file_html, $new_exp_file_html, $code);

$old_don_file_html = 'let fileLink = item.file_name ? `<a href="uploads/${item.file_name}" target="_blank" style="color:#0369a1; font-weight:bold; text-decoration:none;">📄 عرض الإيصال</a>` : \'<span style="color:#999;">لا يوجد</span>\';';
$new_don_file_html = 'let fileLink = item.file_name ? `<a href="#" onclick="viewFile(\'uploads/${item.file_name}\', \'${item.file_name}\')" style="color:#0369a1; font-weight:bold; text-decoration:none;">📄 عرض الإيصال</a>` : \'<span style="color:#999;">لا يوجد</span>\';';

$code = str_replace($old_don_file_html, $new_don_file_html, $code);

// التأكد من وجود دالة viewFile في السكربت
if (strpos($code, 'function viewFile(') === false) {
    $view_file_func = '
        function viewFile(url, name) {
            if(url && url !== \'#\') {
                let win = window.open();
                win.document.write(`<iframe src="${url}" style="width:100%; height:100%; border:none;"></iframe>`);
            } else {
                alert(\'هذا ملف افتراضي تجريبي.\');
            }
        }
    ';
    $code = str_replace('</script>', $view_file_func . "\n</script>", $code);
}

file_put_contents($file, $code);
echo "File preview viewFile function synced successfully!\n";
?>
