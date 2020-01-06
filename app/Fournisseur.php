<?php

namespace App;

use App\Contact;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{

      protected $guarded = [];

      public $MODEL = "Fournisseur";

      public $RULES = [
          "id" => '',
          "Nom" => 'required',
          "Adresse" => '',
          "Cp" => 'required',
          "Ville" => 'required',
          "Pays" => 'required'
      ];

      public $VALIDATION_ERRORS_MESSAGES = [
        'Nom.required' => 'Le champ Nom est obligatoire.',
        'Cp.required' => 'Le champ Code Postal est obligatoire.',
        'Ville.required' => 'Le champ Ville est obligatoire.',
        'Pays.required' => 'Le champ Pays est obligatoire.'
      ];

      public $allows = [
        "id" => "allows",
        "Nom" => "allows",
        "Adresse" => "allows",
        "Cp" => "allows",
        "Ville" => "allows",
        "Pays" => "allows"
    ];

    public function contacts()
    {
      return $this->hasMany(Contact::class);
    }

    /**
     * Scope of grid list fournisseur
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
     public function scopeGrid($query, $request)
     {

         $detail = null;
         $cond =  array_filter($request);
         if (key_exists("select", $request)) {
             unset($request["select"]);
             $detail = true;
         }
         return $query->select(
             array_keys($this->allows)
         )
             ->when(key_exists('id', $cond), function ($q) use ($cond) {
                 return $q->where('id', 'LIKE', "{$cond['id']}%");
             })
             ->when(key_exists('Nom', $cond), function ($q) use ($cond) {
                 return $q->where('Nom', 'LIKE', "{$cond['Nom']}%");
             })
             ->when(key_exists('Pays', $cond), function ($q) use ($cond) {
                 return $q->where('Pays', '=', $cond['Pays']);
             })
             ->when($detail, function ($q) use ($request) {
                 $q->where($request);
             });
     }
     //--------------------------------------------------------------
}
