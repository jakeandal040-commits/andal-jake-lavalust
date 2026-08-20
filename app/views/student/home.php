<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title ?? 'Student Portal') ?></title>
    <style>
        :root {
            --ink: #1c2733;
            --paper: #f4f1ea;
            --accent: #c1502e;
            --accent-dark: #8f3a20;
            --line: #d8d1c2;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Georgia', 'Times New Roman', serif;
            background: var(--paper);
            color: var(--ink);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        nav {
            background: var(--ink);
            padding: 1rem 2rem;
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }
        nav .brand {
            color: var(--paper);
            font-weight: bold;
            letter-spacing: 1px;
            margin-right: auto;
            font-size: 1.1rem;
        }
        nav a {
            color: var(--paper);
            text-decoration: none;
            padding: 0.4rem 0.9rem;
            border: 1px solid transparent;
            border-radius: 4px;
            font-family: 'Helvetica Neue', Arial, sans-serif;
            font-size: 0.95rem;
        }
        nav a:hover {
            border-color: var(--accent);
            color: var(--accent);
        }
        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 1.5rem;
        }
        .hero {
            max-width: 640px;
            text-align: center;
        }
        .hero .eyebrow {
            text-transform: uppercase;
            letter-spacing: 3px;
            color: var(--accent-dark);
            font-family: 'Helvetica Neue', Arial, sans-serif;
            font-size: 0.8rem;
            margin-bottom: 0.5rem;
        }
        .hero h1 {
            font-size: 2.6rem;
            margin: 0 0 1rem;
            border-bottom: 3px solid var(--accent);
            display: inline-block;
            padding-bottom: 0.4rem;
        }
        .hero p.lead {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #40372c;
        }
        .cta {
            margin-top: 2rem;
        }
        .cta a {
            display: inline-block;
            background: var(--accent);
            color: #fff;
            text-decoration: none;
            padding: 0.75rem 1.8rem;
            border-radius: 4px;
            font-family: 'Helvetica Neue', Arial, sans-serif;
            font-weight: bold;
            letter-spacing: 0.5px;
            transition: background 0.15s ease-in-out;
        }
        .cta a:hover {
            background: var(--accent-dark);
        }
        footer {
            text-align: center;
            padding: 1rem;
            font-family: 'Helvetica Neue', Arial, sans-serif;
            font-size: 0.8rem;
            color: #8a8171;
            border-top: 1px solid var(--line);
        }
    </style>
</head>
<body>

<nav>
    <span class="brand">STUDENT PORTAL</span>
    <a href="<?= site_url('student') ?>">Home</a>
    <a href="<?= site_url('student/profile') ?>">Student Profile</a>
</nav>

<main>
    <div class="hero">
        <div class="eyebrow">Web Systems and Technologies &middot; LavaLust Lab</div>
        <h1>Welcome, <?= htmlspecialchars($student['name']) ?></h1>
        <p class="lead">
            This is the student home page, served by <code>StudentController::index()</code>
            through the <code>/student</code> route. It requires no middleware, so it is
            reachable by anyone. The profile page, on the other hand, is guarded by
            <code>StudentMiddleware</code>.
        </p>
        <div class="cta">
            <a href="<?= site_url('student/profile') ?>">View Student Profile &rarr;</a>
        </div>
    </div>
</main>

<footer>
    Route: GET /student &nbsp;|&nbsp; Controller: StudentController@index &nbsp;|&nbsp; View: student/home.php
</footer>

</body>
</html>
