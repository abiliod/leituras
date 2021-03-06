@extends('layouts._gynPromo.app')

@section('content')
<div class="container">
<h2 class="center">Importações Disponíveis</h2>

<div class="row">
     <nav>
        <div class="nav-wrapper green">
              <div class="col s12">
                <a href="{{ route('home')}}" class="breadcrumb">Início</a>
                <a class="breadcrumb">Compliance Importações</a>
              </div>
        </div>
      </nav>
</div>

<div class="row">

    <div class="col s12 m6">
        <div class="card green darken-1">
            <div class="card-content white-text">
                <span class="card-title">Unidades</span>
                <p>Unidades<br>Assunto: Atualização da Base de Unidades.</p>
                <p>Relatório ERP | R55001A.xlsx  FULL</p>
                <p><b>Modo Update</b>Mantem cadastro nacional</p>
            </div>
            <div class="card-action">
                <a class="white-text" href="{{route('importacao.unidades')}}">Importar Planilha</a>
            </div>
        </div>
    </div>

    <div class="col s12 m6">
        <div class="card #004d40 teal darken-4">
            <div class="card-content white-text">
                <span class="card-title">Cadastral</span>
                <p>Cadastral<br>Assunto: Auxiliar do Sistema.</p>
                <p>Relatório Cadastral fornecido pela SE | Cadastral.xlsx</p>
                <p><b>Modo Truncate</b> necessita ajuste para aderencia Nacional</p>
            </div>
            <div class="card-action">
                <a class="white-text" href="{{route('importacao.cadastral')}}">Importar Planilha</a>
            </div>
        </div>
    </div>

    <div class="col s12 m6">
        <div class="card blue darken-1">
        <div class="card-content white-text">
            <span class="card-title">Feriados</span>
            <p><br>Relatório Feriado ERP | Feriado.xlsx</p> <br>
            <p><b>Modo Truncate</b> necessita ajuste para aderencia Nacional</p>
        </div>
        <div class="card-action">
            <a class="white-text" href="{{route('importacao.feriado')}}">Importar Planilha</a>
        </div>
        </div>
    </div>


    <div class="col s12 m6">
        <div class="card   orange darken-1">
        <div class="card-content white-text">
            <span class="card-title">Sistema WebCont</span>
            <p>Grupo de Verificação 270, Função Prevenção de Perdas.</p>
            <tr>
                <p>Assunto: Débito de Empregado: WebCont | 270-1-FINANCEIRO-WebCont_DebitoEmpregado.xlsx</p>
                <p><b>Modo Truncate</b> necessita ajuste para aderencia Nacional</p>
            </tr>

        </div>
        <div class="card-action">
            <a class="white-text" href="{{route('importacao.webcont')}}">Importar Planilha</a>
        </div>
        </div>
    </div>

    <div class="col s12 m6">
        <div class="card #0d47a1 blue darken-4">
            <div class="card-content white-text">
                <span class="card-title">Sistema Proter</span>
                <p>Grupo de Verificação 270, Função Prevenção de Perdas.</p>
                  <tr>
                    <p>Assunto: Proteção de Receitas. PROTER | 270-2-FINANCEIRO-Proter_ProtecaoReceita.xlsx</p>
                    <p><b>Modo Truncate</b> Talvez necessita ajuste para aderencia Nacional</p>
                </tr>

            </div>
            <div class="card-action">
                <a class="white-text" href="{{route('importacao.proter')}}">Importar Planilha</a>
            </div>
        </div>
    </div>

    <div class="col s12 m6">
        <div class="card #424242 grey darken-3">
        <div class="card-content white-text">
            <span class="card-title">Sistema de Depósito Bancário</span>
            <p>Grupo de Verificação 270, Função Prevenção de Perdas.</p> <b/>
            <tr>
                <p>Assunto: Integridade de Depósitos Bancários. SMB - BDF | 270-3-FINANCEIRO-SMB_ BDF_DepositosNaoConciliados.xlsx</p>
                <p><b>Modo Icremento</b></p>
            </tr>
        </div>
        <div class="card-action">
            <a class="white-text" href="{{route('importacao.smb_bdf')}}">Importar Planilha</a>
        </div>
        </div>
    </div>

    <div class="col s12 m6">
        <div class="card #b71c1c red darken-4">
        <div class="card-content white-text">
            <span class="card-title">Gestão de Numerário</span>
            <p>Grupo de Verificação 270, Função Prevenção de Perdas.</p>
            <b/>
            <tr>
                <p>Assunto: Saldo que passa | 270-4-FINANCEIRO-SLD02_BDF_LimiteEncaixe.xlsx</p>
                <p><b>Modo Icremento</b></p>
            </tr>
        </div>
        <div class="card-action">
            <a class="white-text" href="{{route('importacao.SL02_bdf')}}">Importar Planilha</a>
        </div>
        </div>
    </div>

    <div class="col s12 m6">
        <div class="card #dd2c00 deep-orange accent-4">
            <div class="card-content white-text">
                <span class="card-title">Segurança Postal</span>
                <p>Grupo de Verificação 271, Função: Processos Administrativos <br>Assunto: Responsabilidade Definida.</p>
                <p>Atualização Sazional</p>
            </div>
            <div class="card-action">
                <a class="white-text" href="{{route('importacao.RespDefinida')}}">Importar Planilha</a>
            </div>
        </div>
    </div>

    <div class="col s12 m6">
        <div class="card blue darken-1">
            <div class="card-content white-text">
                <span class="card-title">Sistema de Alarme</span>
                <p>Grupo de Verificação 272, Alarme Monitorado.</p>
                <tr>
                    <p>Assunto: Ativação / Desativação | 272-2-SEGURANÇA-SistemaMonitoramento.xlsx</p>
                    <p><b>Modo Icremento</b></p>
                </tr>
            </div>
            <div class="card-action">
                <a class="white-text" href="{{route('importacao.alarme')}}">Importar Planilha</a>
            </div>
        </div>
    </div>

    <div class="col s12 m6">
        <div class="card #0d47a1 blue darken-4">
            <div class="card-content white-text">
                <span class="card-title">Sistema Segurança</span>
                <p>Grupo de Verificação 272, Senhas Alarme Monitorado.</p>
                <tr>
                    <p>Assunto: Verif. Compart. de Senhas | 272-3-WebSGQ3 - Frequencia por SE.xlsx</p>
                    <p><b>Modo Icremento</b></p>
                </tr>
            </div>
            <div class="card-action">
                <a class="white-text" href="{{route('importacao.absenteismo')}}">Importar Planilha</a>
            </div>
        </div>
    </div>

    <div class="col s12 m6">
        <div class="card #b71c1c red darken-4">
           <div class="card-content white-text">
                <span class="card-title">Sistema Segurança Patrimonial</span>
                <p>Grupo/Item: 272.4, Função: Verif. Funcionamento do equipamento CFTV
                 <br>Arquivo: 272-4-SEGURANÇA-Monitoramento-CFTV</p>
           </div>
        <div class="card-action">
            <a class="white-text" href="{{route('importacao.cftv')}}">Importar Planilha</a>
        </div>
        </div>
    </div>

    <div class="col s12 m6">
        <div class="card deep-orange">
        <div class="card-content white-text">
                <span class="card-title">Sistema Segurança</span>
                <p>Grupo/Item: 272.3, Função: Verif. Compart. de Senhas - FÉRIAS <br>Arquivo: 272-3-WebSGQ3 - Fruicao de ferias por MCU</p>
        </div>
        <div class="card-action">
            <a class="white-text" href="{{route('importacao.ferias')}}">Importar Planilha</a>
        </div>
        </div>
    </div>

    <div class="col s12 m6">
        <div class="card deep-purple">

            <div class="card-content white-text">
                <span class="card-title">Sistema: Atendimento Comercial</span>
               <br/> <p>Grupo/Item: 274.1, Função: Condições de Aceitação, Classificação e Tarifação de Objetos
                 <br>Arquivo: 274-1-PLP-ListasPendentes</p>
           </div>
            <div class="card-action">
                <a class="white-text" href="{{route('importacao.plpListaPendente')}}">Importar Planilha</a>
            </div>
        </div>
    </div>


    <div class="col s12 m6">
        <div class="card #424242 grey darken-3">
        <div class="card-content white-text">
        <span class="card-title">Sistema: Movimentação de Carga Postal</span>
                <p>Grupo/Item: 276.1, Função: Controle de viagem Apontamentos
                 <br>Arquivo: 276-1-ControleDeViagem</p>
        </div>
        <div class="card-action">
            <a class="white-text" href="{{route('importacao.controleDeViagem')}}">Importar Planilha</a>
        </div>
        </div>
    </div>

    <div class="col s12 m6">
        <div class="card green darken-1">
        <div class="card-content white-text">
        <span class="card-title">Sistema: Distribuição Domiciliária <br>SGDO</span>
                <p>Grupo/Item: 277.1, Função: Lançamentos SGDO
                <br>Lançamentos obrigatórios
                 <br>Arquivo: 277-1-SGDO-Distribuição</p>
        </div>
        <div class="card-action">
            <a class="white-text" href="{{route('importacao.sgdoDistribuicao')}}">Importar Planilha</a>
        </div>
        </div>
    </div>

    <div class="col s12 m6">
        <div class="card #b71c1c red darken-4">
        <div class="card-content white-text">
        <span class="card-title">Sistema: Distribuição Domiciliária <br>Pré Alerta</span>
                <p>Grupo/Item: 277.5, Função: Gestão SRO
                <br>Conferência Eletrônica.
                 <br>Arquivo: 277-5-PainelExtravio</p>
        </div>
        <div class="card-action">
            <a class="white-text" href="{{route('importacao.painelExtravio')}}">Importar Planilha</a>
        </div>
        </div>
    </div>


    <div class="col s12 m6">
        <div class="card #0d47a1 blue darken-4">
        <div class="card-content white-text">
        <span class="card-title">Sistema: Plano de Triagem <br>Encaminhamento</span>
                <p>Grupo/Item: 277.7, Função: Gestão SRO
                <br>Mensagens.
                 <br>Arquivo: 277-7-CieEletronica</p>
        </div>
        <div class="card-action">
            <a class="white-text" href="{{route('importacao.cieEletronica')}}">Importar Planilha</a>
        </div>
        </div>
    </div>

    <div class="col s12 m6">
        <div class="card #004d40 teal darken-4">
        <div class="card-content white-text">
        <span class="card-title">Sistema: Gestão de Recursos Humanos <br>Recebimentos</span>
                <p>Grupo/Item: 278.2, Função: Gestão de Recursos Humanos

                 <br>Arquivo: 278-2-WebSGQ-3-PagamentosAdicionais</p>
        </div>
        <div class="card-action">
            <a class="white-text" href="{{route('importacao.pagamentosAdicionais')}}">Importar Planilha</a>
        </div>
        </div>
    </div>

    <div class="col s12 m6">
        <div class="card #dd2c00 deep-orange accent-4">
            <div class="card-content white-text">
            <span class="card-title">Sistema: Gestão de Recursos Humanos </span>
                <p>Grupo/Item: 278.2, Função: Recebimentos
                 Arquivo: 278-2-BDF_FAT_02.xlsx - Unidades que irão ser inspecionadas ultimos 210 dias.</p>
            </div>
            <div class="card-action">
                <a class="white-text" href="{{route('importacao.bdf_fat_02')}}">Importar Planilha</a>
            </div>
        </div>
    </div>

    <div class="col s12 m6">
        <div class="card  #424242 grey darken-3">
            <div class="card-content white-text">
            <span class="card-title">Sistema: Gestão da Distribuição Domiciliaria</span>
                 <p>Grupo/Item: 277.2, Função: Gestão de Recursos SRO
                 <br>Arquivo: 277-2-4_3-ObjetosNaoEntreguePrimeiraTentativa</p>
            </div>
            <div class="card-action">
                <a class="white-text" href="{{route('importacao.microStrategy')}}">Importar Planilha</a>
            </div>
        </div>
    </div>


</div>
@endsection
