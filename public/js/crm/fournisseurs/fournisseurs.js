(function(){  

  $(document).ready(function() {
    
    //Load data and render datatable
    var liste_fournisseur = $('#liste_fournisseur').DataTable( {
      processing: true,
      serverSide: true,
      responsive: true,
      searching: false,
      paging: true,
      bInfo: false,      
      "pageLength": 25,
      "bFilter": false,
      aLengthMenu: [
              [25, 50, 100, 200, -1],
              [25, 50, 100, 200, "All"]
      ],
      "ajax":{
        url : `${base_url}/filtered`,
        data: function (d) {
            d.id = $("#filter_id").val(),
            d.Nom = $("#filter_Nom").val(),
            d.Pays = $("#filter_Pays").dropdown('get value')
        }
      },
      'createdRow': function( row, data) {
          $(row).data('id', data.id);
          $(row).addClass('hover-highlight');
      },
      "columnDefs": [
        { "targets": 1, 'createdCell':  function (td) { $(td).attr('name', 'Nom'); } },
        { "targets": 2, 'createdCell':  function (td) { $(td).attr('name', 'Cp'); } },
        { "targets": 3, 'createdCell':  function (td) { $(td).attr('name', 'Ville'); } },
        { "targets": 4, 'createdCell':  function (td) { $(td).attr('name', 'Pays'); } }
      ], 
      "columns": [
          { "data": "id", className:'open' }, 
          { "data": "Nom", className:'open' },
          { "data": "Cp", className:'open' },
          { "data": "Ville", className:'open' },
          { "data": "Pays", className:'open' },
          { "render": function(data, type, full, row){
              return `<i style="cursor:pointer;" class="large trash red icon delete_fournisseur_btn" data-id="${full.id}"></i>`;
            }
          }
      ],
      "order": [[0, 'asc']]
    } );


    //Add semantic ui styling to liste_length dropdown [25,50,100,All]
    $('select[name="liste_fournisseur_length"]')
    .addClass('ui dropdown liste_fournisseur_length');  

    const $table_body = $('#liste_fournisseur tbody');
    const $loader_tr = $('<tr id="loader_tr"><td colspan="6"></td></tr>');
    $loader_tr.find('td').append($('.fournisseur_open_loader'));
    
    // Add event listener for opening and closing childrow
    $table_body.on('click', 'td.open', function () {
        var tr = $(this).closest('tr');
        var allrows = $('#liste_fournisseur tbody tr[role="row"]')
        var row = liste_fournisseur.row( tr );
        const id = tr.data('id');

        if ( row.child.isShown() ) {
            // This row is already open - close it
            $('#fournisseur_details', row.child()).slideUp( function () {
                row.child.hide();
                tr.removeClass('shown');
                $(this).find('tr').addClass('hover-highlight');
            } );
        }
        else {
            // Close opened row
            const $opened_tr = $('#liste_fournisseur tbody tr.shown');
            const opened_row = liste_fournisseur.row( $opened_tr );
            opened_row.child.hide();
            $opened_tr.removeClass('shown');
            
            $loader_tr.insertAfter(tr).show();
            // Open this row
            $.ajax({
              url :`${base_url}/${id}/show`,
              method: "get",
              success: function(data){
                $loader_tr.hide();
                row.child( data.view, 'no-padding' ).show();
                tr.addClass('shown');
                allrows.removeClass('hover-highlight');
                $('#fournisseur_details', row.child()).slideDown(() => {
                  allrows.addClass('hover-highlight');
                });
              }
            });
        }
    } );

    //-------------------------------------------------------

    //Filters
    const $filters = $('.filter_');
    const $reset_filters = $('div.reset_filters');
    const fade_delay = 200;
    const $filter_loader = $('.fournisseur_filter_loader');

    liste_fournisseur.on( 'page.dt', () => $filter_loader.show() );
    
    liste_fournisseur.on( 'draw', () => $filter_loader.hide() );

    function filters_event_handler(){
      $filter_loader.show();
      liste_fournisseur.ajax.reload( () => $filter_loader.hide() );
      const inputs_are_empty = $filters.toArray().every(input => input.value === "");
      if(inputs_are_empty){
        $reset_filters.hide(fade_delay);
      }else{
        $reset_filters.show(fade_delay);
      }
    }

    //Filter datatable according to user input 
    $filters.on('keyup' , filters_event_handler);
    $('#filter_Pays').find('input[name="Pays"]').change(filters_event_handler);

    //Clicking reset filters btn will reset filters input value to default
    $reset_filters.click(function(){
      $filters.val('');
      $('#filter_Pays').dropdown('clear');
      $filter_loader.show();
      liste_fournisseur.ajax.reload( () => {
        $reset_filters.hide(fade_delay);
        $filter_loader.hide(); 
      });
    });

    //-------------------------------------------------------

    //Nouveau Fournisseur Modal
    const $nv_fournisseur_modal = $('#nv_fournisseur_modal');
    //clicking button will open modal form to create new fournisseur
    $('.nouveau-fournisseur-btn button').click( () => {

      $nv_fournisseur_modal.iziModal('open');
      
      //clicking valider button will store ressource
      $('button.valider', $nv_fournisseur_modal).click(function (){

        $nv_fournisseur_modal.iziModal('startLoading');
        const $form = $nv_fournisseur_modal.find('form');
        const data = $form.serializeArray();
        const url = `${base_url}/store`;

        update_ressource(data, url, 
        response => { //success_action
          $nv_fournisseur_modal.iziModal('stopLoading');
          if(!response.error){
            $nv_fournisseur_modal.iziModal('close');
            liste_fournisseur.ajax.reload();
            flash('Fournisseur ajouter', 'success');
          }else{
            const error_messages = response.errors; 
            formErrors($form, error_messages);
          }
        },
        ()=>{ //error_action
          $nv_fournisseur_modal.iziModal('close');
          flash('Erreur serveur', 'error');
        });

      });

    });
    //-------------------------------------------------------
    const $fournisseur_update_loader = $('.fournisseur_update_loader');
    /**
    * Event handler to update fournisseur
    *  
    * @param {event} e  
    */
    function update_fournisseur(e) {
      e.preventDefault();
      var $field = $(this);
      var $form = $field.closest('.form');
      var id = $form.data('id')
      
      const data = $form.serializeArray();
      data.push({"name": "_method", "value": "patch"});
      const url = `${base_url}/${id}/update`;
      const $updated_row = $form.closest('tr').prev('tr.shown');
      $('#fournisseur_details').append($fournisseur_update_loader);
      $fournisseur_update_loader.show();

      update_ressource(data, url, 
      response => {
        if(!response.error){
          update_row_values($updated_row, data);
          flash('Fournisseur modifier', 'success');
          $form.find('.error_message p').text('');
          $fournisseur_update_loader.hide();
        }else{
          const error_messages = response.errors; 
          formErrors($form, error_messages);
        }
      });
      
    };
    
    //-------------------------------------------------------
    //Modifier Fournisseur
    $(document).on('change', '.fournisseur_update_input', update_fournisseur);
    //--------------------------------------------------------------
    const $suppression_loader = $('.suppression_loader'); 
    /**
    * Event handler to delete fournisseur
    *  
    * @param {Int} id id of fournisseur
    * @param {DataTable} liste_fournisseur fournisseur datatable object used to reload table  
    */
    function delete_fournisseur(id, liste_fournisseur){
      confirm_popup('Voulez vous supprimer ce fournisseur ?', 'red',
       () =>{ //user clicked yes
        const data = {"_method": "delete"};
        const url = `${base_url}/${id}/destroy`;
        $suppression_loader.show(); 
        update_ressource(data, url, 
        response =>{ //success_action
          liste_fournisseur.ajax.reload( () => $suppression_loader.hide() );
          flash('Fournisseur supprimer', 'success');
        });
      })
    }
    //-------------------------------------------------------
    //Supprimer Fournisseur
    $(document).on('click', '.delete_fournisseur_btn', function(){
      const id = $(this).data('id');
      delete_fournisseur(id, liste_fournisseur);
    });
    //--------------------------------------------------------------

    //Init Modals
    $('.izimodal').iziModal({restoreDefaultContent : true});

    //Init Semantic Ui DropDown
    $('.ui.dropdown')
    .dropdown();

  //document ready end   
  } );

})();
