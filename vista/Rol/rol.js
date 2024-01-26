async function editModal(IdElemento,TableName) {
    // Realizar una solicitud AJAX 
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            // Manejar la respuesta del servidor
             var data = JSON.parse(this.responseText);

            // Llenar el formulario con los datos recibidos
            document.getElementById('txtNameEdit').value = data.Name;
            document.getElementById('txtDescriptionEdit').value = data.Description;

            // Mostrar la ventana modal
            $('#crudModalEdit').modal('show');
        }
    };
    var url = "editar.php?Id=" + IdElemento + "&TableName=" + TableName;
    xhttp.open("GET", url, true);
    xhttp.send();
}

﻿/*
 *Diferents alerts windows
 */
/*
 async function PostAlertRol() {

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "¿Estás seguro?",
        text: "Ingresaras un nuevo rol!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, guardar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            
            swalWithBootstrapButtons.fire({
                title: "Guardado!",
                text: "El nuevo rol ha sido ingresado con exito.",
                icon: "success",
            });
        } else if (
            /* Read more about handling dismissals below 
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "No se ha ingresado el rol",
                icon: "error"
            });
        }
    });
}*/

async function DeleteAlert(idElemento) {

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "¿Estás seguro?",
        text: "Eliminaras un registro de tu base de datos!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, eliminar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true

    }).then((result) => {
        if (result.isConfirmed) { 
          /*
            Al confirmar que se desea eliminar el elemento, 
            se crea la variable xhttp que me permitira hacer solicitudes al servidor  
          */
          var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                // Manejar la respuesta del servidor (opcional)
                console.log(this.responseText);
                // Eliminar el elemento del DOM
                var elemento = document.getElementById(idElemento);
                if (elemento) {
                  elemento.parentNode.removeChild(elemento);
                }
              }
            };
            xhttp.open("GET", "eliminar.php?Id=" + idElemento, true);
            xhttp.send();        

            swalWithBootstrapButtons.fire({
                title: "Eliminado!",
                text: "El elemento indicado ha sido eliminado",
                icon: "success"
            });
            // Recargar la página después de la eliminación exitosa
            setTimeout(function() {
              location.reload();
            }, 3000);
        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "No se ha eliminado ningún elemento",
                icon: "error"
            });
        }
    });
}



async function PostAlertRol() {

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "¿Estás seguro?",
        text: "Ingresaras un nuevo rol!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, guardar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
                /*Si se confirma el cargo de la información se procede a hacer la solicitud ajax*/ 
                let Name = document.getElementById("txtName").value;
                let Description = document.getElementById("txtDescription").value;              
                /*console.log("Datos enviados:", JSON.stringify({
                    confirmed: result.isConfirmed,
                    Name: Name,
                    Description: Description
                }));*/
                var xhttp = new XMLHttpRequest();
                var url = "guardar.php?Name=" + Name + "&Description=" + Description;
                xhttp.open("GET", url, true);
                xhttp.send();	

            swalWithBootstrapButtons.fire({
                title: "Guardado!",
                text: "El nuevo rol ha sido ingresado con exito.",
                icon: "success",
            });
            setTimeout(function() {
                location.reload();
              }, 3000);
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "No se ha ingresado el rol",
                icon: "error"
            });
        }
    });
    
}

