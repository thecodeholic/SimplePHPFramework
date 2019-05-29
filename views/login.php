<div>
    <h1>Login</h1>
    <?php if ($errors): ?>
        <div class="alert alert-danger">
            <p><?php echo implode('<br>', array_values($errors)) ?></p>
        </div>
    <?php endif; ?>
    <form method="post" action="">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email"
                   class="form-control<?php echo isset($errors['email']) ? ' is-invalid' : ($data['email'] ? ' is-valid' : '') ?>" id="exampleInputEmail1" name="email"
                   placeholder="Enter email" value="<?php echo $data['email'] ?>">
            <?php if (isset($errors['email'])): ?>
                <p class="invalid-feedback"><?php echo $errors['email'] ?></p>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control<?php echo isset($errors['password']) ? ' is-invalid' : '' ?>" id="exampleInputPassword1"
                   name="password" placeholder="Password" value="<?php echo $data['password'] ?>">
            <?php if (isset($errors['password'])): ?>
                <p class="invalid-feedback"><?php echo $errors['password'] ?></p>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
