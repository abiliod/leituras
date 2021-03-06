<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('principal/welcome');
});

Route::get('/sobre', 'Site\PaginaController@sobre')->name('site.sobre');
Route::get('/contato', 'Site\PaginaController@contato')->name('site.contato');
Route::put('/contato/enviar', 'Site\PaginaController@enviarContato')->name('site.contato.enviar');

Auth::routes();

Route::get('/principal/home', 'HomeController@index')->name('home');
Route::get('/sair', 'Admin\UsuarioController@sair')->name('sair');

Route::get('/admin/cidades/deletar/{id}', 'Cidades\CidadeController@deletar')->name('admin.cidades.deletar');
Route::get('/admin/cidades', 'Cidades\CidadeController@index')->name('admin.cidades');
Route::get('/admin/cidades/editar/{id}', 'Cidades\CidadeController@editar')->name('admin.cidades.editar');
Route::put('/admin/cidades/atualizar/{id}', 'Cidades\CidadeController@atualizar')->name('admin.cidades.atualizar');
Route::get('/admin/cidades/adicionar', 'Cidades\CidadeController@adicionar')->name('admin.cidades.adicionar');
Route::post('/admin/cidades/salvar', 'Cidades\CidadeController@salvar')->name('admin.cidades.salvar');
Route::post('/admin/cidades/{search?}', 'Cidades\CidadeController@search')->name('admin.cidades.search');





Route::get('/admin/pessoas/', 'Pessoas\PessoaController@index')->name('admin.pessoas');
Route::get('/admin/pessoas/entradaCPF_CNPJ/{id}', 'Pessoas\PessoaController@showEntradaCPF_CNPJ')->name('admin.pessoas.entradaCPF_CNPJ');
Route::post('/admin/pessoas/show', 'Pessoas\PessoaController@show')->name('admin.pessoas.show');
Route::delete('/admin/pessoas/deletar/{id}', 'Pessoas\PessoaController@destroy')->name('admin.pessoas.deletar');// deleta o endereco
Route::put('/admin/pessoas/atualizaPessoa', 'Pessoas\PessoaController@atualizaPessoa')->name('admin.pessoas.atualizaPessoa');
Route::get('/admin/pessoas/editarEndereco/{id}', 'Pessoas\PessoaController@edicaoEndereco')->name('admin.pessoas.editarEndereco');
Route::get('/admin/pessoas/adicionarEndereco/{id}', 'Pessoas\PessoaController@adicionarEndereco')->name('admin.pessoas.adicionarEndereco');
Route::delete('/admin/pessoas/deletarEndereco/{id}', 'Pessoas\PessoaController@destroyEndereco')->name('admin.pessoas.deletarEndereco');// deleta o endereco

Route::get('/admin/pessoas/entradaCEP/{id}', 'Pessoas\PessoaController@showEntradaCEP')->name('admin.pessoas.entradaCEP');
//Route::post('/admin/pessoas/buscaCEP', 'Pessoas\PessoaController@showFormBuscaCEP')->name('admin.pessoas.buscaCEP');
Route::get('/admin/pessoas/createEndereco', 'Pessoas\PessoaController@createEndereco')->name('admin.pessoas.createEndereco');
Route::post('/admin/pessoas/enderecoSalvar', 'Pessoas\PessoaController@enderecoSalvar')->name('admin.pessoas.enderecoSalvar');
Route::put('/admin/pessoas/atualizaEndereco', 'Pessoas\PessoaController@atualizaEndereco')->name('admin.pessoas.atualizaEndereco');

Route::get('/admin/pessoas/adicionarPessoa', 'Pessoas\PessoaController@showFormAdicionarPessoa')->name('admin.pessoas.adicionarPessoa');
Route::post('/admin/pessoas/addPessoa', 'Pessoas\PessoaController@addPessoa')->name('admin.pessoas.addPessoa');
Route::post('/admin/pessoas/{search?}', 'Pessoas\PessoaController@search')->name('admin.pessoas.search');


Route::get('/admin/slides', 'Admin\SlideController@index')->name('admin.slides');
Route::get('/admin/slides/adicionar', 'Admin\SlideController@adicionar')->name('admin.slides.adicionar');
Route::post('/admin/slides/salvar', 'Admin\SlideController@salvar')->name('admin.slides.salvar');
Route::get('/admin/slides/editar/{id}', 'Admin\SlideController@editar')->name('admin.slides.editar');
Route::get('/admin/slides/deletar/{id}', 'Admin\SlideController@deletar')->name('admin.slides.deletar');
Route::put('/admin/slides/atualizar/{id}', 'Admin\SlideController@atualizar')->name('admin.slides.atualizar');

//Administando o Autoriza????es para Usu??rios do site
Route::get('/admin/papel', 'Admin\PapelController@index')->name('admin.papel');
Route::get('/admin/papel/adicionar', 'Admin\PapelController@adicionar')->name('admin.papel.adicionar');
Route::post('/admin/papel/salvar', 'Admin\PapelController@salvar')->name('admin.papel.salvar');
Route::get('/admin/papel/editar/{id}', 'Admin\PapelController@editar')->name('admin.papel.editar');
Route::put('/admin/papel/atualizar/{id}', 'Admin\PapelController@atualizar')->name('admin.papel.atualizar');
Route::get('/admin/papel/deletar/{id}', 'Admin\PapelController@deletar')->name('admin.papel.deletar');

//Administando o Permiss??es para Usu??rios do site
Route::get('/admin/papel/permissao/{id}', 'Admin\PapelController@permissao')->name('admin.papel.permissao');
Route::post('/admin/papel/permissao/{id}/salvar', 'Admin\PapelController@salvarPermissao')->name('admin.papel.permissao.salvar');
//Route::post('/admin/papel/permissao/salvar/{id}', 'Admin\PapelController@salvarPermissao')->name('admin.papel.permissao.salvar');
Route::get('/admin/papel/permissao/{id}', 'Admin\PapelController@permissao')->name('admin.papel.permissao');

//Route::get('/admin/papel/permissao/remover/{id}/{id_permissao}','Admin\PapelController@removerPermissao')->name('admin.papel.permissao.remover');
Route::get('/admin/papel/permissao/{id}/remover/{id_permissao}','Admin\PapelController@removerPermissao')->name('admin.papel.permissao.remover');

//Administando o Papeis Usu??rios do site
Route::get('/admin/usuarios/papel/{id}', 'Admin\UsuarioController@papel')->name('admin.usuarios.papel');
Route::post('/admin/usuarios/papel/salvar/{id}', 'Admin\UsuarioController@salvarPapel')->name('admin.usuarios.papel.salvar');
Route::get('/admin/usuarios/papel/remover/{id}/{papel_id}', 'Admin\UsuarioController@removerPapel')->name('admin.usuarios.papel.remover');

//Administando o Usu??rios do site
Route::get('/admin/usuarios', 'Admin\UsuarioController@index')->name('admin.usuarios');
Route::get('/admin/usuarios/adicionar', 'Admin\UsuarioController@adicionar')->name('admin.usuarios.adicionar');
Route::post('/admin/usuarios/salvar', 'Admin\UsuarioController@salvar')->name('admin.usuarios.salvar');
Route::get('/admin/usuarios/editar/{id}', 'Admin\UsuarioController@editar')->name('admin.usuarios.editar');
Route::put('/admin/usuarios/atualizar/{id}', 'Admin\UsuarioController@atualizar')->name('admin.usuarios.atualizar');
Route::get('/admin/usuarios/deletar/{id}', 'Admin\UsuarioController@deletar')->name('admin.usuarios.deletar');
Route::post('/admin/usuarios/{search?}', 'Admin\UsuarioController@search')->name('admin.usuarios.search');

//Administando o paginas do site
Route::get('/admin/paginas', 'Admin\PaginasController@index')->name('admin.paginas');
Route::get('/admin/paginas/editar/{id}', 'Admin\PaginasController@editar')->name('admin.paginas.editar');
Route::put('/admin/paginas/atualizar/{id}', 'Admin\PaginasController@atualizar')->name('admin.paginas.atualizar');

/**
 * inicio Rotas para importa????o de eventos de arme e desarme de alarmes nas unidades
 */
Route::post('/compliance/unidades/salvarVerificacao', 'Correios\UnidadesController@salvarVerificacao')->name('compliance.unidades.salvarVerificacao');
Route::get('/compliance/unidades/gerarVerificacao/{id}', 'Correios\UnidadesController@gerarVerificacao')->name('compliance.unidades.gerarVerificacao');
Route::put('/compliance/unidades/atualizar/{id}','Correios\UnidadesController@atualizar')->name('compliance.unidades.atualizar');
Route::get('/compliance/unidades/editar/{id}', 'Correios\UnidadesController@edit')->name('compliance.unidades.editar');
Route::get('/compliance/unidades', 'Correios\UnidadesController@index')->name('compliance.unidades');
Route::post('/compliance/unidades{id?}', 'Correios\UnidadesController@search')->name('compliance.unidades.search');

Route::get('/compliance/grupoVerificacao/destroy/{id}', 'Correios\GruposDeVerificacaoController@destroy')->name('compliance.grupoVerificacao.destroy');
Route::post('/compliance/grupoVerificacao/salvar', 'Correios\GruposDeVerificacaoController@salvar')->name('compliance.grupoVerificacao.salvar');
Route::get('/compliance/grupoVerificacao/adicionar', 'Correios\GruposDeVerificacaoController@adicionar')->name('compliance.grupoVerificacao.adicionar');
Route::put('/compliance/grupoVerificacao/atualizar/{id}','Correios\GruposDeVerificacaoController@atualizar')->name('compliance.grupoVerificacao.atualizar');
Route::get('/compliance/grupoVerificacao/editar/{id}', 'Correios\GruposDeVerificacaoController@edit')->name('compliance.grupoVerificacao.editar');
Route::get('/compliance/grupoVerificacao/', 'Correios\GruposDeVerificacaoController@index')->name('compliance.grupoVerificacao');
Route::post('/compliance/grupoVerificacao/{search?}', 'Correios\GruposDeVerificacaoController@search')->name('compliance.grupoVerificacao.search');

Route::get('/compliance/relatos/destroy/{id}', 'Correios\RelatoController@destroy')->name('compliance.relatos.destroy');
Route::post('/compliance/relatos/salvar', 'Correios\RelatoController@salvar')->name('compliance.relatos.salvar');
Route::get('/compliance/relatos/adicionar', 'Correios\RelatoController@adicionar')->name('compliance.relatos.adicionar');
Route::put('/compliance/relatos/atualizar/{id}','Correios\RelatoController@atualizar')->name('compliance.relatos.atualizar');
Route::get('/compliance/relatos/editar/{id}', 'Correios\RelatoController@edit')->name('compliance.relatos.editar');
Route::get('/compliance/relatos/', 'Correios\RelatoController@index')->name('compliance.relatos');
Route::post('/compliance/relatos/{search?}', 'Correios\RelatoController@search')->name('compliance.relatos.search');



Route::get('/compliance/inspecionados', 'Correios\InspecionadosController@index')->name('compliance.inspecionados');
Route::post('/compliance/inspecionados{search?}', 'Correios\InspecionadosController@search')->name('compliance.inspecionados.search');
Route::get('/compliance/inspecionados/{id}', 'Correios\InspecionadosController@papelTrabalho')->name('compliance.inspecionados.papelTrabalho');
Route::get('/compliance/inspecionados/pdf/{id}','Correios\InspecionadosController@createPDF')->name('compliance.inspecionados.pdfPapelTrabalho');
Route::get('/compliance/inspecionados/xml/{id}','Correios\InspecionadosController@createXML')->name('compliance.inspecionados.xml');
Route::get('/compliance/inspecionados/recusar/{id}', 'Correios\InspecionadosController@recusar')->name('compliance.inspecionados.recusar');


Route::get('/compliance/verificacoes/destroy/{id}', 'Correios\VerificacoesController@destroy')->name('compliance.verificacoes.destroy');
Route::get('/compliance/verificacoes/', 'Correios\VerificacoesController@index')->name('compliance.verificacoes');
Route::post('/compliance/verificacoes/{search?}', 'Correios\VerificacoesController@search')->name('compliance.verificacoes.search');


Route::put('/compliance/tipounidades/atualizar/{id}','Correios\TipoDeUnidadeController@update')->name('compliance.tipounidades.atualizar');
Route::get('/compliance/tipounidades', 'Correios\TipoDeUnidadeController@index')->name('compliance.tipounidades');
Route::get('/compliance/tipounidades/editar/{id}', 'Correios\TipoDeUnidadeController@edit')->name('compliance.tipounidades.editar');


Route::get('/compliance/inspecao/destroyfiles/{id}', 'Correios\InspecaoController@deletefiles')->name('compliance.inspecao.destroyfiles');
Route::put('/compliance/inspecao/atualizar/{id}','Correios\InspecaoController@update')->name('compliance.inspecao.atualizar');

//atualizarsro

Route::get('/compliance/inspecao/editar/{id}', 'Correios\InspecaoController@edit')->name('compliance.inspecao.editar');

Route::put('/compliance/inspecao/editsro/{id}', 'Correios\InspecaoController@editsro')->name('compliance.inspecao.editar.sro');


//**
// Rota nomeada com mais de um par??metro
//Route::get('/compliance/inspecao/lancamentossro/export/{idCodigo}/numeroGrupoVerificacao/{idNumeroGrupoVerificacao}/numeroDoTeste/{idNumeroDoTeste}', 'Correios\InspecaoController@exportLancamentosSRO')->name('compliance.inspecao.export');

Route::get('/compliance/inspecao/lancamentossro/export/{codigo}', 'Correios\InspecaoController@exportLancamentosSRO')->name('compliance.inspecao.export.sro');


Route::get('/compliance/inspecao/{id}', 'Correios\InspecaoController@index')->name('compliance.inspecao');
Route::get('/compliance/inspecao/corroborar/{id}', 'Correios\InspecaoController@corroborar')->name('compliance.inspecao.corroborar');
Route::post('/compliance/inspecao/{search?}', 'Correios\InspecaoController@search')->name('compliance.inspecao.search');

Route::get('/compliance/importacoes', 'Correios\Importacao\ImportacaoController@index')->name('importacao');

Route::get('/compliance/importacoes/alarme/export', 'Correios\Importacao\ImportacaoController@exportAlarme')->name('compliance.export.alarme');
Route::post('/compliance/importacoes/alarme', 'Correios\Importacao\ImportacaoController@importAlarme')->name('compliance.importacao.alarme');
Route::get('/compliance/importacoes/alarme', 'Correios\Importacao\ImportacaoController@alarme')->name('importacao.alarme');

Route::get('/compliance/importacoes/debitoEmpregado/export', 'Correios\Importacao\ImportacaoController@exportDebitoEmpregados')->name('compliance.export.webcont');
Route::post('/compliance/importacoes/debitoEmpregado', 'Correios\Importacao\ImportacaoController@importDebitoEmpregados')->name('compliance.importacao.webcont');
Route::get('/compliance/importacoes/debitoEmpregado', 'Correios\Importacao\ImportacaoController@debitoEmpregados')->name('importacao.webcont');

Route::get('/compliance/importacoes/proter/export', 'Correios\Importacao\ImportacaoController@exportProter')->name('compliance.export.proter');
Route::post('/compliance/importacoes/proter', 'Correios\Importacao\ImportacaoController@importProter')->name('compliance.importacao.proter');
Route::get('/compliance/importacoes/proter', 'Correios\Importacao\ImportacaoController@proter')->name('importacao.proter');

Route::get('/compliance/importacoes/cadastral/export', 'Correios\Importacao\ImportacaoController@exportCadastral')->name('compliance.export.cadastral');
Route::post('/compliance/importacoes/cadastral', 'Correios\Importacao\ImportacaoController@importCadastral')->name('compliance.importacao.cadastral');
Route::get('/compliance/importacoes/cadastral', 'Correios\Importacao\ImportacaoController@cadastral')->name('importacao.cadastral');

Route::post('/compliance/importacoes/unidades', 'Correios\Importacao\ImportacaoController@importUnidades')->name('compliance.importacao.unidades');
Route::get('/compliance/importacoes/unidades', 'Correios\Importacao\ImportacaoController@unidades')->name('importacao.unidades');


Route::get('/compliance/importacoes/smb_bdf/export', 'Correios\Importacao\ImportacaoController@exportSmb_bdf')->name('compliance.export.smb_bdf');
Route::post('/compliance/importacoes/smb_bdf', 'Correios\Importacao\ImportacaoController@importSmb_bdf')->name('compliance.importacao.smb_bdf');
Route::get('/compliance/importacoes/smb_bdf', 'Correios\Importacao\ImportacaoController@smb_bdf')->name('importacao.smb_bdf');

Route::get('/compliance/importacoes/SL02_bdf/export', 'Correios\Importacao\ImportacaoController@exportSL02_bdf')->name('compliance.export.SL02_bdf');
Route::post('/compliance/importacoes/SL02_bdf', 'Correios\Importacao\ImportacaoController@importSL02_bdf')->name('compliance.importacao.SL02_bdf');
Route::get('/compliance/importacoes/SL02_bdf', 'Correios\Importacao\ImportacaoController@SL02_bdf')->name('importacao.SL02_bdf');

Route::get('/compliance/importacoes/RespDefinida/export', 'Correios\Importacao\ImportacaoController@exportRespDefinida')->name('compliance.export.RespDefinida');
Route::post('/compliance/importacoes/RespDefinida', 'Correios\Importacao\ImportacaoController@importRespDefinida')->name('compliance.importacao.RespDefinida');
Route::get('/compliance/importacoes/RespDefinida', 'Correios\Importacao\ImportacaoController@RespDefinida')->name('importacao.RespDefinida');

Route::get('/compliance/importacoes/feriado/export', 'Correios\Importacao\ImportacaoController@exportFeriado')->name('compliance.export.feriado');
Route::post('/compliance/importacoes/feriado', 'Correios\Importacao\ImportacaoController@importFeriado')->name('compliance.importacao.feriado');
Route::get('/compliance/importacoes/feriado', 'Correios\Importacao\ImportacaoController@feriado')->name('importacao.feriado');

Route::get('/compliance/importacoes/ferias/export', 'Correios\Importacao\ImportacaoController@exportFerias')->name('compliance.export.ferias');
Route::post('/compliance/importacoes/ferias', 'Correios\Importacao\ImportacaoController@importFerias')->name('compliance.importacao.ferias');
Route::get('/compliance/importacoes/ferias', 'Correios\Importacao\ImportacaoController@ferias')->name('importacao.ferias');



Route::get('/compliance/importacoes/absenteismo/export', 'Correios\Importacao\ImportacaoController@exportAbsenteismo')->name('compliance.export.absenteismo');
Route::post('/compliance/importacoes/absenteismo', 'Correios\Importacao\ImportacaoController@importAbsenteismo')->name('compliance.importacao.absenteismo');
Route::get('/compliance/importacoes/absenteismo', 'Correios\Importacao\ImportacaoController@absenteismo')->name('importacao.absenteismo');

Route::get('/compliance/importacoes/cftv/export', 'Correios\Importacao\ImportacaoController@exportCftv')->name('compliance.export.cftv');
Route::post('/compliance/importacoes/cftv', 'Correios\Importacao\ImportacaoController@importCftv')->name('compliance.importacao.cftv');
Route::get('/compliance/importacoes/cftv', 'Correios\Importacao\ImportacaoController@cftv')->name('importacao.cftv');

Route::get('/compliance/importacoes/controleDeViagem/export', 'Correios\Importacao\ImportacaoController@exportControleDeViagem')->name('compliance.export.controleDeViagem');
Route::post('/compliance/importacoes/controleDeViagem', 'Correios\Importacao\ImportacaoController@importControleDeViagem')->name('compliance.importacao.controleDeViagem');
Route::get('/compliance/importacoes/controleDeViagem', 'Correios\Importacao\ImportacaoController@controleDeViagem')->name('importacao.controleDeViagem');

Route::get('/compliance/importacoes/plpListaPendente/export', 'Correios\Importacao\ImportacaoController@exportPLPListaPendente')->name('compliance.export.plpListaPendente');
Route::post('/compliance/importacoes/plpListaPendente', 'Correios\Importacao\ImportacaoController@importPLPListaPendente')->name('compliance.importacao.plpListaPendente');
Route::get('/compliance/importacoes/plpListaPendente', 'Correios\Importacao\ImportacaoController@plpListaPendente')->name('importacao.plpListaPendente');

Route::get('/compliance/importacoes/sgdoDistribuicao/export', 'Correios\Importacao\ImportacaoController@exportSgdoDistribuicao')->name('compliance.export.sgdoDistribuicao');
Route::post('/compliance/importacoes/sgdoDistribuicao', 'Correios\Importacao\ImportacaoController@importSgdoDistribuicao')->name('compliance.importacao.sgdoDistribuicao');
Route::get('/compliance/importacoes/sgdoDistribuicao', 'Correios\Importacao\ImportacaoController@sgdoDistribuicao')->name('importacao.sgdoDistribuicao');


Route::get('/compliance/importacoes/cieEletronica/export', 'Correios\Importacao\ImportacaoController@exportCieEletronica')->name('compliance.export.cieEletronica');
Route::post('/compliance/importacoes/cieEletronica', 'Correios\Importacao\ImportacaoController@importCieEletronica')->name('compliance.importacao.cieEletronica');
Route::get('/compliance/importacoes/cieEletronica', 'Correios\Importacao\ImportacaoController@cieEletronica')->name('importacao.cieEletronica');

Route::get('/compliance/importacoes/painelExtravio/export', 'Correios\Importacao\ImportacaoController@exportPainelExtravio')->name('compliance.export.painelExtravio');
Route::post('/compliance/importacoes/painelExtravio', 'Correios\Importacao\ImportacaoController@importPainelExtravio')->name('compliance.importacao.painelExtravio');
Route::get('/compliance/importacoes/painelExtravio', 'Correios\Importacao\ImportacaoController@painelExtravio')->name('importacao.painelExtravio');


Route::get('/compliance/importacoes/pagamentosAdicionais/export', 'Correios\Importacao\ImportacaoController@exportPagamentosAdicionais')->name('compliance.export.pagamentosAdicionais');
Route::post('/compliance/importacoes/pagamentosAdicionais', 'Correios\Importacao\ImportacaoController@importPagamentosAdicionais')->name('compliance.importacao.pagamentosAdicionais');
Route::get('/compliance/importacoes/pagamentosAdicionais', 'Correios\Importacao\ImportacaoController@pagamentosAdicionais')->name('importacao.pagamentosAdicionais');

Route::get('/compliance/importacoes/bdf_fat_02/export', 'Correios\Importacao\ImportacaoController@exportBDF_FAT_02')->name('compliance.export.bdf_fat_02');
Route::post('/compliance/importacoes/bdf_fat_02', 'Correios\Importacao\ImportacaoController@importBDF_FAT_02')->name('compliance.importacao.bdf_fat_02');
Route::get('/compliance/importacoes/bdf_fat_02', 'Correios\Importacao\ImportacaoController@bdf_fat_02')->name('importacao.bdf_fat_02');

Route::get('/compliance/importacoes/microStrategy/export', 'Correios\Importacao\ImportacaoController@exportMicroStrategy')->name('compliance.export.microStrategy');
Route::post('/compliance/importacoes/microStrategy', 'Correios\Importacao\ImportacaoController@importMicroStrategy')->name('compliance.importacao.microStrategy');
Route::get('/compliance/importacoes/microStrategy', 'Correios\Importacao\ImportacaoController@microStrategy')->name('importacao.microStrategy');


//Route::get('/concessionarias/leituras/destroyLeituras/{id}', 'Concessionarias\ConcessionariasLeituraController@destroyLeituras')->name('concessionarias.leituras.destroyLeituras');
//Route::put('/concessionarias/leituras/atualizarLeituras/{id}','Concessionarias\ConcessionariasLeituraController@atualizarLeituras')->name('concessionarias.leituras.atualizarLeituras');

//faturamento
Route::get('/concessionarias/faturamento/pdf/{id}','Concessionarias\ConcessionariasFaturamentoController@createPDF')->name('concessionarias.faturamento.pdffatura');
Route::get('/concessionarias/faturamento/imprimirFatura/{id}', 'Concessionarias\ConcessionariasFaturamentoController@imprimirFatura')->name('concessionarias.faturamento.imprimirFatura');
Route::put('/concessionarias/faturamento/receberFatura/{id}', 'Concessionarias\ConcessionariasFaturamentoController@receberFatura')->name('concessionarias.faturamento.receberFatura');
Route::post('/concessionarias/faturamento/{searchFaturas?}', 'Concessionarias\ConcessionariasFaturamentoController@searchFaturas')->name('concessionarias.faturamento.searchFaturas');
Route::get('/concessionarias/faturamento', 'Concessionarias\ConcessionariasFaturamentoController@index')->name('concessionarias.faturamento');
Route::get('/concessionarias/faturamento/recebimentoFatura/{id}', 'Concessionarias\ConcessionariasFaturamentoController@recebimentoFatura')->name('concessionarias.faturamento.recebimentoFatura');
Route::get('/concessionarias/faturamento/destroyFatura/{id}', 'Concessionarias\ConcessionariasFaturamentoController@destroyFatura')->name('concessionarias.faturamento.destroyFatura');




Route::get('/concessionarias/leituras/destroyLeituras/{id}', 'Concessionarias\ConcessionariasLeituraController@destroyLeituras')->name('concessionarias.leituras.destroyLeituras');
Route::put('/concessionarias/leituras/atualizarLeituras/{id}','Concessionarias\ConcessionariasLeituraController@atualizarLeituras')->name('concessionarias.leituras.atualizarLeituras');
Route::get('/concessionarias/leituras/editarLeituras/{id}', 'Concessionarias\ConcessionariasLeituraController@editLeituras')->name('concessionarias.leituras.editarLeituras');
Route::post('/concessionarias/leituras/{searchLeituras?}', 'Concessionarias\ConcessionariasLeituraController@searchLeituras')->name('concessionarias.leituras.searchLeituras');
Route::get('/concessionarias/leituras', 'Concessionarias\ConcessionariasLeituraController@index')->name('concessionarias.leituras');


Route::get('/concessionarias/tarifas/destroyTarifas/{id}', 'Concessionarias\ConcessionariasTarifasController@destroyTarifas')->name('concessionarias.contas.destroyTarifas');
Route::post('/concessionarias/tarifas/salvarTarifas', 'Concessionarias\ConcessionariasTarifasController@salvarTarifas')->name('concessionarias.tarifas.salvarTarifas');
Route::get('/concessionarias/tarifas/adicionarTarifas', 'Concessionarias\ConcessionariasTarifasController@adicionarTarifas')->name('concessionarias.tarifas.adicionarTarifas');
Route::post('/concessionarias/tarifas/{searchTarifa?}', 'Concessionarias\ConcessionariasTarifasController@searchTarifa')->name('concessionarias.tarifas.searchTarifa');
Route::get('/concessionarias/tarifas', 'Concessionarias\ConcessionariasTarifasController@index')->name('concessionarias.tarifas');


Route::get('/concessionarias/contas/gerarLeitura/{id}', 'Concessionarias\ConcessionariasController@gerarLeituraId')->name('concessionarias.contas.gerarLeituraId');
Route::get('/concessionarias/contas/gerarLeitura', 'Concessionarias\ConcessionariasController@gerarLeitura')->name('concessionarias.contas.gerarLeitura');
Route::get('/concessionarias/contas/destroy/{id}', 'Concessionarias\ConcessionariasController@destroyContas')->name('concessionarias.contas.destroyContas');
Route::put('/concessionarias/contas/atualizarContas/{id}','Concessionarias\ConcessionariasController@atualizarContas')->name('concessionarias.contas.atualizarContas');
Route::get('/concessionarias/contas/editarContas/{id}', 'Concessionarias\ConcessionariasController@editContas')->name('concessionarias.contas.editarContas');
Route::post('/concessionarias/contas/salvarContas', 'Concessionarias\ConcessionariasController@salvarContas')->name('concessionarias.contas.salvarContas');
Route::get('/concessionarias/contas/adicionarContas', 'Concessionarias\ConcessionariasController@adicionarContas')->name('concessionarias.contas.adicionarContas');
Route::post('/concessionarias/{search?}', 'Concessionarias\ConcessionariasController@search')->name('concessionaria.search');
Route::get('/concessionarias', 'Concessionarias\ConcessionariasController@index')->name('concessionarias');








/**
 * index ??? Lista os dados da tabela
 * show ??? Mostra um item espec??fico
 * create ??? Retorna a View para criar um item da tabela
 * store ??? Salva o novo item na tabela
 * edit ??? Retorna a View para edi????o do dado
 * update ??? Salva a atualiza????o do dado
 * destroy ??? Remove o dado
*/
