<?php

class HorlogeController extends BaseController
{
    private $horlogeModel;

    public function __construct()
    {
        $this->horlogeModel = $this->model('Horloge');
    }

    public function index($display = 'none', $message = '')
    {
        $result = $this->horlogeModel->getAllHorloges();

        $data = [
            'title' => 'Duurste Horloges',
            'display' => $display,
            'message' => $message,
            'result' => $result
        ];

        $this->view('horloge/index', $data);
    }

    public function delete($Id)
    {
        $this->horlogeModel->delete($Id);

        header('Refresh:3; url=' . URLROOT . '/HorlogeController/index');

        $this->index('flex', 'Record is verwijderd');
    }

    public function create()
{
    $data = [
        'title' => 'Nieuw horloge toevoegen',
        'display' => 'none',
        'message' => '',
        'errors' => []
    ];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $errors = [];

        if (empty(trim($_POST['merk']))) {
            $errors['merk'] = 'Voer een merk in';
        } elseif (strlen($_POST['merk']) > 20) {
            $errors['merk'] = 'Merk mag maximaal 20 tekens bevatten';
        }

        if (empty(trim($_POST['model']))) {
            $errors['model'] = 'Voer een model in';
        } elseif (strlen($_POST['model']) > 30) {
            $errors['model'] = 'Model mag maximaal 30 tekens bevatten';
        }

        if (empty($_POST['prijs'])) {
            $errors['prijs'] = 'Voer een prijs in';
        } elseif (!is_numeric($_POST['prijs']) || $_POST['prijs'] < 0 || $_POST['prijs'] > 999999.99) {
            $errors['prijs'] = 'Voer een geldige prijs in';
        }

        if (empty(trim($_POST['materiaal']))) {
            $errors['materiaal'] = 'Voer een materiaal in';
        } elseif (strlen($_POST['materiaal']) > 20) {
            $errors['materiaal'] = 'Materiaal mag maximaal 20 tekens bevatten';
        }

        if (empty($_POST['gewicht'])) {
            $errors['gewicht'] = 'Voer een gewicht in';
        } elseif (!is_numeric($_POST['gewicht']) || $_POST['gewicht'] < 0 || $_POST['gewicht'] > 99999.99) {
            $errors['gewicht'] = 'Voer een geldig gewicht in';
        }

        if (empty($_POST['releasedatum'])) {
            $errors['releasedatum'] = 'Voer een releasedatum in';
        } elseif (!DateTime::createFromFormat('Y-m-d', $_POST['releasedatum'])) {
            $errors['releasedatum'] = 'Voer een geldige datum in (jjjj-mm-dd)';
        }

        if (!empty($errors)) {
            $data['errors'] = $errors;
        } else {
            $data['display'] = 'flex';
            $data['message'] = 'De gegevens zijn opgeslagen';
            $data['color'] = 'success';

            $this->horlogeModel->create($_POST);

            header('Refresh:3; URL=' . URLROOT . '/HorlogeController/index');
        }
    }

    $this->view('horloge/create', $data);
}

public function update($id = NULL)
{
    $data = [
        'title' => 'Wijzig horloge',
        'display' => 'none',
        'message' => '',
        'errors' => []
    ];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $errors = [];

        if (empty(trim($_POST['merk']))) {
            $errors['merk'] = 'Voer een merk in';
        } elseif (strlen($_POST['merk']) > 20) {
            $errors['merk'] = 'Merk mag maximaal 20 tekens bevatten';
        }

        if (empty(trim($_POST['model']))) {
            $errors['model'] = 'Voer een model in';
        } elseif (strlen($_POST['model']) > 30) {
            $errors['model'] = 'Model mag maximaal 30 tekens bevatten';
        }

        if (empty($_POST['prijs'])) {
            $errors['prijs'] = 'Voer een prijs in';
        } elseif (!is_numeric($_POST['prijs']) || $_POST['prijs'] < 0 || $_POST['prijs'] > 999999.99) {
            $errors['prijs'] = 'Voer een geldige prijs in';
        }

        if (empty(trim($_POST['materiaal']))) {
            $errors['materiaal'] = 'Voer een materiaal in';
        } elseif (strlen($_POST['materiaal']) > 20) {
            $errors['materiaal'] = 'Materiaal mag maximaal 20 tekens bevatten';
        }

        if (empty($_POST['gewicht'])) {
            $errors['gewicht'] = 'Voer een gewicht in';
        } elseif (!is_numeric($_POST['gewicht']) || $_POST['gewicht'] < 0 || $_POST['gewicht'] > 99999.99) {
            $errors['gewicht'] = 'Voer een geldig gewicht in';
        }

        if (empty($_POST['releasedatum'])) {
            $errors['releasedatum'] = 'Voer een releasedatum in';
        } elseif (!DateTime::createFromFormat('Y-m-d', $_POST['releasedatum'])) {
            $errors['releasedatum'] = 'Voer een geldige datum in (jjjj-mm-dd)';
        }

        if (!empty($errors)) {
            $data['errors'] = $errors;
        } else {
            $result = $this->horlogeModel->updateHorloge($_POST);

            $data['display'] = 'flex';
            $data['message'] = 'Het record is succesvol opgeslagen';
            $data['color'] = 'success';

            header("Refresh:3; url='/HorlogeController/index'");
        }
    }

    $data['horloge'] = $this->horlogeModel->getHorlogeById($id);

    $this->view('horloge/update', $data);
}
}