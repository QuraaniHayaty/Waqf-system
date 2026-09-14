<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بيانات عقارات الوقف - وقف تعليم القرآن الكريم والعلوم الشرعية</title>
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
        
        .action-dropdown { position: relative; display: inline-block; }
        .action-btn { background: #eef2f5; border: none; padding: 6px 14px; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 16px; color: #333; }
        .action-btn:hover { background: #dfe4ea; }
        
        .dropdown-menu { display: none; position: absolute; left: 0; top: 100%; background-color: white; min-width: 160px; box-shadow: 0px 8px 16px rgba(0,0,0,0.1); border-radius: 6px; z-index: 100; border: 1px solid #eee; overflow: hidden; }
        .dropdown-menu a { color: #333; padding: 10px 15px; text-decoration: none; display: block; font-size: 13px; text-align: right; transition: background 0.2s; }
        .dropdown-menu a:hover { background-color: #f1f8f4; color: #27ae60; }
        .dropdown-menu a.delete-item { color: #c0392b; }
        .dropdown-menu a.delete-item:hover { background-color: #fde8e8; }
        
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
        .form-group input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; text-align: right; background: #fff; }
        
        /* الطوابق والوحدات */
        .floats-section-title { font-size: 15px; color: #2e5a36; font-weight: bold; margin-bottom: 10px; border-bottom: 2px solid #27ae60; padding-bottom: 5px; display: flex; justify-content: space-between; align-items: center; }
        .floor-card { background: #fafafa; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px; margin-bottom: 15px; }
        .floor-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; }
        .floor-name-input { font-weight: bold; width: 60% !important; padding: 6px 10px !important; }
        
        .unit-row { display: flex; gap: 10px; margin-bottom: 8px; align-items: center; background: #fff; padding: 8px; border: 1px solid #eee; border-radius: 6px; }
        .unit-row select, .unit-row input { flex: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px; font-size: 13px; }
        
        .btn-add-floor { background-color: #27ae60; color: white; border: none; padding: 6px 12px; border-radius: 6px; font-size: 13px; font-weight: bold; cursor: pointer; }
        .btn-add-unit-in-floor { background-color: #3498db; color: white; border: none; padding: 6px 12px; border-radius: 4px; font-size: 12px; cursor: pointer; font-weight: bold; }
        .btn-remove { background: #e74c3c; color: white; border: none; padding: 6px 10px; border-radius: 4px; cursor: pointer; font-size: 12px; }
        
        .modal-footer { padding: 15px 20px; border-top: 1px solid #eee; display: flex; justify-content: flex-start; background: #fafafa; }
        .btn-save { background-color: #27ae60; color: white; border: none; padding: 8px 18px; border-radius: 6px; font-size: 14px; font-weight: bold; cursor: pointer; }
        .btn-save:hover { background-color: #219653; }

        /* نافذة إشعار النجاح */
        .alert-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.4); z-index: 2000; justify-content: center; align-items: center; }
        .alert-box { background: white; width: 420px; border-radius: 10px; box-shadow: 0 5px 25px rgba(0,0,0,0.2); padding: 30px 20px; text-align: center; animation: fadeIn 0.2s ease-in-out; }
        .success-icon-circle { width: 70px; height: 70px; border: 3px solid #27ae60; border-radius: 50%; display: flex; justify-content: center; align-items: center; margin: 0 auto 15px auto; color: #27ae60; font-size: 32px; }
        .alert-box h2 { font-size: 20px; color: #333; margin-bottom: 10px; font-weight: bold; }
        .alert-box p { font-size: 14px; color: #666; margin-bottom: 25px; }
        .btn-ok { background-color: #5c6bc0; color: white; border: none; padding: 8px 40px; border-radius: 6px; font-size: 15px; font-weight: bold; cursor: pointer; transition: background 0.2s; }
        .btn-ok:hover { background-color: #3f51b5; }

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
                <li><a href="properties.php" class="active">بيانات عقارات الوقف</a></li>
                <li><a href="#">قائمة البرامج المستفيدة</a></li>
                <li><a href="#">عقود الإيجارات</a></li>
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
                <h1>بيانات عقارات الوقف</h1>
                <p>إدارة واستيراد عقارات الوقف بكفاءة عالية</p>
            </div>
        </div>

        <div class="action-bar">
            <button class="btn-add" onclick="openAddModal()">➕ إضافة عقار</button>
        </div>

        <div class="content-card">
            <div class="search-box">
                <input type="text" placeholder="بحث...">
            </div>
            <table>
                <thead>
                    <tr>
                        <th>المعرف</th>
                        <th>اسم الوقف</th>
                        <th>مكان الوقف</th>
                        <th>عدد الوحدات</th>
                        <th>إجمالي الدخل الحالي</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <tr id="row-1" data-floats='[{"floor":"الطابق الأرضي","units":[{"type":"محل","no":"1"},{"type":"محل","no":"2"}]},{"floor":"الطابق الأول","units":[{"type":"شقة","no":"101"},{"type":"شقة","no":"102"}]}]'>
                        <td>1</td>
                        <td class="prop-name">عمارة الروضة التجارية</td>
                        <td class="prop-location">قرية الروضة - الشارع العام</td>
                        <td class="prop-units">4 وحدة</td>
                        <td class="prop-income" style="font-weight: bold; color: #555;">-</td>
                        <td>
                            <div class="action-dropdown">
                                <button class="action-btn" onclick="toggleMenu(event, 'menu-1')">⋮</button>
                                <div id="menu-1" class="dropdown-menu">
                                    <a href="#" onclick="openEditModal(1)">تعديل</a>
                                    <a href="#" onclick="openUnitsModal(1)">وحدات الوقف</a>
                                    <a href="#">عقود الإيجار</a>
                                    <a href="#" class="delete-item">حذف</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="pagination">
                <span id="paginationText">عرض 1 إلى 1 من 1 مدخلات</span>
                <button>&lt;</button>
                <button class="active">1</button>
                <button>&gt;</button>
            </div>
        </div>
    </main>

    <!-- نافذة تعديل العقار -->
    <div id="editModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <h3>تعديل العقار</h3>
                <button class="close-modal" onclick="closeEditModal()">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editPropId">
                <div class="form-group">
                    <label>اسم الوقف</label>
                    <input type="text" id="editPropName">
                </div>
                <div class="form-group">
                    <label>مكان الوقف</label>
                    <input type="text" id="editPropLocation">
                </div>
                
                <div class="floats-section-title">
                    <span>طوابق ووحدات العقار</span>
                    <button type="button" class="btn-add-floor" onclick="addFloorRow('edit-floats-container')">➕ إضافة طابق</button>
                </div>
                <div id="edit-floats-container"></div>
            </div>
            <div class="modal-footer">
                <button class="btn-save" onclick="saveEditChanges()">حفظ التغييرات</button>
            </div>
        </div>
    </div>

    <!-- نافذة إضافة عقار -->
    <div id="addModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <h3>إضافة عقار جديد</h3>
                <button class="close-modal" onclick="closeAddModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>اسم الوقف</label>
                    <input type="text" id="addPropName" placeholder="أدخل اسم الوقف">
                </div>
                <div class="form-group">
                    <label>مكان الوقف</label>
                    <input type="text" id="addPropLocation" placeholder="أدخل مكان الوقف">
                </div>

                <div class="floats-section-title">
                    <span>طوابق ووحدات العقار</span>
                    <button type="button" class="btn-add-floor" onclick="addFloorRow('add-floats-container')">➕ إضافة طابق</button>
                </div>
                <div id="add-floats-container"></div>
            </div>
            <div class="modal-footer">
                <button class="btn-save" onclick="saveNewProperty()">حفظ</button>
            </div>
        </div>
    </div>

    <!-- نافذة عرض وحدات الوقف -->
    <div id="unitsModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <h3 id="unitsModalTitle">وحدات الوقف</h3>
                <button class="close-modal" onclick="closeUnitsModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div id="unitsDetailsContent" style="font-size: 14px; line-height: 1.6; color: #333;"></div>
            </div>
            <div class="modal-footer">
                <button class="btn-save" onclick="closeUnitsModal()">إغلاق</button>
            </div>
        </div>
    </div>

    <!-- نافذة إشعار النجاح -->
    <div id="successAlert" class="alert-overlay">
        <div class="alert-box">
            <div class="success-icon-circle">✓</div>
            <h2>نجاح</h2>
            <p id="alertMessage">تمت العملية بنجاح</p>
            <button class="btn-ok" onclick="closeSuccessAlert()">OK</button>
        </div>
    </div>

    <script>
        let propertyCount = 1;

        function toggleMenu(event, menuId) {
            event.stopPropagation();
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                if (menu.id !== menuId) menu.style.display = 'none';
            });
            let menu = document.getElementById(menuId);
            menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
        }

        window.onclick = function() {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.style.display = 'none';
            });
        }

        function addFloorRow(containerId, floorName = '', units = []) {
            let container = document.getElementById(containerId);
            let floorDiv = document.createElement('div');
            floorDiv.className = 'floor-card';
            
            let floorId = 'floor_' + Math.random().toString(36).substr(2, 9);
            floorDiv.innerHTML = `
                <div class="floor-header">
                    <input type="text" class="floor-name-input" placeholder="اسم الطابق (مثال: الطابق الأول)" value="${floorName}">
                    <button type="button" class="btn-remove" onclick="this.closest('.floor-card').remove()">حذف الطابق</button>
                </div>
                <div class="units-in-floor" id="${floorId}"></div>
                <button type="button" class="btn-add-unit-in-floor" onclick="addUnitInFloor('${floorId}')">➕ إضافة وحدة</button>
            `;
            container.appendChild(floorDiv);

            let unitsContainer = floorDiv.querySelector('.units-in-floor');
            if(units && units.length > 0) {
                units.forEach(u => {
                    addUnitRowObj(unitsContainer, u.type, u.no);
                });
            } else {
                addUnitRowObj(unitsContainer, '', '');
            }
        }

        function addUnitInFloor(floorId, type = '', no = '') {
            let container = document.getElementById(floorId);
            addUnitRowObj(container, type, no);
        }

        function addUnitRowObj(container, type, no) {
            let row = document.createElement('div');
            row.className = 'unit-row';
            row.innerHTML = `
                <select class="unit-type">
                    <option value="" disabled ${type===''?'selected':''}>نوع الوحدة</option>
                    <option value="محل" ${type==='محل'?'selected':''}>محل</option>
                    <option value="شقة" ${type==='شقة'?'selected':''}>شقة</option>
                    <option value="مخزن" ${type==='مخزن'?'selected':''}>مخزن</option>
                    <option value="منزل" ${type==='منزل'?'selected':''}>منزل</option>
                </select>
                <input type="text" class="unit-no" placeholder="رقم أو اسم الوحدة (مثال: 101)" value="${no}">
                <button type="button" class="btn-remove" onclick="this.parentElement.remove()">حذف</button>
            `;
            container.appendChild(row);
        }

        function openUnitsModal(id) {
            let row = document.getElementById('row-' + id);
            let propName = row.querySelector('.prop-name').innerText;
            let floatsData = JSON.parse(row.getAttribute('data-floats') || '[]');

            document.getElementById('unitsModalTitle').innerText = 'وحدات العقار: ' + propName;
            let contentDiv = document.getElementById('unitsDetailsContent');
            
            if(floatsData.length === 0) {
                contentDiv.innerHTML = '<p style="color: #7f8c8d; text-align: center;">لا توجد طوابق أو وحدات مضافة لهذا العقار.</p>';
            } else {
                let html = '';
                floatsData.forEach(f => {
                    html += `<div style="background: #fdfdfd; border: 1px solid #e2e8f0; border-radius: 6px; padding: 12px; margin-bottom: 15px;">
                        <h4 style="color: #2e5a36; margin-bottom: 8px; border-bottom: 1px solid #eee; padding-bottom: 4px;">🏢 ${f.floor}</h4>`;
                    if(!f.units || f.units.length === 0) {
                        html += '<p style="font-size: 13px; color: #777;">لا توجد وحدات في هذا الطابق.</p>';
                    } else {
                        html += '<table style="width: 100%; font-size: 13px;"><thead><tr style="background:#f1f5f9;"><th>نوع الوحدة</th><th>رقم/اسم الوحدة</th><th>حالة التأجير</th><th>القيمة الإيجارية</th></tr></thead><tbody>';
                        f.units.forEach(u => {
                            html += `<tr><td>${u.type}</td><td>${u.no}</td><td><span style="background:#fee2e2; color:#991b1b; padding:2px 8px; border-radius:4px; font-size:12px;">غير مؤجرة</span></td><td>-</td></tr>`;
                        });
                        html += '</tbody></table>';
                    }
                    html += `</div>`;
                });
                contentDiv.innerHTML = html;
            }

            document.getElementById('unitsModal').style.display = 'flex';
        }

        function closeUnitsModal() {
            document.getElementById('unitsModal').style.display = 'none';
        }

        function openEditModal(id) {
            let row = document.getElementById('row-' + id);
            let name = row.querySelector('.prop-name').innerText;
            let location = row.querySelector('.prop-location').innerText;
            let floatsData = JSON.parse(row.getAttribute('data-floats') || '[]');

            document.getElementById('editPropId').value = id;
            document.getElementById('editPropName').value = name;
            document.getElementById('editPropLocation').value = location;
            
            let container = document.getElementById('edit-floats-container');
            container.innerHTML = '';
            floatsData.forEach(f => {
                addFloorRow('edit-floats-container', f.floor, f.units);
            });

            document.getElementById('editModal').style.display = 'flex';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        function saveEditChanges() {
            let id = document.getElementById('editPropId').value;
            let row = document.getElementById('row-' + id);

            let name = document.getElementById('editPropName').value;
            let location = document.getElementById('editPropLocation').value;

            let floatsArr = [];
            let totalUnitsCount = 0;

            document.querySelectorAll('#edit-floats-container .floor-card').forEach(fc => {
                let floorName = fc.querySelector('.floor-name-input').value || 'طابق غير محدد';
                let unitsArr = [];
                fc.querySelectorAll('.unit-row').forEach(ur => {
                    let t = ur.querySelector('.unit-type').value;
                    let n = ur.querySelector('.unit-no').value;
                    if(t && n) {
                        unitsArr.push({ type: t, no: n });
                        totalUnitsCount++;
                    }
                });
                floatsArr.push({ floor: floorName, units: unitsArr });
            });

            row.querySelector('.prop-name').innerText = name;
            row.querySelector('.prop-location').innerText = location;
            row.querySelector('.prop-units').innerText = totalUnitsCount + ' وحدة';
            row.querySelector('.prop-income').innerText = '-';
            row.setAttribute('data-floats', JSON.stringify(floatsArr));

            closeEditModal();
            document.getElementById('alertMessage').innerText = "Property updated successfully";
            document.getElementById('successAlert').style.display = 'flex';
        }

        function openAddModal() {
            document.getElementById('addPropName').value = '';
            document.getElementById('addPropLocation').value = '';
            document.getElementById('add-floats-container').innerHTML = '';
            addFloorRow('add-floats-container', 'الطابق الأرضي', []);
            document.getElementById('addModal').style.display = 'flex';
        }

        function closeAddModal() {
            document.getElementById('addModal').style.display = 'none';
        }

        function saveNewProperty() {
            let name = document.getElementById('addPropName').value;
            let location = document.getElementById('addPropLocation').value;

            if(!name || !location) {
                alert('الرجاء تعبئة اسم الوقف ومكانه');
                return;
            }

            let floatsArr = [];
            let totalUnitsCount = 0;

            document.querySelectorAll('#add-floats-container .floor-card').forEach(fc => {
                let floorName = fc.querySelector('.floor-name-input').value || 'طابق غير محدد';
                let unitsArr = [];
                fc.querySelectorAll('.unit-row').forEach(ur => {
                    let t = ur.querySelector('.unit-type').value;
                    let n = ur.querySelector('.unit-no').value;
                    if(t && n) {
                        unitsArr.push({ type: t, no: n });
                        totalUnitsCount++;
                    }
                });
                floatsArr.push({ floor: floorName, units: unitsArr });
            });

            propertyCount++;
            let newId = propertyCount;
            let tbody = document.getElementById('tableBody');

            let newRow = document.createElement('tr');
            newRow.id = 'row-' + newId;
            newRow.setAttribute('data-floats', JSON.stringify(floatsArr));
            newRow.innerHTML = `
                <td>${newId}</td>
                <td class="prop-name">${name}</td>
                <td class="prop-location">${location}</td>
                <td class="prop-units">${totalUnitsCount} وحدة</td>
                <td class="prop-income" style="font-weight: bold; color: #555;">-</td>
                <td>
                    <div class="action-dropdown">
                        <button class="action-btn" onclick="toggleMenu(event, 'menu-${newId}')">⋮</button>
                        <div id="menu-${newId}" class="dropdown-menu">
                            <a href="#" onclick="openEditModal(${newId})">تعديل</a>
                            <a href="#" onclick="openUnitsModal(${newId})">وحدات الوقف</a>
                            <a href="#">عقود الإيجار</a>
                            <a href="#" class="delete-item">حذف</a>
                        </div>
                    </div>
                </td>
            `;

            tbody.appendChild(newRow);
            document.getElementById('paginationText').innerText = `عرض 1 إلى ${newId} من ${newId} مدخلات`;

            closeAddModal();
            document.getElementById('alertMessage').innerText = "Property added successfully";
            document.getElementById('successAlert').style.display = 'flex';
        }

        function closeSuccessAlert() {
            document.getElementById('successAlert').style.display = 'none';
        }
    </script>
</body>
</html>
