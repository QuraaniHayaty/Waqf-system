<?php
require_once 'auth.php';
$file = 'finance.php';
$code = file_get_contents($file);

// استبدال كود نافذة إضافة المصروف
$modal_old = '    <!-- نافذة تسجيل مصروف جديد بتصميم برنامج المدرسة المخصص للوقف -->
    <div id="addExpenseModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <h3>تسجيل مصروف جديد</h3>
                <button onclick="closeAddExpenseModal()" style="background:none; border:none; font-size:18px; cursor:pointer;">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>بند المصروف</label>
                    <select id="expTitle">
                        <option value="عقارات الوقف">عقارات الوقف</option>
                        <option value="دعم البرامج">دعم البرامج</option>
                        <option value="أدوات ومعدات تابعة للوقف">أدوات ومعدات تابعة للوقف</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>التصنيف</label>
                    <select id="expCategory">
                        <option value="خدمات ومرافق (كهرباء/مياه/إنترنت)">خدمات ومرافق (كهرباء/مياه/إنترنت)</option>
                        <option value="أدوات تعليمية وقرطاسية">أدوات تعليمية وقرطاسية</option>
                        <option value="صيانة ونظافة">صيانة ونظافة</option>
                        <option value="مكافآت ورواتب">مكافآت ورواتب</option>
                        <option value="أخرى">أخرى</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>المبلغ (ر.ع)</label>
                    <input type="number" step="0.001" id="expAmount" placeholder="0.000">
                </div>
                <div class="form-group">
                    <label>تاريخ الصرف</label>
                    <input type="date" id="expDate" value="' . date('Y-m-d') . '">
                </div>
                <div class="form-group">
                    <label>إرفاق الفاتورة / الإيصال (اختياري)</label>
                    <input type="file" id="expFile" style="padding: 6px;">
                </div>
            </div>
            <div class="modal-footer">
                <button style="background:#6c757d; color:white; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;" onclick="closeAddExpenseModal()">إلغاء</button>
                <button class="btn-action-add btn-expense-add" onclick="saveExpense()">حفظ المصروف</button>
            </div>
        </div>
    </div>';

$modal_new = '    <!-- نافذة تسجيل مصروف جديد بتصميم برنامج المدرسة المخصص للوقف -->
    <div id="addExpenseModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <h3>تسجيل مصروف جديد</h3>
                <button onclick="closeAddExpenseModal()" style="background:none; border:none; font-size:18px; cursor:pointer;">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>بند المصروف</label>
                    <select id="expTitle">
                        <option value="عقارات الوقف">عقارات الوقف</option>
                        <option value="دعم البرامج">دعم البرامج</option>
                        <option value="أدوات ومعدات تابعة للوقف">أدوات ومعدات تابعة للوقف</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>التصنيف</label>
                    <select id="expCategory">
                        <option value="خدمات ومرافق (كهرباء/مياه/إنترنت)">خدمات ومرافق (كهرباء/مياه/إنترنت)</option>
                        <option value="أدوات تعليمية وقرطاسية">أدوات تعليمية وقرطاسية</option>
                        <option value="صيانة ونظافة">صيانة ونظافة</option>
                        <option value="بناء">بناء</option>
                        <option value="مكافآت ورواتب">مكافآت ورواتب</option>
                        <option value="أخرى">أخرى</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>التفاصيل (وصف إضافي للمصروف)</label>
                    <input type="text" id="expDetails" placeholder="اكتب تفاصيل إضافية هنا...">
                </div>
                <div class="form-group">
                    <label>المبلغ (ر.ع)</label>
                    <input type="number" step="0.001" id="expAmount" placeholder="0.000">
                </div>
                <div class="form-group">
                    <label>تاريخ الصرف</label>
                    <input type="date" id="expDate" value="' . date('Y-m-d') . '">
                </div>
                <div class="form-group">
                    <label>إرفاق الفاتورة / الإيصال (اختياري)</label>
                    <input type="file" id="expFile" style="padding: 6px;">
                </div>
            </div>
            <div class="modal-footer">
                <button style="background:#6c757d; color:white; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;" onclick="closeAddExpenseModal()">إلغاء</button>
                <button class="btn-action-add btn-expense-add" onclick="saveExpense()">حفظ المصروف</button>
            </div>
        </div>
    </div>';

// تطبيق التعديل وتحديث دالة saveExpense
$code = str_replace($modal_old, $modal_new, $code);
file_put_contents($file, $code);
echo "Patched successfully!";
?>
