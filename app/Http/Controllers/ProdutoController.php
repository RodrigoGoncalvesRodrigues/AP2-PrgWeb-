<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Responses\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdutoController extends Controller
{
    public function salvar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:200',
            'preco' => 'required|float',
            

        ]);

        if ($validator->fails()) {

            return ApiResponse::error($validator->errors(),'Validation error');
            
        
        }

        $salvar = Produto::create($request->all());
        

        return ApiResponse::ok('Produto salvo com sucesso',$salvar);
       
    }


    public function editar(Request $request,int $id)
   
    {
        $validator = Validator::make($request->all(), [
            

            'nome' => 'required|string|max:200',
            'preco' => 'required|float',
            
            
        ]);

        if ($validator->fails()) {
            
            return ApiResponse::error($validator->errors(),'Validation error');
           
        
        }

        $editar = Produto::findOrFail($id);
        

        $editar->update($request->all());
        
        
        return ApiResponse::ok('Produto atuaizado com sucesso',$editar);
        
    }
    public function listar()
    {
        $listar = Produto::all();
        
        
        return ApiResponse::ok('lista de clientes',$listar);
       
    }

    public function listarPeloId(int $id)
    
    {
        $listarid = Produto::findOrFail($id);
       
        return ApiResponse::ok('Cliente a ser listado', $listarid);
        

    }
    public function excluir(Request $request,int $id)
    
    {
        $excluir = Produto::findOrFail($id);
       
        $excluir->delete();
       
        
        return ApiResponse::ok('Cliente exlcuido com sucesso');
       
    }
}

