<section id="profile">

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm8- offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
                <div class="container">
                    <h3><?= $user['firstname'] . ' ' . $user['lastname'] ?></h3>
                    <hr>

                    <?php if (session()->get('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->get('success') ?>
                        </div>
                    <?php endif; ?>

                    <!--Avatar-->
                    <div class="d-flex justify-content-center mb-4">
                        <?php if ($user['profile_image'] != '') : ?>
                            <img src='<?= $user['profile_image']; ?>' class="rounded-circle" alt="Profile Pic" style="width: 150px;" />
                        <?php else : ?>
                            <img src="https://mdbootstrap.com/img/Photos/Others/placeholder-avatar.jpg" class="rounded-circle" alt="example placeholder" style="width: 150px;" />
                        <?php endif; ?>
                    </div>
                    <br>


                    <!-- user detail -->
                    <div class="container row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input type="text" class="form-control" readonly id="firstname" value="<?= $user['firstname'] ?>">
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" class="form-control" readonly id="lastname" value="<?= $user['lastname'] ?>">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="text" class="form-control" readonly id="email" value="<?= $user['email'] ?>">
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="number" class="form-control" readonly id="age" value="<?= $user['age'] ?>">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <input type="text" class="form-control" readonly id="gender" value="<?= $user['gender'] ?>">
                            </div>
                        </div>

                        <?php if (isset($validation)) : ?>
                            <div class="col-12">
                                <div class="alert alert-danger" role="alert">
                                    <?= $validation->listErrors() ?>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>

                    <div class="row">
                        <!-- Button trigger modal -->
                        <div class="col-12 col-8 col-sm-4 ">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#profileImageModal">Upload Profile</button>
                        </div>
                        <div class="col-12 col-8 col-sm-4">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#editUserDetails">Edit details</button>
                        </div>
                        <div class="col-12 col-8 col-sm-4">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#changePassword">Change Password</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-8 col-sm-4 text-left">
            <button onclick="deleteConfirm()"class="btn btn-danger">Delete your account</button>
    </div>

    <script>
        function deleteConfirm() {
            if (confirm("Are you sure you want to delete?")) {
                window.location.href = '<?php echo base_url('/delete') ?>';
            }
        }
    </script>

    <!-- Modal -->
    <div class="modal fade" id="profileImageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload the Profile Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class='card-body'>
                    <?= form_open_multipart($action = "profile/image"); ?>
                    <div class='form-group'>
                        <label>Upload Avatar</label>
                        <input type="file" name='profile_image' class='form-control'>
                    </div>
                    <div class='form-group'>
                        <input type="submit" name='upload' value='Upload' class='btn btn-primary'>
                    </div>

                    <?= form_close(); ?>
                </div>

            </div>
        </div>
    </div>
    <!-- edit info bootstarp modal  -->

    <!-- Modal -->
    <div class="modal fade" id="editUserDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form id="updateuser" name="updateuser" class="" action="/profile/details" method="post">
                            <div class="modal-body">
                                <div class="row">

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="firstname">First Name</label>
                                            <input type="text" class="form-control" name="firstname" id="firstname" value="<?= set_value('firstname', $user['firstname']) ?>">
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="lastname">Last Name</label>
                                            <input type="text" class="form-control" name="lastname" id="lastname" value="<?= set_value('lastname', $user['lastname']) ?>">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email">Email address</label>
                                            <input type="text" class="form-control" readonly id="email" value="<?= $user['email'] ?>">
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="age">Age</label>
                                            <input type="number" class="form-control" name="age" id="age" value="<?= set_value('age', $user['age']) ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <?php $gender = $user['gender']; ?>
                                            <label>Gender:</label>
                                            <br>
                                            <input type="radio" name="gender" <?php if (isset($gender) && $gender == "male") echo "checked"; ?> value="male">Male
                                            <input type="radio" name="gender" <?php if (isset($gender) && $gender == "female") echo "checked"; ?> value="female">Female
                                            <input type="radio" name="gender" <?php if (isset($gender) && $gender == "other") echo "checked"; ?> value="other">Other
                                        </div>
                                    </div>

                                    <!-- <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" value="">
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group">
                                            <label for="password_confirm">Confirm Password</label>
                                            <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="">
                                        </div>
                                    </div> -->
                                    <?php if (isset($validation)) : ?>
                                        <div class="col-12">
                                            <div class="alert alert-danger" role="alert">
                                                <?= $validation->listErrors() ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- edit password info bootstarp modal -->
    <div class="modal fade" id="changePassword" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="card-body">
                        <form class="" action="/profile/password" method="post">

                            <div class="row">

                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="firstname">First Name</label>
                                        <input type="text" class="form-control" readonly id="firstname" value="<?= $user['firstname'] ?>">
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="lastname">Last Name</label>
                                        <input type="text" class="form-control" readonly id="lastname" value="<?= $user['lastname'] ?>">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="text" class="form-control" readonly id="email" value="<?= $user['email'] ?>">
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" value="">
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="password_confirm">Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>

</section>