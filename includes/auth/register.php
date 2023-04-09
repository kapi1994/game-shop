<main class="container">
    <div class="row mt-5">
        <div class="col-lg-4 mx-auto">
            <div id="register_response_messages"></div>
            <form action="#">
                <div class="mb-3">
                    <lable class="mb-1" for='first_name'>Ime</lable>
                    <input type="text" name="first_name" id="first_name" class="form-control">
                    <div id="first_name_error" class="mt-1"></div>
                </div>
                <div class="mb-3">
                    <label for="last_name" class="mb-1">Prezime</label>
                    <input type="text" name="last_name" id="last_name" class="form-control">
                    <div id="last_name_error" class="mt-1"></div>
                </div>
                <div class="mb-3">
                    <label for="email" class="mb-1">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                    <div id="email_error" class="mt-1"></div>
                </div>
                <div class="mb-3">
                    <label for="password" class="mb-1">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <div id="password_error" class="mt-1"></div>
                </div>
                <div class="d-grid">
                    <button class="btn btn-primary" type="button" id="btnRegister">Registruj se</button>
                    <div class="d-flex mt-3 justify-content-center">
                        Allready have an account? <a href="index.php?page=login" class="nav-link ms-2 text-primary">Log in</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>