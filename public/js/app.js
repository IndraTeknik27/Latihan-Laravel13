/* ============================================
   DIVISI MANAGEMENT - SINGLE SCRIPTS
   ============================================ */

document.addEventListener('DOMContentLoaded', function() {

    /* ------------------------------------------
       PASSWORD TOGGLE (Login & Register)
       ------------------------------------------ */
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');

    if (passwordInput && toggleIcon) {
        const toggleBtn = toggleIcon.closest('button');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleIcon.classList.remove('bi-eye');
                    toggleIcon.classList.add('bi-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    toggleIcon.classList.remove('bi-eye-slash');
                    toggleIcon.classList.add('bi-eye');
                }
            });
        }
    }

    /* ------------------------------------------
       TABLE SEARCH FILTER (Divisi Index)
       ------------------------------------------ */
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('tableBody');

    if (searchInput && tableBody) {
        const rows = tableBody.querySelectorAll('tr');
        searchInput.addEventListener('input', function(e) {
            const keyword = e.target.value.toLowerCase();
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(keyword) ? '' : 'none';
            });
        });
    }

    /* ------------------------------------------
       AUTO-HIDE ALERTS
       ------------------------------------------ */
    const alerts = document.querySelectorAll('.alert-error');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });

});