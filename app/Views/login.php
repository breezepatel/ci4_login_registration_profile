<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
                <div class="container">

                    <h3>Login</h3>
                    <hr>

                    <!-- using session showcasing the success msg of registering the user, hence signing up new user successfully -->
                    <?php if (session()->get('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->get('success') ?>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->get('delete')) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->get('delete') ?>
                        </div>
                    <?php endif; ?>

                    <form class="" action="/" method="post">

                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="text" class="form-control" name="email" id="email" value="<?= set_value('email') ?>">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" value="">
                        </div>

                        <!-- if data input is not valid then showing the error. -->
                        <?php if (isset($validation)) : ?>
                            <div class="col-12">
                                <div class="alert alert-danger" role="alert">
                                    <?= $validation->listErrors() ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                            <div class="col-12 col-sm-8 text-right">
                                <a href="/register">Don't have an account yet?</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
</section>