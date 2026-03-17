<?php

class SneakerController extends BaseController
{
    private $sneakerModel;

    public function __construct()
    {
        $this->sneakerModel = $this->model('Sneaker');
    }

    public function index($display = 'none', $message = '')
    {
        $result = $this->sneakerModel->getAllSneakers();

        $data = [
            'title' => 'Mooiste Sneakers',
            'display' => $display,
            'message' => $message,
            'result' => $result
        ];

        $this->view('sneaker/index', $data);
    }

    public function delete($Id)
    {
        $this->sneakerModel->delete($Id);

        header('Refresh:3; url=' . URLROOT . '/SneakerController/index');

        $this->index('flex', 'Record is verwijderd');
    }

    public function create()
    {
        $data = [
            'title' => 'Nieuwe sneaker toevoegen',
            'display' => 'none',
            'message' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (
                empty($_POST['merk']) ||
                empty($_POST['model']) ||
                empty($_POST['type']) ||
                empty($_POST['prijs']) ||
                empty($_POST['materiaal']) ||
                empty($_POST['gewicht']) ||
                empty($_POST['releasedatum'])
            ) {
                $data['display'] = 'flex';
                $data['message'] = 'Vul alle velden in';
            } else {
                $data['display'] = 'flex';
                $data['message'] = 'De gegevens zijn opgeslagen';

                $this->sneakerModel->create($_POST);

                header('Refresh:3; URL=' . URLROOT . '/SneakerController/index');
            }
        }

        $this->view('sneaker/create', $data);
    }

    public function update($id = NULL)
    {
        $data = [
            'title' => 'Wijzig sneaker',
            'display' => 'none',
            'message' => '',
            'color' => 'success'
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (
                empty($_POST['merk']) ||
                empty($_POST['model']) ||
                empty($_POST['type']) ||
                empty($_POST['prijs']) ||
                empty($_POST['materiaal']) ||
                empty($_POST['gewicht']) ||
                empty($_POST['releasedatum'])
            ) {
                $data['display'] = 'flex';
                $data['message'] = 'Vul alle velden in';
                $data['color'] = 'danger';
            } else {
                $result = $this->sneakerModel->updateSneaker($_POST);

                $data['display'] = 'flex';
                $data['message'] = 'Het record is succesvol opgeslagen';
                $data['color'] = 'success';

                header("Refresh:3; url='/SneakerController/index'");
            }
        }

        $data['sneaker'] = $this->sneakerModel->getSneakerById($id);

        $this->view('sneaker/update', $data);
    }
}