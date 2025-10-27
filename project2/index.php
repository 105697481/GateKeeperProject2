<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GateKeeper Inc</title>
  <!--Favicon link for the browser tab-->
  <link rel= "icon" type = "image/png" href = "images/logo2.png">
  <link rel="stylesheet" href="styles/index2.css"> 
</head>
<body>
  <a href="logout.php" class="logout-link">Logout</a>
  <!-- EMBEDDED CSS EXAMPLE - Required by rubric -->
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
    
    /* Embedded CSS for print media */
    @media print {
        body {
            background-image: none !important;
            background-color: white !important;
        }
        .nav-container, footer {
            display: none !important;
        }
    }
    </style>

  <a href="#main-content" class="skip-link">Skip to main content</a>

<?php include 'header.inc'; ?>

  <main id="main-content" role="main">
  <!---Welcome message here--->
  <div class="side-by-side"><?php
    if (isset($_SESSION['username'])) {
        echo "<h2 style='text-align:center; color:#000000;'>Welcome, " . htmlspecialchars($_SESSION['username']) . " 👋</h2>";
    }
    ?>

  <div class="hometext-content">
    <h2 style="color: #2c3e50; text-shadow: 2px 2px 4px rgba(0,0,0,0.1);">Home</h2>
    <p>
      Welcome to GateKeeper – Your Pathway to Cybersecurity Careers
      At GateKeeper, we aim to help individuals build a career in cybersecurity by providing comprehensive guidance, job placement services, and the latest industry insights. Whether you're just starting out or are an experienced professional, GateKeeper offers the tools and resources you need to succeed in the growing field of cybersecurity.
    </p>
  </div>
  <div class="homeimage-content">
    <img src="images/Home_pic.jpg" alt="Abstract cybersecurity illustration with padlock, shield, fingerprint and network nodes representing data protection.">
  </div>
  <div class="abouttext-content">
    <h2>About</h2>
    <p>
      Our Vision and Story
      GateKeeper was founded by four visionary CEOs who recognized the urgent need for cybersecurity professionals in the digital age. Their goal was to create a company that not only provides job placement services but also raises awareness about the importance of cybersecurity in every facet of modern life. The founders are passionate about empowering individuals to pursue careers in cybersecurity and equipping them with the knowledge and skills necessary to protect our digital world.
    </p>
  </div>
  <div class="aboutimage-content">
    <img src="images/About_pic.png" alt="A robot hand touching the techno print -> shows users that the visions of the company is to reach to the modern future with a plenty of technology.">
  </div>
  <div class="servicetext-content">
    <h2>Services</h2>
    <p>Cybersecurity Job Placement & Career Support
    GateKeeper specializes in connecting cybersecurity professionals with top employers in the industry. Our services include:
    </p>
    <ul role="list">
      <li><strong>Job Search Assistance:</strong> We help you find the right job in cybersecurity by matching your skills with the needs of leading companies.</li>
      <li><strong>Career Counseling:</strong> Our expert advisors provide personalized guidance to help you navigate your career path and make the best decisions.</li>
      <li><strong>Resume Building & Interview Preparation:</strong> Get expert tips and resources to perfect your resume and ace your cybersecurity interviews.</li>
      <li><strong>Industry Insights:</strong> Stay up-to-date with the latest trends, certifications, and technologies in cybersecurity.</li>
    </ul>
  </div>
  <div class="serviceimage-content">
    <img src="images/Services_pic.jpg" alt="Hand holding a glowing sphere with a networked shield icon, symbolizing cybersecurity protection.">
  </div>
</div>
  </main>

<?php include 'footer.inc'; ?>