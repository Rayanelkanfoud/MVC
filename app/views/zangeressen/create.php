<?php require_once APPROOT . '/views/includes/header.php'; ?>

<div class="container">
    <div class="row mt-4 d-flex justify-content-center">
        <div class="col-6">
            <h3><?php echo $data['title']; ?></h3>
        </div>
    </div>

    <div class="row mt-3 d-<?php echo $data['display']; ?> justify-content-center">
        <div class="col-6">
            <div class="alert alert-<?php echo $data['color'] ?? 'success'; ?>" role="alert">
                <?php echo $data['message']; ?>
            </div>
        </div>
    </div>

    <div class="row mt-3 d-flex justify-content-center">
        <div class="col-6">
            <form action="<?= URLROOT; ?>/ZangeressenController/create" method="post">
                <div class="mb-3">
                    <label for="naam" class="form-label">Naam</label>
                    <input name="naam" type="text" class="form-control <?= isset($data['errors']['naam']) ? 'is-invalid' : ''; ?>" id="naam" value="<?= $_POST['naam'] ?? ''; ?>">
                    <?php if (isset($data['errors']['naam'])) : ?>
                        <div class="invalid-feedback"><?= $data['errors']['naam']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="geboorteland" class="form-label">Geboorteland</label>
                    <input name="geboorteland" type="text" class="form-control <?= isset($data['errors']['geboorteland']) ? 'is-invalid' : ''; ?>" id="geboorteland" value="<?= $_POST['geboorteland'] ?? ''; ?>">
                    <?php if (isset($data['errors']['geboorteland'])) : ?>
                        <div class="invalid-feedback"><?= $data['errors']['geboorteland']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="vermogen" class="form-label">Vermogen (mln $)</label>
                    <input name="vermogen" type="number" min="0" max="99999999" step="0.01" class="form-control <?= isset($data['errors']['vermogen']) ? 'is-invalid' : ''; ?>" id="vermogen" value="<?= $_POST['vermogen'] ?? ''; ?>">
                    <?php if (isset($data['errors']['vermogen'])) : ?>
                        <div class="invalid-feedback"><?= $data['errors']['vermogen']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="genre" class="form-label">Genre</label>
                    <input name="genre" type="text" class="form-control <?= isset($data['errors']['genre']) ? 'is-invalid' : ''; ?>" id="genre" value="<?= $_POST['genre'] ?? ''; ?>">
                    <?php if (isset($data['errors']['genre'])) : ?>
                        <div class="invalid-feedback"><?= $data['errors']['genre']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="geboortedatum" class="form-label">Geboortedatum</label>
                    <input name="geboortedatum" type="date" class="form-control <?= isset($data['errors']['geboortedatum']) ? 'is-invalid' : ''; ?>" id="geboortedatum" value="<?= $_POST['geboortedatum'] ?? ''; ?>">
                    <?php if (isset($data['errors']['geboortedatum'])) : ?>
                        <div class="invalid-feedback"><?= $data['errors']['geboortedatum']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="d-flex justify-content-between mt-3 mb-5">
                    <button type="submit" class="btn btn-primary">Verstuur</button>
                    <a href="<?= URLROOT; ?>/homepages/index" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Terug naar homepage
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/includes/footer.php'; ?>
