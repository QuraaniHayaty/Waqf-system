<?php
require_once 'auth.php';
$file = "finance.php";
$code = file_get_contents($file);

// استبدال كود دوال التعديل والحفظ في finance.php لتكون مستوحاة ومنسقة تماماً مثل عقود الإيجار المضبوطة
$new_js_logic = '
    <script>
        let allFinances = [];
        let allLeases = [];
        let activeSection = \'donation\';

        document.addEventListener("DOMContentLoaded", function() {
            loadAllData();
        });

        function loadAllData() {
            Promise.all([
                fetch(\'api_finances.php?action=getAll\').then(res => res.json()),
                fetch(\'api_leases.php?action=getAll\').then(res => res.json())
            ])
            .then(([finances, leases]) => {
                allFinances = finances;
                allLeases = leases;
                updateDashboardStats();
                renderActiveSection();
            });
        }

        function updateDashboardStats() {
            let startDate = document.getElementById(\'filterStartDate\').value;
            let endDate = document.getElementById(\'filterEndDate\').value;

            let leasesTotal = 0;
            allLeases.forEach(l => {
                let d = l.start_date || \'\';
                if((!startDate || d >= startDate) && (!endDate || d <= endDate)) {
                    leasesTotal += parseFloat(l.amount || 0);
                }
            });

            let donationsTotal = 0;
            let expensesTotal = 0;

            allFinances.forEach(f => {
                let d = f.t_date || \'\';
                if((!startDate || d >= startDate) && (!endDate || d <= endDate)) {
                    if(f.type === \'expense\') {
                        expensesTotal += parseFloat(f.amount || 0);
                    } else {
                        donationsTotal += parseFloat(f.amount || 0);
                    }
                }
            });

            let netBalance = (leasesTotal + donationsTotal) - expensesTotal;

            document.getElementById(\'statLeasesIncome\').innerText = leasesTotal.toFixed(3) + \' ر.ع\';
            document.getElementById(\'statDonations\').innerText = donationsTotal.toFixed(3) + \' ر.ع\';
            document.getElementById(\'statExpenses\').innerText = expensesTotal.toFixed(3) + \' ر.ع\';
            document.getElementById(\'statNetBalance\').innerText = netBalance.toFixed(3) + \' ر.ع\';
        }

        function switchSection(section) {
            activeSection = section;
            document.querySelectorAll(\'.tab-btn\').forEach(b => b.classList.remove(\'active\'));
            
            let btnContainer = document.getElementById(\'actionButtonContainer\');

            if(section === \'donation\') {
                document.getElementById(\'btnTabDonation\').classList.add(\'active\');
                btnContainer.innerHTML = \'<button class="btn-action-add" onclick="openAddDonationModal()">➕ تسجيل تبرع جديد</button>\';
            } else if(section === \'lease\') {
                document.getElementById(\'btnTabLease\').classList.add(\'active\');
                btnContainer.innerHTML = \'<span style="color:#666; font-size:13px; font-weight:bold;">(إيرادات الإيجارات تُدار من عقود الإيجار)</span>\';
            } else if(section === \'expense\') {
                document.getElementById(\'btnTabExpense\').classList.add(\'active\');
                btnContainer.innerHTML = \'<button class="btn-action-add btn-expense-add" onclick="openAddExpenseModal()">➕ تسجيل مصروف جديد</button>\';
            }

            renderActiveSection();
        }

        function renderActiveSection() {
            updateDashboardStats();
            let tbody = document.getElementById(\'tableBody\');
            tbody.innerHTML = \'\';

            let startDate = document.getElementById(\'filterStartDate\').value;
            let endDate = document.getElementById(\'filterEndDate\').value;

            let headerRow = document.getElementById(\'tableHeaderRow\');
            let titleEl = document.getElementById(\'sectionTitle\');

            if(activeSection === \'donation\') {
                titleEl.innerText = \'سجل التبرعات والأسهم الوقفية\';
                headerRow.innerHTML = `
                    <th>#</th>
                    <th>اسم المتبرع</th>
                    <th>الهاتف</th>
                    <th>نوع المساهمة</th>
                    <th>المبلغ</th>
                    <th>تاريخ التبرع</th>
                    <th>طريقة الدفع</th>
                    <th>الإيصال</th>
                    <th>ملاحظات</th>
                    <th>الإجراءات</th>
                `;

                let filtered = allFinances.filter(f => f.type !== \'expense\');
                if(startDate || endDate) {
                    filtered = filtered.filter(f => (!startDate || f.t_date >= startDate) && (!endDate || f.t_date <= endDate));
                }

                if(filtered.length === 0) {
                    tbody.innerHTML = \'<tr><td colspan="10" style="text-align:center; color:#777;">لا توجد تبرعات مسجلة.</td></tr>\';
                    return;
                }

                filtered.forEach((item, idx) => {
                    let fileLink = item.file_name ? `<a href="uploads/${item.file_name}" target="_blank" style="color:#0369a1; font-weight:bold; text-decoration:none;">📄 عرض الإيصال</a>` : \'<span style="color:#999;">لا يوجد</span>\';
                    let tr = document.createElement(\'tr\');
                    tr.innerHTML = `
                        <td>${idx + 1}</td>
                        <td><strong>${item.title}</strong></td>
                        <td>${item.phone || \'-\'}</td>
                        <td><span style="background:#e0f2fe; color:#0369a1; padding:3px 8px; border-radius:4px; font-weight:bold;">${item.type}</span></td>
                        <td><strong style="color:#27ae60;">${parseFloat(item.amount).toFixed(3)} ر.ع</strong></td>
                        <td>${item.t_date || \'-\'}</td>
                        <td>${item.method || \'-\'}</td>
                        <td>${fileLink}</td>
                        <td>${item.notes || \'-\'}</td>
                        <td>
                            <div style="display:flex; gap:4px; align-items:center;">
                                <button onclick="openEditDonation(${item.id})" class="btn-edit">تعديل</button>
                                <button onclick="deleteRecord(${item.id})" class="btn-delete">حذف</button>
                            </div>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });

            } else if(activeSection === \'lease\') {
                titleEl.innerText = \'إيرادات عقود الإيجار (للاطلاع والمتابعة)\';
                headerRow.innerHTML = `
                    <th>#</th>
                    <th>العقار والوحدة</th>
                    <th>المستأجر ورقم الهاتف</th>
                    <th>مدة العقد</th>
                    <th>القيمة الإيجارية</th>
                    <th>تاريخ التسجيل</th>
                `;

                let filtered = allLeases;
                if(startDate || endDate) {
                    filtered = filtered.filter(l => (!startDate || l.start_date >= startDate) && (!endDate || l.start_date <= endDate));
                }

                if(filtered.length === 0) {
                    tbody.innerHTML = \'<tr><td colspan="6" style="text-align:center; color:#777;">لا توجد عقود إيجار مسجلة.</td></tr>\';
                    return;
                }

                filtered.forEach((lease, idx) => {
                    let tr = document.createElement(\'tr\');
                    tr.innerHTML = `
                        <td>${idx + 1}</td>
                        <td><strong>${lease.prop}</strong><br><small>${lease.floor} (${lease.unit})</small></td>
                        <td>${lease.tenant}<br><small>📞 ${lease.phone || \'-\'}</small></td>
                        <td>من: ${lease.start_date}<br>إلى: ${lease.end_date}</td>
                        <td><strong style="color:#27ae60;">${parseFloat(lease.amount).toFixed(3)} ر.ع</strong></td>
                        <td>${lease.created_at || \'-\'}</td>
                    `;
                    tbody.appendChild(tr);
                });

            } else if(activeSection === \'expense\') {
                titleEl.innerText = \'سجل المصروفات التشغيلية للوقف\';
                headerRow.innerHTML = `
                    <th>#</th>
                    <th>بند المصروف</th>
                    <th>التصنيف</th>
                    <th>التفاصيل</th>
                    <th>المبلغ</th>
                    <th>تاريخ الصرف</th>
                    <th>الفاتورة</th>
                    <th>الإجراءات</th>
                `;

                let filtered = allFinances.filter(f => f.type === \'expense\');
                if(startDate || endDate) {
                    filtered = filtered.filter(f => (!startDate || f.t_date >= startDate) && (!endDate || f.t_date <= endDate));
                }

                if(filtered.length === 0) {
                    tbody.innerHTML = \'<tr><td colspan="8" style="text-align:center; color:#777;">لا توجد مصروفات مسجلة.</td></tr>\';
                    return;
                }

                filtered.forEach((item, idx) => {
                    let fileLink = item.file_name ? `<a href="uploads/${item.file_name}" target="_blank" style="color:#0369a1; font-weight:bold; text-decoration:none;">📄 الفاتورة</a>` : \'<span style="color:#999;">لا يوجد</span>\';
                    let tr = document.createElement(\'tr\');
                    tr.innerHTML = `
                        <td>${idx + 1}</td>
                        <td><strong>${item.title}</strong></td>
                        <td><span style="background:#fee2e2; color:#991b1b; padding:3px 8px; border-radius:4px; font-weight:bold;">${item.category || \'-\'}</span></td>
                        <td>${item.notes || \'-\'}</td>
                        <td><strong style="color:#c0392b;">${parseFloat(item.amount).toFixed(3)} ر.ع</strong></td>
                        <td>${item.t_date || \'-\'}</td>
                        <td>${fileLink}</td>
                        <td>
                            <div style="display:flex; gap:4px; align-items:center;">
                                <button onclick="openEditExpense(${item.id})" class="btn-edit">تعديل</button>
                                <button onclick="deleteRecord(${item.id})" class="btn-delete">حذف</button>
                            </div>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
            }
        }

        function resetFilters() {
            document.getElementById(\'filterStartDate\').value = \'\';
            document.getElementById(\'filterEndDate\').value = \'\';
            renderActiveSection();
        }

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

        function openAddDonationModal() {
            document.getElementById(\'donName\').value = \'فاعل خير\';
            document.getElementById(\'donPhone\').value = \'\';
            document.getElementById(\'donAmount\').value = \'\';
            document.getElementById(\'donNotes\').value = \'\';
            document.getElementById(\'addDonationModal\').style.display = \'flex\';
        }

        function closeAddDonationModal() {
            document.getElementById(\'addDonationModal\').style.display = \'none\';
        }

        function saveNewDonation() {
            let title = document.getElementById(\'donName\').value;
            let phone = document.getElementById(\'donPhone\').value;
            let type = document.getElementById(\'donType\').value;
            let amount = document.getElementById(\'donAmount\').value;
            let transaction_date = document.getElementById(\'donDate\').value;
            let method = document.getElementById(\'donMethod\').value;
            let notes = document.getElementById(\'donNotes\').value;

            if(!title || !amount || !transaction_date) {
                alert(\'الرجاء إدخال اسم المتبرع والمبلغ وتاريخ التبرع\');
                return;
            }

            fetch(\'api_finances.php?action=add\', {
                method: \'POST\',
                headers: { \'Content-Type\': \'application/json\' },
                body: JSON.stringify({ 
                    type: type, 
                    title: title, 
                    category: \'\',
                    amount: amount, 
                    transaction_date: transaction_date, 
                    notes: `الهاتف: ${phone} | الطريقة: ${method} | ملاحظات: ${notes}`,
                    file_name: \'\'
                })
            })
            .then(res => res.json())
            .then(res => {
                if(res.status === \'success\') {
                    closeAddDonationModal();
                    alert(\'تم حفظ التبرع بنجاح!\');
                    loadAllData();
                } else {
                    alert(\'حدث خطأ أثناء الحفظ\');
                }
            });
        }

        function openEditDonation(id) {
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
                let row = document.createElement(\'div\');
                row.className = \'attachment-row\';
                row.style.cssText = \'display:flex; gap:10px; align-items:center; margin-bottom:8px;\';
                row.innerHTML = `<span style="flex:1; font-size:13px; color:#0369a1; font-weight:bold;">📄 ${item.file_name}</span> <button type="button" class="btn-remove-att" onclick="this.parentElement.remove()" style="background:#e74c3c; color:white; border:none; padding:4px 8px; border-radius:4px; cursor:pointer; font-size:11px;">حذف</button>`;
                container.appendChild(row);
            }
            addAttachmentRow(\'editDonAttachmentsContainer\');

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

            let container = document.getElementById(\'editDonAttachmentsContainer\');
            let filesList = [];
            if(container) {
                container.querySelectorAll(\'.attachment-row\').forEach(row => {
                    let span = row.querySelector(\'span\');
                    let fileInput = row.querySelector(\'input[type="file"]\');
                    if(span) {
                        filesList.push(span.innerText.replace(\'📄 \', \'\').trim());
                    } else if(fileInput && fileInput.files.length > 0) {
                        filesList.push(fileInput.files[0].name);
                    }
                });
            }
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
        }

        function openAddExpenseModal() {
            document.getElementById(\'expDetails\').value = \'\';
            document.getElementById(\'expAmount\').value = \'\';
            document.getElementById(\'addExpenseModal\').style.display = \'flex\';
        }

        function closeAddExpenseModal() {
            document.getElementById(\'addExpenseModal\').style.display = \'none\';
        }

        function saveNewExpense() {
            let title = document.getElementById(\'expTitle\').value;
            let category = document.getElementById(\'expCategory\').value;
            let details = document.getElementById(\'expDetails\').value;
            let amount = document.getElementById(\'expAmount\').value;
            let transaction_date = document.getElementById(\'expDate\').value;

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
                    file_name: \'\' 
                })
            })
            .then(res => res.json())
            .then(res => {
                if(res.status === \'success\') {
                    closeAddExpenseModal();
                    alert(\'تم حفظ المصروف بنجاح!\');
                    loadAllData();
                } else {
                    alert(\'حدث خطأ أثناء الحفظ\');
                }
            });
        }

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
            container.innerHTML = \'\';
            if(item.file_name) {
                let row = document.createElement(\'div\');
                row.className = \'attachment-row\';
                row.style.cssText = \'display:flex; gap:10px; align-items:center; margin-bottom:8px;\';
                row.innerHTML = `<span style="flex:1; font-size:13px; color:#0369a1; font-weight:bold;">📄 ${item.file_name}</span> <button type="button" class="btn-remove-att" onclick="this.parentElement.remove()" style="background:#e74c3c; color:white; border:none; padding:4px 8px; border-radius:4px; cursor:pointer; font-size:11px;">حذف</button>`;
                container.appendChild(row);
            }
            addAttachmentRow(\'editExpAttachmentsContainer\');

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

            let container = document.getElementById(\'editExpAttachmentsContainer\');
            let filesList = [];
            if(container) {
                container.querySelectorAll(\'.attachment-row\').forEach(row => {
                    let span = row.querySelector(\'span\');
                    let fileInput = row.querySelector(\'input[type="file"]\');
                    if(span) {
                        filesList.push(span.innerText.replace(\'📄 \', \'\').trim());
                    } else if(fileInput && fileInput.files.length > 0) {
                        filesList.push(fileInput.files[0].name);
                    }
                });
            }
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
        }

        function deleteRecord(id) {
            if(confirm(\'هل أنت متأكد من حذف هذا السجل؟\')) {
                fetch(\'api_finances.php?action=delete\', {
                    method: \'POST\',
                    headers: { \'Content-Type\': \'application/json\' },
                    body: JSON.stringify({ id: id })
                })
                .then(res => res.json())
                .then(res => {
                    if(res.status === \'success\') {
                        alert(\'تم الحذف بنجاح\');
                        loadAllData();
                    }
                });
            }
        }
    </script>
';

// استبدال كود السكربت القديم بالكامل بالكود الجديد المضبوط
$start_pos = strpos($code, '<script>');
$end_pos = strrpos($code, '</script>');
if ($start_pos !== false && $end_pos !== false) {
    $code = substr_replace($code, $new_js_logic, $start_pos, ($end_pos + strlen('</script>')) - $start_pos);
}

// التأكد من استبدال دالة الحفظ القديمة saveDonation بـ saveNewDonation في الأزرار
$code = str_replace('onclick="saveDonation()"', 'onclick="saveNewDonation()"', $code);
$code = str_replace('onclick="saveExpense()"', 'onclick="saveNewExpense()"', $code);

file_put_contents($file, $code);
echo "Finance JS synced successfully like leases!\n";
?>
