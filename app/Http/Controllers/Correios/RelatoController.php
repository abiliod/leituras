<?php

namespace App\Http\Controllers\Correios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

use App\Models\Correios\TesteDeVerificacao;
use App\Models\Correios\GrupoDeVerificacao;
use App\Models\Correios\TipoDeUnidade;
use App\Http\Requests\Compliance\SalvarTesteDeVerificacao;

class RelatoController extends Controller
{

    public function destroy($id) {

//        $testeDeVerificacao = DB::table('testesDeVerificacao')
 //          ->select('numeroDoTeste','teste')
  //         ->where([
   //             ['grupoVerificacao_id', '=', $id]
    //    ])
     //   ->first();

 //       if($testeDeVerificacao){
 //           \Session::flash('mensagem',['msg'=>'Registro Não pode ser excluido, pois está  Relacionado ao item de Verificação Número. '.$testeDeVerificacao->numeroDoTeste.''
 //           ,'class'=>'red white-text']);
 //   		return redirect()->route('compliance.grupoVerificacao');
 //       }else{
  //      }


            $registro = TesteDeVerificacao::find($id);
        //     $registro->delete();
             \Session::flash('mensagem',['msg'=>'Registro Nâo NâoNâoNâoNâoNâo deletado com sucesso!'
             ,'class'=>'green white-text']);
             return redirect()->route('compliance.relatos');


    }

    public function salvar(SalvarTesteDeVerificacao $request)
    {
        TesteDeVerificacao::create($request->all());
        \Session::flash('mensagem',['msg'=>'Teste de Verificacao Criado com sucesso !'
                  ,'class'=>'green white-text']);
        return redirect()->route('compliance.relatos');
    }

    public function adicionar()
    {
        $gruposdeverificacao = DB::table('gruposDeVerificacao')
        ->join('tiposDeUnidade', 'tiposDeUnidade.id',  '=',   'gruposDeVerificacao.tipoUnidade_id')
        ->select('gruposDeVerificacao.id','ciclo','tipoVerificacao','sigla','tipodescricao','numeroGrupoVerificacao','nomegrupo')
        -> orderBy ('ciclo', 'ASC')
        -> orderBy ('tipoUnidade_id', 'ASC')
        -> orderBy ('numeroGrupoVerificacao', 'ASC')
        ->get();
        return view('compliance.relatos.adicionar',compact('gruposdeverificacao'));
    }

    public function atualizar (Request $request, $id)
    {
        $registro = TesteDeVerificacao::find($id);
        $dados = $request->all();
        $registro->grupoVerificacao_id =  $dados['grupoVerificacao_id'];
        $registro->numeroDoTeste =  $dados['numeroDoTeste'];
        $registro->inspecaoObrigatoria =  $dados['inspecaoObrigatoria'];
        $registro->teste =  $dados['teste'];
        $registro->ajuda =  $dados['ajuda'];
        $registro->amostra =  $dados['amostra'];
        $registro->norma =  $dados['norma'];
        $registro->sappp =  $dados['sappp'];
        $registro->tabela_CFP =  $dados['tabela_CFP'];
        $registro->impactoFinanceiro =  $dados['impactoFinanceiro'];
        $registro->riscoFinanceiro =  $dados['riscoFinanceiro'];
        $registro->descumprimentoLeisContratos =  $dados['descumprimentoLeisContratos'];
        $registro->descumprimentoNormaInterna =  $dados['descumprimentoNormaInterna'];
        $registro->riscoSegurancaIntegridade =  $dados['riscoSegurancaIntegridade'];
        $registro->riscoImgInstitucional =  $dados['riscoImgInstitucional'];
        $registro->totalPontos = $dados['totalPontos'];
        $registro->consequencias = $dados['consequencias'];
        $registro->roteiroConforme = $dados['roteiroConforme'];
        $registro->roteiroNaoConforme = $dados['roteiroNaoConforme'];
        $registro->roteiroNaoVerificado = $dados['roteiroNaoVerificado'];
        $registro->itemanosanteriores = $dados['itemanosanteriores'];
        $registro->orientacao = $dados['orientacao'];

        $registro->update();
        \Session::flash('mensagem',['msg'=>'Teste de Verificação atualizado com sucesso !'
        ,'class'=>'green white-text']);
        return redirect()->route('compliance.relatos');

    }

    public function edit($id)
    {
        $registro = TesteDeVerificacao::find($id);
        $gruposdeverificacao = DB::table('gruposDeVerificacao')
        ->join('tiposDeUnidade', 'tiposDeUnidade.id',  '=',   'gruposDeVerificacao.tipoUnidade_id')
        ->select('gruposDeVerificacao.id','ciclo','tipoVerificacao','sigla','tipodescricao','numeroGrupoVerificacao','nomegrupo')
        -> orderBy ('ciclo', 'ASC')
        -> orderBy ('tipoUnidade_id', 'ASC')
        -> orderBy ('numeroGrupoVerificacao', 'ASC')
        ->get();
        return view('compliance.relatos.editar',compact('registro', 'gruposdeverificacao'));
    }

    public function search (Request $request) {
        $dados = $request->all();
        if ($dados['nomegrupo'] == null) $dados['nomegrupo'] ="";

        if (($dados['tipoUnidade_id'] >= "1")&&($dados['tipoVerificacao'] == null)){
            \Session::flash('mensagem',['msg'=>'Tipo de Verificação é Requerido !'
                  ,'class'=>'red white-text']);
            return redirect()->back();
        }

        if (($dados['tipoUnidade_id'] == "0")&&($dados['tipoVerificacao'] == null)){
            \Session::flash('mensagem',['msg'=>'Tipo de Unidade e Tipo de Verificação é Requerido !'
                  ,'class'=>'red white-text']);
            return redirect()->back();
        }else if($dados['tipoUnidade_id'] >= "1"){
                        //dd("elseif");
                        $registros = DB::table('tiposDeUnidade')
                        ->join('gruposDeVerificacao', 'tiposDeUnidade.id',  '=',   'tipoUnidade_id')
                        ->join('testesDeVerificacao', 'grupoVerificacao_id', '=', 'gruposDeVerificacao.id')
                        ->where([
                                ['gruposDeVerificacao.tipoUnidade_id', '=', $dados['tipoUnidade_id'] ]
                                ])
                        ->where([
                                ['gruposDeVerificacao.tipoVerificacao', '=', $dados['tipoVerificacao'] ]
                                ])
                        ->where([
                                ['gruposDeVerificacao.nomegrupo', 'like','%' . $dados['nomegrupo'] .'%' ]
                                ])
                        ->paginate(100);
                }else{
            //   dd('else');
                $registros = DB::table('tiposDeUnidade')
                ->join('gruposDeVerificacao', 'tiposDeUnidade.id',  '=',   'tipoUnidade_id')
                ->join('testesDeVerificacao', 'grupoVerificacao_id', '=', 'gruposDeVerificacao.id')
                ->where([
                        ['gruposDeVerificacao.tipoVerificacao', '=', $dados['tipoVerificacao'] ]
                        ])
                ->where([
                        ['gruposDeVerificacao.nomegrupo', 'like','%' . $dados['nomegrupo'] .'%' ]
                        ])
                ->paginate(100);
        }
        $gruposdeverificacao = DB::table('gruposDeVerificacao')
            ->select('nomegrupo')
            ->groupByRaw('nomegrupo')
            ->get();

        $tiposDeUnidade = DB::table('tiposDeUnidade')
            ->join('gruposDeVerificacao', 'tiposDeUnidade.id',  '=',   'tipoUnidade_id')
            ->select('tipoUnidade_id as id','sigla','tipodescricao')
            ->groupByRaw('tipoUnidade_id')
            ->get();
        $dados = TipoDeUnidade::find($request['tipoUnidade_id']);
            //$dados->nomegrupo=$request['nomegrupo'];
        return view('compliance.relatos.index',compact('registros', 'tiposDeUnidade','gruposdeverificacao','dados'));
    }

    public function index() {

        $registros = DB::table('tiposDeUnidade')
            ->join('gruposDeVerificacao', 'tiposDeUnidade.id',  '=',   'tipoUnidade_id')
            ->join('testesDeVerificacao', 'grupoVerificacao_id', '=', 'gruposDeVerificacao.id')
            ->paginate(15);

        $gruposdeverificacao = DB::table('gruposDeVerificacao')
            ->select('nomegrupo')
            ->groupByRaw('nomegrupo')
            ->get();

        $dados = TipoDeUnidade::find(1);
        $dados->id= 0;
        $dados->sigla='Selecione um ';
        $dados->tipodescricao='Tipo de Unidade';
        $dados->nomegrupo='Selecione um Grupo de Unidade';


        $tiposDeUnidade = DB::table('tiposDeUnidade')

            ->join('gruposDeVerificacao', 'tiposDeUnidade.id',  '=',   'tipoUnidade_id')
            ->select('tipoUnidade_id as id','sigla','tipodescricao')
            ->groupByRaw('tipoUnidade_id')
            ->get();
        //dd($tiposDeUnidade );

        return view('compliance.relatos.index',compact('registros', 'tiposDeUnidade','gruposdeverificacao','dados'));
    }
}
