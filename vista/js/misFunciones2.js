/**
 * Funciones personales
 */
function limpiarCampos() {
    var form = document.getElementById('Form');
    form.reset();
}

$(document).ready(function()
{
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked)
		{
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});

function agregarItem(idElementoOrigen, idElementoDestino){
	var option = document.createElement("option");
	option.text = document.getElementById(idElementoOrigen).value;
	document.getElementById(idElementoDestino).add(option);
	//removerItem(idElementoOrigen);
	selectTodos(idElementoDestino);
}

function removerItem(IDelemento){
	var comboBox = document.getElementById(IDelemento);
    comboBox = comboBox.options[comboBox.selectedIndex];
    comboBox.remove();
	selectTodos(IDelemento);
  }

function selectTodos(IDelemento) {
    var elementos = document.getElementById(IDelemento);
    elementos = elementos.options;
    for (var i = 0; i < elementos.length; i++) {
        elementos[i].selected = "true";
    }
}
/*
function agregarItem(idElementoOrigen, idElementoDestino){
	var option = document.createElement("option");
	option.text = document.getElementById(idElementoOrigen).value;
	document.getElementById(idElementoDestino).add(option);
	removerItem(idElementoOrigen);
	selectTodos(idElementoDestino);
}

function removerItem(IDelemento){
	var comboBox = document.getElementById(IDelemento);
    comboBox = comboBox.options[comboBox.selectedIndex];
    comboBox.remove();
	selectTodos(IDelemento);
  }

function selectTodos(IDelemento) {
    var elementos = document.getElementById(IDelemento);
    elementos = elementos.options;
    for (var i = 0; i < elementos.length; i++) {
        elementos[i].selected = "true";
    }
}

*/

async function alertPrueba() {
    // Código de la función
    alert("¡Hola desde JavaScript!");
}

async function exitAlert() {
  const currentLanguage = localStorage.getItem('selectedLanguage');
  const title = currentLanguage === 'es' ? "¿Cerrar sesión?" : "Sign off?";
  const confirmButtonText = currentLanguage === 'es' ? "Salir" : "Exit";
  const denyButtonText = currentLanguage === 'es' ? "Cancelar" : "Cancel";

  const result = await Swal.fire({
    title: title,
    showDenyButton: true,
    confirmButtonText: confirmButtonText,
    denyButtonText: denyButtonText
  });

  if (result.isConfirmed) {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        window.location.href = "http://localhost/webSiteEchez/login.php";
      }
    };

    xhttp.open("GET", "http://localhost/webSiteEchez/vista/cerrarSesion.php", true);
    xhttp.send();
  }
}


