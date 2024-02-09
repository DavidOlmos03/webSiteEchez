// lang.js
var currentLanguage = localStorage.getItem('selectedLanguage') || 'es'; // Obtener el idioma almacenado o usar 'es' como predeterminado

function changeLanguage(language) {
  currentLanguage = language;
  updateContent();
  localStorage.setItem('selectedLanguage', language); // Almacenar el idioma seleccionado en localStorage
}

function updateContent() {
  if(currentLanguage == 'es'){
    urlJson = 'http://localhost/webSiteEchez/vista/json/es.json';
  }else{
    urlJson = 'http://localhost/webSiteEchez/vista/json/en.json'
  }
    // Cargar el archivo JSON de manera asíncrona con jQuery
  $.getJSON(urlJson, function (data) {
    var section;
    /**
     * Para los botones 
     * */  
      section='buttons';
      $('.save-text').text(data[section].save);
      $('.edit-text').text(data[section].edit);
      $('.delete-text').text(data[section].delete);
      $('.clean-text').text(data[section].clean);
    /**
       * Para el navbar principalmente
       */
      
      section='navbar';
      $('.home-text').text(data[section].home);
      $('.profile-text').text(data[section].profile);
      $('.inventory-text').text(data[section].inventory);
      $('.exit-text').text(data[section].exit);
      $('.rented-text').text(data[section].rented);
      $('.licensing-text').text(data[section].licensing);
      $('.user-text').text(data[section].user);
      $('.role-text').text(data[section].role);
      /**
       * Para el Home principalmente
       */
      section='home';
      $('#future-text').text(data[section].future);
      $('#transformation-text').text(data[section].transformation);
      $('#faith-text').text(data[section].faith);
      $('#values-text').text(data[section].values);
      $('#faithTittle-text').text(data[section].faithTittle);
      $('#valueTittle-text').text(data[section].valueTittle);
      /**
       * Para el Profile principalmente
       */
      section='profile';
      $('.about-text').text(data[section].about);
      $('.roles-text').text(data[section].roles);
      $('.name-text').text(data[section].name);
      $('.email-text').text(data[section].email);
      $('.activeRoles-text').text(data[section].activeRoles);
      $('.inactiveRoles-text').text(data[section].inactiveRoles);
      $('#descriptionAdminGlobal-text').text(data[section].descriptionAdminGlobal);
      $('#descriptionAdmin-text').text(data[section].descriptionAdmin);
      $('#descriptionITProject-text').text(data[section].descriptionITProject);
      $('#descriptionAnalytics-text').text(data[section].descriptionAnalytics);
      $('#descriptionInventory-text').text(data[section].descriptionInventory);
      $('#descriptionApprovals-text').text(data[section].descriptionApprovals);
      $('.description-text').text(data[section].description);
      $('.pages-text').text(data[section].pages);
      $('.social-text').text(data[section].social);
      /**
       * Para el Rented PCs principalmente
       */
      section='rented';
      $('.addPc-text').text(data[section].addPc);
      $('.active-text').text(data[section].active);
      $('.inactive-text').text(data[section].inactive);
      $('.all-text').text(data[section].all);
      $('.rentedPC-text').text(data[section].rentedPC);
      $('.pcData-text').text(data[section].pcData);
      $('.userName-text').text(data[section].userName);
      $('.pcName-text').text(data[section].pcName);
      $('.installationDate-text').text(data[section].installationDate);
      $('.platePc-text').text(data[section].platePc);
      $('.specifications-text').text(data[section].specifications);
      $('.desktop-text').text(data[section].desktop);
      $('.laptop-text').text(data[section].laptop);
      $('.domain-text').text(data[section].domain);
      $('.statusPc-text').text(data[section].statusPc);
      $('.dateUpdated-text').text(data[section].dateUpdated);
      $('.actions-text').text(data[section].actions);
       /**
     * Para Licenciamiento principal/
     */
      section='licensing';
      $('.licensingWord-text').text(data[section].licensing);
      $('.applicant-text').text(data[section].applicant);
      $('.area-text').text(data[section].area);
      $('.licenseType-text').text(data[section].licenseType);
      $('.budget-text').text(data[section].budget);
      $('.cost-text').text(data[section].cost);
      $('.startDate-text').text(data[section].startDate);
      $('.endDate-text').text(data[section].endDate);
      $('.constCenter-text').text(data[section].constCenter);
      $('.quantity-text').text(data[section].quantity);
      $('.data-text').text(data[section].data);

      /**
       * Para Usuario principal/
       */
      section='users';
      $('.management-text').text(data[section].management);
      $('.user-text').text(data[section].user);
      $('.newUser-text').text(data[section].newUser);
      $('.name-text').text(data[section].name);
      $('.email-text').text(data[section].email);
      $('.password-text').text(data[section].password);
      $('.dataUser-text').text(data[section].dataUser);
      $('.userRoles-text').text(data[section].userRoles);
      $('.allRoles-text').text(data[section].allRoles);
      $('.specificRoles-text').text(data[section].specificRoles);
      $('.addItem-text').text(data[section].addItem);
      $('.removeItem-text').text(data[section].removeItem);
    });
   

}

// Call updateContent() on page load
$(document).ready(function () {
  updateContent();
});
