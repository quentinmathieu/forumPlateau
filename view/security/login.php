<div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body p-5">
                        <h2 class="text-uppercase text-center mb-5">Log In</h2>

                        <form action ="index.php?ctrl=security&action=checkLogin" method="post" class="container">


                            <div class="form-outline mb-4">
                                <input type="email" id="email" name ="email" class="form-control form-control-lg" />
                                <label class="form-label" for="email">Your Email</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" id="password" name="password" class="form-control form-control-lg" />
                                <label class="form-label" for="password">Password</label>
                            </div>


                            <div class="d-flex justify-content-center">
                                <input type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body" value="Log In">
                            </div>

                            <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="#!" class="fw-bold text-body"><u>Login here</u></a></p>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>