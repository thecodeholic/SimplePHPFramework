<div>
    <h1>Login</h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <p><?php echo $error ?></p>
        </div>
    <?php endif; ?>
    <form method="post" action="/login">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                   placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
