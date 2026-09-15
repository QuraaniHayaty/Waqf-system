<?php
require_once 'auth.php';
$file = "finance.php";
$code = file_get_contents($file);

// التأكد من أن زر تعديل المصروف يستدعي openEditExpense بشكل صحيح
$old_btn = '<td><button onclick="openEditExpense(${item.id})" class="btn-edit">تعديل</button></td>';
$new_btn = '<td>
                <div style="display:flex; gap:4px; align-items:center;">
                    <button onclick="openEditExpense(${item.id})" class="btn-edit">تعديل</button>
                    <button onclick="deleteRecord(${item.id})" class="btn-delete">حذف</button>
                </div>
            </td>';

$code = str_replace($old_btn, $new_btn, $code);

// التأكد من وجود دالة openEditExpense سليمة بالكامل في السكربت
if (strpos($code, 'function openEditExpense(') === false) {
    // إضافة الدالة إذا كانت غير موجودة
    $target = 'function openEditDonation(id) {';
    $expense_func = '
        function openEditExpense(id) {
            let item = allFinances.find(f => f.id == id);
            if(!item) return;

            document.getElementById(\'editExpId\').value = item.id;
            document.getElementById(\'editExpTitle\').value = item.title;
            document.getElementById(\'editExpCategory\').value = item.category || \'أخرى\';
            document.getElementById(\'editExpDetails\').value = item.notes || \'\';
            document.getElementById(\'editExpAmount\').value = item.amount;
            document.getElementById(\'editExpDate\').value = item.t_date;

            let container = document.getElementById(\'editExpAttachmentsContainer\');
            if(container) {
                container.innerHTML = \'\';
                if(item.file_name) {
                    let row = document.createElement(\'div\');
                    row.className = \'attachment-row\';
                    row.style.cssText = \'display:flex; gap:10px; align-items:center; margin-bottom:8px;\';
                    row.innerHTML = `<span style="flex:1; font-size:13px; color:#0369a1; font-weight:bold;">📄 ${item.file_name}</span> <button type="button" class="btn-remove-att" onclick="this.parentElement.remove()" style="background:#e74c3c; color:white; border:none; padding:4px 8px; border-radius:4px; cursor:pointer; font-size:11px;">حذف</button>`;
                    container.appendChild(row);
                }
                addAttachmentRow(\'editExpAttachmentsContainer\');
            }

            document.getElementById(\'editExpenseModal\').style.display = \'flex\';
        }
    ';
    $code = str_replace($target, $expense_func . "\n" . $target, $code);
}

file_put_contents($file, $code);
echo "Expense edit button fixed successfully!\n";
?>
