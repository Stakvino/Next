<!-- BTN Nouveau Fournisseur -->
<div class="nouveau-fournisseur-btn">
  <button class="ui primary button">  
    Nouveau Fournisseur
  </button>
</div>
<!-- /-->

<!-- Modals -->
@include('crm.fournisseurs.includes.modals.fournisseur')
<!-- /-->

<!-- Loader -->
<div class="ui segment fournisseur_open_loader">
  <div class="ui active inverted dimmer">
    <div class="ui text loader">Chargement Fournisseur</div>
  </div>
  <p></p>
</div>

<div class="ui segment white_layer_loader fournisseur_update_loader">
  <div class="ui active inverted dimmer">
    <div class="ui text loader">Modification Fournisseur</div>
  </div>
  <p></p>
</div>

<div class="ui segment suppression_loader">
  <div class="ui active inverted dimmer">
    <div class="ui text loader">Suppression</div>
  </div>
  <p></p>
</div>
<!-- /-->

<!-- Listing Fournisseurs -->
<table id="liste_fournisseur" class="display" style="width:100%">
  <thead>
      <tr>
        <th style="border: none;">
          <!-- Filtering Loader -->
          <div class="ui segment white_layer_loader fournisseur_filter_loader">
            <div class="ui active inverted dimmer">
              <div class="ui text loader">Chargement</div>
            </div>
            <p></p>
          </div>
          <!-- /-->
        </th>
      </tr>
      <tr>
          <th>Code</th>
          <th>Nom</th>
          <th>Code Postal</th>
          <th>Ville</th>
          <th>Pays</th>
          <th style="width:40px;"></th>
      </tr>
  </thead> 
</table>
<!-- /-->