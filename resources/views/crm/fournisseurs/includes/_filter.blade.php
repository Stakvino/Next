<!-- Search by Code input -->
<div class="reset_filters">
  <button class="ui button"><i class="undo icon"></i> Réinitialiser le filtre</button>
</div>
<!-- /-->
<div class="filter_fields">
  <!-- Search by Code input -->
  <div class="ui search">
    <div class="ui icon input">
      <input class="prompt filter_" type="text" placeholder="Code" id="filter_id">
      <i class="search icon"></i>
    </div>
    <div class="results"></div>
  </div>
  <!-- /-->
  <!-- Search by Nom input -->
  <div class="ui search">
    <div class="ui icon input">
      <input class="prompt filter_" type="text" placeholder="Nom du fournisseur" id="filter_Nom">
      <i class="search icon"></i>
    </div>
    <div class="results"></div>
  </div>
  <!-- /-->
  <!-- Search by Pays -->
  <div class="Pays_dropdown">
    @include('crm.fournisseurs.includes._countries_dropdown')
  </div>
  <!-- /-->
</div>