<?php

namespace Controllers;

class Message extends AbstractController
{
    protected $defaultModelName = \Models\Message::class;

    /**
     * @return void
     */
    public function index()
    {
        return $this->json($this->defaultModel->findAll());
    }

    public function new()
    {
        $request = $this->post('json', ['author'=>'text', 'content'=>'text']);
        if(!$request) {
            return $this->json('not ok');
        }

        $message = new \Models\Message();
        $message->setAuthor($request['author']);
        $message->setContent($request['content']);
        $this->defaultModel->save($message);

        return $this->json('ok');
    }

    public function del()
    {
        $request = $this->delete('json', ['id'=>'number']);

        if(!$request) {
            return $this->json('request not ok', 'delete');
        }

        $message = $this->defaultModel->findById($request['id']);

        if(!$message) {
            return $this->json('message not ok', 'delete');
        }

        $this->defaultModel->remove($message);
        return $this->json('ok', 'delete');
    }
}