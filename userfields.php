<div class="form-group py-3">
    <label for="InputName">Имя Заказчика</label>
    <input type="text" name="name" class="form-control w-25" placeholder="Имя Фамилия" value="<?= $user['name'] ?>" <?= $required ?>>
</div>
<div class="form-group py-3">
    <label for="InputEmail">Адрес электронной почты</label>
    <input type="email" name="email" class="form-control w-25" id="InputEmail" placeholder="yourmail@yourdomain.com" value="<?= $user['email'] ?>" <?= $required ?>>
</div>
<div class="form-group py-3">
    <label for="InputPhone">Телефон</label>
    <input type="text" name="phone" class="form-control w-25" id="InputPhone" placeholder="1234567890" value="<?= $user['phone'] ?>" <?= $required ?>>
</div>
<div class="form-group py-3">
    <label for="TextareaAddress">Адрес доставки</label>
    <textarea name="address" class="form-control w-50" id="TextareaAddress" rows="3" <?= $required ?>><?= $user['address'] ?></textarea>
</div>