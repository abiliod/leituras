<?php

namespace App\Http\Controllers\Concessionarias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Concessionarias\Tarifa;

class ConcessionariasTarifasController extends Controller
{

    public function destroyTarifas($id) {

        $registro = Tarifa::find($id);
        $registro->delete(); //remove o arquivo

        \Session::flash('mensagem',['msg'=>'Registro deletado com sucesso!'
        ,'class'=>'green white-text']);

        return redirect()->route('concessionarias.tarifas');
    }


    public function salvarTarifas(Request $request ){
        $dados = $request->all();

        $registro = new Tarifa();
        $registro->tipo_concessionaria = $dados['tipo_concessionaria'];
        $registro->tipo_consumidor = $dados['tipo_consumidor'];
        $registro->custo_fixo = $dados['custo_fixo'];
        $registro->custo_unitario = $dados['custo_unitario'];
        $registro->tipo_custo_unitario = $dados['tipo_custo_unitario'];
        $registro->vigencia = $dados['vigencia'];
        $registro->tipo_custo_adicional = $dados['tipo_custo_adicional'];
        $registro->custo_adicional = $dados['custo_adicional'];
//dd( $dados);
        $registro->save();

        \Session::flash('mensagem',['msg'=>'Registro criado com sucesso!'
        ,'class'=>'green white-text']);
        return redirect()->route('concessionarias.tarifas');
    }

    public function adicionarTarifas()
    {
        return view('concessionarias.tarifas.adicionarTarifas');
    }

    public function searchTarifa (Request $request)
    {
        $dados = $request->all();

        $registros = DB::table('tarifas')
            ->where([
                    ['tipo_concessionaria', '=', $dados['tipo_concessionaria']]
            ])
            ->where([
                    ['tipo_consumidor', '=', $dados['tipo_consumidor']]
            ])

            ->where([
                ['vigencia', '>=', $dados['search']]
            ])

            ->paginate(15);
            return view('concessionarias.index_tarifa', compact('registros'));
    }


    public function index()
    {
        $registros = DB::table('tarifas')
            ->orderBy('vigencia', 'desc')
        ->paginate(15);
        return view('concessionarias.index_tarifa', compact('registros'));

    }
}
