<?php

class ZangeressenController extends BaseController
{
    private $zangeressenModel;

    public function __construct()
    {
        $this->zangeressenModel = $this->model('Zangeressen');
    }

    public function index($display = 'none', $message = '')
    {
        $result = $this->zangeressenModel->getAllZangeressen();

        $data = [
            'title' => 'Rijkste Zangeressen',
            'display' => $display,
            'message' => $message,
            'result' => $result
        ];

        $this->view('zangeressen/index', $data);
    }

    public function delete($Id)
    {
        $this->zangeressenModel->delete($Id);

        header('Refresh:3; url=' . URLROOT . '/ZangeressenController/index');

        $this->index('flex', 'Record is verwijderd');
    }

    public function create()
    {
        $data = [
            'title' => 'Nieuwe zangeres toevoegen',
            'display' => 'none',
            'message' => '',
            'errors' => []
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = [];

            if (empty(trim($_POST['naam']))) {
                $errors['naam'] = 'Voer een naam in';
            } elseif (strlen($_POST['naam']) > 50) {
                $errors['naam'] = 'Naam mag maximaal 50 tekens bevatten';
            }

            if (empty(trim($_POST['geboorteland']))) {
                $errors['geboorteland'] = 'Voer een geboorteland in';
            } elseif (strlen($_POST['geboorteland']) > 50) {
                $errors['geboorteland'] = 'Geboorteland mag maximaal 50 tekens bevatten';
            }

            if (empty($_POST['vermogen'])) {
                $errors['vermogen'] = 'Voer een vermogen in';
            } elseif (!is_numeric($_POST['vermogen']) || $_POST['vermogen'] < 0 || $_POST['vermogen'] > 99999999.99) {
                $errors['vermogen'] = 'Voer een geldig vermogen in';
            }

            if (empty(trim($_POST['genre']))) {
                $errors['genre'] = 'Voer een genre in';
            } elseif (strlen($_POST['genre']) > 25) {
                $errors['genre'] = 'Genre mag maximaal 25 tekens bevatten';
            }

            if (empty($_POST['geboortedatum'])) {
                $errors['geboortedatum'] = 'Voer een geboortedatum in';
            } elseif (!DateTime::createFromFormat('Y-m-d', $_POST['geboortedatum'])) {
                $errors['geboortedatum'] = 'Voer een geldige datum in (jjjj-mm-dd)';
            }

            if (!empty($errors)) {
                $data['errors'] = $errors;
            } else {
                $data['display'] = 'flex';
                $data['message'] = 'De gegevens zijn opgeslagen';
                $data['color'] = 'success';

                $this->zangeressenModel->create($_POST);

                header('Refresh:3; URL=' . URLROOT . '/ZangeressenController/index');
            }
        }

        $this->view('zangeressen/create', $data);
    }

    public function update($id = NULL)
    {
        $data = [
            'title' => 'Wijzig zangeres',
            'display' => 'none',
            'message' => '',
            'errors' => []
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errors = [];

            if (empty(trim($_POST['naam']))) {
                $errors['naam'] = 'Voer een naam in';
            } elseif (strlen($_POST['naam']) > 50) {
                $errors['naam'] = 'Naam mag maximaal 50 tekens bevatten';
            }

            if (empty(trim($_POST['geboorteland']))) {
                $errors['geboorteland'] = 'Voer een geboorteland in';
            } elseif (strlen($_POST['geboorteland']) > 50) {
                $errors['geboorteland'] = 'Geboorteland mag maximaal 50 tekens bevatten';
            }

            if (empty($_POST['vermogen'])) {
                $errors['vermogen'] = 'Voer een vermogen in';
            } elseif (!is_numeric($_POST['vermogen']) || $_POST['vermogen'] < 0 || $_POST['vermogen'] > 99999999.99) {
                $errors['vermogen'] = 'Voer een geldig vermogen in';
            }

            if (empty(trim($_POST['genre']))) {
                $errors['genre'] = 'Voer een genre in';
            } elseif (strlen($_POST['genre']) > 25) {
                $errors['genre'] = 'Genre mag maximaal 25 tekens bevatten';
            }

            if (empty($_POST['geboortedatum'])) {
                $errors['geboortedatum'] = 'Voer een geboortedatum in';
            } elseif (!DateTime::createFromFormat('Y-m-d', $_POST['geboortedatum'])) {
                $errors['geboortedatum'] = 'Voer een geldige datum in (jjjj-mm-dd)';
            }

            if (!empty($errors)) {
                $data['errors'] = $errors;
            } else {
                $this->zangeressenModel->updateZangeres($_POST);

                $data['display'] = 'flex';
                $data['message'] = 'Het record is succesvol opgeslagen';
                $data['color'] = 'success';

                header('Refresh:3; url=' . URLROOT . '/ZangeressenController/index');
            }
        }

        $data['zangeres'] = $this->zangeressenModel->getZangeresById($id);

        $this->view('zangeressen/update', $data);
    }
}
