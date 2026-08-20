<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$student = $student ?? [];
$notice = $notice ?? '';
$access_granted = $access_granted ?? false;

function student_value($student, $key)
{
    return htmlspecialchars($student[$key] ?? '', ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Andal</title>
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
            width: min(940px, calc(100% - 32px));
            margin: 0 auto;
            padding: 32px 0 48px;
        }
        .nav {
            display: flex; align-items: center; justify-content: space-between; gap: 16px;
            padding: 14px 20px;
            margin-bottom: 32px;
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

        .intro {
            padding: 44px;
            text-align: center;
            border-top: 6px solid var(--forest);
        }
        .avatar {
            width: 86px; height: 86px;
            margin: 0 auto 18px;
            display: grid; place-items: center;
            border-radius: 10px;
            color: #fff;
            background: var(--forest);
            box-shadow: 0 10px 22px rgba(31, 78, 44, 0.3);
            font-size: 28px;
            font-weight: 900;
        }
        .eyebrow { color: var(--bark); font-weight: 900; font-size: 13px; text-transform: uppercase; letter-spacing: 0.1em; }
        .eyebrow::before { content: "🍃 "; }
        h1 { margin-top: 10px; font-size: clamp(32px, 6vw, 50px); line-height: 1.05; color: var(--forest-deep); }
        .identity-meta { margin-top: 8px; color: var(--forest); font-weight: 800; }

        .summary {
            margin: 24px auto 0;
            max-width: 620px;
            padding: 22px 26px;
            border-radius: 10px;
            background: var(--sage-soft);
            border: 1px solid var(--sage);
            color: var(--muted);
            font-size: 17px;
            line-height: 1.7;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 20px;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 900;
            font-size: 13px;
            border: 2px solid;
        }
        .status-pill.on { background: var(--sage-soft); color: var(--forest-deep); border-color: var(--sage); }
        .status-pill.off { background: #f6e6e2; color: #7a2a2a; border-color: #d9b3a8; }
        .status-pill .dot { width: 8px; height: 8px; border-radius: 50%; background: currentColor; }

        .actions { margin-top: 24px; display: flex; justify-content: center; gap: 12px; flex-wrap: wrap; }
        .profile-link, .allow-link {
            display: inline-block;
            padding: 12px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 900;
        }
        .profile-link { color: #fff; background: var(--forest); }
        .profile-link:hover { background: var(--forest-deep); }
        .allow-link { color: var(--forest-deep); background: var(--sage-soft); border: 2px solid var(--sage); }
        .allow-link:hover { background: var(--sage); }

        @media (max-width: 700px) {
            .intro { padding: 30px 20px; }
        }
    </style>
</head>
<body>
    <main class="shell">
        <nav class="nav">
            <div class="brand">Student Portal</div>
            <div class="links">
                <a class="active" href="<?= site_url('student'); ?>">Home</a>
                <a href="<?= site_url('student/profile'); ?>">Student Profile</a>
                <a href="<?= site_url('student?permission=yes'); ?>">Allow</a>
                <a class="danger" href="<?= site_url('student?permission=no'); ?>">Locked Info</a>
            </div>
        </nav>

        <section class="card intro">
            <div class="avatar">JA</div>
            <div class="eyebrow">Student Profile</div>
            <h1><?= $access_granted ? student_value($student, 'name') : 'Locked'; ?></h1>
            <?php if ($access_granted): ?>
                <p class="identity-meta"><?= student_value($student, 'course'); ?> · <?= student_value($student, 'year'); ?></p>
            <?php endif; ?>

            <p class="summary">
                <?= $access_granted
                    ? student_value($student, 'description')
                    : 'Student information is locked. Allow access to view the profile description.'; ?>
            </p>

            <div class="status-pill <?= $access_granted ? 'on' : 'off'; ?>">
                <span class="dot"></span>
                <?= $access_granted ? 'Access Allowed' : 'Access Locked'; ?>
            </div>

            <div class="actions">
                <?php if ($access_granted): ?>
                    <a class="profile-link" href="<?= site_url('student/profile'); ?>">View Full Profile</a>
                <?php else: ?>
                    <a class="allow-link" href="<?= site_url('student?permission=yes'); ?>">Allow Access</a>
                <?php endif; ?>
            </div>
        </section>
    </main>
</body>
</html>