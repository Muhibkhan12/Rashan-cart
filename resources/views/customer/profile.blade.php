<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Rashan Cart – Profile</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com/3.4.17"></script>
<script>tailwind.config={theme:{extend:{colors:{bg:'var(--bg)',sf:'var(--sf)',tx:'var(--tx)',mu:'var(--mu)',bd:'var(--bd)',br:'var(--br)',bs:'var(--bs)',bt:'var(--bt)'}}}}</script>
<style>
:root{box-sizing:border-box;padding-top:env(safe-area-inset-top,0px);padding-bottom:env(safe-area-inset-bottom,0px);--bg:#f9fcfa;--sf:#fff;--tx:#2d4036;--mu:#97a99f;--bd:#e6eee9;--br:#d8f1e2;--bs:#f2faf6;--bt:#66a985;--pf:#9ad8b4;--bp:#d8f1e2;--bpt:#3a7a58;--er:#e07b90;--ih:44px;--sh:0 1px 2px rgba(45,64,54,.025),0 10px 28px -14px rgba(150,210,175,.35);color-scheme:light}
@media (prefers-color-scheme:dark){:root:not([data-theme="light"]){--bg:#0f1913;--sf:#15221b;--tx:#e6f1ea;--mu:#8aa296;--bd:#2a3d33;--br:#2c5a42;--bs:#183024;--bt:#7fd8a5;--pf:#4fb883;--bp:#24523b;--bpt:#c4f0d7;--sh:none;color-scheme:dark}}
:root[data-theme="dark"]{--bg:#0f1913;--sf:#15221b;--tx:#e6f1ea;--mu:#8aa296;--bd:#2a3d33;--br:#2c5a42;--bs:#183024;--bt:#7fd8a5;--pf:#4fb883;--bp:#24523b;--bpt:#c4f0d7;--sh:none;color-scheme:dark}
html{scroll-padding-top:env(safe-area-inset-top,0px)}
body{background:var(--bg);color:var(--tx);font-family:"Plus Jakarta Sans",system-ui,-apple-system,"Segoe UI",sans-serif;font-size:15px;line-height:1.5}
.card{background:var(--sf);border:1px solid var(--bd);border-radius:20px;box-shadow:var(--sh)}
.btn{border:1px solid var(--bd);border-radius:12px;padding:9px 16px;font-size:13px;font-weight:600;background:var(--sf);white-space:nowrap;color:var(--tx);transition:background .15s,border-color .15s}
.btn:hover{border-color:var(--br);background:var(--bs)}
.btn-p{background:var(--bp);border-color:var(--bp);color:var(--bpt)}
.btn-p:hover{background:color-mix(in srgb,var(--bp) 85%,var(--pf));border-color:transparent}
.btn:disabled{opacity:.5;cursor:not-allowed}
.btn-f{height:var(--ih);padding-top:0;padding-bottom:0;display:inline-flex;align-items:center;justify-content:center}
.nav{display:flex;gap:10px;align-items:center;padding:10px 14px;border-radius:12px;font-size:14px;font-weight:500;color:var(--mu);width:100%;text-align:left}
.nav:hover{background:var(--bs)}
.nav.on{background:var(--bs);color:var(--bt);font-weight:600}
.chip{padding:7px 16px;border-radius:999px;font-size:13px;font-weight:600;color:var(--mu);border:1px solid var(--bd);white-space:nowrap;background:var(--sf)}
.chip.on{background:var(--bs);color:var(--bt);border-color:var(--br)}
.fl{display:block;font-size:12px;font-weight:600;color:var(--mu);margin-bottom:6px}
input,select{background:var(--sf);color:var(--tx);border:1.5px solid var(--bd);border-radius:12px;height:var(--ih);padding:0 14px;font-size:14px;font-family:inherit;outline:none;width:100%;transition:border-color .15s,box-shadow .15s}
input::placeholder{color:var(--mu);opacity:.7}
input:hover,select:hover{border-color:color-mix(in srgb,var(--bd) 50%,var(--pf))}
input:focus,select:focus{border-color:var(--pf);box-shadow:0 0 0 4px color-mix(in srgb,var(--br) 55%,transparent)}
input.bad,select.bad{border-color:var(--er)!important;box-shadow:0 0 0 4px color-mix(in srgb,var(--er) 15%,transparent)}
select{appearance:none;-webkit-appearance:none;cursor:pointer;padding-right:40px;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2397a99f' stroke-width='2.4' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 14px center}
.err{font-size:12px;color:var(--er);margin-top:5px;font-weight:500}
.err:empty{display:none}
.pop{animation:pop .18s ease-out}@keyframes pop{from{opacity:0;transform:translateY(6px)}to{opacity:1;transform:none}}
@media (prefers-reduced-motion:reduce){.pop{animation:none}}
</style>
</head>
<body>
<div class="flex min-h-screen">

  @include('customer.sidebar')

  <main class="flex-1 min-w-0">

    {{-- Top bar --}}
    <header class="sticky top-0 z-20 px-4 md:px-8 py-3 flex items-center gap-3 border-b border-bd" style="background:var(--bg)">
      <div class="relative flex-1 max-w-md">
        <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-mu pointer-events-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M11 19a8 8 0 1 0 0-16 8 8 0 0 0 0 16M21 21l-4.3-4.3"/></svg>
        <input id="gs" type="search" placeholder="Search" style="padding-left:42px" aria-label="Search" autocomplete="off">
      </div>
      <div class="ml-auto flex items-center gap-2">
        <button class="btn" id="th">Theme</button>
        <div class="w-10 h-10 rounded-full bg-br text-[#3a7a58] grid place-items-center text-sm font-bold">
          {{ strtoupper(substr(auth()->user()->name ?? 'AM', 0, 2)) }}
        </div>
      </div>
    </header>

    {{-- ===== PAGE CONTENT ===== --}}
    <div class="p-4 md:p-8 max-w-[1100px] mx-auto">

      <div class="mb-6">
        <h1 class="text-2xl font-bold tracking-tight">Profile</h1>
        <p class="text-sm text-mu mt-1">Manage your details and delivery addresses.</p>
      </div>

      {{-- Success / error flashes --}}
      @if (session('status'))
        <div class="mb-4 px-4 py-3 rounded-xl border text-sm"
             style="background:var(--bs);color:var(--bt);border-color:var(--br)" role="alert">
          {{ session('status') }}
        </div>
      @endif

      @if ($errors->any())
        <div class="mb-4 px-4 py-3 rounded-xl border text-sm"
             style="background:#e07b9018;color:var(--er);border-color:#e07b9040" role="alert">
          {{ $errors->first() }}
        </div>
      @endif

      <div class="grid xl:grid-cols-2 gap-4">

        {{-- ============ Personal details ============ --}}
        <section class="card p-6">
          <div class="flex items-center justify-between gap-2 mb-5">
            <h2 class="font-semibold text-base">Personal details</h2>
          </div>

          <form method="POST" action="{{ route('customer.profile.update') }}" class="space-y-4" novalidate>
            @csrf
            @method('PUT')

            <div>
              <label class="fl" for="name">Full name</label>
              <input id="name" name="name" type="text" autocomplete="name"
                     value="{{ old('name', $user->name) }}"
                     class="@error('name') bad @enderror" required>
              @error('name')<p class="err" role="alert">{{ $message }}</p>@enderror
            </div>

            <div>
              <label class="fl" for="email">Email address</label>
              <input id="email" name="email" type="email" autocomplete="email" inputmode="email"
                     value="{{ old('email', $user->email) }}"
                     class="@error('email') bad @enderror" required>
              @error('email')<p class="err" role="alert">{{ $message }}</p>@enderror
            </div>

            <div>
              <label class="fl" for="phone">Phone number</label>
              <input id="phone" name="phone" type="tel" autocomplete="tel" inputmode="tel"
                     value="{{ old('phone', $user->phone) }}"
                     class="@error('phone') bad @enderror" required>
              @error('phone')<p class="err" role="alert">{{ $message }}</p>@enderror
            </div>

            <div class="pt-2">
              <button type="submit" class="btn btn-p btn-f w-full sm:w-auto">Save changes</button>
            </div>
          </form>
        </section>

        {{-- ============ Delivery addresses ============ --}}
        <section class="card p-6">
          <div class="flex items-center justify-between gap-2 mb-5">
            <h2 class="font-semibold text-base">Delivery addresses</h2>
            <button type="button" class="btn" onclick="document.getElementById('addr-form').classList.toggle('hidden')">
              + Add new
            </button>
          </div>

          {{-- Existing addresses --}}
          @if ($addresses->isEmpty())
            <p class="text-sm text-mu mb-4">No addresses yet. Add one to speed up checkout.</p>
          @else
            <div class="space-y-2 mb-4">
              @foreach ($addresses as $addr)
                <div class="flex items-start gap-3 py-3 {{ !$loop->first ? 'border-t border-bd' : '' }}">
                  <span class="w-10 h-10 rounded-xl bg-bs text-bt grid place-items-center shrink-0 mt-0.5">
                    <svg class="w-[18px] h-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12zM12 12.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/></svg>
                  </span>

                  <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 flex-wrap">
                      <p class="text-sm font-semibold">{{ $addr->area }}</p>
                      @if ($addr->is_default)
                        <span class="text-[11px] font-semibold px-2 py-0.5 rounded-full"
                              style="color:var(--bt);background:var(--bs)">Default</span>
                      @endif
                    </div>
                    <p class="text-xs text-mu mt-0.5 truncate">{{ $addr->address_line }}, {{ $addr->city }}</p>
                    @if ($addr->landmark)
                      <p class="text-xs text-mu mt-0.5">Near {{ $addr->landmark }}</p>
                    @endif
                  </div>

                  <div class="flex items-center gap-1 shrink-0">
                    @if (!$addr->is_default)
                      <form method="POST" action="{{ route('customer.addresses.default', $addr->id) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn !py-1.5 !px-3 text-xs">Set default</button>
                      </form>
                    @endif

                    <form method="POST" action="{{ route('customer.addresses.destroy', $addr->id) }}"
                          onsubmit="return confirm('Delete this address?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn !py-1.5 !px-3 text-xs" style="color:var(--er);border-color:#e07b9040">Delete</button>
                    </form>
                  </div>
                </div>
              @endforeach
            </div>
          @endif

          {{-- Add new address form --}}
          <form id="addr-form" method="POST" action="{{ route('customer.addresses.store') }}"
                class="hidden mt-4 pt-4 border-t border-bd space-y-3" novalidate>
            @csrf

            <div>
              <label class="fl" for="area">Area / Block</label>
              <input id="area" name="area" type="text" placeholder="e.g. Block 7"
                     value="{{ old('area') }}"
                     class="@error('area') bad @enderror" required>
              @error('area')<p class="err" role="alert">{{ $message }}</p>@enderror
            </div>

            <div>
              <label class="fl" for="address_line">Street address</label>
              <input id="address_line" name="address_line" type="text"
                     autocomplete="street-address" placeholder="House 12, Street 4"
                     value="{{ old('address_line') }}"
                     class="@error('address_line') bad @enderror" required>
              @error('address_line')<p class="err" role="alert">{{ $message }}</p>@enderror
            </div>

            <div>
              <label class="fl" for="city">City</label>
              <input id="city" name="city" type="text" autocomplete="address-level2"
                     placeholder="Karachi" value="{{ old('city', 'Karachi') }}"
                     class="@error('city') bad @enderror" required>
              @error('city')<p class="err" role="alert">{{ $message }}</p>@enderror
            </div>

            <div>
              <label class="fl" for="landmark">Landmark <span class="font-normal text-mu">(optional)</span></label>
              <input id="landmark" name="landmark" type="text"
                     placeholder="Near the mosque" value="{{ old('landmark') }}"
                     class="@error('landmark') bad @enderror">
              @error('landmark')<p class="err" role="alert">{{ $message }}</p>@enderror
            </div>

            <label class="flex items-center gap-2 text-sm text-tx cursor-pointer select-none pt-1">
              <input type="checkbox" name="is_default" value="1" @checked(old('is_default'))>
              Make this my default address
            </label>

            <div class="flex gap-2 pt-2">
              <button type="submit" class="btn btn-p btn-f flex-1">Add address</button>
              <button type="button" class="btn btn-f flex-1"
                      onclick="document.getElementById('addr-form').classList.add('hidden')">Cancel</button>
            </div>
          </form>
        </section>

      </div>

    </div>
  </main>
</div>

<div id="toast" class="fixed bottom-5 right-5 z-50"></div>
<script>
  const toast = m => {
    const t = document.getElementById('toast');
    t.innerHTML = `<div class="pop card px-4 py-3 text-sm font-semibold">${m}</div>`;
    clearTimeout(toast.t);
    toast.t = setTimeout(() => t.innerHTML = '', 2600);
  };
  document.getElementById('th').onclick = () => {
    const d = document.documentElement;
    const dk = d.dataset.theme ? d.dataset.theme === 'dark' : matchMedia('(prefers-color-scheme:dark)').matches;
    d.dataset.theme = dk ? 'light' : 'dark';
  };

  // If there were address validation errors, keep the add form open
  @if ($errors->has('area') || $errors->has('address_line') || $errors->has('city'))
    document.getElementById('addr-form').classList.remove('hidden');
  @endif
</script>
</body>
</html>