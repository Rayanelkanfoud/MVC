<?php require_once APPROOT . '/views/includes/header.php'; ?>

<!-- Voor het centreren van de container gebruiken we het bootstrap grid -->
<div class="container">

    <div class="row mt-3 d-flex justify-content-center">
        <div class="col-10">
            <h3><?php echo $data['title']; ?></h3>
        </div>
    </div>

    <div class="row mt-3 d-flex justify-content-center">
        <div class="col-10">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Merk</th>
                        <th>Model</th>
                        <th>Prijs</th>
                        <th>Geheugen</th>
                        <th>Besturingssysteem</th>
                        <th>Schermgrootte</th>
                        <th>Releasedatum</th>
                        <th>MegaPixels</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data['result'] as $smartphone) : ?>
                        <tr>
                            <td><?php echo $smartphone->Merk; ?></td>
                            <td><?php echo $smartphone->Model; ?></td>
                            <td><?php echo $smartphone->Prijs; ?></td>
                            <td><?php echo $smartphone->Geheugen; ?></td>
                            <td><?php echo $smartphone->Besturingssysteem; ?></td>
                            <td><?php echo $smartphone->Schermgrootte; ?></td>
                            <td><?php echo $smartphone->Releasedatum; ?></td>
                            <td><?php echo $smartphone->MegaPixels; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <a href="<?php echo URLROOT; ?>/homepages/index" class="btn btn-primary">
                Terug
            </a>

        </div>
    </div>

</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>