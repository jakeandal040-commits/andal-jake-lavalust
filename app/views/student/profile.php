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
            --card: #ffffff;
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
            justify-content: center;
            padding: 3rem 1.5rem;
        }
        .badge-banner {
            max-width: 720px;
            width: 100%;
        }
        .badge-banner .protected-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: #2f4d3a;
            color: #d9f2e2;
            font-family: 'Helvetica Neue', Arial, sans-serif;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            padding: 0.3rem 0.7rem;
            border-radius: 20px;
            margin-bottom: 1rem;
        }
        .card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 2.2rem 2.4rem;
            box-shadow: 0 10px 25px rgba(28, 39, 51, 0.06);
        }
        .card h1 {
            margin: 0 0 0.2rem;
            font-size: 2rem;
            color: var(--accent-dark);
        }
        .card .subtitle {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            color: #6b6252;
            margin-bottom: 1.6rem;
            font-size: 0.95rem;
        }
        dl {
            display: grid;
            grid-template-columns: 160px 1fr;
            row-gap: 0.85rem;
            column-gap: 1rem;
            margin: 0 0 1.6rem;
        }
        dt {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #8a8171;
            align-self: center;
        }
        dd {
            margin: 0;
            font-size: 1.05rem;
            border-bottom: 1px dashed var(--line);
            padding-bottom: 0.6rem;
        }
        .about {
            background: #faf7f0;
            border-left: 4px solid var(--accent);
            padding: 1rem 1.2rem;
            font-style: italic;
            color: #40372c;
            border-radius: 4px;
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
    <div class="badge-banner">
        <span class="protected-tag">&#128274; Access granted by StudentMiddleware</span>
        <div class="card">
            <h1>Student Information</h1>
            <p class="subtitle">Loaded by StudentController::profile() &middot; view: student/profile.php</p>

            <dl>
                <dt>Student ID</dt>
                <dd><?= htmlspecialchars($student['student_id']) ?></dd>

                <dt>Name</dt>
                <dd><?= htmlspecialchars($student['name']) ?></dd>

                <dt>Course</dt>
                <dd><?= htmlspecialchars($student['course']) ?></dd>

                <dt>Year Level</dt>
                <dd><?= htmlspecialchars($student['year']) ?></dd>

                <dt>Section</dt>
                <dd><?= htmlspecialchars($student['section']) ?></dd>

                <dt>Email</dt>
                <dd><?= htmlspecialchars($student['email']) ?></dd>

                <dt>Address</dt>
                <dd><?= htmlspecialchars($student['address']) ?></dd>

                <dt>Contact No.</dt>
                <dd><?= htmlspecialchars($student['contact']) ?></dd>

                <dt>Hobbies</dt>
                <dd><?= htmlspecialchars($student['hobbies']) ?></dd>
            </dl>

            <p class="about"><?= htmlspecialchars($student['about']) ?></p>
        </div>
    </div>
</main>

<footer>
    Route: GET /student/profile &nbsp;|&nbsp; Middleware: StudentMiddleware &nbsp;|&nbsp; Controller: StudentController@profile
    <br>
    <a href="<?= site_url('student/logout') ?>" style="color:var(--accent);">Revoke access (demo unauthorized redirect)</a>
</footer>

</body>
</html>
