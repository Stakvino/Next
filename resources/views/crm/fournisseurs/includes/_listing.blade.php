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

<!-- Listing Fournisseurs -->
<table id="liste_fournisseur" class="display" style="width:100%">
  <thead>
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