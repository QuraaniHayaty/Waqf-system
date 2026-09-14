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
        
        .btn-action-edit { background: #eef2f5; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 12px; color: #333; }
        .btn-action-archive { background: #fef3c7; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 12px; color: #d97706; }
        .btn-action-delete { background: #fee2e2; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 12px; color: #dc2626; }
        .btn-action-restore { background: #dcfce7; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 12px; color: #166534; }

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
                <p>إدارة وإبرام عقود الإيجار وتحديد تواريخ وبداية ونهاية المدة بمرونة</p>
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
                        <th>مدة العقد وتاريخه</th>
                        <th>القيمة الإيجارية</th>
                        <th>المرفقات</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody id="leasesTableBody">
                    <tr id="lease-row-1" data-prop="عمارة الروضة التجارية" data-floor="الطابق الأرضي" data-unit="محل رقم 1" data-tenant="شركة الأفق للتجارة" data-phone="95000000" data-amount="50" data-start="2026-01-01" data-end="2028-01-01" data-files='[{"name": "عقد_محل_1.pdf", "url": "#"}]'>
                        <td>1</td>
                        <td class="col-prop">عمارة الروضة التجارية</td>
                        <td class="col-unit">الطابق الأرضي (محل رقم 1)</td>
                        <td class="col-tenant">شركة الأفق للتجارة<br><small style="color:#777;">📞 95000000</small></td>
                        <td class="col-duration"><b>سنتان</b><br><small style="color:#666;">من: 2026-01-01<br>إلى: 2028-01-01</small></td>
                        <td class="col-amount">50 ر.ع</td>
                        <td class="col-files">
                            <div style="display:flex; flex-direction:column; gap:4px;">
                                <div style="display:flex; gap:5px; align-items:center;">
                                    <a href="#" onclick="viewFile('#', 'عقد_محل_1.pdf')" style="color:#27ae60; text-decoration:none; font-weight:bold; font-size:12px; cursor:pointer;">📄 عقد_محل_1.pdf</a>
                                    <button onclick="viewFile('#', 'عقد_محل_1.pdf')" style="background:#f39c12; color:white; border:none; padding:1px 4px; border-radius:3px; cursor:pointer; font-size:9px;" title="معاينة">🖨️</button>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="display:flex; gap:5px; align-items:center;">
                                <button onclick="openEditLeaseModal(1)" class="btn-action-edit">تعديل</button>
                                <button onclick="archiveLease(1)" class="btn-action-archive">أرشيف</button>
                                <button onclick="deleteLease(1)" class="btn-action-delete">حذف</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="pagination">
                <span>عرض 1 إلى 1 من 1 مدخلات</span>
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

                <div class="form-group">
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

                <div class="form-group">
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

    <!-- نافذة أرشيف العقود المنتهية -->
    <div id="archiveModal" class="modal-overlay">
        <div class="modal-box" style="width: 900px;">
            <div class="modal-header">
                <h3>أرشيف عقود الإيجار المنتهية</h3>
                <button class="close-modal" onclick="closeArchiveModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="search-box" style="margin-bottom: 15px;">
                    <input type="text" id="archiveSearchInput" placeholder="بحث في الأرشيف..." oninput="filterArchive()" style="width: 280px; padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px;">
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
                <div class="pagination" id="archivePaginationButtons" style="margin: 0;"></div>
                <button class="btn-save" onclick="closeArchiveModal()">إغلاق</button>
            </div>
        </div>
    </div>

    <script>
        const samplePropertyData = {
            "عمارة الروضة التجارية": [
                { floor: "الطابق الأرضي", units: ["محل رقم 1", "محل رقم 2"] },
                { floor: "الطابق الأول", units: ["شقة رقم 101", "شقة رقم 102"] }
            ]
        };

        let archiveData = [];
        let archiveCurrentPage = 1;
        const archiveRowsPerPage = 10;

        /* دالة حساب المدة الزمنية تلقائياً بين تاريخين */
        function calculateDurationText(startDateStr, endDateStr) {
            if(!startDateStr || !endDateStr) return 'غير محدد';
            let start = new Date(startDateStr);
            let end = new Date(endDateStr);
            if(end <= start) return 'تاريخ غير منطقي';

            let diffTime = Math.abs(end - start);
            let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            
            let years = Math.floor(diffDays / 365);
            let months = Math.floor((diffDays % 365) / 30);
            let days = (diffDays % 365) % 30;

            let textParts = [];
            if(years > 0) textParts.push(years + (years === 1 ? ' سنة' : years === 2 ? ' سنتان' : ' سنوات'));
            if(months > 0) textParts.push(months + ' شهر');
            if(years === 0 && months === 0 && days > 0) textParts.push(days + ' يوم');

            return textParts.join(' و ') || 'يوم واحد';
        }

        function addAttachmentRow(containerId, fileObj = null) {
            let container = document.getElementById(containerId);
            let row = document.createElement('div');
            row.className = 'attachment-row';
            
            let fileName = fileObj ? fileObj.name : '';
            let fileUrl = fileObj ? fileObj.url : '';

            row.innerHTML = `
                <input type="file" class="att-file" style="flex:1;" data-url="${fileUrl}" data-name="${fileName}">
                ${fileName ? `<span style="font-size:12px; color:#27ae60; max-width:150px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;" title="${fileName}">(${fileName})</span>` : ''}
                <button type="button" class="btn-remove-att" onclick="this.parentElement.remove()">حذف</button>
            `;
            container.appendChild(row);
        }

        function viewFile(url, name) {
            if(url && url !== '#') {
                let win = window.open();
                win.document.write(`<iframe src="${url}" style="width:100%; height:100%; border:none;"></iframe>`);
            } else {
                alert('هذا ملف افتراضي تجريبي. قم برفع واستعراض ملف حقيقي.');
            }
        }

        function deleteLease(id) {
            if(confirm('هل أنت متأكد من حذف هذا العقد نهائياً؟')) {
                let row = document.getElementById('lease-row-' + id);
                if(row) row.remove();
                alert('تم حذف العقد بنجاح.');
            }
        }

        function archiveLease(id) {
            if(confirm('هل تريد أرشفة هذا العقد (نقله إلى الأرشيف)؟')) {
                let row = document.getElementById('lease-row-' + id);
                if(row) {
                    let prop = row.getAttribute('data-prop');
                    let floor = row.getAttribute('data-floor');
                    let unit = row.getAttribute('data-unit');
                    let tenant = row.getAttribute('data-tenant');
                    let phone = row.getAttribute('data-phone');
                    let amount = row.getAttribute('data-amount');
                    let start = row.getAttribute('data-start');
                    let end = row.getAttribute('data-end');
                    let files = JSON.parse(row.getAttribute('data-files') || '[]');

                    archiveData.push({ id, prop, floor, unit, tenant, phone, amount, start, end, files });
                    row.remove();
                    updateArchiveTable();
                    alert('تم نقل العقد إلى الأرشيف بنجاح.');
                }
            }
        }

        function restoreLease(index) {
            if(confirm('هل تريد استعادة هذا العقد وإعادته إلى قائمة عقود الإيجار النشطة؟')) {
                let item = archiveData.splice(index, 1)[0];
                let tbody = document.getElementById('leasesTableBody');
                let rowCount = tbody.rows.length + 1;

                let filesHtml = '<div style="display:flex; flex-direction:column; gap:4px;">';
                if(item.files.length === 0) {
                    filesHtml += '<span style="color:#999; font-style:italic;">لا توجد مرفقات</span>';
                } else {
                    item.files.forEach(f => {
                        filesHtml += `
                            <div style="display:flex; gap:5px; align-items:center;">
                                <a href="#" onclick="viewFile('${f.url}', '${f.name}')" style="color:#27ae60; text-decoration:none; font-weight:bold; font-size:12px; cursor:pointer;">📄 ${f.name}</a>
                                <button onclick="viewFile('${f.url}', '${f.name}')" style="background:#f39c12; color:white; border:none; padding:1px 4px; border-radius:3px; cursor:pointer; font-size:9px;" title="معاينة">🖨️</button>
                            </div>
                        `;
                    });
                }
                filesHtml += '</div>';

                let durationText = calculateDurationText(item.start, item.end);

                let newRow = document.createElement('tr');
                newRow.id = 'lease-row-' + rowCount;
                newRow.setAttribute('data-prop', item.prop);
                newRow.setAttribute('data-floor', item.floor);
                newRow.setAttribute('data-unit', item.unit);
                newRow.setAttribute('data-tenant', item.tenant);
                newRow.setAttribute('data-phone', item.phone);
                newRow.setAttribute('data-amount', item.amount);
                newRow.setAttribute('data-start', item.start);
                newRow.setAttribute('data-end', item.end);
                newRow.setAttribute('data-files', JSON.stringify(item.files));

                newRow.innerHTML = `
                    <td>${rowCount}</td>
                    <td class="col-prop">${item.prop}</td>
                    <td class="col-unit">${item.floor} (${item.unit})</td>
                    <td class="col-tenant">${item.tenant}<br><small style="color:#777;">📞 ${item.phone || '-'}</small></td>
                    <td class="col-duration"><b>${durationText}</b><br><small style="color:#666;">من: ${item.start}<br>إلى: ${item.end}</small></td>
                    <td class="col-amount">${item.amount} ر.ع</td>
                    <td class="col-files">${filesHtml}</td>
                    <td>
                        <div style="display:flex; gap:5px; align-items:center;">
                            <button onclick="openEditLeaseModal(${rowCount})" class="btn-action-edit">تعديل</button>
                            <button onclick="archiveLease(${rowCount})" class="btn-action-archive">أرشيف</button>
                            <button onclick="deleteLease(${rowCount})" class="btn-action-delete">حذف</button>
                        </div>
                    </td>
                `;

                tbody.appendChild(newRow);
                updateArchiveTable();
                alert('تمت استعادة العقد بنجاح.');
            }
        }

        function deleteFromArchive(index) {
            if(confirm('هل أنت متأكد من حذف هذا العقد نهائياً من الأرشيف؟')) {
                archiveData.splice(index, 1);
                updateArchiveTable();
                alert('تم حذف العقد نهائياً.');
            }
        }

        function filterArchive() {
            archiveCurrentPage = 1;
            updateArchiveTable();
        }

        function updateArchiveTable() {
            let searchText = document.getElementById('archiveSearchInput').value.toLowerCase();
            let filtered = archiveData.filter(item => {
                return item.prop.toLowerCase().includes(searchText) ||
                       item.tenant.toLowerCase().includes(searchText) ||
                       item.unit.toLowerCase().includes(searchText) ||
                       item.floor.toLowerCase().includes(searchText);
            });

            let totalPages = Math.ceil(filtered.length / archiveRowsPerPage) || 1;
            if (archiveCurrentPage > totalPages) archiveCurrentPage = totalPages;

            let start = (archiveCurrentPage - 1) * archiveRowsPerPage;
            let paginatedItems = filtered.slice(start, start + archiveRowsPerPage);

            let tbody = document.getElementById('archiveTableBody');
            if(filtered.length === 0) {
                tbody.innerHTML = '<tr><td colspan="7" style="text-align: center; color: #777; padding: 20px;">لا توجد عقود مؤرشفة مطابقة للبحث.</td></tr>';
                document.getElementById('archivePaginationText').innerText = 'عرض 0 من 0';
                document.getElementById('archivePaginationButtons').innerHTML = '';
                return;
            }

            let html = '';
            paginatedItems.forEach((item, idx) => {
                let originalIndex = archiveData.indexOf(item);
                let filesHtml = '';
                item.files.forEach(f => {
                    filesHtml += `<a href="#" onclick="viewFile('${f.url}', '${f.name}')" style="color:#27ae60; text-decoration:none; display:block; font-size:12px;">📄 ${f.name}</a>`;
                });
                if(!filesHtml) filesHtml = 'لا توجد مرفقات';

                let durationText = calculateDurationText(item.start, item.end);

                html += `<tr>
                    <td>${item.prop}</td>
                    <td>${item.floor} (${item.unit})</td>
                    <td>${item.tenant}<br><small style="color:#777;">📞 ${item.phone || '-'}</small></td>
                    <td><b>${durationText}</b><br><small style="color:#666;">من: ${item.start}<br>إلى: ${item.end}</small></td>
                    <td>${item.amount} ر.ع</td>
                    <td>${filesHtml}</td>
                    <td>
                        <div style="display:flex; gap:5px; align-items:center;">
                            <button onclick="restoreLease(${originalIndex})" class="btn-action-restore" title="إعادة إلى العقود النشطة">استعادة</button>
                            <button onclick="deleteFromArchive(${originalIndex})" class="btn-action-delete" title="حذف نهائي">حذف</button>
                        </div>
                    </td>
                </tr>`;
            });
            tbody.innerHTML = html;

            document.getElementById('archivePaginationText').innerText = `عرض ${start + 1} إلى ${Math.min(start + archiveRowsPerPage, filtered.length)} من ${filtered.length} مدخلات`;
            
            let btnHtml = '';
            for(let i = 1; i <= totalPages; i++) {
                btnHtml += `<button onclick="archiveCurrentPage=${i}; updateArchiveTable();" class="${archiveCurrentPage === i ? 'active' : ''}">${i}</button>`;
            }
            document.getElementById('archivePaginationButtons').innerHTML = btnHtml;
        }

        function openArchiveModal() {
            document.getElementById('archiveSearchInput').value = '';
            archiveCurrentPage = 1;
            updateArchiveTable();
            document.getElementById('archiveModal').style.display = 'flex';
        }

        function closeArchiveModal() {
            document.getElementById('archiveModal').style.display = 'none';
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

        function openEditLeaseModal(id) {
            let row = document.getElementById('lease-row-' + id);
            let prop = row.getAttribute('data-prop');
            let floor = row.getAttribute('data-floor');
            let unit = row.getAttribute('data-unit');
            let tenant = row.getAttribute('data-tenant');
            let phone = row.getAttribute('data-phone');
            let amount = row.getAttribute('data-amount');
            let start = row.getAttribute('data-start') || '';
            let end = row.getAttribute('data-end') || '';
            let files = JSON.parse(row.getAttribute('data-files') || '[]');

            document.getElementById('editLeaseId').value = id;
            document.getElementById('editLeasePropSelect').value = prop;
            
            loadFloatsForProperty('editLeasePropSelect', 'editLeaseFloorSelect', 'editLeaseUnitSelect');
            document.getElementById('editLeaseFloorSelect').value = floor;
            
            loadUnitsForFloor('editLeasePropSelect', 'editLeaseFloorSelect', 'editLeaseUnitSelect');
            document.getElementById('editLeaseUnitSelect').value = unit;

            document.getElementById('editLeaseTenant').value = tenant;
            document.getElementById('editLeasePhone').value = phone;
            document.getElementById('editLeaseAmount').value = amount;
            document.getElementById('editLeaseStartDate').value = start;
            document.getElementById('editLeaseEndDate').value = end;

            let attContainer = document.getElementById('edit-attachments-container');
            attContainer.innerHTML = '';
            
            if(files.length > 0) {
                files.forEach(f => {
                    addAttachmentRow('edit-attachments-container', f);
                });
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
            let row = document.getElementById('lease-row-' + id);

            let prop = document.getElementById('editLeasePropSelect').value;
            let floor = document.getElementById('editLeaseFloorSelect').value;
            let unit = document.getElementById('editLeaseUnitSelect').value;
            let tenant = document.getElementById('editLeaseTenant').value;
            let phone = document.getElementById('editLeasePhone').value;
            let amount = document.getElementById('editLeaseAmount').value;
            let start = document.getElementById('editLeaseStartDate').value;
            let end = document.getElementById('editLeaseEndDate').value;

            let fileObjects = [];
            let rows = document.querySelectorAll('#edit-attachments-container .attachment-row');
            
            let processed = 0;
            if(rows.length === 0) finishSave([]);

            rows.forEach((ar, idx) => {
                let fi = ar.querySelector('.att-file');
                let existingUrl = fi.getAttribute('data-url');
                let existingName = fi.getAttribute('data-name');

                if(fi.files.length > 0) {
                    let file = fi.files[0];
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        fileObjects.push({ name: file.name, url: e.target.result });
                        processed++;
                        if(processed === rows.length) finishSave(fileObjects);
                    };
                    reader.readAsDataURL(file);
                } else if(existingName) {
                    fileObjects.push({ name: existingName, url: existingUrl || '#' });
                    processed++;
                    if(processed === rows.length) finishSave(fileObjects);
                } else {
                    processed++;
                    if(processed === rows.length) finishSave(fileObjects);
                }
            });

            function finishSave(filesArr) {
                let durationText = calculateDurationText(start, end);

                row.setAttribute('data-prop', prop);
                row.setAttribute('data-floor', floor);
                row.setAttribute('data-unit', unit);
                row.setAttribute('data-tenant', tenant);
                row.setAttribute('data-phone', phone);
                row.setAttribute('data-amount', amount);
                row.setAttribute('data-start', start);
                row.setAttribute('data-end', end);
                row.setAttribute('data-files', JSON.stringify(filesArr));

                row.querySelector('.col-prop').innerText = prop;
                row.querySelector('.col-unit').innerText = `${floor} (${unit})`;
                row.querySelector('.col-tenant').innerHTML = `${tenant}<br><small style="color:#777;">📞 ${phone || '-'}</small>`;
                row.querySelector('.col-duration').innerHTML = `<b>${durationText}</b><br><small style="color:#666;">من: ${start}<br>إلى: ${end}</small>`;
                row.querySelector('.col-amount').innerText = `${amount} ر.ع`;
                
                let filesHtml = '<div style="display:flex; flex-direction:column; gap:4px;">';
                if(filesArr.length === 0) {
                    filesHtml += '<span style="color:#999; font-style:italic;">لا توجد مرفقات</span>';
                } else {
                    filesArr.forEach(f => {
                        filesHtml += `
                            <div style="display:flex; gap:5px; align-items:center;">
                                <a href="#" onclick="viewFile('${f.url}', '${f.name}')" style="color:#27ae60; text-decoration:none; font-weight:bold; font-size:12px; cursor:pointer;">📄 ${f.name}</a>
                                <button onclick="viewFile('${f.url}', '${f.name}')" style="background:#f39c12; color:white; border:none; padding:1px 4px; border-radius:3px; cursor:pointer; font-size:9px;" title="معاينة">🖨️</button>
                            </div>
                        `;
                    });
                }
                filesHtml += '</div>';
                row.querySelector('.col-files').innerHTML = filesHtml;

                closeEditLeaseModal();
                alert('تم تحديث العقد وتواريخ المدة بنجاح!');
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
                alert('الرجاء تعبئة كافة الحقول بما فيها تواريخ بداية ونهاية العقد');
                return;
            }

            let fileObjects = [];
            let rows = document.querySelectorAll('#add-attachments-container .attachment-row');
            
            let processed = 0;
            if(rows.length === 0) finishAdd([]);

            rows.forEach((ar, idx) => {
                let fi = ar.querySelector('.att-file');
                if(fi.files.length > 0) {
                    let file = fi.files[0];
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        fileObjects.push({ name: file.name, url: e.target.result });
                        processed++;
                        if(processed === rows.length) finishAdd(fileObjects);
                    };
                    reader.readAsDataURL(file);
                } else {
                    processed++;
                    if(processed === rows.length) finishAdd(fileObjects);
                }
            });

            function finishAdd(filesArr) {
                let tbody = document.getElementById('leasesTableBody');
                let rowCount = tbody.rows.length + 1;
                let durationText = calculateDurationText(start, end);

                let newRow = document.createElement('tr');
                newRow.id = 'lease-row-' + rowCount;
                newRow.setAttribute('data-prop', prop);
                newRow.setAttribute('data-floor', floor);
                newRow.setAttribute('data-unit', unit);
                newRow.setAttribute('data-tenant', tenant);
                newRow.setAttribute('data-phone', phone);
                newRow.setAttribute('data-amount', amount);
                newRow.setAttribute('data-start', start);
                newRow.setAttribute('data-end', end);
                newRow.setAttribute('data-files', JSON.stringify(filesArr));

                let filesHtml = '<div style="display:flex; flex-direction:column; gap:4px;">';
                if(filesArr.length === 0) {
                    filesHtml += '<span style="color:#999; font-style:italic;">لا توجد مرفقات</span>';
                } else {
                    filesArr.forEach(f => {
                        filesHtml += `
                            <div style="display:flex; gap:5px; align-items:center;">
                                <a href="#" onclick="viewFile('${f.url}', '${f.name}')" style="color:#27ae60; text-decoration:none; font-weight:bold; font-size:12px; cursor:pointer;">📄 ${f.name}</a>
                                <button onclick="viewFile('${f.url}', '${f.name}')" style="background:#f39c12; color:white; border:none; padding:1px 4px; border-radius:3px; cursor:pointer; font-size:9px;" title="معاينة">🖨️</button>
                            </div>
                        `;
                    });
                }
                filesHtml += '</div>';

                newRow.innerHTML = `
                    <td>${rowCount}</td>
                    <td class="col-prop">${prop}</td>
                    <td class="col-unit">${floor} (${unit})</td>
                    <td class="col-tenant">${tenant}<br><small style="color:#777;">📞 ${phone || '-'}</small></td>
                    <td class="col-duration"><b>${durationText}</b><br><small style="color:#666;">من: ${start}<br>إلى: ${end}</small></td>
                    <td class="col-amount">${amount} ر.ع</td>
                    <td class="col-files">${filesHtml}</td>
                    <td>
                        <div style="display:flex; gap:5px; align-items:center;">
                            <button onclick="openEditLeaseModal(${rowCount})" class="btn-action-edit">تعديل</button>
                            <button onclick="archiveLease(${rowCount})" class="btn-action-archive">أرشيف</button>
                            <button onclick="deleteLease(${rowCount})" class="btn-action-delete">حذف</button>
                        </div>
                    </td>
                `;

                tbody.appendChild(newRow);
                closeAddLeaseModal();
                alert('تمت إضافة عقد الإيجار وتحديد مدته بنجاح!');
            }
        }
    </script>
</body>
</html>
