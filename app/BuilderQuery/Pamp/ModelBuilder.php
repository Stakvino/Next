<?php

namespace App\BuilderQuery\Pamp;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

/**
 * Trait de Fournisseur controller
 */
trait ModelBuilder
{


    /**
    * Get Fournisseur
    *
    * @param Int $id
    * @param String $view | template to rendering
    * @param \Illuminate\Database\Eloquent\Model $model
    * @return String
    */
    protected function _get(Int $id, String $view = null, $model, String $select = null)
    {
        try {
            switch ($select) {
                case 'select':
                    $_model = $model::grid([$model->table . '.id' => $id, "select" => null])->first();
                    break;

                default:
                    $_model = $model::whereId($id)->first();
                    break;
            }
            switch ($view) {
                case null:
                    return $_model;
                    break;
                default:
                    $renderView = view($view)->with(['data' => $_model])->render();
                    return response()->json(['ok' => 'SUCCESS GET ' . $view, 'view' => $renderView], 200);
                    break;
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => 'FAIL TO GET ' . $view . ' : ' . $th]);
        }
    }
    //------------------------------------------------------------------------

    /**
     * Create New Model
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return String JSON
     */
     protected function _set(Request $request, $model)
     {
        try {
            $validateResult = $this->ValidateRequest($request, $model);
            if ($validateResult == "Validated") {
                if (!array_key_exists('id', $request->all())) {
                    $action = "_STORE";
                    $_model = $model::Create($request->all());
                } else {
                    $action = "_UPDATE";
                    $_model = $model->find($request->all()["id"]);
                    $_model->update($request->all());
                }

                $json_response = response()->json(
                  [
                      'ok' => 'SUCCESS ' . $action . ' ' . $model->MODEL,
                      'id' => $_model->id,
                      'action' => $action
                  ],
                  200
                );

            } else{
                $json_response = $validateResult;
            } 

            return $json_response;

        } catch (\Throwable $th) {
            return response()->json(['error' => 'FAIL TO ' . $action . ' ' . $model->Model . ':' . $th]);
        }
    }
    //-----------------------------------------------------
    
    /**
     * Build a JSON response for JQeuryDataTables using Yajra DataTables 
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return String JSON
     */
     private function _dataTable(Request $request, $model)
     { 
       
         $data = $model::grid($this->cleanRequest($request, $model->allows));
         $dataTable = DataTables::of($data);
         
         return  $dataTable->toJson();
    }
    //------------------------------------------------
    
    /**
     * Update 
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return String JSON
     */
     protected function _saveWhat(Request $request, $model, $id)
     {
         try {
             $data = $this->cleanRequest($request, $model->RULES);
             $validateResult = $this->ValidateRequest($request, $model);
             if ($validateResult == "Validated") {
             $_model = $model::find($id);
             $_model->update($data);
             $json_response =  response()->json([
                 'Result' => 'OK',
                 'ok' => 'Modification effectuée avec succès',
                 'record' => $_model
             ], 200);
            }else{
              $json_response = $validateResult;
            }

            return $json_response;
            
         } catch (\Throwable $th) {
             return response()->json(['error' => 'Problème lors de la modification' . $th]);
         }
     }
     //------------------------------------------------------------------------

    /**
     * Destroy model function
     *
     * @param Int $id
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return String JSON 
     */
     protected function _destroyWhat(Int $id, $model)
     {
         try {
             $_model = $model::find($id);
             $_model->delete();
             return response()->json([
                 'ok' => 'Suppression effectuée',
                 'list' => '#liste_' . $model->MODEL
             ], 200);
         } catch (\Throwable $th) {
             return response()->json([
                 'error' => 'Problème lors de la suppression' . $th
             ]);
         }
     }

     //------------------------------------------------------------------------
 
    /**
     * Clean request
     *
     * @param \Illuminate\Http\Request $request
     * @param Array $allows
     * @return Array
     */
     private function cleanRequest(Request $request, array $allows)
     {
         return  array_intersect_key($request->all(), $allows);
     }

     //------------------------------------------------


    /**
     * Validate Model request
     *
     * @param \Illuminate\Http\Request $request
     * @return String
     */
    private function ValidateRequest(Request $request, $model)
    {
        $validator = Validator::make(
            $request->all(),
            $model->RULES,
            $model->VALIDATION_ERRORS_MESSAGES
        );
        if ($validator->fails())
            return response()->json(
                [
                    'error' => 'Fail to store '.class_basename($model),
                    'errors' => $validator->errors()->messages()
                ]
            );
        else return "Validated";
    }

    //-----------------------------------------------

}
