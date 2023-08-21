<?php

namespace App\Controllers\Rally;

use App\Controllers\BaseController;
use App\Models\Rally\FaqControllerModel;

class FaqController extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new FaqControllerModel();
    }

    public function user()
    {
        $data['title'] = 'FAQ Rally';
        $data['list_faq'] = $this->model->show_data();
        return view('rally/userfaq', $data);
    }

    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        if ($keyword) {
            $search = $this->model->search_data($keyword);
        } else {
            $search = $this->model;
        }
        $data['title'] = 'Manage FAQ';
        $data['keyword'] = $keyword;
        $data['list_faq'] = $search->paginate(5);
        $data['pager'] = $this->model->pager;
        $data['no'] = ($this->request->getVar('page') == 1) ? '0' : $this->request->getVar('page');
        return view('rally/adminfaq', $data);
    }

    public function save()
    {
        $validasi = \Config\Services::validation();
        $rules = [
            'question' => [
                'label' => 'Question',
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'Field {field} maksimal 255 karakter!'
                ]
            ],
            'answer' => [
                'label' => 'Answer',
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => 'Field {field} maksimal 255 karakter!'
                ]
            ]
        ];

        $validasi->setRules($rules);
        if ($validasi->withRequest($this->request)->run()) {
            $id = $this->request->getPost('id');
            $question = $this->request->getPost('question');
            $answer = $this->request->getPost('answer');

            $data = [
                'id' => $id,
                'question' => $question,
                'answer' => $answer
            ];

            $this->model->save($data);

            $response['success'] = "Update successful";
            $response['error'] = true;
        } else {
            $response['success'] = false;
            $response['error'] = $validasi->listErrors();
        }

        return json_encode($response);
    }

    public function edit($id)
    {
        return json_encode($this->model->find($id));
    }

    public function del($id)
    {
        $this->model->delete($id);
        return redirect()->to('panitia/games/faq');
    }
}
