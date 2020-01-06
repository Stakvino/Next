<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Fournisseur;
use Illuminate\Http\Request;
use App\BuilderQuery\Pamp\ModelBuilder;

class ContactController extends Controller
{

    use ModelBuilder;
    protected $view;

    public function __construct()
    {
        $this->model = new Contact();
    }

    //---------------------------------------------------

    /**
     * Display a listing of the resource.
     *
     * @param  App\Fournisseur
     * @return \Illuminate\Http\Response
     */
    public function index(Fournisseur $fournisseur)
    {
        return ['data' => $fournisseur->contacts];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return String JSON
     */
    public function store(Request $request)
    {
        return $this->_set($request, $this->model);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return $contact;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->_saveWhat($request, $this->model, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Int id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Int $id)
    {
        return $this->_destroyWhat($id, $this->model);
    }
}
