<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Rashan Cart – Shop</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com/3.4.17"></script>
<script>tailwind.config={theme:{extend:{colors:{bg:'var(--bg)',sf:'var(--sf)',tx:'var(--tx)',mu:'var(--mu)',bd:'var(--bd)',br:'var(--br)',bs:'var(--bs)',bt:'var(--bt)'}}}}</script>
<style>
:root{
  box-sizing:border-box;
  padding-top:env(safe-area-inset-top,0px);
  padding-bottom:env(safe-area-inset-bottom,0px);
  --bg:#f9fcfa;--sf:#ffffff;--tx:#2d4036;--mu:#97a99f;--bd:#e6eee9;
  --br:#d8f1e2;--bs:#f2faf6;--bt:#66a985;--pf:#9ad8b4;
  --bp:#d8f1e2;--bpt:#3a7a58;--er:#e07b90;--ih:44px;
  --sh:0 1px 2px rgba(45,64,54,.025),0 10px 28px -14px rgba(150,210,175,.35);
  color-scheme:light;
}
@media (prefers-color-scheme:dark){
  :root:not([data-theme="light"]){
    --bg:#0f1913;--sf:#15221b;--tx:#e6f1ea;--mu:#8aa296;--bd:#2a3d33;
    --br:#2c5a42;--bs:#183024;--bt:#7fd8a5;--pf:#4fb883;--bp:#24523b;--bpt:#c4f0d7;--sh:none;
    color-scheme:dark;
  }
}
:root[data-theme="dark"]{
  --bg:#0f1913;--sf:#15221b;--tx:#e6f1ea;--mu:#8aa296;--bd:#2a3d33;
  --br:#2c5a42;--bs:#183024;--bt:#7fd8a5;--pf:#4fb883;--bp:#24523b;--bpt:#c4f0d7;--sh:none;
  color-scheme:dark;
}
html{scroll-padding-top:env(safe-area-inset-top,0px);scroll-behavior:smooth}
body{background:var(--bg);color:var(--tx);font-family:"Plus Jakarta Sans",system-ui,-apple-system,"Segoe UI",sans-serif;font-size:15px;line-height:1.5}
a{text-decoration:none;color:inherit}
.card{background:var(--sf);border:1px solid var(--bd);border-radius:20px;box-shadow:var(--sh)}
.btn{border:1px solid var(--bd);border-radius:12px;padding:0 16px;height:var(--ih);font-size:13px;font-weight:600;background:var(--sf);white-space:nowrap;color:var(--tx);display:inline-flex;align-items:center;justify-content:center;gap:6px;transition:background .15s,border-color .15s,transform .1s}
.btn:hover{border-color:var(--br);background:var(--bs)}
.btn:active{transform:scale(.99)}
.btn-p{background:var(--bp);border-color:var(--bp);color:var(--bpt)}
.btn-p:hover{background:color-mix(in srgb,var(--bp) 85%,var(--pf));border-color:transparent}
.btn:disabled{opacity:.55;cursor:not-allowed}
.btn:focus-visible,.chip:focus-visible,.nav:focus-visible{outline:2px solid var(--pf);outline-offset:2px}
.nav{display:flex;gap:10px;align-items:center;padding:10px 14px;border-radius:12px;font-size:14px;font-weight:500;color:var(--mu);width:100%;text-align:left}
.nav:hover{background:var(--bs)}
.nav.on{background:var(--bs);color:var(--bt);font-weight:600}
.chip{padding:7px 16px;border-radius:999px;font-size:13px;font-weight:600;color:var(--mu);border:1px solid var(--bd);white-space:nowrap;background:var(--sf)}
.chip:hover{border-color:var(--br)}
.chip.on{background:var(--bs);color:var(--bt);border-color:var(--br)}
.fl{display:block;font-size:12px;font-weight:600;color:var(--mu);margin-bottom:6px}
input,select{background:var(--sf);color:var(--tx);border:1.5px solid var(--bd);border-radius:12px;height:var(--ih);padding:0 14px;font-size:14px;font-family:inherit;outline:none;width:100%;transition:border-color .15s,box-shadow .15s}
input::placeholder{color:var(--mu);opacity:.7}
input:hover,select:hover{border-color:color-mix(in srgb,var(--bd) 50%,var(--pf))}
input:focus,select:focus{border-color:var(--pf);box-shadow:0 0 0 4px color-mix(in srgb,var(--br) 55%,transparent)}
select{appearance:none;-webkit-appearance:none;cursor:pointer;padding-right:40px;text-overflow:ellipsis;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2397a99f' stroke-width='2.4' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 14px center}
select option{color:var(--tx);background:var(--sf)}
.stp{display:inline-flex;align-items:center;border:1.5px solid var(--bd);border-radius:12px;height:var(--ih);background:var(--sf)}
.stp button{width:42px;height:100%;display:grid;place-items:center;color:var(--bt);border-radius:10px}
.stp button:hover{background:var(--bs)}
.stp button:focus-visible{outline:2px solid var(--pf);outline-offset:-2px}
.stp b{min-width:30px;text-align:center;font-size:14px}
.stp.sm{height:36px;border-radius:10px}
.stp.sm button{width:32px}
.save{display:inline-flex;align-items:center;gap:6px;font-size:12px;font-weight:700;color:var(--bt);background:var(--bs);border:1px solid var(--br);padding:5px 10px;border-radius:10px}
.deal{font-size:11px;font-weight:700;color:#b9852a;background:#f0c97a22;padding:3px 9px;border-radius:999px;white-space:nowrap}
.err{font-size:12px;color:var(--er);margin-top:8px;font-weight:500}
.err:empty{display:none}
.spin{width:16px;height:16px;border:2px solid color-mix(in srgb,var(--bpt) 30%,transparent);border-top-color:var(--bpt);border-radius:50%;animation:sp .7s linear infinite}
@keyframes sp{to{transform:rotate(360deg)}}
.pop{animation:pop .2s ease-out}@keyframes pop{from{opacity:0;transform:translateY(6px)}to{opacity:1;transform:none}}
.noscroll::-webkit-scrollbar{display:none}.noscroll{scrollbar-width:none}
@media (max-width:640px){input,select{font-size:16px}}
@media (prefers-reduced-motion:reduce){.pop,.spin{animation:none}html{scroll-behavior:auto}}
</style>
</head>
<body>
<div class="flex min-h-screen">

  @include('customer.sidebar')

  {{-- ===== MAIN ===== --}}
  <main class="flex-1 min-w-0">

    {{-- Top bar --}}
    <header class="sticky top-0 z-20 px-4 md:px-8 py-3 flex items-center gap-3 border-b border-bd" style="background:var(--bg)">
      <div class="relative flex-1 max-w-md">
        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-mu pointer-events-none" id="ics"></span>
        <input id="q" type="search" placeholder="Search products" style="padding-left:42px" autocomplete="off" aria-label="Search products">
      </div>
      <div class="ml-auto flex items-center gap-2">
        <button class="btn" id="th" type="button">Theme</button>
        <div class="w-10 h-10 rounded-full bg-br text-[#3a7a58] grid place-items-center text-sm font-bold">
          {{ strtoupper(substr(auth()->user()->name ?? 'AM', 0, 2)) }}
        </div>
      </div>
    </header>

    {{-- Mobile nav --}}
    <div id="mnav" class="lg:hidden flex gap-2 overflow-x-auto noscroll px-4 pt-3"></div>

    <div class="p-4 md:p-8 pb-28 xl:pb-8 max-w-[1180px] mx-auto">
      <div class="mb-6">
        <h1 class="text-2xl font-bold tracking-tight">Shop</h1>
        <p id="sub" class="text-sm text-mu mt-1">See the group price, how much you save, and place your order.</p>
      </div>

      <div class="grid xl:grid-cols-[1fr_380px] gap-6 items-start">

        {{-- Products --}}
        <section aria-label="Products">
          <div class="flex flex-col sm:flex-row sm:items-center gap-3 mb-5">
            <div id="cats" class="flex gap-2 overflow-x-auto noscroll flex-1 min-w-0"></div>
            <div class="sm:w-48 shrink-0">
              <label class="sr-only" for="sort">Sort products</label>
              <select id="sort" aria-label="Sort products">
                <option value="featured">Sort: Featured</option>
                <option value="save">Biggest savings</option>
                <option value="low">Price: low to high</option>
                <option value="high">Price: high to low</option>
              </select>
            </div>
          </div>
          <div id="grid" class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-2 gap-4"></div>
        </section>

        {{-- Order panel --}}
        <aside id="order-panel" class="card p-6 xl:sticky xl:top-24" aria-label="Your order"></aside>
      </div>
    </div>
  </main>
</div>

{{-- Mobile / tablet bottom bar --}}
<div id="bar" class="xl:hidden hidden fixed bottom-0 inset-x-0 z-30 p-3" style="background:var(--bg);border-top:1px solid var(--bd);padding-bottom:calc(12px + env(safe-area-inset-bottom,0px))"></div>

<script>
/* ---------- data from Laravel ---------- */
const PRODUCTS=@json($products ?? []);      // [{id,name,category,price,market_price}]
const ADDRESSES=@json($addresses ?? []);    // [{id,label,address,area}]
const FEE=Number(@json($deliveryFee ?? 50));
const ORDER_URL=@json(\Illuminate\Support\Facades\Route::has('customer.orders.store') ? route('customer.orders.store') : url('/customer/orders'));
const CSRF=document.querySelector('meta[name="csrf-token"]').content;

/* Sidebar links. Change these to your real routes. */
const LINKS={
  home:@json(url('/dashboard')),
  shop:@json(url('/customer/shop')),
  orders:@json(url('/dashboard')),
  deliveries:@json(url('/dashboard')),
  savings:@json(url('/dashboard')),
  profile:@json(url('/dashboard'))
};

/* ---------- helpers ---------- */
const $=s=>document.querySelector(s);
const esc=s=>String(s==null?'':s).replace(/&/g,'&amp;').replace(/"/g,'&quot;').replace(/</g,'&lt;');
const money=n=>'Rs '+Number(n).toLocaleString('en-PK',{minimumFractionDigits:0,maximumFractionDigits:2});
const P={
  plus:'M12 5v14M5 12h14',minus:'M5 12h14',x:'M18 6 6 18M6 6l12 12',check:'M5 13l4 4L19 7',
  bag:'M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4zM3 6h18M16 10a4 4 0 0 1-8 0',
  home:'M3 11l9-8 9 8v10a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1z',
  cart:'M3 4h2l2.5 11h10L20 7H6.5M9 20h.01M17 20h.01',
  truck:'M2 6h11v10H2zM13 9h4l4 4v3h-8M6 19h.01M17 19h.01',
  chart:'M4 20V10M10 20V4M16 20v-8M22 20H2',
  user:'M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8',
  gift:'M20 12v9H4v-9M2 7h20v5H2zM12 22V7M12 7H7.5a2.5 2.5 0 1 1 0-5C11 2 12 7 12 7zM12 7h4.5a2.5 2.5 0 1 0 0-5C13 2 12 7 12 7z',
  search:'M11 19a8 8 0 1 0 0-16 8 8 0 0 0 0 16M21 21l-4.3-4.3',
  pin:'M12 22s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12zM12 12.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5'
};
const ic=(n,c='w-4 h-4')=>`<svg class="${c}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="${P[n]}"/></svg>`;
const saving=p=>{const m=Number(p.market_price||0),pr=Number(p.price);return m>pr?{amt:m-pr,pct:Math.round((m-pr)/m*100)}:null};
const maxPct=PRODUCTS.reduce((m,p)=>{const s=saving(p);return s&&s.pct>m?s.pct:m},0);

/* ---------- sidebar ---------- */
const NAV=[['home','Home','home'],['shop','Shop','bag'],['orders','My orders','cart'],['deliveries','Deliveries','truck'],['savings','Savings','chart'],['profile','Profile','user']];
function drawNav(){
  const n=$('#nav');
  if(n)n.innerHTML=NAV.map(x=>`<a href="${LINKS[x[0]]}" class="nav ${x[0]=='shop'?'on':''}" ${x[0]=='shop'?'aria-current="page"':''}>${ic(x[2],'w-[18px] h-[18px]')}${x[1]}</a>`).join('');
  $('#mnav').innerHTML=NAV.map(x=>`<a href="${LINKS[x[0]]}" class="chip ${x[0]=='shop'?'on':''}">${x[1]}</a>`).join('');
  const g=$('#icg');if(g)g.innerHTML=ic('gift','w-5 h-5');
  $('#ics').innerHTML=ic('search','w-4 h-4');
}

/* ---------- state ---------- */
let CART={};            // {productId: quantity}
let CAT='All',Q='',SORT='featured',CATS=['All'];
let ADDR=ADDRESSES.length?String(ADDRESSES[0].id):'';
let BUSY=false,DONE=null,ERR='';
const byId=id=>PRODUCTS.find(p=>String(p.id)==String(id));

/* keep the order if the page is refreshed */
const KEY='rc_cart';
const persist=()=>{try{localStorage.setItem(KEY,JSON.stringify(CART))}catch(e){}};
(function load(){try{const o=JSON.parse(localStorage.getItem(KEY)||'{}');Object.entries(o).forEach(([id,q])=>{if(byId(id)&&q>0)CART[id]=Math.min(99,Math.floor(+q))})}catch(e){}})();

function setQty(id,q){q=Math.max(0,Math.min(99,q));if(q==0)delete CART[id];else CART[id]=q;ERR='';persist();render()}
function clearCart(){CART={};ERR='';persist();render()}
function setCat(i){CAT=CATS[i];render()}

/* ---------- totals ---------- */
function totals(){
  let sub=0,saved=0,count=0;
  Object.entries(CART).forEach(([id,q])=>{const p=byId(id);if(!p)return;sub+=Number(p.price)*q;const s=saving(p);if(s)saved+=s.amt*q;count+=q});
  const fee=count?FEE:0;
  return {sub,saved,count,fee,total:sub+fee};
}

/* ---------- products grid ---------- */
function card(p){
  const s=saving(p),q=CART[p.id]||0,best=s&&maxPct>0&&s.pct==maxPct;
  return `<article class="card p-5 flex flex-col ${q?'ring-1':''}" style="${q?'border-color:var(--pf)':''}">
    <div class="flex items-start gap-3">
      <div class="w-11 h-11 rounded-xl bg-bs text-bt grid place-items-center shrink-0 font-bold">${esc((p.name||'?').trim().charAt(0).toUpperCase())}</div>
      <div class="min-w-0 flex-1"><h3 class="font-semibold leading-tight">${esc(p.name)}</h3><p class="text-xs text-mu mt-0.5">${esc(p.category||'')}</p></div>
      ${best?'<span class="deal">Best deal</span>':''}
    </div>
    <div class="flex items-end gap-2 mt-4">
      <span class="text-2xl font-bold">${money(p.price)}</span>
      ${s?`<s class="text-sm text-mu pb-0.5">${money(p.market_price)}</s>`:''}
    </div>
    <div class="mt-2 min-h-[30px]">${s?`<span class="save">You save ${money(s.amt)} (${s.pct}%)</span>`:`<span class="text-xs text-mu">Group price</span>`}</div>
    <div class="mt-4">${q?`<div class="flex items-center justify-between gap-3"><div class="stp"><button type="button" onclick="setQty(${p.id},${q-1})" aria-label="Less ${esc(p.name)}">${ic('minus')}</button><b aria-live="polite">${q}</b><button type="button" onclick="setQty(${p.id},${q+1})" aria-label="More ${esc(p.name)}">${ic('plus')}</button></div><span class="text-sm font-semibold">${money(p.price*q)}</span></div>`:`<button type="button" class="btn btn-p w-full" onclick="setQty(${p.id},1)">${ic('plus')}Add to order</button>`}</div>
  </article>`;
}
function renderGrid(){
  CATS=['All',...new Set(PRODUCTS.map(p=>p.category).filter(Boolean))];
  if(!CATS.includes(CAT))CAT='All';
  $('#cats').innerHTML=CATS.map((c,i)=>`<button type="button" class="chip ${c==CAT?'on':''}" onclick="setCat(${i})">${esc(c)}</button>`).join('');
  let l=PRODUCTS.filter(p=>(CAT=='All'||p.category==CAT)&&p.name.toLowerCase().includes(Q.toLowerCase()));
  if(SORT=='save')l=l.slice().sort((a,b)=>((saving(b)||{pct:0}).pct)-((saving(a)||{pct:0}).pct));
  if(SORT=='low')l=l.slice().sort((a,b)=>a.price-b.price);
  if(SORT=='high')l=l.slice().sort((a,b)=>b.price-a.price);
  $('#grid').innerHTML=l.length?l.map(card).join(''):`<div class="card p-8 text-center col-span-full"><p class="font-semibold">${PRODUCTS.length?'No products found':'No products available right now'}</p><p class="text-sm text-mu mt-1">${PRODUCTS.length?'Try a different search or category.':'Please check back soon.'}</p></div>`;
  $('#sub').textContent=PRODUCTS.length?`${PRODUCTS.length} products${maxPct?` · save up to ${maxPct}% with group prices`:''}`:'See the group price, how much you save, and place your order.';
}

/* ---------- order panel ---------- */
function renderPanel(){
  const el=$('#order-panel');
  if(DONE){
    el.innerHTML=`<div class="pop text-center py-4">
      <div class="w-14 h-14 rounded-full mx-auto grid place-items-center text-white" style="background:var(--pf)">${ic('check','w-7 h-7')}</div>
      <h2 class="text-xl font-bold mt-4">Order placed</h2>
      <p class="text-sm text-mu mt-1">Order number</p>
      <p class="font-bold text-lg mt-0.5">${esc(DONE.order_number)}</p>
      <p class="text-sm text-mu mt-3">Total ${money(DONE.total_amount)}. We will confirm it shortly.</p>
      <button type="button" class="btn btn-p w-full mt-6" onclick="DONE=null;render()">Place another order</button>
      <a href="${LINKS.orders}" class="btn w-full mt-2">View my orders</a>
    </div>`;
    return;
  }
  const t=totals(),items=Object.entries(CART).map(([id,q])=>[byId(id),q]).filter(([p])=>p);
  let h=`<div class="flex items-center justify-between mb-4"><h2 class="font-semibold text-base">Your order</h2>${items.length?`<button type="button" class="text-xs font-semibold text-mu hover:text-tx" onclick="clearCart()">Clear all</button>`:''}</div>`;
  if(!items.length){
    h+=`<div class="text-center py-8"><div class="w-12 h-12 rounded-2xl bg-bs text-bt grid place-items-center mx-auto">${ic('bag','w-5 h-5')}</div><p class="font-semibold text-sm mt-3">Your order is empty</p><p class="text-xs text-mu mt-1">Tap "Add to order" on any product.</p></div>`;
    el.innerHTML=h;return;
  }
  h+=`<div>${items.map(([p,q],i)=>{const s=saving(p);return `<div class="py-3 ${i?'border-t border-bd':''}">
      <div class="flex items-start justify-between gap-2"><p class="text-sm font-semibold leading-tight">${esc(p.name)}</p><button type="button" class="text-mu hover:text-tx p-1 -mr-1" onclick="setQty(${p.id},0)" aria-label="Remove ${esc(p.name)}">${ic('x')}</button></div>
      <div class="flex items-center justify-between mt-2"><div class="stp sm"><button type="button" onclick="setQty(${p.id},${q-1})" aria-label="Less">${ic('minus','w-3.5 h-3.5')}</button><b>${q}</b><button type="button" onclick="setQty(${p.id},${q+1})" aria-label="More">${ic('plus','w-3.5 h-3.5')}</button></div><div class="text-right"><p class="text-sm font-semibold">${money(p.price*q)}</p><p class="text-[11px] ${s?'text-bt font-semibold':'text-mu'}">${s?`Save ${money(s.amt*q)}`:`${money(p.price)} each`}</p></div></div>
    </div>`}).join('')}</div>`;
  if(t.saved>0)h+=`<div class="rounded-2xl bg-bs border border-br p-3 mt-2 text-sm font-semibold text-bt text-center">You are saving ${money(t.saved)} on this order</div>`;
  h+=`<div class="mt-4"><label class="fl" for="addr">Deliver to</label>`;
  if(ADDRESSES.length){
    const cur=ADDRESSES.find(a=>String(a.id)==ADDR);
    h+=`<select id="addr" onchange="ADDR=this.value;ERR='';renderPanel()">${ADDRESSES.map(a=>`<option value="${a.id}" ${String(a.id)==ADDR?'selected':''}>${esc(a.label?a.label+': ':'')}${esc(a.address)}</option>`).join('')}</select>${cur&&cur.area?`<p class="text-xs text-mu mt-1.5 flex items-center gap-1">${ic('pin','w-3.5 h-3.5')}Area: ${esc(cur.area)}</p>`:''}`;
  }else{
    h+=`<p class="text-sm text-mu rounded-xl border border-bd p-3">You have no saved delivery address. <a class="font-semibold text-bt hover:underline" href="${LINKS.profile}">Add one in your profile</a>.</p>`;
  }
  h+=`</div>
    <div class="mt-5 pt-4 border-t border-bd space-y-2 text-sm">
      <div class="flex justify-between"><span class="text-mu">Subtotal</span><span>${money(t.sub)}</span></div>
      <div class="flex justify-between"><span class="text-mu">Delivery fee</span><span>${t.fee?money(t.fee):'Free'}</span></div>
      <div class="flex justify-between text-base font-bold pt-2 border-t border-bd"><span>Total</span><span>${money(t.total)}</span></div>
    </div>
    <button type="button" id="place" class="btn btn-p w-full mt-5" onclick="place()" ${(BUSY||!ADDRESSES.length)?'disabled':''}>${BUSY?'<span class="spin"></span>Placing order...':'Place order'}</button>
    <p class="err" role="alert">${esc(ERR)}</p>`;
  el.innerHTML=h;
}

/* ---------- mobile / tablet bar ---------- */
function renderBar(){
  const t=totals(),b=$('#bar');
  if(!t.count||DONE){b.classList.add('hidden');return}
  b.classList.remove('hidden');
  b.innerHTML=`<div class="flex items-center gap-3"><div class="flex-1"><p class="text-xs text-mu">${t.count} ${t.count==1?'item':'items'}${t.saved>0?` · saving ${money(t.saved)}`:''}</p><p class="font-bold">${money(t.total)}</p></div><button type="button" class="btn btn-p" onclick="document.getElementById('order-panel').scrollIntoView({behavior:'smooth',block:'start'})">View order</button></div>`;
}

function render(){renderGrid();renderPanel();renderBar()}

/* ---------- place order ---------- */
async function place(){
  if(BUSY||!Object.keys(CART).length)return;
  if(!ADDR){ERR='Choose a delivery address.';renderPanel();return}
  BUSY=true;ERR='';renderPanel();
  try{
    const r=await fetch(ORDER_URL,{
      method:'POST',
      headers:{'Content-Type':'application/json','Accept':'application/json','X-CSRF-TOKEN':CSRF,'X-Requested-With':'XMLHttpRequest'},
      body:JSON.stringify({address_id:Number(ADDR),items:Object.entries(CART).map(([id,q])=>({product_id:Number(id),quantity:q}))})
    });
    const j=await r.json().catch(()=>({}));
    if(!r.ok)throw new Error(j.message||'Could not place the order. Please try again.');
    DONE=j;CART={};persist();
    scrollTo({top:0,behavior:'smooth'});
  }catch(e){ERR=e.message||'Something went wrong. Please try again.'}
  BUSY=false;render();
}

/* ---------- events ---------- */
$('#q').addEventListener('input',e=>{Q=e.target.value;renderGrid()});
$('#sort').addEventListener('change',e=>{SORT=e.target.value;renderGrid()});
$('#th').onclick=()=>{const d=document.documentElement,dk=d.dataset.theme?d.dataset.theme=='dark':matchMedia('(prefers-color-scheme:dark)').matches;d.dataset.theme=dk?'light':'dark'};
document.addEventListener('keydown',e=>{if(e.key=='/'&&!/INPUT|SELECT|TEXTAREA/.test(document.activeElement.tagName)){e.preventDefault();$('#q').focus()}});
drawNav();
render();
</script>
</body>
</html>