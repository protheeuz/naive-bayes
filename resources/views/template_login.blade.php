<!DOCTYPE html>
<html class="loading" lang="en">
<head>
    <!-- Meta tags and CSS links -->
</head>
<body class="vertical-layout vertical-menu 1-column auth-page navbar-sticky blank-page" data-menu="vertical-menu" data-col="1-column">
    <div class="wrapper">
        <div class="main-panel">
            <div class="main-content">
                <div class="content-overlay"></div>
                <div class="content-wrapper">
                    <section id="login" class="auth-height">
                        <div class="row full-height-vh m-0">
                            <div class="col-12 d-flex align-items-center justify-content-center">
                                <div class="card overflow-hidden">
                                    <div class="card-content">
                                        <div class="card-body auth-img">
                                            <div class="row m-0">
                                                <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center auth-img-bg p-3">
                                                    <img src="{{ asset('assets/img/gallery/login.png') }}" alt="" class="img-fluid" width="300" height="230">
                                                </div>
                                                <div class="col-lg-6 col-12 px-4 py-3" style="max-width: 500px;">
                                                    <h4 class="mb-2 card-title">Login</h4>
                                                    <p>Selamat datang di Aplikasi SPK Metode NAIVE BAYES</p>
                                                    <form action="{{ route('login') }}" method="post" id="form_login">
                                                        @csrf
                                                        <input type="text" name="username" value="admin" class="form-control mb-3" placeholder="Username">
                                                        <input type="password" name="password" value="admin" class="form-control mb-2" placeholder="Password">
                                                        <div class="d-flex justify-content-between flex-sm-row flex-column">
                                                            <button type="submit" id="btn_login" class="btn btn-primary">Login</button>
                                                        </div>
                                                    </form>
                                                    <hr>
                                                    <p style="word-wrap: break-word;">Naive Bayes merupakan pengklasifikasian dengan metode probabilitas dan statistik yang dikemukan oleh ilmuwan Inggris Thomas Bayes, yaitu memprediksi peluang di masa depan berdasarkan pengalaman di masa sebelumnya.</p>
                                                    <hr>
                                                    Copyright &copy; {{ date('Y') }} <a href="https://upi-yai.ac.id/page/teknik-informatika-s-1">Universitas Persada Indonesia YAI</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    jQuery(document).ready(function() {
        $('#form_login').submit(function (e) {
            data = $(this).serializeArray();
            data.push({'name': 'login', 'value': 'true'});
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: data,
                beforeSend: function(data) {
                    $('#btn_login').prop('disabled', true);
                    $('#btn_login').html('<span class="spinner-border spinner-border-sm me-05" role="status" aria-hidden="true"></span> Loading');
                },
                error: function(xhr, status, error) {
                    $('#btn_login').prop('disabled', false);
                    $('#btn_login').html('Login');
                    Swal.fire({
                        text: xhr.responseText,
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "OK",
                        customClass: { confirmButton: "btn btn-primary" },
                    });
                },
                success: function(data) {
                    location.reload();
                }
            });
            e.preventDefault();
        });
    });
    </script>

</body>
</html>