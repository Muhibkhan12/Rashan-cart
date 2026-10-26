@php
    $nav = [
        ['route' => 'customer.dashboard',  'label' => 'Home',       'icon' => 'home',  'active' => request()->routeIs('customer.dashboard')],
        ['route' => 'customer.shop',       'label' => 'Shop',       'icon' => 'mega',  'active' => request()->routeIs('customer.shop')],
        ['route' => 'customer.orders',     'label' => 'My orders',  'icon' => 'cart',  'active' => request()->routeIs('customer.orders')],
        ['route' => 'customer.deliveries', 'label' => 'Deliveries', 'icon' => 'truck', 'active' => request()->routeIs('customer.deliveries')],
        ['route' => 'customer.savings',    'label' => 'Savings',    'icon' => 'chart', 'active' => request()->routeIs('customer.savings')],
        ['route' => 'customer.profile',    'label' => 'Profile',    'icon' => 'user',  'active' => request()->routeIs('customer.profile')],
    ];

    $icons = [
        'home'  => 'M3 11l9-8 9 8v10a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1z',
        'mega'  => 'M3 11v2a1 1 0 0 0 1 1h2l5 4V6L6 10H4a1 1 0 0 0-1 1zM16 8a5 5 0 0 1 0 8',
        'cart'  => 'M3 4h2l2.5 11h10L20 7H6.5M9 20h.01M17 20h.01',
        'truck' => 'M2 6h11v10H2zM13 9h4l4 4v3h-8M6 19h.01M17 19h.01',
        'chart' => 'M4 20V10M10 20V4M16 20v-8M22 20H2',
        'user'  => 'M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8',
    ];
@endphp

<aside class="hidden lg:flex w-64 shrink-0 flex-col p-4 border-r border-bd bg-sf sticky top-0 h-screen">

  {{-- Brand --}}
  <div class="flex items-center gap-2.5 px-2 pb-6">
    <div class="w-9 h-9 rounded-xl bg-br text-[#2f6a48] grid place-items-center font-bold">R</div>
    <div class="min-w-0">
      <p class="font-bold leading-none">Rashan Cart</p>
      <p class="text-xs text-mu mt-1 truncate">{{ auth()->user()->name ?? 'Guest' }}</p>
    </div>
  </div>

  {{-- Nav (Blade-rendered, real links) --}}
  <nav class="flex flex-col gap-1 flex-1 min-h-0 overflow-y-auto">
    @foreach ($nav as $item)
      <a href="{{ route($item['route']) }}"
         class="nav {{ $item['active'] ? 'on' : '' }}">
        <svg class="w-[18px] h-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <path d="{{ $icons[$item['icon']] }}"/>
        </svg>
        {{ $item['label'] }}
      </a>
    @endforeach
  </nav>

  {{-- Invite card --}}
  <div class="mt-3 rounded-2xl bg-bs p-4">
    <div class="text-bt mb-1">
      <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
        <path d="M20 12v9H4v-9M2 7h20v5H2zM12 22V7M12 7H7.5a2.5 2.5 0 1 1 0-5C11 2 12 7 12 7zM12 7h4.5a2.5 2.5 0 1 0 0-5C13 2 12 7 12 7z"/>
      </svg>
    </div>
    <p class="text-sm font-semibold text-bt">Invite a neighbor</p>
    <p class="text-xs text-mu mt-1">Bigger groups unlock lower prices. You both get Rs 5 off.</p>
    <button type="button"
            class="btn btn-p mt-3 w-full"
            onclick="navigator.clipboard.writeText('{{ url('/register?ref=' . auth()->id()) }}');toast('Invite link copied')">
      Copy invite link
    </button>
  </div>

  {{-- Logout --}}
  <form method="POST" action="{{ route('logout') }}" class="mt-3">
    @csrf
    <button type="submit" class="btn w-full !py-2.5 flex items-center justify-center gap-2 text-mu hover:text-tx">
      <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/>
      </svg>
      Sign out
    </button>
  </form>

</aside>