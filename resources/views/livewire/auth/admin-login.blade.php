<div class="auth-page">
    <div class="container d-flex align-items-center justify-content-center" style="min-height:80vh">
        <div class="card shadow-sm" style="max-width:420px; width:100%; border-radius:12px;">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <!-- <img src="/tabler/theme/img/logo.png" alt="Logo" style="height:48px;" onerror="this.style.display='none'"> -->
                    <h4 class="mt-3 mb-0">Admin Login</h4>
                    <p class="text-muted small">Sign in to your admin panel</p>
                </div>

                @if(session()->has('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form wire:submit.prevent="login">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input wire:model.defer="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="you@example.com">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input wire:model.defer="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Your password">
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input wire:model="remember" class="form-check-input" type="checkbox" id="remember">
                            <label class="form-check-label small" for="remember">Remember me</label>
                        </div>

                        <a href="#" class="small">Forgot password?</a>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Sign in</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center small text-muted">© {{ date('Y') }} Your Company</div>
        </div>
    </div>

    <style>
        body{ background: linear-gradient(180deg,#f8fafc,#eef2ff); }
        .card{ border:0; }
        .btn-primary{ background-image: linear-gradient(90deg,#4f46e5,#06b6d4); border:0; color:#fff; }
    </style>
</div>
