const base_url = "/crm/fournisseurs";

/**
 * Update the textcontent of cells in a row of HTML table
 * 
 * @param {jQuery Collection} $row row in table that will be updated
 * @param {Array} data  data that will be used to update the row {name, value} 
 * @return {void} 
 */
function update_row_values($row, data){
  data.forEach( element => {
    const name = element['name'];
    const value = element['value'];
    $row.find(`td[name="${name}"]`).text(value);
  });
}
//---------------------------------------------------------

/**
 * Uses iziToast to flash a message
 * 
 * @param {String} message  To show
 * @param {string} type  type of flash message [success|error|info|warn]
 * @param {string} position  bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
 */
function flash(message, type , position = "bottomRight") {
  switch (type) {
      case "success":
          iziToast.success({
              title: false,
              position: position,
              message: message,
          });
          break;
      case "error":
          iziToast.error({
              title: false,
              position: position,
              message: message,
          });
          break;
      default:
          iziToast.info({
              title: false,
              position: position,
              message: message,
          });
          break;
  }
}
//-------------------------------------------------------

/**
 * Display error messages in a form using Semantic Ui .error_message
 * 
 * @param {jQuery Collection} $form  
 * @param {Object} error_messages   
 * @return {void} 
 */
function formErrors($form, error_messages = []){
  $form.find('.error_message').hide();
  
  $form.find('.field').each(function(){
    const input_name = $(this).find('input').attr('name');
    if(input_name && error_messages[input_name]){
      const $message_container = $(this).find('.error_message').show();
      const error_message = error_messages[input_name][0];
      $message_container.find('p').text(error_message);
    }
  });
}
//-------------------------------------------------------
/**
 * Display an iziToast confirm popup  
 * 
 * @param {String} message  
 * @param {String} color color of displayed popup ex: "red"   
 * @param {Function} success_action callback executed if user choses "yes" 
 */
function confirm_popup(message = "", color, success_action){
  iziToast.question({
    timeout: 10000,
    zindex: 999,
    message: message,
    position: 'center',
    color: color,
    buttons: [
        ['<button><b>Oui</b></button>', function (instance, toast) {
            
            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
            if(success_action){
              success_action();
            }

        }, true],
        ['<button>No</button>', function (instance, toast) {

            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

        }],
    ]
  });
}
//-------------------------------------------------------
/**
* Store Update or Delete a ressource using ajax
*
* @param {Array} data array of objects {name, value}
* @param {String} url end point to store ressource
* @param {callback} success_action
* @param {callback} error_action 
*/
function update_ressource(data, url, success_action, error_action) {
  $.ajax({
      url: url,
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: data,
      success: function (response) {
          if (success_action) {
            success_action(response);
          }
      },
      error: function (xhr, status, errorThrown) {
          if(error_action){
            error_action();
          }
          console.log(JSON.parse(xhr.responseText).category[0]);
      }
  })
}




