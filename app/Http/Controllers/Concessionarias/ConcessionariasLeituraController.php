<?php

namespace App\Http\Controllers\Concessionarias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Concessionarias\Leitura;
use Auth;

class ConcessionariasLeituraController extends Controller
{

    public function destroyLeituras($id) {

        $registro = Leitura::find($id);

     //   $dirimagempath ='img/concessionariasContas/'.$id.'/';
        $dirimagempath = "img/concessionariasLeituras/".$registro->cod_medidor."/";
//dd($dirimagempath);
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

        return redirect()->route('concessionarias.leituras');

    }


    public function atualizarLeituras (Request $request, $id) {

        $registro = Leitura::find($id);
        $dados = $request->all();

        $registro->cod_medidor = $dados['cod_medidor'];
        $registro->tipo_concessionaria = $dados['tipo_concessionaria'];
        $registro->posicao = $dados['posicao'];

        if($dados['data'] == null){
            $registro->data = now();
        }else{
            $registro->data = $dados['data'];
        }


        $registro->user = Auth::user()->name;

        $file = $request->file('imagem');
        if($file) {
            $rand = rand(11111,99999);
            $diretorio = "img/concessionariasLeituras/".$registro->cod_medidor."/";
            $ext = $file->guessClientExtension();
            $nomeArquivo = "_img_".$rand.".".$ext;
            $file->move($diretorio,$nomeArquivo);
            $registro->imagem = $diretorio.$nomeArquivo;
        }

        $registro->update();
        \Session::flash('mensagem',['msg'=>'Registro Atualizado com sucesso!'
        ,'class'=>'green white-text']);

        return redirect()->route('concessionarias.leituras');
    }


    public function editLeituras($id) {
        $registro = Leitura::find($id);

        return view('concessionarias.leituras.editarLeitura',compact('registro'));
    }

    public function searchLeituras (Request $request)
    {
        $dados = $request->all();

        if ($dados['cod_medidor']==null){
           // $registros = DB::table('leituras')
            $registros = DB::table('unidadesconsumidoras')
            ->join('leituras', 'unidadesconsumidoras.cod_medidor', '=', 'leituras.cod_medidor')
            ->select(
               'unidadesconsumidoras.descricao',
                'leituras.*'
            )

            ->where([
                ['leituras.tipo_concessionaria', '=', $dados['tipo_concessionaria']]
            ])
            ->paginate(15);
        }else {

            //$registros = DB::table('leituras')

            $registros = DB::table('unidadesconsumidoras')
            ->join('leituras', 'unidadesconsumidoras.cod_medidor', '=', 'leituras.cod_medidor')
            ->select(
               'unidadesconsumidoras.descricao',
                'leituras.*'
            )
            ->where([
                ['leituras.tipo_concessionaria', '=', $dados['tipo_concessionaria']]
            ])
            ->where([
                ['leituras.cod_medidor', '=', $dados['cod_medidor']]
            ])

            ->paginate(15);
        }

        return view('concessionarias.leituras.index', compact('registros'));

    }

    public function index()
    {

       $registros = DB::table('unidadesconsumidoras')
       ->join('leituras', 'unidadesconsumidoras.cod_medidor', '=', 'leituras.cod_medidor')
       ->select(
          'unidadesconsumidoras.descricao',
           'leituras.*'
       )
       ->where([
            ['leituras.data', '=', null ]
       ])
          // ->first();
           ->paginate(15);



        return view('concessionarias.leituras.index', compact('registros'));
    }
}
