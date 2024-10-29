<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use App\Responses\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VendedorController extends Controller
{
    public function salvar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:200',
            'cpf' => 'required|string|max:15',
            'ano' =>'require|integer',
            

        ]);

        if ($validator->fails()) {

            return ApiResponse::error($validator->errors(),'Validation error');
            
        
        }

        $salvar = Vendedor ::create($request->all());//cliente models
        

        return ApiResponse::ok('Vendedor salvo com sucesso',$salvar);
       
    }


    public function editar(Request $request,int $id)
   
    {
        $validator = Validator::make($request->all(), [
            

            'nome' => 'required|string|max:200',
            'cpf' => 'required|string|max:15',
            'ano' =>'require|integer',
            
            
        ]);

        if ($validator->fails()) {
            
            return ApiResponse::error($validator->errors(),'Validation error');
           
        
        }

        $customer = Vendedor::findOrFail($id);
        

        $customer->update($request->all());
        
        
        return ApiResponse::ok('Vendedor atualizado com sucesso',$customer);
        
    }
    public function listar()
    {
        $listar = Vendedor ::all();
        
        
        return ApiResponse::ok('lista de Vendedores',$listar);
       
    }

    public function listarPeloId(int $id)
    
    {
        $listarid = Vendedor ::findOrFail($id);
       
        return ApiResponse::ok('vendedor a ser listado', $listarid);
        

    }
    public function excluir(Request $request,int $id)
    
    {
        $customer = Vendedor ::findOrFail($id);
       
        $customer->delete();
       
        
        return ApiResponse::ok('vendedor exlcuido com sucesso');
       
    }
}
