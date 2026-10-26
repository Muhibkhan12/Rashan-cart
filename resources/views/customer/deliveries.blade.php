<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Rashan Cart – Deliveries</title>
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
.btn-f{height:var(--ih);padding-top:0;padding-bottom:0;display:inline-flex;align-items:center;justify-content:center}
.nav{display:flex;gap:10px;align-items:center;padding:10px 14px;border-radius:12px;font-size:14px;font-weight:500;color:var(--mu);width:100%;text-align:left}
.nav:hover{background:var(--bs)}
.nav.on{background:var(--bs);color:var(--bt);font-weight:600}
.chip{padding:7px 16px;border-radius:999px;font-size:13px;font-weight:600;color:var(--mu);border:1px solid var(--bd);white-space:nowrap;background:var(--sf)}
.chip.on{background:var(--bs);color:var(--bt);border-color:var(--br)}
input,select{background:var(--sf);color:var(--tx);border:1.5px solid var(--bd);border-radius:12px;height:var(--ih);padding:0 14px;font-size:14px;outline:none;width:100%}
input:focus,select:focus{border-color:var(--pf);box-shadow:0 0 0 4px color-mix(in srgb,var(--br) 55%,transparent)}
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
        <input id="gs" type="search" placeholder="Search deliveries" style="padding-left:42px" aria-label="Search deliveries" autocomplete="off">
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

      <div class="flex flex-wrap items-end justify-between gap-3 mb-6">
        <div>
          <h1 class="text-2xl font-bold tracking-tight">Deliveries</h1>
          <p class="text-sm text-mu mt-1">Follow each order until it reaches your door.</p>
        </div>
      </div>

      @php
        $deliveries = [
          [
            'id'      => '#1051',
            'name'    => 'Fresh eggs, 30 tray',
            'qty'     => 2,
            'total'   => 10.20,
            'address' => 'House 12, Block 7',
            'status'  => 'Out for delivery',
            'stage'   => 3,
            'note'    => 'Rider Imran is 3 stops away. Expected between 4 and 6 pm.',
            'badge'   => 'b',
          ],
          [
            'id'      => '#1060',
            'name'    => 'Basmati rice 5 kg',
            'qty'     => 1,
            'total'   => 11.20,
            'address' => 'House 12, Block 7',
            'status'  => 'Packed',
            'stage'   => 2,
            'note'    => 'Packed and waiting for a rider.',
            'badge'   => 'b',
          ],
          [
            'id'      => '#1058',
            'name'    => 'Wheat flour 10 kg',
            'qty'     => 1,
            'total'   => 8.40,
            'address' => 'House 12, Block 7',
            'status'  => 'Placed',
            'stage'   => 0,
            'note'    => '16 more orders needed to lock the group price.',
            'badge'   => 'a',
          ],
        ];

        $badgeColors = ['g' => '#5fb383', 'a' => '#d19a3c', 'b' => '#6a9fd0', 'r' => '#e07b90', 'x' => '#9aa9a1'];
        $steps = ['Placed', 'Confirmed', 'Packed', 'On the way', 'Delivered'];
      @endphp

      @if (count($deliveries) === 0)
        <section class="card p-6">
          <h2 class="font-semibold text-base mb-2">No active deliveries</h2>
          <p class="text-sm text-mu">Place an order and your delivery will show up here.</p>
          <a href="{{ route('customer.shop') }}" class="btn btn-p mt-3 inline-flex">Place an order</a>
        </section>
      @else
        <div class="space-y-4">
          @foreach ($deliveries as $d)
            @php $c = $badgeColors[$d['badge']] ?? '#9aa9a1'; @endphp

            <section class="card p-6">

              {{-- Header --}}
              <div class="flex flex-wrap items-center justify-between gap-2 mb-5">
                <div class="min-w-0">
                  <p class="font-semibold">{{ $d['name'] }} <span class="text-mu">x{{ $d['qty'] }}</span></p>
                  <p class="text-xs text-mu flex items-center gap-1 mt-1">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12zM12 12.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/></svg>
                    {{ $d['address'] }}
                  </p>
                </div>
                <div class="flex items-center gap-2">
                  <span class="text-xs text-mu font-medium">Rs {{ number_format($d['total'], 2) }}</span>
                  <span style="color:{{ $c }};background:{{ $c }}1c" class="text-xs font-semibold px-3 py-1 rounded-full whitespace-nowrap">
                    {{ $d['status'] }}
                  </span>
                </div>
              </div>

              {{-- Progress steps --}}
              <div class="flex items-start mb-4">
                @foreach ($steps as $i => $label)
                  <div class="flex-1 flex flex-col items-center relative">
                    @if ($i > 0)
                      <div class="absolute top-3.5 right-1/2 w-full h-0.5" style="background:{{ $i <= $d['stage'] ? 'var(--pf)' : 'var(--bd)' }}"></div>
                    @endif
                    <div class="relative w-7 h-7 rounded-full grid place-items-center z-10"
                         style="color:#fff;background:{{ $i <= $d['stage'] ? 'var(--pf)' : 'var(--bd)' }}">
                      @if ($i <= $d['stage'])
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7"/></svg>
                      @endif
                    </div>
                    <p class="text-[11px] mt-1.5 text-center {{ $i === $d['stage'] ? 'font-bold' : 'text-mu' }}">{{ $label }}</p>
                  </div>
                @endforeach
              </div>

              {{-- Note --}}
              <p class="text-xs text-mu mt-4">{{ $d['note'] }}</p>

              {{-- Order id --}}
              <p class="text-[11px] text-mu mt-2">Order <b class="text-tx">{{ $d['id'] }}</b></p>

            </section>
          @endforeach
        </div>
      @endif

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
</script>
</body>
</html>