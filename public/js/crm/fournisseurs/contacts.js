(function(){
  
  $(document).ready(function(){

    const fournisseur_id = $('#liste_contact').data('fournisseur_id');

    //Load data and render datatable
    var liste_contact = $('#liste_contact').DataTable( {
      responsive: true,
      searching: false,
      bPaginate: false,
      bInfo: false,
      "ajax": `${base_url}/${fournisseur_id}/contacts`,
      'createdRow': function( row, data) {
          $(row).data('id', data.id);
      },
      "columnDefs": [
        { "targets": 0, 'createdCell':  function (td) { $(td).attr('name', 'Nom'); } },
        { "targets": 1, 'createdCell':  function (td) { $(td).attr('name', 'Tel'); } },
        { "targets": 2, 'createdCell':  function (td) { $(td).attr('name', 'Fax'); } },
        { "targets": 3, 'createdCell':  function (td) { $(td).attr('name', 'Email'); } }
      ], 
      "columns": [ 
          { "data": "Nom" },
          { "data": "Tel" },
          { "data": "Fax" },
          { "data": "Email" },
          { "render": function(data, type, full, row){
              return `
              <div class="btns_td">
                <i style="cursor:pointer;" class="large edit blue icon edit_contact_btn" data-id="${full.id}"></i>
                <i style="cursor:pointer;" class="large trash red icon delete_contact_btn" data-id="${full.id}"></i>
              </div>`;
            }, style: "color:red"
          }
      ],
      "order": [[0, 'asc']]
    } );

    //Contact Modals
    $('.izimodal').iziModal({restoreDefaultContent : true});
    const $nv_contact_modal = $('#nv_contact_modal');
    const $contact_update_modal = $('#contact_update_modal');

    $('.nouveau-contact-btn').click(function(){
      
      $nv_contact_modal.iziModal('open');
        
      $('button.valider', $nv_contact_modal).click(function(){
        
        $nv_contact_modal.iziModal('startLoading');
        const $form = $nv_contact_modal.find('form');
        const data = $form.serializeArray();
        data.push({"name": "fournisseur_id", "value": fournisseur_id});
        const url = `${base_url}/contacts/store`;

        update_ressource(data, url, 
          response =>{ //success_action
            $nv_contact_modal.iziModal('stopLoading');
            
            if(!response.error){
              $nv_contact_modal.iziModal('close');
              liste_contact.ajax.reload();
              flash('Contact ajouter', 'success');
            }else{
              const error_messages = response.errors; 
              formErrors($form, error_messages);
            }
          },
          ()=>{ //error_action
            $nv_contact_modal.iziModal('close');
            flash('Erreur serveur', 'error');
          }
        );
      });
    });
    
    // Update Contact
    liste_contact.on('click', '.edit_contact_btn', function(){
      
      const id = $(this).data('id');
      const $form = $contact_update_modal.find('form');

      $contact_update_modal.iziModal('open');
      $contact_update_modal.iziModal('startLoading');

      $.get(`${base_url}/contacts/${id}/show`, function(data){
        for (const key in data) {
          $form.find(`input[name="${key}"]`).val(data[key]);
        }
        $contact_update_modal.iziModal('stopLoading');
      });

      $('button.modifier', $contact_update_modal).click(function(){
        
        $contact_update_modal.iziModal('startLoading');
        const data = $form.serializeArray();
        data.push({"name": "fournisseur_id", "value": fournisseur_id});
        data.push({"name": "_method", "value": "patch"});
        const url = `${base_url}/contacts/${id}/update`;

        update_ressource(data, url, 
          response =>{ //success_action
            $contact_update_modal.iziModal('stopLoading');
            if(!response.error){
              $contact_update_modal.iziModal('close');
              liste_contact.ajax.reload();
              flash('Contact modifier', 'success');
            }else{
              const error_messages = response.errors;
              formErrors($form, error_messages);
            }
          },
          ()=>{ //error_action
            $contact_update_modal.iziModal('close');
            flash('Erreur serveur', 'error');
          }
        );
      });
    });

    //-------------------------------------------------------
    //Supprimer Contact
    const $suppression_loader = $('.suppression_loader');
    liste_contact.on('click', '.delete_contact_btn', function(e){
      const id = $(e.target).data('id');
      confirm_popup('Voulez vous supprimer ce contact ?', 'red',
      () =>{ //user clicked yes
        const data = {"_method": "delete"};
        const url = `${base_url}/contacts/${id}/destroy`; 
        $suppression_loader.show();
        update_ressource(data, url, 
        response =>{ //success_action
          liste_contact.ajax.reload();
          $suppression_loader.hide();
          flash('Contact supprimer', 'success');
        });
      });
    });

    $('.ui.dropdown')
    .dropdown();
    
  //End document ready 
  });
     
})();