<?php
$file = "finance.php";
$code = file_get_contents($file);

// استبدال دالة حفظ المصروف الجديد لتستخدم FormData لرفع الملف الحقيقي مثل عقود الإيجار
$old_save_exp = '        function saveNewExpense() {
            let title = document.getElementById(\'expTitle\').value;
            let category = document.getElementById(\'expCategory\').value;
            let details = document.getElementById(\'expDetails\').value;
            let amount = document.getElementById(\'expAmount\').value;
            let transaction_date = document.getElementById(\'expDate\').value;

            let container = document.getElementById(\'addExpAttachmentsContainer\');
            let filesList = [];
            if(container) {
                container.querySelectorAll(\'.attachment-row\').forEach(row => {
                    let fileInput = row.querySelector(\'input[type="file"]\');
                    if(fileInput && fileInput.files.length > 0) filesList.push(fileInput.files[0].name);
                });
            }
            let fileName = filesList.join(\', \');

            if(!amount || !transaction_date) {
                alert(\'الرجاء إدخال المبلغ والتاريخ\');
                return;
            }

            fetch(\'api_finances.php?action=add\', {
                method: \'POST\',
                headers: { \'Content-Type\': \'application/json\' },
                body: JSON.stringify({ type: \'expense\', title, category, amount, transaction_date, notes: details, file_name: fileName })
            })
            .then(res => res.json())
            .then(res => {
                if(res.status === \'success\') {
                    closeAddExpenseModal();
                    alert(\'تم حفظ المصروف بنجاح!\');
                    loadAllData();
                } else { alert(\'حدث خطأ\'); }
            });
        }';

$new_save_exp = '        function saveNewExpense() {
            let title = document.getElementById(\'expTitle\').value;
            let category = document.getElementById(\'expCategory\').value;
            let details = document.getElementById(\'expDetails\').value;
            let amount = document.getElementById(\'expAmount\').value;
            let transaction_date = document.getElementById(\'expDate\').value;

            if(!amount || !transaction_date) {
                alert(\'الرجاء إدخال المبلغ والتاريخ\');
                return;
            }

            let formData = new FormData();
            formData.append(\'type\', \'expense\');
            formData.append(\'title\', title);
            formData.append(\'category\', category);
            formData.append(\'amount\', amount);
            formData.append(\'transaction_date\', transaction_date);
            formData.append(\'notes\', details);

            let container = document.getElementById(\'addExpAttachmentsContainer\');
            if(container) {
                let fileInput = container.querySelector(\'input[type="file"]\');
                if(fileInput && fileInput.files.length > 0) {
                    formData.append(\'file\', fileInput.files[0]);
                }
            }

            fetch(\'api_finances.php?action=add\', {
                method: \'POST\',
                body: formData
            })
            .then(res => res.json())
            .then(res => {
                if(res.status === \'success\') {
                    closeAddExpenseModal();
                    alert(\'تم حفظ المصروف مع المرفق بنجاح!\');
                    loadAllData();
                } else { alert(\'حدث خطأ أثناء الحفظ\'); }
            })
            .catch(err => alert(\'خطأ في الاتصال: \' + err));
        }';

$code = str_replace($old_save_exp, $new_save_exp, $code);
file_put_contents($file, $code);
echo "Finance expense save updated to use FormData like leases!\n";
?>
