<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Rashan Cart – Dashboard</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com/3.4.17"></script>
<script>tailwind.config={theme:{extend:{colors:{bg:'var(--bg)',sf:'var(--sf)',tx:'var(--tx)',mu:'var(--mu)',bd:'var(--bd)',br:'var(--br)',bs:'var(--bs)',bt:'var(--bt)'}}}}</script>
<style>
:root{
  box-sizing:border-box;
  padding-top:env(safe-area-inset-top,0px);
  padding-bottom:env(safe-area-inset-bottom,0px);
  /* soft, light mint theme */
  --bg:#f9fcfa;      /* page */
  --sf:#ffffff;      /* cards */
  --tx:#2d4036;      /* text */
  --mu:#97a99f;      /* muted text */
  --bd:#e6eee9;      /* borders (slightly firmer so fields are visible) */
  --br:#d8f1e2;      /* soft mint accent */
  --bs:#f2faf6;      /* tinted surfaces */
  --bt:#66a985;      /* accent text / icons */
  --pf:#9ad8b4;      /* progress + filled steps */
  --bp:#d8f1e2;      /* primary button bg */
  --bpt:#3a7a58;     /* primary button text */
  --er:#e07b90;      /* error */
  --ih:44px;         /* input + field-button height */
  --sh:0 1px 2px rgba(45,64,54,.025),0 10px 28px -14px rgba(150,210,175,.35);
  color-scheme:light;
}
@media (prefers-color-scheme:dark){
  :root:not([data-theme="light"]){
    --bg:#0f1913;--sf:#15221b;--tx:#e6f1ea;--mu:#8aa296;
    --bd:#2a3d33;--br:#2c5a42;--bs:#183024;--bt:#7fd8a5;
    --pf:#4fb883;--bp:#24523b;--bpt:#c4f0d7;--sh:none;
    color-scheme:dark;
  }
}
:root[data-theme="dark"]{
  --bg:#0f1913;--sf:#15221b;--tx:#e6f1ea;--mu:#8aa296;
  --bd:#2a3d33;--br:#2c5a42;--bs:#183024;--bt:#7fd8a5;
  --pf:#4fb883;--bp:#24523b;--bpt:#c4f0d7;--sh:none;
  color-scheme:dark;
}
html{scroll-padding-top:env(safe-area-inset-top,0px)}
body{background:var(--bg);color:var(--tx);font-family:"Plus Jakarta Sans",system-ui,-apple-system,"Segoe UI",sans-serif;font-size:15px;line-height:1.5}
.card{background:var(--sf);border:1px solid var(--bd);border-radius:20px;box-shadow:var(--sh)}
.btn{border:1px solid var(--bd);border-radius:12px;padding:9px 16px;font-size:13px;font-weight:600;background:var(--sf);white-space:nowrap;color:var(--tx);transition:background .15s,border-color .15s}
.btn:hover{border-color:var(--br);background:var(--bs)}
.btn-p{background:var(--bp);border-color:var(--bp);color:var(--bpt)}
.btn-p:hover{background:color-mix(in srgb,var(--bp) 85%,var(--pf));border-color:transparent}
.btn:disabled{opacity:.5}
.btn-f{height:var(--ih);padding-top:0;padding-bottom:0;display:inline-flex;align-items:center;justify-content:center}
.btn:focus-visible,.nav:focus-visible,.chip:focus-visible{outline:2px solid var(--pf);outline-offset:2px}
.nav{display:flex;gap:10px;align-items:center;padding:10px 14px;border-radius:12px;font-size:14px;font-weight:500;color:var(--mu);width:100%;text-align:left}
.nav:hover{background:var(--bs)}
.nav.on{background:var(--bs);color:var(--bt);font-weight:600}
.chip{padding:7px 16px;border-radius:999px;font-size:13px;font-weight:600;color:var(--mu);border:1px solid var(--bd);white-space:nowrap;background:var(--sf)}
.chip:hover{border-color:var(--br)}
.chip.on{background:var(--bs);color:var(--bt);border-color:var(--br)}
th{text-align:left;font-weight:500;color:var(--mu);font-size:12px;padding:8px 14px}
td{padding:14px;border-top:1px solid var(--bd);font-size:14px;white-space:nowrap}
tbody tr:hover{background:var(--bs)}

/* ---------- Form fields ---------- */
.fl{display:block;font-size:12px;font-weight:600;color:var(--mu);margin-bottom:6px}
input,select{background:var(--sf);color:var(--tx);border:1.5px solid var(--bd);border-radius:12px;height:var(--ih);padding:0 14px;font-size:14px;font-family:inherit;outline:none;width:100%;transition:border-color .15s,box-shadow .15s}
input::placeholder{color:var(--mu);opacity:.7}
input:hover,select:hover{border-color:color-mix(in srgb,var(--bd) 50%,var(--pf))}
input:focus,select:focus{border-color:var(--pf);box-shadow:0 0 0 4px color-mix(in srgb,var(--br) 55%,transparent)}
input.bad,select.bad{border-color:var(--er)!important;box-shadow:0 0 0 4px color-mix(in srgb,var(--er) 15%,transparent)}
select{appearance:none;-webkit-appearance:none;cursor:pointer;padding-right:40px;text-overflow:ellipsis;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2397a99f' stroke-width='2.4' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 14px center}
select option{color:var(--tx);background:var(--sf)}
.err{font-size:12px;color:var(--er);margin-top:5px;font-weight:500;min-height:0}
.err:empty{display:none}
.stp{display:inline-flex;align-items:center;border:1.5px solid var(--bd);border-radius:12px;height:var(--ih);background:var(--sf)}
.stp button{width:44px;height:100%;display:grid;place-items:center;color:var(--bt);border-radius:10px}
.stp button:hover{background:var(--bs)}
.stp button:focus-visible{outline:2px solid var(--pf);outline-offset:-2px}
.stp b{min-width:36px;text-align:center;font-size:15px}
@media (max-width:640px){input,select{font-size:16px}}

.pop{animation:pop .18s ease-out}@keyframes pop{from{opacity:0;transform:translateY(6px)}to{opacity:1;transform:none}}
@media (prefers-reduced-motion:reduce){.pop{animation:none}input,select{transition:none}}
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
        <input id="gs" type="search" placeholder="Search products" style="padding-left:42px" oninput="gsearch(this.value)" aria-label="Search products" autocomplete="off">
      </div>
      <div class="ml-auto flex items-center gap-2 relative">
        <button class="btn" id="th">Theme</button>
        <button class="btn !p-2.5" onclick="$('#np').classList.toggle('hidden')" aria-label="Notifications"><span id="icb"></span></button>
        <div id="np" class="hidden pop absolute right-0 top-12 w-72 card p-4 z-30"></div>
        <div class="w-10 h-10 rounded-full bg-br text-[#3a7a58] grid place-items-center text-sm font-bold">
          {{ strtoupper(substr(auth()->user()->name ?? 'AM', 0, 2)) }}
        </div>
      </div>
    </header>

    {{-- Mobile nav --}}
    <div id="mnav" class="lg:hidden flex gap-2 overflow-x-auto px-4 pt-3"></div>

    {{-- View container --}}
    <div id="view" class="p-4 md:p-8 max-w-[1100px] mx-auto"></div>

  </main>
</div>

<div id="toast" class="fixed bottom-5 right-5 z-50"></div>
<div id="modal"></div>

<script>
const $=s=>document.querySelector(s);
const put=(s,h)=>{const e=document.querySelector(s);if(e)e.innerHTML=h}; /* safe innerHTML: skips elements that do not exist */
const esc=s=>String(s).replace(/&/g,'&amp;').replace(/"/g,'&quot;').replace(/</g,'&lt;');
const P={home:'M3 11l9-8 9 8v10a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1z',mega:'M3 11v2a1 1 0 0 0 1 1h2l5 4V6L6 10H4a1 1 0 0 0-1 1zM16 8a5 5 0 0 1 0 8',bag:'M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4zM3 6h18M16 10a4 4 0 0 1-8 0',cart:'M3 4h2l2.5 11h10L20 7H6.5M9 20h.01M17 20h.01',truck:'M2 6h11v10H2zM13 9h4l4 4v3h-8M6 19h.01M17 19h.01',chart:'M4 20V10M10 20V4M16 20v-8M22 20H2',user:'M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8',bell:'M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9M10 21h4',search:'M11 19a8 8 0 1 0 0-16 8 8 0 0 0 0 16M21 21l-4.3-4.3',plus:'M12 5v14M5 12h14',minus:'M5 12h14',tag:'M20.6 13.4l-7.2 7.2a2 2 0 0 1-2.8 0L2 12V2h10l8.6 8.6a2 2 0 0 1 0 2.8zM7 7h.01',gift:'M20 12v9H4v-9M2 7h20v5H2zM12 22V7M12 7H7.5a2.5 2.5 0 1 1 0-5C11 2 12 7 12 7zM12 7h4.5a2.5 2.5 0 1 0 0-5C13 2 12 7 12 7z',check:'M5 13l4 4L19 7',pin:'M12 22s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12zM12 12.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5'};
const ic=(n,c='w-[18px] h-[18px]')=>`<svg class="${c}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="${P[n]}"/></svg>`;
const badge=(t,c='g')=>{const m={g:'#5fb383',a:'#d19a3c',r:'#e07b90',b:'#6a9fd0',x:'#9aa9a1'}[c];return `<span style="color:${m};background:${m}1c" class="text-xs font-semibold px-3 py-1 rounded-full whitespace-nowrap">${t}</span>`};
const prog=(p)=>`<div class="h-2.5 rounded-full bg-bd overflow-hidden min-w-[80px]"><div class="h-full rounded-full" style="width:${Math.min(100,p)}%;background:var(--pf)"></div></div>`;
const card=(t,b,a='',x='')=>`<section class="card p-6 ${x}"><div class="flex items-center justify-between gap-2 mb-4"><h2 class="font-semibold text-base">${t}</h2>${a}</div>${b}</section>`;
const table=(h,r)=>`<div class="overflow-x-auto -mx-2"><table class="w-full"><thead><tr>${h.map(x=>`<th>${x}</th>`).join('')}</tr></thead><tbody>${r.map(x=>`<tr>${x.map(c=>`<td>${c}</td>`).join('')}</tr>`).join('')}</tbody></table></div>`;
const head=(t,s,a='')=>`<div class="flex flex-wrap items-end justify-between gap-3 mb-6"><div><h1 class="text-2xl font-bold tracking-tight">${t}</h1><p class="text-sm text-mu mt-1">${s}</p></div><div class="flex gap-2 items-center">${a}</div></div>`;
const ms=(l,v,d,i)=>`<div class="card p-5"><div class="flex items-center justify-between"><p class="text-sm text-mu">${l}</p><span class="w-10 h-10 rounded-xl bg-bs text-bt grid place-items-center">${ic(i)}</span></div><p class="text-2xl font-bold mt-2">${v}</p><p class="text-xs text-mu mt-1">${d}</p></div>`;
const toast=m=>{$('#toast').innerHTML=`<div class="pop card px-4 py-3 text-sm font-semibold">${m}</div>`;clearTimeout(toast.t);toast.t=setTimeout(()=>$('#toast').innerHTML='',2600)};
const bars=(v,l)=>{const m=Math.max(...v);return `<div class="flex items-end gap-3 h-44">${v.map((x,i)=>`<div class="flex-1 h-full flex flex-col justify-end items-center gap-1"><span class="text-[11px] text-mu">Rs ${x}</span><div class="w-full rounded-t-xl" style="height:${x/m*78}%;background:var(--pf);opacity:${i==v.length-1?1:.45}"></div><span class="text-[11px] text-mu">${l[i]}</span></div>`).join('')}</div>`};

/* ---------- data ----------
   S.prods = products open for ordering in the customer's area
   p = group price, m = store price, j = orders placed so far, t = orders needed to lock the price, d = days left to order */
const S={view:'home',cat:'All',q:'',
prods:[{n:'Basmati rice 5 kg',c:'Staples',p:11.2,m:14.5,j:84,t:100,d:2},{n:'Cooking oil 5 L',c:'Oils',p:13.9,m:17.8,j:47,t:80,d:4},{n:'Fresh eggs, 30 tray',c:'Dairy and eggs',p:5.1,m:6.4,j:120,t:120,d:1},{n:'Wheat flour 10 kg',c:'Staples',p:8.4,m:10.9,j:22,t:60,d:6},{n:'Pulses bundle',c:'Staples',p:6.4,m:8.2,j:64,t:70,d:3},{n:'Sugar 5 kg',c:'Staples',p:4.9,m:6.1,j:38,t:90,d:5}],
orders:[{id:'#1042',c:5,q:2,s:'Delivered',d:'Oct 12'},{id:'#1051',c:2,q:2,s:'Out for delivery',d:'Oct 21'},{id:'#1058',c:3,q:1,s:'Placed',d:'Oct 23'},{id:'#1060',c:0,q:1,s:'Packed',d:'Oct 22'}],
addr:[['Home','House 12, Block 7',1],['Parents','Flat 4B, Block 9',0]],me:{name:'Ayesha Muhib',email:'ayesha.muhib@example.com',phone:'(555) 014-2290'},next:1061};
/* order status flow: Placed -> Confirmed -> Packed -> Out for delivery -> Delivered */
const stage={Placed:0,Confirmed:1,Packed:2,'Out for delivery':3,Delivered:4};
const lab={Placed:'Order placed',Confirmed:'Confirmed',Packed:'Packed','Out for delivery':'On the way',Delivered:'Delivered',Cancelled:'Cancelled'};
const sc={Placed:'a',Confirmed:'b',Packed:'b','Out for delivery':'b',Delivered:'g',Cancelled:'x'};
const live=o=>o.s!='Cancelled';const active=o=>live(o)&&o.s!='Delivered';
const money=n=>'Rs '+n.toFixed(2);
const tot=o=>S.prods[o.c].p*o.q,sav=o=>(S.prods[o.c].m-S.prods[o.c].p)*o.q;
const NAV=[['home','Home','home'],['shop','Shop','bag'],['orders','My orders','cart'],['deliveries','Deliveries','truck'],['savings','Savings','chart'],['profile','Profile','user']];
const defAddr=()=>S.addr.find(x=>x[2])[1];
const left=d=>`${d} ${d==1?'day':'days'} left to order`;

const steps=(k)=>`<div class="flex items-start">${['Placed','Confirmed','Packed','On the way','Delivered'].map((l,i)=>`<div class="flex-1 flex flex-col items-center relative"><div class="absolute top-3.5 right-1/2 w-full h-0.5 ${i?'':'hidden'}" style="background:${i<=k?'var(--pf)':'var(--bd)'}"></div><div class="relative w-7 h-7 rounded-full grid place-items-center" style="color:#fff;background:${i<=k?'var(--pf)':'var(--bd)'}">${i<=k?ic('check','w-4 h-4'):''}</div><p class="text-[11px] mt-1.5 text-center ${i==k?'font-bold':'text-mu'}">${l}</p></div>`).join('')}</div>`;
const ptile=()=>`<div class="w-11 h-11 rounded-xl bg-bs text-bt grid place-items-center shrink-0">${ic('tag')}</div>`;

/* product card (Shop page) */
const pc=(c,i)=>{const mine=S.orders.some(o=>o.c==i&&active(o)),pct=c.j/c.t*100,ok=c.j>=c.t;return `<div class="card p-5 flex flex-col"><div class="flex items-start gap-3">${ptile()}<div class="min-w-0 flex-1"><p class="font-semibold leading-tight">${c.n}</p><p class="text-xs text-mu mt-0.5">${left(c.d)}</p></div>${mine?badge('Ordered'):''}</div><div class="flex items-end gap-2 mt-4"><span class="text-2xl font-bold">${money(c.p)}</span><s class="text-sm text-mu pb-0.5">${money(c.m)}</s><span class="ml-auto text-xs font-bold text-bt bg-bs px-2.5 py-1 rounded-lg">Save ${Math.round((c.m-c.p)/c.m*100)}%</span></div><div class="mt-4">${prog(pct)}</div><p class="text-xs text-mu mt-2">${ok?'Group price is locked.':`${c.t-c.j} more orders to lock the group price`}</p><button class="btn btn-p btn-f mt-4 w-full" onclick="orderOpen(${i})">${mine?'Order again':'Order now'}</button></div>`};
const pgrid=()=>{const l=S.prods.map((c,i)=>[c,i]).filter(([c])=>(S.cat=='All'||c.c==S.cat)&&c.n.toLowerCase().includes(S.q.toLowerCase()));return l.map(([c,i])=>pc(c,i)).join('')||`<p class="text-sm text-mu col-span-full">No products found. Clear the search or pick another category.</p>`};

/* compact rows (Home page) */
const prow=(c,i,f)=>`<div class="flex items-center gap-3 py-3 ${f?'':'border-t border-bd'}">${ptile()}<div class="min-w-0 flex-1"><p class="font-semibold text-sm truncate">${c.n}</p><p class="text-xs text-mu">${money(c.p)} · ${left(c.d)}</p></div><button class="btn btn-p" onclick="orderOpen(${i})">Order</button></div>`;
const orow=(o,f)=>`<div class="flex items-center gap-3 py-3 ${f?'':'border-t border-bd'}">${ptile()}<div class="min-w-0 flex-1"><p class="font-semibold text-sm truncate">${S.prods[o.c].n} x${o.q}</p><p class="text-xs text-mu">${o.id} · ${o.d} · ${money(tot(o))}</p></div>${badge(lab[o.s],sc[o.s])}</div>`;
const newBtn=()=>`<button class="btn btn-p flex items-center gap-1.5" onclick="orderOpen()">${ic('plus','w-4 h-4')}New order</button>`;

/* profile field: label + input + inline error */
const PF=(l,k,t,ac,im)=>`<div><label class="fl" for="p-${k}">${l}</label><input id="p-${k}" name="${k}" type="${t}" autocomplete="${ac}" ${im?`inputmode="${im}"`:''} value="${esc(S.me[k])}" oninput="S.me.${k}=this.value;pcheck('${k}',1)" onblur="pcheck('${k}')" aria-describedby="pe-${k}"><p id="pe-${k}" class="err" role="alert"></p></div>`;
const PV={
  name:v=>v.trim().length<3?'Enter your full name.':'',
  email:v=>!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v.trim())?'Enter a valid email address.':'',
  phone:v=>{const d=v.replace(/\D/g,'').length;return d<10||d>15?'Enter a valid phone number (10 to 15 digits).':''}
};
function pcheck(k,soft){const el=$('#p-'+k),m=PV[k](el.value);if(soft&&!el.classList.contains('bad')){return !m}el.classList.toggle('bad',!!m);if(m)el.setAttribute('aria-invalid','true');else el.removeAttribute('aria-invalid');$('#pe-'+k).textContent=m;return !m}
function saveP(){let first=null;['name','email','phone'].forEach(k=>{if(!pcheck(k)&&!first)first=k});if(first){$('#p-'+first).focus();toast('Please fix the highlighted fields');return}toast('Profile saved')}

const V={
home(){const a=S.orders.filter(active),s=S.orders.filter(live).reduce((t,o)=>t+sav(o),0),tr=S.orders.find(o=>o.s=='Out for delivery')||S.orders.find(o=>o.s=='Packed'),w=a.filter(o=>o.s=='Placed').length;
 const end=S.prods.map((c,i)=>[c,i]).sort((x,y)=>x[0].d-y[0].d).slice(0,3);
 return head('Hi, Ayesha Muhib','Place an order, then track it right here.',newBtn())+
 `<div class="grid sm:grid-cols-3 gap-4">${ms('You saved',money(s),'Compared with store prices','chart')}${ms('Active orders',a.length,w?`${w} awaiting confirmation`:'All on track','cart')}${ms('Next delivery','Thursday','Between 4 and 6 pm','truck')}</div>`+
 `<div class="grid xl:grid-cols-5 gap-4 mt-4">${card('Your delivery',tr?`<div class="flex items-center justify-between mb-5"><div><p class="font-semibold">${S.prods[tr.c].n} x${tr.q}</p><p class="text-xs text-mu">To ${defAddr()}</p></div>${badge(lab[tr.s],'b')}</div>${steps(stage[tr.s])}`:`<p class="text-sm text-mu">Nothing on the way yet.</p><button class="btn btn-p mt-3" onclick="orderOpen()">Place an order</button>`,'','xl:col-span-3')}${card('Order before it closes',end.map(([c,i],k)=>prow(c,i,k==0)).join(''),`<button class="btn" onclick="go('shop')">See all</button>`,'xl:col-span-2')}</div>`+
 `<div class="mt-4">${card('Recent orders',S.orders.slice(-3).reverse().map((o,k)=>orow(o,k==0)).join(''),`<button class="btn" onclick="go('orders')">View all</button>`)}</div>`},
otable(l,act){return table(['Item','Total','Status',''].filter((x,i)=>act||i<3),l.map(o=>{const i=S.orders.indexOf(o),r=[`<b>${S.prods[o.c].n}</b> <span class="text-mu">x${o.q}</span>`,money(tot(o)),badge(lab[o.s],sc[o.s])];if(act)r.push(o.s=='Placed'?`<button class="btn" onclick="cancelO(${i})">Cancel</button>`:'');return r}))},
shop(){const cats=['All','Staples','Oils','Dairy and eggs'];return head('Shop','Pick a product and place your order. The more orders, the lower the price.')+`<div class="flex gap-2 mb-5 overflow-x-auto">${cats.map(x=>`<button class="chip ${x==S.cat?'on':''}" onclick="S.cat='${x}';draw()">${x}</button>`).join('')}</div><div id="cg" class="grid sm:grid-cols-2 xl:grid-cols-3 gap-4">${pgrid()}</div>`},
orders(){return head('My orders','You can cancel an order until it is confirmed.',newBtn())+card('All orders',S.orders.length?V.otable(S.orders.slice().reverse(),1):`<p class="text-sm text-mu">No orders yet.</p><button class="btn btn-p mt-3" onclick="orderOpen()">Place your first order</button>`)},
deliveries(){const l=S.orders.filter(active);return head('Deliveries','Follow each order until it reaches your door.')+(l.length?`<div class="space-y-4">${l.map(o=>`<div class="card p-6"><div class="flex flex-wrap items-center justify-between gap-2 mb-5"><div><p class="font-semibold">${S.prods[o.c].n} x${o.q}</p><p class="text-xs text-mu flex items-center gap-1 mt-1">${ic('pin','w-3.5 h-3.5')}${defAddr()}</p></div>${badge(lab[o.s],sc[o.s])}</div>${steps(stage[o.s])}<p class="text-xs text-mu mt-4">${o.s=='Out for delivery'?'Rider Imran is 3 stops away. Expected between 4 and 6 pm.':o.s=='Packed'?'Packed and waiting for a rider.':o.s=='Placed'?`${Math.max(0,S.prods[o.c].t-S.prods[o.c].j)} more orders needed to lock the group price.`:'Confirmed. Stock arrives soon.'}</p></div>`).join('')}</div>`:card('No active deliveries',`<p class="text-sm text-mu">Place an order and your delivery will show up here.</p><button class="btn btn-p mt-3" onclick="orderOpen()">Place an order</button>`))},
savings(){const l=S.orders.filter(live),s=l.reduce((t,o)=>t+sav(o),0),sp=l.reduce((t,o)=>t+tot(o),0);return head('Savings','See what group buying has saved you.')+`<div class="grid sm:grid-cols-2 gap-4 mb-4">${ms('Total saved',money(s),'All time','chart')}${ms('Total spent',money(sp),'Across '+l.length+' orders','cart')}</div><div class="grid xl:grid-cols-5 gap-4">${card('Savings by month',bars([18,26,31,22,35,Math.round(s)],['May','Jun','Jul','Aug','Sep','Oct']),'','xl:col-span-3')}${card('By product',l.map(o=>`<div class="py-2"><div class="flex justify-between text-sm mb-1.5"><span class="font-medium truncate pr-3">${S.prods[o.c].n}</span><b class="text-bt">${money(sav(o))}</b></div>${prog(sav(o)/s*100)}</div>`).join(''),'','xl:col-span-2')}</div>`},
profile(){return head('Profile','Your details and delivery addresses.',`<button class="btn btn-p" onclick="saveP()">Save changes</button>`)+`<div class="grid xl:grid-cols-2 gap-4">${card('Personal details',`<div class="space-y-4">${PF('Full name','name','text','name')}${PF('Email','email','email','email','email')}${PF('Phone','phone','tel','tel','tel')}</div>`)}${card('Delivery addresses',S.addr.map((a,i)=>`<div class="flex items-center gap-3 py-3 ${i?'border-t border-bd':''}"><span class="w-10 h-10 rounded-xl bg-bs text-bt grid place-items-center shrink-0">${ic('pin')}</span><div class="flex-1 min-w-0"><p class="text-sm font-semibold">${esc(a[0])}</p><p class="text-xs text-mu truncate">${esc(a[1])}</p></div>${a[2]?badge('Default'):`<button class="btn" onclick="S.addr.forEach((x,j)=>x[2]=+(j==${i}));draw();toast('Default address updated')">Make default</button>`}</div>`).join('')+`<div class="mt-3 pt-4 border-t border-bd"><label class="fl" for="na">Add a new address</label><div class="flex gap-2"><input id="na" name="address" autocomplete="street-address" placeholder="e.g. House 3, Block 7" oninput="this.classList.remove('bad');$('#ne').textContent=''" onkeydown="if(event.key=='Enter'){event.preventDefault();addA()}" aria-describedby="ne"><button class="btn btn-p btn-f shrink-0" onclick="addA()">Add</button></div><p id="ne" class="err" role="alert"></p></div>`)}</div>`}
};
function go(v){S.view=v;draw();scrollTo(0,0)}
function draw(){
  /* page content first, so it always shows even if the sidebar partial has no #nav */
  try{$('#view').innerHTML=V[S.view]()}catch(e){console.error(e);$('#view').innerHTML='<div class="card p-6"><p class="font-semibold">Something went wrong</p><p class="text-sm text-mu mt-1">'+esc(e.message)+'</p></div>'}
  put('#nav',NAV.map(x=>`<button class="nav ${x[0]==S.view?'on':''}" onclick="go('${x[0]}')">${ic(x[2])}${x[1]}</button>`).join(''));
  const m=$('#mnav');
  m.innerHTML=NAV.map(x=>`<button class="chip ${x[0]==S.view?'on':''}" onclick="go('${x[0]}')">${x[1]}</button>`).join('');
  m.classList.toggle('lg:hidden',!!$('#nav')); /* no sidebar #nav? show the chip menu on desktop too */
}
function gsearch(q){S.q=q;if(S.view!='shop'){S.view='shop';draw();$('#gs').focus()}else $('#cg').innerHTML=pgrid()}
function cancelO(i){const o=S.orders[i];o.s='Cancelled';S.prods[o.c].j-=o.q;draw();toast('Order cancelled. Nothing was charged')}
function addA(){const el=$('#na'),v=el.value.trim();if(v.length<5){el.classList.add('bad');$('#ne').textContent='Enter a full address (at least 5 characters).';el.focus();return}S.addr.push(['Other',v,0]);draw();toast('Address added')}

/* ---------- create order ---------- */
let M={c:0,q:1,a:0};
function orderOpen(i){M={c:i==null?0:i,q:1,a:Math.max(0,S.addr.findIndex(x=>x[2]))};mdraw()}
function mq(d){M.q=Math.max(1,Math.min(10,M.q+d));mdraw()}
function mclose(){$('#modal').innerHTML=''}
function mdraw(){const c=S.prods[M.c];$('#modal').innerHTML=`<div class="fixed inset-0 z-40 grid place-items-center p-4 overflow-y-auto" style="background:#2d403655" onclick="if(event.target==this)mclose()"><div class="pop card p-6 w-full max-w-md" role="dialog" aria-modal="true" aria-label="New order"><h2 class="font-bold text-lg">New order</h2><p class="text-sm text-mu mb-5">Choose what you need. You pay when the order is confirmed.</p>
<div><label class="fl" for="m-p">Product</label><select id="m-p" onchange="M.c=+this.value;mdraw();$('#m-p').focus()">${S.prods.map((p,k)=>`<option value="${k}" ${k==M.c?'selected':''}>${p.n} · ${money(p.p)}</option>`).join('')}</select></div>
<div class="flex items-center justify-between mt-4"><span class="fl !mb-0">How many?</span><div class="stp"><button type="button" onclick="mq(-1)" aria-label="Less">${ic('minus','w-4 h-4')}</button><b aria-live="polite">${M.q}</b><button type="button" onclick="mq(1)" aria-label="More">${ic('plus','w-4 h-4')}</button></div></div>
<div class="mt-4"><label class="fl" for="m-a">Deliver to</label><select id="m-a" onchange="M.a=+this.value">${S.addr.map((a,k)=>`<option value="${k}" ${k==M.a?'selected':''}>${esc(a[0])}: ${esc(a[1])}</option>`).join('')}</select></div>
<div class="rounded-2xl bg-bs p-4 mt-5 text-sm space-y-2"><div class="flex justify-between"><span class="text-mu">You pay</span><b>${money(c.p*M.q)}</b></div><div class="flex justify-between text-bt font-bold"><span>You save</span><span>${money((c.m-c.p)*M.q)}</span></div></div>
<div class="flex gap-2 mt-5"><button class="btn btn-f flex-1" onclick="mclose()">Cancel</button><button class="btn btn-p btn-f flex-1" onclick="placeO()">Place order</button></div></div></div>`}
function placeO(){const c=S.prods[M.c];c.j+=M.q;S.orders.push({id:'#'+(S.next++),c:M.c,q:M.q,s:c.j>=c.t?'Confirmed':'Placed',d:'Oct 25'});mclose();S.view='orders';draw();toast('Order placed: '+c.n)}

put('#ics',ic('search','w-4 h-4'));put('#icb',ic('bell','w-4 h-4'));put('#icg',ic('gift','w-5 h-5'));
$('#np').innerHTML='<p class="font-semibold text-sm mb-2">Notifications</p>'+['Your eggs order is on the way','Rice needs 16 more orders to lock the price','Oil price dropped to Rs 13.90'].map(t=>`<p class="text-sm py-2 border-t border-bd">${t}</p>`).join('');
$('#th').onclick=()=>{const d=document.documentElement,dk=d.dataset.theme?d.dataset.theme=='dark':matchMedia('(prefers-color-scheme:dark)').matches;d.dataset.theme=dk?'light':'dark'};
document.addEventListener('keydown',e=>{
  if(e.key=='Escape'&&$('#modal').innerHTML)mclose();
  if(e.key=='/'&&!/INPUT|SELECT|TEXTAREA/.test(document.activeElement.tagName)){e.preventDefault();$('#gs').focus()}
});
draw();
</script>
</body>
</html>