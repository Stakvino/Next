<?php

namespace App\Http\Controllers;

use App\BuilderQuery\Pamp\ModelBuilder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Fournisseur;

class FournisseurController extends Controller
{ 

    use ModelBuilder;
    protected $model;

    public function __construct()
    {
        $this->model = new Fournisseur();
    }
    //---------------------------------------------------


    /**
     * Get "filtered by user" fournisseurs in JSON format
     *
     * @param \Illuminate\Http\Request $request
     * @return string JSON
     */
     public function filtered(Request $request)
     {
       return $this->_dataTable($request, $this->model);
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('crm.fournisseurs.index');
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
     * @param  Int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Int $id)
    {
        return $this->_get($id, 'crm.fournisseurs.detail', $this->model);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function edit(Fournisseur $fournisseur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Int $id)
    {
        return $this->_saveWhat($request, $this->model, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Int $id)
    {
        return $this->_destroyWhat($id, $this->model);
    }

}
