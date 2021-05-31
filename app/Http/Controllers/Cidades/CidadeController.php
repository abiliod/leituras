<?php

namespace App\Http\Controllers\Cidades;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cidades\Cidade;
use App\Models\Cidades\Estado;

class CidadeController extends Controller {

    public function index() {

        $registros = DB::table('estados')
            ->join('cidades', function($join) {
                $join->on('estados.id', '=', 'cidades.estado_id');
            })
            ->paginate(15);

            return view('admin.cidades.index', compact('registros'));
    }

    public function editar($id)  {

        $estados = Estado::get();
        $registro = Cidade::find($id);

        return view('admin.cidades.editar', compact('registro','estados'));
    }

    public function atualizar(Request $request, $id) {

        $registro = Cidade::find($id);
        $dados = $request->all();
        $registro->cidade = $dados['cidade'];
        $registro->estado_id = $dados['estado_id'];

        $registro ->update();

        \Session::flash('mensagem',['msg'=>'Registro atualizado com sucesso!'
        ,'class'=>'green white-text']);

        return redirect()->route('admin.cidades');
    }

    public function adicionar() {

        $estados = Estado::get();
        return view('admin.cidades.adicionar', compact('estados'));
    }

    public function salvar(Request $request) {

        $dados = $request->all();
        $search=$dados['cidade'];

        $registro = new Cidade();
        $registro->cidade = $dados['cidade'];
        $registro->estado_id = $dados['estado_id'];

        $registro->save();

        \Session::flash('mensagem',['msg'=>'Registro criado com sucesso!'
        ,'class'=>'green white-text']);

        return redirect()->route('admin.cidades');

    }

    public function deletar($id) {

        /** atualizar quando implementar tabela de endereços
        *
        * if(Cidade::where('endereco_id','=',$id)->count()){
        *   $msg = "Não é possível deletar essa cidade! Ela está associada pelo menos um endereço (";
        *   $imoveis = Imovel::where('cidade_id','=',$id)->get();
        *
        *   foreach ($imoveis as $imovel) {
        *       $msg .= "id:".$imovel->id." ";
        *   }
        *   $msg .= ") estão relacionados.";
        *
        *    \Session::flash('mensagem',['msg'=>$msg,'class'=>'red white-text']);
        *         return redirect()->route('admin.cidades');
        *}
        * Cidade::find($id)->delete();
        */

        \Session::flash('mensagem',['msg'=>'Registro deletado com sucesso!'
        ,'class'=>'green white-text']);

        return redirect()->route('admin.cidades');
    }
    
    public function search (Request $request) {

        $registros = DB::table('estados')
           ->Join('cidades', 'estados.id', '=', 'cidades.estado_id')
           ->orWhere('cidade', 'LIKE', '%' . $request->all()['search'] .'%' )
           ->paginate(15);

           return view('admin.cidades.index', compact('registros'));
    }

}
