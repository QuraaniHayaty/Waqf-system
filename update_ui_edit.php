<?php
require_once 'auth.php';
$file = "finance.php";
$code = file_get_contents($file);

// استبدال نافذة تعديل التبرع لتشمل حقل المرفقات
$edit_don_old = '    <!-- نافذة تعديل تبرع -->
    <div id="editDonationModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <h3>تعديل بيانات التبرع / المساهمة الوقفية</h3>
                <button onclick="closeEditDonationModal()" style="background:none; border:none; font-size:18px; cursor:pointer;">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editDonId">
                <div class="form-group">
                    <label>اسم المتبرع</label>
                    <input type="text" id="editDonName">
                </div>
                <div class="form-group">
                    <label>رقم الهاتف</label>
                    <input type="text" id="editDonPhone">
                </div>
                <div class="form-group">
                    <label>نوع المساهمة / التبرع</label>
                    <select id="editDonType">
                        <option value="سهم وقفي عام">سهم وقفي عام</option>
                        <option value="كفالة حلقة قرآنية">كفالة حلقة قرآنية</option>
                        <option value="دعم جوائز وأنشطة">دعم جوائز وأنشطة</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>المبلغ (ر.ع)</label>
                    <input type="number" step="0.001" id="editDonAmount">
                </div>
                <div class="form-group">
                    <label>تاريخ التبرع</label>
                    <input type="date" id="editDonDate">
                </div>
                <div class="form-group">
                    <label>طريقة الدفع</label>
                    <select id="editDonMethod">
                        <option value="تحويل بنكي">تحويل بنكي</option>
                        <option value="نقداً">نقداً</option>
                        <option value="إيداع مباشر">إيداع مباشر</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>ملاحظات إضافية</label>
                    <input type="text" id="editDonNotes">
                </div>
            </div>
            <div class="modal-footer">
                <button style="background:#6c757d; color:white; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;" onclick="closeEditDonationModal()">إلغاء</button>
                <button class="btn-action-add" onclick="updateDonation()">حفظ التعديلات</button>
            </div>
        </div>
    </div>';

$edit_don_new = '    <!-- نافذة تعديل تبرع -->
    <div id="editDonationModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <h3>تعديل بيانات التبرع / المساهمة الوقفية</h3>
                <button onclick="closeEditDonationModal()" style="background:none; border:none; font-size:18px; cursor:pointer;">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editDonId">
                <div class="form-group">
                    <label>اسم المتبرع</label>
                    <input type="text" id="editDonName">
                </div>
                <div class="form-group">
                    <label>رقم الهاتف</label>
                    <input type="text" id="editDonPhone">
                </div>
                <div class="form-group">
                    <label>نوع المساهمة / التبرع</label>
                    <select id="editDonType">
                        <option value="سهم وقفي عام">سهم وقفي عام</option>
                        <option value="كفالة حلقة قرآنية">كفالة حلقة قرآنية</option>
                        <option value="دعم جوائز وأنشطة">دعم جوائز وأنشطة</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>المبلغ (ر.ع)</label>
                    <input type="number" step="0.001" id="editDonAmount">
                </div>
                <div class="form-group">
                    <label>تاريخ التبرع</label>
                    <input type="date" id="editDonDate">
                </div>
                <div class="form-group">
                    <label>طريقة الدفع</label>
                    <select id="editDonMethod">
                        <option value="تحويل بنكي">تحويل بنكي</option>
                        <option value="نقداً">نقداً</option>
                        <option value="إيداع مباشر">إيداع مباشر</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>المرفق الحالي / إيصال التحويل</label>
                    <div id="editDonFilePreview" style="margin-bottom: 8px; font-size: 13px;"></div>
                    <input type="file" id="editDonFile" style="padding: 6px;">
                    <label style="margin-top: 5px; font-size: 11px; color: #666;"><input type="checkbox" id="removeDonFile"> حذف المرفق الحالي</label>
                </div>
                <div class="form-group">
                    <label>ملاحظات إضافية</label>
                    <input type="text" id="editDonNotes">
                </div>
            </div>
            <div class="modal-footer">
                <button style="background:#6c757d; color:white; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;" onclick="closeEditDonationModal()">إلغاء</button>
                <button class="btn-action-add" onclick="updateDonation()">حفظ التعديلات</button>
            </div>
        </div>
    </div>';

$code = str_replace($edit_don_old, $edit_don_new, $code);

// استبدال نافذة تعديل المصروف لتشمل حقل المرفقات
$edit_exp_old = '    <!-- نافذة تعديل مصروف -->
    <div id="editExpenseModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <h3>تعديل المصروف التشغيلي</h3>
                <button onclick="closeEditExpenseModal()" style="background:none; border:none; font-size:18px; cursor:pointer;">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editExpId">
                <div class="form-group">
                    <label>بند المصروف</label>
                    <select id="editExpTitle">
                        <option value="عقارات الوقف">عقارات الوقف</option>
                        <option value="دعم البرامج">دعم البرامج</option>
                        <option value="أدوات ومعدات تابعة للوقف">أدوات ومعدات تابعة للوقف</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>التصنيف</label>
                    <select id="editExpCategory">
                        <option value="خدمات ومرافق (كهرباء/مياه/إنترنت)">خدمات ومرافق (كهرباء/مياه/إنترنت)</option>
                        <option value="أدوات تعليمية وقرطاسية">أدوات تعليمية وقرطاسية</option>
                        <option value="صيانة ونظافة">صيانة ونظافة</option>
                        <option value="بناء">بناء</option>
                        <option value="مكافآت ورواتب">مكافآت ورواتب</option>
                        <option value="أخرى">أخرى</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>التفاصيل</label>
                    <input type="text" id="editExpDetails">
                </div>
                <div class="form-group">
                    <label>المبلغ (ر.ع)</label>
                    <input type="number" step="0.001" id="editExpAmount">
                </div>
                <div class="form-group">
                    <label>تاريخ الصرف</label>
                    <input type="date" id="editExpDate">
                </div>
            </div>
            <div class="modal-footer">
                <button style="background:#6c757d; color:white; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;" onclick="closeEditExpenseModal()">إلغاء</button>
                <button class="btn-action-add btn-expense-add" onclick="updateExpense()">حفظ التعديلات</button>
            </div>
        </div>
    </div>';

$edit_exp_new = '    <!-- نافذة تعديل مصروف -->
    <div id="editExpenseModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <h3>تعديل المصروف التشغيلي</h3>
                <button onclick="closeEditExpenseModal()" style="background:none; border:none; font-size:18px; cursor:pointer;">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editExpId">
                <div class="form-group">
                    <label>بند المصروف</label>
                    <select id="editExpTitle">
                        <option value="عقارات الوقف">عقارات الوقف</option>
                        <option value="دعم البرامج">دعم البرامج</option>
                        <option value="أدوات ومعدات تابعة للوقف">أدوات ومعدات تابعة للوقف</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>التصنيف</label>
                    <select id="editExpCategory">
                        <option value="خدمات ومرافق (كهرباء/مياه/إنترنت)">خدمات ومرافق (كهرباء/مياه/إنترنت)</option>
                        <option value="أدوات تعليمية وقرطاسية">أدوات تعليمية وقرطاسية</option>
                        <option value="صيانة ونظافة">صيانة ونظافة</option>
                        <option value="بناء">بناء</option>
                        <option value="مكافآت ورواتب">مكافآت ورواتب</option>
                        <option value="أخرى">أخرى</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>التفاصيل</label>
                    <input type="text" id="editExpDetails">
                </div>
                <div class="form-group">
                    <label>المبلغ (ر.ع)</label>
                    <input type="number" step="0.001" id="editExpAmount">
                </div>
                <div class="form-group">
                    <label>تاريخ الصرف</label>
                    <input type="date" id="editExpDate">
                </div>
                <div class="form-group">
                    <label>الفاتورة الحالية / المرفق</label>
                    <div id="editExpFilePreview" style="margin-bottom: 8px; font-size: 13px;"></div>
                    <input type="file" id="editExpFile" style="padding: 6px;">
                    <label style="margin-top: 5px; font-size: 11px; color: #666;"><input type="checkbox" id="removeExpFile"> حذف الفاتورة الحالية</label>
                </div>
            </div>
            <div class="modal-footer">
                <button style="background:#6c757d; color:white; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;" onclick="closeEditExpenseModal()">إلغاء</button>
                <button class="btn-action-add btn-expense-add" onclick="updateExpense()">حفظ التعديلات</button>
            </div>
        </div>
    </div>';

$code = str_replace($edit_exp_old, $edit_exp_new, $code);

// تحديث دوال جافاسكريبت لتعمل مع المرفقات وتتجنب الخطأ
$js_old = '        function openEditDonation(id) {
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

            document.getElementById(\'editDonationModal\').style.display = \'flex\';
        }

        function closeEditDonationModal() {
            document.getElementById(\'editDonationModal\').style.display = \'none\';
        }

        function updateDonation() {
            let id = document.getElementById(\'editDonId\').value;
            let title = document.getElementById(\'editDonName\').value;
            let phone = document.getElementById(\'editDonPhone\').value;
            let type = document.getElementById(\'editDonType\').value;
            let amount = document.getElementById(\'editDonAmount\').value;
            let transaction_date = document.getElementById(\'editDonDate\').value;
            let method = document.getElementById(\'editDonMethod\').value;
            let notes = document.getElementById(\'editDonNotes\').value;

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
                    amount: amount, 
                    transaction_date: transaction_date, 
                    notes: `الهاتف: ${phone} | الطريقة: ${method} | ملاحظات: ${notes}`
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

$js_new = '        function openEditDonation(id) {
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
                preview.innerHTML = `المرفق الحالي: <a href="uploads/${item.file_name}" target="_blank" style="color:#0369a1; font-weight:bold;">${item.file_name}</a>`;
            } else {
                preview.innerHTML = \'<span style="color:#888;">لا يوجد مرفق حالياً</span>\';
            }

            document.getElementById(\'editDonationModal\').style.display = \'flex\';
        }

        function closeEditDonationModal() {
            document.getElementById(\'editDonationModal\').style.display = \'none\';
        }

        function updateDonation() {
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
            } else if(fileInput.files.length > 0) {
                fileName = fileInput.files[0].name;
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

$code = str_replace($js_old, $js_new, $code);

// تحديث دوال تعديل المصروفات في الجافاسكريبت
$js_exp_old = '        function openEditExpense(id) {
            let item = allFinances.find(f => f.id == id);
            if(!item) return;

            document.getElementById(\'editExpId\').value = item.id;
            document.getElementById(\'editExpTitle\').value = item.title;
            document.getElementById(\'editExpCategory\').value = item.category || \'أخرى\';
            document.getElementById(\'editExpDetails\').value = item.notes || \'\';
            document.getElementById(\'editExpAmount\').value = item.amount;
            document.getElementById(\'editExpDate\').value = item.t_date;

            document.getElementById(\'editExpenseModal\').style.display = \'flex\';
        }

        function closeEditExpenseModal() {
            document.getElementById(\'editExpenseModal\').style.display = \'none\';
        }

        function updateExpense() {
            let id = document.getElementById(\'editExpId\').value;
            let title = document.getElementById(\'editExpTitle\').value;
            let category = document.getElementById(\'editExpCategory\').value;
            let details = document.getElementById(\'editExpDetails\').value;
            let amount = document.getElementById(\'editExpAmount\').value;
            let transaction_date = document.getElementById(\'editExpDate\').value;

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
                    notes: details 
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

$js_exp_new = '        function openEditExpense(id) {
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
                preview.innerHTML = `الفاتورة الحالية: <a href="uploads/${item.file_name}" target="_blank" style="color:#0369a1; font-weight:bold;">${item.file_name}</a>`;
            } else {
                preview.innerHTML = \'<span style="color:#888;">لا توجد فاتورة مرفقة حالياً</span>\';
            }

            document.getElementById(\'editExpenseModal\').style.display = \'flex\';
        }

        function closeEditExpenseModal() {
            document.getElementById(\'editExpenseModal\').style.display = \'none\';
        }

        function updateExpense() {
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
            } else if(fileInput.files.length > 0) {
                fileName = fileInput.files[0].name;
            }

            if(!amount || !transaction_date) {
                alert(\'الرجاء إدخال المبلغ وتاريخ الصرف\');
                return;
            }

            fetch(\'api_finances.php?action=update\', {
                method: 'POST',
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

$code = str_replace($js_exp_old, $js_exp_new, $code);
file_put_contents($file, $code);
echo "Edit modal with files updated successfully!";
?>
