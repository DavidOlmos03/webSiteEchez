async function editModal(IdElemento,TableName) {
    // Realizar una solicitud AJAX 
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            // Manejar la respuesta del servidor
             var data = JSON.parse(this.responseText);

            // Llenar el formulario con los datos recibidos
            document.getElementById('txtUser_NameEdit').value = data.User_Name;
            document.getElementById('txtSerialEdit').value = data.Serial;
            document.getElementById('txtPC_NameEdit').value = data.PC_Name;
            document.getElementById('txtInstallation_DateEdit').value = data.Installation_Date;
            document.getElementById('txtPlate_PCEdit').value = data.Plate_PC;
            document.getElementById('txtSpecificationsEdit').value = data.Specifications;
            document.getElementById('txtRamEdit').value = data.Ram;
            document.getElementById('txtDesktop_LaptopEdit').value = data.Desktop_Laptop;
            document.getElementById('txtDomainEdit').value = data.Domain;
            document.getElementById('txtStatus_PCEdit').value = data.Status_PC;
            document.getElementById('txtdateUpdate_DateEdit').value = data.dateUpdate_Date;
            
            // Mostrar la ventana modal
            $('#crudModalEdit').modal('show');
        }
    };
    var url = "editar.php?Id=" + IdElemento + "&TableName=" + TableName;
    xhttp.open("GET", url, true);
    xhttp.send();
}




async function PostAlert() {

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "¿Estás seguro?",
        text: "Ingresaras un nuevo PC!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, guardar!",
        cancelButtonText: "No, cancelar!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
                /*Si se confirma el cargo de la información se procede a hacer la solicitud ajax*/ 
                
                let User_Name = document.getElementById('txtUser_Name').value;
                let Serial= document.getElementById('txtSerial').value;
                let PC_Name = document.getElementById('txtPC_Name').value;
                let Installation_Date = document.getElementById('txtInstallation_Date').value;
                let Plate_PC = document.getElementById('txtPlate_PC').value;
                let Specifications = document.getElementById('txtSpecifications').value;
                let Ram = document.getElementById('txtRamEdit').value;
                let Desktop_Laptop = document.getElementById('txtDesktop_LaptopEdit').value;
                let Domain = document.getElementById('txtDomainEdit').value;
                let Status_PC = document.getElementById('txtStatus_PCEdit').value;
                let dateUpdate_Date = document.getElementById('txtdateUpdate_DateEdit').value;             
                /*console.log("Datos enviados:", JSON.stringify({
                    confirmed: result.isConfirmed,
                    Name: Name,
                    Description: Description
                }));*/
                var xhttp = new XMLHttpRequest();
                var url = "guardar.php?User_Name=" + User_Name + "&Serial=" + Serial+"&PC_Name=" + PC_Name+
                "&Installation_Date=" + Installation_Date+"&Plate_PC=" + Plate_PC+"&Specifications=" + Specifications+"&Ram=" + Ram
                + "&Desktop_Laptop=" + Desktop_Laptop+"&Domain=" + Domain+"&Status_PC=" + Status_PC+"&dateUpdate_Date=" + dateUpdate_Date;
                xhttp.open("GET", url, true);
                xhttp.send();	

            swalWithBootstrapButtons.fire({
                title: "Guardado!",
                text: "El nuevo PC ha sido ingresado con exito.",
                icon: "success",
            });
            /*setTimeout(function() {
                location.reload();
              }, 2000);*/
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "No se ha ingresado el PC",
                icon: "error"
            });
        }
    });
    
}

