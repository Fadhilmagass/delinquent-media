import './bootstrap';
import './calendar'; // Impor logika kalender
import 'tippy.js/dist/tippy.css'; // Impor CSS untuk Tippy.js

import "trix";

// Import CSS TomSelect
import "tom-select/dist/css/tom-select.bootstrap5.css";

// Import TomSelect dan jadikan global agar bisa diakses di Blade
import TomSelect from "tom-select";
window.TomSelect = TomSelect;

// Dark Mode Toggle Logic
const setupDarkModeToggle = () => {
    const darkModeToggle = document.getElementById('darkModeToggle');
    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', () => {
            const isDarkMode = document.documentElement.classList.toggle('dark');
            localStorage.setItem('darkMode', isDarkMode);

            // Optional: Dispatch event for Livewire/Alpine components
            window.dispatchEvent(new CustomEvent('dark-mode-toggled', { detail: { isDarkMode } }));
        });
    }
};

// Jalankan saat halaman pertama kali dimuat (full load)
document.addEventListener('DOMContentLoaded', setupDarkModeToggle);

// Jalankan kembali setiap kali Livewire selesai navigasi
document.addEventListener('livewire:navigated', setupDarkModeToggle);

