(() => {
  if (window.__A11Y_WIDGET__) return; window.__A11Y_WIDGET__ = true;

  const Z = 999999;
  const PERSIST_KEY = "a11y_widget_prefs_v4";
  const prefs = loadPrefs();
  const html = document.documentElement;

  const globalCSS = `
:root { --a11y-font-scale: 100%; }
/* ===== Scalable text ===== */
html[data-a11y-font-scale] body { font-size: var(--a11y-font-scale) !important; }

/* ===== Strong dark mode (with !important) ===== */
html[data-a11y-dark] { color-scheme: dark; background-color:#0e1116 !important; }
html[data-a11y-dark] body { background-color:#0e1116 !important; color:#e9eef5 !important; }
html[data-a11y-dark] main, html[data-a11y-dark] section, html[data-a11y-dark] article,
html[data-a11y-dark] header, html[data-a11y-dark] footer, html[data-a11y-dark] nav, html[data-a11y-dark] aside,
html[data-a11y-dark] [role="main"], html[data-a11y-dark] [class*="content"], html[data-a11y-dark] [class*="container"] {
  background-color:#0f1218 !important; color:#e9eef5 !important; border-color:#293041 !important;
}
html[data-a11y-dark] a { color:#8fb9ff !important; }
html[data-a11y-dark] :where(input,select,textarea,button) {
  background-color:#0f1624 !important; color:#e9eef5 !important; border-color:#293041 !important;
}

/* ===== High contrast ===== */
html[data-a11y-hc] { color-scheme: dark; background:#000 !important; }
html[data-a11y-hc] body { background:#000 !important; color:#fff !important; }
html[data-a11y-hc] a { color:#ffd400 !important; text-decoration: underline !important; }

/* ===== Other toggles ===== */
html[data-a11y-underline-links] a { text-decoration: underline !important; }
html[data-a11y-text-spacing] body { line-height:1.8 !important; letter-spacing:.06em !important; word-spacing:.25em !important; }
html[data-a11y-dyslexia] body { font-family: Arial, Verdana, Tahoma, sans-serif !important; font-variant-ligatures:none !important; letter-spacing:.08em !important; }
html[data-a11y-hide-images] img:not([aria-hidden="false"]) { display:none !important; }
html[data-a11y-grayscale] { filter: grayscale(1) !important; }
html[data-a11y-focus-ring] *:focus { outline: 3px solid #1ea7ff !important; outline-offset: 2px !important; }
/* Always stop animations when the toggle sets data-a11y-pause-anim */
html[data-a11y-pause-anim],
html[data-a11y-pause-anim] *:not(#a11y-widget-root):not(#a11y-reading-mask):not(#a11y-widget-root *),
html[data-a11y-pause-anim] *::before,
html[data-a11y-pause-anim] *::after{
  animation: none !important;
  animation-play-state: paused !important;
  transition: none !important;
  scroll-behavior: auto !important;
}

/* Also respect OS "Reduce Motion" even if the toggle is off */
@media (prefers-reduced-motion: reduce) {
  html:not([data-a11y-pause-anim-off]) *:not(#a11y-widget-root):not(#a11y-reading-mask):not(#a11y-widget-root *),
  html:not([data-a11y-pause-anim-off]) *::before,
  html:not([data-a11y-pause-anim-off]) *::after{
    animation: none !important;
    animation-play-state: paused !important;
    transition: none !important;
    scroll-behavior: auto !important;
  }
}

/* ===== Skip link ===== */
#a11y-skip {
  position: fixed; left: .5rem; top: .5rem; z-index: ${Z - 1};
  background: #0b5cff; color: #fff; padding: .5rem .75rem; border-radius: .5rem;
  text-decoration: none; box-shadow: 0 4px 16px rgba(0,0,0,.2); transform: translateY(-150%); transition: transform .15s ease;
}
#a11y-skip:focus { transform: translateY(0); outline: none; }

/* ===== Reading mask ===== */
#a11y-reading-mask {
  pointer-events: none; position: fixed; inset: 0; z-index: ${Z - 2};
  background: linear-gradient(#0008,#0008) top/100% calc(var(--band-top,40%) - var(--band-height,3rem)),
              linear-gradient(#0008,#0008) bottom/100% calc(100% - var(--band-top,40%) - var(--band-height,3rem)),
              transparent;
  background-repeat: no-repeat;
  transition: background-position .05s linear;
}

/* ===== Hover Reader highlight ===== */
[data-a11y-read-target] { outline: 2px dashed #0b5cff !important; outline-offset: 2px !important; }

/* ===== Floating Hover-Read Button ===== */
#a11y-hover-read-btn {
  position: fixed; inset: 0 auto auto 0; transform: translate(-9999px,-9999px);
  z-index: ${Z - 1}; width: 44px; height: 44px; border-radius: 999px;
  background:#0b5cff; color:#fff; display:none; place-items:center; box-shadow: 0 10px 24px rgba(0,0,0,.24);
  cursor: pointer; border:0; user-select: none;
}
#a11y-hover-read-btn svg { width:22px; height:22px; fill: currentColor; }
#a11y-hover-read-btn[visible] { display:grid; }
`;

  const root = document.createElement('div');
  root.id = 'a11y-widget-root';
  root.style.all = 'initial';
  root.style.position = 'fixed';
  root.style.insetInlineEnd = '16px';
  root.style.insetBlockEnd = '16px';
  root.style.zIndex = String(Z);
  root.attachShadow({ mode: 'open' });

  const panelHTML = `
<style>
  :host { all: initial; }
  * { box-sizing: border-box; font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, "Noto Sans", "Helvetica Neue", sans-serif; }
  button, input, select { font: inherit; }

  .fab {
    position: fixed; inset-inline-end: 0; inset-block-end: 0;
    width: 52px; height: 52px; border-radius: 999px; border: 0;
    background: #0b5cff; color: #fff; cursor: pointer;
    display: grid; place-items: center; box-shadow: 0 10px 24px rgba(0,0,0,.24);
    bottom:10px;
    left:10px;
  }
  .fab:focus-visible { outline: 3px solid #1ea7ff; outline-offset: 2px; }
  .icon { width: 24px; height: 24px; fill: currentColor; }

  .backdrop { position: fixed; inset: 0; background: rgba(0,0,0,.5); display: none; }
  .panel {
    position: fixed; top: 50%; left: 50%; transform: translate(-50%,-50%);
    width: min(560px, calc(100vw - 32px)); max-height: min(80vh, 680px); overflow: auto;
    background: #10131a; color: #eaf1ff; border: 1px solid #2a3242; border-radius: 14px;
    box-shadow: 0 24px 80px rgba(0,0,0,.55); padding: 12px; display: none;
  }
  .panel[open], .backdrop[open] { display: block; }
  .row { display: flex; align-items: center; justify-content: space-between; gap: 10px; padding: 8px 6px; border-radius: 10px; }
  .row:hover { background: #161b26; }
  .row label { display: flex; align-items:center; gap: 8px; font-size: 14px; line-height:1.2; }
  .switch { inline-size: 44px; block-size: 24px; border-radius: 999px; background:#2a3242; position: relative; }
  .switch input { opacity: 0; position: absolute; inset:0; margin:0; }
  .knob { position:absolute; inset-block:2px; inset-inline-start:2px; width:20px; height:20px; background:#fff; border-radius:999px; transition: transform .2s; }
  .switch input:checked + .knob { transform: translateX(20px); }
  .hdr { display:flex; align-items:center; justify-content: space-between; padding: 6px; margin-bottom: 6px; }
  .title { font-weight: 700; font-size: 14px; letter-spacing:.3px; }
  .close { background:none; border:0; color:#9fb3ff; cursor:pointer; padding:6px; }
  .hr { height:1px; background:#20283a; margin: 8px 0; border-radius:2px; }
  .range { width: 160px; }
  .hint { color:#9fb0c7; font-size:12px; }
  .btn { appearance:none; border:1px solid #2a3242; background:#0f1520; color:#d7e3ff; padding:8px 10px; border-radius:10px; cursor:pointer; }
  .btn:hover { background:#151c2a; }
  .footer { display:flex; gap:8px; flex-wrap: wrap; padding:6px; }
  .visually-hidden { position:absolute !important; width:1px;height:1px;overflow:hidden;clip:rect(1px,1px,1px,1px);white-space:nowrap;border:0;padding:0;margin:-1px; }
  .kbd { border:1px solid #2a3242; padding:0 6px; border-radius:6px; background:#0f1520; }
  .tts-opts { display:flex; gap:8px; align-items:center; color:#9fb0c7; font-size:12px; }
  .tts-opts input { width: 80px; }
</style>

<button class="fab" id="a11y-open" aria-haspopup="dialog" aria-expanded="false" aria-controls="a11y-panel" title="Accessibility options">
  <svg class="icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2a2 2 0 1 1-.001 3.999A2 2 0 0 1 12 2zm-7.5 6a1.5 1.5 0 0 0 0 3h4.07l-.81 9.27a1.5 1.5 0 1 0 2.98.26L11.5 14h1l.76 6.53a1.5 1.5 0 0 0 2.98-.26L15.43 11H19.5a1.5 1.5 0 0 0 0-3h-15z"/></svg>
  <span class="visually-hidden">Open accessibility options</span>
</button>

<div class="backdrop" id="a11y-backdrop" aria-hidden="true"></div>

<div class="panel" id="a11y-panel" role="dialog" aria-modal="true" aria-labelledby="a11y-title">
  <div class="hdr">
    <div class="title" id="a11y-title">Accessibility</div>
    <button class="close" id="a11y-close" aria-label="Close (Esc)">✕</button>
  </div>

  <div class="row" id="row-scale">
    <label for="a11y-scale">
      <svg class="icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 4h16v2H4V4zm3 4h10v2H7V8zm-3 4h16v2H4v-2zm3 4h6v2H7v-2z"/></svg>
      Text size
    </label>
    <input id="a11y-scale" class="range" type="range" min="80" max="220" step="5" value="100" aria-valuemin="80" aria-valuemax="220" aria-valuenow="100" aria-label="Text size percent">
  </div>

  <div class="row"><label><svg class="icon" viewBox="0 0 24 24"><path d="M12 2a8 8 0 100 16 8 8 0 000-16zM6 10h12"/></svg> Dark mode</label><span class="switch"><input id="a11y-dark" type="checkbox" /><span class="knob"></span></span></div>
  <div class="row"><label><svg class="icon" viewBox="0 0 24 24"><path d="M3 4h18v4H3V4zm0 6h18v10H3V10z"/></svg> High contrast</label><span class="switch"><input id="a11y-hc" type="checkbox" /><span class="knob"></span></span></div>
  <div class="row"><label><svg class="icon" viewBox="0 0 24 24"><path d="M4 6h16v2H4zm0 10h16v2H4z"/></svg> Text spacing</label><span class="switch"><input id="a11y-spacing" type="checkbox" /><span class="knob"></span></span></div>
  <div class="row"><label><svg class="icon" viewBox="0 0 24 24"><path d="M4 5h16v2H4zM4 11h16v2H4zM4 17h10v2H4z"/></svg> Dyslexia-friendly</label><span class="switch"><input id="a11y-dys" type="checkbox" /><span class="knob"></span></span></div>
  <div class="row"><label><svg class="icon" viewBox="0 0 24 24"><path d="M4 6h16v2H4zm0 10h16v2H4z"/></svg> Underline links</label><span class="switch"><input id="a11y-ul" type="checkbox" /><span class="knob"></span></span></div>
  <div class="row"><label><svg class="icon" viewBox="0 0 24 24"><path d="M12 4a8 8 0 100 16 8 8 0 000-16zm0 2a6 6 0 110 12A6 6 0 0112 6z"/></svg> Always show focus</label><span class="switch"><input id="a11y-focus" type="checkbox" /><span class="knob"></span></span></div>
  <div class="row"><label><svg class="icon" viewBox="0 0 24 24"><path d="M21 4H3v16h18V4zM5 6h14v8H5V6zm4 10h6v2H9v-2z"/></svg> Hide images</label><span class="switch"><input id="a11y-hideimg" type="checkbox" /><span class="knob"></span></span></div>
  <div class="row"><label><svg class="icon" viewBox="0 0 24 24"><path d="M8 5v14l11-7zM3 5h3v14H3z"/></svg> Mute & pause videos</label><span class="switch"><input id="a11y-mutevid" type="checkbox" /><span class="knob"></span></span></div>
  <div class="row"><label><svg class="icon" viewBox="0 0 24 24"><path d="M4 4h16v16H4z"/></svg> Grayscale</label><span class="switch"><input id="a11y-gray" type="checkbox" /><span class="knob"></span></span></div>
  <div class="row"><label><svg class="icon" viewBox="0 0 24 24"><path d="M4 6h16v2H4zm0 10h16v2H4z"/></svg> Pause animations</label><span class="switch"><input id="a11y-anim" type="checkbox" /><span class="knob"></span></span></div>
  <div class="row"><label><svg class="icon" viewBox="0 0 24 24"><path d="M21 3H3v2h8v14h2V5h8z"/></svg> Reading mask</label><span class="switch"><input id="a11y-mask" type="checkbox" /><span class="knob"></span></span></div>

  <div class="hr"></div>

  <div class="row"><label><svg class="icon" viewBox="0 0 24 24"><path d="M6 4h12v2H6V4zm0 4h12v2H6V8zm0 4h12v2H6v-2zm0 4h8v2H6v-2z"/></svg> Hover to Read (show button)</label><span class="switch"><input id="a11y-hoverread" type="checkbox" /><span class="knob"></span></span></div>
  <div class="row"><label><svg class="icon" viewBox="0 0 24 24"><path d="M4 4h16v4H4V4zm0 6h10v2H4v-2zm0 4h12v2H4v-2z"/></svg> Auto-read selected text</label><span class="switch"><input id="a11y-autoselect" type="checkbox" /><span class="knob"></span></span></div>

  <div class="hr"></div>

  <div class="row" style="align-items:flex-start;">
    <div>
      <div class="hint">Reader (select text → <span class="kbd">Play</span>)</div>
      <div style="display:flex; gap:6px; margin-top:6px;">
        <button class="btn" id="tts-play">Play</button>
        <button class="btn" id="tts-pause">Pause</button>
        <button class="btn" id="tts-stop">Stop</button>
      </div>
      <div class="tts-opts" style="margin-top:6px;">
        <label>Rate <input id="tts-rate" type="range" min="0.6" max="1.6" step="0.1" value="1.0" aria-label="Speech rate"></label>
        <label>Pitch <input id="tts-pitch" type="range" min="0.6" max="1.6" step="0.1" value="1.0" aria-label="Speech pitch"></label>
      </div>
    </div>
    <div class="hint" style="text-align:right;">Esc closes panel</div>
  </div>

  <div class="footer">
    <button class="btn" id="a11y-reset" aria-label="Reset all settings">Reset</button>
    <button class="btn" id="a11y-export" aria-label="Export settings">Export</button>
    <button class="btn" id="a11y-import" aria-label="Import settings">Import</button>
  </div>

  <!-- Powered by ShipWr3ck | Codelyfe (drop anywhere near the end of <body>) -->
<div id="sw-powered" role="contentinfo" aria-label="Powered by ShipWr3ck and Codelyfe">
  <div class="pill">
    <span class="spark" aria-hidden="true"></span>
    <span class="txt">Powered by</span>
    <a class="brand ship" href="https://shipwr3ck.com" target="_blank" rel="noopener">ShipWr3ck</a>
    <span class="sep">|</span>
    <a class="brand code" href="https://github.com/codelyfe/A11y-Widget-Place-Anywhere" target="_blank" rel="noopener">Codelyfe</a>
  </div>
</div>
<style>
  #sw-powered .pill{
    pointer-events:auto;display:flex;align-items:center;gap:.55rem;padding:.55rem .9rem;border-radius:999px;
    background:rgba(15,18,23,.6);backdrop-filter:saturate(140%) blur(8px);
    border:1px solid rgba(255,255,255,.12); box-shadow:0 8px 28px rgba(0,0,0,.28), inset 0 0 0 1px rgba(255,255,255,.05);
    font:600 12.5px/1.2 ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Arial,"Noto Sans","Helvetica Neue",sans-serif;
    color:#eaf1ff;
  }
  #sw-powered .txt{opacity:.9;letter-spacing:.25px}
  #sw-powered .sep{opacity:.35}
  #sw-powered a{position:relative;text-decoration:none}
  #sw-powered a:hover{text-decoration:underline}
  #sw-powered .brand{
    font-weight:800;letter-spacing:.3px
  }
  #sw-powered .brand.ship{
    background:linear-gradient(90deg,#22d3ee,#38bdf8,#60a5fa);
    -webkit-background-clip:text;background-clip:text;color:transparent;
    text-shadow:0 0 12px rgba(56,189,248,.25)
  }
  #sw-powered .brand.code{
    background:linear-gradient(90deg,#c084fc,#a78bfa,#f472b6);
    -webkit-background-clip:text;background-clip:text;color:transparent;
    text-shadow:0 0 12px rgba(192,132,252,.25)
  }
  #sw-powered .spark{
    width:.6rem;height:.6rem;border-radius:999px;flex:0 0 auto;
    background:linear-gradient(135deg,#22d3ee,#8b5cf6,#ec4899);
    box-shadow:0 0 12px rgba(139,92,246,.6),0 0 24px rgba(236,72,153,.35);
    animation:sw-pulse 2.4s ease-in-out infinite
  }
  @keyframes sw-pulse{
    0%,100%{transform:scale(1);filter:saturate(1)}
    50%{transform:scale(1.2);filter:saturate(1.35)}
  }
  @media (prefers-color-scheme: light){
    #sw-powered .pill{background:rgba(255,255,255,.75);color:#0b1220;border-color:rgba(0,0,0,.08)}
    #sw-powered .txt{opacity:.8}
  }
</style>


  <div aria-live="polite" class="visually-hidden" id="a11y-live"></div>
</div>
`;

  // Shadow UI
  root.shadowRoot.innerHTML = panelHTML;
  document.body.appendChild(root);

  // Global CSS
  const style = document.createElement('style');
  style.id = 'a11y-global-css';
  style.textContent = globalCSS;
  document.head.appendChild(style);

  // Skip link + reading mask
  injectSkipLink();
  const mask = document.createElement('div');
  mask.id = 'a11y-reading-mask';
  mask.style.display = 'none';
  document.body.appendChild(mask);
  window.addEventListener('mousemove', (e) => {
    if (mask.style.display === 'none') return;
    const y = e.clientY;
    const h = Math.max(48, Math.round(window.innerHeight * 0.08));
    mask.style.setProperty('--band-top', `${y - h/2}px`);
    mask.style.setProperty('--band-height', `${h}px`);
  });

  // Floating Hover-Read button
  const hoverBtn = document.createElement('button');
  hoverBtn.id = 'a11y-hover-read-btn';
  hoverBtn.type = 'button';
  hoverBtn.innerHTML = `<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3a9 9 0 00-9 9 1.25 1.25 0 102.5 0 6.5 6.5 0 1113 0 1.25 1.25 0 102.5 0 9 9 0 00-9-9zm-2.5 9a2.5 2.5 0 015 0v5.5a2.5 2.5 0 01-5 0V12z"/></svg><span class="visually-hidden">Read hovered text</span>`;
  document.body.appendChild(hoverBtn);

  /* ===== Hover-to-Read state (declare BEFORE any calls that use it) ===== */
  let currentHover = null;
  let hoverMoveRAF = 0;
  let hoverVisible = false;
  let hoverHighlightEl = null;

  // Controls
  const $ = (sel) => root.shadowRoot.querySelector(sel);
  const panel = $('#a11y-panel');
  const backdrop = $('#a11y-backdrop');
  const btnOpen = $('#a11y-open');
  const btnClose = $('#a11y-close');
  const live = $('#a11y-live');

  const inputScale = $('#a11y-scale');
  const toggles = {
    dark: $('#a11y-dark'),
    hc: $('#a11y-hc'),
    spacing: $('#a11y-spacing'),
    dys: $('#a11y-dys'),
    ul: $('#a11y-ul'),
    focus: $('#a11y-focus'),
    hideimg: $('#a11y-hideimg'),
    mutevid: $('#a11y-mutevid'),
    gray: $('#a11y-gray'),
    anim: $('#a11y-anim'),
    mask: $('#a11y-mask'),
    hoverread: $('#a11y-hoverread'),
    autoselect: $('#a11y-autoselect'),
  };

  // Apply saved prefs
  applyPrefs(prefs);

  // Open/close
  const openPanel = () => {
    panel.setAttribute('open', '');
    backdrop.setAttribute('open', '');
    btnOpen.setAttribute('aria-expanded', 'true');
    (panel.querySelector('input,button,select,[href]')||panel).focus();
  };
  const closePanel = () => {
    panel.removeAttribute('open');
    backdrop.removeAttribute('open');
    btnOpen.setAttribute('aria-expanded', 'false');
    btnOpen.focus();
  };

  btnOpen.addEventListener('click', openPanel);
  btnOpen.addEventListener('keydown', (e) => { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); openPanel(); } });
  btnClose.addEventListener('click', closePanel);
  backdrop.addEventListener('click', closePanel);
  window.addEventListener('keydown', (e) => { if (panel.hasAttribute('open') && e.key === 'Escape') closePanel(); });
  panel.addEventListener('keydown', trapFocus);

  // Range
  inputScale.addEventListener('input', () => {
    const v = clamp(parseInt(inputScale.value, 10), 80, 220);
    html.style.setProperty('--a11y-font-scale', v + '%');
    setAttr('font-scale', v !== 100);
    inputScale.setAttribute('aria-valuenow', String(v));
    prefs.scale = v;
    savePrefs();
    say(`Text size ${v}%`);
  });

  // Toggle handlers
  Object.entries(toggles).forEach(([key, el]) => {
    el.addEventListener('change', () => {
      if (key === 'dark' && el.checked) { setAttr('hc', false); toggles.hc.checked = false; }
      if (key === 'hc' && el.checked) { setAttr('dark', false); toggles.dark.checked = false; }
      setToggle(key, el.checked);
      prefs[key] = el.checked;
      savePrefs();
      if (key === 'mask') mask.style.display = el.checked ? 'block' : 'none';
      if (key === 'mutevid') handleVideoMute(el.checked);
      if (key === 'anim') {
        if (el.checked) html.removeAttribute('data-a11y-pause-anim-off');
        else html.setAttribute('data-a11y-pause-anim-off', '');
      }
      if (key === 'hoverread') toggleHoverRead(el.checked);
      say(labelForKey(key) + (el.checked ? ' on' : ' off'));
    });
  });

  /* ===================== SMARTER TTS ===================== */
  const tts = {
    synth: 'speechSynthesis' in window ? window.speechSynthesis : null,
    utter: null,
    queue: [],
    playing: false,
    voice: null,
    lastHash: '',
    lastAt: 0
  };
  const rateEl = $('#tts-rate');
  const pitchEl = $('#tts-pitch');

  if (tts.synth) {
    const primeVoices = () => {
      const voices = tts.synth.getVoices();
      const pageLang = (document.documentElement.getAttribute('lang') || navigator.language || 'en').toLowerCase();
      const langBase = pageLang.split('-')[0];
      tts.voice = voices.find(v => v.lang && v.lang.toLowerCase() === pageLang)
        || voices.find(v => v.lang && v.lang.toLowerCase().startsWith(langBase))
        || voices.find(v => /google|enhanced/i.test(v.name))
        || voices[0] || null;
    };
    primeVoices();
    window.speechSynthesis.onvoiceschanged = primeVoices;
  }

  $('#tts-play').addEventListener('click', () => {
    if (!tts.synth) return say('Speech not supported');
    if (tts.synth.speaking && tts.synth.paused) { tts.synth.resume(); return; }
    if (tts.synth.speaking) return;

    const text = getBestText();
    if (!text.trim()) return say('Nothing to read');
    startSpeak(text);
  });

  $('#tts-pause').addEventListener('click', () => {
    if (!tts.synth) return;
    if (tts.synth.speaking && !tts.synth.paused) { tts.synth.pause(); say('Paused'); }
  });

  $('#tts-stop').addEventListener('click', stopTTS);

  function startSpeak(text) {
    if (!tts.synth) return;
    stopTTS();
    const t = text.trim();
    const h = hash(t);
    const now = Date.now();
    if (h === tts.lastHash && now - tts.lastAt < 800) return;
    tts.lastHash = h; tts.lastAt = now;
    tts.queue = chunkText(t, 1400);
    tts.playing = true;
    speakNext();
  }

  function speakNext() {
    if (!tts.playing || !tts.queue.length) { say('Reading finished'); tts.playing = false; return; }
    const part = tts.queue.shift();
    tts.utter = new SpeechSynthesisUtterance(part);
    if (tts.voice) tts.utter.voice = tts.voice;
    tts.utter.rate = clamp(parseFloat(rateEl.value || '1'), 0.6, 1.6);
    tts.utter.pitch = clamp(parseFloat(pitchEl.value || '1'), 0.6, 1.6);
    tts.utter.onend = () => { if (tts.playing) speakNext(); };
    tts.utter.onerror = () => { if (tts.playing) speakNext(); };
    tts.synth.speak(tts.utter);
  }
  function stopTTS() {
    if (!tts.synth) return;
    if (tts.synth.speaking || tts.synth.pending) { tts.playing = false; tts.queue = []; tts.synth.cancel(); }
  }
  function getBestText() {
    const sel = window.getSelection && String(window.getSelection().toString());
    if (sel && sel.trim()) return sel.trim();

    const ae = document.activeElement;
    if (ae && ae !== document.body) {
      let t = (ae.getAttribute && (ae.getAttribute('aria-label') || ae.getAttribute('title'))) || '';
      if (!t) t = (ae.innerText || ae.textContent || '').trim();
      if (!t && ae.tagName === 'IMG') t = ae.alt || '';
      if (t) return t;
    }

    const main = document.querySelector('[role="main"], main, #main, #content, #primary, [data-main]') || document.body;
    let text = (main.innerText || '').replace(/\s+\n/g, '\n').replace(/\n{3,}/g, '\n\n');
    return text.slice(0, 24000);
  }
  function chunkText(s, max) {
    const parts = [];
    const sentences = s.split(/(?<=[.!?。؟…])\s+/);
    let buf = '';
    for (const sent of sentences) {
      if ((buf + ' ' + sent).length <= max) buf = buf ? buf + ' ' + sent : sent;
      else { if (buf) parts.push(buf); buf = sent; }
    }
    if (buf) parts.push(buf);
    return parts.length ? parts : [s.slice(0, max)];
  }
  function hash(str) { let h=0,i=0,l=str.length; while(i<l){h=(h<<5)-h+str.charCodeAt(i++)|0;} return String(h); }
  /* ====================================================== */

  // ===== Selection Auto-Read =====
  let selectTimer = null;
  document.addEventListener('selectionchange', () => {
    if (!toggles.autoselect.checked) return;
    if (selectTimer) clearTimeout(selectTimer);
    selectTimer = setTimeout(() => {
      const text = String(window.getSelection ? window.getSelection().toString() : '').trim();
      if (!text || text.length < 2) return;
      if (isInShadow(root, document.getSelection())) return;
      startSpeak(text.slice(0, 24000));
    }, 200);
  });

  // ===== Hover-to-Read (with floating button) =====
  function toggleHoverRead(on) {
    if (on) {
      hoverBtn.setAttribute('visible', '');
      hoverVisible = true;
      document.addEventListener('mousemove', onHoverMove, { passive: true });
      document.addEventListener('mouseover', onHoverOver, true);
      document.addEventListener('mouseout', onHoverOut, true);
    } else {
      hoverBtn.removeAttribute('visible');
      hoverVisible = false;
      document.removeEventListener('mousemove', onHoverMove, { passive: true });
      document.removeEventListener('mouseover', onHoverOver, true);
      document.removeEventListener('mouseout', onHoverOut, true);
      currentHover = null;
      clearHighlight();
      hoverBtn.style.transform = 'translate(-9999px,-9999px)';
    }
  }

  hoverBtn.addEventListener('click', () => {
    if (!currentHover) return;
    const text = extractReadableText(currentHover);
    if (text) startSpeak(text);
  });

  function onHoverMove(e) {
    if (!hoverVisible) return;
    if (hoverMoveRAF) cancelAnimationFrame(hoverMoveRAF);
    const { clientX:x, clientY:y } = e;
    hoverMoveRAF = requestAnimationFrame(() => {
      const offX = 18, offY = 18;
      hoverBtn.style.left = Math.min(window.innerWidth - 52, Math.max(0, x + offX)) + 'px';
      hoverBtn.style.top  = Math.min(window.innerHeight - 52, Math.max(0, y + offY)) + 'px';
    });
  }

  function onHoverOver(e) {
    if (!hoverVisible) return;
    const path = e.composedPath ? e.composedPath() : [e.target];
    const el = findReadable(path);
    currentHover = el;
    highlight(el);
  }
  function onHoverOut() {
    if (!hoverVisible) return;
  }

  function findReadable(path) {
    if (path.some(n => n === root || (n && n.getRootNode && n.getRootNode() === root.shadowRoot))) return null;
    for (const node of path) {
      if (!node || node.nodeType !== 1) continue;
      const el = node;
      const tag = el.tagName;
      if (el.closest && el.closest('#a11y-hover-read-btn')) continue;
      if (!isVisible(el)) continue;
      if (['SCRIPT','STYLE','NOSCRIPT','SVG','CANVAS','IFRAME','VIDEO','AUDIO'].includes(tag)) continue;
      const text = extractReadableText(el);
      if (text) return el;
    }
    return null;
  }

  function extractReadableText(el) {
    if (!el) return '';
    if (el.matches('input,textarea,select,button,[role="button"],[role="link"]')) {
      const lbl = (el.getAttribute('aria-label') || el.getAttribute('title') || '').trim();
      if (lbl) return lbl;
    }
    if (el.tagName === 'IMG') {
      const t = (el.alt || el.title || '').trim();
      if (t) return t;
    }
    let text = (el.innerText || el.textContent || '').replace(/\s+\n/g, '\n').replace(/\n{3,}/g, '\n\n').trim();
    text = text.replace(/\s{2,}/g, ' ');
    if (!text) return '';
    const maxLen = 1200;
    return text.length > maxLen ? text.slice(0, maxLen) : text;
  }

  function isVisible(el) {
    const cs = getComputedStyle(el);
    if (cs.visibility === 'hidden' || cs.display === 'none' || Number(cs.opacity) === 0) return false;
    const rect = el.getBoundingClientRect();
    if (rect.width < 2 || rect.height < 2) return false;
    if (rect.bottom < 0 || rect.top > innerHeight || rect.right < 0 || rect.left > innerWidth) return false;
    return true;
  }

  function highlight(el) {
    clearHighlight();
    if (!el) return;
    hoverHighlightEl = el;
    try { el.setAttribute('data-a11y-read-target',''); } catch {}
  }
  function clearHighlight() {
    if (hoverHighlightEl) { try { hoverHighlightEl.removeAttribute('data-a11y-read-target'); } catch {} }
    hoverHighlightEl = null;
  }

  // Reset / Import / Export
  $('#a11y-reset').addEventListener('click', () => {
    Object.values(toggles).forEach(el => el.checked = false);
    Object.keys(prefs).forEach(k => delete prefs[k]);
    inputScale.value = 100; inputScale.dispatchEvent(new Event('input'));
    clearAttrs();
    mask.style.display = 'none';
    toggleHoverRead(false);
    savePrefs();
    say('Settings reset');
    stopTTS();
  });

  $('#a11y-export').addEventListener('click', () => {
    const blob = new Blob([JSON.stringify(prefs, null, 2)], { type: 'application/json' });
    const a = document.createElement('a');
    a.download = 'a11y-settings.json';
    a.href = URL.createObjectURL(blob);
    a.click();
    URL.revokeObjectURL(a.href);
    say('Settings exported');
  });

  $('#a11y-import').addEventListener('click', async () => {
    const inp = document.createElement('input');
    inp.type = 'file'; inp.accept = 'application/json';
    inp.onchange = () => {
      const file = inp.files && inp.files[0]; if (!file) return;
      const reader = new FileReader();
      reader.onload = () => {
        try {
          const obj = JSON.parse(String(reader.result || '{}'));
          applyPrefs(obj, true);
          say('Settings imported');
        } catch { say('Invalid settings file'); }
      };
      reader.readAsText(file);
    };
    inp.click();
  });

  // Helpers
  function trapFocus(e) {
    if (e.key !== 'Tab') return;
    const focusables = panel.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
    const list = Array.from(focusables).filter(el => !el.hasAttribute('disabled'));
    if (!list.length) return;
    const first = list[0], last = list[list.length - 1];
    if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
    else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
  }
  function say(msg) { live.textContent = ''; setTimeout(() => { live.textContent = msg; }, 10); }
  function clamp(v, min, max) { v = Number.isFinite(v) ? v : min; return Math.max(min, Math.min(max, v)); }
  function setAttr(name, on) { if (on) html.setAttribute('data-a11y-' + name, ''); else html.removeAttribute('data-a11y-' + name); }
  function clearAttrs() {
    ['font-scale','dark','hc','underline-links','text-spacing','dyslexia','hide-images','grayscale','focus-ring','pause-anim']
      .forEach(n => html.removeAttribute('data-a11y-' + n));
    html.style.removeProperty('--a11y-font-scale');
  }
  function setToggle(key, on) {
    switch (key) {
      case 'dark': setAttr('dark', on); break;
      case 'hc': setAttr('hc', on); break;
      case 'spacing': setAttr('text-spacing', on); break;
      case 'dys': setAttr('dyslexia', on); break;
      case 'ul': setAttr('underline-links', on); break;
      case 'focus': setAttr('focus-ring', on); break;
      case 'hideimg': setAttr('hide-images', on); break;
      case 'gray': setAttr('grayscale', on); break;
      case 'anim': setAttr('pause-anim', on); if (!on) html.setAttribute('data-a11y-pause-anim-off', ''); break;
      case 'mask': break;
      case 'mutevid': break;
      case 'hoverread': break;
      case 'autoselect': break;
    }
  }
  function labelForKey(k){ return ({
    dark:'Dark mode', hc:'High contrast', spacing:'Text spacing',
    dys:'Dyslexia-friendly', ul:'Underline links', focus:'Focus ring',
    hideimg:'Hide images', mutevid:'Mute videos', gray:'Grayscale',
    anim:'Pause animations', mask:'Reading mask',
    hoverread:'Hover to Read', autoselect:'Auto-read selection'
  })[k] || 'Option'; }

  function handleVideoMute(on) {
    const vids = Array.from(document.querySelectorAll('video'));
    vids.forEach(v => {
      v.muted = !!on;
      if (on) { try { v.pause(); } catch {} }
    });
  }

  function savePrefs() { try { localStorage.setItem(PERSIST_KEY, JSON.stringify(prefs)); } catch {} }
  function loadPrefs() { try { return JSON.parse(localStorage.getItem(PERSIST_KEY) || '{}') || {}; } catch { return {}; } }
  function applyPrefs(p, fromImport = false) {
    const v = clamp(parseInt(p.scale ?? 100, 10), 80, 220);
    html.style.setProperty('--a11y-font-scale', v + '%');
    inputScale.value = v; inputScale.setAttribute('aria-valuenow', String(v));
    setAttr('font-scale', v !== 100);

    Object.entries(toggles).forEach(([key, el]) => {
      const on = !!p[key];
      el.checked = on;
      setToggle(key, on);
      if (key === 'hoverread') toggleHoverRead(on);
    });

    mask.style.display = toggles.mask.checked ? 'block' : 'none';
    if (toggles.mutevid.checked) handleVideoMute(true);

    Object.assign(prefs, p);
    if (fromImport) savePrefs();
  }

  function injectSkipLink() {
    const candidates = ['[role="main"]','main','#main','#content','#primary','[data-main]'];
    let target = null;
    for (const sel of candidates) { const el = document.querySelector(sel); if (el) { target = el; break; } }
    if (!target) {
      const wrap = document.createElement('div'); wrap.id = 'a11y-main-wrap';
      while (document.body.firstChild && document.body.firstChild !== root) { wrap.appendChild(document.body.firstChild); }
      document.body.insertBefore(wrap, root);
      target = wrap;
    }
    if (!target.id) target.id = 'main';
    const skip = document.createElement('a'); skip.id = 'a11y-skip'; skip.href = `#${target.id}`; skip.textContent = 'Skip to content';
    document.body.appendChild(skip);
  }

  function isInShadow(host, selection) {
    if (!selection) return false;
    const an = selection.anchorNode, fn = selection.focusNode;
    const sr = host.shadowRoot;
    if (!an && !fn) return false;
    const ar = an && an.getRootNode ? an.getRootNode() : null;
    const fr = fn && fn.getRootNode ? fn.getRootNode() : null;
    return (ar === sr) || (fr === sr);
  }

  // Click outside (backdrop) to close
  document.addEventListener('mousedown', (e) => {
    if (!panel.hasAttribute('open')) return;
    const path = e.composedPath ? e.composedPath() : [];
    if (!path.includes(panel) && !path.includes(btnOpen) && !path.includes(root)) closePanel();
  });
})();

(() => {
  const root = document.getElementById('a11y-widget-root');
  if (!root || !root.shadowRoot) return;
  const $ = (sel) => root.shadowRoot.querySelector(sel);
  const panel = $('#a11y-panel');

  /* ===== iPhone toggle + mobile sizing fixes (no markup changes) ===== */
  const style = document.createElement('style');
  style.textContent = `
    .knob { pointer-events: none; } /* ensure taps hit the checkbox */
    .switch { touch-action: manipulation; -webkit-tap-highlight-color: transparent; }
    /* Bigger tap targets on small screens */
    @media (max-width: 480px){
      .panel{ width:calc(100vw - 24px) !important; max-height:88vh !important; }
      .row{ padding:12px 10px !important; gap:12px !important; }
      .switch{ inline-size:56px !important; block-size:32px !important; }
      .knob{ inset-block:2px !important; inset-inline-start:2px !important; width:28px !important; height:28px !important; }
      .switch input:checked + .knob{ transform: translateX(24px) !important; }
      .range{ width:100% !important; max-width:220px !important; }
      .btn{ padding:10px 12px !important; }
      .fab{ width:56px !important; height:56px !important; }
      .icon{ width:26px !important; height:26px !important; }
    }
  `;
  root.shadowRoot.appendChild(style);

  /* Label/row click delegates to the nearest checkbox (fixes iOS tap) */
  panel.addEventListener('click', (e) => {
    const inSwitch = e.target.closest('.switch');
    if (inSwitch) return; // native checkbox handles it

    const row = e.target.closest('.row');
    if (!row || row.id === 'row-scale') return; // don't hijack slider row

    const cb = row.querySelector('.switch input[type="checkbox"]');
    if (!cb) return;

    cb.checked = !cb.checked;
    cb.dispatchEvent(new Event('change', { bubbles: true }));
  }, { passive: true });

  /* Extra safety: make the whole switch container toggle on iOS */
  panel.addEventListener('click', (e) => {
    const sw = e.target.closest('.switch');
    if (!sw) return;
    const cb = sw.querySelector('input[type="checkbox"]');
    if (!cb) return;
    // If tap was on the container (not the input), mirror a click
    if (e.target !== cb) {
      cb.checked = !cb.checked;
      cb.dispatchEvent(new Event('change', { bubbles: true }));
    }
  }, { passive: true });
})();
