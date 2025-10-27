<?php
require_once 'settings.php'; #This one only run one time, if this command is already included in somewhere it doesn't run this. 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Introduction to basic HTML elements">
    <meta name="keywords" content="HTML, Doctype, Head, Body, Meta, Paragraph, Headings, Strong, Emphasis">
    <meta name="author" content="Thishula Nimsara">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs at CyberSecure Solutions</title>
    <!--Favicon link for the browser tab-->
    <link rel= "icon" type = "image/png" href = "images/logo2.png">

    <!--Link to the external stylesheet as required by the project brief-->
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/responsive.css">

    <!-- Embedded CSS Examples-->
     <style>
        /* Styles for the sidebar section (aside container): sets width, light background with transparency, rounded border, subtle shadow, centered layout, and padding for readability */
        .sidebar {
            width: 60%; 
            background-color: rgba(245, 245, 247, 0.8); 
            border: 2px solid #005bb5; 
            border-radius: 10px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05); 
            margin: 20px auto; 
            padding: 25px; 
            text-align: center; 
        }

        .app_details {
            text-align: left; 
            margin : 0 auto;
            max-width: 600px; 
        }

        /* Styles for the page body: sets font, text color, removes default spacing, and applies a fixed full-screen background image for a clean, readable layout */
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
<div>
<?php include("header.inc"); ?> 

<div id="container"><h1>Current Job Openings</h1></div>

    <div class="job-card-container">
    <?php 
    $query = "SELECT * FROM jobs";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<section class='job-card'>";
            echo "<h2>" . htmlspecialchars($row['title']) . "</h2>"; // Prevent XSS attacks. Convers special characters like " < , > , & " into safe HTML symbols 
            echo "<p style = 'color: #555; font-style: italic'<strong>Reference Number : </strong>" . htmlspecialchars($row['reference_no']) . "</p>";
            echo "<p>" . htmlspecialchars($row['description']) . "</p>";

            echo "<h3>Job Details:</h3>";
            echo "<ul><li><strong>Salary : </strong>" . htmlspecialchars($row['salary']) . "</li>";
            echo "<li><strong>Reporting to : </strong>" . htmlspecialchars($row['reporting_to']) . "</li></ul>";

            echo "<h3>Key Responsibilities</h3>";
            // get the raw text from the column which contains multiple lines 
            $requirements = $row['responsibilities'];
            // split that text into an array therefore each line becomes a seperate element 
            $items = explode("\n", $requirements);
            // show as an unordered list 
            echo "<ul>";
            foreach ($items as $item) {
                $trimmed = trim($item); // remove extra spaces
                if (!empty($trimmed)) { // only show non-empty lines
                    echo "<li>" . htmlspecialchars($trimmed) . "</li>";
                }
            }
            echo "</ul>";

            echo "<h3>Requirements (Essential)</h3>";
            $requirements = $row['essential_reqs'];
            // split by line breaks 
            $items = explode("\n", $requirements);
            // show as an unordered list 
            echo "<ol>";
            foreach ($items as $item) {
                $trimmed = trim($item); // remove extra spaces
                if (!empty($trimmed)) { // only show non-empty lines
                    echo "<li>" . htmlspecialchars($trimmed) . "</li>";
                }
            }
            echo "</ol>";
            
            echo "<h3>Requirements (Preferable)</h3>";
            $requirements = $row['prefered_reqs'];
            // split by line breaks 
            $items = explode("\n", $requirements);
            // show as an unordered list 
            echo "<ol>";
            foreach ($items as $item) {
                $trimmed = trim($item); // remove extra spaces
                if (!empty($trimmed)) { // only show non-empty lines
                    echo "<li>" . htmlspecialchars($trimmed) . "</li>";
                }
            }
            echo "</ol>";
        
            echo "<p><a href='" . htmlspecialchars($row['apply_link']) . "' class='apply-btn'>Click here to apply!</a></p>";
            echo "</section>";
        }
    } else {
        echo "<p>No job openings available at the moment. Please check back later.</p>";
    }
    mysqli_close($conn);
?>
    </div>
</div>

<!--Aside Section-->
    <Aside class = "sidebar">
        <h3>Why Work With Us?</h3>
        <p>At CyberSecure Solutions, we believe that our people are our greatest asset. We foster a culture of continuous learning, innovation, and collaboration. Enjoy comprehensive benefits, professional development opportunities, and a supportive team environment dedicated to solving the world's toughest cybersecurity challenges.</p>
        <h3>Application Essentials</h3>
        <div class = "app_details">
        <ul>
            <li>Application Deadline - 30 Nov 2025 (11:59 pm AEDT)</li>
            <li>Locations - Melbourne CBD (hybrid) • Sydney (hybrid) • Remote AU</li> 
            <li>Hiring Steps - CV screen → Technical Interview → Panel → Offer</li>
        </ul>
        </div>
    </Aside>

<?php include("footer.inc"); ?>

</body>
</html>