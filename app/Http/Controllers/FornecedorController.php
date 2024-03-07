<?php

namespace App\Http\Controllers;

use App\Http\Requests\FornecedorFormRequest;
use App\Models\Fornecedor;
use App\Services\FornecedorService;
use Illuminate\Http\Request;


class FornecedorController extends Controller
{

    public $service;

    public function __construct(FornecedorService $service)
    {
        $this->service = $service;
    }

    public function index() {
        return view('app.fornecedor.index');
    }

    public function listar(Request $request) {

        $fornecedores = $this->service->listar($request);
        return view('app.fornecedor.listar', ['fornecedores' => $fornecedores, 'request' => $request->all()]);
    }

    public function adicionar(Request $request) {

        $msg = '';

        //inclusão
        if($request->input('_token') != '' && $request->input('id') == '') {
            //validacao
            $regras = [
                'nome' => 'required|min:3|max:40',
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
                'email' => 'email'
            ];

            $feedback = [
                'required' => 'O campo :attribute deve ser preenchida',
                'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
                'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
                'uf.min' => 'O campo uf deve ter no mínimo 2 caracteres',
                'uf.max' => 'O campo uf deve ter no máximo 2 caracteres',
                'email.email' => 'O campo e-mail não foi preenchido corretamente'
            ];

            $request->validate($regras, $feedback);

            $fornecedor = new Fornecedor();
            $fornecedor->create($request->all());

            //redirect

            //dados view
            $msg = 'Cadastro realizado com sucesso';
        }

        //edição
        if($request->input('_token') != '' && $request->input('id') != '') {
            $fornecedor = Fornecedor::find($request->input('id'));
            $update = $fornecedor->update($request->all());

            if($update) {
                $msg = 'Atualização realizado com sucesso';
            } else {
                $msg = 'Erro ao tentar atualizar o registro';
            }

            return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg' => $msg]);
        }

        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }

    public function editar($id, $msg = '') {

        $fornecedor = Fornecedor::find($id);

        return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor, 'msg' => $msg]);
    }

    public function excluir($id) {

        Fornecedor::find($id)->delete();
        //Fornecedor::find($id)->forceDelete();


        return redirect()->route('app.fornecedor');
    }

}
