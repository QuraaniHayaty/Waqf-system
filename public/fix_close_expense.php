<?php
$file = "finance.php";
$code = file_get_contents($file);

// التأكد من إضافة دالة closeEditExpenseModal إن لم تكن موجودة
if (strpos($code, 'function closeEditExpenseModal') === false) {
    $target = 'function openEditExpense(id) {';
    $close_func = '
        function closeEditExpenseModal() {
            document.getElementById(\'editExpenseModal\').style.display = \'none\';
        }
    ';
    $code = str_replace($target, $close_func . "\n" . $target, $code);
}

file_put_contents($file, $code);
echo "closeEditExpenseModal added successfully!\n";
?>
