<?php
 
if($erreur !=""): ?>

<div class="alert alert-dismissible alert-primary">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

  <p><?= $erreur ?> </p>
</div>
<?php else: ?>
    <div class="card">
        <div class="card-header bg-primary text-center">
            <h3><?= $product['productTitle'] ?></h3>
        </div>
        <div class="card-body text-center">
            <div class="row"> 
        <div class="col-12 col-md-6">
        <img src="image/<?= $product['image'] ?>" alt="<?= $product['productTitle'] ?>" class="img-fluid">
        </div>
        <div class="col-12 col-md-6">
        <iframe src="https://www.google.com/maps?q=<?= $user['city'] ?>&t=&z=13&ie=UTF8&iwloc=&output=embed" width='100%' height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="p-2"></iframe>

        </div>
    </div>
        </div>
    </div>

<?php endif ?>
