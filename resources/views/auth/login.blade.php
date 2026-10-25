<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Rashan Cart – Log in</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com/3.4.17"></script>
<script>tailwind.config={theme:{extend:{colors:{bg:'var(--bg)',sf:'var(--sf)',tx:'var(--tx)',mu:'var(--mu)',bd:'var(--bd)',br:'var(--br)',bs:'var(--bs)',bt:'var(--bt)'}}}}</script>
<style>
:root{box-sizing:border-box;padding-top:env(safe-area-inset-top,0px);padding-bottom:env(safe-area-inset-bottom,0px);--bg:#f6fdf9;--sf:#fff;--tx:#14261c;--mu:#6b8576;--bd:#e3f3ea;--br:#5fdc93;--bt:#168f4d;--bs:#e7faef;--sh:0 1px 2px rgba(20,38,28,.03),0 14px 36px -16px rgba(95,220,147,.4);color-scheme:light}
@media (prefers-color-scheme:dark){:root:not([data-theme="light"]){--bg:#0b1410;--sf:#111c16;--tx:#e8f3ec;--mu:#8fa99a;--bd:#213128;--br:#4ade80;--bt:#6ee7a0;--bs:#153a27;--sh:none;color-scheme:dark}}
:root[data-theme="dark"]{--bg:#0b1410;--sf:#111c16;--tx:#e8f3ec;--mu:#8fa99a;--bd:#213128;--br:#4ade80;--bt:#6ee7a0;--bs:#153a27;--sh:none;color-scheme:dark}
html{scroll-padding-top:env(safe-area-inset-top,0px)}
body{background:var(--bg);color:var(--tx);font-family:"Plus Jakarta Sans",system-ui,-apple-system,"Segoe UI",sans-serif}
.brand{background:linear-gradient(160deg,var(--bs),var(--bg) 70%);border-right:1px solid var(--bd)}
.card{background:var(--sf);border:1px solid var(--bd);border-radius:20px;box-shadow:var(--sh)}
.btn{border:1px solid var(--bd);border-radius:12px;padding:11px 16px;font-size:14px;font-weight:600;background:var(--sf);width:100%}
.btn:hover{border-color:var(--br)}
.btn-p{background:var(--br);border-color:var(--br);color:#06301a}
.btn:disabled{opacity:.5;cursor:not-allowed}
input,select{background:var(--sf);color:var(--tx);border:1px solid var(--bd);border-radius:12px;padding:11px 14px;font-size:14px;outline:none;width:100%;transition:border-color .15s,box-shadow .15s}
input::placeholder{color:var(--mu);opacity:.7}
input:focus{background:var(--sf);border-color:var(--br);box-shadow:0 0 0 3px color-mix(in srgb,var(--br) 25%,transparent)}
input[type=checkbox]{width:18px;height:18px;min-width:18px;margin:0;padding:0;flex:none;border:1.5px solid var(--bd);border-radius:5px;background:var(--sf);accent-color:var(--br);cursor:pointer;vertical-align:middle}
input[type=checkbox]:checked{border-color:var(--br);background:var(--br)}
input.bad{border-color:#f43f5e!important;box-shadow:0 0 0 3px color-mix(in srgb,#f43f5e 20%,transparent)}
.lnk{color:var(--bt);font-weight:600}.lnk:hover{text-decoration:underline}
.pop{animation:pop .22s ease-out}@keyframes pop{from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:none}}
@media (prefers-reduced-motion:reduce){.pop{animation:none}}
</style>
</head>
<body>
<div class="min-h-screen grid lg:grid-cols-2">
  <section class="brand hidden lg:flex flex-col justify-between p-12">
    <div class="flex items-center gap-2.5"><div class="w-10 h-10 rounded-xl bg-br text-[#06301a] grid place-items-center font-bold text-lg">R</div><span class="font-bold text-xl">Rashan Cart</span></div>
    <div>
      <h1 class="text-4xl font-bold tracking-tight leading-tight">Buy together.<br>Save together.</h1>
      <p class="text-mu mt-4 max-w-md">Your neighbors combine orders for groceries and household essentials, so everyone gets the bulk price.</p>
    </div>
  </section>
  <main class="relative flex items-center justify-center p-5 sm:p-10">
    <button id="th" type="button" class="absolute top-4 right-4 text-xs font-semibold border border-bd rounded-lg px-3 py-1.5 bg-sf">Theme</button>
    <div class="w-full max-w-md">
      <div class="lg:hidden flex items-center gap-2.5 mb-6"><div class="w-9 h-9 rounded-xl bg-br text-[#06301a] grid place-items-center font-bold">R</div><span class="font-bold text-lg">Rashan Cart</span></div>

      <div class="pop">
        <h2 class="text-2xl font-bold tracking-tight">Welcome back</h2>
        <p class="text-sm text-mu mt-1.5 mb-6">Log in to your Rashan Cart account.</p>

        {{-- Flash status from password reset or email verification --}}
        @if (session('status'))
          <div class="rounded-xl px-4 py-3 text-sm mb-4" style="background:var(--bs);color:var(--bt)" role="alert">
            {{ session('status') }}
          </div>
        @endif

        {{-- Validation errors --}}
        @if ($errors->any())
          <div class="rounded-xl px-4 py-3 text-sm mb-4" style="background:#f43f5e18;color:#e11d48" role="alert">
            {{ $errors->first() }}
          </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4" novalidate>
          @csrf

          <div>
            <label for="email" class="block text-xs font-semibold text-mu mb-1.5">Email address</label>
            <input id="email" name="email" type="email" autocomplete="username"
                   value="{{ old('email') }}" placeholder="you@example.com"
                   class="@error('email') bad @enderror" required autofocus>
            @error('email')<p class="text-xs text-rose-500 mt-1" role="alert">{{ $message }}</p>@enderror
          </div>

          <div>
            <label for="password" class="block text-xs font-semibold text-mu mb-1.5">Password</label>
            <div class="relative">
              <input id="password" name="password" type="password" autocomplete="current-password"
                     placeholder="Your password" style="padding-right:4rem"
                     class="@error('password') bad @enderror" required>
              <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-xs font-semibold text-bt select-none"
                      onclick="tgp('password',this)" aria-label="Toggle password visibility">Show</button>
            </div>
            @error('password')<p class="text-xs text-rose-500 mt-1" role="alert">{{ $message }}</p>@enderror
          </div>

          <div class="flex items-center justify-between gap-3 text-sm">
            <label class="flex items-center gap-2 text-sm text-mu cursor-pointer select-none">
              <input type="checkbox" name="remember" value="1" @checked(old('remember'))>
              Keep me signed in
            </label>
            <a href="{{ route('password.request') }}" class="lnk shrink-0">Forgot password?</a>
          </div>

          <button id="sb" type="submit" class="btn btn-p">Log in</button>
        </form>

        <p class="text-sm text-mu text-center mt-5">
          New to Rashan Cart? <a href="{{ route('register') }}" class="lnk">Create an account</a>
        </p>
        <p class="text-sm text-mu text-center mt-2">
          Have an invitation? <a href="{{ route('invite.form') }}" class="lnk">Activate your account</a>
        </p>
      </div>
    </div>
  </main>
</div>

<script>
function tgp(id, b) {
  const i = document.getElementById(id);
  i.type = i.type === 'password' ? 'text' : 'password';
  b.textContent = i.type === 'password' ? 'Show' : 'Hide';
}
document.getElementById('th').onclick = () => {
  const d = document.documentElement;
  const dk = d.dataset.theme ? d.dataset.theme === 'dark' : matchMedia('(prefers-color-scheme:dark)').matches;
  d.dataset.theme = dk ? 'light' : 'dark';
};
</script>
</body>
</html>