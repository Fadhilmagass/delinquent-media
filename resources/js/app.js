import './bootstrap';
import './calendar'; // Impor logika kalender
import 'tippy.js/dist/tippy.css'; // Impor CSS untuk Tippy.js

import "trix";

// Import CSS TomSelect
import "tom-select/dist/css/tom-select.bootstrap5.css";

// Import TomSelect dan jadikan global agar bisa diakses di Blade
import TomSelect from "tom-select";
window.TomSelect = TomSelect;
