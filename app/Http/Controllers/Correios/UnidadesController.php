<?php

namespace App\Http\Controllers\Correios;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Correios\Unidade;
use App\Models\Correios\TipoDeUnidade;
use App\Models\Correios\Verificacao;
use App\Models\Correios\ItemDeInspecao;
use App\Http\Requests\Compliance\SalvarVerificacao;

class UnidadesController extends Controller
{
    public function salvarVerificacao(SalvarVerificacao $request)
   // public function salvarVerificacao(Request $request)
    {
        $dados = $request->all();
        $id=$request->unidade_id;
        $unidade = Unidade::find($id);
       // dd($dados );
        $verificacao = Verificacao::create($request->all());
        $verificacao->descricao =  $unidade['descricao'];
        $verificacao->save();

        $parametros = DB::table('tiposDeUnidade')
            ->join('gruposDeVerificacao', 'tiposDeUnidade.id',  '=',   'tipoUnidade_id')
            ->join('testesDeVerificacao', 'grupoVerificacao_id', '=', 'gruposDeVerificacao.id')
            ->where([
                    ['gruposDeVerificacao.tipoUnidade_id', '=', $dados['tipoUnidade_id'] ] //" tipoUnidade_id " => " 1 "
            ])
            ->where([
                    ['gruposDeVerificacao.tipoVerificacao', '=', $dados['tipoVerificacao'] ] //" tipoVerificacao " => " Remoto "
            ])
            ->where([
                    ['gruposDeVerificacao.ciclo', '=', $dados['ciclo'] ]
            ])
        ->get();

        foreach($parametros as $parametro)
        {
            $registro = new ItemDeInspecao;
            $registro->verificacao_id =  $verificacao['id']; //veriricação relacionada
            //$parametro é um objeto, não uma matriz, então deve acessá-lo da seguinte forma:
            $registro->unidade_id =  $dados['unidade_id']; //unidade verificada
            $registro->tipoUnidade_id =  $dados['tipoUnidade_id']; //Tipo de unidade


            $registro->grupoVerificacao_id =  $parametro->grupoVerificacao_id;//grupo de verificação
            $registro->testeVerificacao_id =  $parametro->id;// $registro->id teste de verificação
            $registro->oportunidadeAprimoramento = $parametro->roteiroConforme;
            $registro->consequencias =   $parametro->consequencias;
   //        dd($parametro);
            $registro->save();
        }
        \Session::flash('mensagem',['msg'=>'Inspeção Gerada com sucesso !'
        ,'class'=>'green white-text']);
        return redirect()->route('compliance.unidades');
    }

    public function gerarVerificacao($id)
    {
        $registro = Unidade::find($id);
        $tiposDeUnidade = DB::table('tiposDeUnidade')
        ->where([
                 ['tiposDeUnidade.id', '=', $registro->tipoUnidade_id],
        ])
        ->get();

        $tiposautorizado = DB::table('tiposDeUnidade')
            ->where([
                ['tiposDeUnidade.id', '=', $registro->tipoUnidade_id],
            ])
            ->first();

        if ($tiposautorizado->inspecionar=='Sim')
        {
            return view('compliance.unidades.gerarVerificacao',compact('registro','tiposDeUnidade'));
        }
        else
        {
            \Session::flash('mensagem',['msg'=>'Esta unidade ainda não está liberada para Inspeção:  '.$registro->descricao.'  !'
                ,'class'=>'red white-text']);
            return redirect()->route('compliance.unidades');
        }


    }

    public function atualizar (Request $request, $id)
    {
        $registro = Unidade::find($id);
        $dados = $request->all();
        $registro->se =  $dados['se'];
        $registro->tipoUnidade_id =  $dados['tipoUnidade_id'];
        $registro->descricao =  $dados['descricao'];
        $registro->an8 =  $dados['an8'];
        $registro->mcu =  $dados['mcu'];
        $registro->sto =  $dados['sto'];
        $registro->status_unidadeDesc =  $dados['status_unidadeDesc'];
        $registro->inicio_expediente =  $dados['inicio_expediente'];
        $registro->final_expediente =  $dados['final_expediente'];
        $registro->inicio_intervalo_refeicao =  $dados['inicio_intervalo_refeicao'];
        $registro->final_intervalo_refeicao =  $dados['final_intervalo_refeicao'];
        $registro->trabalha_sabado =  $dados['trabalha_sabado'];
        if( $registro->trabalha_sabado=="Não"){
            $dados['inicio_expediente_sabado']=NULL;
            $dados['final_expediente_sabado']=NULL;
            $dados['horario_lim_post_final_semana']=NULL;
        }
        $registro->inicio_expediente_sabado =  $dados['inicio_expediente_sabado'];
        $registro->final_expediente_sabado =  $dados['final_expediente_sabado'];
        $registro->trabalha_domingo =  $dados['trabalha_domingo'];
        if( $registro->trabalha_sabado=="Não"){
            $dados['inicio_expediente_domingo']=NULL;
            $dados['final_expediente_domingo']=NULL;
            $dados['horario_lim_post_final_semana']=NULL;
        }
        $registro->inicio_expediente_domingo =  $dados['inicio_expediente_domingo'];
        $registro->final_expediente_domingo =  $dados['final_expediente_domingo'];
        $registro->tem_plantao =  $dados['tem_plantao'];
        if( $registro->tem_plantao=="Não"){
            $dados['inicio_plantao_sabado']=NULL;
            $dados['final_plantao_sabado']=NULL;
            $dados['inicio_plantao_domingo']=NULL;
            $dados['final_plantao_domingo']=NULL;
            $dados['horario_lim_post_final_semana']=NULL;
        }
        $registro->inicio_plantao_sabado =  $dados['inicio_plantao_sabado'];
        $registro->final_plantao_sabado =  $dados['final_plantao_sabado'];
        $registro->inicio_plantao_domingo =  $dados['inicio_plantao_domingo'];
        $registro->final_plantao_domingo =  $dados['final_plantao_domingo'];
        $registro->tem_distribuicao =  $dados['tem_distribuicao'];
        if( $registro->tem_distribuicao=="Tem distribuição"){
            $dados['inicio_distribuicao']=NULL;
            $dados['final_distribuicao']=NULL;
        }
        $registro->inicio_distribuicao =  $dados['inicio_distribuicao'];
        $registro->final_distribuicao =  $dados['final_distribuicao'];

        if(($registro->tipoUnidade_id >= 13) && ($registro->tipoUnidade_id !=31) ){
            $dados['horario_lim_post_na_semana']=NULL;
            $dados['horario_lim_post_final_semana']=NULL;
        }
        $registro->horario_lim_post_na_semana =  $dados['horario_lim_post_na_semana'];
        $registro->horario_lim_post_final_semana =  $dados['horario_lim_post_final_semana'];
        $registro->telefone =  $dados['telefone'];
        $registro->email =  $dados['email'];
        $registro->update();

        \Session::flash('mensagem',['msg'=>'Registro da Unidade:  '.$registro->descricao.' foi atualizado com sucesso !'
        ,'class'=>'green white-text']);
        return redirect()->route('compliance.unidades');
    }

    public function edit($id)
    {
        $status_unidadeDesc = DB::table('unidades')
        ->select('status_unidadeDesc')
        ->groupByRaw('status_unidadeDesc')
        ->get();
        $tiposDeUnidade = TipoDeUnidade::all();
        $registro = Unidade::find($id);
        return view('compliance.unidades.editar',compact('registro','tiposDeUnidade','status_unidadeDesc'));
    }

    public function search (Request $request)
    {
        $status = 'Criado e instalado';
        $registros = DB::table('unidades')
            ->join('tiposdeunidade', 'unidades.tipoUnidade_id', '=', 'tiposdeunidade.id')
            ->select(
                'unidades.*', 'tiposdeunidade.inspecionar', 'tiposdeunidade.tipoInspecao'

            )
            ->where([
            ['descricao', 'LIKE', '%' . $request->all()['search'] .'%' ],
            ['status_unidadeDesc', '=', $status],
            ['tiposDeUnidade.inspecionar', '=',  'Sim']

        ])
        ->orWhere([
            ['mcu', 'LIKE', '%' . $request->all()['search'] .'%' ],
            ['status_unidadeDesc', '=', $status],
            ['tiposDeUnidade.inspecionar', '=',  'Sim']

        ])
        ->orWhere([
            ['sto', 'LIKE', '%' . $request->all()['search'] .'%' ],
            ['status_unidadeDesc', '=', $status],
            ['tiposDeUnidade.inspecionar', '=',  'Sim']
        ])
        ->orWhere([
            ['telefone', 'LIKE', '%' . $request->all()['search'] .'%' ],
            ['status_unidadeDesc', '=', $status],
            ['tiposDeUnidade.inspecionar', '=',  'Sim']
        ])
        ->paginate(5);
        return view('compliance.unidades.index',compact('registros'));
    }

    public function index()
    {
        $status = 'Criado e instalado';
        $registros = DB::table('unidades')
            ->join('tiposdeunidade', 'unidades.tipoUnidade_id', '=', 'tiposdeunidade.id')
            ->select(
                'unidades.*', 'tiposdeunidade.inspecionar', 'tiposdeunidade.tipoInspecao'

            )
            ->where([['tiposDeUnidade.inspecionar', '=',  'Sim']])
            ->where([['unidades.status_unidadeDesc', '=',  $status]])
            ->paginate(10);
    	return view('compliance.unidades.index',compact('registros'));  //
    }
}
