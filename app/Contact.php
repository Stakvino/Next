<?php

namespace App;

use App\Fournisseur;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

    protected $guarded = [];

    public $MODEL = "Contact";

    public $RULES = [
        "fournisseur_id" => 'required',
        "Nom" => 'required',
        "Tel" => 'required',
        "Fax" => '',
        "Email" => ''
    ];

    public $VALIDATION_ERRORS_MESSAGES = [
      'Nom.required' => 'Le champ Nom est obligatoire.',
      'Tel.required' => 'Le champ Tel est obligatoire.',
      'fournisseur_id.required' => 'Le fournisseur_id est obligatoire.'
    ];

    public $allows = [
      'id' => "allows",
      "fournisseur_id" => "allows",
      "Nom" => "allows",
      "Tel" => "allows",
      "Fax" => "allows",
      "Email" => "allows"
    ];

    public function fournisseur()
    {
      return $this->belongsTo(Fournisseur::class);
    }
}
