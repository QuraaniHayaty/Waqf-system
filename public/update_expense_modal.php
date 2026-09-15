<?php
$file = "finance.php";
$content = file_get_contents($file);

// 1. إضافة خيار "بناء" في قائمة التصنيفات للمصروفات
$old_select = '<select id="expCategory">
                        <option value="خدمات ومرافق (كهرباء/مياه/إنترنت)">خدمات ومرافق (كهرباء/مياه/إنترنت)</option>
                        <option value="أدوات تعليمية وقرطاسية">أدوات تعليمية وقرطاسية</option>
                        <option value="صيانة ونظافة">صيانة ونظافة</option>
                        <option value="مكافآت ورواتب">مكافآت ورواتب</option>
                        <option value="أخرى">أخرى</option>
                    </select>';

$new_select = '<select id="expCategory">
                        <option value="خدمات ومرافق (كهرباء/مياه/إنترنت)">خدمات ومرافق (كهرباء/مياه/إنترنت)</option>
                        <option value="أدوات تعليمية وقرطاسية">أدوات تعليمية وقرطاسية</option>
                        <option value="صيانة ونظافة">صيانة ونظافة</option>
                        <option value="بناء">بناء</option>
                        <option value="مكافآت ورواتب">مكافآت ورواتب</option>
                        <option value="أخرى">أخرى</option>
                    </select>';

$content = str_replace($old_select, $new_select, $content);

// 2. إضافة حقل "التفاصيل" فوق المبلغ مباشرة داخل نافذة المصروفات
$old_group = '<div class="form-group">
                    <label>المبلغ (ر.ع)</label>
                    <input type="number" step="0.001" id="expAmount" placeholder="0.000">
                </div>';

$new_group = '<div class="form-group">
                    <label>التفاصيل (وصف إضافي للمصروف)</label>
                    <input type="text" id="expDetails" placeholder="اكتب تفاصيل إضافية هنا...">
                </div>
                <div class="form-group">
                    <label>المبلغ (ر.ع)</label>
                    <input type="number" step="0.001" id="expAmount" placeholder="0.000">
                </div>';

$content = str_replace($old_group, $new_group, $content);

// 3. تحديث دالة الحفظ في الجافاسكريبت لتشمل حقل التفاصيل
$content = str_str_replace_fixed($content);

file_put_contents($file, $content);
echo "Expense modal updated successfully!";
?>
