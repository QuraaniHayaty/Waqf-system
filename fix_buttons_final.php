<?php
require_once 'auth.php';
$file = "finance.php";
$code = file_get_contents($file);

// إزالة أي دالة قديمة وتثبيت الدوال السليمة والصريحة
$new_update_functions = '
        function updateDonation() {
            let id = document.getElementById(\'editDonId\').value;
            let title = document.getElementById(\'editDonName\').value;
            let phone = document.getElementById(\'editDonPhone\').value;
            let type = document.getElementById(\'editDonType\').value;
            let amount = document.getElementById(\'editDonAmount\').value;
            let transaction_date = document.getElementById(\'editDonDate\').value;
            let method = document.getElementById(\'editDonMethod\').value;
            let notes = document.getElementById(\'editDonNotes\').value;

            let container = document.getElementById(\'editDonAttachmentsContainer\');
            let filesList = [];
            if(container) {
                container.querySelectorAll(\'.attachment-row\').forEach(row => {
                    let span = row.querySelector(\'span\');
                    let fileInput = row.querySelector(\'input[type="file"]\');
                    if(span) {
                        filesList.push(span.innerText.replace(\'📄 \', \'\').trim());
                    } else if(fileInput && fileInput.files.length > 0) {
                        filesList.push(fileInput.files[0].name);
                    }
                });
            }
            let fileName = filesList.join(\', \');

            if(!title || !amount || !transaction_date) {
                alert(\'الرجاء تعبئة الحقول الأساسية\');
                return;
            }

            fetch(\'api_finances.php?action=update\', {
                method: \'POST\',
                headers: { \'Content-Type\': \'application/json\' },
                body: JSON.stringify({ 
                    id: id,
                    type: type, 
                    title: title, 
                    category: \'\',
                    amount: amount, 
                    transaction_date: transaction_date, 
                    notes: `الهاتف: ${phone} | الطريقة: ${method} | ملاحظات: ${notes}`,
                    file_name: fileName
                })
            })
            .then(res => res.json())
            .then(res => {
                if(res.status === \'success\') {
                    closeEditDonationModal();
                    alert(\'تم تحديث التبرع بنجاح!\');
                    loadAllData();
                } else {
                    alert(\'خطأ من السيرفر: \' + (res.message || \'خطأ غير معروف\'));
                }
            })
            .catch(err => alert(\'خطأ في الاتصال: \' + err.message));
        }

        function updateExpense() {
            let id = document.getElementById(\'editExpId\').value;
            let title = document.getElementById(\'editExpTitle\').value;
            let category = document.getElementById(\'editExpCategory\').value;
            let details = document.getElementById(\'editExpDetails\').value;
            let amount = document.getElementById(\'editExpAmount\').value;
            let transaction_date = document.getElementById(\'editExpDate\').value;

            let container = document.getElementById(\'editExpAttachmentsContainer\');
            let filesList = [];
            if(container) {
                container.querySelectorAll(\'.attachment-row\').forEach(row => {
                    let span = row.querySelector(\'span\');
                    let fileInput = row.querySelector(\'input[type="file"]\');
                    if(span) {
                        filesList.push(span.innerText.replace(\'📄 \', \'\').trim());
                    } else if(fileInput && fileInput.files.length > 0) {
                        filesList.push(fileInput.files[0].name);
                    }
                });
            }
            let fileName = filesList.join(\', \');

            if(!amount || !transaction_date) {
                alert(\'الرجاء إدخال المبلغ وتاريخ الصرف\');
                return;
            }

            fetch(\'api_finances.php?action=update\', {
                method: \'POST\',
                headers: { \'Content-Type\': \'application/json\' },
                body: JSON.stringify({ 
                    id: id,
                    type: \'expense\', 
                    title: title, 
                    category: category,
                    amount: amount, 
                    transaction_date: transaction_date, 
                    notes: details,
                    file_name: fileName
                })
            })
            .then(res => res.json())
            .then(res => {
                if(res.status === \'success\') {
                    closeEditExpenseModal();
                    alert(\'تم تحديث المصروف بنجاح!\');
                    loadAllData();
                } else {
                    alert(\'خطأ من السيرفر: \' + (res.message || \'خطأ غير معروف\'));
                }
            })
            .catch(err => alert(\'خطأ في الاتصال: \' + err.message));
        }
';

// إذا كانت الدوال القديمة موجودة، نستبدلها، وإلا نضيفها قبل نهاية السكربت
if (strpos($code, 'function updateDonation()') !== false) {
    // استبدال الدوال القديمة بالدوال السليمة
    $start = strpos($code, 'function updateDonation()');
    $end = strpos($code, 'function deleteRecord(', $start);
    if ($start !== false && $end !== false) {
        $code = substr_replace($code, $new_update_functions, $start, $end - $start);
    }
}

file_put_contents($file, $code);
echo "Buttons logic fixed successfully!\n";
?>
