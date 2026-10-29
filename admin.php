<?php
// ======================================================================================
// FILENAME: admin.php (Updated with Robust Prepared Statements for Fetching)
// DESCRIPTION: Single file for Admin Login and Full Dashboard Management
// ======================================================================================

session_start();
// --- FIX: Ensure $conn is available from the required file ---
require_once 'connectionfile.php'; 

// ----------------------------------------------------------------------
// 1. CONFIGURATION AND HARDCODED ADMIN CHECK
// ----------------------------------------------------------------------

const ADMIN_EMAIL = 'admin@servekind.org';
const ADMIN_PASSWORD = 'servekind_admin123'; 

// Helper function to redirect to the main admin page with an action
function redirect_to_admin($module = 'dashboard', $status = null, $msg = null, $type = null) {
    $url = "admin.php?module=" . urlencode($module);
    if ($status) $url .= "&status=" . urlencode($status);
    if ($msg) $url .= "&msg=" . urlencode($msg);
    if ($type) $url .= "&type=" . urlencode($type);
    header("Location: $url");
    exit();
}

// ----------------------------------------------------------------------
// 2. LOGOUT HANDLER
// ----------------------------------------------------------------------

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset();
    session_destroy();
    header("Location: home.php"); // Redirect to public homepage
    exit;
}

// ----------------------------------------------------------------------
// 3. LOGIN PROCESS
// ----------------------------------------------------------------------

if (isset($_POST['login'])) {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Check against hardcoded credentials
    if ($email === ADMIN_EMAIL && $password === ADMIN_PASSWORD) { 
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_email'] = ADMIN_EMAIL;
        redirect_to_admin('dashboard');
    } else {
        $login_error = "Invalid administrator email or password.";
    }
}

// ----------------------------------------------------------------------
// 4. SECURITY CHECK AND REDIRECT TO LOGIN FORM
// ----------------------------------------------------------------------

if (!isset($_SESSION['admin_logged_in'])) {
    // RENDER LOGIN FORM
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Admin Login - ServeKind</title>
        <script src="https://cdn.tailwindcss.com/3.4.16"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
        <style>
            :root { --color-primary: #FF6B35; --color-secondary: #4A90E2; }
            .glass-bg { background: rgba(255,255,255,0.7); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); }
        </style>
    </head>
    <body class="bg-gray-100 flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md p-8 glass-bg rounded-2xl shadow-xl">
            <h1 class="text-4xl font-extrabold text-[var(--color-primary)] text-center mb-6">ServeKind Admin</h1>
            <p class="text-center text-gray-600 mb-8">Please log in to the administrator dashboard.</p>
            
            <form method="POST" action="admin.php">
                <input type="hidden" name="login" value="1">
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" id="email" name="email" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[var(--color-secondary)] focus:border-[var(--color-secondary)]">
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-[var(--color-secondary)] focus:border-[var(--color-secondary)]">
                </div>

                <?php if (isset($login_error)): ?>
                    <div class="p-3 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert"><?php echo $login_error; ?></div>
                <?php endif; ?>

                <button type="submit" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[var(--color-primary)] hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--color-primary)] transition duration-150">
                    <i class="ri-login-box-line mr-2"></i> Log In
                </button>
            </form>
            <p class="mt-4 text-xs text-center text-gray-500">Fixed ID: <code>admin@servekind.org</code> | Pass: <code>servekind_admin123</code></p>
        </div>
    </body>
    </html>
    <?php
    exit; // Stop execution after showing the login form
}

// ----------------------------------------------------------------------
// 5. CORE ADMIN DASHBOARD LOGIC (After successful login)
// ----------------------------------------------------------------------

$module = $_GET['module'] ?? 'dashboard';
$action = $_GET['action'] ?? '';
$id = $_GET['id'] ?? null;
$status_message = $_GET['msg'] ?? '';
$status_type = $_GET['status'] ?? ''; // success, error, info

// --- Data Fetching for Navigation & Alerts ---
try {
    $new_volunteers_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(id) AS count FROM volunteer_registrations WHERE status='pending'"))['count'] ?? 0;
    $unread_messages_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(id) AS count FROM contact_messages WHERE status='unread'"))['count'] ?? 0;
} catch (\Throwable $e) {
    // Basic error handling for navigation counts
    error_log("DB Error fetching counts: " . $e->getMessage());
    $new_volunteers_count = 0;
    $unread_messages_count = 0;
}


// ----------------------------------------------------------------------
// 6. ACTION HANDLERS (CRUD Operations)
// ----------------------------------------------------------------------

// --- Volunteer Approval/Rejection ---
if ($module === 'volunteers' && in_array($action, ['approve', 'reject']) && $id) {
    $new_status = $action === 'approve' ? 'approved' : 'rejected';
    try {
        $stmt = $conn->prepare("UPDATE volunteer_registrations SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $new_status, $id);
        if ($stmt->execute()) {
            redirect_to_admin('volunteers', 'success', "Volunteer application $id has been $new_status.");
        } else {
            redirect_to_admin('volunteers', 'error', "Database error updating volunteer status: " . $conn->error);
        }
        $stmt->close();
    } catch (\Throwable $e) {
        redirect_to_admin('volunteers', 'error', "An unexpected error occurred: " . $e->getMessage());
    }
}

// --- Food Donation Status Update ---
if ($module === 'food' && in_array($action, ['complete', 'schedule']) && $id) {
    $new_status = $action === 'complete' ? 'completed' : 'scheduled';
    try {
        $stmt = $conn->prepare("UPDATE food_donations SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $new_status, $id);
        if ($stmt->execute()) {
            redirect_to_admin('food', 'success', "Food donation $id marked as $new_status.");
        } else {
            redirect_to_admin('food', 'error', "Database error updating food donation status: " . $conn->error);
        }
        $stmt->close();
    } catch (\Throwable $e) {
        redirect_to_admin('food', 'error', "An unexpected error occurred: " . $e->getMessage());
    }
}

// --- Contact Message Reply ---
if ($module === 'messages' && $action === 'reply_process' && isset($_POST['reply_id'])) {
    $reply_id = intval($_POST['reply_id']);
    $reply_text = trim($_POST['admin_reply'] ?? '');

    if (empty($reply_text)) {
        redirect_to_admin('messages', 'error', 'Reply text cannot be empty.');
    }
    
    try {
        // Update message status and store reply
        $stmt = $conn->prepare("UPDATE contact_messages SET admin_reply = ?, status = 'replied', replied_at = NOW() WHERE id = ?");
        $stmt->bind_param("si", $reply_text, $reply_id);
        
        if ($stmt->execute()) {
            redirect_to_admin('messages', 'success', 'Reply saved and message status updated to "replied".');
        } else {
            redirect_to_admin('messages', 'error', "Database error saving reply: " . $conn->error);
        }
        $stmt->close();
    } catch (\Throwable $e) {
        redirect_to_admin('messages', 'error', "An unexpected error occurred: " . $e->getMessage());
    }
}

// --- Content Management (CRUD for Blogs/Programs) ---
if ($module === 'content') {
    $content_type = $_GET['type'] ?? 'blog'; // blog, program
    
    // Enforce only 'blog' and 'program' types
    if (!in_array($content_type, ['blog', 'program'])) {
        $content_type = 'blog';
    }

    // --- DELETE Action ---
    if ($action === 'delete' && $id) {
        $table = $content_type === 'program' ? 'programs' : 'content';
        try {
            $stmt = $conn->prepare("DELETE FROM $table WHERE id = ?");
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                redirect_to_admin('content', 'success', ucfirst($content_type) . " ID $id deleted.", $content_type);
            } else {
                redirect_to_admin('content', 'error', "Error deleting content: " . $conn->error, $content_type);
            }
            $stmt->close();
        } catch (\Throwable $e) {
            redirect_to_admin('content', 'error', "An unexpected error occurred: " . $e->getMessage(), $content_type);
        }
    }

    // --- ADD/EDIT Process ---
    if ($action === 'save' && isset($_POST['content_submit'])) {
        $title = trim($_POST['title'] ?? '');
        $text = trim($_POST['content_text'] ?? '');
        $image_url = trim($_POST['image_url'] ?? ''); // Simple field for image URL for now
        $content_id = intval($_POST['content_id'] ?? 0); // 0 for new

        if (empty($title) || empty($text)) {
            redirect_to_admin('content', 'error', 'Title and content text are required.', $content_type);
        }
        
        $msg = "Error: Database problem.";
        $success_msg = "Content added successfully!";

        try {
            if ($content_type === 'program') {
                $category = trim($_POST['category'] ?? '');
                $location = trim($_POST['location'] ?? '');
                
                if ($content_id > 0) { // Update
                    $sql = "UPDATE programs SET title=?, description=?, image_url=?, category=?, location=? WHERE id=?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sssssi", $title, $text, $image_url, $category, $location, $content_id);
                    $success_msg = "Program updated successfully!";
                } else { // Insert
                    $sql = "INSERT INTO programs (title, description, image_url, category, location) VALUES (?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sssss", $title, $text, $image_url, $category, $location);
                }
            } else { // Blog 
                $type = 'blog';

                if ($content_id > 0) { // Update
                    $sql = "UPDATE content SET title=?, content_text=?, image_url=?, type=? WHERE id=?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssssi", $title, $text, $image_url, $type, $content_id);
                    $success_msg = ucfirst($type) . " updated successfully!";
                } else { // Insert
                    $sql = "INSERT INTO content (title, content_text, image_url, type) VALUES (?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssss", $title, $text, $image_url, $type);
                }
            }
            
            if ($stmt && $stmt->execute()) {
                redirect_to_admin('content', 'success', $success_msg, $content_type);
            } else {
                redirect_to_admin('content', 'error', $msg . " - " . $conn->error, $content_type);
            }
            $stmt->close();
        } catch (\Throwable $e) {
            redirect_to_admin('content', 'error', "An unexpected error occurred during save: " . $e->getMessage(), $content_type);
        }
    }
}
// End of Action Handlers

// ----------------------------------------------------------------------
// 7. HTML HEADER & NAVIGATION
// ----------------------------------------------------------------------
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard - ServeKind</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <script>
        tailwind.config = { theme: { extend: { colors: { primary: '#FF6B35', secondary: '#4A90E2' }, borderRadius: {'button': '8px'} } } };
    </script>
    <style>
        /* Glassmorphism effect consistent with user files */
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .sidebar {
            /* Fixed sidebar style */
            width: 280px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">

    <aside class="sidebar h-screen sticky top-0 p-4 bg-white shadow-xl flex-shrink-0">
        <h1 class="text-3xl font-['Pacifico'] text-primary mb-8 border-b pb-4"> Admin</h1>
        <nav class="space-y-2">
            <a href="admin.php?module=dashboard" class="flex items-center p-3 rounded-lg transition duration-150 <?= $module == 'dashboard' ? 'bg-primary text-white font-semibold' : 'text-gray-700 hover:bg-gray-100' ?>">
                <i class="ri-dashboard-line mr-3"></i> Dashboard
            </a>
            <a href="admin.php?module=users" class="flex items-center p-3 rounded-lg transition duration-150 <?= $module == 'users' ? 'bg-primary text-white font-semibold' : 'text-gray-700 hover:bg-gray-100' ?>">
                <i class="ri-user-4-line mr-3"></i> Registered Users
            </a>
            <a href="admin.php?module=monetary" class="flex items-center p-3 rounded-lg transition duration-150 <?= $module == 'monetary' ? 'bg-primary text-white font-semibold' : 'text-gray-700 hover:bg-gray-100' ?>">
                <i class="ri-wallet-3-line mr-3"></i> Monetary Donations
            </a>
            <a href="admin.php?module=food" class="flex items-center p-3 rounded-lg transition duration-150 <?= $module == 'food' ? 'bg-primary text-white font-semibold' : 'text-gray-700 hover:bg-gray-100' ?>">
                <i class="ri-takeaway-line mr-3"></i> Food Donations
            </a>
            <a href="admin.php?module=volunteers" class="flex items-center p-3 rounded-lg transition duration-150 <?= $module == 'volunteers' ? 'bg-primary text-white font-semibold' : 'text-gray-700 hover:bg-gray-100' ?>">
                <i class="ri-hand-heart-line mr-3"></i> Volunteer Apps 
                <?php if ($new_volunteers_count > 0): ?><span class="ml-auto bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full"><?= $new_volunteers_count ?></span><?php endif; ?>
            </a>
            <a href="admin.php?module=messages" class="flex items-center p-3 rounded-lg transition duration-150 <?= $module == 'messages' ? 'bg-primary text-white font-semibold' : 'text-gray-700 hover:bg-gray-100' ?>">
                <i class="ri-mail-line mr-3"></i> Messages 
                <?php if ($unread_messages_count > 0): ?><span class="ml-auto bg-yellow-500 text-white text-xs font-bold px-2 py-1 rounded-full"><?= $unread_messages_count ?></span><?php endif; ?>
            </a>
            <a href="admin.php?module=content" class="flex items-center p-3 rounded-lg transition duration-150 <?= $module == 'content' ? 'bg-primary text-white font-semibold' : 'text-gray-700 hover:bg-gray-100' ?>">
                <i class="ri-edit-box-line mr-3"></i> Blogs & Programs
            </a>
            <a href="admin.php?action=logout" class="flex items-center p-3 rounded-lg text-red-500 hover:bg-red-50 transition duration-150 mt-8">
                <i class="ri-logout-box-line mr-3"></i> Logout
            </a>
        </nav>
    </aside>

    <main class="flex-1 p-8">
        <?php if ($status_message): ?>
            <div class="p-4 mb-6 rounded-lg text-sm 
                <?= $status_type == 'success' ? 'bg-green-100 text-green-800' : ($status_type == 'error' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800') ?>" 
                role="alert">
                <?= htmlspecialchars($status_message) ?>
            </div>
        <?php endif; ?>
        
        <?php
        // ----------------------------------------------------------------------
        // 8. MODULE VIEWS (switch between different screens)
        // ----------------------------------------------------------------------

        switch ($module) {
            case 'dashboard':
                // --- Dashboard Data Fetch ---
                $total_monetary = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COALESCE(SUM(amount), 0) AS total FROM monetary_donations"))['total'] ?? 0;
                $total_volunteers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(id) AS count FROM volunteer_registrations"))['count'] ?? 0;
                $total_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(id) AS count FROM users"))['count'] ?? 0;
                $completed_food = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(id) AS count FROM food_donations WHERE status='completed'"))['count'] ?? 0;
                
                // Fetch Monthly Data for Chart (last 12 months - MODIFIED)
                $months = [];
                $monetary_vals = [];
                $volunteer_vals = [];
                // CHANGED '5' TO '11' to get 12 months of data (0 to 11)
                for ($i = 6; $i >= 0; $i--) { 
                    $month_ts = strtotime("-$i month");
                    $month_label = date('M Y', $month_ts);
                    $months[] = $month_label;
                    
                    $start_date = date('Y-m-01', $month_ts);
                    $end_date = date('Y-m-t', $month_ts);

                    $monetary_month = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COALESCE(SUM(amount), 0) AS total FROM monetary_donations WHERE created_at BETWEEN '$start_date 00:00:00' AND '$end_date 23:59:59'"))['total'] ?? 0;
                    $volunteer_month = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(id) AS count FROM volunteer_registrations WHERE created_at BETWEEN '$start_date 00:00:00' AND '$end_date 23:59:59'"))['count'] ?? 0;

                    $monetary_vals[] = $monetary_month;
                    $volunteer_vals[] = $volunteer_month;
                }

                ?>
                <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard Overview</h1>

                <section class="grid md:grid-cols-4 gap-6 mb-8">
                    <div class="glass-card rounded-xl p-6 shadow-lg">
                        <p class="text-sm font-medium text-gray-500">Total Donations</p>
                        <p class="text-3xl font-extrabold text-green-600 mt-1">₹<?= number_format($total_monetary, 2) ?></p>
                    </div>
                    <div class="glass-card rounded-xl p-6 shadow-lg">
                        <p class="text-sm font-medium text-gray-500">Total Volunteers</p>
                        <p class="text-3xl font-extrabold text-primary mt-1"><?= number_format($total_volunteers) ?></p>
                    </div>
                    <div class="glass-card rounded-xl p-6 shadow-lg">
                        <p class="text-sm font-medium text-gray-500">Food Donations Completed</p>
                        <p class="text-3xl font-extrabold text-secondary mt-1"><?= number_format($completed_food) ?></p>
                    </div>
                    <div class="glass-card rounded-xl p-6 shadow-lg">
                        <p class="text-sm font-medium text-gray-500">Registered Users</p>
                        <p class="text-3xl font-extrabold text-gray-800 mt-1"><?= number_format($total_users) ?></p>
                    </div>
                </section>

                <section class="glass-card rounded-xl p-6 shadow-lg mb-8">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">Donations & Volunteer Trend (Last 12 Months)</h2>
                    <div class="h-96">
                        <canvas id="adminChart"></canvas>
                    </div>
                </section>
                
                <script>
                    const ctx = document.getElementById('adminChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: <?= json_encode($months) ?>,
                            datasets: [{
                                label: 'Monetary Donations (₹)',
                                data: <?= json_encode($monetary_vals) ?>,
                                backgroundColor: 'rgba(97, 174, 247, 0.8)', // Stronger Blue (Secondary Color)
                                borderColor: '#001125ff',
                                borderWidth: 1,
                                borderRadius: 4, 
                                barPercentage: 0.6,     // Makes bars slimmer
                                categoryPercentage: 0.4, // Makes bars slimmer
                                yAxisID: 'y'
                            }, {
                                label: 'Volunteer Apps',
                                data: <?= json_encode($volunteer_vals) ?>,
                                backgroundColor: '#e36b01ff', // Primary Color for the Line Dot Fill
                                borderColor: '#e36b01ff', // Primary Color for the Line
                                borderWidth: 3,
                                tension: 0.3, 
                                pointRadius: 6, 
                                pointBackgroundColor: 'white',
                                pointBorderColor: '#FF6B35',
                                type: 'line', 
                                fill: false,
                                yAxisID: 'y1'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            interaction: {
                                mode: 'index',
                                intersect: false,
                            },
                            plugins: {
                                legend: {
                                    labels: {
                                        usePointStyle: true,
                                    }
                                },
                                tooltip: {
                                    mode: 'index',
                                    intersect: false
                                }
                            },
                            scales: {
                                x: {
                                    grid: { display: false } // Remove vertical grid lines
                                },
                                y: {
                                    type: 'linear',
                                    display: true,
                                    position: 'left',
                                    title: { display: true, text: 'Donation Amount (₹)', color: '#4A90E2' },
                                    beginAtZero: true
                                },
                                y1: {
                                    type: 'linear',
                                    display: true,
                                    position: 'right',
                                    grid: { drawOnChartArea: false }, 
                                    title: { display: true, text: 'Volunteer Applications', color: '#FF6B35' },
                                    beginAtZero: true,
                                    min: 0,
                                }
                            }
                        }
                    });
                </script>
                <?php
                break;
            
            case 'users':
                // --- Users List ---
                $users = [];
                try {
                    $stmt = $conn->prepare("SELECT id, name, email, created_at FROM users ORDER BY created_at DESC");
                    $stmt->execute();
                    $users_res = $stmt->get_result();
                    while ($row = $users_res->fetch_assoc()) $users[] = $row;
                    $stmt->close();
                } catch (\Throwable $e) {
                    echo "<div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg'>Error fetching users: " . $e->getMessage() . "</div>";
                }
                ?>
                <h1 class="text-3xl font-bold text-gray-800 mb-6">Registered Users</h1>
                <div class="glass-card rounded-xl p-6 shadow-lg overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                       <thead class="bg-gray-50">
    <tr>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
    </tr>
</thead>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php foreach ($users as $row): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $row['id'] ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($row['name']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($row['email']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= date('M d, Y', strtotime($row['created_at'])) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php
                break;

            case 'monetary':
                // --- Monetary Donations List ---
                $monetary = [];
                try {
                    $stmt = $conn->prepare("SELECT * FROM monetary_donations ORDER BY created_at DESC");
                    $stmt->execute();
                    $monetary_res = $stmt->get_result();
                    while ($row = $monetary_res->fetch_assoc()) $monetary[] = $row;
                    $stmt->close();
                } catch (\Throwable $e) {
                    echo "<div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg'>Error fetching monetary donations: " . $e->getMessage() . "</div>";
                }
                ?>
                <h1 class="text-3xl font-bold text-gray-800 mb-6">Monetary Donations Received</h1>
                <div class="glass-card rounded-xl p-6 shadow-lg overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Txn ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Donor</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Method</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php foreach ($monetary as $row): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $row['transaction_id'] ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-green-600">₹<?= number_format($row['amount'], 2) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars(ucfirst($row['payment_method'])) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= date('M d, Y', strtotime($row['created_at'])) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php
                break;

            case 'food':
                // --- Food Donations List ---
                $food = [];
                try {
                    $stmt = $conn->prepare("SELECT * FROM food_donations ORDER BY created_at DESC");
                    $stmt->execute();
                    $food_res = $stmt->get_result();
                    while ($row = $food_res->fetch_assoc()) $food[] = $row;
                    $stmt->close();
                } catch (\Throwable $e) {
                    echo "<div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg'>Error fetching food donations: " . $e->getMessage() . "</div>";
                }
                ?>
                <h1 class="text-3xl font-bold text-gray-800 mb-6">Food Donations (Scheduled & Completed)</h1>
                <div class="glass-card rounded-xl p-6 shadow-lg overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Donor</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pickup</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type / Details</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php foreach ($food as $row): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($row['full_name']) ?></td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <?= date('M d, Y', strtotime($row['pickup_date'])) ?><br>
                                    <span class="font-medium text-xs"><?= $row['pickup_time'] ?></span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <strong><?= htmlspecialchars(ucfirst($row['donation_type'])) ?>:</strong> <?= substr(htmlspecialchars($row['donation_details']), 0, 50) ?>...
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        <?= $row['status'] == 'completed' ? 'bg-green-100 text-green-800' : 'bg-orange-100 text-orange-800' ?>">
                                        <?= ucfirst($row['status']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <?php if ($row['status'] == 'scheduled'): ?>
                                        <a href="admin.php?module=food&action=complete&id=<?= $row['id'] ?>" onclick="return confirm('Mark this donation as COMPLETED?');" class="text-green-600 hover:text-green-900 mr-3">Complete</a>
                                    <?php endif; ?>
                                    <a href="javascript:alert('Details:\nAddress: <?= htmlspecialchars($row['address_line1']) ?>\nCity: <?= htmlspecialchars($row['city']) ?>\nPhone: <?= htmlspecialchars($row['phone']) ?>');" class="text-secondary hover:text-blue-900">View</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php
                break;

            case 'volunteers':
                // --- Volunteer Applications List ---
                $vols = [];
                try {
                    $stmt = $conn->prepare("SELECT * FROM volunteer_registrations ORDER BY created_at DESC");
                    $stmt->execute();
                    $vol_res = $stmt->get_result();
                    while ($row = $vol_res->fetch_assoc()) $vols[] = $row;
                    $stmt->close();
                } catch (\Throwable $e) {
                    echo "<div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg'>Error fetching volunteers: " . $e->getMessage() . "</div>";
                }
                ?>
                <h1 class="text-3xl font-bold text-gray-800 mb-6">Volunteer Applications</h1>
                <div class="glass-card rounded-xl p-6 shadow-lg overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location / Interests</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php foreach ($vols as $row): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <strong>Loc:</strong> <?= htmlspecialchars($row['location']) ?><br>
                                    <strong>Interests:</strong> <?= htmlspecialchars($row['areas_of_interest']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        <?= $row['status'] == 'approved' ? 'bg-green-100 text-green-800' : ($row['status'] == 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') ?>">
                                        <?= ucfirst($row['status']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <?php if ($row['status'] == 'pending'): ?>
                                        <a href="admin.php?module=volunteers&action=approve&id=<?= $row['id'] ?>" onclick="return confirm('Approve this volunteer?');" class="text-green-600 hover:text-green-900 mr-3">Approve</a>
                                        <a href="admin.php?module=volunteers&action=reject&id=<?= $row['id'] ?>" onclick="return confirm('Reject this volunteer?');" class="text-red-600 hover:text-red-900">Reject</a>
                                    <?php else: ?>
                                        <span class="text-gray-400">Done</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php
                break;

            case 'messages':
                $action = $_GET['action'] ?? 'list';
                $messages = [];

                // --- 1. ADMIN REPLY PROCESSING LOGIC ---
                if ($action === 'reply_process' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                    $reply_id = intval($_POST['reply_id'] ?? 0);
                    $admin_reply = trim($_POST['admin_reply'] ?? '');

                    if ($reply_id > 0 && !empty($admin_reply)) {
                        try {
                            // Update the message with the admin reply and set status to 'replied'
                            $stmt = $conn->prepare("UPDATE contact_messages SET admin_reply = ?, status = 'replied', replied_at = NOW() WHERE id = ?");
                            $stmt->bind_param("si", $admin_reply, $reply_id);
                            $stmt->execute();
                            $msg = "Reply sent and status updated.";
                            redirect_to_admin('messages', 'success', $msg);
                        } catch (\Throwable $e) {
                            error_log("Reply Process Error: " . $e->getMessage());
                            redirect_to_admin('messages', 'error', "Failed to send reply.");
                        }
                    } else {
                        redirect_to_admin('messages', 'error', "Reply ID or message content is missing.");
                    }
                }


                // --- 2. Contact Messages List View ---
                try {
                    // FIX: Changed 'created_at' to 'timestamp' to match your table
                    $stmt = $conn->prepare("SELECT * FROM contact_messages ORDER BY timestamp DESC");
                    $stmt->execute();
                    $msg_res = $stmt->get_result();
                    while ($row = $msg_res->fetch_assoc()) $messages[] = $row;
                    $stmt->close();
                } catch (\Throwable $e) {
                    echo "<div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg'>Error fetching messages: " . $e->getMessage() . "</div>";
                }
                ?>
                <h1 class="text-3xl font-bold text-gray-800 mb-6">Contact Messages</h1>
                <div class="glass-card rounded-xl p-6 shadow-lg overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name / Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject / Message</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php foreach ($messages as $row): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= date('M d, H:i', strtotime($row['timestamp'])) ?></td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    <?= htmlspecialchars($row['firstname'] . ' ' . $row['lastname']) ?><br>
                                    <span class="text-xs text-secondary"><?= htmlspecialchars($row['emailaddress']) ?></span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <strong><?= htmlspecialchars($row['subject']) ?>:</strong> <?= substr(htmlspecialchars($row['message']), 0, 50) ?>...
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        <?php $status = $row['status'] ?? 'unread'; ?>
                                        <?= $status == 'replied' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                        <?= ucfirst($status) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button onclick="document.getElementById('reply-modal-<?= $row['id'] ?>').classList.remove('hidden')" class="text-primary hover:text-orange-700">Reply</button>
                                </td>
                            </tr>
                            <div id="reply-modal-<?= $row['id'] ?>" class="fixed z-10 inset-0 overflow-y-auto bg-gray-500 bg-opacity-75 hidden">
                                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                    <div class="inline-block align-bottom glass-card rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                        <div class="p-6">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Reply to Message from <?= htmlspecialchars($row['firstname']) ?></h3>
                                            <p class="text-sm text-gray-600 mb-4"><strong>Message:</strong> <?= htmlspecialchars($row['message']) ?></p>
                                            <?php if (!empty($row['admin_reply'])): ?>
                                                <div class="p-2 mb-4 bg-gray-100 border border-gray-200 rounded-md">
                                                    <strong class="text-xs text-gray-600 block">Current Reply:</strong>
                                                    <p class="text-sm italic"><?= nl2br(htmlspecialchars($row['admin_reply'])) ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <form method="POST" action="admin.php?module=messages&action=reply_process">
                                                <input type="hidden" name="reply_id" value="<?= $row['id'] ?>">
                                                <textarea name="admin_reply" rows="5" class="shadow-sm focus:ring-primary focus:border-primary mt-1 block w-full sm:text-sm border-gray-300 rounded-md p-2" placeholder="Your reply message..." required><?= htmlspecialchars($row['admin_reply'] ?? '') ?></textarea>
                                                <div class="mt-5 sm:mt-6 sm:flex sm:flex-row-reverse">
                                                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-orange-700 sm:ml-3 sm:w-auto sm:text-sm">
                                                        Send/Update Reply
                                                    </button>
                                                    <button type="button" onclick="document.getElementById('reply-modal-<?= $row['id'] ?>').classList.add('hidden')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php
                break;

            case 'content':
                $content_type = $_GET['type'] ?? 'blog';
                // Enforce only 'blog' and 'program' types for display/logic
                if (!in_array($content_type, ['blog', 'program'])) {
                    $content_type = 'blog';
                }

                $page_title = ucfirst($content_type) . ' Management';
                
                // Fetch existing content/item for editing
                $edit_item = null;
                if ($action === 'edit' && $id) {
                    $table = $content_type === 'program' ? 'programs' : 'content';
                    try {
                        $stmt = $conn->prepare("SELECT * FROM $table WHERE id = ?");
                        $stmt->bind_param("i", $id);
                        $stmt->execute();
                        $edit_item = $stmt->get_result()->fetch_assoc();
                        $stmt->close();
                    } catch (\Throwable $e) {
                        echo "<div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg'>Error fetching item for edit: " . $e->getMessage() . "</div>";
                    }
                }

                $content = [];
                try {
                    $table = $content_type === 'program' ? 'programs' : 'content';
                    // Only fetch the specific type (blog or program)
                    $where = $content_type === 'program' ? '' : "WHERE type='$content_type'";
                    $stmt = $conn->prepare("SELECT * FROM $table $where ORDER BY created_at DESC");
                    $stmt->execute();
                    $content_res = $stmt->get_result();
                    while ($row = $content_res->fetch_assoc()) $content[] = $row;
                    $stmt->close();
                } catch (\Throwable $e) {
                    echo "<div class='p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg'>Error fetching content list: " . $e->getMessage() . "</div>";
                }
                
                ?>
                <h1 class="text-3xl font-bold text-gray-800 mb-6"><?= $page_title ?></h1>
                
                <div class="flex space-x-4 mb-6">
                    <a href="admin.php?module=content&type=blog" class="p-3 rounded-lg <?= $content_type == 'blog' ? 'bg-secondary text-white' : 'bg-white text-secondary' ?> font-medium">Manage Blogs</a>
                    <a href="admin.php?module=content&type=program" class="p-3 rounded-lg <?= $content_type == 'program' ? 'bg-secondary text-white' : 'bg-white text-secondary' ?> font-medium">Manage Programs</a>
                </div>

                <div class="glass-card rounded-xl p-6 shadow-lg mb-8">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800"><?= $edit_item ? 'Edit' : 'Add New' ?> <?= ucfirst($content_type) ?></h2>
                    <form method="POST" action="admin.php?module=content&action=save&type=<?= $content_type ?>">
                        <input type="hidden" name="content_submit" value="1">
                        <input type="hidden" name="content_id" value="<?= $edit_item['id'] ?? 0 ?>">
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Title</label>
                                <input type="text" name="title" required value="<?= htmlspecialchars($edit_item['title'] ?? '') ?>" class="mt-1 block w-full p-2 border rounded-md">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Image URL (Path to file)</label>
                                <input type="text" name="image_url" value="<?= htmlspecialchars($edit_item['image_url'] ?? '') ?>" class="mt-1 block w-full p-2 border rounded-md">
                            </div>
                        </div>

                        <?php if ($content_type === 'program'): ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Category</label>
                                <input type="text" name="category" value="<?= htmlspecialchars($edit_item['category'] ?? '') ?>" class="mt-1 block w-full p-2 border rounded-md">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Location</label>
                                <input type="text" name="location" value="<?= htmlspecialchars($edit_item['location'] ?? '') ?>" class="mt-1 block w-full p-2 border rounded-md">
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Content / Description</label>
                            <textarea name="content_text" rows="8" required class="mt-1 block w-full p-2 border rounded-md"><?= htmlspecialchars($edit_item['description'] ?? $edit_item['content_text'] ?? '') ?></textarea>
                        </div>
                        
                        <button type="submit" class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-orange-700 transition duration-150">
                            <i class="ri-save-line mr-2"></i> Save <?= ucfirst($content_type) ?>
                        </button>
                    </form>
                </div>

                <div class="glass-card rounded-xl p-6 shadow-lg overflow-x-auto">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">Existing <?= ucfirst($content_type) ?>s</h2>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php foreach ($content as $row): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($row['title']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= date('M d, Y', strtotime($row['created_at'])) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="admin.php?module=content&action=edit&type=<?= $content_type ?>&id=<?= $row['id'] ?>" class="text-secondary hover:text-blue-900 mr-3">Edit</a>
                                    <a href="admin.php?module=content&action=delete&type=<?= $content_type ?>&id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this <?= $content_type ?>?');" class="text-red-600 hover:text-red-900">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php
                break;

            default:
                // Fallback to Dashboard if module is not recognized
                redirect_to_admin('dashboard');
                break;
        }
        ?>

    </main>
</body>
</html>
<?php
// Ensure the connection is closed at the end of the script
mysqli_close($conn);
?>