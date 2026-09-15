<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عقود الإيجارات - وقف تعليم القرآن الكريم والعلوم الشرعية</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f4f6f9; display: flex; height: 100vh; overflow: hidden; direction: rtl; text-align: right; }
        
        aside { width: 285px; height: 100vh; background-color: #fcf6f5; border-left: 1px solid #f2e8e6; display: flex; flex-direction: column; justify-content: space-between; flex-shrink: 0; }
        .sidebar-header { text-align: center; padding: 22px 10px; border-bottom: 1px solid #f2e8e6; background-color: #fcf6f5; z-index: 10; }
        .sidebar-header img { max-width: 195px; height: auto; object-fit: contain; mix-blend-mode: multiply; }
        
        .nav-container { flex-grow: 1; overflow-y: auto; padding: 15px 10px; }
        .nav-menu { list-style: none; }
        .nav-menu li { margin-bottom: 6px; }
        .nav-menu a { display: flex; align-items: center; padding: 11px 15px; color: #2e5a36; text-decoration: none; border-radius: 8px; font-size: 15px; font-weight: 600; transition: all 0.2s; }
        .nav-menu a:hover, .nav-menu a.active { background-color: #27ae60; color: #ffffff; }
        
        .logout-section { padding: 15px 20px; border-top: 1px solid #f2e8e6; background-color: #fcf6f5; z-index: 10; }
        .logout-btn { display: flex; align-items: center; justify-content: center; padding: 11px; background-color: #fde8e8; color: #c0392b; text-decoration: none; border-radius: 8px; font-size: 14px; transition: all 0.2s; font-weight: bold; border: 1px solid #f5c6cb; }
        .logout-btn:hover { background-color: #c0392b; color: white; }
        
        main { flex-grow: 1; display: flex; flex-direction: column; background-color: #f9fafb; overflow-y: auto; height: 100vh; }
        .top-header-bar { background-color: #fcf6f5; padding: 15px 30px; border-bottom: 1px solid #f2e8e6; text-align: right; font-size: 22px; font-weight: 700; color: #2e5a36; }
        
        .top-banner { background-color: #27ae60; color: white; margin: 25px; padding: 25px 30px; border-radius: 10px; display: flex; justify-content: space-between; align-items: center; }
        .banner-title h1 { font-size: 24px; margin-bottom: 5px; font-weight: bold; }
        .banner-title p { font-size: 14px; opacity: 0.9; }
        
        .action-bar { padding: 0 25px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
        .btn-add { background-color: #27ae60; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: bold; transition: background 0.2s; cursor: pointer; border: none; }
        .btn-add:hover { background-color: #219653; }
        
        .btn-archive-view { background-color: #e67e22; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: bold; cursor: pointer; border: none; }
        .btn-archive-view:hover { background-color: #d35400; }

        .content-card { background: white; margin: 0 25px 25px 25px; padding: 20px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .search-box { margin-bottom: 15px; }
        .search-box input { width: 250px; padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; }
        
        table { width: 100%; border-collapse: collapse; text-align: right; }
        th, td { padding: 12px 15px; border-bottom: 1px solid #eee; font-size: 14px; color: #333; }
        th { background-color: #f8f9fa; color: #2e5a36; font-weight: 600; }
        tr:hover { background-color: #fcfcfc; }
        
        .btn-action-edit { background: #eef2f5; border: none; padding: 5px 8px; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 11px; color: #333; }
        .btn-action-delete { background: #fee2e2; border: none; padding: 5px 8px; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 11px; color: #dc2626; }

        .badge-active { background-color: #dcfce7; color: #166534; padding: 2px 8px; border-radius: 4px; font-size: 11px; font-weight: bold; display: inline-block; margin-top: 3px; }
        .badge-expired { background-color: #fee2e2; color: #991b1b; padding: 2px 8px; border-radius: 4px; font-size: 11px; font-weight: bold; display: inline-block; margin-top: 3px; }

        .modal-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); z-index: 1000; justify-content: center; align-items: center; }
        .modal-box { background: white; width: 680px; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.15); overflow: hidden; animation: fadeIn 0.2s ease-in-out; max-height: 90vh; display: flex; flex-direction: column; }
        .modal-header { display: flex; justify-content: space-between; align-items: center; padding: 15px 20px; border-bottom: 1px solid #eee; }
        .modal-header h3 { font-size: 16px; color: #333; font-weight: bold; }
        .close-modal { background: none; border: none; font-size: 20px; cursor: pointer; color: #888; }
        .close-modal:hover { color: #333; }
        .modal-body { padding: 20px; overflow-y: auto; flex-grow: 1; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-size: 13px; color: #555; margin-bottom: 5px; text-align: right; font-weight: bold; }
        .form-group input, .form-group select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; text-align: right; background: #fff; }
        
        .date-row { display: flex; gap: 10px; }
        .date-row .form-group { flex: 1; margin-bottom: 0; }

        .attachment-row { display: flex; gap: 10px; align-items: center; margin-bottom: 8px; }
        .btn-add-attachment { background-color: #3498db; color: white; border: none; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: bold; cursor: pointer; margin-top: 5px; }
        .btn-add-attachment:hover { background-color: #2980b9; }
        .btn-remove-att { background: #e74c3c; color: white; border: none; padding: 6px 10px; border-radius: 4px; cursor: pointer; font-size: 12px; }

        .modal-footer { padding: 15px 20px; border-top: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; background: #fafafa; }
        .btn-save { background-color: #27ae60; color: white; border: none; padding: 8px 18px; border-radius: 6px; font-size: 14px; font-weight: bold; cursor: pointer; }
        .btn-save:hover { background-color: #219653; }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
        
        .pagination { display: flex; justify-content: flex-end; align-items: center; margin-top: 20px; gap: 5px; font-size: 14px; color: #666; }
        .pagination button { padding: 5px 10px; border: 1px solid #ddd; background: white; border-radius: 4px; cursor: pointer; }
        .pagination button.active { background: #27ae60; color: white; border-color: #27ae60; }
    </style>
</head>
<body>
    <aside>
        <div class="sidebar-header">
            <img src="logo.png" alt="شعار الوقف">
        </div>
        <div class="nav-container">
            <ul class="nav-menu">
                <li><a href="index.php">لوحة التحكم</a></li>
                <li><a href="properties.php">بيانات عقارات الوقف</a></li>
                <li><a href="#">قائمة البرامج المستفيدة</a></li>
                <li><a href="leases.php" class="active">عقود الإيجارات</a></li>
                <li><a href="#">الحسابات</a></li>
                <li><a href="#">قائمة واتساب</a></li>
                <li><a href="#">الإعدادات</a></li>
            </ul>
        </div>
        <div class="logout-section">
            <a href="#" class="logout-btn">تسجيل الخروج</a>
        </div>
    </aside>
    <main>
        <div class="top-header-bar">
            وقف تعليم القرآن الكريم والعلوم الشرعية بقرية الروضة
        </div>
        
        <div class="top-banner">
            <div class="banner-title">
                <h1>عقود الإيجارات</h1>
                <p>إدارة وإبرام وتجديد عقود الإيجار ومتابعة الصلاحية والأرشيف (قاعدة بيانات MySQL)</p>
            </div>
        </div>

        <div class="action-bar">
            <button class="btn-add" onclick="openAddLeaseModal()">➕ إضافة عقد إيجار</button>
            <button class="btn-archive-view" onclick="openArchiveModal()">📁 أرشيف العقود المنتهية</button>
        </div>

        <div class="content-card">
            <div class="search-box">
                <input type="text" placeholder="بحث عن عقد...">
            </div>
            <table>
                <thead>
                    <tr>
                        <th>المعرف</th>
                        <th>اسم العقار</th>
                        <th>الطابق والوحدة</th>
                        <th>المستأجر ورقم الهاتف</th>
                        <th>مدة العقد وحالته</th>
                        <th>القيمة الإيجارية</th>
                        <th>المرفقات</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody id="leasesTableBody">
                    <!-- يتم جلب العقود ديناميكياً من MySQL -->
                </tbody>
            </table>
            <div class="pagination">
                <span id="leasesPaginationText">جاري التحميل...</span>
                <button>&lt;</button>
                <button class="active">1</button>
                <button>&gt;</button>
            </div>
        </div>
    </main>

    <!-- نافذة إضافة عقد إيجار -->
    <div id="addLeaseModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <h3>إضافة عقد إيجار جديد</h3>
                <button class="close-modal" onclick="closeAddLeaseModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>اختر العقار</label>
                    <select id="leasePropSelect" onchange="loadFloatsForProperty('leasePropSelect', 'leaseFloorSelect', 'leaseUnitSelect')">
                        <option value="" disabled selected>اختر العقار</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>اختر الطابق</label>
                    <select id="leaseFloorSelect" onchange="loadUnitsForFloor('leasePropSelect', 'leaseFloorSelect', 'leaseUnitSelect')">
                        <option value="" disabled selected>اختر الطابق أولاً</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>اختر الوحدة</label>
                    <select id="leaseUnitSelect">
                        <option value="" disabled selected>اختر الوحدة أولاً</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>اسم المستأجر</label>
                    <input type="text" id="leaseTenant" placeholder="أدخل اسم المستأجر">
                </div>
                <div class="form-group">
                    <label>رقم هاتف المستأجر</label>
                    <input type="text" id="leasePhone" placeholder="أدخل رقم الهاتف">
                </div>
                
                <div class="date-row">
                    <div class="form-group">
                        <label>تاريخ بداية العقد (من)</label>
                        <input type="date" id="leaseStartDate">
                    </div>
                    <div class="form-group">
                        <label>تاريخ نهاية العقد (إلى)</label>
                        <input type="date" id="leaseEndDate">
                    </div>
                </div>

                <div class="form-group" style="margin-top: 15px;">
                    <label>القيمة الإيجارية الشهرية (ر.ع)</label>
                    <input type="number" id="leaseAmount" placeholder="أدخل المبلغ">
                </div>
                
                <div class="form-group">
                    <label>مرفقات العقد والمستندات</label>
                    <div id="add-attachments-container"></div>
                    <button type="button" class="btn-add-attachment" onclick="addAttachmentRow('add-attachments-container')">➕ إضافة مرفق جديد</button>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-save" onclick="saveNewLease()">حفظ العقد في قاعدة البيانات</button>
            </div>
        </div>
    </div>

    <!-- نافذة أرشيف العقود -->
    <div id="archiveModal" class="modal-overlay">
        <div class="modal-box" style="width: 900px;">
            <div class="modal-header">
                <h3>أرشيف عقود الإيجار المنتهية والمجددة</h3>
                <button class="close-modal" onclick="closeArchiveModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="search-box" style="margin-bottom: 15px;">
                    <input type="text" id="archiveSearchInput" placeholder="بحث في الأرشيف..." style="width: 280px; padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px;">
                </div>
                <table style="width: 100%;">
                    <thead>
                        <tr style="background: #f8f9fa;">
                            <th>اسم العقار</th>
                            <th>الطابق والوحدة</th>
                            <th>المستأجر</th>
                            <th>مدة العقد وتاريخه</th>
                            <th>القيمة</th>
                            <th>المرفقات</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody id="archiveTableBody"></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <span id="archivePaginationText" style="font-size: 13px; color: #666;">عرض 0 من 0</span>
                <button class="btn-save" onclick="closeArchiveModal()">إغلاق</button>
            </div>
        </div>
    </div>

    <script>
        let propertiesList = [];
        let archiveData = [];
        const currentDate = new Date();

        document.addEventListener("DOMContentLoaded", function() {
            loadPropertiesForDropdowns();
            loadLeasesFromDB();
        });

        function loadPropertiesForDropdowns() {
            fetch('api_properties.php?action=getAll')
                .then(res => res.json())
                .then(data => {
                    propertiesList = data;
                    populatePropSelects();
                });
        }

        function populatePropSelects() {
            let sel = document.getElementById('leasePropSelect');
            if(!sel) return;
            sel.innerHTML = '<option value="" disabled selected>اختر العقار</option>';
            propertiesList.forEach(p => {
                let opt = document.createElement('option');
                opt.value = p.name;
                opt.innerText = p.name;
                sel.appendChild(opt);
            });
        }

        function loadFloatsForProperty(propSelectId, floorSelectId, unitSelectId) {
            let propName = document.getElementById(propSelectId).value;
            let floorSel = document.getElementById(floorSelectId);
            floorSel.innerHTML = '<option value="" disabled selected>اختر الطابق</option>';
            
            let unitSel = document.getElementById(unitSelectId);
            unitSel.innerHTML = '<option value="" disabled selected>اختر الوحدة أولاً</option>';

            let propObj = propertiesList.find(p => p.name === propName);
            if(propObj && propObj.floats) {
                propObj.floats.forEach(f => {
                    let opt = document.createElement('option');
                    opt.value = f.floor;
                    opt.innerText = f.floor;
                    floorSel.appendChild(opt);
                });
            }
        }

        function loadUnitsForFloor(propSelectId, floorSelectId, unitSelectId) {
            let propName = document.getElementById(propSelectId).value;
            let floorName = document.getElementById(floorSelectId).value;
            let unitSel = document.getElementById(unitSelectId);
            unitSel.innerHTML = '<option value="" disabled selected>اختر الوحدة</option>';

            let propObj = propertiesList.find(p => p.name === propName);
            if(propObj && propObj.floats) {
                let floorObj = propObj.floats.find(f => f.floor === floorName);
                if(floorObj && floorObj.units) {
                    floorObj.units.forEach(u => {
                        let opt = document.createElement('option');
                        opt.value = u.no;
                        opt.innerText = `${u.type} (${u.no})`;
                        unitSel.appendChild(opt);
                    });
                }
            }
        }

        function loadLeasesFromDB() {
            fetch('api_leases.php?action=getAll')
                .then(res => res.json())
                .then(data => {
                    let tbody = document.getElementById('leasesTableBody');
                    tbody.innerHTML = '';

                    if(data.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="8" style="text-align:center; color:#777;">لا توجد عقود إيجار مسجلة. اضغط على "إضافة عقد إيجار" للبدء.</td></tr>';
                        document.getElementById('leasesPaginationText').innerText = 'عرض 0 إلى 0 من 0 مدخلات';
                        return;
                    }

                    data.forEach((lease) => {
                        let res = calculateDurationAndStatus(lease.start_date, lease.end_date);
                        let filesArr = lease.files || [];
                        let filesHtml = '<div style="display:flex; flex-direction:column; gap:4px;">';
                        if(filesArr.length === 0) {
                            filesHtml += '<span style="color:#999; font-style:italic;">لا توجد مرفقات</span>';
                        } else {
                            filesArr.forEach(f => {
                                filesHtml += `<a href="#" onclick="viewFile('${f.url}', '${f.name}')" style="color:#27ae60; text-decoration:none; font-weight:bold; font-size:12px;">📄 ${f.name}</a>`;
                            });
                        }
                        filesHtml += '</div>';

                        let newRow = document.createElement('tr');
                        newRow.id = 'lease-row-' + lease.id;
                        newRow.innerHTML = `
                            <td>${lease.id}</td>
                            <td class="col-prop">${lease.prop}</td>
                            <td class="col-unit">${lease.floor} (${lease.unit})</td>
                            <td class="col-tenant">${lease.tenant}<br><small style="color:#777;">📞 ${lease.phone || '-'}</small></td>
                            <td class="col-duration"><b>${res.text}</b> ${res.statusHtml}<br><small style="color:#666;">من: ${lease.start_date}<br>إلى: ${lease.end_date}</small></td>
                            <td class="col-amount">${lease.amount} ر.ع</td>
                            <td class="col-files">${filesHtml}</td>
                            <td>
                                <div style="display:flex; gap:4px; align-items:center;">
                                    <button onclick="deleteLease(${lease.id})" class="btn-action-delete">حذف</button>
                                </div>
                            </td>
                        `;
                        tbody.appendChild(newRow);
                    });
                    document.getElementById('leasesPaginationText').innerText = `عرض 1 إلى ${data.length} من ${data.length} مدخلات`;
                });
        }

        function calculateDurationAndStatus(startDateStr, endDateStr) {
            if(!startDateStr || !endDateStr) return { text: 'غير محدد', statusHtml: '' };
            let start = new Date(startDateStr);
            let end = new Date(endDateStr);
            let isExpired = end < currentDate;
            let statusBadge = isExpired ? '<span class="badge-expired">🔴 منتهي</span>' : '<span class="badge-active">🟢 ساري / فعال</span>';
            
            let diffDays = Math.ceil(Math.abs(end - start) / (1000 * 60 * 60 * 24));
            let years = Math.floor(diffDays / 365);
            let months = Math.floor((diffDays % 365) / 30);
            let parts = [];
            if(years > 0) parts.push(years + ' سنة');
            if(months > 0) parts.push(months + ' شهر');
            return { text: parts.join(' و ') || 'يوم واحد', statusHtml: statusBadge };
        }

        function addAttachmentRow(containerId) {
            let container = document.getElementById(containerId);
            let row = document.createElement('div');
            row.className = 'attachment-row';
            row.innerHTML = `
                <input type="file" class="att-file" style="flex:1;">
                <button type="button" class="btn-remove-att" onclick="this.parentElement.remove()">حذف</button>
            `;
            container.appendChild(row);
        }

        function viewFile(url, name) {
            if(url && url !== '#') {
                let win = window.open();
                win.document.write(`<iframe src="${url}" style="width:100%; height:100%; border:none;"></iframe>`);
            } else {
                alert('هذا ملف افتراضي تجريبي.');
            }
        }

        function deleteLease(id) {
            if(confirm('هل أنت متأكد من حذف هذا العقد نهائياً من قاعدة البيانات؟')) {
                fetch('api_leases.php?action=delete', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: id })
                })
                .then(res => res.json())
                .then(res => {
                    if(res.status === 'success') {
                        alert('تم حذف العقد بنجاح.');
                        loadLeasesFromDB();
                    } else {
                        alert('حدث خطأ أثناء الحذف.');
                    }
                });
            }
        }

        function openAddLeaseModal() {
            document.getElementById('leasePropSelect').value = "";
            document.getElementById('leaseFloorSelect').innerHTML = '<option value="" disabled selected>اختر الطابق أولاً</option>';
            document.getElementById('leaseUnitSelect').innerHTML = '<option value="" disabled selected>اختر الوحدة أولاً</option>';
            document.getElementById('leaseTenant').value = '';
            document.getElementById('leasePhone').value = '';
            document.getElementById('leaseAmount').value = '';
            document.getElementById('leaseStartDate').value = '';
            document.getElementById('leaseEndDate').value = '';
            
            document.getElementById('add-attachments-container').innerHTML = '';
            addAttachmentRow('add-attachments-container');
            document.getElementById('addLeaseModal').style.display = 'flex';
        }

        function closeAddLeaseModal() {
            document.getElementById('addLeaseModal').style.display = 'none';
        }

        function saveNewLease() {
            let prop = document.getElementById('leasePropSelect').value;
            let floor = document.getElementById('leaseFloorSelect').value;
            let unit = document.getElementById('leaseUnitSelect').value;
            let tenant = document.getElementById('leaseTenant').value;
            let phone = document.getElementById('leasePhone').value;
            let amount = document.getElementById('leaseAmount').value;
            let start_date = document.getElementById('leaseStartDate').value;
            let end_date = document.getElementById('leaseEndDate').value;

            if(!prop || !floor || !unit || !tenant || !amount || !start_date || !end_date) {
                alert('الرجاء تعبئة كافة الحقول المطلوبة');
                return;
            }

            fetch('api_leases.php?action=add', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ prop, floor, unit, tenant, phone, amount, start_date, end_date, files: [] })
            })
            .then(res => res.json())
            .then(res => {
                if(res.status === 'success') {
                    closeAddLeaseModal();
                    alert('تمت إضافة عقد الإيجار وحفظه في قاعدة البيانات بنجاح!');
                    loadLeasesFromDB();
                } else {
                    alert('حدث خطأ أثناء الحفظ.');
                }
            });
        }

        function openArchiveModal() { document.getElementById('archiveModal').style.display = 'flex'; }
        function closeArchiveModal() { document.getElementById('archiveModal').style.display = 'none'; }
    </script>
</body>
</html>