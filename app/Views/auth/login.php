<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login</div>

                <div class="card-body">
                    <form id="signin-form">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" autocomplete="email" autofocus>
                                <span class="text-danger error" id="error-email"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" autocomplete="current-password">
                                <span class="text-danger error" id="error-password"></span>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
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
    <script>
        var signInForm = '#signin-form';
        $(document).on('submit', signInForm, function(e) {
            e.preventDefault();

            let form = document.querySelector(signInForm);
            var data = new FormData(form);

            axios({
                method: 'POST',
                url: SIGNIN_API,
                data: data,
                headers: { 'Content-Type': $(this).prop('enctype') },
            })
            .then(function (response) {
                var res = response.data;
                if (res.access_token != '') {
                    localStorage.setItem('token', res.access_token);
                    window.location = '/u/profile'
                }
            })
            .catch(function (error) {
                showErrors(error, signInForm);
            });
        });
    </script>
<?= $this->endSection() ?>