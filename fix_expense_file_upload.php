<?php
require_once 'auth.php';
$file = "finance.php";
$code = file_get_contents($file);

// تحديث دالة saveNewExpense لتلتقط اسم الملف المرفق بشكل صحيح عند الإضافة
$old_save_exp = '        function saveNewExpense() {
            let titleEl = document.getElementById(\'expTitle\');
            let categoryEl = document.getElementById(\'expCategory\');
            let detailsEl = document.getElementById(\'expDetails\');
            let amountEl = document.getElementById(\'expAmount\');
            let dateEl = document.getElementById(\'expDate\');

            let title = titleEl ? titleEl.value : \'عقارات الوقف\';
            let category = categoryEl ? categoryEl.value : \'أخرى\';
            let details = detailsEl ? detailsEl.value : \'\';
            let amount = amountEl ? amountEl.value : 0;
            let transaction_date = dateEl ? dateEl.value : new Date().toISOString().split(\'T\')[0];

            let container = document.getElementById(\'addExpAttachmentsContainer\');
            let filesList = [];
            if(container) {
                container.querySelectorAll(\'.attachment-row\').forEach(row => {
                    let fileInput = row.querySelector(\'input[type="file"]\');
                    if(fileInput && fileInput.files.length > 0) {
                        filesList.push(fileInput.files[0].name);
                    }
                });
            }
            let fileName = filesList.join(\', \');';

$new_save_exp = '        function saveNewExpense() {
            let titleEl = document.getElementById(\'expTitle\');
            let categoryEl = document.getElementById(\'expCategory\');
            let detailsEl = document.getElementById(\'expDetails\');
            let amountEl = document.getElementById(\'expAmount\');
            let dateEl = document.getElementById(\'expDate\');

            let title = titleEl ? titleEl.value : \'عقارات الوقف\';
            let category = categoryEl ? categoryEl.value : \'أخرى\';
            let details = detailsEl ? detailsEl.value : \'\';
            let amount = amountEl ? amountEl.value : 0;
            let transaction_date = dateEl ? dateEl.value : new Date().toISOString().split(\'T\')[0];

            let container = document.getElementById(\'addExpAttachmentsContainer\');
            let filesList = [];
            if(container) {
                container.querySelectorAll(\'.attachment-row\').forEach(row => {
                    let fileInput = row.querySelector(\'input[type="file"]\');
                    let span = row.querySelector(\'span\');
                    if(span) {
                        filesList.push(span.innerText.replace(\'📄 \', \'\').trim());
                    } else if(fileInput && fileInput.files.length > 0) {
                        filesList.push(fileInput.files[0].name);
                    }
                });
            }
            // دعم العنصر القديم إن وجد
            let singleFile = document.getElementById(\'expFile\');
            if(singleFile && singleFile.files.length > 0) {
                filesList.push(singleFile.files[0].name);
            }
            let fileName = filesList.join(\', \');';

$code = str_replace($old_save_exp, $new_save_exp, $code);

// التأكد من وجود وعاء المرفقات في نافذة إضافة المصروف في HTML إن لم يكن موجوداً
if (strpos($code, 'id="addExpAttachmentsContainer"') === false) {
    $code = str_replace(
        '<input type="file" id="expFile" style="padding: 6px;">',
        '<div id="addExpAttachmentsContainer" style="margin-bottom: 8px;"></div>
                    <button type="button" class="btn-add-attachment" onclick="addAttachmentRow(\'addExpAttachmentsContainer\')" style="background-color: #3498db; color: white; border: none; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: bold; cursor: pointer;">➕ إضافة مرفق جديد</button>',
        $code
    );
}

file_put_contents($file, $code);
echo "Expense attachment handling updated successfully!\n";
?>
