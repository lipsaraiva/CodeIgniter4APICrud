<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\LojaModel;
use CodeIgniter\API\ResponseTrait;

class Loja extends Controller {

    use ResponseTrait;

    //Mostrar todos produtos
    public function index(){
        $model = new LojaModel();
        //Funcao nativa CI4
        //Se desejar mostrar os marcados na coluna deleted_at
        //$data = $model->withDeleted();
        //Fim - Funcao nativa CI4
        $data = $model->findAll();
        return $this->respond($data);
    }

    //Mostrar somente um produto
    public function show($id = null){
        $model = new LojaModel();
        $data = $model->getWhere(['id' => $id])->getResult();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('Nenhum produto encontrado com a id '.$id);
        }
    }

    //Criar um produto
    public function create(){
        $model = new LojaModel;
        $data = array(
            'nome'      => $this->request->getVar('nome'),
            'preco'     => $this->request->getVar('preco'),
            'descricao' => $this->request->getVar('descricao')
        );
        if($data){
            $model->insert($data);
            $response = [
                'status'   => 201,
                'error'    => null,
                'messages' => [
                    'success' => 'Produto Criado!'
                ]
            ];
            return $this->respondCreated($response);
        }else{
            return $this->failNotFound('Informar os parâmetros necessários');
        }
    }

    //Atualizar produto
    public function update($id = null){
        $model = new LojaModel;
        $input = $this->request->getRawInput();
        $data = [
            'nome'      => $input['nome'],
            'preco'     => $input['preco'],
            'descricao' => $input['descricao']  
        ];
        $model->update($id, $data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Produto Atualizado!'
            ]
        ];
        return $this->respond($response);
    }

    //Deletar produto
    public function delete($id = null){
        $model = new LojaModel;
        $data = $model->find($id);
        if($data){
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Produto Deletado!'
                ]
            ];
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('Nenhum produto encontrado com a id '.$id);
        }
    }

}