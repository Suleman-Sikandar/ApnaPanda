<!-- Drawer Modal -->
<div id="EditdrawerModal" class="drawer-modal">
    <div id="EditdrawerBox" class="drawer-box">

        <!-- Header -->
        <div class="drawer-header">
            <h3 id="drawerTitle">Edit Role</h3>
            <button class="drawer-close">&times;</button>
        </div>

        <!-- Form -->
        <form id="rolesForm">
            @csrf
            <input type="hidden" id="role_id" name="id" value="{{ $role->id }}">

            <!-- Role Name -->
            <div class="form-group">
                <label class="form-label">Role Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="roleName" class="form-control" placeholder="Enter role name"
                    value="{{ $role->name }}" required>
                <small class="form-error text-danger" id="error-name"></small>
            </div>

            <!-- Permissions -->
            <div class="form-group mt-6">
                <label class="form-label mb-3">Permissions</label>
                <div id="permissionsWrapper" class="permissions-container">

                    @foreach ($categories as $category)
                        <div class="permission-category">
                            <div class="category-header">
                                <span class="category-title">{{ $category->name }}</span>
                            </div>
                            <div class="permission-items">
                                @foreach ($category->modules as $module)
                                    <label class="permission-item">
                                        <input type="checkbox" name="modules[]" value="{{ $module->id }}"
                                            {{ $role->modules->contains($module->id) ? 'checked' : '' }}>
                                        <span>{{ $module->module_name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

            <!-- Footer -->
            <div class="drawer-footer mt-6">
                <button type="button" class="btn-cancel drawer-close">Cancel</button>
                <button type="submit" id="submitRoleBtn" class="role-btn-primary-gradient">Save Role</button>
            </div>
        </form>
    </div>
</div>

<style>
/* ============================
   DRAWER MODAL
============================ */
.drawer-modal {
    position: fixed;
    top: 0;
    right: -100%;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.55);
    z-index: 9999;
    transition: right 0.3s ease;
}

.drawer-modal.active {
    right: 0;
}

.drawer-box {
    position: absolute;
    right: 0;
    top: 0;
    width: 600px;
    max-width: 90%;
    height: 100%;
    background: #fff;
    box-shadow: -4px 0 20px rgba(0, 0, 0, 0.15);
    overflow-y: auto;
    transform: translateX(100%);
    transition: transform 0.3s ease;
    border-radius: 0 8px 8px 0;
}

.drawer-modal.active .drawer-box {
    transform: translateX(0);
}

/* ============================
   HEADER
============================ */
.drawer-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 28px;
    border-bottom: 1px solid #e5e7eb;
    position: sticky;
    top: 0;
    background: #fff;
    z-index: 10;
}

.drawer-header h3 {
    margin: 0;
    font-size: 22px;
    font-weight: 700;
    color: #111827;
}

.drawer-close {
    background: none;
    border: none;
    font-size: 28px;
    cursor: pointer;
    color: #6b7280;
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
    transition: all 0.2s;
}

.drawer-close:hover {
    background: #f3f4f6;
    color: #111827;
}

/* ============================
   FORM
============================ */
#rolesForm {
    padding: 24px 28px;
}

.form-label {
    display: block;
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
    font-size: 15px;
}

.form-control {
    width: 100%;
    padding: 12px 14px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 14px;
    transition: all 0.2s;
}

.form-control:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* ============================
   PERMISSIONS
============================ */
.permissions-container {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.permission-category {
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    overflow: hidden;
    background: #fafafa;
    transition: box-shadow 0.2s;
}

.permission-category:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

.category-header {
    display: flex;
    align-items: center;
    padding: 14px 20px;
    background: #f9fafb;
    border-bottom: 1px solid #e5e7eb;
    cursor: pointer;
    transition: background 0.2s;
}

.category-header:hover {
    background: #f3f4f6;
}

.category-title {
    font-weight: 600;
    color: #111827;
    font-size: 15px;
    flex: 1;
}

.permission-items {
    padding: 12px 20px 12px 48px;
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 12px;
    background: #fff;
}

.permission-item {
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    padding: 8px 10px;
    border-radius: 6px;
    transition: background 0.2s, transform 0.1s;
}

.permission-item:hover {
    background: #f9fafb;
    transform: translateY(-1px);
}

.permission-item input[type="checkbox"] {
    width: 18px;
    height: 18px;
    cursor: pointer;
    accent-color: #3b82f6;
}

.permission-item span {
    font-size: 14px;
    color: #4b5563;
    user-select: none;
}

/* ============================
   FOOTER
============================ */
.drawer-footer {
    display: flex;
    justify-content: flex-end;
    gap: 14px;
    padding: 20px 0 28px;
    border-top: 1px solid #e5e7eb;
}

.btn-cancel {
    padding: 10px 24px;
    border: 1px solid #d1d5db;
    background: #fff;
    color: #374151;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-cancel:hover {
    background: #f3f4f6;
    border-color: #9ca3af;
}

.role-btn-primary-gradient {
    padding: 10px 28px;
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
}

.role-btn-primary-gradient:hover {
    background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    box-shadow: 0 6px 16px rgba(59, 130, 246, 0.3);
}

.form-error {
    display: block;
    margin-top: 4px;
    font-size: 13px;
}

.text-danger {
    color: #ef4444;
}

/* ============================
   RESPONSIVE
============================ */
@media (max-width: 640px) {
    .drawer-box {
        width: 100%;
        max-width: 100%;
        border-radius: 0;
    }

    .permission-items {
        grid-template-columns: 1fr;
    }
}
</style>
