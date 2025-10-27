<?php
//start the session to store error messages
session_start(); 

//Connect to MySQL database
require_once("settings.php");

//Block direct access (only allow POST requests)
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: apply.php");                  // redirect if user tries to access directly
    exit();
}

//Sanitising function
function sanitise_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//Create table if not exists
$table_sql = "CREATE TABLE IF NOT EXISTS eoi (
    EOInumber INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(20) NOT NULL,
    last_name VARCHAR(20) NOT NULL,
    dob DATE NOT NULL,
    gender ENUM('male','female','other') NOT NULL,
    street_address VARCHAR(40) NOT NULL,
    suburb_town VARCHAR(40) NOT NULL,
    state ENUM('VIC','NSW','QLD','NT','WA','SA','TAS','ACT') NOT NULL,
    postcode CHAR(4) NOT NULL,
    email VARCHAR(50) NOT NULL,
    country_code VARCHAR(5) NOT NULL,
    phone VARCHAR(12) NOT NULL,
    job_role VARCHAR(50) NOT NULL,
    job_reference VARCHAR(10) NOT NULL,
    visa_class ENUM('Citizen','Temporary visa') NOT NULL,
    skills VARCHAR(255) NOT NULL,
    other_skills TEXT,
    status ENUM('New','Current','Final') DEFAULT 'New'
)";
mysqli_query($conn, $table_sql);

//Collect and sanitise form data
$first_name = sanitise_input($_POST["first_name"] ?? '');
$last_name = sanitise_input($_POST["last_name"] ?? '');
$dob = sanitise_input($_POST["dob"] ?? '');
$gender = sanitise_input($_POST["gender"] ?? '');
$street_address = sanitise_input($_POST["street_address"] ?? '');
$suburb = sanitise_input($_POST["suburb"] ?? '');
$state = sanitise_input($_POST["state"] ?? '');
$postcode = sanitise_input($_POST["postcode"] ?? '');
$email = sanitise_input($_POST["email"] ?? '');
$country_code = sanitise_input($_POST["country_code"] ?? '');
$phone = sanitise_input($_POST["phone"] ?? '');
$job_role = sanitise_input($_POST["job_role"] ?? '');
$job_reference = sanitise_input($_POST["job_reference"] ?? '');
$visa_class = sanitise_input($_POST["visa_class"] ?? '');
$skills = isset($_POST["skills"]) ? implode(", ", $_POST["skills"]) : '';
$other_skills = sanitise_input($_POST["other_skills"] ?? '');

//Store old values in session (so user doesn't have to re-type)
$_SESSION['first_name'] = $first_name;
$_SESSION['last_name'] = $last_name;
$_SESSION['dob'] = $dob;
$_SESSION['gender'] = $gender;
$_SESSION['street_address'] = $street_address;
$_SESSION['suburb'] = $suburb;
$_SESSION['state'] = $state;
$_SESSION['postcode'] = $postcode;
$_SESSION['email'] = $email;
$_SESSION['country_code'] = $country_code;
$_SESSION['phone'] = $phone;
$_SESSION['job_role'] = $job_role;
$_SESSION['job_reference'] = $job_reference;
$_SESSION['visa_class'] = $visa_class;
$_SESSION['skills'] = $skills;
$_SESSION['other_skills'] = $other_skills;

//Server-side validation
$errors = false;

if (empty($first_name) || !preg_match("/^[A-Za-z\s]+$/", $first_name)) {
    $_SESSION['first_name_err'] = "First name is required and must contain only letters.";
$errors = true;
}

if (empty($last_name) || !preg_match("/^[A-Za-z\s]+$/", $last_name)) {
    $_SESSION['last_name_err'] = "Last name is required and must contain only letters.";
$errors = true;
}

if (empty($dob)) { 
    $_SESSION['dob_err'] = "Date of birth is required.";
$errors = true;
}

if (empty($gender)) {
    $_SESSION['gender_err'] = "Please select your gender.";
$errors = true;
}

if (empty($street_address)) {
    $_SESSION['street_address_err'] = "Street address is required.";
$errors = true;
}

if (empty($suburb)) {
    $_SESSION['suburb_err'] = "Suburb/Town is required.";
$errors = true;
}

if (empty($postcode) || !preg_match("/^[0-9]{4}$/", $postcode)) {
    $_SESSION['postcode_err'] = "Postcode must be exactly 4 digits.";
$errors = true;
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['email_err'] = "Please enter a valid email address.";
$errors = true;
}

if (empty($country_code)) {
    $_SESSION['country_code_err'] = "Country code is required.";
$errors = true;
}

if (empty($phone) || !preg_match("/^[0-9]{8,12}$/", $phone)) {
    $_SESSION['phone_err'] = "Phone number must be between 8 and 12 digits.";
$errors = true;
}

if (empty($job_role)) {
    $_SESSION['job_role_err'] = "Job role is required.";
$errors = true;
}

if (empty($job_reference)) {
    $_SESSION['job_reference_err'] = "Job reference is required.";
$errors = true;
}

if (empty($visa_class)) {
    $_SESSION['visa_class_err'] = "Visa class is required.";
$errors = true;
}

if (empty($skills)) {
    $_SESSION['skills_err'] = "Select at least one skill.";
$errors = true;
}

//If validation fails → send back to form
if ($errors) {
    header("Location: apply.php");
    exit();
}

//Insert validated data into table
$query = "INSERT INTO eoi 
(first_name, last_name, dob, gender, street_address, suburb_town, state, postcode, email, country_code, phone, job_role, job_reference, visa_class, skills, other_skills)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"; 

//We use (?) instead of writing the variables directly here. It is called "Prepared statement". 
//It helps to prevent sql injection attacks makes the query more secure. 
//So, instead of putting variable values directly into the sql string, we safely bind them later using 'mysqli_stmt_bind_param()'.

$stmt = mysqli_prepare($conn, $query);

//Here we bind our php variables to the (?) placeholders above. 
//The "ssssssssssssssss" means each variable is a string (s - string)
//This step tells MySQL exactly which values to insert safely without allowing any harmful code to run.

mysqli_stmt_bind_param($stmt, "ssssssssssssssss",
    $first_name, $last_name, $dob, $gender, $street_address, $suburb, $state, $postcode,
    $email, $country_code, $phone, $job_role, $job_reference, $visa_class, $skills, $other_skills
);

//In here when we execute the prepared query and if it is successfull, MySQL will insert the record and create an auto_generated EOInumber. 
if (mysqli_stmt_execute($stmt)) {
    $eoi_number = mysqli_insert_id($conn);              // get the auto-incremented EOI number
    echo "<h2 style='color:green; text-align:center;'>Your application has been submitted successfully!</h2>";
    echo "<h3 style='text-align:center;'>Your EOI Number is <strong>$eoi_number</strong></h3>";
} else {
    echo "<p style='color:red; text-align:center;'>Error: " . mysqli_error($conn) . "</p>";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>



