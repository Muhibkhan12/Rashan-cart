<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Rashan Cart – My orders</title>
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
th{text-align:left;font-weight:500;color:var(--mu);font-size:12px;padding:8px 14px}
td{padding:14px;border-top:1px solid var(--bd);font-size:14px;white-space:nowrap}
tbody tr:hover{background:var(--bs)}
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
        <input id="gs" type="search" placeholder="Search orders" style="padding-left:42px" aria-label="Search orders" autocomplete="off">
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
          <h1 class="text-2xl font-bold tracking-tight">My orders</h1>
          <p class="text-sm text-mu mt-1">You can cancel an order until it is confirmed.</p>
        </div>
        <a href="{{ route('customer.order-create') }}" class="btn btn-p flex items-center gap-1.5">
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
          New order
        </a>
      </div>

      {{-- Status badge colours --}}
      @php
        $badgeColors = [
          'Placed'           => '#d19a3c',
          'Confirmed'        => '#6a9fd0',
          'Packed'           => '#6a9fd0',
          'Out for delivery' => '#6a9fd0',
          'Delivered'        => '#5fb383',
          'Cancelled'        => '#9aa9a1',
        ];
        $statusLabels = [
          'Placed'           => 'Order placed',
          'Out for delivery' => 'On the way',
        ];
      @endphp

      <section class="card p-6">
        <div class="flex items-center justify-between gap-2 mb-4">
          <h2 class="font-semibold text-base">All orders</h2>
        </div>

        @if ($orders->isEmpty())
          <p class="text-sm text-mu">No orders yet.</p>
          <a href="{{ route('customer.order-create') }}" class="btn btn-p mt-3 inline-flex">Place your first order</a>
        @else
          <div class="overflow-x-auto -mx-2">
            <table class="w-full" id="otable">
              <thead>
                <tr>
                  <th>Order</th>
                  <th>Items</th>
                  <th>Total</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($orders as $o)
                  @php
                    $c = $badgeColors[$o->status] ?? '#9aa9a1';
                    $first = $o->items->first();
                    $more = $o->items->count() - 1;
                    $search = strtolower($o->order_number . ' ' . $o->status . ' ' . $o->items->pluck('product_name')->implode(' '));
                  @endphp
                  <tr data-s="{{ $search }}">
                    <td><b>{{ $o->order_number }}</b></td>
                    <td>
                      @if ($first)
                        {{ $first->product_name }} <span class="text-mu">x{{ $first->quantity }}</span>
                        @if ($more > 0)
                          <span class="text-mu text-xs">+{{ $more }} more</span>
                        @endif
                      @else
                        <span class="text-mu">-</span>
                      @endif
                    </td>
                    <td>Rs {{ number_format($o->total_amount, 2) }}</td>
                    <td>{{ $o->created_at->format('M j') }}</td>
                    <td>
                      <span style="color:{{ $c }};background:{{ $c }}1c"
                            class="text-xs font-semibold px-3 py-1 rounded-full whitespace-nowrap">
                        {{ $statusLabels[$o->status] ?? $o->status }}
                      </span>
                    </td>
                    <td>
                      @if ($o->status === 'Placed')
                        <form method="POST" action="{{ route('customer.orders.cancel', $o->id) }}"
                              onsubmit="return confirm('Cancel this order?')">
                          @csrf
                          <button type="submit" class="btn">Cancel</button>
                        </form>
                      @else
                        <span class="text-mu text-xs">Locked</span>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <p id="none" class="hidden text-sm text-mu mt-3">No orders match your search.</p>
        @endif
      </section>

    </div>
  </main>
</div>

<div id="toast" class="fixed bottom-5 right-5 z-50"></div>
<script>
  const toast = m => {
    const t = document.getElementById('toast');
    const d = document.createElement('div');
    d.className = 'pop card px-4 py-3 text-sm font-semibold';
    d.textContent = m;
    t.innerHTML = '';
    t.appendChild(d);
    clearTimeout(toast.t);
    toast.t = setTimeout(() => t.innerHTML = '', 3200);
  };

  document.getElementById('th').onclick = () => {
    const d = document.documentElement;
    const dk = d.dataset.theme ? d.dataset.theme === 'dark' : matchMedia('(prefers-color-scheme:dark)').matches;
    d.dataset.theme = dk ? 'light' : 'dark';
  };

  /* search orders */
  document.getElementById('gs').addEventListener('input', e => {
    const q = e.target.value.trim().toLowerCase();
    let shown = 0;
    document.querySelectorAll('#otable tbody tr').forEach(r => {
      const ok = r.dataset.s.includes(q);
      r.style.display = ok ? '' : 'none';
      if (ok) shown++;
    });
    const none = document.getElementById('none');
    if (none) none.classList.toggle('hidden', shown > 0);
  });

  /* messages from the server (order placed, order cancelled, errors) */
  @if (session('success'))
    toast(@json(session('success')));
  @endif
  @if (session('error'))
    toast(@json(session('error')));
  @endif
</script>
</body>
</html>