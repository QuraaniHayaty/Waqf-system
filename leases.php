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
        .btn-action-renew { background: #dbeafe; border: none; padding: 5px 8px; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 11px; color: #1e40af; }
        .btn-action-archive { background: #fef3c7; border: none; padding: 5px 8px; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 11px; color: #d97706; }
        .btn-action-delete { background: #fee2e2; border: none; padding: 5px 8px; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 11px; color: #dc2626; }
        .btn-action-restore { background: #dcfce7; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 12px; color: #166534; }

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

        @media (max-width: 768px) {
            body { flex-direction: column; height: auto; overflow: visible; }
            aside { width: 100%; height: auto; }
            .nav-container { max-height: 220px; overflow-y: auto; }
            main { height: auto; overflow: visible; }
            .top-banner { flex-direction: column; align-items: flex-start; gap: 10px; }
            .action-bar { flex-direction: column; gap: 10px; align-items: stretch; }
            .content-card { margin: 0 12px 20px 12px; padding: 12px; }
            table { display: block; overflow-x: auto; white-space: nowrap; }
            .modal-box { width: 95vw !important; max-width: 95vw; }
            .date-row { flex-direction: column; }
        }
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
                <li><a href="finance.php">الحسابات</a></li>
                <li><a href="#">قائمة واتساب</a></li>
                <li><a href="#">الإعدادات</a></li>
            </ul>
        </div>
        <div class="logout-section">
            <a href="logout.php" class="logout-btn">تسجيل الخروج</a>
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
                <input type="text" id="searchInput" placeholder="بحث عن عقد..." oninput="loadLeases()">
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
                </tbody>
            </table>
            <div class="pagination">
                <span id="paginationText">جاري التحميل...</span>
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
                        <option value="عمارة الروضة التجارية">عمارة الروضة التجارية</option>
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
                    <label>مرفقات العقد والمستندات (يقبل جميع الصيغ)</label>
                    <div id="add-attachments-container"></div>
                    <button type="button" class="btn-add-attachment" onclick="addAttachmentRow('add-attachments-container')">➕ إضافة مرفق جديد</button>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-save" onclick="saveNewLease()">حفظ العقد</button>
            </div>
        </div>
    </div>

    <!-- نافذة تعديل عقد إيجار -->
    <div id="editLeaseModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <h3>تعديل عقد الإيجار والمرفقات</h3>
                <button class="close-modal" onclick="closeEditLeaseModal()">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editLeaseId">
                <div class="form-group">
                    <label>اختر العقار</label>
                    <select id="editLeasePropSelect" onchange="loadFloatsForProperty('editLeasePropSelect', 'editLeaseFloorSelect', 'editLeaseUnitSelect')">
                        <option value="عمارة الروضة التجارية">عمارة الروضة التجارية</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>اختر الطابق</label>
                    <select id="editLeaseFloorSelect" onchange="loadUnitsForFloor('editLeasePropSelect', 'editLeaseFloorSelect', 'editLeaseUnitSelect')">
                    </select>
                </div>
                <div class="form-group">
                    <label>اختر الوحدة</label>
                    <select id="editLeaseUnitSelect">
                    </select>
                </div>
                <div class="form-group">
                    <label>اسم المستأجر</label>
                    <input type="text" id="editLeaseTenant">
                </div>
                <div class="form-group">
                    <label>رقم هاتف المستأجر</label>
                    <input type="text" id="editLeasePhone">
                </div>

                <div class="date-row">
                    <div class="form-group">
                        <label>تاريخ بداية العقد (من)</label>
                        <input type="date" id="editLeaseStartDate">
                    </div>
                    <div class="form-group">
                        <label>تاريخ نهاية العقد (إلى)</label>
                        <input type="date" id="editLeaseEndDate">
                    </div>
                </div>

                <div class="form-group" style="margin-top: 15px;">
                    <label>القيمة الإيجارية الشهرية (ر.ع)</label>
                    <input type="number" id="editLeaseAmount">
                </div>

                <div class="form-group">
                    <label>مرفقات العقد والمستندات (يقبل جميع الصيغ)</label>
                    <div id="edit-attachments-container"></div>
                    <button type="button" class="btn-add-attachment" onclick="addAttachmentRow('edit-attachments-container')">➕ إضافة مرفق جديد</button>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-save" onclick="saveEditLeaseChanges()">حفظ التغييرات</button>
            </div>
        </div>
    </div>

    <!-- نافذة تجديد العقد -->
    <div id="renewLeaseModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <h3>تجديد عقد الإيجار</h3>
                <button class="close-modal" onclick="closeRenewLeaseModal()">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="renewLeaseId">
                <div class="form-group">
                    <label>اختر العقار</label>
                    <select id="renewLeasePropSelect" onchange="loadFloatsForProperty('renewLeasePropSelect', 'renewLeaseFloorSelect', 'renewLeaseUnitSelect')">
                        <option value="عمارة الروضة التجارية">عمارة الروضة التجارية</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>اختر الطابق</label>
                    <select id="renewLeaseFloorSelect" onchange="loadUnitsForFloor('renewLeasePropSelect', 'renewLeaseFloorSelect', 'renewLeaseUnitSelect')">
                    </select>
                </div>
                <div class="form-group">
                    <label>اختر الوحدة</label>
                    <select id="renewLeaseUnitSelect">
                    </select>
                </div>
                <div class="form-group">
                    <label>اسم المستأجر</label>
                    <input type="text" id="renewLeaseTenant">
                </div>
                <div class="form-group">
                    <label>رقم هاتف المستأجر</label>
                    <input type="text" id="renewLeasePhone">
                </div>

                <div class="date-row">
                    <div class="form-group">
                        <label>تاريخ بداية العقد الجديد (من)</label>
                        <input type="date" id="renewLeaseStartDate">
                    </div>
                    <div class="form-group">
                        <label>تاريخ نهاية العقد الجديد (إلى)</label>
                        <input type="date" id="renewLeaseEndDate">
                    </div>
                </div>

                <div class="form-group" style="margin-top: 15px;">
                    <label>القيمة الإيجارية الشهرية الجديدة (ر.ع)</label>
                    <input type="number" id="renewLeaseAmount">
                </div>

                <div class="form-group">
                    <label>مرفقات العقد والمستندات</label>
                    <div id="renew-attachments-container"></div>
                    <button type="button" class="btn-add-attachment" onclick="addAttachmentRow('renew-attachments-container')">➕ إضافة مرفق جديد</button>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-save" onclick="saveRenewLeaseChanges()">أرشفة القديم وحفظ التجديد</button>
            </div>
        </div>
    </div>

    <!-- نافذة أرشيف العقود المنتهية -->
    <div id="archiveModal" class="modal-overlay">
        <div class="modal-box" style="width: 900px;">
            <div class="modal-header">
                <h3>أرشيف عقود الإيجار المنتهية والمجددة</h3>
                <button class="close-modal" onclick="closeArchiveModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="search-box" style="margin-bottom: 15px;">
                    <input type="text" id="archiveSearchInput" placeholder="بحث في الأرشيف..." oninput="loadArchiveData()" style="width: 280px; padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px;">
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
                    <tbody id="archiveTableBody">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <span id="archivePaginationText" style="font-size: 13px; color: #666;">عرض 0 من 0</span>
                <button class="btn-save" onclick="closeArchiveModal()">إغلاق</button>
            </div>
        </div>
    </div>

    <script>
        let allLeasesData = [];
        const samplePropertyData = {
            "عمارة الروضة التجارية": [
                { floor: "الطابق الأرضي", units: ["محل رقم 1", "محل رقم 2"] },
                { floor: "الطابق الأول", units: ["شقة رقم 101", "شقة رقم 102"] }
            ]
        };
        const currentDate = new Date('2026-09-15');

        document.addEventListener("DOMContentLoaded", function() {
            loadLeases();
        });

        function loadLeases() {
            fetch('api_leases.php?action=getAll')
                .then(res => res.json())
                .then(data => {
                    allLeasesData = data;
                    renderLeasesTable(data);
                })
                .catch(err => console.error('Error loading leases:', err));
        }

        function calculateDurationAndStatus(startDateStr, endDateStr) {
            if(!startDateStr || !endDateStr) return { text: 'غير محدد', statusHtml: '' };
            let start = new Date(startDateStr);
            let end = new Date(endDateStr);
            let isExpired = end < currentDate;
            let statusBadge = isExpired ? '<span class="badge-expired">🔴 منتهي</span>' : '<span class="badge-active">🟢 ساري / فعال</span>';

            let diffTime = Math.abs(end - start);
            let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            let years = Math.floor(diffDays / 365);
            let months = Math.floor((diffDays % 365) / 30);
            let days = (diffDays % 365) % 30;

            let textParts = [];
            if(years > 0) textParts.push(years + (years === 1 ? ' سنة' : years === 2 ? ' سنتان' : ' سنوات'));
            if(months > 0) textParts.push(months + ' شهر');
            if(years === 0 && months === 0 && days > 0) textParts.push(days + ' يوم');

            return { text: textParts.join(' و ') || 'يوم واحد', statusHtml: statusBadge };
        }

        function renderLeasesTable(data) {
            let tbody = document.getElementById('leasesTableBody');
            tbody.innerHTML = '';

            let activeLeases = data.filter(l => !l.status || l.status === 'active');

            if(activeLeases.length === 0) {
                tbody.innerHTML = '<tr><td colspan="8" style="text-align: center; color: #777; padding: 20px;">لا توجد عقود إيجار مسجلة. اضغط على "إضافة عقد إيجار" للبدء.</td></tr>';
                document.getElementById('paginationText').innerText = 'عرض 0 إلى 0 من 0 مدخلات';
                return;
            }

            let html = '';
            activeLeases.forEach((item, index) => {
                let res = calculateDurationAndStatus(item.start_date, item.end_date);
                let filesHtml = '<div style="display:flex; flex-direction:column; gap:4px;">';
                if(!item.files || item.files.length === 0) {
                    filesHtml += '<span style="color:#999; font-style:italic;">لا توجد مرفقات</span>';
                } else {
                    item.files.forEach(f => {
                        filesHtml += `<div style="display:flex; gap:5px; align-items:center;">
                            <a href="#" onclick="viewFile('${f.url}', '${f.name}')" style="color:#27ae60; text-decoration:none; font-weight:bold; font-size:12px; cursor:pointer;">📄 ${f.name}</a>
                        </div>`;
                    });
                }
                filesHtml += '</div>';

                html += `<tr id="lease-row-${item.id}">
                    <td>${item.id}</td>
                    <td>${item.prop}</td>
                    <td>${item.floor} (${item.unit})</td>
                    <td>${item.tenant}<br><small style="color:#777;">📞 ${item.phone || '-'}</small></td>
                    <td><b>${res.text}</b> ${res.statusHtml}<br><small style="color:#666;">من: ${item.start_date}<br>إلى: ${item.end_date}</small></td>
                    <td>${item.amount} ر.ع</td>
                    <td>${filesHtml}</td>
                    <td>
                        <div style="display:flex; gap:4px; align-items:center;">
                            <button onclick="openEditLeaseModal(${item.id})" class="btn-action-edit">تعديل</button>
                            <button onclick="openRenewLeaseModal(${item.id})" class="btn-action-renew">تجديد</button>
                            <button onclick="archiveLease(${item.id})" class="btn-action-archive">أرشيف</button>
                            <button onclick="deleteLease(${item.id})" class="btn-action-delete">حذف</button>
                        </div>
                    </td>
                </tr>`;
            });
            tbody.innerHTML = html;
            document.getElementById('paginationText').innerText = `عرض 1 إلى ${activeLeases.length} من ${activeLeases.length} مدخلات`;
        }

        function viewFile(url, name) {
            if(url && url !== '#') {
                let win = window.open();
                win.document.write(`<iframe src="${url}" style="width:100%; height:100%; border:none;"></iframe>`);
            } else {
                alert('هذا ملف افتراضي تجريبي.');
            }
        }

        function addAttachmentRow(containerId, fileObj = null) {
            let container = document.getElementById(containerId);
            let row = document.createElement('div');
            row.className = 'attachment-row';
            let fileName = fileObj ? fileObj.name : '';
            let fileUrl = fileObj ? fileObj.url : '';

            row.innerHTML = `
                <input type="file" class="att-file" style="flex:1;" data-url="${fileUrl}" data-name="${fileName}">
                ${fileName ? `<span style="font-size:12px; color:#27ae60;">(${fileName})</span>` : ''}
                <button type="button" class="btn-remove-att" onclick="this.parentElement.remove()">حذف</button>
            `;
            container.appendChild(row);
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

        function loadFloatsForProperty(propId, floorId, unitId) {
            let prop = document.getElementById(propId).value;
            let floorSelect = document.getElementById(floorId);
            floorSelect.innerHTML = '<option value="" disabled selected>اختر الطابق</option>';
            let unitSelect = document.getElementById(unitId);
            unitSelect.innerHTML = '<option value="" disabled selected>اختر الطابق أولاً</option>';

            if(samplePropertyData[prop]) {
                samplePropertyData[prop].forEach(f => {
                    let opt = document.createElement('option');
                    opt.value = f.floor;
                    opt.innerText = f.floor;
                    floorSelect.appendChild(opt);
                });
            }
        }

        function loadUnitsForFloor(propId, floorId, unitId) {
            let prop = document.getElementById(propId).value;
            let floor = document.getElementById(floorId).value;
            let unitSelect = document.getElementById(unitId);
            unitSelect.innerHTML = '<option value="" disabled selected>اختر الوحدة</option>';

            if(samplePropertyData[prop]) {
                let foundFloor = samplePropertyData[prop].find(f => f.floor === floor);
                if(foundFloor && foundFloor.units) {
                    foundFloor.units.forEach(u => {
                        let opt = document.createElement('option');
                        opt.value = u;
                        opt.innerText = u;
                        unitSelect.appendChild(opt);
                    });
                }
            }
        }

        function saveNewLease() {
            let prop = document.getElementById('leasePropSelect').value;
            let floor = document.getElementById('leaseFloorSelect').value;
            let unit = document.getElementById('leaseUnitSelect').value;
            let tenant = document.getElementById('leaseTenant').value;
            let phone = document.getElementById('leasePhone').value;
            let amount = document.getElementById('leaseAmount').value;
            let start = document.getElementById('leaseStartDate').value;
            let end = document.getElementById('leaseEndDate').value;

            if(!prop || !floor || !unit || !tenant || !amount || !start || !end) {
                alert('الرجاء تعبئة كافة الحقول المطلوبة');
                return;
            }

            processAttachments('add-attachments-container', function(filesArr) {
                let payload = { prop, floor, unit, tenant, phone, amount, start, end, files: filesArr, status: 'active' };
                fetch('api_leases.php?action=add', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                })
                .then(res => res.json())
                .then(res => {
                    if(res.status === 'success') {
                        closeAddLeaseModal();
                        alert('تمت إضافة وحفظ عقد الإيجار على السيرفر بنجاح!');
                        loadLeases();
                    } else {
                        alert('حدث خطأ أثناء الحفظ');
                    }
                });
            });
        }

        function processAttachments(containerId, callback) {
            let rows = document.querySelectorAll('#' + containerId + ' .attachment-row');
            let fileObjects = [];
            let processed = 0;
            if(rows.length === 0) { callback([]); return; }

            rows.forEach(ar => {
                let fi = ar.querySelector('.att-file');
                let existingName = fi.getAttribute('data-name');
                let existingUrl = fi.getAttribute('data-url');

                if(fi.files.length > 0) {
                    let file = fi.files[0];
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        fileObjects.push({ name: file.name, url: e.target.result });
                        processed++;
                        if(processed === rows.length) callback(fileObjects);
                    };
                    reader.readAsDataURL(file);
                } else if(existingName) {
                    fileObjects.push({ name: existingName, url: existingUrl || '#' });
                    processed++;
                    if(processed === rows.length) callback(fileObjects);
                } else {
                    processed++;
                    if(processed === rows.length) callback(fileObjects);
                }
            });
        }

        function deleteLease(id) {
            if(confirm('هل أنت متأكد من حذف هذا العقد نهائياً؟')) {
                fetch('api_leases.php?action=delete', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id })
                })
                .then(res => res.json())
                .then(res => {
                    if(res.status === 'success') {
                        alert('تم حذف العقد بنجاح.');
                        loadLeases();
                    }
                });
            }
        }

        function archiveLease(id) {
            if(confirm('هل تريد أرشفة هذا العقد (نقله إلى الأرشيف)؟')) {
                fetch('api_leases.php?action=archive', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id })
                })
                .then(res => res.json())
                .then(res => {
                    if(res.status === 'success') {
                        alert('تم نقل العقد إلى الأرشيف بنجاح.');
                        loadLeases();
                    }
                });
            }
        }

        function openEditLeaseModal(id) {
            let item = allLeasesData.find(l => l.id == id);
            if(!item) return;

            document.getElementById('editLeaseId').value = item.id;
            document.getElementById('editLeasePropSelect').value = item.prop;
            loadFloatsForProperty('editLeasePropSelect', 'editLeaseFloorSelect', 'editLeaseUnitSelect');
            document.getElementById('editLeaseFloorSelect').value = item.floor;
            loadUnitsForFloor('editLeasePropSelect', 'editLeaseFloorSelect', 'editLeaseUnitSelect');
            document.getElementById('editLeaseUnitSelect').value = item.unit;

            document.getElementById('editLeaseTenant').value = item.tenant;
            document.getElementById('editLeasePhone').value = item.phone;
            document.getElementById('editLeaseAmount').value = item.amount;
            document.getElementById('editLeaseStartDate').value = item.start_date;
            document.getElementById('editLeaseEndDate').value = item.end_date;

            let attContainer = document.getElementById('edit-attachments-container');
            attContainer.innerHTML = '';
            if(item.files && item.files.length > 0) {
                item.files.forEach(f => addAttachmentRow('edit-attachments-container', f));
            } else {
                addAttachmentRow('edit-attachments-container');
            }

            document.getElementById('editLeaseModal').style.display = 'flex';
        }

        function closeEditLeaseModal() {
            document.getElementById('editLeaseModal').style.display = 'none';
        }

        function saveEditLeaseChanges() {
            let id = document.getElementById('editLeaseId').value;
            let prop = document.getElementById('editLeasePropSelect').value;
            let floor = document.getElementById('editLeaseFloorSelect').value;
            let unit = document.getElementById('editLeaseUnitSelect').value;
            let tenant = document.getElementById('editLeaseTenant').value;
            let phone = document.getElementById('editLeasePhone').value;
            let amount = document.getElementById('editLeaseAmount').value;
            let start = document.getElementById('editLeaseStartDate').value;
            let end = document.getElementById('editLeaseEndDate').value;

            processAttachments('edit-attachments-container', function(filesArr) {
                let payload = { id, prop, floor, unit, tenant, phone, amount, start, end, files: filesArr };
                fetch('api_leases.php?action=update', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                })
                .then(res => res.json())
                .then(res => {
                    if(res.status === 'success') {
                        closeEditLeaseModal();
                        alert('تم تحديث العقد بنجاح!');
                        loadLeases();
                    }
                });
            });
        }

        function openRenewLeaseModal(id) {
            let item = allLeasesData.find(l => l.id == id);
            if(!item) return;

            document.getElementById('renewLeaseId').value = item.id;
            document.getElementById('renewLeasePropSelect').value = item.prop;
            loadFloatsForProperty('renewLeasePropSelect', 'renewLeaseFloorSelect', 'renewLeaseUnitSelect');
            document.getElementById('renewLeaseFloorSelect').value = item.floor;
            loadUnitsForFloor('renewLeasePropSelect', 'renewLeaseFloorSelect', 'renewLeaseUnitSelect');
            document.getElementById('renewLeaseUnitSelect').value = item.unit;

            document.getElementById('renewLeaseTenant').value = item.tenant;
            document.getElementById('renewLeasePhone').value = item.phone;
            document.getElementById('renewLeaseAmount').value = item.amount;
            document.getElementById('renewLeaseStartDate').value = '';
            document.getElementById('renewLeaseEndDate').value = '';

            let attContainer = document.getElementById('renew-attachments-container');
            attContainer.innerHTML = '';
            if(item.files && item.files.length > 0) {
                item.files.forEach(f => addAttachmentRow('renew-attachments-container', f));
            } else {
                addAttachmentRow('renew-attachments-container');
            }

            document.getElementById('renewLeaseModal').style.display = 'flex';
        }

        function closeRenewLeaseModal() {
            document.getElementById('renewLeaseModal').style.display = 'none';
        }

        function saveRenewLeaseChanges() {
            let id = document.getElementById('renewLeaseId').value;
            let prop = document.getElementById('renewLeasePropSelect').value;
            let floor = document.getElementById('renewLeaseFloorSelect').value;
            let unit = document.getElementById('renewLeaseUnitSelect').value;
            let tenant = document.getElementById('renewLeaseTenant').value;
            let phone = document.getElementById('renewLeasePhone').value;
            let amount = document.getElementById('renewLeaseAmount').value;
            let start = document.getElementById('renewLeaseStartDate').value;
            let end = document.getElementById('renewLeaseEndDate').value;

            if(!start || !end || !amount) {
                alert('الرجاء تواريخ البداية والنهاية والقيمة الإيجارية الجديدة');
                return;
            }

            // 1. أرشفة العقد القديم
            fetch('api_leases.php?action=archive', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id })
            }).then(() => {
                // 2. إضافة العقد الجديد المجدد
                processAttachments('renew-attachments-container', function(filesArr) {
                    let payload = { prop, floor, unit, tenant, phone, amount, start, end, files: filesArr, status: 'active' };
                    fetch('api_leases.php?action=add', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(payload)
                    })
                    .then(res => res.json())
                    .then(res => {
                        if(res.status === 'success') {
                            closeRenewLeaseModal();
                            alert('تم تجديد العقد وحفظه وأرشفة القديم بنجاح!');
                            loadLeases();
                        }
                    });
                });
            });
        }

        function openArchiveModal() {
            loadArchiveData();
            document.getElementById('archiveModal').style.display = 'flex';
        }

        function closeArchiveModal() {
            document.getElementById('archiveModal').style.display = 'none';
        }

        function loadArchiveData() {
            fetch('api_leases.php?action=getAll')
                .then(res => res.json())
                .then(data => {
                    let archived = data.filter(l => l.status === 'archived');
                    let searchText = (document.getElementById('archiveSearchInput').value || '').toLowerCase();

                    let filtered = archived.filter(item => {
                        return (item.prop && item.prop.toLowerCase().includes(searchText)) ||
                               (item.tenant && item.tenant.toLowerCase().includes(searchText)) ||
                               (item.unit && item.unit.toLowerCase().includes(searchText));
                    });

                    let tbody = document.getElementById('archiveTableBody');
                    if(filtered.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="7" style="text-align: center; color: #777; padding: 20px;">لا توجد عقود مؤرشفة مطابقة.</td></tr>';
                        document.getElementById('archivePaginationText').innerText = 'عرض 0 من 0';
                        return;
                    }

                    let html = '';
                    filtered.forEach(item => {
                        let res = calculateDurationAndStatus(item.start_date, item.end_date);
                        let filesHtml = '';
                        if(item.files) {
                            item.files.forEach(f => {
                                filesHtml += `<a href="#" onclick="viewFile('${f.url}', '${f.name}')" style="color:#27ae60; text-decoration:none; display:block; font-size:12px;">📄 ${f.name}</a>`;
                            });
                        }
                        if(!filesHtml) filesHtml = 'لا توجد مرفقات';

                        html += `<tr>
                            <td>${item.prop}</td>
                            <td>${item.floor} (${item.unit})</td>
                            <td>${item.tenant}<br><small style="color:#777;">📞 ${item.phone || '-'}</small></td>
                            <td><b>${res.text}</b> ${res.statusHtml}<br><small style="color:#666;">من: ${item.start_date}<br>إلى: ${item.end_date}</small></td>
                            <td>${item.amount} ر.ع</td>
                            <td>${filesHtml}</td>
                            <td>
                                <div style="display:flex; gap:5px; align-items:center;">
                                    <button onclick="restoreLease(${item.id})" class="btn-action-restore">استعادة</button>
                                    <button onclick="deleteLeaseFromArchive(${item.id})" class="btn-action-delete">حذف</button>
                                </div>
                            </td>
                        </tr>`;
                    });
                    tbody.innerHTML = html;
                    document.getElementById('archivePaginationText').innerText = `عرض ${filtered.length} من ${filtered.length} مدخلات`;
                });
        }

        function restoreLease(id) {
            if(confirm('هل تريد استعادة هذا العقد وإعادته إلى قائمة عقود الإيجار النشطة؟')) {
                fetch('api_leases.php?action=restore', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id })
                })
                .then(res => res.json())
                .then(res => {
                    if(res.status === 'success') {
                        alert('تمت استعادة العقد بنجاح.');
                        loadArchiveData();
                        loadLeases();
                    }
                });
            }
        }

        function deleteLeaseFromArchive(id) {
            if(confirm('هل أنت متأكد من حذف هذا العقد نهائياً من الأرشيف؟')) {
                fetch('api_leases.php?action=delete', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id })
                })
                .then(res => res.json())
                .then(res => {
                    if(res.status === 'success') {
                        alert('تم حذف العقد نهائياً.');
                        loadArchiveData();
                    }
                });
            }
        }
    </script>
</body>
</html>
