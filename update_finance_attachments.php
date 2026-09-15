<?php
require_once 'auth.php';
$file = "finance.php";
$code = file_get_contents($file);

// استبدال قسم المرفقات في نافذة تعديل التبرع
$old_don_att = '                <div class="form-group">
                    <label>المرفقات وإيصالات التحويل</label>
                    <div id="editDonFilePreview" style="margin-bottom: 8px; font-size: 13px;"></div>
                    <input type="file" id="editDonFile" style="padding: 6px;" multiple>
                    <label style="margin-top: 5px; font-size: 11px; color: #c0392b;"><input type="checkbox" id="removeDonFile"> حذف المرفقات الحالية</label>
                </div>';

$new_don_att = '                <div class="form-group">
                    <label>المرفقات وإيصالات التحويل</label>
                    <div id="editDonAttachmentsContainer" style="margin-bottom: 8px;"></div>
                    <button type="button" class="btn-add-attachment" onclick="addAttachmentRow(\'editDonAttachmentsContainer\')" style="background-color: #3498db; color: white; border: none; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: bold; cursor: pointer;">➕ إضافة مرفق جديد</button>
                </div>';

$code = str_replace($old_don_att, $new_don_att, $code);

// استبدال قسم المرفقات في نافذة تعديل المصروف
$old_exp_att = '                <div class="form-group">
                    <label>الفواتير والمرفقات</label>
                    <div id="editExpFilePreview" style="margin-bottom: 8px; font-size: 13px;"></div>
                    <input type="file" id="editExpFile" style="padding: 6px;" multiple>
                    <label style="margin-top: 5px; font-size: 11px; color: #c0392b;"><input type="checkbox" id="removeExpFile"> حذف المرفقات الحالية</label>
                </div>';

$new_exp_att = '                <div class="form-group">
                    <label>الفواتير والمرفقات</label>
                    <div id="editExpAttachmentsContainer" style="margin-bottom: 8px;"></div>
                    <button type="button" class="btn-add-attachment" onclick="addAttachmentRow(\'editExpAttachmentsContainer\')" style="background-color: #3498db; color: white; border: none; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: bold; cursor: pointer;">➕ إضافة مرفق جديد</button>
                </div>';

$code = str_replace($old_exp_att, $new_exp_att, $code);

// تحديث دوال الجافاسكريبت لتعرض المرفقات كصفوف منفصلة مع زر حذف لكل مرفق
$old_js_don_edit = '        function openEditDonation(id) {
            let item = allFinances.find(f => f.id == id);
            if(!item) return;

            document.getElementById(\'editDonId\').value = item.id;
            document.getElementById(\'editDonName\').value = item.title;
            document.getElementById(\'editDonAmount\').value = item.amount;
            document.getElementById(\'editDonDate\').value = item.t_date;
            document.getElementById(\'editDonType\').value = item.type;
            
            let notesStr = item.notes || \'\';
            let phoneMatch = notesStr.match(/الهاتف:\\s*([^|]+)/);
            let methodMatch = notesStr.match(/الطريقة:\\s*([^|]+)/);
            
            document.getElementById(\'editDonPhone\').value = phoneMatch ? phoneMatch[1].trim() : \'\';
            if(methodMatch) document.getElementById(\'editDonMethod\').value = methodMatch[1].trim();
            document.getElementById(\'editDonNotes\').value = notesStr;
            document.getElementById(\'removeDonFile\').checked = false;
            document.getElementById(\'editDonFile\').value = \'\';

            let preview = document.getElementById(\'editDonFilePreview\');
            if(item.file_name) {
                preview.innerHTML = `المرفقات الحالية: <span style="color:#0369a1; font-weight:bold;">${item.file_name}</span>`;
            } else {
                preview.innerHTML = \'<span style="color:#888;">لا توجد مرفقات حالياً</span>\';
            }

            document.getElementById(\'editDonationModal\').style.display = \'flex\';
        }';

$new_js_don_edit = '        function openEditDonation(id) {
            let item = allFinances.find(f => f.id == id);
            if(!item) return;

            document.getElementById(\'editDonId\').value = item.id;
            document.getElementById(\'editDonName\').value = item.title;
            document.getElementById(\'editDonAmount\').value = item.amount;
            document.getElementById(\'editDonDate\').value = item.t_date;
            document.getElementById(\'editDonType\').value = item.type;
            
            let notesStr = item.notes || \'\';
            let phoneMatch = notesStr.match(/الهاتف:\\s*([^|]+)/);
            let methodMatch = notesStr.match(/الطريقة:\\s*([^|]+)/);
            
            document.getElementById(\'editDonPhone\').value = phoneMatch ? phoneMatch[1].trim() : \'\';
            if(methodMatch) document.getElementById(\'editDonMethod\').value = methodMatch[1].trim();
            document.getElementById(\'editDonNotes\').value = notesStr;

            let container = document.getElementById(\'editDonAttachmentsContainer\');
            container.innerHTML = \'\';
            
            if(item.file_name) {
                let files = item.file_name.split(\',\').map(f => f.trim()).filter(f => f);
                files.forEach(f => {
                    let row = document.createElement(\'div\');
                    row.className = \'attachment-row\';
                    row.style.cssText = \'display:flex; gap:10px; align-items:center; margin-bottom:8px;\';
                    row.innerHTML = `<span style="flex:1; font-size:13px; color:#0369a1; font-weight:bold;">📄 ${f}</span> <button type="button" class="btn-remove-att" onclick="this.parentElement.remove()" style="background:#e74c3c; color:white; border:none; padding:4px 8px; border-radius:4px; cursor:pointer; font-size:11px;">حذف</button>`;
                    container.appendChild(row);
                });
            }
            addAttachmentRow(\'editDonAttachmentsContainer\');

            document.getElementById(\'editDonationModal\').style.display = \'flex\';
        }';

$code = str_replace($old_js_don_edit, $new_js_don_edit, $code);

// تحديث دالة updateDonation لجمع أسماء الملفات المتبقية والجديدة
$old_up_don = '        function updateDonation() {
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

$new_up_don = '        function updateDonation() {
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
            container.querySelectorAll(\'.attachment-row\').forEach(row => {
                let span = row.querySelector(\'span\');
                let fileInput = row.querySelector(\'input[type="file"]\');
                if(span) {
                    filesList.push(span.innerText.replace(\'📄 \', \'\').trim());
                } else if(fileInput && fileInput.files.length > 0) {
                    filesList.push(fileInput.files[0].name);
                }
            });
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
                    alert(\'حدث خطأ أثناء التحديث\');
                }
            });
        }';

$code = str_replace($old_up_don, $new_up_don, $code);

// تحديث دوال تعديل المصروف لتتطابق تماماً
$old_js_exp_edit = '        function openEditExpense(id) {
            let item = allFinances.find(f => f.id == id);
            if(!item) return;

            document.getElementById(\'editExpId\').value = item.id;
            document.getElementById(\'editExpTitle\').value = item.title;
            document.getElementById(\'editExpCategory\').value = item.category || \'أخرى\';
            document.getElementById(\'editExpDetails\').value = item.notes || \'\';
            document.getElementById(\'editExpAmount\').value = item.amount;
            document.getElementById(\'editExpDate\').value = item.t_date;
            document.getElementById(\'removeExpFile\').checked = false;
            document.getElementById(\'editExpFile\').value = \'\';

            let preview = document.getElementById(\'editExpFilePreview\');
            if(item.file_name) {
                preview.innerHTML = `المرفقات الحالية: <span style="color:#0369a1; font-weight:bold;">${item.file_name}</span>`;
            } else {
                preview.innerHTML = \'<span style="color:#888;">لا توجد مرفقات حالياً</span>\';
            }

            document.getElementById(\'editExpenseModal\').style.display = \'flex\';
        }';

$new_js_exp_edit = '        function openEditExpense(id) {
            let item = allFinances.find(f => f.id == id);
            if(!item) return;

            document.getElementById(\'editExpId\').value = item.id;
            document.getElementById(\'editExpTitle\').value = item.title;
            document.getElementById(\'editExpCategory\').value = item.category || \'أخرى\';
            document.getElementById(\'editExpDetails\').value = item.notes || \'\';
            document.getElementById(\'editExpAmount\').value = item.amount;
            document.getElementById(\'editExpDate\').value = item.t_date;

            let container = document.getElementById(\'editExpAttachmentsContainer\');
            container.innerHTML = \'\';
            
            if(item.file_name) {
                let files = item.file_name.split(\',\').map(f => f.trim()).filter(f => f);
                files.forEach(f => {
                    let row = document.createElement(\'div\');
                    row.className = \'attachment-row\';
                    row.style.cssText = \'display:flex; gap:10px; align-items:center; margin-bottom:8px;\';
                    row.innerHTML = `<span style="flex:1; font-size:13px; color:#0369a1; font-weight:bold;">📄 ${f}</span> <button type="button" class="btn-remove-att" onclick="this.parentElement.remove()" style="background:#e74c3c; color:white; border:none; padding:4px 8px; border-radius:4px; cursor:pointer; font-size:11px;">حذف</button>`;
                    container.appendChild(row);
                });
            }
            addAttachmentRow(\'editExpAttachmentsContainer\');

            document.getElementById(\'editExpenseModal\').style.display = \'flex\';
        }';

$code = str_replace($old_js_exp_edit, $new_js_exp_edit, $code);

// تحديث دالة updateExpense لجمع الملفات المتبقية والجديدة
$old_up_exp = '        function updateExpense() {
            let id = document.getElementById(\'editExpId\').value;
            let title = document.getElementById(\'editExpTitle\').value;
            let category = document.getElementById(\'editExpCategory\').value;
            let details = document.getElementById(\'editExpDetails\').value;
            let amount = document.getElementById(\'editExpAmount\').value;
            let transaction_date = document.getElementById(\'editExpDate\').value;
            let fileInput = document.getElementById(\'editExpFile\');
            let removeFile = document.getElementById(\'removeExpFile\').checked;

            let item = allFinances.find(f => f.id == id);
            let fileName = item ? item.file_name : \'\';

            if(removeFile) {
                fileName = \'\';
            }
            if(fileInput.files.length > 0) {
                let newFiles = Array.from(fileInput.files).map(f => f.name).join(\', \');
                fileName = fileName ? fileName + \', \' + newFiles : newFiles;
            }

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
                    alert(\'حدث خطأ أثناء التحديث\');
                }
            });
        }';

$new_up_exp = '        function updateExpense() {
            let id = document.getElementById(\'editExpId\').value;
            let title = document.getElementById(\'editExpTitle\').value;
            let category = document.getElementById(\'editExpCategory\').value;
            let details = document.getElementById(\'editExpDetails\').value;
            let amount = document.getElementById(\'editExpAmount\').value;
            let transaction_date = document.getElementById(\'editExpDate\').value;

            let container = document.getElementById(\'editExpAttachmentsContainer\');
            let filesList = [];
            container.querySelectorAll(\'.attachment-row\').forEach(row => {
                let span = row.querySelector(\'span\');
                let fileInput = row.querySelector(\'input[type="file"]\');
                if(span) {
                    filesList.push(span.innerText.replace(\'📄 \', \'\').trim());
                } else if(fileInput && fileInput.files.length > 0) {
                    filesList.push(fileInput.files[0].name);
                }
            });
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
                    alert(\'حدث خطأ أثناء التحديث\');
                }
            });
        }';

$code = str_replace($old_up_exp, $new_up_exp, $code);

// إضافة دالة addAttachmentRow العامة إن لم تكن موجودة
if(strpos($code, 'function addAttachmentRow') === false) {
    $code .= '
    <script>
        function addAttachmentRow(containerId) {
            let container = document.getElementById(containerId);
            let row = document.createElement(\'div\');
            row.className = \'attachment-row\';
            row.style.cssText = \'display:flex; gap:10px; align-items:center; margin-bottom:8px;\';
            row.innerHTML = `
                <input type="file" class="att-file" style="flex:1; padding:6px; font-size:13px;">
                <button type="button" class="btn-remove-att" onclick="this.parentElement.remove()" style="background:#e74c3c; color:white; border:none; padding:4px 8px; border-radius:4px; cursor:pointer; font-size:11px;">حذف</button>
            `;
            container.appendChild(row);
        }
    </script>
    ';
}

file_put_contents($file, $code);
echo "Attachments modal updated successfully to match leases style!\n";
?>
