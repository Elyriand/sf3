<form class="form-signup" method="post">

    <?php if (count($_errors)): ?>
        <ul class="form-errors">
        <?php foreach ($_errors as $fieldName => $error): ?>
            <li class="form-error"><?= $error ?></li>
        <?php endforeach ?>
        </ul>
    <?php endif ?>

    <h2 class="form-signup-heading">Sign up</h2>
    <fieldset>
    <label for="inputFirstName" class="sr-only">Email address</label>
    <input name="first_name" id="inputFirstName" class="form-control" placeholder="First name" value="<?= $_signUp->getFirstName() ?>">
    <label for="inputLastName" class="sr-only">Email address</label>
    <input name="last_name" id="inputLastName" class="form-control" placeholder="Last name"  value="<?= $_signUp->getLastName() ?>">
    <label for="inputPhoneNumber" class="sr-only">Phone number</label>
    <input name="phone_number" id="inputPhoneNumber" class="form-control" placeholder="Phone number" value="<?= $_signUp->getPhoneNumber() ?>">
    <label for="inputEmail" class="sr-only">Email address</label>
    <input name="email" id="inputEmail" class="form-control" placeholder="Email address" value="<?= $_signUp->getEmail() ?>">
    </fieldset>

    <div class="form-group">
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password">
    <label for="inputPasswordConfirm" class="sr-only">Confirmation</label>
    <input type="password" name="password_confirm" id="inputPasswordConfirm" class="form-control" placeholder="Password confirmation">
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
</form>
