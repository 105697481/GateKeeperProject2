<?php
session_start();
require_once 'settings.php';

// Fetch all members
$sql = "SELECT * FROM about ORDER BY student_id, project_number ASC";
$result = $conn->query($sql);

// Group members by student_id
$members = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $members[$row['student_id']]['info'] = $row;
        $members[$row['student_id']]['projects'][] = $row;
    }
} else {
    echo "<p style='text-align:center;color:red;'>No member data found.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us | GateKeeper</title>
  <!--Favicon link for the browser tab-->
  <link rel= "icon" type = "image/png" href = "images/logo2.png">
  <!--External CSS-->
  <link rel="stylesheet" href="styles/about2.css">
  
  <!--Embedded CSS Example-->
  <style>
    body {
      font-family: Arial, sans-serif;
      line-height: 1.6;
      margin: 0;
      padding: 0;
      color: #333;
      background-image: url(images/bgimage3.jpg);
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
    }

    .logout-link {
            position: absolute;
            top: 20px;
            right: 20px;
            background: #DC2626;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
    }

    .logout-link:hover {
            background: #c0392b;
    }
  </style>
</head>

<body>
    <a href="logout.php" class="logout-link">Logout</a>

    <?php include 'header.inc'; ?>

<main>
  <section id="blue_section" style="background-color: rgba(0, 102, 204, 0.7); color:white;"> <!--Inline CSS example-->
    <h1>About Our Team</h1>
    <?php 
    // Load class and tutor info dynamically (from first record)
    if (!empty($members)) {
        $any = reset($members);
        $class = $any['info']['class_time'];
        $tutor = $any['info']['tutor_name'];
        echo "<p class='white_text'><strong>Class Time:</strong> $class | <strong>Tutor:</strong> $tutor</p>";
    }
    ?>
    <ul id="about_info">
      <?php foreach ($members as $m) { ?>
        <li class="white_text">
          Member: <?= htmlspecialchars($m['info']['full_name']) ?> [Student ID: <?= htmlspecialchars($m['info']['student_id']) ?>]
        </li>
      <?php } ?>
    </ul>
  </section>

  <section id="light_blue_section">
    <h2>Meet Our Team</h2>
    <div class="team-container">
      <?php foreach ($members as $m) { ?>
        <div class="member">
          <img src="<?= htmlspecialchars($m['info']['image_path']) ?>" alt="<?= htmlspecialchars($m['info']['short_name']) ?>">
          <p><b><?= htmlspecialchars($m['info']['short_name']) ?></b></p>
        </div>
      <?php } ?>
    </div>
  </section>

  <section id="contributions_section">
    <h2>Project Contributions</h2>
    <?php foreach ($members as $m) { ?>
      <h3 style="color:#003366;"><?= htmlspecialchars($m['info']['full_name']) ?> (<?= htmlspecialchars($m['info']['role']) ?>)</h3>
      <?php foreach ($m['projects'] as $p) { ?>
        <div class="contribution-card">
          <h3><?= htmlspecialchars($p['project_name']) ?></h3>
          <p><b>Title:</b> <?= htmlspecialchars($p['contribution_title']) ?></p>
          <p><b>Details:</b> <?= htmlspecialchars($p['contribution_details']) ?></p>
          <p><b>Technologies:</b> <?= htmlspecialchars($p['technologies_used']) ?></p>
          <p><b>Completion Date:</b> <?= htmlspecialchars($p['completion_date']) ?></p>
        </div>
      <?php } ?>
    <?php } ?>
  </section>

  <section id="interests_section">
    <h2>Members' Interests</h2>
    <table class="info-table">
      <thead>
        <tr>
          <th>Member</th>
          <th>Interests</th>
          <th>Hometown</th>
          <th>Favourite Sport</th>
          <th>First Language</th>
          <th>Skills</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($members as $m) { 
          $i = $m['info']; ?>
          <tr>
            <td><?= htmlspecialchars($i['full_name']) ?></td>
            <td><?= htmlspecialchars($i['interests']) ?></td>
            <td><?= htmlspecialchars($i['hometown']) ?></td>
            <td><?= htmlspecialchars($i['favourite_sport']) ?></td>
            <td><?= htmlspecialchars($i['first_language']) ?></td>
            <td><?= htmlspecialchars($i['skills']) ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </section>
</main>

<?php include("footer.inc"); ?>

</body>
</html>

<?php $conn->close(); ?>
