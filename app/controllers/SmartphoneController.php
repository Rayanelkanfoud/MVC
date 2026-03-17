<?php

class SmartphoneController extends BaseController
{
    private $smartphoneModel;

    public function __construct()
    {
        $this->smartphoneModel = $this->model('Smartphone');
    }

    public function index($display = 'none', $message = '')
    {
        $result = $this->smartphoneModel->getAllSmartphones();

        $data = [
            'title' => 'Overzicht Smartphones',
            'display' => $display,
            'message' => $message,
            'result' => $result
        ];

        $this->view('smartphone/index', $data);
    }

    public function delete($Id)
    {
        $this->smartphoneModel->delete($Id);

        header('Refresh:3; url=' . URLROOT . '/SmartphoneController/index');

        $this->index('flex', 'Record is verwijderd');
    }

    public function create()
    {
        $data = [
            'title' => 'Nieuwe smartphone toevoegen',
            'display' => 'none',
            'message' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (
                empty($_POST['merk']) ||
                empty($_POST['model']) ||
                empty($_POST['prijs']) ||
                empty($_POST['geheugen']) ||
                empty($_POST['besturingssysteem']) ||
                empty($_POST['schermgrootte']) ||
                empty($_POST['releasedatum']) ||
                empty($_POST['megapixels'])
            ) {
                $data['display'] = 'flex';
                $data['message'] = 'Vul alle velden in';
            } else {
                $data['display'] = 'flex';
                $data['message'] = 'De gegevens zijn opgeslagen';

                $this->smartphoneModel->create($_POST);

                header('Refresh:3; URL=' . URLROOT . '/SmartphoneController/index');
            }
        }

        $this->view('smartphone/create', $data);
    }

    public function update($id = NULL)
    {
        $data = [
            'title' => 'Wijzig smartphone',
            'display' => 'none',
            'message' => '',
            'color' => 'success'
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (
                empty($_POST['merk']) ||
                empty($_POST['model']) ||
                empty($_POST['prijs']) ||
                empty($_POST['geheugen']) ||
                empty($_POST['besturingssysteem']) ||
                empty($_POST['schermgrootte']) ||
                empty($_POST['releasedatum']) ||
                empty($_POST['megapixels'])
            ) {
                $data['display'] = 'flex';
                $data['message'] = 'Vul alle velden in';
                $data['color'] = 'danger';
            } else {
                $result = $this->smartphoneModel->updateSmartphone($_POST);

                $data['display'] = 'flex';
                $data['message'] = 'Het record is succesvol opgeslagen';
                $data['color'] = 'success';

                header("Refresh:3; url='/SmartphoneController/index'");
            }
        }

        $data['smartphone'] = $this->smartphoneModel->getSmartphoneById($id);

        $this->view('smartphone/update', $data);
    }
}