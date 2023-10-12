<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-4 text-left">Profile</div>
                            <div class="col-sm-8 text-right">
                                <a href="<?php echo base_url('u/users'); ?>" class="btn btn-primary pl-3 pr-3 btn-sm">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-12">
                                <div class="form-group" id="username">
                                    <label for="name" class="control-label"><strong>Username :</strong></label>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <div class="form-group" id="email">
                                    <label for="status" class="control-label"><strong>Email :</strong></label>
                                    <span></span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-12">
                                <div class="form-group" id="role_name">
                                    <label for="status" class="control-label"><strong>Role :</strong></label>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <div class="form-group" id="mobile">
                                    <label for="status" class="control-label"><strong>Mobile :</strong></label>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <div class="form-group" id="state">
                                    <label for="status" class="control-label"><strong>State :</strong></label>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <div class="form-group" id="pincode">
                                    <label for="status" class="control-label"><strong>Pin :</strong></label>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <div class="form-group" id="address">
                                    <label for="status" class="control-label"><strong>Address :</strong></label>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('footer') ?>
    <script type="text/javascript">
        getSingleUser('<?php echo $user['id']; ?>', 'show');
    </script> 
<?= $this->endSection() ?>
