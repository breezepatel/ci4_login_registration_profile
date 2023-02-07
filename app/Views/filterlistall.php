<section id="listall">

    <div class="container mt-4 pd-4" style="text-align: center;">
        <div class="row">
            <div class="col-12 ">

                <h1> Current User Name : <?= session()->get('firstname') ?></h1>

                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="card">
                                <div class="card-header bg-purple text-black">
                                    <div class="card-header-title">
                                        <h2>List of registered user<h2>
                                    </div>
                                </div>

                                <div class=" container">
                                    <form action="search" method ="post">
                                        <div class="input-group">
                                            <input type="search" class="form-control rounded" id="keyword" name="keyword" required placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                                            <button type="submit" value="search" class="btn btn-primary">Search</button>
                                        </div>
                                    </form>
                                </div>

                                <div class="card-body">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>ID</th>
                                            <th>First Name</th>
                                            <th>Laast Name</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Email</th>
                                            <th>Created At</th>
                                            <!-- <th>Password</th> -->
                                        </tr>

                                        <?php if (!empty($registered)) {
                                            foreach ($registered as $register) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $register['id']; ?></td>
                                                    <td><?php echo $register['firstname']; ?></td>
                                                    <td><?php echo $register['lastname']; ?></td>
                                                    <td><?php echo $register['age']; ?></td>
                                                    <td><?php echo $register['gender']; ?></td>
                                                    <td><?php echo $register['email']; ?></td>
                                                    <td><?php echo $register['created_at']; ?></td>

                                                </tr>
                                            <?php }
                                        } else { ?>
                                            <tr>
                                                <td colspan="6">Records not found</td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                             <div>
                                <a class="nav-link" href="/listall/">
                                <button class="btn btn-primary">List All Users</button></a>
                             </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>