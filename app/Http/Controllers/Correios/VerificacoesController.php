<?php

namespace App\Http\Controllers\Correios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

use App\Models\Correios\Verificacao;

class VerificacoesController extends Controller
{
    public function destroy($id) {
        $registro = Verificacao::find($id);

        if($registro->status == "Em Inspeção")
        {
            $registro->delete();
            \Session::flash('mensagem',['msg'=>'Registro deletado com sucesso!'
            ,'class'=>'green white-text']);
        }
        else
        {
            \Session::flash('mensagem',['msg'=>'Registro Com Status {{ $registro->status }} Não pode ser deletado!'
            ,'class'=>'red white-text']);
        }

        $registros = Verificacao::orderBy('codigo')->paginate(10);
        $tiposDeUnidade = DB::table('tiposDeUnidade')
        ->join('gruposDeVerificacao', 'tiposDeUnidade.id',  '=',   'tipoUnidade_id')
        ->select('tipoUnidade_id as id','sigla','tipodescricao')
        ->groupByRaw('tipoUnidade_id')
        ->get();

        return view('compliance.verificacoes.index',compact('registros','tiposDeUnidade'));
    }

    public function search (Request $request)
    {
        $dados = $request->all();

        if( (!empty($request->all()['tipoUnidade_id'])) && (!empty($request->all()['tipoVerificacao'])) && (!empty($request->all()['inspetor'])) )
        {
            $registros = DB::table('verificacoes')
                ->where([['ciclo', '=', $dados['ciclo']]])
                ->Where([['status', '=', $dados['status']]])
                ->Where([['tipoUnidade_id', '=', $dados['tipoUnidade_id']]])
                ->Where([['tipoVerificacao', '=', $dados['tipoVerificacao']]])
                ->Where([['inspetorcoordenador', '=', $dados['inspetor']]])
                ->Where([['inspetorcolaborador', '=', $dados['inspetor']]])
                ->paginate(10);
            \Session::flash('mensagem',['msg'=>'Filtro Aplicado, [Tipo de Unidade, Tipo de Verificação e Inspetor Envolvido].'
                ,'class'=>'orange white-text']);
        }
        if( (!empty($request->all()['tipoUnidade_id'])) && (!empty($request->all()['tipoVerificacao']))  )
        {
            $registros = DB::table('verificacoes')
                ->where([['ciclo', '=', $dados['ciclo']]])
                ->Where([['status', '=', $dados['status']]])
                ->Where([['tipoUnidade_id', '=', $dados['tipoUnidade_id']]])
                ->Where([['tipoVerificacao', '=', $dados['tipoVerificacao']]])
                ->paginate(10);
            \Session::flash('mensagem',['msg'=>'Filtro Aplicado, [Tipo de Unidade e Tipo de Verificação ].'
                ,'class'=>'orange white-text']);
        }

        if(!empty($request->all()['tipoUnidade_id']))
        {
            $registros = DB::table('verificacoes')
                ->where([['ciclo', '=', $dados['ciclo']]])
                ->Where([['status', '=', $dados['status']]])
                ->Where([['tipoUnidade_id', '=', $dados['tipoUnidade_id']]])
                ->paginate(10);
            \Session::flash('mensagem',['msg'=>'Filtro Aplicado, [Tipo de Unidade].'
                ,'class'=>'orange white-text']);
        }
        if(!empty($request->all()['tipoVerificacao']))
        {
            $registros = DB::table('verificacoes')
                ->where([['ciclo', '=', $dados['ciclo']]])
                ->Where([['status', '=', $dados['status']]])
                ->Where([['tipoVerificacao', '=', $dados['tipoVerificacao']]])
                ->paginate(10);
            \Session::flash('mensagem',['msg'=>'Filtro Aplicado, [Tipo de Inspeção].'
                ,'class'=>'orange white-text']);
        }

        if(!empty($request->all()['search'])){
            $registros = DB::table('verificacoes')
                ->where([['ciclo', '=', $dados['ciclo']]])
                ->Where([['status', '=', $dados['status']]])
                ->where([['descricao', 'LIKE', '%' . $request->all()['search'] .'%' ]])
                ->paginate(10);
            \Session::flash('mensagem',['msg'=>'Filtro Aplicado, [Por Unidade].'
                ,'class'=>'orange white-text']);
        }
        if(!empty($request->all()['inspetor'])){
            $registros = DB::table('verificacoes')
                ->where([['ciclo', '=', $dados['ciclo']]])
                ->Where([['status', '=', $dados['status']]])
                ->Where([['inspetorcoordenador', '=', $dados['inspetor']]])
                ->Where([['inspetorcolaborador', '=', $dados['inspetor']]])
                ->paginate(10);
        }
        if(!empty($request->all()['codigo']))
        {
            $registros = DB::table('verificacoes')
                ->where([['ciclo', '=', $dados['ciclo']]])
                ->Where([['status', '=', $dados['status']]])
                ->where([['codigo', 'LIKE', '%' . $request->all()['codigo'] .'%' ]])
                ->paginate(10);
            \Session::flash('mensagem',['msg'=>'Filtro Aplicado, [Por Número da Inspeção].'
                ,'class'=>'orange white-text']);
        }

        $tiposDeUnidade = DB::table('tiposDeUnidade')
        ->join('gruposDeVerificacao', 'tiposDeUnidade.id',  '=',   'tipoUnidade_id')
        ->select('tipoUnidade_id as id','sigla','tipodescricao')
        ->groupByRaw('tipoUnidade_id')
        ->get();

        return view('compliance.verificacoes.index',compact('registros', 'tiposDeUnidade'));
    }

    public function index()
    {
        $registros = DB::table('verificacoes')
        ->select('verificacoes.*')
        ->where([['status', '=', 'Em Inspeção']])
        ->orderBy('codigo' , 'asc')
        ->paginate(10);

        $tiposDeUnidade = DB::table('tiposDeUnidade')
        ->join('gruposDeVerificacao', 'tiposDeUnidade.id',  '=',   'tipoUnidade_id')
        ->select('tipoUnidade_id as id','sigla','tipodescricao')
        ->groupByRaw('tipoUnidade_id')
        ->get();

        return view('compliance.verificacoes.index',compact('registros','tiposDeUnidade'));
    }
}
