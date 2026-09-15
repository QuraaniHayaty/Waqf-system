<?php
require_once 'auth.php';
$file = "finance.php";
$code = file_get_contents($file);

// 1. تصحيح زر تسجيل مصروف جديد في دالة switchSection
$old_tab_switch = 'btnContainer.innerHTML = \'<button class="btn-action-add btn-expense-add" onclick="openAddExpenseModal()">➕ تسجيل مصروف جديد</button>\';';
$new_tab_switch = 'btnContainer.innerHTML = \'<button class="btn-action-add btn-expense-add" onclick="openAddExpenseModal()">➕ تسجيل مصروف جديد</button>\';';

// التأكد من أن الدوال موجودة وصحيحة في السكربت
$expense_js = '
        function openAddExpenseModal() {
            let detailsInput = document.getElementById(\'expDetails\');
            let amountInput = document.getElementById(\'expAmount\');
            if(detailsInput) detailsInput.value = \'\';
            if(amountInput) amountInput.value = \'\';
            
            let container = document.getElementById(\'addExpAttachmentsContainer\');
            if(container) {
                container.innerHTML = \'\';
                if(typeof addAttachmentRow === \'function\') {
                    addAttachmentRow(\'addExpAttachmentsContainer\');
                }
            }
            let modal = document.getElementById(\'addExpenseModal\');
            if(modal) modal.style.display = \'flex\';
        }

        function closeAddExpenseModal() {
            let modal = document.getElementById(\'addExpenseModal\');
            if(modal) modal.style.display = \'none\';
        }

        function saveNewExpense() {
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
            let fileName = filesList.join(\', \');

            if(!amount || !transaction_date) {
                alert(\'الرجاء إدخال المبلغ وتاريخ الصرف\');
                return;
            }

            fetch(\'api_finances.php?action=add\', {
                method: \'POST\',
                headers: { \'Content-Type\': \'application/json\' },
                body: JSON.stringify({ 
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
                    closeAddExpenseModal();
                    alert(\'تم حفظ المصروف بنجاح!\');
                    loadAllData();
                } else {
                    alert(\'خطأ من السيرفر: \' + (res.message || \'خطأ غير معروف\'));
                }
            })
            .catch(err => alert(\'خطأ في الاتصال: \' + err.message));
        }
';

// إذا كانت الدوال غير موجودة، نقوم بإضافتها قبل إغلاق السكربت
if (strpos($code, 'function openAddExpenseModal()') === false) {
    $code = str_replace('</script>', $expense_js . "\n</script>", $code);
}

file_put_contents($file, $code);
echo "Add expense modal and functions fixed successfully!\n";
?>
