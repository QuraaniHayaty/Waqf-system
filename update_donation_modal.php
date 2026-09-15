<?php
require_once 'auth.php';
$file = "public/finance.php";
$code = file_get_contents($file);

// 1. إضافة حقل المرفقات وزر الإضافة في نافذة "تسجيل تبرع جديد" إن لم يكن موجوداً
$target_html = '<div class="form-group">
                    <label>ملاحظات إضافية</label>
                    <textarea id="donNotes" rows="2" placeholder="أي ملاحظات..."></textarea>
                </div>';

$attachment_html = '<div class="form-group">
                    <label>إيصالات ومرفقات التبرع</label>
                    <div id="addDonAttachmentsContainer" style="margin-bottom: 8px;"></div>
                    <button type="button" class="btn-action-add" onclick="addAttachmentRow(\'addDonAttachmentsContainer\')" style="background-color: #3498db; color: white; border: none; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: bold; cursor: pointer;">➕ إضافة مرفق جديد</button>
                </div>
                <div class="form-group">
                    <label>ملاحظات إضافية</label>
                    <textarea id="donNotes" rows="2" placeholder="أي ملاحظات..."></textarea>
                </div>';

if (strpos($code, 'id="addDonAttachmentsContainer"') === false) {
    $code = str_replace($target_html, $attachment_html, $code);
}

// 2. تحديث دالة فتح نافذة التبرع لتهيئة حاوية المرفقات
$old_open_don = '        function openAddDonationModal() {
            document.getElementById(\'donName\').value = \'فاعل خير\';
            document.getElementById(\'donPhone\').value = \'\';
            document.getElementById(\'donAmount\').value = \'\';
            document.getElementById(\'donNotes\').value = \'\';
            document.getElementById(\'addDonationModal\').style.display = \'flex\';
        }';

$new_open_don = '        function openAddDonationModal() {
            document.getElementById(\'donName\').value = \'فاعل خير\';
            document.getElementById(\'donPhone\').value = \'\';
            document.getElementById(\'donAmount\').value = \'\';
            document.getElementById(\'donNotes\').value = \'\';
            let container = document.getElementById(\'addDonAttachmentsContainer\');
            if(container) {
                container.innerHTML = \'\';
                addAttachmentRow(\'addDonAttachmentsContainer\');
            }
            document.getElementById(\'addDonationModal\').style.display = \'flex\';
        }';

$code = str_replace($old_open_don, $new_open_don, $code);

// 3. تحديث دالة حفظ التبرع الجديد لترسل الملفات بـ FormData مثل المصروفات
$old_save_don = '        function saveNewDonation() {
            let title = document.getElementById(\'donName\').value;
            let phone = document.getElementById(\'donPhone\').value;
            let type = document.getElementById(\'donType\').value;
            let amount = document.getElementById(\'donAmount\').value;
            let transaction_date = document.getElementById(\'donDate\').value;
            let method = document.getElementById(\'donMethod\').value;
            let notes = document.getElementById(\'donNotes\').value;

            if(!title || !amount || !transaction_date) {
                alert(\'الرجاء إدخال الحقول الأساسية\');
                return;
            }

            fetch(\'api_finances.php?action=add\', {
                method: \'POST\',
                headers: { \'Content-Type\': \'application/json\' },
                body: JSON.stringify({ type, title, category: \'\', amount, transaction_date, notes: `الهاتف: ${phone} | الطريقة: ${method} | ملاحظات: ${notes}`, file_name: \'\' })
            })
            .then(res => res.json())
            .then(res => {
                if(res.status === \'success\') {
                    closeAddDonationModal();
                    alert(\'تم حفظ التبرع بنجاح!\');
                    loadAllData();
                } else {
                    alert(\'حدث خطأ\');
                }
            });
        }';

$new_save_don = '        function saveNewDonation() {
            let title = document.getElementById(\'donName\').value;
            let phone = document.getElementById(\'donPhone\').value;
            let type = document.getElementById(\'donType\').value;
            let amount = document.getElementById(\'donAmount\').value;
            let transaction_date = document.getElementById(\'donDate\').value;
            let method = document.getElementById(\'donMethod\').value;
            let notes = document.getElementById(\'donNotes\').value;

            if(!title || !amount || !transaction_date) {
                alert(\'الرجاء إدخال الحقول الأساسية\');
                return;
            }

            let formData = new FormData();
            formData.append(\'type\', type);
            formData.append(\'title\', title);
            formData.append(\'category\', \'\');
            formData.append(\'amount\', amount);
            formData.append(\'transaction_date\', transaction_date);
            formData.append(\'notes\', `الهاتف: ${phone} | الطريقة: ${method} | ملاحظات: ${notes}`);

            let container = document.getElementById(\'addDonAttachmentsContainer\');
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
                    closeAddDonationModal();
                    alert(\'تم حفظ التبرع مع المرفق بنجاح!\');
                    loadAllData();
                } else {
                    alert(\'حدث خطأ أثناء الحفظ\');
                }
            })
            .catch(err => alert(\'خطأ في الاتصال: \' + err));
        }';

$code = str_replace($old_save_don, $new_save_don, $code);

file_put_contents($file, $code);
echo "Donation modal and save function updated with attachments successfully!\n";
?>
