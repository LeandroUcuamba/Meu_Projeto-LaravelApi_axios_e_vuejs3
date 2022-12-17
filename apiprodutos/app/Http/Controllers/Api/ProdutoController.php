<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Produto;

class ProdutoController extends Controller
{
    

    public function add(Request $request){
        
        try{
           $produto = new Produto();

           $produto->nome = $request->nome;
           $produto->quantidade = $request->quantidade;
           $produto->valor = $request->valor;

           $produto->save();

           return ['retorno'=>'ok'];

        } catch(\Exception $erro){
           
            return ['retorno'=>'erro', 'details'=>$erro];
        }
    }

    public function list(Request $request){

        $produto = Produto::all(); //aqui no parametro pode se dizer quais campos retornar;

        return $produto;
    }

    public function select($id){

        $produto = Produto::find($id);

        return $produto;
    }

    public function update(Request $request, $id){
        
        try{
           $produto = Produto::find($id);

           $produto->nome = $request->nome;
           $produto->quantidade = $request->quantidade;
           $produto->valor = $request->valor;

           $produto->save();

           return ['retorno'=>'ok', 'data'=>$request->all()]; //posso tirar o 'data'=>$request;

        } catch(\Exception $erro){
           
            return ['retorno'=>'erro', 'details'=>$erro];
        }
    }

    public function delete($id){
        
        try{
           $produto = Produto::find($id);

           $produto->delete();

           return ['retorno'=>'ok'];

        } catch(\Exception $erro){
           
            return ['retorno'=>'erro', 'details'=>$erro];
        }
    }


}
