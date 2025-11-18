// ========================================
// KasKu - Firebase Configuration
// ========================================

// Import Firebase modules
import { initializeApp } from 'https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js';
import { getDatabase, ref, set, get, push, remove, onValue, update } from 'https://www.gstatic.com/firebasejs/10.7.1/firebase-database.js';

// Firebase configuration
// IMPORTANT: Ganti dengan konfigurasi Firebase project Anda sendiri
// Dapatkan dari: Firebase Console > Project Settings > General > Your apps
const firebaseConfig = {
    apiKey: "AIzaSyBxVXQYXKHQMxD3YxF7YxF7YxF7YxF7YxF",
    authDomain: "kasku-demo.firebaseapp.com",
    databaseURL: "https://kasku-demo-default-rtdb.firebaseio.com",
    projectId: "kasku-demo",
    storageBucket: "kasku-demo.appspot.com",
    messagingSenderId: "123456789012",
    appId: "1:123456789012:web:abcdef123456"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const database = getDatabase(app);

// Export database functions untuk digunakan di app.js
window.db = database;
window.dbRef = ref;
window.dbSet = set;
window.dbGet = get;
window.dbPush = push;
window.dbRemove = remove;
window.dbOnValue = onValue;
window.dbUpdate = update;

// Initialize default data jika database kosong
initializeDefaultData();

function initializeDefaultData() {
    const defaultTransactions = [
        {
            id: '1',
            date: '2025-10-12',
            type: 'Masuk',
            description: 'Freelance Project',
            category: 'Freelance',
            amount: 1000000,
            createdAt: new Date('2025-10-12').toISOString()
        },
        {
            id: '2',
            date: '2025-10-10',
            type: 'Keluar',
            description: 'Bensin',
            category: 'Transportation',
            amount: 200000,
            createdAt: new Date('2025-10-10').toISOString()
        },
        {
            id: '3',
            date: '2025-10-05',
            type: 'Keluar',
            description: 'Belanja Bulanan',
            category: 'Shopping',
            amount: 500000,
            createdAt: new Date('2025-10-05').toISOString()
        },
        {
            id: '4',
            date: '2025-10-01',
            type: 'Masuk',
            description: 'Gaji Bulanan',
            category: 'Salary',
            amount: 5000000,
            createdAt: new Date('2025-10-01').toISOString()
        }
    ];

    // Cek apakah database sudah ada data
    const transRef = ref(database, 'transactions');
    get(transRef).then((snapshot) => {
        if (!snapshot.exists()) {
            console.log('Initializing default data...');
            defaultTransactions.forEach(trans => {
                const newRef = push(ref(database, 'transactions'));
                set(newRef, trans);
            });
        }
    }).catch((error) => {
        console.error('Error checking database:', error);
    });
}

// Load transactions when page loads
window.addEventListener('load', () => {
    if (window.loadTransactions) {
        window.loadTransactions();
    }
});

console.log('Firebase initialized successfully!');