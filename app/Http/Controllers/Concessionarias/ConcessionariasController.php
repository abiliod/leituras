<?php

namespace App\Http\Controllers\Concessionarias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Concessionarias\UnidadeConsumidora;
use App\Models\Concessionarias\Leitura;
use App\Models\Pessoas\Pessoa;
//use App\Http\Controllers\ConcessionariasLeituraController;

class ConcessionariasController extends Controller
{


    public function gerarLeituraId($id)
    {
        $registro = DB::table('unidadesconsumidoras')
        ->where([
                ['status', '=', 'Ativo']
        ])
        ->where([
            ['id', '=', $id]
        ])
        ->first();
        $res=0;
        if($registro->cod_medidor  == 'ENEL62L22FUNDOS'){
            $res = DB::table('leituras')
                ->where([
                    ['cod_medidor', '=', $registro->cod_medidor ]
                ])
                ->max('posicao');
            $res=$res+82;
        }

        if($registro->cod_medidor  == 'Y19162L24FUNDOS'){
            $res = DB::table('leituras')
                ->where([
                    ['cod_medidor', '=', $registro->cod_medidor ]
                ])
                ->max('posicao');
            $res=$res+5.5;
        }

        $leitura = new Leitura;
        $leitura->cod_medidor  = $registro->cod_medidor;
        $leitura->posicao  = $res;
        $leitura->tipo_concessionaria  = $registro->tipo_concessionaria;
        $leitura->data  = null;
//        dd($registro->cod_medidor, $res,$leitura);
        $leitura->save();

        return redirect()-> route('concessionarias.leituras');
    }

    public function gerarLeitura()
    {
        $registros = DB::table('unidadesconsumidoras')
        ->where([
                ['status', '=', 'Ativo']
        ])
        ->get();

        foreach($registros as $registro) {
            $res=0;
            if($registro->cod_medidor  == 'ENEL62L22FUNDOS'){
                $res = DB::table('leituras')
                    ->where([
                        ['cod_medidor', '=', $registro->cod_medidor ]
                    ])
                    ->max('posicao');
                $res=$res+82;
            }
            if($registro->cod_medidor  == 'ENEL62L22FRENTE'){
                $res = DB::table('leituras')
                    ->where([
                        ['cod_medidor', '=', $registro->cod_medidor ]
                    ])
                    ->max('posicao');
                $res=$res+45;
                //          SELECT max(posicao)+72 FROM leituras where cod_medidor = '04128172';
            }
//            dd($registro->cod_medidor, $res);

            if($registro->cod_medidor  == 'Y19162L22FUNDOS'){
                $res = DB::table('leituras')
                    ->where([
                        ['cod_medidor', '=', $registro->cod_medidor ]
                    ])
                    ->max('posicao');
                $res=$res + 5.5;
            }

            if($registro->cod_medidor  == 'Y19162L22FRENTE'){
                $res = DB::table('leituras')
                    ->where([
                        ['cod_medidor', '=', $registro->cod_medidor ]
                    ])
                    ->max('posicao');
                $res=$res+9;
            }
            $leitura = new Leitura;
            $leitura->cod_medidor  = $registro->cod_medidor;
            $leitura->posicao  = $res;
            $leitura->tipo_concessionaria  = $registro->tipo_concessionaria;
//            dd($registro->cod_medidor, $res,$leitura);
            $leitura->save();
        }
        return redirect()-> route('concessionarias.leituras');
    }


    public function search (Request $request)
    {
        $dados = $request->all();
        $registros = DB::table('unidadesconsumidoras')
            ->where([
                    ['tipo_concessionaria', '=', $dados['tipo_concessionaria']]
            ])
            ->where([
                    ['status', '=', $dados['status']]
            ])
            ->where([
                ['pessoa_cpfcnpj', 'like', '%' . trim($dados['search']) . '%']

            ])
            ->paginate(15);
            //var_dump($registros);
            return view('concessionarias.index', compact('registros'));
    }

    public function destroyContas($id) {

        $registro = UnidadeConsumidora::find($id);
        $dirimagempath ='img/concessionariasContas/'.$id.'/';

        if(is_dir($dirimagempath)){
            $imagens = glob($dirimagempath . "*.*"); //obter todas imagens do diretório
            if($imagens){
                foreach($imagens as $imagem){
                    unlink($imagem); // remove todas imagens
                }
            }
            rmdir($dirimagempath);  //remove o diretorio
            $registro->delete(); //remove o arquivo

        }else{
            $registro->delete(); //remove o arquivo
        }
        \Session::flash('mensagem',['msg'=>'Registro deletado com sucesso!'
        ,'class'=>'green white-text']);

        return redirect()->route('concessionarias');
    }

    public function atualizarContas (Request $request, $id) {

        $registro = UnidadeConsumidora::find($id);
        $dados = $request->all();
        $registro->cod_medidor = $dados['cod_medidor'];
        $registro->tipo_concessionaria = $dados['tipo_concessionaria'];
        $registro->descricao = $dados['descricao'];
        $registro->status = $dados['status'];
        $registro->cep = $dados['cep'];
        $registro->estado = $dados['uf'];
        $registro->cidade = $dados['cidade'];
        $registro->bairro = $dados['bairro'];
        $registro->logradouro = $dados['rua'];
        $registro->numero = $dados['numero'];
        $registro->complemento = $dados['complemento'];
        $registro->tipo = $dados['tipo'];
        $registro->pessoa_cpfcnpj = $dados['pessoa_cpfcnpj'];

        $file = $request->file('imagem');
        if($file) {
            $rand = rand(11111,99999);
            $diretorio = "img/concessionariasContas/".$id."/";
            $ext = $file->guessClientExtension();
            $nomeArquivo = "_img_".$rand.".".$ext;
            $file->move($diretorio,$nomeArquivo);
            $registro->imagem = $diretorio.$nomeArquivo;
        }

        $registro->update();
        \Session::flash('mensagem',['msg'=>'Registro Atualizado com sucesso!'
        ,'class'=>'green white-text']);

        return redirect()->route('concessionarias');
    }

    public function editContas($id) {
        $registro = UnidadeConsumidora::find($id);
        return view('concessionarias.contas.editarContas',compact('registro'));
    }

    public function salvarContas(Request $request ){
        $dados = $request->all();
//        $pessoa_cpfcnpj = DB::table('pessoas')
//            ->select(
//                'pessoas.cpf_cnpj'
//            )
//            ->where([['cpf_cnpj', '=',$dados['pessoa_cpfcnpj']]])
//         ->first();
//        if($pessoa_cpfcnpj )
            if($dados['pessoa_cpfcnpj'] )
        {

            $registro = new UnidadeConsumidora();
            $registro->cod_medidor = $dados['cod_medidor'];
            $registro->tipo_concessionaria = $dados['tipo_concessionaria'];
            $registro->descricao = $dados['descricao'];
            $registro->status = $dados['status'];
            $registro->cep = $dados['cep'];
            $registro->estado = $dados['uf'];
            $registro->cidade = $dados['cidade'];
            $registro->bairro = $dados['bairro'];
            $registro->logradouro = $dados['rua'];
            $registro->numero = $dados['numero'];
            $registro->complemento = $dados['complemento'];
            $registro->tipo = $dados['tipo'];
            $registro->pessoa_cpfcnpj = $dados['pessoa_cpfcnpj'];

            $registro->save();

            $file = $request->file('imagem');
            if($file) {
                $rand = rand(11111,99999);
                $diretorio = "img/concessionariasContas/".$registro->id."/"; //o eloquent recupera automaticamente o id inserido para o registro
                $ext = $file->guessClientExtension();
                $nomeArquivo = "_img_".$rand.".".$ext;
                $file->move($diretorio,$nomeArquivo);
                $registro->imagem = $diretorio.$nomeArquivo;
            }
            $registro->update();

            \Session::flash('mensagem',['msg'=>'Registro criado com sucesso!'
            ,'class'=>'green white-text']);

        }else{
            \Session::flash('mensagem',['msg'=>'Registro não criado Pessoa do CPF/CNPJ não existe! '
            ,'class'=>'red white-text']);
        }

        return redirect()->route('concessionarias');
    }

    public function adicionarContas()
    {
        return view('concessionarias.contas.adicionarContas');
    }

    public function index()
    {
        $registros = DB::table('unidadesconsumidoras')
        ->paginate(15);
        return view('concessionarias.index', compact('registros'));

    }

}
