import './bootstrap';

import Swal from 'sweetalert2';
import Alpine from 'alpinejs';

import 'sweetalert2/dist/sweetalert2.min.css';

window.Swal = Swal;
window.Alpine = Alpine;

Alpine.start();

window.teste = function(){
    console.log('oi');
}
