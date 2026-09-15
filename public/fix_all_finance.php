<?php
$file = "finance.php";
$code = file_get_contents($file);

// تعديل دالة تحديث التبرع في الجافاسكريبت لتعمل بسلاسة دون أخطاء
$old_js_update = '        function updateDonation() {
            let id = document.getElementById(\'editDonId\').value;
            let title = document.getElementById(\'editDonName\').value;
            let phone = document.getElementById(\'editDonPhone\').value;
            let type = document.getElementById(\'editDonType\').value;
            let amount = document.getElementById(\'editDonAmount\').value;
            let transaction_date = document.getElementById(\'editDonDate\').value;
            let method = document.getElementById(\'editDonMethod\').value;
            let notes = document.getElementById(\'editDonNotes\').value;
            let fileInput = document.getElementById(\'editDonFile\');
            let removeFile = document.getElementById(\'removeDonFile\').checked;

            let item = allFinances.find(f => f.id == id);
            let fileName = item ? item.file_name : \'\';

            if(removeFile) {
                fileName = \'\';
            }
            if(fileInput.files.length > 0) {
                let newFiles = Array.from(fileInput.files).map(f => f.name).join(\', \');
                fileName = fileName ? fileName + \', \' + newFiles : newFiles;
            }

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
                    alert(\'حدث خطأ أثناء التحديث\');
                }
            });
        }';

$new_js_update = '        function updateDonation() {
            let id = document.getElementById(\'editDonId\').value;
            let title = document.getElementById(\'editDonName\').value;
            let phone = document.getElementById(\'editDonPhone\').value;
            let type = document.getElementById(\'editDonType\').value;
            let amount = document.getElementById(\'editDonAmount\').value;
            let transaction_date = document.getElementById(\'editDonDate\').value;
            let method = document.getElementById(\'editDonMethod\').value;
            let notes = document.getElementById(\'editDonNotes\').value;
            let fileInput = document.getElementById(\'editDonFile\');

            let item = allFinances.find(f => f.id == id);
            let fileName = item ? item.file_name : \'\';

            if(fileInput.files.length > 0) {
                let newFiles = Array.from(fileInput.files).map(f => f.name).join(\', \');
                fileName = fileName ? fileName + \', \' + newFiles : newFiles;
            }

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
                    alert(\'حدث خطأ أثناء التحديث\');
                }
            });
        }';

$code = str_replace($old_js_update, $new_js_update, $code);
file_put_contents($file, $code);
echo "Finance JS updated successfully!\n";
?>
