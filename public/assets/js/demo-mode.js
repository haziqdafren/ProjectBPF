/**
 * SURPA - Demo Mode Restrictions
 * This script prevents data modifications in demo mode
 * Shows professional SweetAlert popups for save and delete actions
 */

// Check if current user is in demo mode
const isDemoMode = document.querySelector('.demo-banner') !== null;

if (isDemoMode) {
    console.log('%c🔒 DEMO MODE ACTIVE', 'color: #667eea; font-size: 16px; font-weight: bold');
    console.log('%cRead-only access - Modifications prevented on save/delete', 'color: #764ba2; font-size: 12px');

    // Wait for DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        initializeDemoMode();
    });
}

function initializeDemoMode() {
    // Handle DELETE operations with professional SweetAlert
    handleDeleteOperations();

    // Handle SAVE operations (create/update forms)
    handleSaveOperations();

    // Show welcome message on first load
    showWelcomeMessage();
}

/**
 * Handle all delete operations
 * Replace default confirm() with professional SweetAlert
 */
function handleDeleteOperations() {
    // Find all delete forms
    const deleteForms = document.querySelectorAll('form[method="POST"]');

    deleteForms.forEach(form => {
        const methodInput = form.querySelector('input[name="_method"]');
        const isDeleteForm = methodInput && methodInput.value === 'DELETE';

        if (isDeleteForm) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                e.stopPropagation();
                showDeleteAlert();
                return false;
            });
        }
    });

    // Also handle delete button clicks directly
    const deleteButtons = document.querySelectorAll('button[type="submit"].btn-danger');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            showDeleteAlert();
            return false;
        });
    });
}

/**
 * Handle all save operations (create/update)
 * Allow users to fill forms, but prevent submission
 */
function handleSaveOperations() {
    // Find all forms except login/logout/search
    const allForms = document.querySelectorAll('form');

    allForms.forEach(form => {
        // Skip these forms
        if (form.action.includes('/session') ||
            form.action.includes('/logout') ||
            form.action.includes('/login') ||
            form.action.includes('/search') ||
            form.method.toUpperCase() === 'GET') {
            return;
        }

        // Check if it's a create or update form
        const methodInput = form.querySelector('input[name="_method"]');
        const isUpdateForm = methodInput && (methodInput.value === 'PUT' || methodInput.value === 'PATCH');
        const isCreateForm = !methodInput && form.method.toUpperCase() === 'POST';
        const isDeleteForm = methodInput && methodInput.value === 'DELETE';

        // Handle create/update forms (allow filling, prevent submit)
        if (isCreateForm || isUpdateForm) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                e.stopPropagation();
                showSaveAlert(isCreateForm ? 'create' : 'update');
                return false;
            });

            // Also prevent submit button clicks
            const submitButtons = form.querySelectorAll('button[type="submit"], input[type="submit"]');
            submitButtons.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    showSaveAlert(isCreateForm ? 'create' : 'update');
                    return false;
                });
            });
        }
    });
}

/**
 * Show professional delete confirmation popup
 */
function showDeleteAlert() {
    Swal.fire({
        title: 'Yakin ingin menghapus data?',
        html: `
            <div style="text-align: left;">
                <p style="font-size: 1rem; margin-bottom: 1rem; color: #64748b;">
                    Anda sedang menggunakan <strong>akun demo</strong> dengan akses read-only.
                </p>
                <div style="background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); padding: 1rem; border-radius: 0.75rem; border-left: 4px solid #ef4444;">
                    <p style="font-size: 0.95rem; color: #991b1b; margin: 0; font-weight: 500;">
                        <i class="fas fa-ban me-2"></i>
                        Penghapusan data tidak diizinkan dalam mode demo
                    </p>
                </div>
                <div style="background: #f8fafc; padding: 1rem; border-radius: 0.5rem; margin-top: 1rem;">
                    <p style="font-size: 0.875rem; color: #64748b; margin: 0;">
                        <strong>Demo Account</strong><br>
                        Email: <code style="background: white; padding: 0.2rem 0.4rem; border-radius: 0.25rem; color: #4A5568;">demo@surpa.com</code><br>
                        Password: <code style="background: white; padding: 0.2rem 0.4rem; border-radius: 0.25rem; color: #4A5568;">demo123</code>
                    </p>
                </div>
            </div>
        `,
        icon: 'error',
        confirmButtonText: 'Mengerti',
        confirmButtonColor: '#4A5568',
        showClass: {
            popup: 'animate__animated animate__fadeInDown animate__faster'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp animate__faster'
        },
        customClass: {
            popup: 'swal-demo-popup',
            title: 'swal-demo-title',
            htmlContainer: 'swal-demo-content'
        },
        width: '32rem'
    });
}

/**
 * Show professional save prevention popup
 */
function showSaveAlert(action = 'save') {
    const messages = {
        'create': {
            title: 'Tidak dapat membuat data baru',
            description: 'Anda sedang menggunakan akun demo dengan akses read-only.',
            message: 'Pembuatan data baru tidak diizinkan dalam mode demo'
        },
        'update': {
            title: 'Tidak dapat menyimpan perubahan',
            description: 'Anda sedang menggunakan akun demo dengan akses read-only.',
            message: 'Penyimpanan perubahan tidak diizinkan dalam mode demo'
        },
        'save': {
            title: 'Tidak dapat menyimpan data',
            description: 'Anda sedang menggunakan akun demo dengan akses read-only.',
            message: 'Penyimpanan data tidak diizinkan dalam mode demo'
        }
    };

    const msg = messages[action] || messages['save'];

    Swal.fire({
        title: msg.title,
        html: `
            <div style="text-align: left;">
                <p style="font-size: 1rem; margin-bottom: 1rem; color: #64748b;">
                    ${msg.description}
                </p>
                <div style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); padding: 1rem; border-radius: 0.75rem; border-left: 4px solid #f59e0b;">
                    <p style="font-size: 0.95rem; color: #92400e; margin: 0; font-weight: 500;">
                        <i class="fas fa-lock me-2"></i>
                        ${msg.message}
                    </p>
                </div>
                <div style="margin-top: 1rem; background: #f0f9ff; padding: 1rem; border-radius: 0.5rem; border-left: 3px solid #3b82f6;">
                    <p style="font-size: 0.875rem; color: #1e40af; margin: 0;">
                        <strong><i class="fas fa-info-circle me-1"></i> Yang dapat Anda lakukan:</strong><br>
                        ✅ Melihat semua data<br>
                        ✅ Navigasi semua halaman<br>
                        ✅ Mengisi form (tanpa menyimpan)<br>
                        ❌ Tidak dapat membuat/edit/hapus data
                    </p>
                </div>
                <div style="background: #f8fafc; padding: 1rem; border-radius: 0.5rem; margin-top: 1rem;">
                    <p style="font-size: 0.875rem; color: #64748b; margin: 0;">
                        <strong>Demo Account</strong><br>
                        Email: <code style="background: white; padding: 0.2rem 0.4rem; border-radius: 0.25rem; color: #4A5568;">demo@surpa.com</code><br>
                        Password: <code style="background: white; padding: 0.2rem 0.4rem; border-radius: 0.25rem; color: #4A5568;">demo123</code>
                    </p>
                </div>
            </div>
        `,
        icon: 'warning',
        confirmButtonText: 'Mengerti',
        confirmButtonColor: '#4A5568',
        showClass: {
            popup: 'animate__animated animate__fadeInDown animate__faster'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp animate__faster'
        },
        customClass: {
            popup: 'swal-demo-popup',
            title: 'swal-demo-title',
            htmlContainer: 'swal-demo-content'
        },
        width: '34rem'
    });
}

/**
 * Show welcome message on first page load
 */
function showWelcomeMessage() {
    // Only show once per session
    if (sessionStorage.getItem('demo_welcome_shown')) {
        return;
    }

    setTimeout(() => {
        Swal.fire({
            title: 'Selamat Datang di SURPA Demo!',
            html: `
                <div style="text-align: left;">
                    <p style="font-size: 1rem; margin-bottom: 1rem; color: #475569;">
                        Anda login menggunakan <strong>akun demo</strong> dengan <strong>akses read-only</strong>.
                    </p>
                    <div style="background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%); padding: 1.25rem; border-radius: 0.75rem; margin-bottom: 1rem;">
                        <p style="font-size: 0.95rem; color: #3730a3; margin: 0; line-height: 1.8;">
                            <strong style="font-size: 1rem;">Yang dapat Anda lakukan:</strong><br>
                            <i class="fas fa-check-circle" style="color: #10b981;"></i> Melihat semua data dan halaman<br>
                            <i class="fas fa-check-circle" style="color: #10b981;"></i> Menggunakan fitur pencarian<br>
                            <i class="fas fa-check-circle" style="color: #10b981;"></i> Navigasi seluruh sistem<br>
                            <i class="fas fa-check-circle" style="color: #10b981;"></i> Mengisi form (tanpa menyimpan)<br><br>
                            <strong style="font-size: 1rem;">Yang tidak dapat dilakukan:</strong><br>
                            <i class="fas fa-times-circle" style="color: #ef4444;"></i> Membuat data baru<br>
                            <i class="fas fa-times-circle" style="color: #ef4444;"></i> Mengedit data yang ada<br>
                            <i class="fas fa-times-circle" style="color: #ef4444;"></i> Menghapus data
                        </p>
                    </div>
                    <div style="background: #f8fafc; padding: 1rem; border-radius: 0.5rem;">
                        <p style="font-size: 0.875rem; color: #64748b; margin: 0;">
                            <i class="fas fa-user-circle me-1"></i> <strong>Credentials</strong><br>
                            Email: <code style="background: white; padding: 0.2rem 0.4rem; border-radius: 0.25rem; color: #4A5568;">demo@surpa.com</code><br>
                            Password: <code style="background: white; padding: 0.2rem 0.4rem; border-radius: 0.25rem; color: #4A5568;">demo123</code>
                        </p>
                    </div>
                </div>
            `,
            icon: 'info',
            confirmButtonText: 'Mulai Menjelajah',
            confirmButtonColor: '#4A5568',
            timer: 10000,
            timerProgressBar: true,
            showClass: {
                popup: 'animate__animated animate__zoomIn'
            },
            customClass: {
                popup: 'swal-welcome-popup',
                title: 'swal-welcome-title'
            },
            width: '36rem'
        });

        sessionStorage.setItem('demo_welcome_shown', 'true');
    }, 1500);
}

// Add custom SweetAlert styles
if (isDemoMode && !document.querySelector('#swal-demo-styles')) {
    const style = document.createElement('style');
    style.id = 'swal-demo-styles';
    style.textContent = `
        .swal-demo-popup {
            font-family: 'Open Sans', sans-serif;
        }

        .swal-demo-title {
            font-size: 1.5rem !important;
            font-weight: 600 !important;
            color: #1e293b !important;
        }

        .swal-demo-content {
            font-size: 1rem !important;
        }

        .swal-welcome-popup {
            border-top: 4px solid #667eea !important;
        }

        .swal-welcome-title {
            font-size: 1.75rem !important;
            font-weight: 700 !important;
            color: #667eea !important;
        }

        .swal2-icon.swal2-info {
            border-color: #667eea !important;
            color: #667eea !important;
        }

        .swal2-icon.swal2-warning {
            border-color: #f59e0b !important;
            color: #f59e0b !important;
        }

        .swal2-icon.swal2-error {
            border-color: #ef4444 !important;
            color: #ef4444 !important;
        }
    `;
    document.head.appendChild(style);
}
