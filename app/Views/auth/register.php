<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register</div>

                <div class="card-body">
                    <form id="register-form" enctype="multipart/form-data">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Username<span class="text-danger"> *</span></label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="" autocomplete="name" autofocus placeholder="Name">
                                <span class="text-danger error" id="error-username"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address<span class="text-danger"> *</span></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="" autocomplete="email" placeholder="Email">
                                <span class="text-danger error" id="error-email"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-right">Date of Birth<span class="text-danger"> *</span></label>

                            <div class="col-md-6">
                                <input id="dob" type="date" class="form-control" name="dob" value="" autocomplete="dob" placeholder="DOB" max="{{ date('Y-m-d') }}">
                                <span class="text-danger error" id="error-dob"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mobile" class="col-md-4 col-form-label text-md-right">Mobile<span class="text-danger"> *</span></label>

                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control" name="mobile" value="" autocomplete="mobile" placeholder="Mobile">
                                <span class="text-danger error" id="error-mobile"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="state" class="col-md-4 col-form-label text-md-right">State<span class="text-danger"> *</span></label>

                            <div class="col-md-6">
                                <input id="state" type="text" class="form-control" name="state" value="" autocomplete="state" placeholder="State">
                                <span class="text-danger error" id="error-state"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Address<span class="text-danger"> *</span></label>

                            <div class="col-md-6">
                                <textarea id="address" class="form-control" name="address" autocomplete="address" placeholder="Address"></textarea>
                                <span class="text-danger error" id="error-address"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pincode" class="col-md-4 col-form-label text-md-right">Pin Code<span class="text-danger"> *</span></label>

                            <div class="col-md-6">
                                <input id="pincode" type="text" class="form-control" name="pincode" autocomplete="new-password" placeholder="Pincode">
                                <span class="text-danger error" id="error-pincode"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password<span class="text-danger"> *</span></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" autocomplete="new-password" placeholder="Password">
                                <span class="text-danger error" id="error-password"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password<span class="text-danger"> *</span></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="confirm_password" autocomplete="new-password" placeholder="Confirm Password">
                                <span class="text-danger error" id="error-confirm_password"></span>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
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