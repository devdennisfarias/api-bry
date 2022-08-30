<?php

namespace App\Http\Controllers;

use App\Http\Requests\FuncionarioRequest;
use App\Http\Resources\FuncionarioCollection;
use App\Http\Resources\FuncionarioResource;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SimpleXMLElement;

class FuncionarioController extends Controller
{
    /**
     * @OA\Get(
     *      path="/funcionarios",
     *      sumary="Mostra os funcionarios cadastrados",
     *      @OA\Response(response=200, description="ok")
     * )
     * 
     * Display a listing of the resource.
     *
     * @return FuncionarioCollection
     */
    public function index(Request $request): FuncionarioCollection
    {
        if ($request->query('relacoes') === 'empresa') {
            $funcionario = Funcionario::with('empresa')->paginate(15);
            //dd($funcionario);
        } else {
            $funcionario = Funcionario::paginate(15);
        }
        return new FuncionarioCollection($funcionario);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FuncionarioRequest $request)
    {
        return response(Funcionario::create($request->all()), 201);
    }


    /**
     * @OA\Get(
     *      path="/funcionario/{id}",
     *      sumary="Mostra os detalhes da funcionario",
     *      @OA\Response(response=200, description="ok")
     * )
     * 
     * Display the specified resource.
     *
     * @param  Funcionario $funcionario
     * @return FuncionarioResource
     */
    public function show(Funcionario $funcionario): FuncionarioResource
    {
        if (request()->header("Accept") === "application/xml") {
            return $this->pegarFuncionarioXMLResponse($funcionario);
        }

        if (request()->wantsJson()) {
            return new FuncionarioResource($funcionario);
        }

        return response('Formato de Dados Desconhecidos nesta aplicação');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  FuncionarioRequest  $request
     * @param  Funcionario $funcionario
     * @return Funcionario
     */
    public function update(FuncionarioRequest $request, Funcionario $funcionario): Funcionario
    {
        $funcionario->update($request->all());

        return $funcionario;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  Funcionario $funcionario
     * @return array
     */
    public function destroy(Funcionario $funcionario)
    {
        $funcionario->delete();

        return [];
    }


    /**
     * Retorna uma response com xml do funcionario
     * 
     * @param Funcionario $funcionario
     * @return Response
     */
    private function pegarFuncionarioXMLResponse(Funcionario $funcionario): Response
    {
        $funcionario = $funcionario->toArray();

        $xml = new SimpleXMLElement('<funcionario/>');

        array_walk_recursive($funcionario, function ($valor, $chave) use ($xml) {
            $xml->addChild($chave, $valor);
        });

        return response($xml->asXML())
            ->header('Content-Type', 'application/xml');
    }
}
