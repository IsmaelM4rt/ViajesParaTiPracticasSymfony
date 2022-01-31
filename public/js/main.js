//Esperamos a que la ventana cargue para que el javascript no se lance antes de que las variables esten inicializadas.
window.onload = function () {
    const proveedores = document.getElementById('proveedores');

    if (proveedores) {
        //Añadimos el eventlistener al botón de borrar.
        proveedores.addEventListener('click', (e) => {
            if(e.target.className === 'btn btn-danger delete-proveedor') {
               if(confirm('Eliminar proveedor?')){
                   const id = e.target.getAttribute('data-id');
                   fetch(`/proveedor/borrar/${id}`, {
                       method:'DELETE'
                   }).then(res => window.location.reload());
               }
            }
        });
    }
}