// ========================================
// KasKu - Main Application Logic
// ========================================

// Global variables
let currentUser = null;
let currentUserRole = null;
let transactions = [];

// ========================================
// INITIALIZATION
// ========================================

document.addEventListener('DOMContentLoaded', function() {
    // Set today's date as default for transaction form
    const today = new Date().toISOString().split('T')[0];
    if (document.getElementById('transDate')) {
        document.getElementById('transDate').value = today;
    }
    
    // Initialize category options
    updateCategoryOptions();
    
    // Add event listener for transaction type change
    document.getElementById('transType').addEventListener('change', updateCategoryOptions);
});

// ========================================
// AUTHENTICATION FUNCTIONS
// ========================================

function login() {
    const username = document.getElementById('loginUsername').value;
    const password = document.getElementById('loginPassword').value;

    if (!username || !password) {
        showNotification('Mohon isi username dan password', 'error');
        return;
    }

    // Demo login (untuk production, gunakan Firebase Authentication)
    if (username === 'admin' && password === 'admin123') {
        currentUser = 'admin';
        currentUserRole = 'admin';
        showNotification('Login berhasil sebagai Admin!', 'success');
        showDashboard('admin');
    } else if (username === 'user' && password === 'user123') {
        currentUser = 'user';
        currentUserRole = 'user';
        showNotification('Login berhasil!', 'success');
        showDashboard('user');
    } else {
        showNotification('Username atau password salah', 'error');
    }
}

function register() {
    const name = document.getElementById('regName').value;
    const username = document.getElementById('regUsername').value;
    const email = document.getElementById('regEmail').value;
    const phone = document.getElementById('regPhone').value;
    const password = document.getElementById('regPassword').value;
    const confirmPassword = document.getElementById('regConfirmPassword').value;

    // Validation
    if (!name || !username || !email || !phone || !password || !confirmPassword) {
        showNotification('Mohon isi semua field', 'error');
        return;
    }

    if (password !== confirmPassword) {
        showNotification('Password tidak cocok', 'error');
        return;
    }

    if (password.length < 6) {
        showNotification('Password minimal 6 karakter', 'error');
        return;
    }

    // Email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        showNotification('Format email tidak valid', 'error');
        return;
    }

    // Save to Firebase (implementasi bisa ditambahkan)
    // const userRef = window.dbPush(window.dbRef(window.db, 'users'));
    // window.dbSet(userRef, { name, username, email, phone, role: 'user' });

    showNotification('Registrasi berhasil! Silakan login', 'success');
    setTimeout(() => showLogin(), 1500);
}

function logout() {
    currentUser = null;
    currentUserRole = null;
    document.getElementById('userDashboard').classList.remove('active');
    document.getElementById('adminDashboard').classList.remove('active');
    document.getElementById('loginPage').style.display = 'flex';
    
    // Clear input fields
    document.getElementById('loginUsername').value = '';
    document.getElementById('loginPassword').value = '';
    
    showNotification('Logout berhasil', 'success');
}

// ========================================
// PAGE NAVIGATION
// ========================================

function showLogin() {
    document.getElementById('loginPage').style.display = 'flex';
    document.getElementById('registerPage').style.display = 'none';
}

function showRegister() {
    document.getElementById('loginPage').style.display = 'none';
    document.getElementById('registerPage').style.display = 'flex';
}

function showDashboard(role) {
    document.getElementById('loginPage').style.display = 'none';
    document.getElementById('registerPage').style.display = 'none';
    
    if (role === 'admin') {
        document.getElementById('adminDashboard').classList.add('active');
        document.getElementById('userDashboard').classList.remove('active');
    } else {
        document.getElementById('userDashboard').classList.add('active');
        document.getElementById('adminDashboard').classList.remove('active');
    }

    loadTransactions();
}

// ========================================
// TAB SWITCHING
// ========================================

function switchUserTab(tab) {
    // Remove active class from all tabs
    const tabs = document.querySelectorAll('#userDashboard .tab');
    tabs.forEach(t => t.classList.remove('active'));
    event.target.classList.add('active');

    // Hide all sections
    document.getElementById('userTransaksi').classList.remove('active');
    document.getElementById('userPemasukan').classList.remove('active');
    document.getElementById('userPengeluaran').classList.remove('active');
    document.getElementById('userLaporan').classList.remove('active');

    // Show selected section
    if (tab === 'transaksi') document.getElementById('userTransaksi').classList.add('active');
    if (tab === 'pemasukan') document.getElementById('userPemasukan').classList.add('active');
    if (tab === 'pengeluaran') document.getElementById('userPengeluaran').classList.add('active');
    if (tab === 'laporan') document.getElementById('userLaporan').classList.add('active');
}

function switchAdminTab(tab) {
    // Remove active class from all tabs
    const tabs = document.querySelectorAll('#adminDashboard .tab');
    tabs.forEach(t => t.classList.remove('active'));
    event.target.classList.add('active');

    // Hide all sections
    document.getElementById('adminSemua').classList.remove('active');
    document.getElementById('adminPemasukan').classList.remove('active');
    document.getElementById('adminPengeluaran').classList.remove('active');
    document.getElementById('adminAnggota').classList.remove('active');
    document.getElementById('adminLaporan').classList.remove('active');

    // Show selected section
    if (tab === 'semua') document.getElementById('adminSemua').classList.add('active');
    if (tab === 'pemasukan') document.getElementById('adminPemasukan').classList.add('active');
    if (tab === 'pengeluaran') document.getElementById('adminPengeluaran').classList.add('active');
    if (tab === 'anggota') document.getElementById('adminAnggota').classList.add('active');
    if (tab === 'laporan') document.getElementById('adminLaporan').classList.add('active');
}

// ========================================
// MODAL FUNCTIONS
// ========================================

function showAddTransaction() {
    document.getElementById('addTransactionModal').classList.add('active');
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('transDate').value = today;
    updateCategoryOptions();
}

function closeModal() {
    document.getElementById('addTransactionModal').classList.remove('active');
    
    // Reset form
    document.getElementById('transType').value = 'Pemasukan';
    document.getElementById('transAmount').value = '0';
    document.getElementById('transDesc').value = '';
    document.getElementById('transCategory').value = '';
}

// ========================================
// TRANSACTION FUNCTIONS
// ========================================

function loadTransactions() {
    if (!window.db) {
        console.error('Database not initialized');
        return;
    }

    const transRef = window.dbRef(window.db, 'transactions');
    window.dbOnValue(transRef, (snapshot) => {
        transactions = [];
        if (snapshot.exists()) {
            snapshot.forEach((childSnapshot) => {
                transactions.push({
                    firebaseKey: childSnapshot.key,
                    ...childSnapshot.val()
                });
            });
        }
        updateDashboard();
    });
}

function addTransaction() {
    const type = document.getElementById('transType').value;
    const amount = parseInt(document.getElementById('transAmount').value);
    const description = document.getElementById('transDesc').value;
    const category = document.getElementById('transCategory').value;
    const date = document.getElementById('transDate').value;

    // Validation
    if (!amount || amount <= 0) {
        showNotification('Masukkan jumlah yang valid', 'error');
        return;
    }

    if (!description.trim()) {
        showNotification('Masukkan deskripsi', 'error');
        return;
    }

    if (!category) {
        showNotification('Pilih kategori', 'error');
        return;
    }

    if (!date) {
        showNotification('Pilih tanggal', 'error');
        return;
    }

    // Create transaction object
    const transaction = {
        date: date,
        type: type === 'Pemasukan' ? 'Masuk' : 'Keluar',
        description: description,
        category: category,
        amount: amount,
        createdAt: new Date().toISOString(),
        createdBy: currentUser
    };

    // Save to Firebase
    const newRef = window.dbPush(window.dbRef(window.db, 'transactions'));
    window.dbSet(newRef, transaction)
        .then(() => {
            showNotification('Transaksi berhasil ditambahkan', 'success');
            closeModal();
            loadTransactions();
        })
        .catch((error) => {
            showNotification('Gagal menambahkan transaksi: ' + error.message, 'error');
        });
}

function deleteTransaction(key) {
    if (!confirm('Yakin ingin menghapus transaksi ini?')) return;

    const transRef = window.dbRef(window.db, 'transactions/' + key);
    window.dbRemove(transRef)
        .then(() => {
            showNotification('Transaksi berhasil dihapus', 'success');
            loadTransactions();
        })
        .catch((error) => {
            showNotification('Gagal menghapus transaksi: ' + error.message, 'error');
        });
}

function editTransaction(key) {
    // TODO: Implementasi edit transaction
    showNotification('Fitur edit akan segera tersedia', 'info');
}

// ========================================
// DASHBOARD UPDATE
// ========================================

function updateDashboard() {
    let totalIncome = 0;
    let totalExpense = 0;
    let incomeCount = 0;
    let expenseCount = 0;

    // Calculate totals
    transactions.forEach(trans => {
        if (trans.type === 'Masuk') {
            totalIncome += trans.amount;
            incomeCount++;
        } else {
            totalExpense += trans.amount;
            expenseCount++;
        }
    });

    const balance = totalIncome - totalExpense;

    // Update user dashboard
    document.getElementById('userTotalIncome').textContent = formatCurrency(totalIncome);
    document.getElementById('userTotalExpense').textContent = formatCurrency(totalExpense);
    document.getElementById('userBalance').textContent = formatCurrency(balance);

    // Update admin dashboard
    document.getElementById('adminTotalIncome').textContent = formatCurrency(totalIncome);
    document.getElementById('adminTotalExpense').textContent = formatCurrency(totalExpense);
    document.getElementById('adminBalance').textContent = formatCurrency(balance);

    // Update admin subtitles
    const adminIncomeCard = document.querySelector('#adminDashboard .stat-card.income .stat-subtitle');
    const adminExpenseCard = document.querySelector('#adminDashboard .stat-card.expense .stat-subtitle');
    const adminBalanceCard = document.querySelector('#adminDashboard .stat-card.balance .stat-subtitle');
    
    if (adminIncomeCard) adminIncomeCard.textContent = `${incomeCount} transaksi`;
    if (adminExpenseCard) adminExpenseCard.textContent = `${expenseCount} transaksi`;
    if (adminBalanceCard) adminBalanceCard.textContent = `Total ${transactions.length} transaksi`;

    // Update all tables
    updateTable('userAllTransactionsTable', transactions, false);
    updateTable('userIncomeTable', transactions.filter(t => t.type === 'Masuk'), false);
    updateTable('userExpenseTable', transactions.filter(t => t.type === 'Keluar'), false);

    updateTable('adminAllTransactionsTable', transactions, true);
    updateTable('adminIncomeTable', transactions.filter(t => t.type === 'Masuk'), true);
    updateTable('adminExpenseTable', transactions.filter(t => t.type === 'Keluar'), true);

    // Update reports
    document.getElementById('reportIncome').textContent = formatCurrency(totalIncome);
    document.getElementById('reportExpense').textContent = formatCurrency(totalExpense);
    document.getElementById('reportBalance').textContent = formatCurrency(balance);
}

function updateTable(tableId, data, showActions) {
    const table = document.getElementById(tableId);
    if (!table) return;

    const tbody = table.querySelector('tbody');
    tbody.innerHTML = '';

    if (data.length === 0) {
        tbody.innerHTML = `<tr><td colspan="${showActions ? '6' : '5'}" style="text-align: center; padding: 40px; color: #999;">Belum ada transaksi</td></tr>`;
        return;
    }

    // Sort by date (newest first)
    data.sort((a, b) => new Date(b.date) - new Date(a.date)).forEach(trans => {
        const row = document.createElement('tr');
        
        row.innerHTML = `
            <td>${formatDate(trans.date)}</td>
            <td><span class="badge ${trans.type === 'Masuk' ? 'income' : 'expense'}">${trans.type === 'Masuk' ? '📈 Masuk' : '📉 Keluar'}</span></td>
            <td>${trans.description}</td>
            <td>${trans.category}</td>
            <td class="amount ${trans.type === 'Masuk' ? 'positive' : 'negative'}">${trans.type === 'Masuk' ? '+' : '-'} ${formatCurrency(trans.amount)}</td>
            ${showActions ? `
                <td>
                    <div class="action-buttons">
                        <button class="btn-edit" onclick="editTransaction('${trans.firebaseKey}')">✏️</button>
                        <button class="btn-delete" onclick="deleteTransaction('${trans.firebaseKey}')">🗑️</button>
                    </div>
                </td>
            ` : ''}
        `;
        tbody.appendChild(row);
    });
}

// ========================================
// UTILITY FUNCTIONS
// ========================================

function formatCurrency(num) {
    return 'Rp ' + num.toLocaleString('id-ID');
}

function formatDate(dateStr) {
    const date = new Date(dateStr);
    const day = date.getDate().toString().padStart(2, '0');
    const month = date.toLocaleString('id-ID', { month: 'short' });
    const year = date.getFullYear();
    return `${day} ${month} ${year}`;
}

function updateCategoryOptions() {
    const type = document.getElementById('transType').value;
    const categorySelect = document.getElementById('transCategory');
    
    const incomeCategories = ['Salary', 'Freelance', 'Business', 'Investment', 'Gift', 'Other'];
    const expenseCategories = ['Shopping', 'Transportation', 'Food', 'Bills', 'Entertainment', 'Health', 'Education', 'Other'];
    
    const categories = type === 'Pemasukan' ? incomeCategories : expenseCategories;
    
    categorySelect.innerHTML = '<option value="">Pilih kategori</option>';
    categories.forEach(cat => {
        const option = document.createElement('option');
        option.value = cat;
        option.textContent = cat;
        categorySelect.appendChild(option);
    });
}

function showNotification(message, type = 'success') {
    const notification = document.getElementById('notification');
    notification.textContent = message;
    notification.className = 'notification show ' + type;
    
    setTimeout(() => {
        notification.classList.remove('show');
    }, 3000);
}

function showHelp() {
    alert(`KasKu - Sistem Manajemen Keuangan Online

Fitur:
• Kelola pemasukan dan pengeluaran
• Laporan keuangan lengkap
• Dashboard admin dan user terpisah
• Real-time data sync dengan Firebase

Login Demo:
Admin: admin / admin123
User: user / user123

Untuk support, hubungi: support@kasku.com`);
}

// ========================================
// EXPORT FUNCTIONS TO GLOBAL SCOPE
// ========================================

window.login = login;
window.register = register;
window.showLogin = showLogin;
window.showRegister = showRegister;
window.logout = logout;
window.switchUserTab = switchUserTab;
window.switchAdminTab = switchAdminTab;
window.showAddTransaction = showAddTransaction;
window.closeModal = closeModal;
window.addTransaction = addTransaction;
window.deleteTransaction = deleteTransaction;
window.editTransaction = editTransaction;
window.showNotification = showNotification;
window.showHelp = showHelp;
window.loadTransactions = loadTransactions;