<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-4 text-left">Categories</div>
                            <div class="col-sm-8 text-right">
                                <a href="<?php echo base_url('u/categories/new'); ?>" class="btn btn-primary pl-3 pr-3 btn-sm">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Add New
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm" id="category-list">
                                <thead>
                                    <tr>
                                        <th scope="col"> Name </th>
                                        <th scope="col"> Status </th>
                                        <th scope="col"> Action </th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('footer') ?>
    <script type="text/javascript">
        getCategoryList();
    </script>
<?= $this->endSection() ?>