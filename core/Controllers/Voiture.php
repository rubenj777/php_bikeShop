<?php

namespace Controllers;

class Voiture extends AbstractController
{
    protected $defaultModelName = \Models\Voiture::class;

    /**
     * @return void
     */
    public function index()
    {
        return $this->json($this->defaultModel->findAll());
    }

    /**
     * @return void
     */
    public function new()
    {
        $request = $this->post('json', ['name'=>'text', 'brand'=>'text', 'price'=>'number']);
        if(!$request) {
            return $this->json('not ok');
        }

        $voiture = new \Models\Voiture();
        $voiture->setName($request['name']);
        $voiture->setBrand($request['brand']);
        $voiture->setPrice($request['price']);
        $this->defaultModel->save($voiture);

        return $this->json('ok');
    }

    /**
     * @return void
     */
    public function del()
    {
        $request = $this->delete('json', ['id'=>'number']);

        if(!$request) {
            return $this->json('request not ok', 'delete');
        }

        $voiture = $this->defaultModel->findById($request['id']);

        if(!$voiture) {
            return $this->json('voiture not exists', 'delete');
        }

        $this->defaultModel->remove($voiture);
        return $this->json('ok', 'delete');
    }
}