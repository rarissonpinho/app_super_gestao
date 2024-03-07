<?php

namespace App\Services;

use App\Models\Fornecedor;

class FornecedorService
{
   public function listar($request) {
    $fornecedores = Fornecedor::with(['produtos'])->where('nome', 'like', '%'.$request->input('nome').'%')
        ->where('site', 'like', '%'.$request->input('site').'%')
        ->where('uf', 'like', '%'.$request->input('uf').'%')
        ->where('email', 'like', '%'.$request->input('email').'%')
        ->paginate(5);

        return $fornecedores;
   }
}

