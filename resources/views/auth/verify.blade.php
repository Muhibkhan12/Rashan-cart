<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Rashan Cart – Verify your email</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com/3.4.17"></script>
<script>
tailwind.config = {
  theme: {
    extend: {
      fontFamily: { sans: ['Inter', 'system-ui', 'sans-serif'] },
      colors: {
        ink:      '#0b1220',
        muted:    '#6b7280',
        line:     '#e5e7eb',
        brand:    '#2563eb',
        'brand-d':'#1d4ed8',
        'brand-l':'#eff6ff',
      },
    },
  },
};
</script>
<style>
:root { color-scheme: light; }
* { -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }
body { font-family: 'Inter', system-ui, sans-serif; background: #f6f7f9; color: #0b1220; }

.btn-primary {
  width: 100%;
  height: 44px;
  border-radius: 8px;
  font-size: 14px;
  font-weight: 600;
  color: #fff;
  background: #2563eb;
  border: 1px solid #2563eb;
  cursor: pointer;
  transition: background .12s, box-shadow .12s, transform .06s;
}
.btn-primary:hover { background: #1d4ed8; border-color: #1d4ed8; }
.btn-primary:active { transform: translateY(.5px); }
.btn-primary:focus-visible {
  outline: none;
  box-shadow: 0 0 0 3px rgba(37, 99, 235, .30);
}

.btn-secondary {
  width: 100%;
  height: 44px;
  border-radius: 8px;
  font-size: 14px;
  font-weight: 500;
  color: #0b1220;
  background: #fff;
  border: 1px solid #e5e7eb;
  cursor: pointer;
  transition: background .12s, border-color .12s;
}
.btn-secondary:hover { background: #f9fafb; border-color: #d1d5db; }
.btn-secondary:focus-visible {
  outline: none;
  box-shadow: 0 0 0 3px rgba(37, 99, 235, .15);
}

.lnk { color: #2563eb; font-weight: 500; }
.lnk:hover { text-decoration: underline; text-underline-offset: 2px; }

.brand-mark {
  width: 32px; height: 32px;
  border-radius: 8px;
  background: #2563eb;
  color: #fff;
  display: grid;
  place-items: center;
  font-weight: 700;
  font-size: 15px;
}

.grid-bg {
  background-color: #0b1220;
  background-image:
    linear-gradient(rgba(255,255,255,.04) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.04) 1px, transparent 1px);
  background-size: 40px 40px;
  background-position: -1px -1px;
  position: relative;
}
.grid-bg::before {
  content: "";
  position: absolute;
  inset: 0;
  background: radial-gradient(60% 50% at 50% 0%, rgba(37, 99, 235, .25) 0%, transparent 70%);
  pointer-events: none;
}

.bullet {
  width: 20px; height: 20px;
  border-radius: 50%;
  background: rgba(37, 99, 235, .15);
  color: #93c5fd;
  display: grid;
  place-items: center;
  flex: none;
}

.fade-up { animation: fadeUp .4s ease-out both; }
.d1 { animation-delay: .05s; }
.d2 { animation-delay: .1s; }
.d3 { animation-delay: .15s; }
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(8px); }
  to   { opacity: 1; transform: translateY(0); }
}
@media (prefers-reduced-motion: reduce) { .fade-up { animation: none; } }

/* Envelope illustration */
.mail-icon {
  width: 64px;
  height: 64px;
  border-radius: 16px;
  background: #eff6ff;
  color: #2563eb;
  display: grid;
  place-items: center;
  margin: 0 auto;
}
</style>
</head>
<body>

<div class="min-h-screen grid lg:grid-cols-2">

  <!-- ============ LEFT: Brand panel ============ -->
  <aside class="hidden lg:flex grid-bg text-white flex-col justify-between p-12 relative">
    <div class="relative z-10 flex items-center gap-2.5 fade-up d1">
      <div class="brand-mark">R</div>
      <span class="font-semibold text-[15px] tracking-tight">Rashan Cart</span>
    </div>

    <div class="relative z-10 max-w-md fade-up d2">
      <h1 class="text-[40px] leading-[1.1] font-bold tracking-tight">
        One quick step<br>and you're in.
      </h1>
      <p class="text-[15px] text-slate-400 mt-4 leading-relaxed">
        We verify every email so only real neighbors can join group-buy campaigns. It keeps pricing honest and your orders safe.
      </p>

      <ul class="mt-8 space-y-4">
        <li class="flex items-start gap-3">
          <span class="bullet">
            <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7"/></svg>
          </span>
          <div>
            <p class="text-sm font-semibold">Link valid for 60 minutes</p>
            <p class="text-[13px] text-slate-400 mt-0.5">Plenty of time. If it expires, we'll send a fresh one.</p>
          </div>
        </li>
        <li class="flex items-start gap-3">
          <span class="bullet">
            <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7"/></svg>
          </span>
          <div>
            <p class="text-sm font-semibold">Check spam if it's missing</p>
            <p class="text-[13px] text-slate-400 mt-0.5">Sometimes the first email lands in promotions or spam.</p>
          </div>
        </li>
        <li class="flex items-start gap-3">
          <span class="bullet">
            <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7"/></svg>
          </span>
          <div>
            <p class="text-sm font-semibold">Wrong email? Just re-register</p>
            <p class="text-[13px] text-slate-400 mt-0.5">You can sign out and sign up again with the right address.</p>
          </div>
        </li>
      </ul>
    </div>

    <div class="relative z-10 flex items-center gap-6 text-[13px] text-slate-400 fade-up d3">
      <div class="flex items-center gap-2">
        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
        All systems operational
      </div>
      <span class="w-px h-4 bg-white/10"></span>
      <span>© 2026 Rashan Cart</span>
    </div>
  </aside>

  <!-- ============ RIGHT: Verify panel ============ -->
  <main class="flex items-center justify-center p-6 sm:p-10 bg-white">
    <div class="w-full max-w-[420px] py-8">

      <!-- Mobile logo -->
      <div class="lg:hidden flex items-center gap-2.5 mb-10">
        <div class="brand-mark">R</div>
        <span class="font-semibold text-[15px] tracking-tight">Rashan Cart</span>
      </div>

      <div class="fade-up">

        <div class="mail-icon mb-6">
          <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="5" width="18" height="14" rx="2"/>
            <path d="m3 7 9 6 9-6"/>
          </svg>
        </div>

        <h2 class="text-[26px] font-semibold tracking-tight text-center">Verify your email</h2>
        <p class="text-[14px] text-muted mt-2 text-center leading-relaxed">
          We just sent a verification link to<br>
          <span class="font-medium text-ink">{{ auth()->user()->email ?? session('email', 'your inbox') }}</span>.
        </p>

        <div class="mt-6 px-4 py-3 rounded-lg border border-blue-200 bg-blue-50 text-[13px] text-blue-800 leading-relaxed">
          Click the link in that email to activate your account. It expires in <strong>60 minutes</strong>.
        </div>

        {{-- Flash status (after clicking "resend") --}}
        @if (session('status') === 'verification-link-sent')
          <div class="mt-4 px-4 py-3 rounded-lg border border-green-200 bg-green-50 text-[13px] text-green-800" role="alert">
            A new verification link has been sent to your email.
          </div>
        @endif

        {{-- Any other flash --}}
        @if (session('status') && session('status') !== 'verification-link-sent')
          <div class="mt-4 px-4 py-3 rounded-lg border border-blue-200 bg-blue-50 text-[13px] text-blue-800" role="alert">
            {{ session('status') }}
          </div>
        @endif

        {{-- Errors (e.g. throttled resend) --}}
        @if ($errors->any())
          <div class="mt-4 px-4 py-3 rounded-lg border border-red-200 bg-red-50 text-[13px] text-red-800" role="alert">
            {{ $errors->first() }}
          </div>
        @endif

        <!-- Resend -->
        <form method="POST" action="{{ route('verification.send') }}" class="mt-6 space-y-3">
          @csrf
          <button type="submit" class="btn-primary">Resend verification email</button>
        </form>

        <!-- Sign out -->
        <form method="POST" action="{{ route('logout') }}" class="mt-3">
          @csrf
          <button type="submit" class="btn-secondary">Sign out</button>
        </form>

        <p class="text-[12px] text-muted text-center mt-6 leading-relaxed">
          Wrong email address? Sign out and
          <a href="{{ route('register') }}" class="lnk">register again</a>
          with the correct one.
        </p>

      </div>
    </div>
  </main>
</div>

</body>
</html>