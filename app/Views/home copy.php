<?= $this->extend('layouts.front') ?>

<?= $this->section('header') ?>
    <header class="masthead" style="background-image: url('images/home-bg.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>Blogs</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">

                @foreach($posts as $post)
                    <!-- Post preview-->
                    <div class="post-preview">
                        <a href="{{ route('post-detail', [$post->id]) }}">
                            <h2 class="post-title">{{ $post->title }}</h2>
                            <h3 class="post-subtitle">{{ $post->sub_title }}</h3>
                        </a>
                        <p class="post-meta">
                            Posted by
                            <a href="#!">{{ $post->user->name }}</a>
                            on {{ $post->created_at->format('F d, Y') }}
                        </p>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                @endforeach

                <!-- Pager-->
                <div class="d-flex">
                    <div class="mx-auto">
                        {{ $posts->links("pagination::bootstrap-4") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
