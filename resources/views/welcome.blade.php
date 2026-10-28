<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CloudDeploy | Laravel CI/CD Platform</title>
    <meta name="description" content="A Laravel application deployed on AWS EC2 using GitHub and Jenkins CI/CD automation.">
    <style>
        :root{--bg:#080d19;--panel:#101827;--panel-light:#151f32;--border:#263247;--text:#edf2ff;--muted:#99a8c0;--blue:#6c8cff;--cyan:#50d9e9;--green:#46d69a}
        *{box-sizing:border-box;margin:0;padding:0}
        html{scroll-behavior:smooth}
        body{background:var(--bg);color:var(--text);font-family:Inter,"Segoe UI",Arial,sans-serif;line-height:1.6}
        a{color:inherit;text-decoration:none}
        .container{width:min(1120px,90%);margin:auto}
        .navbar{border-bottom:1px solid var(--border);background:rgba(8,13,25,.94)}
        .nav-content{min-height:76px;display:flex;align-items:center;justify-content:space-between;gap:24px}
        .brand{display:flex;align-items:center;gap:11px;font-size:20px;font-weight:800;letter-spacing:-.5px}
        .brand-icon{width:38px;height:38px;display:grid;place-items:center;border-radius:12px;color:white;background:linear-gradient(135deg,#6288ff,#9c78ff)}
        .nav-links{display:flex;align-items:center;gap:26px;color:var(--muted);font-size:14px}
        .nav-links a:hover{color:white}
        .button{display:inline-flex;align-items:center;justify-content:center;padding:11px 17px;border:1px solid var(--border);border-radius:10px;background:var(--panel-light);color:white;font-size:14px;font-weight:700;transition:transform .2s,border-color .2s}
        .button:hover{transform:translateY(-2px);border-color:var(--blue)}
        .button-primary{background:var(--blue);border-color:var(--blue);color:#080d19}
        .hero{padding:92px 0 66px;background:radial-gradient(ellipse at 75% 15%,#19274d 0,transparent 40%),radial-gradient(ellipse at 10% 55%,#13253a 0,transparent 38%)}
        .eyebrow{display:inline-flex;align-items:center;gap:9px;padding:7px 12px;border:1px solid #285b4d;border-radius:999px;background:#10271f;color:var(--green);font-size:12px;font-weight:800;letter-spacing:1px;text-transform:uppercase}
        .status-dot{width:8px;height:8px;display:inline-block;border-radius:50%;background:var(--green);box-shadow:0 0 12px #46d69a88}
        h1{max-width:850px;margin:24px 0 20px;font-size:clamp(38px,6vw,66px);line-height:1.08;letter-spacing:-2.5px}
        .gradient-text{background:linear-gradient(100deg,var(--blue),var(--cyan));background-clip:text;-webkit-background-clip:text;color:transparent}
        .hero-description{max-width:680px;color:var(--muted);font-size:17px;line-height:1.9}
        .hero-actions{display:flex;flex-wrap:wrap;gap:13px;margin-top:30px}
        .hero-meta{display:flex;flex-wrap:wrap;gap:22px;margin-top:30px;color:var(--muted);font-size:13px}
        .hero-meta span{display:inline-flex;align-items:center;gap:8px}
        section{padding:62px 0}
        .section-heading{margin-bottom:28px}
        .section-label{margin-bottom:8px;color:var(--cyan);font-size:12px;font-weight:800;letter-spacing:1.8px;text-transform:uppercase}
        h2{font-size:clamp(26px,4vw,36px);letter-spacing:-1px}
        .section-description{max-width:690px;margin-top:10px;color:var(--muted)}
        .grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:18px}
        .card{padding:23px;border:1px solid var(--border);border-radius:17px;background:linear-gradient(145deg,var(--panel),#0c1422)}
        .card-icon{width:46px;height:46px;display:grid;place-items:center;margin-bottom:18px;border:1px solid var(--border);border-radius:13px;background:var(--panel-light);font-size:22px}
        .card h3{margin-bottom:8px;font-size:17px}
        .card p{color:var(--muted);font-size:14px}
        .tag-list{display:flex;flex-wrap:wrap;gap:9px;margin-top:17px}
        .tag{padding:5px 9px;border:1px solid var(--border);border-radius:7px;color:#cbd7ee;background:#0b1321;font-size:12px}
        .workflow{display:grid;grid-template-columns:repeat(5,minmax(0,1fr));gap:12px;margin-top:30px}
        .workflow-step{padding:20px 14px;border:1px solid var(--border);border-radius:14px;background:var(--panel);text-align:center}
        .step-number{width:34px;height:34px;display:grid;place-items:center;margin:0 auto 12px;border-radius:10px;background:#1c2a49;color:var(--cyan);font-weight:800}
        .workflow-step h3{font-size:14px}
        .workflow-step p{margin-top:6px;color:var(--muted);font-size:12px}
        .architecture{padding:30px;border:1px solid var(--border);border-radius:18px;background:var(--panel)}
        .architecture-row{display:flex;flex-wrap:wrap;align-items:center;justify-content:center;gap:12px;margin:18px 0}
        .architecture-node{min-width:155px;padding:17px;border:1px solid #334466;border-radius:12px;background:#111e33;text-align:center}
        .architecture-node strong{display:block;margin-bottom:5px}
        .architecture-node span{color:var(--muted);font-size:12px}
        .arrow{color:var(--cyan);font-size:23px}
        .architecture-note{margin-top:22px;color:var(--muted);font-size:13px;text-align:center}
        .highlight-panel{display:grid;grid-template-columns:1.3fr 1fr;gap:30px;padding:32px;border:1px solid #34466a;border-radius:20px;background:radial-gradient(ellipse at 90% 10%,#233766,transparent 50%),var(--panel)}
        .highlight-panel p{margin-top:12px;color:var(--muted)}
        .check-list{display:grid;gap:13px;align-content:center}
        .check-item{display:flex;align-items:flex-start;gap:11px;color:#dce6f8;font-size:14px}
        .check{color:var(--green);font-weight:900}
        .footer{padding:28px 0;border-top:1px solid var(--border);color:var(--muted);font-size:13px}
        .footer-content{display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:12px}
        @media(max-width:850px){.grid{grid-template-columns:repeat(2,minmax(0,1fr))}.workflow{grid-template-columns:repeat(3,minmax(0,1fr))}.highlight-panel{grid-template-columns:1fr}.nav-links{gap:13px}}
        @media(max-width:580px){.nav-content{padding:15px 0;align-items:flex-start}.nav-links{display:none}.hero{padding-top:65px}h1{letter-spacing:-1.5px}.grid,.workflow{grid-template-columns:1fr}.architecture{padding:18px}.arrow{transform:rotate(90deg)}.architecture-row{flex-direction:column}.architecture-node{width:100%}.highlight-panel{padding:22px}}
    </style>
</head>
<body>
    <!-- Project maintained by Krunal Prajapati -->
    <header class="navbar">
        <div class="container nav-content">
            <a class="brand" href="#home" aria-label="CloudDeploy home"><span class="brand-icon">C</span><span>CloudDeploy<span class="gradient-text">.</span></span></a>
            <nav class="nav-links" aria-label="Main navigation">
                <a href="#overview">Overview</a><a href="#technology">Technology</a><a href="#pipeline">Pipeline</a><a href="#architecture">Architecture</a>
            </nav>
            <a class="button" href="#pipeline">Explore Pipeline ↗</a>
        </div>
    </header>
    <main>
        <section class="hero" id="home">
            <div class="container">
                <div class="eyebrow"><span class="status-dot"></span> Cloud deployment project</div>
                <h1>From code to cloud.<br><span class="gradient-text">Automated delivery.</span></h1>
                <p class="hero-description">A hands-on DevOps portfolio project demonstrating how a Laravel application can be version-controlled with GitHub, built and deployed through Jenkins, and hosted on AWS EC2 with Apache and PHP.</p>
                <div class="hero-actions"><a class="button button-primary" href="#architecture">Explore Architecture →</a><a class="button" href="#technology">View Tech Stack</a></div>
                <div class="hero-meta"><span><span class="status-dot"></span> Laravel application</span><span>☁ AWS EC2 hosting</span><span>⚙ CI/CD automation</span></div>
            </div>
        </section>
        <section id="overview">
            <div class="container">
                <div class="section-heading"><div class="section-label">Project overview</div><h2>A practical cloud deployment workflow</h2><p class="section-description">The goal is to connect source control, continuous integration, deployment automation, and cloud hosting in one repeatable workflow.</p></div>
                <div class="grid">
                    <article class="card"><div class="card-icon">⌘</div><h3>Version Control</h3><p>Store application source code in GitHub and track changes through Git commits and branches.</p><div class="tag-list"><span class="tag">Git</span><span class="tag">GitHub</span></div></article>
                    <article class="card"><div class="card-icon">⚙</div><h3>CI/CD Automation</h3><p>Use a Jenkins pipeline to automate the steps required to prepare and deploy application updates.</p><div class="tag-list"><span class="tag">Jenkins</span><span class="tag">Jenkinsfile</span></div></article>
                    <article class="card"><div class="card-icon">☁</div><h3>Cloud Hosting</h3><p>Host the Laravel application on an AWS EC2 instance running PHP and the Apache web server.</p><div class="tag-list"><span class="tag">AWS EC2</span><span class="tag">Apache</span></div></article>
                </div>
            </div>
        </section>
        <section id="technology">
            <div class="container">
                <div class="section-heading"><div class="section-label">Technology stack</div><h2>Tools behind the deployment</h2><p class="section-description">Each component has a specific role in the application development and deployment process.</p></div>
                <div class="grid">
                    <article class="card"><div class="card-icon">🔴</div><h3>Laravel</h3><p>PHP framework used to structure the application, routes, views, and backend functionality.</p></article>
                    <article class="card"><div class="card-icon">🐘</div><h3>PHP</h3><p>Server-side language used to run the Laravel application.</p></article>
                    <article class="card"><div class="card-icon">🌐</div><h3>Apache</h3><p>Web server configured to serve the application from the deployment server.</p></article>
                    <article class="card"><div class="card-icon">🐙</div><h3>GitHub</h3><p>Remote repository for source code, change history, and the Jenkins pipeline definition.</p></article>
                    <article class="card"><div class="card-icon">🔧</div><h3>Jenkins</h3><p>Automation server responsible for running the pipeline and deployment stages.</p></article>
                    <article class="card"><div class="card-icon">☁️</div><h3>AWS EC2</h3><p>Cloud virtual machines used to host the web application and, separately, Jenkins.</p></article>
                </div>
            </div>
        </section>
        <section id="pipeline">
            <div class="container">
                <div class="section-heading"><div class="section-label">Delivery workflow</div><h2>How the CI/CD pipeline works</h2><p class="section-description">This is the intended deployment flow. Individual stages will become operational as we configure Jenkins and the AWS servers.</p></div>
                <div class="workflow">
                    <article class="workflow-step"><div class="step-number">01</div><h3>Developer</h3><p>Update application code</p></article>
                    <article class="workflow-step"><div class="step-number">02</div><h3>GitHub</h3><p>Commit and push changes</p></article>
                    <article class="workflow-step"><div class="step-number">03</div><h3>Jenkins</h3><p>Run pipeline stages</p></article>
                    <article class="workflow-step"><div class="step-number">04</div><h3>Deployment</h3><p>Update the EC2 application</p></article>
                    <article class="workflow-step"><div class="step-number">05</div><h3>Web Browser</h3><p>Access the deployed website</p></article>
                </div>
            </div>
        </section>
        <section id="architecture">
            <div class="container">
                <div class="section-heading"><div class="section-label">Cloud architecture</div><h2>A clear separation of responsibilities</h2><p class="section-description">The planned architecture separates automation from the web application host.</p></div>
                <div class="architecture">
                    <div class="architecture-row">
                        <div class="architecture-node"><strong>GitHub</strong><span>Source repository</span></div><span class="arrow">→</span>
                        <div class="architecture-node"><strong>Jenkins EC2</strong><span>Pipeline automation</span></div><span class="arrow">→</span>
                        <div class="architecture-node"><strong>Web EC2</strong><span>Apache + PHP + Laravel</span></div>
                    </div>
                    <p class="architecture-note">Intended design — the AWS instances and automated deployment will be configured in later project steps.</p>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="highlight-panel">
                    <div><div class="section-label">Project objectives</div><h2>Build it. Deploy it. Document it.</h2><p>This project is designed to demonstrate practical experience with application hosting, Git-based workflows, CI/CD concepts, Linux server configuration, and cloud infrastructure.</p></div>
                    <div class="check-list">
                        <div class="check-item"><span class="check">✓</span><span>Laravel application running locally</span></div>
                        <div class="check-item"><span class="check">✓</span><span>Source code versioned in GitHub</span></div>
                        <div class="check-item"><span class="check">→</span><span>Configure Apache on AWS EC2</span></div>
                        <div class="check-item"><span class="check">→</span><span>Build the Jenkins deployment pipeline</span></div>
                        <div class="check-item"><span class="check">→</span><span>Validate automated deployments</span></div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="footer"><div class="container footer-content"><span>CloudDeploy · Laravel CI/CD Portfolio Project</span><span>Built to learn cloud deployment and automation.</span></div></footer>
</body>
</html>
