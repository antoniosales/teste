<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\grupos;
use App\Model\Usuario;
use App\Http\Middleware\Security;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(Security::class);
    }

    public function usuarioIndex(){


        $usuarios = Usuario::query()
            ->orderBy('nome')->get();

        return view('layouts.usuario.tabela_usuarios', compact('usuarios'));

    }

    public function usuarioCadastro(){

        $grupos     = grupos::pluck('nome_grupo', 'cod_grupos');
        $escolas    = escola::pluck('nome', 'cod_escola');
        return view('layouts.usuario.cadastro_usuarios', compact('grupos', 'escolas'));
    }

    public function store(Request $request){

        $this->validate($request, [
            'nome' => 'required',
            'login' => 'required',
            'senha' => 'required|same:confirmesenha'
        ],
            [
                'nome.required'    => 'Preencha o campo nome!',
                'login.required'    => 'Preencha o campo login!',
                'senha.required'    => 'Preencha o campo senha!',
                'confirmesenha'    => 'Campo senha diferente do confirme senha',
                'same'              => 'Senha não confere'
            ]);

        $usuario = new Usuario;
        $usuario->nome                  = $request->nome;
        $usuario->login                 = $request->login;
        $request->senha                 = md5($request->senha);
        $usuario->senha                 = $request->senha;
        $usuario->cod_grupos            = $request->cod_grupos;
        $usuario->cod_tipousuario       = $request->cod_tipousuario;
        $usuario->cod_escola            = $request->cod_escola;
        if($usuario->cod_tipousuario==""){
            $usuario->cod_tipousuario = '0';
        }
        $usuario->data_insere           = date('Y-m-d');
        $usuario->cod_usuario_insere    = Session::get("cod_usuario");
        $usuario->save();

        Session::flash('flash_message', 'Cadastro de usuário realizado com sucesso!');

        return \Redirect::route('layouts.usuario.tabela_usuarios', [$request->cod_grupos])->with('message', 'Cadastro de usuário realizado com sucesso!');
    }

    public function edit($id)
    {
        $grupos = grupos::pluck('nome_grupo', 'cod_grupos');
        $escolas    = escola::pluck('nome', 'cod_escola');
        $usuario = Usuario::find($id);
        return view('layouts.usuario.cadastro_usuarios', compact('usuario', 'grupos', 'escolas'));
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $this->validate($request, [
            'nome' => 'required',
            'login' => 'required',
            'senha' => 'required|same:confirmesenha'
        ],
            [
                'nome.required'    => 'Preencha o campo nome!',
                'login.required'    => 'Preencha o campo login!',
                'senha.required'    => 'Preencha o campo senha!',
                'confirmesenha'    => 'Campo senha diferente do confirme senha',
                'same'              => 'Senha não confere'
            ]);

        $usuario->nome                  = $request->nome;
        $usuario->login                 = $request->login;
        $request->senha                 = md5($request->senha);
        $usuario->senha                 = $request->senha;
        $usuario->cod_grupos            = $request->cod_grupos;
        $usuario->cod_tipousuario       = $request->cod_tipousuario;
        $usuario->cod_escola            = $request->cod_escola;
        $usuario->data_insere           = date('Y-m-d');
        $usuario->cod_usuario_insere    = Session::get("cod_usuario");

        $usuario->save();

        Session::flash('flash_message', 'Edição de usuário realizada com sucesso!');

        return \Redirect::route('layouts.usuario.tabela_usuarios', [$request->cod_grupos])->with('message', 'Usuário gravado com sucesso!');

    }

    public function destroy($id)
    {
        $usuario = Usuario::find($id);
        $usuario->delete();
        Session::flash('flash_message', 'Exclusão de usuário realizada com sucesso!');
        return \Redirect::route('layouts.usuario.tabela_usuarios', [$usuario->cod_grupos])->with('message', 'Usuário com sucesso!');
    }
}
