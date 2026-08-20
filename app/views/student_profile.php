<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$student = $student ?? [];

function profile_value($student, $key)
{
    return htmlspecialchars($student[$key] ?? '', ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --forest: #2f6b3f;
            --forest-deep: #1f4e2c;
            --moss: #4f8a5b;
            --sage: #a9c9a4;
            --sage-soft: #e4efdf;
            --parchment: #f8f5ec;
            --bark: #7a5738;
            --ink: #24331f;
            --muted: #5c6d54;
        }
        body {
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            color: var(--ink);
            background: linear-gradient(180deg, #1f4e2c 0%, #3d7a4c 22%, #eef3e8 60%, #f8f5ec 100%);
            background-attachment: fixed;
        }
        .shell {
            width: min(1040px, calc(100% - 32px));
            margin: 0 auto;
            padding: 32px 0 48px;
        }
        .nav {
            display: flex; align-items: center; justify-content: space-between; gap: 16px;
            padding: 14px 20px;
            margin-bottom: 28px;
            border: 2px solid var(--sage);
            border-radius: 12px;
            background: var(--parchment);
            box-shadow: 0 10px 24px rgba(31, 78, 44, 0.22);
        }
        .brand { font-size: 18px; font-weight: 900; color: var(--forest-deep); }
        .brand::before { content: "🌿 "; }
        .links { display: flex; gap: 10px; flex-wrap: wrap; }
        .links a {
            color: var(--forest-deep);
            text-decoration: none;
            font-weight: 800;
            font-size: 14px;
            padding: 9px 14px;
            border: 2px solid var(--sage);
            border-radius: 10px;
            background: var(--sage-soft);
        }
        .links a.active, .links a:hover { color: #fff; background: var(--forest); border-color: var(--forest); }
        .links a.danger { color: #7a2a2a; background: #f6e6e2; border-color: #d9b3a8; }
        .links a.danger:hover { color: #fff; background: #b1493a; border-color: #b1493a; }

        .card {
            background: var(--parchment);
            border: 2px solid var(--sage);
            border-radius: 12px;
            box-shadow: 0 16px 34px rgba(31, 78, 44, 0.16);
        }

        .profile {
            display: flex; flex-direction: column; gap: 22px;
        }
        .identity {
            padding: 34px;
            text-align: center;
            border-top: 6px solid var(--forest);
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .avatar {
            width: 92px; height: 92px; display: grid; place-items: center;
            color: #fff;
            background: var(--forest);
            border-radius: 10px;
            font-size: 32px;
            font-weight: 900;
            margin: 0 auto 18px;
            box-shadow: 0 10px 22px rgba(31, 78, 44, 0.3);
        }
        h1 { color: var(--forest-deep); font-size: 32px; line-height: 1.08; }
        .muted { margin-top: 12px; max-width: 480px; color: var(--muted); line-height: 1.6; }

        .details { padding: 30px; border-top: 6px solid var(--bark); }
        .details h2 { font-size: 22px; margin-bottom: 18px; color: var(--forest-deep); }
        .details h2::before { content: "🍃 "; }

        table.info-table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 8px;
        }
        table.info-table th {
            text-align: left;
            padding: 12px 16px;
            background: var(--forest);
            color: #fff;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }
        table.info-table th:first-child { width: 34%; border-top-left-radius: 8px; }
        table.info-table th:last-child { border-top-right-radius: 8px; }
        table.info-table td {
            padding: 12px 16px;
            border-bottom: 1px solid var(--sage);
            color: var(--ink);
            font-weight: 700;
            overflow-wrap: anywhere;
            vertical-align: top;
        }
        table.info-table td.label {
            font-weight: 900;
            color: var(--forest-deep);
            background: var(--sage-soft);
        }
        table.info-table tr:nth-child(even) td:not(.label) { background: #fbfaf4; }
        table.info-table tr:last-child td { border-bottom: none; }

        .tags { display: flex; flex-wrap: wrap; gap: 8px; }
        .tag {
            padding: 6px 12px;
            border-radius: 6px;
            color: var(--forest-deep);
            background: var(--sage-soft);
            border: 1px solid var(--sage);
            font-weight: 800;
            font-size: 13px;
        }
        .tag::before { content: "🌱 "; }

        @media (max-width: 820px) {
            .profile { grid-template-columns: 1fr; }
            .nav { align-items: flex-start; flex-direction: column; }
            table.info-table th:nth-child(1), table.info-table td.label { width: 40%; }
        }
    </style>
</head>
<body>
    <main class="shell">
        <nav class="nav">
            <div class="brand">Student Portal</div>
            <div class="links">
                <a href="<?= site_url('student'); ?>">Home</a>
                <a class="active" href="<?= site_url('student/profile'); ?>">Student Profile</a>
                <a href="<?= site_url('student?permission=yes'); ?>">Allow Access</a>
                <a class="danger" href="<?= site_url('student?permission=no'); ?>">Hide Info</a>
            </div>
        </nav>

        <section class="profile">
            <aside class="card identity">
                <div class="avatar">JA</div>
                <h1><?= profile_value($student, 'name'); ?></h1>
                <p class="muted">
                    A <?= profile_value($student, 'year'); ?> <?= profile_value($student, 'course'); ?>
                    student from section <?= profile_value($student, 'section'); ?>.
                </p>
            </aside>

            <section class="card details">
                <h2>Student Profile</h2>
                <table class="info-table">
                    <thead>
                        <tr><th>Field</th><th>Detail</th></tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="label">Student ID</td>
                            <td><?= profile_value($student, 'student_id'); ?></td>
                        </tr>
                        <tr>
                            <td class="label">Email</td>
                            <td><?= profile_value($student, 'email'); ?></td>
                        </tr>
                        <tr>
                            <td class="label">Address</td>
                            <td><?= profile_value($student, 'address'); ?></td>
                        </tr>
                        <tr>
                            <td class="label">Contact Number</td>
                            <td><?= profile_value($student, 'contact'); ?></td>
                        </tr>
                        <tr>
                            <td class="label">Course</td>
                            <td><?= profile_value($student, 'course'); ?></td>
                        </tr>
                        <tr>
                            <td class="label">Profile Description</td>
                            <td><?= profile_value($student, 'description'); ?></td>
                        </tr>
                        <tr>
                            <td class="label">Skills</td>
                            <td>
                                <div class="tags">
                                    <?php foreach (($student['skills'] ?? []) as $skill): ?>
                                        <span class="tag"><?= htmlspecialchars($skill, ENT_QUOTES, 'UTF-8'); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="label">Hobbies</td>
                            <td>
                                <div class="tags">
                                    <?php foreach (($student['hobbies'] ?? []) as $hobby): ?>
                                        <span class="tag"><?= htmlspecialchars($hobby, ENT_QUOTES, 'UTF-8'); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </section>
    </main>
</body>
</html>