<?php
$file = "finance.php";
$code = file_get_contents($file);

// جعل تنبيه الخطأ يعرض تفاصيل الخطأ القادمة من السيرفر
$old_err1 = 'alert(\'حدث خطأ أثناء التحديث\');';
$new_err1 = 'res.text().then(text => alert(\'خطأ من السيرفر: \' + text));';

$code = str_replace($old_err1, $new_err1, $code);

file_put_contents($file, $code);
echo "Alert updated with server error details!\n";
?>
