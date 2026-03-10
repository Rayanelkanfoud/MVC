<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container">
    <div class="row mt-4 d-flex justify-content-center">
        <div class="col-6">
            <h3 class="text-success"><?php echo $data['title']; ?></h3>
        </div>
    </div>

    <div class="row mt-3 d-<?php echo $data['display']; ?> justify-content-center">
        <div class="col-6 text-begin text-primary">
            <div class="alert alert-success" role="alert">
                <?php echo $data['message']; ?>
            </div>
        </div>
    </div>

    <div class="row mt-3 d-flex justify-content-center">
        <div class="col-6">
            <form action="<?php echo URLROOT; ?>/HorlogeController/create" method="post">
                <div class="mb-3">
                    <label for="merk" class="form-label">Merk</label>
                    <input name="merk" type="text" class="form-control" id="merk" value="<?php echo $_POST['merk'] ?? ''; ?>">
                </div>

                <div class="mb-3">
                    <label for="model" class="form-label">Model</label>
                    <input name="model" type="text" class="form-control" id="model" value="<?php echo $_POST['model'] ?? ''; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="prijs" class="form-label">Prijs</label>
                    <input name="prijs" type="number" min="0" max="999999" step="0.01" class="form-control" id="prijs" value="<?php echo $_POST['prijs'] ?? ''; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="materiaal" class="form-label">Materiaal</label>
                    <input name="materiaal" type="text" class="form-control" id="materiaal" value="<?php echo $_POST['materiaal'] ?? ''; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="gewicht" class="form-label">Gewicht</label>
                    <input name="gewicht" type="number" min="0" max="99999" step="0.01" class="form-control" id="gewicht" value="<?php echo $_POST['gewicht'] ?? ''; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="releasedatum" class="form-label">Releasedatum</label>
                    <input name="releasedatum" type="date" class="form-control" id="releasedatum" value="<?php echo $_POST['releasedatum'] ?? ''; ?>" required>
                </div>

                <button type="submit" class="btn btn-primary">Verstuur</button>
            </form>

            <a href="<?php echo URLROOT; ?>/homepages/index"><i class="bi bi-arrow-left"></i></a>
        </div>
    </div>
</div>

<?php require_once APPROOT . '/views/includes/footer.php'; ?>