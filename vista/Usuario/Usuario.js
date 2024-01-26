async function editModal(IdElemento,TableName) {
    // Realizar una solicitud AJAX 
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            // Manejar la respuesta del servidor
             var data = JSON.parse(this.responseText);

            // Llenar el formulario con los datos recibidos
            document.getElementById('txtNameEdit').value = data.Name;
            document.getElementById('txtEmailEdit').value = data.Email;
            document.getElementById('txtEmailEditView').value = data.Email;
            //document.getElementById('txtPasswordEdit').value = data.Password;
            //document.getElementById('listboxEdit').value = data.arregloRolesConsulta;

            // Limpiar el listbox1 antes de agregar nuevas opciones
            var listbox1Edit = document.getElementById('listbox1Edit');
            listbox1Edit.innerHTML = '';

            // Obtener el array de roles desde la respuesta del servidor
            var rolesArray = data.Roles;
            //console.log('rolArray:', rolesArray[0].split(";")[1]);
            // Agregar opciones al listbox
            for (var i = 0; i < rolesArray.length; i++) {
                var option = document.createElement('option');
                option.value = rolesArray[i];
                option.text = rolesArray[i];
                listbox1Edit.add(option);

                // Marcar las opciones seleccionadas en el listbox
                if (rolesArray[i]['selected']) {
                    option.selected = true;
                }
                
            }
            

            // Mostrar la ventana modal
            $('#crudModalEditUsuario').modal('show');
        }
    };
    var url = "editar.php?Id=" + IdElemento + "&TableName=" + TableName;
    xhttp.open("GET", url, true);
    xhttp.send();
     // Mostrar rolesArray en la consola
     
}

/*
    Alerts para usuario
*/
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
            }, 2000);
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

async function PostAlertUser() {

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "¿Estás seguro?",
        text: "Ingresaras un nuevo usuario!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, guardar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
                /*Si se confirma el cargo de la información se procede a hacer la solicitud ajax*/ 
                let Email = document.getElementById("txtEmail").value;
                let Name = document.getElementById("txtName").value; 
                let Password = document.getElementById("txtPassword").value;     
                
                /*
                    Para obtener todos los elementos del listbox
                */
               // Obtener el elemento select
                var listbox1 = document.getElementById("listbox1");

                // Obtener todos los elementos de opciones
                var allOptions = [];
                for (var i = 0; i < listbox1.options.length; i++) {
                    var optionValue = listbox1.options[i].value;
                    //var optionText = listbox1.options[i].text;
                    
                    allOptions.push({
                        value: optionValue,
                        //text: optionText
                    });
                }


                /*console.log("Datos enviados:", JSON.stringify({
                    confirmed: result.isConfirmed,
                    Name: Name,
                    Email: Email,
                    Password: Password,
                    listbox1: allOptions
                }));*/
                var xhttp = new XMLHttpRequest();
                var url = "guardar.php?Name=" + Name + "&Email=" + Email+"&Password="+Password+"&listbox1="+encodeURIComponent(JSON.stringify(allOptions));
                xhttp.open("GET", url, true);
                xhttp.send();	

            swalWithBootstrapButtons.fire({
                title: "Guardado!",
                text: "El nuevo usuario ha sido ingresado con exito.",
                icon: "success",
            });
            setTimeout(function() {
                location.reload();
              }, 2000);
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "No se ha ingresado el usuario",
                icon: "error"
            });
        }
    });
    
}