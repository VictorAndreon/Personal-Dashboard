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
        text: 'Você tem certeza? Esta ação não pode ser desfeita.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sim',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
