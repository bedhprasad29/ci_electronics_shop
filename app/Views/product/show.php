<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-4 text-left">Product</div>
                            <div class="col-sm-8 text-right">
                                <a href="<?php echo base_url('u/products'); ?>" class="btn btn-primary pl-3 pr-3 btn-sm">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-12">
                                <div class="form-group" id="name">
                                    <label for="name" class="control-label"><strong>Name :</strong></label>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-12">
                                <div class="form-group" id="category_name">
                                    <label for="sub_title" class="control-label"><strong>Category :</strong></label>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-12">
                                <div class="form-group" id="description">
                                    <label for="description" class="control-label"><strong>Description :</strong></label>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <div class="form-group" id="price">
                                    <label for="status" class="control-label"><strong>Price :</strong></label>
                                    <span></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" id="status">
                                    <label for="status" class="control-label"><strong>Status :</strong></label>
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
        getSingleProduct('<?php echo $uri->getSegment(3); ?>', 'show');
    </script> 
<?= $this->endSection() ?>
