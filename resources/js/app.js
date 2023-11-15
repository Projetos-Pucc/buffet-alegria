import './bootstrap';

import Alpine from 'alpinejs';
import Swal from 'sweetalert2'

window.Alpine = Alpine;

Alpine.start();

window.confirm = function (message="Deseja confirmar esta ação?") {
    return new Promise((resolve) => {
        Swal.fire({
            title: message,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sim",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                resolve(true);
            } else {
                resolve(false);
            }
        });
    });

}

window.error = function (message="Ocorreu um erro ao processar esta solicitação") {
    return Swal.fire({
        icon: "error",
        title: "Oops...",
        text: message,
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Tentar novamente",
      });
}
window.basic = function (message="Operação realizada com sucesso") {
    return Swal.fire(message);
}