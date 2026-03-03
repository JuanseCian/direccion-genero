<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<title>Nueva Contraseña</title>

<style>
body { 
    background-color: rgb(121, 115, 207);
    display:flex;
    min-height:100vh;
    align-items:center;
}
.card { border-radius:15px; box-shadow:0 4px 15px rgba(0,0,0,0.1);}
</style>
</head>
<body>

<div class="container">
<div class="row justify-content-center">
<div class="col-md-6">

<div class="card p-5 bg-white">
    <h3 class="mb-4">Restablecer contraseña</h3>

    <form method="POST" action="{{ route('password.store') }}" id="resetForm">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
        </div>

        <div class="mb-3 position-relative">
            <label>Nueva contraseña</label>
            <div class="input-group">
                <input type="password" name="password" id="password" class="form-control" required>
                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password">
                    <i class="bi bi-eye"></i>
                </button>
            </div>

            <!-- Requisitos -->
            <div id="passwordRules" class="alert alert-warning mt-2 d-none" style="font-size:0.85rem;">
                <strong>La contraseña debe tener:</strong>
                <ul class="mb-0 ps-3">
                    <li id="rule-length" class="text-danger">✖ Mínimo 8 caracteres</li>
                    <li id="rule-lower" class="text-danger">✖ Al menos una minúscula</li>
                    <li id="rule-special" class="text-danger">✖ Al menos un carácter especial</li>
                </ul>
            </div>
        </div>

        <div class="mb-3">
            <label>Confirmar contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>

            <div id="matchAlert" class="alert alert-danger py-1 mt-2 d-none" style="font-size:0.85rem;">
                Las contraseñas no coinciden
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Cambiar contraseña
        </button>
    </form>
</div>

</div>
</div>
</div>

<script>
document.querySelectorAll('.toggle-password').forEach(btn => {
    btn.addEventListener('click', function () {
        const input = document.getElementById(this.dataset.target);
        const icon = this.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye','bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye-slash','bi-eye');
        }
    });
});
</script>

<script>
const passwordInput = document.getElementById('password');
const confirmInput = document.getElementById('password_confirmation');
const rulesBox = document.getElementById('passwordRules');
const matchAlert = document.getElementById('matchAlert');
const form = document.getElementById('resetForm');

function validatePassword() {
    const value = passwordInput.value;
    let errors = 0;

    rulesBox.classList.remove('d-none');

    function checkRule(id, condition) {
        const el = document.getElementById(id);
        if (condition) {
            el.classList.remove('text-danger');
            el.classList.add('text-success');
            el.innerHTML = el.innerHTML.replace('✖', '✔');
        } else {
            el.classList.remove('text-success');
            el.classList.add('text-danger');
            el.innerHTML = el.innerHTML.replace('✔', '✖');
            errors++;
        }
    }

    checkRule('rule-length', value.length >= 8);
    checkRule('rule-lower', /[a-z]/.test(value));
    checkRule('rule-special', /[!@#$%^&*()_+{}\[\]:;"'<>,.?~`]/.test(value));

    if(value === ''){
        rulesBox.classList.add('d-none');
    }

    return errors === 0;
}

function validateMatch() {
    if (confirmInput.value === '') {
        matchAlert.classList.add('d-none');
        confirmInput.classList.remove('is-invalid','is-valid');
        return true;
    }

    if (passwordInput.value !== confirmInput.value) {
        matchAlert.classList.remove('d-none');
        confirmInput.classList.add('is-invalid');
        confirmInput.classList.remove('is-valid');
        return false;
    } else {
        matchAlert.classList.add('d-none');
        confirmInput.classList.remove('is-invalid');
        confirmInput.classList.add('is-valid');
        return true;
    }
}

passwordInput.addEventListener('input', () => {
    validatePassword();
    validateMatch();
});

confirmInput.addEventListener('input', validateMatch);

form.addEventListener('submit', function(e){
    if (!validatePassword() || !validateMatch()) {
        e.preventDefault();
        passwordInput.focus();
    }
});
</script>
</body>
</html>