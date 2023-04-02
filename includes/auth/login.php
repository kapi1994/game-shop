<main class="container">
    <div class="row mt-5">
        <div class="col-lg-4 mx-auto">
            <form action="#">
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
                    <button class="btn btn-primary" type="button" id="btnLogIn">Log in</button>
                    <div class="d-flex justify-content-center mt-3">
                        Nemate nalog? <a href="index.php?page=register" class="nav-link ms-2 text-primary">Registrujte se</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>