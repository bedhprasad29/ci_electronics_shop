<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-4 text-left">Employee - Edit</div>
                            <div class="col-sm-8 text-right">
                                <a href="<?php echo base_url('u/users'); ?>" class="btn btn-primary pl-3 pr-3 btn-sm">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form id="user-update-form">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name<span class="text-danger"> *</span></label>
                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control" name="username" autofocus placeholder="Username">
                                    <span class="text-danger error" id="error-username"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="dob" class="col-md-4 col-form-label text-md-right">Email<span class="text-danger"> *</span></label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" placeholder="Email">
                                    <span class="text-danger error" id="error-email"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="dob" class="col-md-4 col-form-label text-md-right">Date of Birth<span class="text-danger"> *</span></label>
                                <div class="col-md-6">
                                    <input id="dob" type="date" class="form-control" name="dob" placeholder="DOB">
                                    <span class="text-danger error" id="error-dob"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mobile" class="col-md-4 col-form-label text-md-right">Mobile<span class="text-danger"> *</span></label>
                                <div class="col-md-6">
                                    <input id="mobile" type="text" class="form-control" name="mobile" placeholder="Mobile">
                                    <span class="text-danger error" id="error-mobile"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="state" class="col-md-4 col-form-label text-md-right">State<span class="text-danger"> *</span></label>
                                <div class="col-md-6">
                                    <input id="state" type="text" class="form-control" name="state" placeholder="State">
                                    <span class="text-danger error" id="error-state"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">Address<span class="text-danger"> *</span></label>
                                <div class="col-md-6">
                                    <textarea id="address" class="form-control" name="address" placeholder="Address"></textarea>
                                    <span class="text-danger error" id="error-address"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="pincode" class="col-md-4 col-form-label text-md-right">Pin Code<span class="text-danger"> *</span></label>
                                <div class="col-md-6">
                                    <input id="pincode" type="text" class="form-control" name="pincode" placeholder="Pincode">
                                    <span class="text-danger error" id="error-pincode"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('footer') ?>
    <script type="text/javascript">
        getSingleUser('<?php echo $uri->getSegment(3); ?>', 'edit');

        $(document).on('submit', '#user-update-form', function(e) {
            e.preventDefault();
            updateUser('#user-update-form', '<?php echo $uri->getSegment(3); ?>');
        });
    </script>
<?= $this->endSection() ?>