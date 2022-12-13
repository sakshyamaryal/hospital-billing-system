<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-12">
                            <div class="card-body p-md-5 mx-md-4">

                                <div class="text-center">

                                    <h4 class="mt-1 mb-5 pb-1">Admin Login</h4>
                                </div>
                                <p>Please login to your account</p>
                                <div class="user"></div>
                                <div class="pass"></div>
                                <div class="incorrectpasswords"></div>

                                <form method="post" action="">

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example11">Username</label>
                                        <input type="text" id="form2Example11" class="form-control" name="username" require />
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example22">Password</label>
                                        <input type="password" id="form2Example22" class="form-control" name="password" require />

                                    </div>

                                    <div class="text-center pt-1 mb-5 pb-1">
                                        <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit" name="submit">Log
                                            in</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_POST['submit']) ==  TRUE) {
    $_SESSION['username'] = "admin";
    $_SESSION['password'] = "admin";
    if ($_POST['username'] == $_SESSION['username'] && $_POST['password'] == $_SESSION['password']) {
        header('location:' . base_url() . 'hospital/patientDetails');
    }

}

?>

