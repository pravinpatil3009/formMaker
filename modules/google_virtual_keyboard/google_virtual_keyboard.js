// $Id: google_virtual_keyboard.js,v 1.2 2010/12/21 04:13:04 confiz Exp $
var keyboard = '';      
var languages = [];

// Load the Google Onscreen Keyboard API
try {
  google.load("elements", "1", {
    packages: "keyboard"
  });
} catch(error) {
    alert("Fail to connect with google virtual keyboard. Please check your internet connection.");
}

Drupal.behaviors.google_virtual_keyboard = function (context) { 
  //Set languages to be shown in the language dropdown
 
  languages = Drupal.settings.google_virtual_keyboard.languages;  

  //Set background color and foreground color for the language dropdown box
  backgroundColor = '#' + Drupal.settings.google_virtual_keyboard.backgroundColor;
  foregroundColor = '#' + Drupal.settings.google_virtual_keyboard.foregroundColor
  $('#language-menu-wrapper').css({'color': foregroundColor, 'border-color': foregroundColor});
  $('#language-menu-wrapper').css({'background-color': backgroundColor});
  $('#bar').css({'background-color':foregroundColor});
  $('.language-menu-dropdown').css({'border-color' : foregroundColor});
  $('.language-menu-dropdown').css({'background-color' :  backgroundColor});

  //Checks if there is any textfield or textareas
  var fieldExists = false;
  //An Array containing the Ids of both textfields and textareas
  var ids = [];
  //Get the Ids of all textareas
  var $textInput = $("input[type=text]");
  $textInput.each(function() {
    ids[this.name] = $(this).attr('id');
    fieldExists = true;
  });
  //Get the Ids of all textareas
  var $textareas = $('textarea');
  $textareas.each(function() {
    ids[this.name] = $(this).attr('id');
    fieldExists = true;
  });
  
  //Show drop down at the top right corner if there is any field for text input.
  if (fieldExists == true) {
    $(".language-menu-dropdown").append(getDropDownHTML());
    $("#language-menu-wrapper").show();
  }else {
    $("#language-menu-wrapper").hide();
  }  
  $("#language-menu-wrapper").draggable();
  //Toggle min-max buttons on click
  $('#min-max-button').click(function(){
    $(".language-menu-dropdown").toggle();
    var minimizeButtonDiv = 'min-img-button';
    var maximizeButtonDiv = 'max-img-button';
    if (this.className == minimizeButtonDiv) {
      this.className = maximizeButtonDiv;
    }else {
      this.className = minimizeButtonDiv;
    }
  }); 
  //Enable Google Virtual Keyboard
  keyboard = new google.elements.keyboard.Keyboard([google.elements.keyboard.LayoutCode.ENGLISH],ids);
 
};

/*
 * Creates the select element
 */
function getDropDownHTML()
{
  var dropDown = "<select  class='language-dropdown' onchange='changeKeyboardLayout(this.value)'>"+
                 "<option value='en' select='selected' title='Change language for keyboard'>English</option>"+populateOptions()+"</select>";
  return dropDown;
}

/*
 * Populate the languages in the dropdown
 */
function populateOptions() {
  var options = '';
  var name =  '';
  for(var languageCode in languages) {
      name = google.elements.keyboard.getLayoutName(languageCode);
      options = options + '<option value= ' + languageCode + ' title="Change language for keyboard">' + name + '</option>';
  }
  return options;
}


/*
 * Change the language layout for google virtual keyboard "onchange" of the selected language options
 */
function changeKeyboardLayout(selectedLanguage) {
  if(selectedLanguage.length!=0) {
    var code = {};
    code = selectedLanguage; 
    keyboard.setLayout(code);
  }
}

/*
 * Attach color picker to the textfield ID given by arguement
 */
function colorPickerAttach(fieldId) {
  $(fieldId).ColorPicker({
    onSubmit: function(hsb, hex, rgb) {
      $(fieldId).val(hex);
    },
    onBeforeShow: function() {
      $(this).ColorPickerSetColor(this.value);
    }
  })
  .bind('keyup', function(){
    $(this).ColorPickerSetColor(this.value);
  });
}


