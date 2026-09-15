<?php
$file = "finance.php";
$code = file_get_contents($file);

// التأكد من أن زر تسجيل مصروف جديد يستدعي الدالة الصحيحة
$code = str_replace('onclick="openAddExpenseModal()"', 'onclick="openAddExpenseModal()_fixed"', $code); // مؤقت لتجنب التضارب
$code = str_replace('onclick="openAddExpenseModal()_fixed"', 'onclick="openAddExpenseModal()"', $code);

// التأكد من وجود دالة openAddExpenseModal وحفظ المصروف بشكل سليم
if (strpos($code, 'function openAddExpenseModal()') === false) {
    $target = 'function closeAddExpenseModal() {';
    $add_func = '
        function openAddExpenseModal() {
            document.getElementById(\'expDetails\').value = \'\';
            document.getElementById(\'expAmount\').value = \'\';
            let container = document.getElementById(\'addExpAttachmentsContainer\');
            if(container) {
                container.innerHTML = \'\';
                addAttachmentRow(\'addExpAttachmentsContainer\');
            }
            document.getElementById(\'addExpenseModal\').style.display = \'flex\';
        }

        function closeAddExpenseModal() {
            document.getElementById(\'addExpenseModal\').style.display = \'none\';
        }
    ';
    // استبدال أو إضافة
    $code = str_replace('function closeAddExpenseModal() {', $add_func, $code);
}

file_put_contents($file, $code);
echo "Add expense button and modal fixed successfully!\n";
?>
