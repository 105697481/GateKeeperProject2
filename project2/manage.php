<?php
session_start();
require_once 'settings.php';

// Check if user is logged in and is admin
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Initialize variables
$message = '';
$eois = [];
$search_performed = false;
$sort_field = isset($_GET['sort']) ? $_GET['sort'] : 'EOInumber';
$sort_order = isset($_GET['order']) ? $_GET['order'] : 'ASC';

// Handle POST requests (Actions)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Delete EOIs by job reference
    if (isset($_POST['delete_by_job_ref'])) {
        $job_ref = trim($_POST['job_ref_delete']);
        if (!empty($job_ref)) {
            $stmt = $conn->prepare("DELETE FROM eoi WHERE job_reference = ?");
            $stmt->bind_param("s", $job_ref);
            if ($stmt->execute()) {
                $affected_rows = $stmt->affected_rows;
                $message = "<div class='success'>✅ Successfully deleted {$affected_rows} EOI(s) with job reference: {$job_ref}</div>";
            } else {
                $message = "<div class='error'>❌ Error deleting EOIs: " . $stmt->error . "</div>";
            }
            $stmt->close();
        }
    }
    
    // Change EOI Status
    if (isset($_POST['change_status'])) {
        $eoi_number = $_POST['eoi_number'];
        $new_status = $_POST['new_status'];
        
        $stmt = $conn->prepare("UPDATE eoi SET status = ? WHERE EOInumber = ?");
        $stmt->bind_param("si", $new_status, $eoi_number);
        if ($stmt->execute()) {
            $message = "<div class='success'>✅ Successfully updated EOI #{$eoi_number} status to: {$new_status}</div>";
        } else {
            $message = "<div class='error'>❌ Error updating status: " . $stmt->error . "</div>";
        }
        $stmt->close();
    }
}

// Handle search and listing
$where_clause = "";
$params = [];
$param_types = "";

// Search by job reference
if (isset($_GET['search_job_ref']) && !empty($_GET['job_ref'])) {
    $where_clause = "WHERE job_reference = ?";
    $params[] = $_GET['job_ref'];
    $param_types .= "s";
    $search_performed = true;
}

// Search by name
if (isset($_GET['search_name']) && (!empty($_GET['first_name']) || !empty($_GET['last_name']))) {
    $name_conditions = [];
    if (!empty($_GET['first_name'])) {
        $name_conditions[] = "first_name LIKE ?";
        $params[] = "%" . $_GET['first_name'] . "%";
        $param_types .= "s";
    }
    if (!empty($_GET['last_name'])) {
        $name_conditions[] = "last_name LIKE ?";
        $params[] = "%" . $_GET['last_name'] . "%";
        $param_types .= "s";
    }
    $where_clause = "WHERE " . implode(" AND ", $name_conditions);
    $search_performed = true;
}

// List all EOIs (default) or search results
$sql = "SELECT * FROM eoi $where_clause ORDER BY $sort_field $sort_order";
if (!empty($params)) {
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($param_types, ...$params);
} else {
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();
$eois = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Get unique job references for dropdown
$job_refs_query = "SELECT DISTINCT job_reference FROM eoi ORDER BY job_reference";
$job_refs_result = $conn->query($job_refs_query);
$job_references = $job_refs_result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Manager Dashboard - GateKeeper Inc</title>
    <link rel="icon" href="images/logo.png" type="image/png">
    <link rel="stylesheet" href="styles/index.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url(images/bgimage3.jpg);
            background-size: cover;
            background-attachment: fixed;
        }
        
        .admin-container {
            max-width: 1400px;
            margin: 20px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .admin-header {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .search-panel {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 2px solid #dee2e6;
        }
        
        .search-form {
            background: white;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }
        
        .search-form h3 {
            margin-top: 0;
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 5px;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        
        .form-group input, .form-group select {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        
        .btn {
            background: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: background 0.3s;
        }
        
        .btn:hover {
            background: #2980b9;
        }
        
        .btn-danger {
            background: #e74c3c;
        }
        
        .btn-danger:hover {
            background: #c0392b;
        }
        
        .btn-warning {
            background: #f39c12;
        }
        
        .btn-warning:hover {
            background: #e67e22;
        }
        
        .results-section {
            margin-top: 30px;
        }
        
        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 15px;
            background: #3498db;
            color: white;
            border-radius: 8px;
        }
        
        .sort-options {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        
        .eoi-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .eoi-table th {
            background: #3498db;
            color: white;
            padding: 12px 8px;
            text-align: left;
            font-weight: bold;
        }
        
        .eoi-table td {
            padding: 10px 8px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }
        
        .eoi-table tr:hover {
            background: #f8f9fa;
        }
        
        .status-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }
        
        .status-new { background: #3498db; color: white; }
        .status-current { background: #f39c12; color: white; }
        .status-final { background: #27ae60; color: white; }
        
        .action-buttons {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }
        
        .action-buttons .btn {
            padding: 5px 10px;
            font-size: 12px;
        }
        
        .success {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #c3e6cb;
            margin-bottom: 20px;
        }
        
        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #f5c6cb;
            margin-bottom: 20px;
        }
        
        .logout-link {
            position: absolute;
            top: 20px;
            right: 20px;
            background: #e74c3c;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
        }
        
        .logout-link:hover {
            background: #c0392b;
        }
        
        @media (max-width: 768px) {
            .search-panel {
                grid-template-columns: 1fr;
            }
            
            .eoi-table {
                font-size: 12px;
            }
            
            .eoi-table th, .eoi-table td {
                padding: 6px 4px;
            }
        }
    </style>
</head>
<body>
    <a href="logout.php" class="logout-link">Logout</a>

    <?php include 'header.inc'; ?>

    <main>
        <div class="admin-container">
            <div class="admin-header">
                <h1>🛡️ HR Manager Dashboard</h1>
                <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>! | Total EOIs: <?php echo count($eois); ?></p>
            </div>

            <?php if ($message): ?>
                <?php echo $message; ?>
            <?php endif; ?>

            <!-- Search and Action Panel -->
            <div class="search-panel">
                <!-- List All EOIs -->
                <div class="search-form">
                    <h3>📋 View All EOIs</h3>
                    <a href="manage.php" class="btn">Show All EOIs</a>
                </div>

                <!-- Search by Job Reference -->
                <div class="search-form">
                    <h3>🔍 Search by Job Reference</h3>
                    <form method="GET">
                        <div class="form-group">
                            <label>Job Reference:</label>
                            <select name="job_ref" required>
                                <option value="">Select Job Reference</option>
                                <?php foreach ($job_references as $job_ref): ?>
                                    <option value="<?php echo htmlspecialchars($job_ref['job_reference']); ?>"
                                        <?php echo (isset($_GET['job_ref']) && $_GET['job_ref'] === $job_ref['job_reference']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($job_ref['job_reference']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" name="search_job_ref" class="btn">Search</button>
                    </form>
                </div>

                <!-- Search by Name -->
                <div class="search-form">
                    <h3>👤 Search by Applicant Name</h3>
                    <form method="GET">
                        <div class="form-group">
                            <label>First Name:</label>
                            <input type="text" name="first_name" value="<?php echo htmlspecialchars($_GET['first_name'] ?? ''); ?>" placeholder="Enter first name">
                        </div>
                        <div class="form-group">
                            <label>Last Name:</label>
                            <input type="text" name="last_name" value="<?php echo htmlspecialchars($_GET['last_name'] ?? ''); ?>" placeholder="Enter last name">
                        </div>
                        <button type="submit" name="search_name" class="btn">Search</button>
                    </form>
                </div>

                <!-- Delete by Job Reference -->
                <div class="search-form">
                    <h3>🗑️ Delete EOIs by Job Reference</h3>
                    <form method="POST" onsubmit="return confirm('Are you sure you want to delete ALL EOIs with this job reference? This action cannot be undone!');">
                        <div class="form-group">
                            <label>Job Reference:</label>
                            <select name="job_ref_delete" required>
                                <option value="">Select Job Reference</option>
                                <?php foreach ($job_references as $job_ref): ?>
                                    <option value="<?php echo htmlspecialchars($job_ref['job_reference']); ?>">
                                        <?php echo htmlspecialchars($job_ref['job_reference']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" name="delete_by_job_ref" class="btn btn-danger">Delete All</button>
                    </form>
                </div>
            </div>

            <!-- Results Section -->
            <div class="results-section">
                <div class="results-header">
                    <h2>
                        <?php if ($search_performed): ?>
                            🔍 Search Results (<?php echo count($eois); ?> found)
                        <?php else: ?>
                            📊 All EOIs (<?php echo count($eois); ?> total)
                        <?php endif; ?>
                    </h2>
                    
                    <div class="sort-options">
                        <form method="GET" style="display: flex; gap: 10px; align-items: center;">
                            <!-- Preserve existing search parameters -->
                            <?php if (isset($_GET['search_job_ref']) && isset($_GET['job_ref'])): ?>
                                <input type="hidden" name="search_job_ref" value="1">
                                <input type="hidden" name="job_ref" value="<?php echo htmlspecialchars($_GET['job_ref']); ?>">
                            <?php endif; ?>
                            <?php if (isset($_GET['search_name'])): ?>
                                <input type="hidden" name="search_name" value="1">
                                <?php if (isset($_GET['first_name'])): ?>
                                    <input type="hidden" name="first_name" value="<?php echo htmlspecialchars($_GET['first_name']); ?>">
                                <?php endif; ?>
                                <?php if (isset($_GET['last_name'])): ?>
                                    <input type="hidden" name="last_name" value="<?php echo htmlspecialchars($_GET['last_name']); ?>">
                                <?php endif; ?>
                            <?php endif; ?>
                            
                            <label>Sort by:</label>
                            <select name="sort">
                                <option value="EOInumber" <?php echo $sort_field === 'EOInumber' ? 'selected' : ''; ?>>EOI Number</option>
                                <option value="first_name" <?php echo $sort_field === 'first_name' ? 'selected' : ''; ?>>First Name</option>
                                <option value="last_name" <?php echo $sort_field === 'last_name' ? 'selected' : ''; ?>>Last Name</option>
                                <option value="job_reference" <?php echo $sort_field === 'job_reference' ? 'selected' : ''; ?>>Job Reference</option>
                                <option value="status" <?php echo $sort_field === 'status' ? 'selected' : ''; ?>>Status</option>
                                <option value="dob" <?php echo $sort_field === 'dob' ? 'selected' : ''; ?>>Date of Birth</option>
                            </select>
                            
                            <select name="order">
                                <option value="ASC" <?php echo $sort_order === 'ASC' ? 'selected' : ''; ?>>Ascending</option>
                                <option value="DESC" <?php echo $sort_order === 'DESC' ? 'selected' : ''; ?>>Descending</option>
                            </select>
                            
                            <button type="submit" class="btn" style="padding: 5px 15px; font-size: 14px;">Sort</button>
                        </form>
                    </div>
                </div>

                <?php if (empty($eois)): ?>
                    <div style="text-align: center; padding: 40px; background: white; border-radius: 8px;">
                        <h3>No EOIs found</h3>
                        <p>Try adjusting your search criteria or <a href="manage.php">view all EOIs</a>.</p>
                    </div>
                <?php else: ?>
                    <div style="overflow-x: auto;">
                        <table class="eoi-table">
                            <thead>
                                <tr>
                                    <th>EOI#</th>
                                    <th>Name</th>
                                    <th>DOB</th>
                                    <th>Gender</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Job Role</th>
                                    <th>Job Ref</th>
                                    <th>Visa Class</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($eois as $eoi): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($eoi['EOInumber']); ?></td>
                                        <td>
                                            <strong><?php echo htmlspecialchars($eoi['first_name'] . ' ' . $eoi['last_name']); ?></strong><br>
                                            <small><?php echo htmlspecialchars($eoi['suburb_town'] . ', ' . $eoi['state']); ?></small>
                                        </td>
                                        <td><?php echo htmlspecialchars($eoi['dob']); ?></td>
                                        <td><?php echo ucfirst(htmlspecialchars($eoi['gender'])); ?></td>
                                        <td><?php echo htmlspecialchars($eoi['email']); ?></td>
                                        <td><?php echo htmlspecialchars($eoi['country_code'] . ' ' . $eoi['phone']); ?></td>
                                        <td><?php echo htmlspecialchars($eoi['job_role']); ?></td>
                                        <td><strong><?php echo htmlspecialchars($eoi['job_reference']); ?></strong></td>
                                        <td><?php echo htmlspecialchars($eoi['visa_class']); ?></td>
                                        <td>
                                            <span class="status-badge status-<?php echo strtolower($eoi['status']); ?>">
                                                <?php echo htmlspecialchars($eoi['status']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <form method="POST" style="display: inline;">
                                                    <input type="hidden" name="eoi_number" value="<?php echo $eoi['EOInumber']; ?>">
                                                    <select name="new_status" required>
                                                        <option value="">Change Status</option>
                                                        <option value="New" <?php echo $eoi['status'] === 'New' ? 'disabled' : ''; ?>>New</option>
                                                        <option value="Current" <?php echo $eoi['status'] === 'Current' ? 'disabled' : ''; ?>>Current</option>
                                                        <option value="Final" <?php echo $eoi['status'] === 'Final' ? 'disabled' : ''; ?>>Final</option>
                                                    </select>
                                                    <button type="submit" name="change_status" class="btn btn-warning">Update</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <?php include 'footer.inc'; ?>
</body>
</html>

<?php
$conn->close();
?>
