async function editModal(IdElemento,TableName) {
    // Realizar una solicitud AJAX 
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            // Manejar la respuesta del servidor
             var data = JSON.parse(this.responseText);

            // Llenar el formulario con los datos recibidos
            document.getElementById('txtApplicantEdit').value = data.Applicant;
            document.getElementById('txtAreaEdit').value = data.Area;
            document.getElementById('txtStartDateEdit').value = data.StartDate;
            document.getElementById('txtEndDateEdit').value = data.EndDate;
            document.getElementById('txtLicenseTypeEdit').value = data.LicenseType;
            document.getElementById('txtBudgetEdit').value = data.Budget;
            document.getElementById('txtQuantityEdit').value = data.Quantity;
            document.getElementById('txtCostCenterEdit').value = data.CostCenter;
            document.getElementById('txtCostEdit').value = data.Cost;
            
            // Mostrar la ventana modal
            $('#ModalEdit').modal('show');
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

