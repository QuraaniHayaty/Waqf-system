<?php require_once 'auth.php'; ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الحسابات والأسهم الوقفية - وقف تعليم القرآن الكريم والعلوم الشرعية</title>
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
        
        .top-banner { background-color: #27ae60; color: white; margin: 20px 25px; padding: 20px 30px; border-radius: 10px; display: flex; justify-content: space-between; align-items: center; }
        .banner-title h1 { font-size: 22px; margin-bottom: 5px; font-weight: bold; }
        .banner-title p { font-size: 13px; opacity: 0.9; }

        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; margin: 0 25px 20px 25px; }
        .stat-card { background: white; padding: 15px 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); text-align: center; border-top: 4px solid #27ae60; }
        .stat-card h3 { font-size: 13px; color: #666; margin-bottom: 8px; }
        .stat-card .amount { font-size: 18px; font-weight: bold; color: #2e5a36; }

        .tabs-bar { margin: 0 25px 15px 25px; display: flex; justify-content: space-between; align-items: center; background: white; padding: 10px 15px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); flex-wrap: wrap; gap: 10px; }
        .tab-btns { display: flex; gap: 8px; }
        .tab-btn { background: #f1f5f9; color: #333; border: none; padding: 8px 16px; border-radius: 6px; font-size: 13px; font-weight: bold; cursor: pointer; transition: all 0.2s; }
        .tab-btn.active { background: #27ae60; color: white; }
        
        .filter-section { display: flex; align-items: center; gap: 10px; font-size: 13px; color: #555; }
        .filter-section input { padding: 6px 10px; border: 1px solid #ddd; border-radius: 6px; font-size: 13px; }
        .btn-filter-reset { background: #e2e8f0; border: none; padding: 6px 12px; border-radius: 6px; cursor: pointer; font-weight: bold; font-size: 12px; }

        .action-bar { padding: 0 25px; margin-bottom: 15px; display: flex; justify-content: space-between; align-items: center; }
        .btn-action-add { background-color: #27ae60; color: white; padding: 9px 18px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: bold; cursor: pointer; border: none; transition: background 0.2s; }
        .btn-action-add:hover { background-color: #219653; }
        .btn-expense-add { background-color: #c0392b; }
        .btn-expense-add:hover { background-color: #a93226; }

        .content-card { background: white; margin: 0 25px 25px 25px; padding: 20px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        
        table { width: 100%; border-collapse: collapse; text-align: right; }
        th, td { padding: 10px 12px; border-bottom: 1px solid #eee; font-size: 13px; color: #333; }
        th { background-color: #f8f9fa; color: #2e5a36; font-weight: 600; }
        tr:hover { background-color: #fcfcfc; }
        
        .btn-edit { background: #eef2f5; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 11px; color: #333; }
        .btn-delete { background: #fee2e2; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 11px; color: #dc2626; }

        .modal-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); z-index: 1000; justify-content: center; align-items: center; }
        .modal-box { background: white; width: 600px; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.15); overflow: hidden; max-height: 90vh; display: flex; flex-direction: column; }
        .modal-header { display: flex; justify-content: space-between; align-items: center; padding: 12px 20px; border-bottom: 1px solid #eee; background: #f8f9fa; }
        .modal-header h3 { font-size: 15px; color: #333; font-weight: bold; }
        .close-modal { background: none; border: none; font-size: 18px; cursor: pointer; color: #888; }
        .modal-body { padding: 15px 20px; overflow-y: auto; flex-grow: 1; }
        .form-group { margin-bottom: 12px; }
        .form-group label { display: block; font-size: 12px; color: #555; margin-bottom: 4px; font-weight: bold; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 8px 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 13px; text-align: right; background: #fff; }
        
        .modal-footer { padding: 12px 20px; border-top: 1px solid #eee; display: flex; justify-content: flex-end; gap: 10px; background: #fafafa; }
        .btn-save { background-color: #27ae60; color: white; border: none; padding: 7px 16px; border-radius: 6px; font-size: 13px; font-weight: bold; cursor: pointer; }
        .btn-cancel { background-color: #94a3b8; color: white; border: none; padding: 7px 16px; border-radius: 6px; font-size: 13px; font-weight: bold; cursor: pointer; }

        @media (max-width: 768px) {
            body { flex-direction: column; height: auto; overflow: visible; }
            aside { width: 100%; height: auto; }
            .nav-container { max-height: 220px; overflow-y: auto; }
            main { height: auto; overflow: visible; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); margin: 0 12px 15px 12px; }
            .top-banner { flex-direction: column; align-items: flex-start; gap: 10px; margin: 15px 12px; }
            .tabs-bar { margin: 0 12px 12px 12px; }
            .action-bar { padding: 0 12px; flex-direction: column; gap: 10px; align-items: stretch; }
            .content-card { margin: 0 12px 20px 12px; padding: 12px; }
            table { display: block; overflow-x: auto; white-space: nowrap; }
            .modal-box { width: 95vw !important; max-width: 95vw; }
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
                <li><a href="leases.php">عقود الإيجارات</a></li>
                <li><a href="finance.php" class="active">الحسابات والأسهم الوقفية</a></li>
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
                <h1>منظومة الحسابات والأسهم الوقفية والمصروفات</h1>
                <p>متابعة تحصيل الأسهم الوقفية، التبرعات العامة، وإيرادات الإيجارات والمصروفات</p>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>إيرادات عقود الإيجار</h3>
                <div class="amount" id="statLeasesIncome">0.000 ر.ع</div>
            </div>
            <div class="stat-card">
                <h3>التبرعات والمساهمات الوقفية</h3>
                <div class="amount" id="statDonations">0.000 ر.ع</div>
            </div>
            <div class="stat-card">
                <h3>المصروفات التشغيلية للوقف</h3>
                <div class="amount" id="statExpenses" style="color: #c0392b;">0.000 ر.ع</div>
            </div>
            <div class="stat-card" style="border-top-color: #3498db;">
                <h3>صافي رصيد صندوق الوقف المتبقي</h3>
                <div class="amount" id="statNetBalance" style="color: #2980b9;">0.000 ر.ع</div>
            </div>
        </div>

        <div class="tabs-bar">
            <div class="tab-btns">
                <button class="tab-btn active" id="btnTabDonation" onclick="switchSection('donation')">التبرعات والأسهم الوقفية</button>
                <button class="tab-btn" id="btnTabLease" onclick="switchSection('lease')">إيرادات الإيجارات</button>
                <button class="tab-btn" id="btnTabExpense" onclick="switchSection('expense')">سجل المصروفات</button>
            </div>
            <div class="filter-section" style="flex-wrap: wrap; gap: 8px;">
                <input type="text" id="searchInput" placeholder="بحث بالاسم، الهاتف، أو الملاحظات..." oninput="renderActiveSection()" style="padding: 6px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 13px; width: 220px;">
                <select id="filterMethodOrCategory" onchange="renderActiveSection()" style="padding: 6px 10px; border: 1px solid #ddd; border-radius: 6px; font-size: 13px; background: #fff;">
                    <option value="">جميع طرق الدفع / التصنيفات</option>
                </select>
                <label>من:</label>
                <input type="date" id="filterStartDate" onchange="renderActiveSection()">
                <label>إلى:</label>
                <input type="date" id="filterEndDate" onchange="renderActiveSection()">
                <button class="btn-filter-reset" onclick="resetFilters()">إعادة ضبط</button>
            </div>
        </div>

        <div class="action-bar">
            <div id="actionButtonContainer">
                <button class="btn-action-add" onclick="openAddDonationModal()">➕ تسجيل تبرع جديد</button>
            </div>
        </div>

        <div class="content-card">
            <h3 id="sectionTitle" style="margin-bottom: 15px; color: #2e5a36; font-size: 16px;">سجل التبرعات والأسهم الوقفية</h3>
            <table>
                <thead>
                    <tr id="tableHeaderRow">
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
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <!-- البيانات تُجلب ديناميكياً -->
                </tbody>
            </table>
        </div>
    </main>

    <!-- نافذة تسجيل تبرع جديد -->
    <div id="addDonationModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <h3>تسجيل تبرع / مسهمة وقفية جديدة</h3>
                <button class="close-modal" onclick="closeAddDonationModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>اسم المتبرع</label>
                    <input type="text" id="donName" value="فاعل خير">
                </div>
                <div class="form-group">
                    <label>رقم الهاتف</label>
                    <input type="text" id="donPhone" placeholder="أدخل رقم الهاتف">
                </div>
                <div class="form-group">
                    <label>نوع المساهمة / التبرع</label>
                    <select id="donType">
                        <option value="سهم وقفي عام">سهم وقفي عام</option>
                        <option value="تبرع عام">تبرع عام</option>
                        <option value="مساهمة بناء">مساهمة بناء</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>المبلغ (ر.ع)</label>
                    <input type="number" id="donAmount" placeholder="أدخل المبلغ">
                </div>
                <div class="form-group">
                    <label>تاريخ التبرع</label>
                    <input type="date" id="donDate" value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="form-group">
                    <label>طريقة الدفع</label>
                    <select id="donMethod">
                        <option value="تحويل بنكي">تحويل بنكي</option>
                        <option value="نقداً">نقداً</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>إيصالات ومرفقات التبرع</label>
                    <div id="addDonAttachmentsContainer" style="margin-bottom: 8px;"></div>
                    <button type="button" class="btn-action-add" onclick="addAttachmentRow('addDonAttachmentsContainer')" style="background-color: #3498db; color: white; border: none; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: bold; cursor: pointer;">➕ إضافة مرفق جديد</button>
                </div>
                <div class="form-group">
                    <label>ملاحظات إضافية</label>
                    <textarea id="donNotes" rows="2" placeholder="أي ملاحظات..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeAddDonationModal()">إلغاء</button>
                <button class="btn-save" onclick="saveNewDonation()">حفظ التبرع</button>
            </div>
        </div>
    </div>

    <!-- نافذة تعديل التبرع -->
    <div id="editDonationModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <h3>تعديل بيانات التبرع / المساهمة الوقفية</h3>
                <button class="close-modal" onclick="closeEditDonationModal()">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editDonId">
                <div class="form-group">
                    <label>اسم المتبرع</label>
                    <input type="text" id="editDonName">
                </div>
                <div class="form-group">
                    <label>رقم الهاتف</label>
                    <input type="text" id="editDonPhone">
                </div>
                <div class="form-group">
                    <label>نوع المساهمة / التبرع</label>
                    <select id="editDonType">
                        <option value="سهم وقفي عام">سهم وقفي عام</option>
                        <option value="تبرع عام">تبرع عام</option>
                        <option value="مساهمة بناء">مساهمة بناء</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>المبلغ (ر.ع)</label>
                    <input type="number" id="editDonAmount">
                </div>
                <div class="form-group">
                    <label>تاريخ التبرع</label>
                    <input type="date" id="editDonDate">
                </div>
                <div class="form-group">
                    <label>طريقة الدفع</label>
                    <select id="editDonMethod">
                        <option value="تحويل بنكي">تحويل بنكي</option>
                        <option value="نقداً">نقداً</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>مرفقات الإيصال</label>
                    <div id="editDonAttachmentsContainer"></div>
                    <button type="button" class="btn-action-add" onclick="addAttachmentRow('editDonAttachmentsContainer')" style="font-size: 11px; padding: 4px 10px;">➕ إضافة مرفق جديد</button>
                </div>
                <div class="form-group">
                    <label>ملاحظات إضافية</label>
                    <textarea id="editDonNotes" rows="2"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeEditDonationModal()">إلغاء</button>
                <button class="btn-save" onclick="updateDonation()">حفظ التعديلات</button>
            </div>
        </div>
    </div>

    <!-- نافذة تسجيل مصروف جديد -->
    <div id="addExpenseModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <h3>تسجيل مصروف تشغيلي جديد للوقف</h3>
                <button class="close-modal" onclick="closeAddExpenseModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>بند المصروف</label>
                    <select id="expTitle">
                        <option value="عقارات الوقف">عقارات الوقف</option>
                        <option value="برامج التحفيظ">برامج التحفيظ</option>
                        <option value="الصيانة العامة">الصيانة العامة</option>
                        <option value="أخرى">أخرى</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>التصنيف</label>
                    <select id="expCategory">
                        <option value="خدمات ومرافق (كهرباء/مياه/إنترنت)">خدمات ومرافق (كهرباء/مياه/إنترنت)</option>
                        <option value="صيانة دورية">صيانة دورية</option>
                        <option value="مشتريات تشغيلية">مشتريات تشغيلية</option>
                        <option value="أخرى">أخرى</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>المبلغ (ر.ع)</label>
                    <input type="number" id="expAmount" placeholder="أدخل المبلغ">
                </div>
                <div class="form-group">
                    <label>تاريخ الصرف</label>
                    <input type="date" id="expDate" value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="form-group">
                    <label>الفواتير والمرفقات</label>
                    <div id="addExpAttachmentsContainer"></div>
                    <button type="button" class="btn-action-add" onclick="addAttachmentRow('addExpAttachmentsContainer')" style="font-size: 11px; padding: 4px 10px;">➕ إضافة مرفق جديد</button>
                </div>
                <div class="form-group">
                    <label>التفاصيل والملاحظات</label>
                    <textarea id="expDetails" rows="2" placeholder="تفاصيل المصروف..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeAddExpenseModal()">إلغاء</button>
                <button class="btn-save" onclick="saveNewExpense()" style="background: #c0392b;">حفظ المصروف</button>
            </div>
        </div>
    </div>

    <!-- نافذة تعديل المصروف -->
    <div id="editExpenseModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <h3>تعديل مصروف تشغيلي</h3>
                <button class="close-modal" onclick="closeEditExpenseModal()">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editExpId">
                <div class="form-group">
                    <label>بند المصروف</label>
                    <select id="editExpTitle">
                        <option value="عقارات الوقف">عقارات الوقف</option>
                        <option value="برامج التحفيظ">برامج التحفيظ</option>
                        <option value="الصيانة العامة">الصيانة العامة</option>
                        <option value="أخرى">أخرى</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>التصنيف</label>
                    <select id="editExpCategory">
                        <option value="خدمات ومرافق (كهرباء/مياه/إنترنت)">خدمات ومرافق (كهرباء/مياه/إنترنت)</option>
                        <option value="صيانة دورية">صيانة دورية</option>
                        <option value="مشتريات تشغيلية">مشتريات تشغيلية</option>
                        <option value="أخرى">أخرى</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>المبلغ (ر.ع)</label>
                    <input type="number" id="editExpAmount">
                </div>
                <div class="form-group">
                    <label>تاريخ الصرف</label>
                    <input type="date" id="editExpDate">
                </div>
                <div class="form-group">
                    <label>الفواتير والمرفقات</label>
                    <div id="editExpAttachmentsContainer"></div>
                    <button type="button" class="btn-action-add" onclick="addAttachmentRow('editExpAttachmentsContainer')" style="font-size: 11px; padding: 4px 10px;">➕ إضافة مرفق جديد</button>
                </div>
                <div class="form-group">
                    <label>التفاصيل والملاحظات</label>
                    <textarea id="editExpDetails" rows="2"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeEditExpenseModal()">إلغاء</button>
                <button class="btn-save" onclick="updateExpense()" style="background: #c0392b;">حفظ التعديلات</button>
            </div>
        </div>
    </div>

    <script>
        let allFinances = [];
        let allLeases = [];
        let activeSection = 'donation';

        document.addEventListener("DOMContentLoaded", function() {
            loadAllData();
        });

        function loadAllData() {
            Promise.all([
                fetch('api_finances.php?action=getAll').then(res => res.json()),
                fetch('api_leases.php?action=getAll').then(res => res.json())
            ])
            .then(([finances, leases]) => {
                allFinances = finances;
                allLeases = leases;
                updateDashboardStats();
                renderActiveSection();
            })
            .catch(err => console.error("Error loading data:", err));
        }

        function updateDashboardStats() {
            let startDate = document.getElementById('filterStartDate').value;
            let endDate = document.getElementById('filterEndDate').value;

            let leasesTotal = 0;
            allLeases.forEach(l => {
                let d = l.start_date || '';
                if((!startDate || d >= startDate) && (!endDate || d <= endDate)) {
                    leasesTotal += parseFloat(l.amount || 0);
                }
            });

            let donationsTotal = 0;
            let expensesTotal = 0;

            allFinances.forEach(f => {
                let d = f.t_date || '';
                if((!startDate || d >= startDate) && (!endDate || d <= endDate)) {
                    if(f.type === 'expense') {
                        expensesTotal += parseFloat(f.amount || 0);
                    } else {
                        donationsTotal += parseFloat(f.amount || 0);
                    }
                }
            });

            let netBalance = (leasesTotal + donationsTotal) - expensesTotal;

            document.getElementById('statLeasesIncome').innerText = leasesTotal.toFixed(3) + ' ر.ع';
            document.getElementById('statDonations').innerText = donationsTotal.toFixed(3) + ' ر.ع';
            document.getElementById('statExpenses').innerText = expensesTotal.toFixed(3) + ' ر.ع';
            document.getElementById('statNetBalance').innerText = netBalance.toFixed(3) + ' ر.ع';
        }

        function switchSection(section) {
            activeSection = section;
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            
            let btnContainer = document.getElementById('actionButtonContainer');
            let methodSelect = document.getElementById('filterMethodOrCategory');

            if(section === 'donation') {
                document.getElementById('btnTabDonation').classList.add('active');
                btnContainer.innerHTML = '<button class="btn-action-add" onclick="openAddDonationModal()">➕ تسجيل تبرع جديد</button>';
                methodSelect.innerHTML = '<option value="">جميع طرق الدفع</option><option value="تحويل بنكي">تحويل بنكي</option><option value="نقداً">نقداً</option>';
            } else if(section === 'lease') {
                document.getElementById('btnTabLease').classList.add('active');
                btnContainer.innerHTML = '<span style="color:#666; font-size:13px; font-weight:bold;">(إيرادات الإيجارات تُدار من قسم عقود الإيجار)</span>';
                methodSelect.innerHTML = '<option value="">لا توجد فلترة</option>';
            } else if(section === 'expense') {
                document.getElementById('btnTabExpense').classList.add('active');
                btnContainer.innerHTML = '<button class="btn-action-add btn-expense-add" onclick="openAddExpenseModal()">➕ تسجيل مصروف جديد</button>';
                methodSelect.innerHTML = '<option value="">جميع التصنيفات</option><option value="خدمات ومرافق (كهرباء/مياه/إنترنت)">خدمات ومرافق (كهرباء/مياه/إنترنت)</option><option value="صيانة دورية">صيانة دورية</option><option value="مشتريات تشغيلية">مشتريات تشغيلية</option><option value="أخرى">أخرى</option>';
            }

            document.getElementById('searchInput').value = '';
            methodSelect.value = '';
            renderActiveSection();
        }

        function renderActiveSection() {
            updateDashboardStats();
            let tbody = document.getElementById('tableBody');
            tbody.innerHTML = '';

            let startDate = document.getElementById('filterStartDate').value;
            let endDate = document.getElementById('filterEndDate').value;

            let headerRow = document.getElementById('tableHeaderRow');
            let titleEl = document.getElementById('sectionTitle');

            if(activeSection === 'donation') {
                titleEl.innerText = 'سجل التبرعات والأسهم الوقفية';
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

                let searchQuery = document.getElementById('searchInput').value.toLowerCase().trim();
                let methodFilter = document.getElementById('filterMethodOrCategory').value;

                let filtered = allFinances.filter(f => f.type !== 'expense');
                
                if(startDate || endDate) {
                    filtered = filtered.filter(f => (!startDate || f.t_date >= startDate) && (!endDate || f.t_date <= endDate));
                }
                if(methodFilter) {
                    filtered = filtered.filter(f => f.method === methodFilter);
                }
                if(searchQuery) {
                    filtered = filtered.filter(f => 
                        (f.title && f.title.toLowerCase().includes(searchQuery)) || 
                        (f.phone && f.phone.toLowerCase().includes(searchQuery)) || 
                        (f.notes && f.notes.toLowerCase().includes(searchQuery)) ||
                        (f.amount && f.amount.toString().includes(searchQuery))
                    );
                }

                if(filtered.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="10" style="text-align:center; color:#777;">لا توجد تبرعات مسجلة.</td></tr>';
                    return;
                }

                filtered.forEach((item, idx) => {
                    let fileLink = item.file_name ? `<a href="#" onclick="viewFile('uploads/${item.file_name}', '${item.file_name}')" style="color:#0369a1; font-weight:bold; text-decoration:none;">📄 عرض الإيصال</a>` : '<span style="color:#999;">لا يوجد</span>';
                    let tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${idx + 1}</td>
                        <td><strong>${item.title}</strong></td>
                        <td>${item.phone || '-'}</td>
                        <td><span style="background:#e0f2fe; color:#0369a1; padding:3px 8px; border-radius:4px; font-weight:bold;">${item.type}</span></td>
                        <td><strong style="color:#27ae60;">${parseFloat(item.amount).toFixed(3)} ر.ع</strong></td>
                        <td>${item.t_date || '-'}</td>
                        <td>${item.method || '-'}</td>
                        <td>${fileLink}</td>
                        <td>${item.notes || '-'}</td>
                        <td>
                            <div style="display:flex; gap:4px; align-items:center;">
                                <button onclick="openEditDonation(${item.id})" class="btn-edit">تعديل</button>
                                <button onclick="deleteRecord(${item.id})" class="btn-delete">حذف</button>
                            </div>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });

            } else if(activeSection === 'lease') {
                titleEl.innerText = 'إيرادات عقود الإيجار (للاطلاع والمتابعة)';
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
                    tbody.innerHTML = '<tr><td colspan="6" style="text-align:center; color:#777;">لا توجد عقود إيجار مسجلة.</td></tr>';
                    return;
                }

                filtered.forEach((lease, idx) => {
                    let tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${idx + 1}</td>
                        <td><strong>${lease.prop}</strong><br><small>${lease.floor} (${lease.unit})</small></td>
                        <td>${lease.tenant}<br><small>📞 ${lease.phone || '-'}</small></td>
                        <td>من: ${lease.start_date}<br>إلى: ${lease.end_date}</td>
                        <td><strong style="color:#27ae60;">${parseFloat(lease.amount).toFixed(3)} ر.ع</strong></td>
                        <td>${lease.created_at || '-'}</td>
                    `;
                    tbody.appendChild(tr);
                });

            } else if(activeSection === 'expense') {
                titleEl.innerText = 'سجل المصروفات التشغيلية للوقف';
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

                let searchQuery = document.getElementById('searchInput').value.toLowerCase().trim();
                let categoryFilter = document.getElementById('filterMethodOrCategory').value;

                let filtered = allFinances.filter(f => f.type === 'expense');
                
                if(startDate || endDate) {
                    filtered = filtered.filter(f => (!startDate || f.t_date >= startDate) && (!endDate || f.t_date <= endDate));
                }
                if(categoryFilter) {
                    filtered = filtered.filter(f => f.category === categoryFilter);
                }
                if(searchQuery) {
                    filtered = filtered.filter(f => 
                        (f.title && f.title.toLowerCase().includes(searchQuery)) || 
                        (f.category && f.category.toLowerCase().includes(searchQuery)) || 
                        (f.notes && f.notes.toLowerCase().includes(searchQuery)) ||
                        (f.amount && f.amount.toString().includes(searchQuery))
                    );
                }

                if(filtered.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="8" style="text-align:center; color:#777;">لا توجد مصروفات مسجلة.</td></tr>';
                    return;
                }

                filtered.forEach((item, idx) => {
                    let fileLink = item.file_name ? `<a href="#" onclick="viewFile('uploads/${item.file_name}', '${item.file_name}')" style="color:#0369a1; font-weight:bold; text-decoration:none;">📄 الفاتورة</a>` : '<span style="color:#999;">لا يوجد</span>';
                    let tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${idx + 1}</td>
                        <td><strong>${item.title}</strong></td>
                        <td><span style="background:#fee2e2; color:#991b1b; padding:3px 8px; border-radius:4px; font-weight:bold;">${item.category || '-'}</span></td>
                        <td>${item.notes || '-'}</td>
                        <td><strong style="color:#c0392b;">${parseFloat(item.amount).toFixed(3)} ر.ع</strong></td>
                        <td>${item.t_date || '-'}</td>
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
            document.getElementById('filterStartDate').value = '';
            document.getElementById('filterEndDate').value = '';
            document.getElementById('searchInput').value = '';
            let sel = document.getElementById('filterMethodOrCategory');
            if(sel) sel.value = '';
            renderActiveSection();
        }

        function addAttachmentRow(containerId) {
            let container = document.getElementById(containerId);
            let row = document.createElement('div');
            row.className = 'attachment-row';
            row.style.cssText = 'display:flex; gap:10px; align-items:center; margin-bottom:8px;';
            row.innerHTML = `
                <input type="file" class="att-file" style="flex:1; padding:6px; font-size:13px;">
                <button type="button" class="btn-action-add" onclick="this.parentElement.remove()" style="background:#e74c3c; color:white; border:none; padding:4px 8px; border-radius:4px; cursor:pointer; font-size:11px;">حذف</button>
            `;
            container.appendChild(row);
        }

        function viewFile(url, name) {
            if(url && url !== '#') {
                let win = window.open();
                win.document.write(`
                    <!DOCTYPE html>
                    <html lang="ar" dir="rtl">
                    <head>
                        <meta charset="UTF-8">
                        <title>معاينة المرفق: ${name}</title>
                        <style>
                            body { margin: 0; font-family: Tahoma; background: #f4f6f9; display: flex; flex-direction: column; height: 100vh; }
                            header { background: #2e5a36; color: white; padding: 10px 20px; display: flex; justify-content: space-between; align-items: center; }
                            iframe { flex-grow: 1; border: none; width: 100%; height: calc(100vh - 50px); background: white; }
                        </style>
                    </head>
                    <body>
                        <header>
                            <span>📄 ${name}</span>
                            <button onclick="window.close()" style="background: #e74c3c; color: white; border: none; padding: 5px 12px; border-radius: 4px; cursor: pointer; font-weight: bold;">إغلاق</button>
                        </header>
                        <iframe src="${url}" onerror="document.body.innerHTML='<h3 style=\'text-align:center; margin-top:50px; color:#c0392b;\'>عذراً، لم يتم العثور على الملف الفعلي على السيرفر. تأكد من رفع الملف.</h3>'"></iframe>
                    </body>
                    </html>
                `);
            } else {
                alert('لا يوجد ملف مرفق لهذه المعاملة.');
            }
        }

        // دوال التبرعات
        function openAddDonationModal() {
            document.getElementById('donName').value = 'فاعل خير';
            document.getElementById('donPhone').value = '';
            document.getElementById('donAmount').value = '';
            document.getElementById('donNotes').value = '';
            let container = document.getElementById('addDonAttachmentsContainer');
            if(container) {
                container.innerHTML = '';
                addAttachmentRow('addDonAttachmentsContainer');
            }
            document.getElementById('addDonationModal').style.display = 'flex';
        }
        function closeAddDonationModal() {
            document.getElementById('addDonationModal').style.display = 'none';
        }
        function saveNewDonation() {
            let title = document.getElementById('donName').value;
            let phone = document.getElementById('donPhone').value;
            let type = document.getElementById('donType').value;
            let amount = document.getElementById('donAmount').value;
            let transaction_date = document.getElementById('donDate').value;
            let method = document.getElementById('donMethod').value;
            let notes = document.getElementById('donNotes').value;

            if(!title || !amount || !transaction_date) {
                alert('الرجاء إدخال الحقول الأساسية');
                return;
            }

            let formData = new FormData();
            formData.append('type', type);
            formData.append('title', title);
            formData.append('category', '');
            formData.append('amount', amount);
            formData.append('transaction_date', transaction_date);
            formData.append('notes', `الهاتف: ${phone} | الطريقة: ${method} | ملاحظات: ${notes}`);

            let container = document.getElementById('addDonAttachmentsContainer');
            if(container) {
                let fileInput = container.querySelector('input[type="file"]');
                if(fileInput && fileInput.files.length > 0) {
                    formData.append('file', fileInput.files[0]);
                }
            }

            fetch('api_finances.php?action=add', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(res => {
                if(res.status === 'success') {
                    closeAddDonationModal();
                    alert('تم حفظ التبرع مع المرفق بنجاح!');
                    loadAllData();
                } else {
                    alert('حدث خطأ أثناء الحفظ');
                }
            })
            .catch(err => alert('خطأ في الاتصال: ' + err));
        }

        function openEditDonation(id) {
            let item = allFinances.find(f => f.id == id);
            if(!item) return;
            document.getElementById('editDonId').value = item.id;
            document.getElementById('editDonName').value = item.title;
            document.getElementById('editDonAmount').value = item.amount;
            document.getElementById('editDonDate').value = item.t_date;
            document.getElementById('editDonType').value = item.type;
            
            let notesStr = item.notes || '';
            let phoneMatch = notesStr.match(/الهاتف:\s*([^|]+)/);
            let methodMatch = notesStr.match(/الطريقة:\s*([^|]+)/);
            if(phoneMatch) document.getElementById('editDonPhone').value = phoneMatch[1].trim();
            if(methodMatch) document.getElementById('editDonMethod').value = methodMatch[1].trim();
            document.getElementById('editDonNotes').value = notesStr;

            let container = document.getElementById('editDonAttachmentsContainer');
            container.innerHTML = '';
            if(item.file_name) {
                let row = document.createElement('div');
                row.className = 'attachment-row';
                row.style.cssText = 'display:flex; gap:10px; align-items:center; margin-bottom:8px;';
                row.innerHTML = `<span style="flex:1; font-size:13px; color:#0369a1; font-weight:bold;">📄 ${item.file_name}</span> <button type="button" class="btn-action-add" onclick="this.parentElement.remove()" style="background:#e74c3c; color:white; border:none; padding:4px 8px; border-radius:4px; cursor:pointer; font-size:11px;">حذف</button>`;
                container.appendChild(row);
            }
            addAttachmentRow('editDonAttachmentsContainer');
            document.getElementById('editDonationModal').style.display = 'flex';
        }
        function closeEditDonationModal() {
            document.getElementById('editDonationModal').style.display = 'none';
        }
        function updateDonation() {
            let id = document.getElementById('editDonId').value;
            let title = document.getElementById('editDonName').value;
            let phone = document.getElementById('editDonPhone').value;
            let type = document.getElementById('editDonType').value;
            let amount = document.getElementById('editDonAmount').value;
            let transaction_date = document.getElementById('editDonDate').value;
            let method = document.getElementById('editDonMethod').value;
            let notes = document.getElementById('editDonNotes').value;

            let container = document.getElementById('editDonAttachmentsContainer');
            let filesList = [];
            if(container) {
                container.querySelectorAll('.attachment-row').forEach(row => {
                    let span = row.querySelector('span');
                    let fileInput = row.querySelector('input[type="file"]');
                    if(span) filesList.push(span.innerText.replace('📄 ', '').trim());
                    else if(fileInput && fileInput.files.length > 0) filesList.push(fileInput.files[0].name);
                });
            }
            let fileName = filesList.join(', ');

            fetch('api_finances.php?action=update', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id, type, title, category: '', amount, transaction_date, notes: `الهاتف: ${phone} | الطريقة: ${method} | ملاحظات: ${notes}`, file_name: fileName })
            })
            .then(res => res.json())
            .then(res => {
                if(res.status === 'success') {
                    closeEditDonationModal();
                    alert('تم تحديث التبرع بنجاح!');
                    loadAllData();
                } else { alert('حدث خطأ'); }
            });
        }

        // دوال المصروفات
        function openAddExpenseModal() {
            document.getElementById('expDetails').value = '';
            document.getElementById('expAmount').value = '';
            let container = document.getElementById('addExpAttachmentsContainer');
            if(container) {
                container.innerHTML = '';
                addAttachmentRow('addExpAttachmentsContainer');
            }
            document.getElementById('addExpenseModal').style.display = 'flex';
        }
        function closeAddExpenseModal() {
            document.getElementById('addExpenseModal').style.display = 'none';
        }
        function saveNewExpense() {
            let title = document.getElementById('expTitle').value;
            let category = document.getElementById('expCategory').value;
            let details = document.getElementById('expDetails').value;
            let amount = document.getElementById('expAmount').value;
            let transaction_date = document.getElementById('expDate').value;

            if(!amount || !transaction_date) {
                alert('الرجاء إدخال المبلغ والتاريخ');
                return;
            }

            let formData = new FormData();
            formData.append('type', 'expense');
            formData.append('title', title);
            formData.append('category', category);
            formData.append('amount', amount);
            formData.append('transaction_date', transaction_date);
            formData.append('notes', details);

            let container = document.getElementById('addExpAttachmentsContainer');
            if(container) {
                let fileInput = container.querySelector('input[type="file"]');
                if(fileInput && fileInput.files.length > 0) {
                    formData.append('file', fileInput.files[0]);
                }
            }

            fetch('api_finances.php?action=add', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(res => {
                if(res.status === 'success') {
                    closeAddExpenseModal();
                    alert('تم حفظ المصروف مع المرفق بنجاح!');
                    loadAllData();
                } else { alert('حدث خطأ أثناء الحفظ'); }
            })
            .catch(err => alert('خطأ في الاتصال: ' + err));
        }

        function openEditExpense(id) {
            let item = allFinances.find(f => f.id == id);
            if(!item) return;
            document.getElementById('editExpId').value = item.id;
            document.getElementById('editExpTitle').value = item.title;
            document.getElementById('editExpCategory').value = item.category || 'أخرى';
            document.getElementById('editExpDetails').value = item.notes || '';
            document.getElementById('editExpAmount').value = item.amount;
            document.getElementById('editExpDate').value = item.t_date;

            let container = document.getElementById('editExpAttachmentsContainer');
            if(container) {
                container.innerHTML = '';
                if(item.file_name) {
                    let row = document.createElement('div');
                    row.className = 'attachment-row';
                    row.style.cssText = 'display:flex; gap:10px; align-items:center; margin-bottom:8px;';
                    row.innerHTML = `<span style="flex:1; font-size:13px; color:#0369a1; font-weight:bold;">📄 ${item.file_name}</span> <button type="button" class="btn-action-add" onclick="this.parentElement.remove()" style="background:#e74c3c; color:white; border:none; padding:4px 8px; border-radius:4px; cursor:pointer; font-size:11px;">حذف</button>`;
                    container.appendChild(row);
                }
                addAttachmentRow('editExpAttachmentsContainer');
            }
            document.getElementById('editExpenseModal').style.display = 'flex';
        }
        function closeEditExpenseModal() {
            document.getElementById('editExpenseModal').style.display = 'none';
        }
        function updateExpense() {
            let id = document.getElementById('editExpId').value;
            let title = document.getElementById('editExpTitle').value;
            let category = document.getElementById('editExpCategory').value;
            let details = document.getElementById('editExpDetails').value;
            let amount = document.getElementById('editExpAmount').value;
            let transaction_date = document.getElementById('editExpDate').value;

            let container = document.getElementById('editExpAttachmentsContainer');
            let filesList = [];
            if(container) {
                container.querySelectorAll('.attachment-row').forEach(row => {
                    let span = row.querySelector('span');
                    let fileInput = row.querySelector('input[type="file"]');
                    if(span) filesList.push(span.innerText.replace('📄 ', '').trim());
                    else if(fileInput && fileInput.files.length > 0) filesList.push(fileInput.files[0].name);
                });
            }
            let fileName = filesList.join(', ');

            if(!amount || !transaction_date) {
                alert('الرجاء إدخال المبلغ والتاريخ');
                return;
            }

            fetch('api_finances.php?action=update', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id, type: 'expense', title, category, amount, transaction_date, notes: details, file_name: fileName })
            })
            .then(res => res.json())
            .then(res => {
                if(res.status === 'success') {
                    closeEditExpenseModal();
                    alert('تم تحديث المصروف بنجاح!');
                    loadAllData();
                } else { alert('حدث خطأ'); }
            });
        }

        function deleteRecord(id) {
            if(confirm('هل أنت متأكد من حذف هذا السجل نهائياً؟')) {
                fetch('api_finances.php?action=delete', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id })
                })
                .then(res => res.json())
                .then(res => {
                    if(res.status === 'success') {
                        alert('تم الحذف بنجاح');
                        loadAllData();
                    }
                });
            }
        }
    </script>
</body>
</html>
