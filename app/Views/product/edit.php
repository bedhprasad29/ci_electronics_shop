<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-4 text-left">Product - Edit</div>
                            <div class="col-sm-8 text-right">
                                <a href="<?php echo base_url('u/products'); ?>" class="btn btn-primary pl-3 pr-3 btn-sm">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form id="product-update-form">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name<span class="text-danger"> *</span></label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="" autocomplete="name" autofocus placeholder="Name">
                                    <span class="text-danger error" id="error-name"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="category_id" class="col-md-4 col-form-label text-md-right">Category<span class="text-danger"> *</span></label>
                                <div class="col-md-6">
                                    <select id="category_id" class="form-control" name="category_id"></select>
                                    <span class="text-danger error" id="error-category_id"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Description<span class="text-danger"> *</span></label>
                                <div class="col-md-6">
                                    <textarea id="description" class="form-control" name="description"></textarea>
                                    <span class="text-danger error" id="error-description"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-md-4 col-form-label text-md-right">Price<span class="text-danger"> *</span></label>
                                <div class="col-md-6">
                                    <input id="price" type="text" class="form-control" name="price" value="" autocomplete="price" placeholder="Price">
                                    <span class="text-danger error" id="error-price"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status" class="col-md-4 col-form-label text-md-right">Status<span class="text-danger"> *</span></label>
                                <div class="col-md-6">
                                    <select id="status" class="form-control" name="status">
                                        <option value="">--Select--</option>
                                        <option value="A">Active</option>
                                        <option value="I">InActive</option>
                                    </select>
                                    <span class="text-danger error" id="error-status"></span>
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
        prepareCategoryDropDown('select#category_id');

        getSingleProduct('<?php echo $uri->getSegment(3); ?>', 'edit');

        $(document).on('submit', '#product-update-form', function(e) {
            e.preventDefault();
            updateProduct('#product-update-form', '<?php echo $uri->getSegment(3); ?>');
        });
    </script> 
<?= $this->endSection() ?>