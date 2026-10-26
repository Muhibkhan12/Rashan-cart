<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Rashan Cart – New order</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com/3.4.17"></script>
<script>tailwind.config={theme:{extend:{colors:{bg:'var(--bg)',sf:'var(--sf)',tx:'var(--tx)',mu:'var(--mu)',bd:'var(--bd)',br:'var(--br)',bs:'var(--bs)',bt:'var(--bt)'}}}}</script>
<style>
:root{box-sizing:border-box;padding-top:env(safe-area-inset-top,0px);padding-bottom:env(safe-area-inset-bottom,0px);--bg:#f9fcfa;--sf:#fff;--tx:#2d4036;--mu:#97a99f;--bd:#e6eee9;--br:#d8f1e2;--bs:#f2faf6;--bt:#66a985;--pf:#9ad8b4;--bp:#d8f1e2;--bpt:#3a7a58;--er:#e07b90;--ih:44px;--sh:0 1px 2px rgba(45,64,54,.025),0 10px 28px -14px rgba(150,210,175,.35);color-scheme:light}
@media (prefers-color-scheme:dark){:root:not([data-theme="light"]){--bg:#0f1913;--sf:#15221b;--tx:#e6f1ea;--mu:#8aa296;--bd:#2a3d33;--br:#2c5a42;--bs:#183024;--bt:#7fd8a5;--pf:#4fb883;--bp:#24523b;--bpt:#c4f0d7;--sh:none;color-scheme:dark}}
:root[data-theme="dark"]{--bg:#0f1913;--sf:#15221b;--tx:#e6f1ea;--mu:#8aa296;--bd:#2a3d33;--br:#2c5a42;--bs:#183024;--bt:#7fd8a5;--pf:#4fb883;--bp:#24523b;--bpt:#c4f0d7;--sh:none;color-scheme:dark}
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
.btn:focus-visible,.chip:focus-visible{outline:2px solid var(--pf);outline-offset:2px}
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
.stp{display:inline-flex;align-items:center;border:1.5px solid var(--bd);border-radius:12px;height:40px;background:var(--sf)}
.stp button{width:38px;height:100%;display:grid;place-items:center;color:var(--bt);border-radius:10px}
.stp button:hover{background:var(--bs)}
.stp button:focus-visible{outline:2px solid var(--pf);outline-offset:-2px}
.stp b{min-width:28px;text-align:center;font-size:14px}
.stp.sm{height:34px;border-radius:10px}
.stp.sm button{width:30px}
.save{display:inline-flex;align-items:center;font-size:11px;font-weight:700;color:var(--bt);background:var(--bs);border:1px solid var(--br);padding:2px 8px;border-radius:8px;white-space:nowrap}
.err{font-size:12px;color:var(--er);margin-top:8px;font-weight:500}
.err:empty{display:none}
.spin{width:16px;height:16px;border:2px solid color-mix(in srgb,var(--bpt) 30%,transparent);border-top-color:var(--bpt);border-radius:50%;animation:sp .7s linear infinite}
@keyframes sp{to{transform:rotate(360deg)}}
.pop{animation:pop .18s ease-out}@keyframes pop{from{opacity:0;transform:translateY(6px)}to{opacity:1;transform:none}}
.noscroll::-webkit-scrollbar{display:none}.noscroll{scrollbar-width:none}
@media (max-width:640px){input,select{font-size:16px}}
@media (prefers-reduced-motion:reduce){.pop,.spin{animation:none}html{scroll-behavior:auto}}
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
        <input id="gs" type="search" placeholder="Search products" style="padding-left:42px" aria-label="Search products" autocomplete="off">
      </div>
      <div class="ml-auto flex items-center gap-2">
        <button class="btn" id="th" type="button">Theme</button>
        <div class="w-10 h-10 rounded-full bg-br text-[#3a7a58] grid place-items-center text-sm font-bold">
          {{ strtoupper(substr(auth()->user()->name ?? 'AM', 0, 2)) }}
        </div>
      </div>
    </header>

    {{-- ===== PAGE CONTENT ===== --}}
    <div class="p-4 md:p-8 pb-28 xl:pb-8 max-w-[1100px] mx-auto">

      <div class="flex flex-wrap items-end justify-between gap-3 mb-6">
        <div>
          <h1 class="text-2xl font-bold tracking-tight">New order</h1>
          <p class="text-sm text-mu mt-1">Choose your products, check the total, and place your order.</p>
        </div>
        <a href="{{ route('customer.orders') }}" class="btn">Back to my orders</a>
      </div>

      <div class="grid xl:grid-cols-[1fr_360px] gap-6 items-start">

        {{-- 1. Choose products --}}
        <section class="card p-6" aria-label="Choose products">
          <div class="flex items-center justify-between gap-2 mb-4">
            <h2 class="font-semibold text-base">1. Choose products</h2>
            <span id="found" class="text-xs text-mu"></span>
          </div>
          <div id="cats" class="flex gap-2 overflow-x-auto noscroll mb-2"></div>
          <div id="list"></div>
        </section>

        {{-- 2. Review + place --}}
        <aside id="summary" class="card p-6 xl:sticky xl:top-24" aria-label="Order summary"></aside>
      </div>
    </div>
  </main>
</div>

{{-- Mobile / tablet bottom bar --}}
<div id="bar" class="xl:hidden hidden fixed bottom-0 inset-x-0 z-30 p-3" style="background:var(--bg);border-top:1px solid var(--bd);padding-bottom:calc(12px + env(safe-area-inset-bottom,0px))"></div>
<div id="toast" class="fixed bottom-24 xl:bottom-5 right-5 z-50"></div>

<script>
/* ---------- data from Laravel ---------- */
const PRODUCTS=@json($products ?? []);      // [{id,name,category,price,market_price}]
const ADDRESSES=@json($addresses ?? []);    // [{id,label,address,area}]
const FEE=Number(@json($deliveryFee ?? 50));
const ORDER_URL=@json(route('customer.orders.store'));
const PROFILE_URL=@json(url('/profile'));
const CSRF=document.querySelector('meta[name="csrf-token"]').content;

/* ---------- helpers ---------- */
const $=s=>document.querySelector(s);
const esc=s=>String(s==null?'':s).replace(/&/g,'&amp;').replace(/"/g,'&quot;').replace(/</g,'&lt;');
const money=n=>'Rs '+Number(n).toLocaleString('en-PK',{minimumFractionDigits:0,maximumFractionDigits:2});
const P={plus:'M12 5v14M5 12h14',minus:'M5 12h14',x:'M18 6 6 18M6 6l12 12',bag:'M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4zM3 6h18M16 10a4 4 0 0 1-8 0',pin:'M12 22s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12zM12 12.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5'};
const ic=(n,c='w-4 h-4')=>`<svg class="${c}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="${P[n]}"/></svg>`;
const saving=p=>{const m=Number(p.market_price||0),pr=Number(p.price);return m>pr?{amt:m-pr,pct:Math.round((m-pr)/m*100)}:null};
const toast=m=>{const t=$('#toast');t.innerHTML=`<div class="pop card px-4 py-3 text-sm font-semibold">${esc(m)}</div>`;clearTimeout(toast.t);toast.t=setTimeout(()=>t.innerHTML='',2800)};

/* ---------- state ---------- */
let CART={};              // {productId: quantity}
let CAT='All',Q='',CATS=['All'];
let ADDR=ADDRESSES.length?String(ADDRESSES[0].id):'';
let BUSY=false,ERR='';
const byId=id=>PRODUCTS.find(p=>String(p.id)==String(id));

function setQty(id,q){q=Math.max(0,Math.min(99,q));if(q==0)delete CART[id];else CART[id]=q;ERR='';render()}
function clearCart(){CART={};ERR='';render()}
function setCat(i){CAT=CATS[i];render()}

function totals(){
  let sub=0,saved=0,count=0;
  Object.entries(CART).forEach(([id,q])=>{const p=byId(id);if(!p)return;sub+=Number(p.price)*q;const s=saving(p);if(s)saved+=s.amt*q;count+=q});
  const fee=count?FEE:0;
  return {sub,saved,count,fee,total:sub+fee};
}

/* ---------- 1. product list ---------- */
function row(p,i){
  const s=saving(p),q=CART[p.id]||0;
  return `<div class="flex items-center gap-3 py-4 ${i?'border-t border-bd':''}">
    ${p.image?`<img src="${esc(p.image)}" alt="" loading="lazy" class="w-11 h-11 rounded-xl object-cover shrink-0 bg-bs">`:`<div class="w-11 h-11 rounded-xl bg-bs text-bt grid place-items-center shrink-0 font-bold">${esc((p.name||'?').trim().charAt(0).toUpperCase())}</div>`}
    <div class="min-w-0 flex-1">
      <p class="font-semibold text-sm leading-tight">${esc(p.name)}${p.unit?` <span class="text-mu font-normal">· ${esc(p.unit)}</span>`:''}</p>
      <div class="flex flex-wrap items-center gap-x-2 gap-y-1 mt-1">
        <b class="text-sm">${money(p.price)}</b>
        ${s?`<s class="text-xs text-mu">${money(p.market_price)}</s><span class="save">Save ${money(s.amt)} (${s.pct}%)</span>`:`<span class="text-xs text-mu">${esc(p.category||'')}</span>`}
      </div>
    </div>
    ${q?`<div class="stp shrink-0"><button type="button" onclick="setQty(${p.id},${q-1})" aria-label="Less ${esc(p.name)}">${ic('minus')}</button><b aria-live="polite">${q}</b><button type="button" onclick="setQty(${p.id},${q+1})" aria-label="More ${esc(p.name)}">${ic('plus')}</button></div>`:`<button type="button" class="btn btn-p shrink-0" style="height:40px" onclick="setQty(${p.id},1)" aria-label="Add ${esc(p.name)}">${ic('plus')}Add</button>`}
  </div>`;
}
function renderList(){
  CATS=['All',...new Set(PRODUCTS.map(p=>p.category).filter(Boolean))];
  if(!CATS.includes(CAT))CAT='All';
  $('#cats').innerHTML=CATS.length>2?CATS.map((c,i)=>`<button type="button" class="chip ${c==CAT?'on':''}" onclick="setCat(${i})">${esc(c)}</button>`).join(''):'';
  const l=PRODUCTS.filter(p=>(CAT=='All'||p.category==CAT)&&p.name.toLowerCase().includes(Q.toLowerCase()));
  $('#found').textContent=PRODUCTS.length?`${l.length} ${l.length==1?'product':'products'}`:'';
  $('#list').innerHTML=l.length?l.map(row).join(''):`<div class="py-10 text-center"><p class="font-semibold">${PRODUCTS.length?'No products found':'No products available right now'}</p><p class="text-sm text-mu mt-1">${PRODUCTS.length?'Try a different search or category.':'Please check back soon.'}</p></div>`;
}

/* ---------- 2. summary ---------- */
function renderSummary(){
  const el=$('#summary'),t=totals(),items=Object.entries(CART).map(([id,q])=>[byId(id),q]).filter(([p])=>p);
  let h=`<div class="flex items-center justify-between mb-4"><h2 class="font-semibold text-base">2. Review and place</h2>${items.length?`<button type="button" class="text-xs font-semibold text-mu hover:text-tx" onclick="clearCart()">Clear all</button>`:''}</div>`;
  if(!items.length){
    h+=`<div class="text-center py-8"><div class="w-12 h-12 rounded-2xl bg-bs text-bt grid place-items-center mx-auto">${ic('bag','w-5 h-5')}</div><p class="font-semibold text-sm mt-3">Nothing added yet</p><p class="text-xs text-mu mt-1">Tap "Add" on a product to start.</p></div>`;
    el.innerHTML=h;return;
  }
  h+=`<div>${items.map(([p,q],i)=>`<div class="py-3 ${i?'border-t border-bd':''}">
      <div class="flex items-start justify-between gap-2"><p class="text-sm font-semibold leading-tight">${esc(p.name)}</p><button type="button" class="text-mu hover:text-tx p-1 -mr-1" onclick="setQty(${p.id},0)" aria-label="Remove ${esc(p.name)}">${ic('x')}</button></div>
      <div class="flex items-center justify-between mt-2"><div class="stp sm"><button type="button" onclick="setQty(${p.id},${q-1})" aria-label="Less">${ic('minus','w-3.5 h-3.5')}</button><b>${q}</b><button type="button" onclick="setQty(${p.id},${q+1})" aria-label="More">${ic('plus','w-3.5 h-3.5')}</button></div><div class="text-right"><p class="text-sm font-semibold">${money(p.price*q)}</p><p class="text-[11px] text-mu">${money(p.price)} each</p></div></div>
    </div>`).join('')}</div>`;
  if(t.saved>0)h+=`<div class="rounded-2xl bg-bs border border-br p-3 mt-2 text-sm font-semibold text-bt text-center">You are saving ${money(t.saved)} on this order</div>`;
  h+=`<div class="mt-4"><label class="fl" for="addr">Deliver to</label>`;
  if(ADDRESSES.length){
    const cur=ADDRESSES.find(a=>String(a.id)==ADDR);
    h+=`<select id="addr" onchange="ADDR=this.value;ERR='';renderSummary()">${ADDRESSES.map(a=>`<option value="${a.id}" ${String(a.id)==ADDR?'selected':''}>${esc(a.label?a.label+': ':'')}${esc(a.address)}</option>`).join('')}</select>${cur&&cur.area?`<p class="text-xs text-mu mt-1.5 flex items-center gap-1">${ic('pin','w-3.5 h-3.5')}Area: ${esc(cur.area)}</p>`:''}`;
  }else{
    h+=`<p class="text-sm text-mu rounded-xl border border-bd p-3">You have no saved delivery address. <a class="font-semibold text-bt hover:underline" href="${PROFILE_URL}">Add one in your profile</a>.</p>`;
  }
  h+=`</div>
    <div class="mt-5 pt-4 border-t border-bd space-y-2 text-sm">
      <div class="flex justify-between"><span class="text-mu">Subtotal</span><span>${money(t.sub)}</span></div>
      <div class="flex justify-between"><span class="text-mu">Delivery fee</span><span>${t.fee?money(t.fee):'Free'}</span></div>
      <div class="flex justify-between text-base font-bold pt-2 border-t border-bd"><span>Total</span><span>${money(t.total)}</span></div>
    </div>
    <button type="button" class="btn btn-p w-full mt-5" onclick="place()" ${(BUSY||!ADDRESSES.length)?'disabled':''}>${BUSY?'<span class="spin"></span>Placing order...':'Place order'}</button>
    <p class="err" role="alert">${esc(ERR)}</p>`;
  el.innerHTML=h;
}

function renderBar(){
  const t=totals(),b=$('#bar');
  if(!t.count){b.classList.add('hidden');return}
  b.classList.remove('hidden');
  b.innerHTML=`<div class="flex items-center gap-3"><div class="flex-1"><p class="text-xs text-mu">${t.count} ${t.count==1?'item':'items'}${t.saved>0?` · saving ${money(t.saved)}`:''}</p><p class="font-bold">${money(t.total)}</p></div><button type="button" class="btn btn-p" onclick="document.getElementById('summary').scrollIntoView({behavior:'smooth',block:'start'})">Review order</button></div>`;
}

function render(){renderList();renderSummary();renderBar()}

/* ---------- place order ---------- */
async function place(){
  if(BUSY||!Object.keys(CART).length)return;
  if(!ADDR){ERR='Choose a delivery address.';renderSummary();return}
  BUSY=true;ERR='';renderSummary();
  try{
    const r=await fetch(ORDER_URL,{
      method:'POST',
      headers:{'Content-Type':'application/json','Accept':'application/json','X-CSRF-TOKEN':CSRF,'X-Requested-With':'XMLHttpRequest'},
      body:JSON.stringify({address_id:Number(ADDR),items:Object.entries(CART).map(([id,q])=>({product_id:Number(id),quantity:q}))})
    });
    const j=await r.json().catch(()=>({}));
    if(!r.ok){
      const first=j.errors?Object.values(j.errors)[0][0]:null;
      throw new Error(first||j.message||'Could not place the order. Please try again.');
    }
    window.location.href=j.redirect;   // goes to My orders, which shows the success message
    return;
  }catch(e){ERR=e.message||'Something went wrong. Please try again.'}
  BUSY=false;render();
}

/* ---------- events ---------- */
$('#gs').addEventListener('input',e=>{Q=e.target.value;renderList()});
$('#th').onclick=()=>{const d=document.documentElement,dk=d.dataset.theme?d.dataset.theme=='dark':matchMedia('(prefers-color-scheme:dark)').matches;d.dataset.theme=dk?'light':'dark'};
document.addEventListener('keydown',e=>{if(e.key=='/'&&!/INPUT|SELECT|TEXTAREA/.test(document.activeElement.tagName)){e.preventDefault();$('#gs').focus()}});
render();
</script>
</body>
</html>