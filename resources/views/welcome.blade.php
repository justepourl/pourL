<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pour Lina</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background: #0f0d0a;
            color: #f0ece4;
            font-family: 'Cormorant Garamond', Georgia, serif;
            overflow-x: hidden;
        }
        ::selection { background: rgba(196, 169, 125, 0.3); }

        #stars-canvas {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: 0;
            pointer-events: none;
        }

        .floating-hearts {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }
        .floating-heart {
            position: absolute;
            bottom: -20px;
            font-size: 14px;
            color: rgba(196, 169, 125, 0.12);
            animation: floatUp linear infinite;
        }
        @keyframes floatUp {
            0% { transform: translateY(0) rotate(0deg) scale(0.5); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-110vh) rotate(720deg) scale(1); opacity: 0; }
        }

        .content {
            position: relative;
            z-index: 1;
            max-width: 720px;
            margin: 0 auto;
            padding: 0 24px 100px;
        }

        .hero {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .hero-sub {
            font-family: 'Playfair Display', serif;
            font-size: 14px;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: rgba(196, 169, 125, 0.5);
            margin-bottom: 24px;
            opacity: 0;
            animation: fadeDown 1.2s ease 0.3s forwards;
        }
        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(28px, 6vw, 52px);
            font-weight: 400;
            line-height: 1.3;
            color: #f0ece4;
            opacity: 0;
            animation: fadeUp 1.4s ease 0.6s forwards;
        }
        .hero-title em { font-style: italic; color: #c4a97d; }

        .counter-label-top {
            font-family: 'Playfair Display', serif;
            font-size: clamp(14px, 1.8vw, 18px);
            color: rgba(196, 169, 125, 0.5);
            letter-spacing: 1.5px;
            margin-top: 32px;
            opacity: 0;
            animation: fadeUp 1.4s ease 1s forwards;
        }
        .counter {
            font-family: 'Playfair Display', serif;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 12px;
            font-size: clamp(20px, 3vw, 32px);
            color: #d4c5a9;
            letter-spacing: 0.5px;
            opacity: 0;
            animation: fadeUp 1.4s ease 1.2s forwards;
        }
        .counter-label {
            font-size: 0.5em;
            color: rgba(196, 169, 125, 0.5);
            margin-right: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .counter-label:last-child { margin-right: 0; }

        .play-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 45px;
            padding: 14px 32px;
            background: transparent;
            border: 1.5px solid rgba(196, 169, 125, 0.25);
            border-radius: 50px;
            color: #d4c5a9;
            font-family: 'Playfair Display', serif;
            font-size: 15px;
            letter-spacing: 2px;
            cursor: pointer;
            opacity: 0;
            animation: fadeUp 1.4s ease 2s forwards;
            transition: all 0.4s ease;
        }
        .play-btn:hover {
            border-color: rgba(196, 169, 125, 0.6);
            background: rgba(196, 169, 125, 0.06);
            transform: scale(1.05);
        }
        .play-btn svg {
            transition: transform 0.3s ease;
        }
        .play-btn:hover svg {
            transform: scale(1.15);
        }
        .play-btn.hidden {
            opacity: 0;
            pointer-events: none;
            transform: scale(0.8);
            transition: all 0.5s ease;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .letter-section {
            padding: 30px 0 20px;
        }

        .letter-line {
            font-size: clamp(17px, 2.2vw, 23px);
            line-height: 1.85;
            margin-bottom: 1.6em;
            font-weight: 300;
            letter-spacing: 0.3px;
            color: rgba(240, 236, 228, 0.88);
            min-height: 1.4em;
        }
        .letter-line strong { font-weight: 500; color: #d4c5a9; }
        .letter-line em { color: #c4a97d; font-style: italic; }

        .letter-line.typing::after {
            content: '|';
            display: inline-block;
            animation: cursorBlink 0.8s step-end infinite;
            color: #c4a97d;
            font-weight: 100;
            margin-left: 2px;
        }
        @keyframes cursorBlink { 0%, 100% { opacity: 1; } 50% { opacity: 0; } }

        .heart-divider {
            text-align: center;
            margin: 40px 0;
            font-size: 20px;
            color: rgba(196, 169, 125, 0.25);
            animation: pulse 3s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 0.25; transform: scale(1); }
            50% { opacity: 0.6; transform: scale(1.15); }
        }

        .merci-wrapper { text-align: center; margin: 30px 0 10px; }
        .merci-intro {
            font-size: clamp(16px, 2vw, 21px);
            font-weight: 300;
            letter-spacing: 0.5px;
            color: rgba(240, 236, 228, 0.6);
            margin-bottom: 25px;
            min-height: 1.4em;
        }
        .merci-intro.typing::after {
            content: '|';
            display: inline-block;
            animation: cursorBlink 0.8s step-end infinite;
            color: #c4a97d;
            font-weight: 100;
            margin-left: 2px;
        }

        .merci-list {
            font-size: clamp(20px, 2.6vw, 28px);
            line-height: 2.2;
            font-style: italic;
            color: #d4c5a9;
        }
        .merci-list.typing::after {
            content: '|';
            display: inline-block;
            animation: cursorBlink 0.8s step-end infinite;
            color: #c4a97d;
            font-weight: 100;
            margin-left: 2px;
        }

        .signature {
            font-size: clamp(20px, 2.6vw, 28px);
            font-weight: 400;
            text-align: right;
            margin-top: 50px;
            min-height: 1.4em;
        }
        .signature span {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: 0.85em;
        }
        .signature.typing::after {
            content: '|';
            display: inline-block;
            animation: cursorBlink 0.8s step-end infinite;
            color: #c4a97d;
            font-weight: 100;
            margin-left: 2px;
        }

        .envelope-section {
            min-height: 70vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            opacity: 0;
        }
        .envelope-section.visible {
            opacity: 1;
            transition: opacity 1s ease;
        }
        .envelope {
            position: relative;
            width: 280px; height: 200px;
            cursor: pointer;
            margin-bottom: 30px;
            perspective: 800px;
        }
        .envelope:hover { transform: scale(1.03); }
        .envelope-inner {
            position: relative;
            width: 100%; height: 100%;
            transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            transform-style: preserve-3d;
        }
        .envelope.open .envelope-inner { transform: rotateX(10deg); }
        .envelope-body {
            position: absolute;
            bottom: 0; left: 0;
            width: 100%; height: 140px;
            background: linear-gradient(135deg, #1a1612 0%, #2a2218 100%);
            border: 2px solid rgba(196, 169, 125, 0.15);
            border-radius: 6px;
            z-index: 1;
        }
        .envelope-body::before {
            content: '';
            position: absolute;
            bottom: 0; left: 0;
            width: 100%; height: 30px;
            background: rgba(196, 169, 125, 0.05);
            border-radius: 0 0 6px 6px;
        }
        .envelope-flap {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 60px;
            background: linear-gradient(135deg, #1a1612 0%, #2a2218 100%);
            border: 2px solid rgba(196, 169, 125, 0.15);
            border-bottom: none;
            border-radius: 6px 6px 0 0;
            transform-origin: top;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 3;
        }
        .envelope.open .envelope-flap {
            transform: rotateX(180deg);
            z-index: 0;
        }
        .envelope-heart {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            z-index: 4;
            font-size: 42px;
            color: #c4a97d;
            text-shadow: 0 0 20px rgba(196, 169, 125, 0.3);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            animation: heartPulse 2s ease-in-out infinite;
        }
        @keyframes heartPulse {
            0%, 100% { transform: translate(-50%, -50%) scale(1); text-shadow: 0 0 20px rgba(196,169,125,0.3); }
            50% { transform: translate(-50%, -50%) scale(1.1); text-shadow: 0 0 40px rgba(196,169,125,0.5); }
        }
        .envelope.open .envelope-heart {
            animation: heartFly 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }
        @keyframes heartFly {
            0% { transform: translate(-50%, -50%) scale(1); opacity: 1; }
            50% { transform: translate(-50%, -180%) scale(1.5); opacity: 0.8; }
            100% { transform: translate(-50%, -250%) scale(0.5); opacity: 0; }
        }
        .envelope-letter {
            position: absolute;
            top: 10px; left: 15px;
            width: calc(100% - 30px);
            height: 0;
            background: linear-gradient(135deg, #f0ece4 0%, #e8e0d0 100%);
            border-radius: 4px;
            transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1) 0.15s;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        }
        .envelope.open .envelope-letter { height: 180px; top: -60px; }
        .envelope-letter-content {
            color: #1a1612;
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: 22px;
            text-align: center;
            padding: 20px;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s ease 0.6s;
            line-height: 1.8;
            letter-spacing: 0.5px;
        }
        .envelope.open .envelope-letter-content {
            opacity: 1;
            transform: translateY(0);
        }
        .envelope-hint {
            font-size: 14px;
            color: rgba(196, 169, 125, 0.3);
            letter-spacing: 2px;
            margin-top: 20px;
        }

        .hidden-message {
            max-width: 680px;
            margin: 0 auto;
            padding: 40px 0 80px;
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 1s ease, transform 1s ease;
        }
        .hidden-message.reveal {
            opacity: 1;
            transform: translateY(0);
        }
        .message-title {
            text-align: center;
            font-size: clamp(18px, 2.4vw, 26px);
            margin-bottom: 30px;
        }

        @media (max-width: 600px) {
            .content { padding: 0 20px 80px; }
            .letter-line { font-size: 17px; }
            .envelope { width: 200px; height: 150px; }
            .envelope-letter-content { font-size: 17px; }
            .envelope.open .envelope-letter { height: 130px; top: -40px; }
        }
    </style>
</head>
<body>

<canvas id="stars-canvas"></canvas>
<div class="floating-hearts" id="hearts"></div>

<div class="content">
    <div class="hero">
        <div class="hero-sub">Une lettre pour toi</div>
        <h1 class="hero-title">À ma très chère <em>femme</em></h1>
        <div class="counter-label-top">Ensemble depuis le 27 avril 2025</div>
        <div class="counter" id="counter">
            <span id="days">00</span><span class="counter-label">jours</span>
            <span id="hours">00</span><span class="counter-label">h</span>
            <span id="minutes">00</span><span class="counter-label">min</span>
            <span id="seconds">00</span><span class="counter-label">s</span>
        </div>
        <button class="play-btn" id="playBtn">
            <svg viewBox="0 0 24 24" width="28" height="28">
                <polygon points="8,5 19,12 8,19" fill="currentColor"/>
            </svg>
            <span>Lire la lettre</span>
        </button>
    </div>

    <div class="letter-section" id="letter-section">
        <p class="letter-line">Je tenais à t'écrire cette lettre pour que, le temps de quelques instants, tu puisses entrer dans mes pensées et découvrir ce que je ressens réellement pour toi. Bien plus qu'un simple <em>je t'aime</em>.</p>

        <p class="letter-line">La distance qu'il y a eu entre nous ces dernières semaines m'a ouvert les yeux. Elle m'a fait comprendre que <strong>chaque instant</strong> passé avec toi est un véritable trésor. Chaque seconde à tes côtés est précieuse.</p>

        <p class="letter-line"><strong>Lina</strong>.</p>

        <p class="letter-line">T'avoir dans ma vie est une chance immense, une chance dont tant de personnes auraient rêvé. Tu es ma plus belle rencontre, celle qui a changé ma vie. Tu m'as toujours soutenu, écouté et tu as toujours été présente à mes côtés. Avec toi, je ressens un apaisement <span class="gold">inexplicable</span> que je ne trouve nulle part ailleurs. <strong>Tu es mon refuge</strong>.</p>

        <p class="letter-line">Je t'ai vue dans tous tes états : heureuse, triste, en colère, morte de rire, les larmes aux yeux... Et malgré tout cela, tu restes la femme la plus forte, la plus sincère et la plus belle que j'aie jamais rencontrée. Tu es une femme exceptionnelle, loin des drames inutiles, reconnaissante pour les petites choses, toujours <strong>rayonnante de vie</strong>.</p>

        <div class="heart-divider">♡</div>

        <p class="letter-line">Physiquement, tu le sais déjà : tu es sublime. <span class="gold">Allahumma barik</span>. Tu me plais de la tête aux pieds. Tes yeux me captivent un peu plus chaque jour. Ton odeur reste gravée en moi à chaque fois que je te serre contre moi. La douceur de ta peau... <em>Tout chez toi me fait craquer</em>.</p>

        <p class="letter-line">Tu cherches toujours ce qu'il y a de mieux pour nous deux. Tu m'as apporté tellement de choses que je ne pourrai jamais assez t'en remercier. Aujourd'hui, je suis fou amoureux de toi, et j'espère t'aimer jusqu'à mon dernier souffle, <span class="gold">in shaa Allah</span>.</p>

        <div class="heart-divider">♡</div>

        <p class="letter-line">Je ne suis pas encore au meilleur stade de ma vie, c'est vrai. Mais je te fais une promesse : <strong>tu ne manqueras jamais de rien</strong>. Je t'ai promis qu'un jour nous nous marierions, et je tiendrai cette promesse. Je m'engage envers toi à cent pour cent. Pour la vie.</p>

        <p class="letter-line">À mes yeux, tu es la femme parfaite. Tu es douce, attentionnée, agréable à vivre, et j'espère de tout mon cœur qu'un jour tu deviendras la <strong>mère de nos enfants</strong>, <span class="gold">in shaa Allah</span>.</p>

        <p class="letter-line">J'ai tellement hâte de construire notre vie ensemble. J'ai hâte que l'on ait notre chez-nous, de nous réveiller chaque matin l'un à côté de l'autre, de voyager, de découvrir le monde main dans la main, de créer des souvenirs qui resteront gravés à jamais. J'ai hâte de traverser chaque étape de la vie avec toi, les plus belles comme les plus difficiles, de grandir à tes côtés et de devenir chaque jour une meilleure version de moi-même grâce à toi. Plus que tout, <strong>j'ai hâte de vieillir avec toi</strong> et de regarder, des années plus tard, tout le chemin que nous aurons parcouru ensemble, <span class="gold">in shaa Allah</span>.</p>

        <p class="letter-line">Tu connais ma phrase préférée : <em>&laquo; L'herbe n'est pas plus verte ailleurs &raquo;</em>. Je crois profondément que c'est ainsi que l'on construit quelque chose de solide. L'être humain est un éternel insatisfait, mais moi, je n'ai pas besoin d'aller chercher ailleurs ce que j'ai déjà trouvé auprès de toi. <strong>Tu me suffis. Tu me combles.</strong> Pourquoi irais-je regarder ailleurs alors que j'ai déjà la plus belle personne à mes yeux ? Je le regretterais toute ma vie.</p>

        <p class="letter-line">On nous dit souvent qu'il suffit de s'aimer pour être heureux. Moi, je pense que l'amour ne suffit pas à lui seul. <strong>L'amour se choisit, se protège et s'entretient</strong> chaque jour, à travers les petites attentions, le respect, la patience et les efforts que l'on fait l'un pour l'autre.</p>

        <div class="heart-divider">♡</div>

        <p class="letter-line">Tu ne l'as peut-être jamais remarqué, mais je ne te dis jamais simplement <em>&laquo; je t'aime &raquo;</em>. Parce que chaque fois que ces mots sortent de ma bouche, ils portent en réalité <strong>tout ce que tu viens de lire</strong>. Tout ce que je ressens. Tout ce que tu représentes dans ma vie. Tout ce que tu es pour moi.</p>

        <div class="merci-wrapper">
            <p class="merci-intro">Je n'aurai jamais assez de temps ni assez de mots pour te dire à quel point tu comptes à mes yeux. Alors je veux simplement te dire :</p>
            <div class="merci-list">Merci d'être toi.<br>Merci d'être présente.<br>Merci pour tout ce que tu fais pour nous.<br>Merci de rendre ma vie plus belle.</div>
        </div>

        <p class="letter-line signature">Je t'aime,<br><span>Ton chéri.</span></p>
    </div>

    <div class="envelope-section" id="envelope-section">
        <div class="envelope" id="envelope">
            <div class="envelope-inner">
                <div class="envelope-body"></div>
                <div class="envelope-flap"></div>
                <div class="envelope-heart">♡</div>
                <div class="envelope-letter">
                    <div class="envelope-letter-content">
                        Je peux voir<br>
                        le Brésil<br>
                        maintenant ?
                    </div>
                </div>
            </div>
        </div>
        <p class="envelope-hint" id="envelope-hint">Clique sur l'enveloppe</p>
    </div>

    <div class="hidden-message" id="hiddenMessage">
        <div class="heart-divider">♡</div>
        <p class="letter-line message-title"><em>Un dernier mot...</em></p>
        <p class="letter-line">Je voulais simplement te faire cette surprise et te partager cette lettre, parce que comme je te l'ai dit, <strong>l'amour s'entretient</strong>. Il ne suffit pas de ressentir les choses, il faut aussi les dire, les montrer et les rappeler.</p>
        <p class="letter-line">On ne sait jamais de quoi demain sera fait, alors je ne veux jamais laisser passer une occasion de te dire à quel point tu es importante pour moi. Je ne veux jamais que tu doutes de l'amour que j'ai pour toi.</p>
        <p class="letter-line">J'espère que cette lettre t'aura fait sourire et qu'à chaque fois que tu la reliras, tu ressentiras tout l'amour que j'ai essayé d'y mettre.</p>
        <p class="letter-line">Prends-en soin, comme je prendrai toujours soin de toi, <span class="gold">in shaa Allah</span>.</p>
        <p class="letter-line signature" style="margin-top:20px;">Je t'aime.</p>
    </div>
</div>

<script>
    const canvas = document.getElementById('stars-canvas');
    const ctx = canvas.getContext('2d');
    let stars = [], W, H;

    function resize() { W = canvas.width = window.innerWidth; H = canvas.height = window.innerHeight; }
    resize();
    window.addEventListener('resize', resize);

    for (let i = 0; i < 200; i++) {
        stars.push({
            x: Math.random() * W, y: Math.random() * H,
            r: Math.random() * 1.5 + 0.3, alpha: Math.random(),
            speed: Math.random() * 0.005 + 0.002,
            direction: Math.random() > 0.5 ? 1 : -1,
        });
    }

    function drawStars() {
        ctx.clearRect(0, 0, W, H);
        for (const s of stars) {
            s.alpha += s.speed * s.direction;
            if (s.alpha > 1 || s.alpha < 0.1) s.direction *= -1;
            ctx.beginPath();
            ctx.arc(s.x, s.y, s.r, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(240, 236, 228, ${s.alpha * 0.5})`;
            ctx.fill();
        }
        requestAnimationFrame(drawStars);
    }
    drawStars();

    const startDate = new Date(2025, 3, 27);
    function updateCounter() {
        const now = new Date();
        const diff = now - startDate;
        document.getElementById('days').textContent = String(Math.floor(diff / 86400000)).padStart(2, '0');
        document.getElementById('hours').textContent = String(Math.floor((diff % 86400000) / 3600000)).padStart(2, '0');
        document.getElementById('minutes').textContent = String(Math.floor((diff % 3600000) / 60000)).padStart(2, '0');
        document.getElementById('seconds').textContent = String(Math.floor((diff % 60000) / 1000)).padStart(2, '0');
    }
    updateCounter();
    setInterval(updateCounter, 1000);

    const queue = [];
    const typeElements = document.querySelectorAll('.letter-line, .merci-intro, .merci-list, .signature');
    typeElements.forEach(el => {
        queue.push({ el, html: el.innerHTML });
        el.innerHTML = '';
    });

    function typeWriter(el, html, speed, callback) {
        let i = 0;
        document.querySelectorAll('.typing').forEach(e => e.classList.remove('typing'));
        el.classList.add('typing');
        function step() {
            if (i < html.length) {
                if (html[i] === '<') {
                    const tagEnd = html.indexOf('>', i);
                    el.innerHTML += html.substring(i, tagEnd + 1);
                    i = tagEnd + 1;
                    step();
                } else {
                    el.innerHTML += html[i];
                    i++;
                    setTimeout(step, speed);
                }
                } else if (callback) {
                el.classList.remove('typing');
                callback();
            }
        }
        el.innerHTML = '';
        step();
    }

    document.getElementById('playBtn').addEventListener('click', function() {
        this.classList.add('hidden');
        let totalDelay = 0;
        queue.forEach((item, index) => {
            const duration = item.html.length * 40;
            const startTime = totalDelay;
            const isLast = index === queue.length - 1;
            setTimeout(() => {
                item.el.scrollIntoView({ behavior: 'smooth', block: 'center' });
                setTimeout(() => {
                    typeWriter(item.el, item.html, 40, isLast ? showEnvelope : null);
                }, 300);
            }, startTime);
            totalDelay += duration + 2000;
        });

        function showEnvelope() {
            document.getElementById('envelope-section').classList.add('visible');
            setTimeout(() => {
                document.getElementById('envelope-section').scrollIntoView({ behavior: 'smooth', block: 'center' });
            }, 400);
        }
    });

    const envelope = document.getElementById('envelope');
    const hint = document.getElementById('envelope-hint');
    let opened = false;
    envelope.addEventListener('click', () => {
        opened = !opened;
        envelope.classList.toggle('open');
        hint.textContent = opened ? 'Je t\'aime' : 'Clique sur l\'enveloppe';
        if (opened) {
            setTimeout(() => {
                document.getElementById('hiddenMessage').classList.add('reveal');
                setTimeout(() => {
                    document.getElementById('hiddenMessage').scrollIntoView({ behavior: 'smooth', block: 'center' });
                }, 800);
            }, 600);
        }
    });

    const heartsContainer = document.getElementById('hearts');
    const heartSymbols = ['♡', '♥', '♡'];
    function createHeart() {
        const el = document.createElement('div');
        el.className = 'floating-heart';
        el.textContent = heartSymbols[Math.floor(Math.random() * heartSymbols.length)];
        el.style.left = Math.random() * 100 + '%';
        el.style.fontSize = (Math.random() * 18 + 10) + 'px';
        el.style.animationDuration = (Math.random() * 12 + 10) + 's';
        heartsContainer.appendChild(el);
        setTimeout(() => el.remove(), 22000);
    }
    setInterval(createHeart, 2500);
    for (let i = 0; i < 5; i++) setTimeout(createHeart, i * 500);
</script>

</body>
</html>