<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-4 text-left">Reset Password</div>
                            <div class="col-sm-8 text-right">
                                <a href="<?php echo base_url('u/profile'); ?>" class="btn btn-primary pl-3 pr-3 btn-sm">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form id="reset-form">
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
        $(document).on('submit', '#reset-form', function(e) {
            e.preventDefault();
            resetPassword('#reset-form', '<?= $user['id']; ?>');
        });
    </script>
<?= $this->endSection() ?>