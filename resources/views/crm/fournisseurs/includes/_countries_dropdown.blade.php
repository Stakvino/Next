<div class="ui fluid search selection dropdown" id="filter_Pays">
  <input type="hidden" name="Pays" class="filter_ {{ $class ?? '' }}"  
  value="{{ $Pays ?? '' }}">
  <i class="dropdown icon"></i>
  <div class="default text">Pays</div>
  <div class="menu">
    <div class="item" data-value=""><i class=""></i>Pays</div>
    @foreach (\DB::table('pays')->get() as $pays)
      <div class="item" data-value="{{ $pays->Nom }}">{{ $pays->Nom }}</div>
    @endforeach
  </div>
</div>