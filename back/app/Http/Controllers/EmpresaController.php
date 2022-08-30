<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Response;
use App\Http\Requests\EmpresaRequest;
use App\Http\Resources\EmpresaCollection;
use App\Http\Resources\EmpresaResource;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use SimpleXMLElement;

class EmpresaController extends Controller
{
    /**
     * @OA\Get(
     *      path="/empresas",
     *      sumary="Mostra as empresas cadastradas",
     *      @OA\Response(response=200, description="ok")
     * )
     * 
     * Display a listing of the resource.
     *
     * @return EmpresaCollection
     */
    public function index(Request $request) :EmpresaCollection
    {
        if ($request->query('relacoes') === 'funcionarios')
        {
            $empresa = Empresa::with('funcionarios')->paginate(15);
            //dd($empresa);

        } 
        elseif ($request->query('relacoes') === 'clientes')
        {
            $empresa = Empresa::with('clientes')->paginate(15);
        } else {
            $empresa = Empresa::paginate(15);
        }
        return new EmpresaCollection($empresa);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpresaRequest $request)
    {
        return response(Empresa::create($request->all()), 201);
    }


    /**
     * @OA\Get(
     *      path="/empresa/{id}",
     *      sumary="Mostra os detalhes da empresa",
     *      @OA\Response(response=200, description="ok")
     * )
     * 
     * Display the specified resource.
     *
     * @param  Empresa $empresa
     * @return EmpresaResource
     */
    public function show(Empresa $empresa): EmpresaResource
    {
        if(request()->header("Accept") === "application/xml")
        {
            return $this->pegarEmpresaXMLResponse($empresa);
        }

        if(request()->wantsJson())
        {
            return new EmpresaResource($empresa);
        }

        return response('Formato de Dados Desconhecidos nesta aplicação');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  EmpresaRequest  $request
     * @param  Empresa $empresa
     * @return Empresa
     */
    public function update(EmpresaRequest $request, Empresa $empresa): Empresa
    {
        $empresa->update($request->all());

        return $empresa;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  Empresa $empresa
     * @return array
     */
    public function destroy(Empresa $empresa)
    {
        $empresa->delete();

        return [];
    }


    /**
     * Retorna uma response com xml da empresa
     * 
     * @param Empresa $empresa
     * @return Response
     */
    private function pegarEmpresaXMLResponse(Empresa $empresa): Response
    {
        $empresa = $empresa->toArray();

        $xml = new SimpleXMLElement('<empresa/>');

        array_walk_recursive($empresa, function($valor, $chave) use ($xml)
        {
            $xml->addChild($chave, $valor);
        });

        return response($xml->asXML())
        ->header('Content-Type', 'application/xml');
    }

}
