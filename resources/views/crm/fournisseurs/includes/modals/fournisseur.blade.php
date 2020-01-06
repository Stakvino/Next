<!-- Nouveau Fournisseur Modal -->
<div id="nv_fournisseur_modal" class="izimodal" data-iziModal-title="Nouveau Fournisseur">
  <form class="ui form">
    <div class="field">
      <label>Nom</label>
      <input type="text" name="Nom" placeholder="Nom">
      <div class="error_message">
        <p></p>
      </div>
    </div>
    <div class="field">
      <label>Adresse</label>
      <input type="text" name="Adresse" placeholder="Adresse">
      <div class="error_message">
        <p></p>
      </div>
    </div>
    <div class="field">
      <label>Code Postal</label>
      <input type="number" name="Cp" placeholder="Code Postal" onkeydown="return event.keyCode !== 69">
      <div class="error_message">
        <p></p>
      </div>
    </div>
    <div class="field">
      <label>Ville</label>
      <input type="text" name="Ville" placeholder="Ville">
      <div class="error_message">
        <p></p>
      </div>
    </div>
    <div class="field">
      <label>Pays</label>
      @include('crm.fournisseurs.includes._countries_dropdown')
      <div class="error_message">
        <p></p>
      </div>
    </div>

    <div class="modal_buttons">
      <button type="button" class="ui primary button valider">Valider</button>
      <button type="button" class="ui button" data-izimodal-close="">Annuler</button>
    </div>
  </form>
</div>
<!-- /-->
