<?php

namespace App\Http\Controllers\Concessionarias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Concessionarias\Leitura;
use App\Models\Concessionarias\Fatura;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use PDF;

class ConcessionariasFaturamentoController extends Controller {

    public function recebimentoFatura($id)
    {
         $registro = Fatura::find($id);
         $registro->status_fatura =  'Pago';
         $registro->data_pagamento =  Carbon::now();
         $registro->update();

         \Session::flash('mensagem',['msg'=>'Fatura Recebida com sucesso!'
         ,'class'=>'green white-text']);

         $registros = DB::table('unidadesconsumidoras')
             ->join('faturas', 'faturas.cod_medidor', '=', 'unidadesconsumidoras.cod_medidor')
             ->select(
                 'unidadesconsumidoras.*',
                 'faturas.*'
             )
             ->where([['faturas.status_fatura', '=', 'Pendente']])
             ->orderBy('data_vencimento' ,'asc')
         ->paginate(15);

        return view('concessionarias.faturamento.index', compact('registros'));
    }


    public function destroyFatura($id)
    {
        $registro = Fatura::find($id);

        //preservaaleitura
        Leitura::where('cod_medidor', $registro->cod_medidor)
            ->where('data', $registro->dataLeituraAtual)
        ->update(['status' => 'Pendente']);

        // deleta apenas a fatura
        $registro->delete();

        \Session::flash('mensagem',['msg'=>'Registro deletado com sucesso!'
        ,'class'=>'green white-text']);

        $registros = DB::table('unidadesconsumidoras')
            ->join('faturas', 'faturas.cod_medidor', '=', 'unidadesconsumidoras.cod_medidor')
            ->select(
                'unidadesconsumidoras.*',
                'faturas.*'
               )
            ->where([['faturas.status_fatura', '=', 'Pendente']])
            ->orderBy('data_vencimento' ,'asc')
        ->paginate(15);

        return view('concessionarias.faturamento.index', compact('registros'));
    }

    public function createPDF($id)
    {
        $time='180';
        $size='1024M';
        ini_set('upload_max_filesize', $size);
        ini_set('post_max_size', $size);
        ini_set('max_input_time', $time);
        ini_set('max_execution_time', $time);

        $registro = DB::table('unidadesconsumidoras')
            ->join('faturas', 'faturas.cod_medidor', '=', 'unidadesconsumidoras.cod_medidor')
            ->select(
                'unidadesconsumidoras.*',
                        'faturas.*'
                )
            ->where([['faturas.id', '=', $id]])
        ->first();

        $pdf = PDF::loadView('concessionarias.faturamento.pdffatura',compact('registro'));
        // download PDF file with download method
       // return $pdf->download('papelTrabalho.pdf');
        return $pdf->setPaper('a4')->stream('Conta de '.$registro->tipo_concessionaria);
    }

    public function receberFatura (Request $request, $id)
    {
        $registro = Fatura::find($id);
        $dados = $request->all();

        if(!$dados['data_pagamento'] == null)
        {
            $registro->status_fatura =  'Pago';
            $registro->data_pagamento =  $dados['data_pagamento'];
            $registro->update();
        }
        else
        {
            \Session::flash('mensagem',['msg'=>'Conta não foi Recebida  !'
                            ,'class'=>'red white-text']);
            return back();
        }

        \Session::flash('mensagem',['msg'=>'Recebido com sucesso !'
                  ,'class'=>'green white-text']);

        $registros = DB::table('unidadesconsumidoras')
            ->join('faturas', 'faturas.cod_medidor', '=', 'unidadesconsumidoras.cod_medidor')
            ->select(
                'unidadesconsumidoras.*',
                'faturas.*'

                )
            ->where([['faturas.status_fatura', '=', 'Pendente']])
            ->orderBy('data_vencimento' ,'asc')
        ->paginate(15);
        return view('concessionarias.faturamento.index', compact('registros'));
    }

    public function imprimirFatura($id)
    {
        $registro = DB::table('unidadesconsumidoras')
            ->join('faturas', 'faturas.cod_medidor', '=', 'unidadesconsumidoras.cod_medidor')
            ->select(
                'unidadesconsumidoras.*',
                        'faturas.*'
                 )
            ->where([['faturas.id', '=', $id]])
        ->first();
        return view('concessionarias.faturamento.imprimirFatura', compact('registro'));
    }

    public function searchFaturas (Request $request)
    {
        $dados = $request->all();

        if (
               ( $dados['status_fatura'] == '00')
            && ($dados['tipo_concessionaria'] == '00')
            && ($dados['cod_medidor'] == null)
            && ($dados['descricao'] == null)
        )
        {
            $registros = DB::table('unidadesconsumidoras')
                ->join('faturas', 'faturas.cod_medidor', '=', 'unidadesconsumidoras.cod_medidor')
                ->select(
                    'unidadesconsumidoras.*',
                    'faturas.*'
                )
                ->where([['faturas.status_fatura', '=', 'Pendente']])
                ->orderBy('data_vencimento' ,'desc')
            ->paginate(15);

        }
        if (
            (! $dados['status_fatura'] <> '00')
            && ($dados['tipo_concessionaria'] == '00')
            && ($dados['cod_medidor'] == null)
            && ($dados['descricao'] == null)
        ) // por status fatura
        {
            $registros = DB::table('unidadesconsumidoras')
                ->join('faturas', 'faturas.cod_medidor', '=', 'unidadesconsumidoras.cod_medidor')
                ->select(
                    'unidadesconsumidoras.*',
                    'faturas.*'
                )
                ->where([['faturas.status_fatura', '=', $dados['status_fatura']]])
                //         ->where([['unidadesconsumidoras.descricao', 'like', '%' . trim($dados['descricao']. '%') ]])
                ->orderBy('data_vencimento' ,'desc')
                ->paginate(15);
        }


        if (
            ( ! $dados['status_fatura'] <> '00')
            && ( ! $dados['tipo_concessionaria'] <> '00')
            && ( $dados['cod_medidor'] == null)
            && ($dados['descricao'] == null)
        ) // por tipo de concessionaria e status fatura
        {
           // dd('afffff', $dados);
            $registros = DB::table('unidadesconsumidoras')
                ->join('faturas', 'faturas.cod_medidor', '=', 'unidadesconsumidoras.cod_medidor')
                ->select(
                    'unidadesconsumidoras.*',
                    'faturas.*'
                )
                ->where([['status_fatura', '=', $dados['status_fatura']]])
                ->where([['tipo_concessionaria', '=', $dados['tipo_concessionaria']]])
                //       ->where([['unidadesconsumidoras.descricao', 'like', '%' . trim($dados['descricao']. '%') ]])
                ->orderBy('data_vencimento' ,'desc')
                ->paginate(15);
        }


        if (
            (  $dados['status_fatura'] == '00')
            && ( ! $dados['tipo_concessionaria'] <> '00')
            && ( $dados['cod_medidor'] == null)
            && ($dados['descricao'] == null)
        ) // por tipo de concessionaria
        {
            // dd('afffff', $dados);
            $registros = DB::table('unidadesconsumidoras')
                ->join('faturas', 'faturas.cod_medidor', '=', 'unidadesconsumidoras.cod_medidor')
                ->select(
                    'unidadesconsumidoras.*',
                    'faturas.*'
                )
                //->where([['status_fatura', '=', $dados['status_fatura']]])
                ->where([['tipo_concessionaria', '=', $dados['tipo_concessionaria']]])
                //       ->where([['unidadesconsumidoras.descricao', 'like', '%' . trim($dados['descricao']. '%') ]])
                ->orderBy('data_vencimento' ,'desc')
                ->paginate(15);
        }
        if (
            ( $dados['status_fatura'] = '00')
            && ( $dados['tipo_concessionaria'] == '00')
            && (! $dados['cod_medidor'] == null)
            && ($dados['descricao'] == null)
        ) // por codigo do medidor
        {
            //  dd('aki');
            $registros = DB::table('unidadesconsumidoras')
                ->join('faturas', 'faturas.cod_medidor', '=', 'unidadesconsumidoras.cod_medidor')
                ->select(
                    'unidadesconsumidoras.*',
                    'faturas.*'
                )
                ->where([['faturas.cod_medidor', '=', $dados['cod_medidor']]])
                //     ->where([['unidadesconsumidoras.descricao', 'like', '%' . trim($dados['descricao']. '%') ]])
                ->orderBy('data_vencimento' ,'desc')
                ->paginate(15);
        }
        if (
            ( $dados['status_fatura'] = '00')
            && ( $dados['tipo_concessionaria'] = '00')
            && ( $dados['cod_medidor'] == null)
            && ( ! $dados['descricao'] == null)
        ) // por descrição
        {
         //    dd('dddddddddddddaki', $dados);
            $registros = DB::table('unidadesconsumidoras')
                ->join('faturas', 'faturas.cod_medidor', '=', 'unidadesconsumidoras.cod_medidor')
                ->select(
                    'unidadesconsumidoras.*',
                    'faturas.*'
                )
                //   ->where([['tipo_concessionaria', '=', $dados['tipo_concessionaria']]])
                ->where([['faturas.status_fatura', '=', 'Pendente']])
                ->where([['unidadesconsumidoras.descricao', 'like', '%' . trim($dados['descricao']. '%') ]])
                ->orderBy('data_vencimento' ,'desc')
                ->paginate(15);
        }


 //       dd('dddddddddddddaki', $dados);


        if(! $registros->isEmpty())
        {
            return view('concessionarias.faturamento.index', compact('registros'));
        }
    }

    public function index()
    {
        $row=0;
        $count=0;
        $faturamentos = DB::table('unidadesconsumidoras')
            ->join('leituras', 'unidadesconsumidoras.cod_medidor', '=', 'leituras.cod_medidor')
            ->select(
                    'unidadesconsumidoras.*',
                    'leituras.*'
                )
            ->where([['leituras.status', '=', 'Pendente']]) // Faturado   Pendente
            ->where([['leituras.data', '!=', null]])
        ->get();
        if(! $faturamentos->isEmpty())
        {
            $count = $faturamentos->count('cod_medidor');
        }

        if($count >= 1){
            foreach($faturamentos as $faturamento)
            {
                $faturamentoAnterior = DB::table('leituras')
                   ->select('leituras.*')
                   ->where([['cod_medidor', '=', $faturamento->cod_medidor ]])
                   ->where([['status', '=', 'Faturado' ]])
                   ->where([['data', '<', $faturamento->data ]])
                   ->orderBy('data','desc')
                ->first();

                if(! Empty($faturamentoAnterior->data))
                {
                    $dataLeituraAnterior = Carbon::parse($faturamentoAnterior->data);
                }
                else
                {
                    $dataLeituraAnterior = Carbon::parse($faturamento->data);
                }

             //   $dataLeituraAtual = Carbon::parse($faturamento->data);
                $vencimento = Carbon::parse($faturamento->data);
                $vencimento = $vencimento->addDays(5)->format('Y-m-d');

                $tarifa = DB::table('tarifas')
                    ->where([['tipo_concessionaria', '=', $faturamento->tipo_concessionaria ]])
                    ->where([['tipo_consumidor', '=', $faturamento->tipo ]])
                    ->orderBy('vigencia' ,'desc')
                ->first();

               // dd('aki    ttt   ',$faturamento->rateio_custo_fixo);
             // dd('aki',$tarifa->custo_fixo);


                $rateio_custo_fixo =  $tarifa->custo_fixo  / $faturamento->rateio_custo_fixo;
                $rateio_desconto =  $tarifa->custo_fixo -    $rateio_custo_fixo;
//                dd($faturamento->posicao);

                if( ! empty($faturamentoAnterior->posicao) ){
                    $consumo = $faturamento->posicao - $faturamentoAnterior->posicao;
                    $faturamentoAnteriorposicao =  $faturamentoAnterior->posicao;
                }
                else{
                    $consumo = $faturamento->posicao;
                    $faturamentoAnteriorposicao =  $consumo;
                }

                if( ! empty($faturamentoAnterior->data) ){
                    $periodo = CarbonPeriod::create($faturamentoAnterior->data ,  $faturamento->data );
                    $dias = $periodo->count();
                }
                else{
//                    $periodo = CarbonPeriod::create($faturamentoAnterior->data ,  $faturamento->data );
                    $dias = 30;
                }


                //$total = ($consumo * $tarifa->custo_unitario)  + ($consumo * $tarifa->custo_adicional) + $rateio_custo_fixo  ;

               $dado = Fatura::create([
                    'cod_medidor' => $faturamento->cod_medidor,
                    'status_fatura' => 'Pendente',
                    'dataLeituraAtual' => $faturamento->data,
                    'posicaoLeituraAtual' => $faturamento->posicao,
                    'custo_fixo' => $tarifa->custo_fixo,
                    'custo_unitario' => $tarifa->custo_unitario,
                    'vigencia_tarifa' => $tarifa->vigencia,
                    'dataLeituraAnterior' => $dataLeituraAnterior,
                    'posicaoLeituraAnterior' => $faturamentoAnteriorposicao,
                    'dias' => $dias,
                    'consumo' => $consumo,
                    'valor_consumo' => $consumo *   $tarifa->custo_unitario,
                    'rateio_fixo' => $rateio_custo_fixo,
                    'total_abatimento' =>$rateio_desconto,
                    'data_vencimento' => $vencimento,
                    'imagem' => $faturamento->imagem,
                    'tipo_custo_adicional' => $tarifa->tipo_custo_adicional,
                    'custo_adicional' => $consumo * $tarifa->custo_adicional,
                ]);
                  if( $dado->id >=1)
                  {
                      Leitura::where('cod_medidor', $faturamento->cod_medidor)
                          ->where('data', $faturamento->data)
                          ->update(['status' => 'Faturado']);
                      $row++;
                  }
              }
            \Session::flash('mensagem',['msg'=>'Foram Geradas '.$count.' Novas Faturas'
            ,'class'=>'green white-text']);
        }
        $registros = DB::table('unidadesconsumidoras')
            ->join('faturas', 'faturas.cod_medidor', '=', 'unidadesconsumidoras.cod_medidor')
            ->select(
                 'unidadesconsumidoras.*',
                'faturas.*'
            )
            ->where([['faturas.status_fatura', '=', 'Pendente']])
            ->orderBy('data_vencimento' ,'desc')
        ->paginate(15);

            //  SELECT * FROM unidadesconsumidoras u, faturas f where u.cod_medidor = f.cod_medidor and status_fatura ='pendente' and descricao = 'sarah'
            // dd( '728' ,$registros);

        return view('concessionarias.faturamento.index', compact('registros'));

    }
}


//echo '<br> cod_medidor => '. $faturamento->cod_medidor;
//echo   '<br>status_fatura =>' . 'Pendente';
//echo  '<br>posicaoLeituraAtual =>' . $faturamento->posicao;
//echo '<br>custo_fixo =>' . $tarifa->custo_fixo;
//echo  '<br>custo_unitario =>' . $tarifa->custo_unitario;
//echo'<br>vigencia_tarifa =>' . $tarifa->vigencia;
//echo  '<br>dataLeituraAnterior =>' . $dataLeituraAnterior;
//echo  '<br>posicaoLeituraAnterior =>' . $faturamentoAnterior->posicao;
//echo  '<br>dias => ' . $dias;
//echo '<br>consumo =>' . $consumo;
//echo '<br>valor_consumo =>' . $consumo *   $tarifa->custo_unitario;
//echo '<br>rateio_fixo =>' . $rateio_custo_fixo;
//echo '<br>tipo_custo_adicional =>' . $tarifa->tipo_custo_adicional ;
//echo '<br>custo_adicional =>' . $consumo * $tarifa->custo_adicional ;
//echo '<br>total a pagar  =>' .  $total ;
//echo '<br>total_abatimento =>' .$rateio_desconto;
//echo '<br>data_vencimento =>' . $vencimento;
//dd();
