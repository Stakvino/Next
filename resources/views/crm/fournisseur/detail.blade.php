<!-- Modals -->
  @include('crm.fournisseurs.includes.modals.contact')
<!-- /-->

<!-- Show Fournisseur Details -->
<div id="fournisseur_details">
  <form class="ui form" data-id="{{$data->id}}" data-model="{{class_basename($data)}}">
    <div class="field">
      <label>Nom</label>
      <input type="text" name="Nom" class="fournisseur_update_input" placeholder="Nom" value="{{$data->Nom}}">
      <div class="error_message">
        <p></p>
      </div>
    </div>
    <div class="field">
      <label>Adresse</label>
      <input type="text" name="Adresse" class="fournisseur_update_input" placeholder="Adresse" value="{{$data->Adresse}}">
      <div class="error_message">
        <p></p>
      </div>
    </div>
    <div class="field">
      <label>Code Postal</label>
      <input type="number" name="Cp" class="fournisseur_update_input" placeholder="Code Postal" 
      onkeydown="return event.keyCode !== 69" value="{{$data->Cp}}">
      <div class="error_message">
        <p></p>
      </div>
    </div>
    <div class="field">
      <label>Ville</label>
      <input type="text" name="Ville" class="fournisseur_update_input" placeholder="Ville" value="{{$data->Ville}}">
      <div class="error_message">
        <p></p>
      </div>
    </div>
    <div class="field">
      <label>Pays</label>
        @include('crm.fournisseurs.includes._countries_dropdown', ['Pays' => $data->Pays, 'class' => 'fournisseur_update_input'])
      <div class="error_message">
        <p></p>
      </div>
    </div>

  </form>
</div>
<!-- /-->

<div class="contacts_container" data-fournisseur_id="{{$data->id}}">
  <div class="contacts_header">
    <h2>Contacts</h2>
    <button class="ui positive button nouveau-contact-btn">Ajouter un contact</button>
  </div>
  <div class="contacts_table">
    <!-- Listing Contacts -->
    <table id="liste_contact" class="display" style="width:100%" data-fournisseur_id="{{$data->id}}">
      <thead>
          <tr>
              <th>Nom</th>
              <th>Tel</th>
              <th>Fax</th>
              <th>Email</th>
              <th></th>
          </tr>
      </thead> 
    </table>
    <!-- /-->
  </div>
</div>

<script src="{{ asset('js/crm/fournisseurs/contacts.js') }}"></script>