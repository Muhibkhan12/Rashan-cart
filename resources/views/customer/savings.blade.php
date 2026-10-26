<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Rashan Cart – Savings</title>
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
        <input id="gs" type="search" placeholder="Search savings" style="padding-left:42px" aria-label="Search savings" autocomplete="off">
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
          <h1 class="text-2xl font-bold tracking-tight">Savings</h1>
          <p class="text-sm text-mu mt-1">See what group buying has saved you.</p>
        </div>
      </div>

      @php
        $totalSaved = 214.40;
        $totalSpent = 612.80;
        $totalOrders = 12;
        $avgDiscount = round($totalSaved / ($totalSaved + $totalSpent) * 100);

        $months = ['May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'];
        $monthly = [18, 26, 31, 22, 35, 82];
        $maxMonthly = max($monthly);

        $byProduct = [
          ['name' => 'Basmati rice 5 kg',   'saved' => 66.00, 'pct' => 31],
          ['name' => 'Cooking oil 5 L',     'saved' => 58.50, 'pct' => 27],
          ['name' => 'Wheat flour 10 kg',   'saved' => 42.00, 'pct' => 20],
          ['name' => 'Fresh eggs, 30 tray', 'saved' => 30.60, 'pct' => 14],
          ['name' => 'Pulses bundle',       'saved' => 17.30, 'pct' => 8],
        ];

        $recentSavings = [
          ['id' => '#1051', 'name' => 'Fresh eggs, 30 tray', 'qty' => 2, 'saved' => 2.60, 'date' => 'Oct 21'],
          ['id' => '#1060', 'name' => 'Basmati rice 5 kg',   'qty' => 1, 'saved' => 3.30, 'date' => 'Oct 22'],
          ['id' => '#1042', 'name' => 'Sugar 5 kg',          'qty' => 2, 'saved' => 2.40, 'date' => 'Oct 12'],
          ['id' => '#1038', 'name' => 'Cooking oil 5 L',     'qty' => 1, 'saved' => 3.90, 'date' => 'Oct 05'],
        ];
      @endphp

      {{-- Stat cards --}}
      <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-4 mb-4">
        <div class="card p-5">
          <div class="flex items-center justify-between">
            <p class="text-sm text-mu">Total saved</p>
            <span class="w-10 h-10 rounded-xl bg-bs text-bt grid place-items-center">
              <svg class="w-[18px] h-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 20V10M10 20V4M16 20v-8M22 20H2"/></svg>
            </span>
          </div>
          <p class="text-2xl font-bold mt-2">Rs {{ number_format($totalSaved, 2) }}</p>
          <p class="text-xs text-mu mt-1">All time</p>
        </div>

        <div class="card p-5">
          <div class="flex items-center justify-between">
            <p class="text-sm text-mu">Total spent</p>
            <span class="w-10 h-10 rounded-xl bg-bs text-bt grid place-items-center">
              <svg class="w-[18px] h-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 4h2l2.5 11h10L20 7H6.5M9 20h.01M17 20h.01"/></svg>
            </span>
          </div>
          <p class="text-2xl font-bold mt-2">Rs {{ number_format($totalSpent, 2) }}</p>
          <p class="text-xs text-mu mt-1">Across {{ $totalOrders }} orders</p>
        </div>

        <div class="card p-5 sm:col-span-2 xl:col-span-1">
          <div class="flex items-center justify-between">
            <p class="text-sm text-mu">Average discount</p>
            <span class="w-10 h-10 rounded-xl bg-bs text-bt grid place-items-center">
              <svg class="w-[18px] h-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.6 13.4l-7.2 7.2a2 2 0 0 1-2.8 0L2 12V2h10l8.6 8.6a2 2 0 0 1 0 2.8zM7 7h.01"/></svg>
            </span>
          </div>
          <p class="text-2xl font-bold mt-2">{{ $avgDiscount }}%</p>
          <p class="text-xs text-mu mt-1">Below store prices</p>
        </div>
      </div>

      {{-- Charts row --}}
      <div class="grid xl:grid-cols-5 gap-4">

        {{-- Monthly savings bar chart --}}
        <section class="card p-6 xl:col-span-3">
          <div class="flex items-center justify-between mb-4">
            <h2 class="font-semibold text-base">Savings by month</h2>
          </div>

          <div class="flex items-end gap-3 h-48">
            @foreach ($months as $i => $label)
              @php
                $v = $monthly[$i];
                $h = ($v / $maxMonthly) * 78;
                $isLast = $i === count($months) - 1;
              @endphp
              <div class="flex-1 h-full flex flex-col justify-end items-center gap-1">
                <span class="text-[11px] text-mu">Rs {{ $v }}</span>
                <div class="w-full rounded-t-xl" style="height:{{ $h }}%;background:var(--pf);opacity:{{ $isLast ? 1 : 0.45 }}"></div>
                <span class="text-[11px] text-mu">{{ $label }}</span>
              </div>
            @endforeach
          </div>
        </section>

        {{-- By product breakdown --}}
        <section class="card p-6 xl:col-span-2">
          <div class="flex items-center justify-between mb-4">
            <h2 class="font-semibold text-base">By product</h2>
          </div>

          <div class="space-y-3">
            @foreach ($byProduct as $p)
              <div>
                <div class="flex justify-between text-sm mb-1.5">
                  <span class="font-medium truncate pr-3">{{ $p['name'] }}</span>
                  <b class="text-bt whitespace-nowrap">Rs {{ number_format($p['saved'], 2) }}</b>
                </div>
                <div class="h-2.5 rounded-full bg-bd overflow-hidden">
                  <div class="h-full rounded-full" style="width:{{ $p['pct'] }}%;background:var(--pf)"></div>
                </div>
              </div>
            @endforeach
          </div>
        </section>
 
            </thead>
            <tbody>
              @foreach ($recentSavings as $r)
                <tr class="hover:bg-[var(--bs)]">
                  <td class="px-3.5 py-3.5 border-t border-[var(--bd)] text-sm"><b>{{ $r['id'] }}</b></td>
                  <td class="px-3.5 py-3.5 border-t border-[var(--bd)] text-sm">
                    {{ $r['name'] }} <span class="text-mu">x{{ $r['qty'] }}</span>
                  </td>
                  <td class="px-3.5 py-3.5 border-t border-[var(--bd)] text-sm text-mu">{{ $r['date'] }}</td>
                  <td class="px-3.5 py-3.5 border-t border-[var(--bd)] text-sm text-right font-semibold text-bt">
                    + Rs {{ number_format($r['saved'], 2) }}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </section>

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