<?php
session_start();
require_once 'settings.php';

// Load saved values if user made errors before
$first_name = $_SESSION['first_name'] ?? '';
$last_name = $_SESSION['last_name'] ?? '';
$dob = $_SESSION['dob'] ?? '';
$gender = $_SESSION['gender'] ?? '';
$street_address = $_SESSION['street_address'] ?? '';
$suburb = $_SESSION['suburb'] ?? '';
$state = $_SESSION['state'] ?? '';
$postcode = $_SESSION['postcode'] ?? '';
$email = $_SESSION['email'] ?? '';
$country_code = $_SESSION['country_code'] ?? '';
$phone = $_SESSION['phone'] ?? '';
$job_role = $_SESSION['job_role'] ?? '';
$job_reference = $_SESSION['job_reference'] ?? '';
$visa_class = $_SESSION['visa_class'] ?? '';
$skills = $_SESSION['skills'] ?? '';
$other_skills = $_SESSION['other_skills'] ?? '';

//Load error messages
$first_name_error = $_SESSION['first_name_err'] ?? '';
$last_name_error = $_SESSION['last_name_err'] ?? '';
$dob_error = $_SESSION['dob_err'] ?? '';
$gender_error = $_SESSION['gender_err'] ?? '';
$street_address_error = $_SESSION['street_address_err'] ?? '';
$suburb_error = $_SESSION['suburb_err'] ?? '';
$state_error = $_SESSION['state_err'] ?? '';
$postcode_error = $_SESSION['postcode_err'] ?? '';
$email_error = $_SESSION['email_err'] ?? '';
$country_code_error = $_SESSION['country_code_err'] ?? '';
$phone_error = $_SESSION['phone_err'] ?? '';
$job_role_error = $_SESSION['job_role_err'] ?? '';
$job_reference_error = $_SESSION['job_reference_err'] ?? '';
$visa_class_error = $_SESSION['visa_class_err'] ?? '';
$skills_error = $_SESSION['skills_err'] ?? '';

//Clear session so messages don’t reappear after refresh
session_unset();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Apply for jobs from here</title>
    <!--Favicon link for the browser tab-->
    <link rel= "icon" type = "image/png" href = "images/logo2.png">
    <!--Link to the external stylesheet as required by the project brief-->
    <link rel="stylesheet" href="styles/apply.css">
    
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
    <?php include("header.inc"); ?>
    <a href="logout.php" class="logout-link">Logout</a>
        
    <div class="container">       
            <h1 style="color: #333; text-align: center;">Job Application</h1> <!--Inline CSS Example-->
    </div>
       <form action="process_eoi.php" method="POST" novalidate>
            <fieldset>
                <legend>Personal Information</legend>

                <div class="form-group">
                    <label for="first-name">First Name:</label>
                    <input type="text" id="First-name" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>" pattern="[A-Za-z\s]+" title="Only letters and spaces are allowed" maxlength="20" required placeholder="Enter You First Name">
                    <span class="error" style="color:red;"><?php echo $first_name_error; ?></span>
                </div>
                
                <div class="form-group">
                    <label for="last-name">Last Name:</label>
                    <input type="text" id="Last Name" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>" pattern="[A-Za-z\s]+" title="Only letters and spaces are allowed" maxlength="20" required placeholder="Enter your Last Name">
                    <span class="error" style="color:red;"><?php echo $last_name_error; ?></span>
                </div>

                <div class="form-group">
                    <label for="dob">Date of Birth:</label>
                    <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($dob); ?>" required>
                    <span class="error" style="color:red;"><?php echo $dob_error; ?></span>
                </div>

                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <div class="gender-options">
                        <label><input type="radio" id="male" name="gender" value="male" <?php if($gender=="male") echo "checked"; ?>> Male</label>
                        <label><input type="radio" id="female" name="gender" value="female" <?php if($gender=="female") echo "checked"; ?>> Female</label>
                        <label><input type="radio" id="other" name="gender" value="other" <?php if($gender=="other") echo "checked"; ?>> Other</label>
                        <span class="error" style="color:red;"><?php echo $gender_error; ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="Street-Address">Street Address:</label>
                    <input type="text" id="Street Address" name="street_address" value="<?php echo htmlspecialchars($street_address); ?>" title="Only letters and spaces are allowed" maxlength="40" required placeholder="Enter your street address">
                    <span class="error" style="color:red;"><?php echo $street_address_error; ?></span>
                </div>
            </fieldset>

            <fieldset>
                <legend>Address</legend>

                <div class="form-group">
                    <label for="Suburb/Town">Suburb/Town:</label>
                    <input type="text" id="Suburb/Town" name="suburb" value="<?php echo htmlspecialchars($suburb); ?>" title="Only letters and spaces are allowed" maxlength="40" required placeholder="Enter your Suburb/Town">
                    <span class="error" style="color:red;"><?php echo $suburb_error; ?></span>
                </div>
            

                <div class="form-group">
                    <label for="PostCode">PostCode:</label>
                    <input type="text" id="PostCode" name="postcode" value="<?php echo htmlspecialchars($postcode); ?>" pattern="[0-9]{4}" title="Postcode must be exactly 4 digits"  required placeholder="Enter your post code">
                    <span class="error" style="color:red;"><?php echo $postcode_error; ?></span>
                </div>

                <div class="form-group">
                    <label for="state">State:</label>
                    <select id="state" name="state" required>
                         <option value="">Select</option>
                         <?php
                         $states = ["VIC(Victoria)","NSW(New South Wales)","QLD(Queennsland)","NT(Northern Territory)","WA(Western Australia)","SA(South Australia)","TAS(Tasmania)","ACT(Australian Capital Territory)"];
                         foreach ($states as $st) {
                            $selected = ($state == $st) ? "selected" : "";                
                            echo "<option value='$st' $selected>$st</option>";
                         }
                         ?>
                    </select>
                    <span class="error" style="color:red;"><?php echo $state_error; ?></span>
                </div>          
            </fieldset>

            <fieldset>
                <legend>Contact Information</legend>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="Enter your email" required>
                    <span class="error" style="color:red;"><?php echo $email_error; ?></span>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number:</label>

                    <div class="phone-container">
                        <select id="country-code" name="country_code" required>
                            <option value="+1" <?php if($country_code=="+1") echo "selected"; ?>>+1 (USA)</option>
                            <option value="+44" <?php if($country_code=="+44") echo "selected"; ?>>+44 (UK)</option>
                            <option value="+61" <?php if($country_code=="+61") echo "selected"; ?>>+61 (Australia)</option>
                            <option value="+91" <?php if($country_code=="+91") echo "selected"; ?>>+91 (India)</option>
                        </select>
                        <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>" placeholder="Enter your phone number" required pattern="[0-9]{8,12}" title="8 to 12 digits">
                    </div>
                    <span class="error" style="color:red;"><?php echo $phone_error; ?></span>
                </div>
            </fieldset>

            <fieldset>
                <legend>Job Details</legend>

                <div class="form-group">
                    <label for="job-role">Job Role:</label>
                    <select id="job-role" name="job_role" required>
                        <option value="">Select Job Role</option>
                        <option value="senior-security-analyst" <?php if($job_role=="senior-security-analyst") echo "selected"; ?>>Senior Security Analyst</option>
                        <option value="junior-penetration-tester" <?php if($job_role=="junior-penetration-tester") echo "selected"; ?>>Junior Penetration Tester</option>
                        <option value="cybersecurity-intern" <?php if($job_role=="cybersecurity-intern") echo "selected"; ?>>Cybersecurity Intern</option>
                    </select>
                    <span class="error" style="color:red;"><?php echo $job_role_error; ?></span>  
                </div>
                
                <div class="form-group">
                    <label for="Job_Reference">Job_Reference:</label>
                    <select id="Job_Reference" name="job_reference" required>
                        <option value="">Select Reference</option>
                        <option value="SEC01" <?php if($job_reference=="SEC01") echo "selected"; ?>>SEC01</option>
                        <option value="PEN02" <?php if($job_reference=="PEN02") echo "selected"; ?>>PEN02</option>
                        <option value="INT03" <?php if($job_reference=="INT03") echo "selected"; ?>>INT03</option>
                    </select>
                    <span class="error" style="color:red;"><?php echo $job_reference_error; ?></span>
                </div>

                <div class="form-group">
                    <label for="availability">Visa Class:</label>
                    <select id="Visa Class" name="visa_class" required>
                        <option value="">Select</option>
                        <option value="Citizen" <?php if($visa_class=="Citizen") echo "selected"; ?>>Citizen</option>
                        <option value="Temporary visa" <?php if($visa_class=="Temporary visa") echo "selected"; ?>>Temporary visa</option>
                    </select>
                    <span class="error" style="color:red;"><?php echo $visa_class_error; ?></span>
                </div>
            </fieldset>

            <fieldset>
                <legend>Skills</legend>
                <div class="skills-container">
                    <?PHP
                        $skills_list = ["Network Security", "Risk Management", "Web App Testing", "Social Engineering", "Ethical Hacking", "System Administration", "Other Skills"];
                        foreach ($skills_list as $s) {
                            $checked = (strpos($skills, $s) !== false) ? "checked" : "";
                            echo "<label><input type='checkbox' name='skills[]' value='$s' $checked>$s</label>";
                        }
                        ?>
                </div>
                <span class="error" style="color:red;"><?php echo $skills_error; ?></span>
            </fieldset>

            <fieldset>
                <legend>Additional Information</legend>
                <div class="form-group">
                    <label for="Other Skill">Other Skill:</label>
                    <textarea id="Other Skill" name="other_skills" rows="6" placeholder="Please write a brief other skill..."></textarea>
                </div>
            </fieldset>

            <button type="submit">Submit Application</button>
            <button type="reset">Reset</button> 
        </form>
    </div>
 
<?php include("footer.inc"); ?>

</body>
</html>