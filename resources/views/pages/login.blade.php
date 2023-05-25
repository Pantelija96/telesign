<!-- Does not have a parent layout -->
<!DOCTYPE html>
<html lang="en" dir="ltr" data-color-theme="dark">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Telesign app</title>

    <!-- Global stylesheets -->
    <link href="{{asset('/')}}assets/fonts/inter/inter.css" rel="stylesheet" type="text/css">
    <link href="{{asset('/')}}assets/icons/phosphor/styles.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('/')}}assets/css/all.min.css" id="stylesheet" rel="stylesheet" type="text/css">
    <link href="{{asset('/')}}assets/css/custom.css" id="stylesheet" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{asset('/')}}assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{asset('/')}}assets/js/app.js"></script>
    <!-- /theme JS files -->

</head>
<body>

<!-- Main navbar -->
<div class="navbar navbar-static py-2" style="background-color: #202125;">
    <div class="container-fluid">

        <div class="d-flex justify-content-end align-items-center ms-auto">
            <ul class="navbar-nav flex-row">
                <li class="nav-item">
                    <a href="#" class="navbar-nav-link navbar-nav-link-icon rounded ms-1">
                        <div class="d-flex align-items-center mx-md-1">
                            <i class="ph-lifebuoy"></i>
                            <span class="d-none d-md-inline-block ms-2">Support</span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /main navbar -->


<!-- Page content -->
<div class="page-content">

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Inner content -->
        <div class="content-inner">

            <!-- Content area -->
            <div class="content d-flex justify-content-center align-items-center">

                <!-- Login form -->
                <form class="login-form" action="index.html">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <div class="d-inline-flex align-items-center justify-content-center mb-4 mt-2">
                                    <img src="{{asset('/')}}assets/img/telesignBlueLogo.png" class="h-48px" alt="">
                                </div>
                                <h3 class="mb-0">Login to your account</h3>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <div class="form-control-feedback form-control-feedback-start">
                                    <input type="text" class="form-control" placeholder="Username">
                                    <div class="form-control-feedback-icon">
                                        <i class="ph-user-circle text-muted"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <div class="form-control-feedback form-control-feedback-start">
                                    <input type="password" class="form-control" placeholder="•••••••••••">
                                    <div class="form-control-feedback-icon">
                                        <i class="ph-lock text-muted"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-telesign w-100">Sign in</button>
                            </div>

                            <div class="text-center">
                                <a href="#">Forgot password?</a>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- /login form -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /inner content -->

    </div>
    <!-- /main content -->

</div>
<!-- /page content -->

</body>
</html>
