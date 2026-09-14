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
        
        .action-bar { padding: 0 25px; margin-bottom: 20px; display: flex; justify-content: flex-start; }
        .btn-add { background-color: #27ae60; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: bold; transition: background 0.2s; cursor: pointer; border: none; }
        .btn-add:hover { background-color: #219653; }
        
        .content-card { background: white; margin: 0 25px 25px 25px; padding: 20px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .search-box { margin-bottom: 15px; }
        .search-box input { width: 250px; padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; }
        
        table { width: 100%; border-collapse: collapse; text-align: right; }
        th, td { padding: 12px 15px; border-bottom: 1px solid #eee; font-size: 14px; color: #333; }
        th { background-color: #f8f9fa; color: #2e5a36; font-weight: 600; }
        tr:hover { background-color: #fcfcfc; }
        
        /* النوافذ المنبثقة */
        .modal-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); z-index: 1000; justify-content: center; align-items: center; }
        .modal-box { background: white; width: 650px; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.15); overflow: hidden; animation: fadeIn 0.2s ease-in-out; max-height: 90vh; display: flex; flex-direction: column; }
        .modal-header { display: flex; justify-content: space-between; align-items: center; padding: 15px 20px; border-bottom: 1px solid #eee; }
        .modal-header h3 { font-size: 16px; color: #333; font-weight: bold; }
        .close-modal { background: none; border: none; font-size: 20px; cursor: pointer; color: #888; }
        .close-modal:hover { color: #333; }
        .modal-body { padding: 20px; overflow-y: auto; flex-grow: 1; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-size: 13px; color: #555; margin-bottom: 5px; text-align: right; font-weight: bold; }
        .form-group input, .form-group select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; text-align: right; background: #fff; }
        
        /* إرفاق عدة ملفات */
        .attachment-row { display: flex; gap: 10px; align-items: center; margin-bottom: 8px; }
        .btn-add-attachment { background-color: #3498db; color: white; border: none; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: bold; cursor: pointer; margin-top: 5px; }
        .btn-add-attachment:hover { background-color: #2980b9; }
        .btn-remove-att { background: #e74c3c; color: white; border: none; padding: 6px 10px; border-radius: 4px; cursor: pointer; font-size: 12px; }

        .modal-footer { padding: 15px 20px; border-top: 1px solid #eee; display: flex; justify-content: flex-start; background: #fafafa; }
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
                <p>إدارة وإبرام عقود الإيجار ورفع المستندات والمرفقات بجميع الصيغ (PDF, Word, Excel, صور)</p>
            </div>
        </div>

        <div class="action-bar">
            <button class="btn-add" onclick="openAddLeaseModal()">➕ إضافة عقد إيجار</button>
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
                        <th>القيمة الإيجارية</th>
                        <th>مرفقات العقد (Attachments)</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody id="leasesTableBody">
                    <tr id="lease-row-1" data-prop="عمارة الروضة التجارية" data-floor="الطابق الأرضي" data-unit="محل رقم 1" data-tenant="شركة الأفق للتجارة" data-phone="95000000" data-amount="50" data-files='[{"name": "عقد_محل_1.pdf", "url": "#"}]'>
                        <td>1</td>
                        <td class="col-prop">عمارة الروضة التجارية</td>
                        <td class="col-unit">الطابق الأرضي (محل رقم 1)</td>
                        <td class="col-tenant">شركة الأفق للتجارة<br><small style="color:#777;">📞 95000000</small></td>
                        <td class="col-amount">50 ر.ع</td>
                        <td class="col-files">
                            <div style="display:flex; flex-direction:column; gap:4px;">
                                <div style="display:flex; gap:5px; align-items:center;">
                                    <a href="#" onclick="viewFile('#', 'عقد_محل_1.pdf')" style="color:#27ae60; text-decoration:none; font-weight:bold; font-size:13px; cursor:pointer;">📄 عقد_محل_1.pdf</a>
                                    <button onclick="viewFile('#', 'عقد_محل_1.pdf')" style="background:#f39c12; color:white; border:none; padding:1px 4px; border-radius:3px; cursor:pointer; font-size:10px;" title="معاينة وطباعة">🖨️</button>
                                </div>
                            </div>
                        </td>
                        <td><button onclick="openEditLeaseModal(1)" style="background:#eef2f5; border:none; padding:6px 12px; border-radius:4px; cursor:pointer; font-weight:bold;">تعديل</button></td>
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
                <div class="form-group">
                    <label>القيمة الإيجارية الشهرية (ر.ع)</label>
                    <input type="number" id="leaseAmount" placeholder="أدخل المبلغ">
                </div>
                
                <div class="form-group">
                    <label>مرفقات العقد والمستندات (يقبل جميع الصيغ: PDF, Word, Excel, صور، إلخ)</label>
                    <div id="add-attachments-container"></div>
                    <button type="button" class="btn-add-attachment" onclick="addAttachmentRow('add-attachments-container')">➕ إضافة مرفق جديد</button>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-save" onclick="saveNewLease()">حفظ العقد</button>
            </div>
        </div>
    </div>

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

    <script>
        const samplePropertyData = {
            "عمارة الروضة التجارية": [
                { floor: "الطابق الأرضي", units: ["محل رقم 1", "محل رقم 2"] },
                { floor: "الطابق الأول", units: ["شقة رقم 101", "شقة رقم 102"] }
            ]
        };

        function addAttachmentRow(containerId, fileObj = null) {
            let container = document.getElementById(containerId);
            let row = document.createElement('div');
            row.className = 'attachment-row';
            
            let fileName = fileObj ? fileObj.name : '';
            let fileUrl = fileObj ? fileObj.url : '';

            // تم إزالة خاصية accept بالكامل ليقبل المتصفح رفع أي صيغة (PDF, Word, Excel, صور بأنواعها، وغيرها)
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
                alert('هذا ملف تجريبي افتراضي. قم بإرفاق ملف حقيقي لفتح واستعراض المحتوى.');
            }
        }

        function openAddLeaseModal() {
            document.getElementById('leasePropSelect').value = "";
            document.getElementById('leaseFloorSelect').innerHTML = '<option value="" disabled selected>اختر الطابق أولاً</option>';
            document.getElementById('leaseUnitSelect').innerHTML = '<option value="" disabled selected>اختر الوحدة أولاً</option>';
            document.getElementById('leaseTenant').value = '';
            document.getElementById('leasePhone').value = '';
            document.getElementById('leaseAmount').value = '';
            
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
            unitSelect.innerHTML = '<option value="" disabled selected>اختر الوحدة</
cd ~/domains/rawdahhub.com/public_html/waqf

# إعادة بناء صفحة عقارات الإيجار بشكل كامل ونظيف وصحيح 100%
cat << 'EOF' > leases.php
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
        
        .action-bar { padding: 0 25px; margin-bottom: 20px; display: flex; justify-content: flex-start; }
        .btn-add { background-color: #27ae60; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: bold; transition: background 0.2s; cursor: pointer; border: none; }
        .btn-add:hover { background-color: #219653; }
        
        .content-card { background: white; margin: 0 25px 25px 25px; padding: 20px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .search-box { margin-bottom: 15px; }
        .search-box input { width: 250px; padding: 8px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; }
        
        table { width: 100%; border-collapse: collapse; text-align: right; }
        th, td { padding: 12px 15px; border-bottom: 1px solid #eee; font-size: 14px; color: #333; }
        th { background-color: #f8f9fa; color: #2e5a36; font-weight: 600; }
        tr:hover { background-color: #fcfcfc; }
        
        /* النوافذ المنبثقة */
        .modal-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); z-index: 1000; justify-content: center; align-items: center; }
        .modal-box { background: white; width: 650px; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.15); overflow: hidden; animation: fadeIn 0.2s ease-in-out; max-height: 90vh; display: flex; flex-direction: column; }
        .modal-header { display: flex; justify-content: space-between; align-items: center; padding: 15px 20px; border-bottom: 1px solid #eee; }
        .modal-header h3 { font-size: 16px; color: #333; font-weight: bold; }
        .close-modal { background: none; border: none; font-size: 20px; cursor: pointer; color: #888; }
        .close-modal:hover { color: #333; }
        .modal-body { padding: 20px; overflow-y: auto; flex-grow: 1; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-size: 13px; color: #555; margin-bottom: 5px; text-align: right; font-weight: bold; }
        .form-group input, .form-group select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; text-align: right; background: #fff; }
        
        /* إرفاق عدة ملفات */
        .attachment-row { display: flex; gap: 10px; align-items: center; margin-bottom: 8px; }
        .btn-add-attachment { background-color: #3498db; color: white; border: none; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: bold; cursor: pointer; margin-top: 5px; }
        .btn-add-attachment:hover { background-color: #2980b9; }
        .btn-remove-att { background: #e74c3c; color: white; border: none; padding: 6px 10px; border-radius: 4px; cursor: pointer; font-size: 12px; }

        .modal-footer { padding: 15px 20px; border-top: 1px solid #eee; display: flex; justify-content: flex-start; background: #fafafa; }
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
                <p>إدارة وإبرام عقود الإيجار ورفع المستندات والمرفقات بجميع الصيغ</p>
            </div>
        </div>

        <div class="action-bar">
            <button class="btn-add" onclick="openAddLeaseModal()">➕ إضافة عقد إيجار</button>
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
                        <th>القيمة الإيجارية</th>
                        <th>مرفقات العقد (Attachments)</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody id="leasesTableBody">
                    <tr id="lease-row-1" data-prop="عمارة الروضة التجارية" data-floor="الطابق الأرضي" data-unit="محل رقم 1" data-tenant="شركة الأفق للتجارة" data-phone="95000000" data-amount="50" data-files='[]'>
                        <td>1</td>
                        <td class="col-prop">عمارة الروضة التجارية</td>
                        <td class="col-unit">الطابق الأرضي (محل رقم 1)</td>
                        <td class="col-tenant">شركة الأفق للتجارة<br><small style="color:#777;">📞 95000000</small></td>
                        <td class="col-amount">50 ر.ع</td>
                        <td class="col-files">
                            <span style="color:#999; font-style:italic;">لا توجد مرفقات</span>
                        </td>
                        <td><button onclick="openEditLeaseModal(1)" style="background:#eef2f5; border:none; padding:6px 12px; border-radius:4px; cursor:pointer; font-weight:bold;">تعديل</button></td>
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

    <script>
        const samplePropertyData = {
            "عمارة الروضة التجارية": [
                { floor: "الطابق الأرضي", units: ["محل رقم 1", "محل رقم 2"] },
                { floor: "الطابق الأول", units: ["شقة رقم 101", "شقة رقم 102"] }
            ]
        };

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

        function openAddLeaseModal() {
            document.getElementById('leasePropSelect').value = "";
            document.getElementById('leaseFloorSelect').innerHTML = '<option value="" disabled selected>اختر الطابق أولاً</option>';
            document.getElementById('leaseUnitSelect').innerHTML = '<option value="" disabled selected>اختر الوحدة أولاً</option>';
            document.getElementById('leaseTenant').value = '';
            document.getElementById('leasePhone').value = '';
            document.getElementById('leaseAmount').value = '';
            
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
                row.setAttribute('data-prop', prop);
                row.setAttribute('data-floor', floor);
                row.setAttribute('data-unit', unit);
                row.setAttribute('data-tenant', tenant);
                row.setAttribute('data-phone', phone);
                row.setAttribute('data-amount', amount);
                row.setAttribute('data-files', JSON.stringify(filesArr));

                row.querySelector('.col-prop').innerText = prop;
                row.querySelector('.col-unit').innerText = `${floor} (${unit})`;
                row.querySelector('.col-tenant').innerHTML = `${tenant}<br><small style="color:#777;">📞 ${phone || '-'}</small>`;
                row.querySelector('.col-amount').innerText = `${amount} ر.ع`;
                
                let filesHtml = '<div style="display:flex; flex-direction:column; gap:4px;">';
                if(filesArr.length === 0) {
                    filesHtml += '<span style="color:#999; font-style:italic;">لا توجد مرفقات</span>';
                } else {
                    filesArr.forEach(f => {
                        filesHtml += `
                            <div style="display:flex; gap:5px; align-items:center;">
                                <a href="#" onclick="viewFile('${f.url}', '${f.name}')" style="color:#27ae60; text-decoration:none; font-weight:bold; font-size:13px; cursor:pointer;">📄 ${f.name}</a>
                                <button onclick="viewFile('${f.url}', '${f.name}')" style="background:#f39c12; color:white; border:none; padding:1px 4px; border-radius:3px; cursor:pointer; font-size:10px;" title="معاينة وطباعة">🖨️</button>
                            </div>
                        `;
                    });
                }
                filesHtml += '</div>';
                row.querySelector('.col-files').innerHTML = filesHtml;

                closeEditLeaseModal();
                alert('تم تحديث العقد والمرفقات بنجاح!');
            }
        }

        function saveNewLease() {
            let prop = document.getElementById('leasePropSelect').value;
            let floor = document.getElementById('leaseFloorSelect').value;
            let unit = document.getElementById('leaseUnitSelect').value;
            let tenant = document.getElementById('leaseTenant').value;
            let phone = document.getElementById('leasePhone').value;
            let amount = document.getElementById('leaseAmount').value;

            if(!prop || !floor || !unit || !tenant || !amount) {
                alert('الرجاء تعبئة الحقول الأساسية');
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

                let newRow = document.createElement('tr');
                newRow.id = 'lease-row-' + rowCount;
                newRow.setAttribute('data-prop', prop);
                newRow.setAttribute('data-floor', floor);
                newRow.setAttribute('data-unit', unit);
                newRow.setAttribute('data-tenant', tenant);
                newRow.setAttribute('data-phone', phone);
                newRow.setAttribute('data-amount', amount);
                newRow.setAttribute('data-files', JSON.stringify(filesArr));

                let filesHtml = '<div style="display:flex; flex-direction:column; gap:4px;">';
                if(filesArr.length === 0) {
                    filesHtml += '<span style="color:#999; font-style:italic;">لا توجد مرفقات</span>';
                } else {
                    filesArr.forEach(f => {
                        filesHtml += `
                            <div style="display:flex; gap:5px; align-items:center;">
                                <a href="#" onclick="viewFile('${f.url}', '${f.name}')" style="color:#27ae60; text-decoration:none; font-weight:bold; font-size:13px; cursor:pointer;">📄 ${f.name}</a>
                                <button onclick="viewFile('${f.url}', '${f.name}')" style="background:#f39c12; color:white; border:none; padding:1px 4px; border-radius:3px; cursor:pointer; font-size:10px;" title="معاينة وطباعة">🖨️</button>
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
                    <td class="col-amount">${amount} ر.ع</td>
                    <td class="col-files">${filesHtml}</td>
                    <td><button onclick="openEditLeaseModal(${rowCount})" style="background:#eef2f5; border:none; padding:6px 12px; border-radius:4px; cursor:pointer; font-weight:bold;">تعديل</button></td>
                `;

                tbody.appendChild(newRow);
                closeAddLeaseModal();
                alert('تمت إضافة عقد الإيجار والمرفقات بنجاح!');
            }
        }
    </script>
</body>
</html>
