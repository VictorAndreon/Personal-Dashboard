import './bootstrap';

import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import Alpine from 'alpinejs';
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.css";
import { Portuguese } from "flatpickr/dist/l10n/pt.js";

window.initDatePicker = function() {
    flatpickr(".datepicker", {
        locale: Portuguese,
        altInput: true,
        altFormat: "d/m/Y", // O que o usuário vê
        dateFormat: "Y-m-d",
        allowInput: true,
    });
}

document.addEventListener('DOMContentLoaded', window.initDatePicker);
window.Swal = Swal;
window.Alpine = Alpine;

Alpine.start();

window.confirmaExclusao = function(event) {
    event.preventDefault();
    const form = event.target;

    Swal.fire({
        title: 'Confirmar Exclusão',
        text: 'Esta ação não pode ser desfeita e afetará seu saldo.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#f34316', 
        cancelButtonColor: '#6b7280', 
        confirmButtonText: 'Sim, excluir',
        cancelButtonText: 'Manter registro',
        background: '#ffffff',
        customClass: {
            popup: 'rounded-xl shadow-2xl border border-gray-100',
            title: 'text-gray-800 font-bold',
            confirmButton: 'rounded-lg px-6 py-2 uppercase tracking-wider',
            cancelButton: 'rounded-lg px-6 py-2 uppercase tracking-wider'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
