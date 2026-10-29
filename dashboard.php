<?php
session_start();
require_once 'connectionfile.php';

// Security Check
if (!isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit;
}

$user_id = intval($_SESSION['user_id']);
$user_name = $_SESSION['user_name'];

// 1. Fetch Monetary Donations
$monetary = [];
$total_donated = 0;
$stmt = $conn->prepare("SELECT * FROM monetary_donations WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$res = $stmt->get_result();
while ($row = $res->fetch_assoc()) {
    $monetary[] = $row;
    $total_donated += $row['amount'];
}
$stmt->close();

// 2. Fetch Food Donations
$food = [];
$stmt = $conn->prepare("SELECT * FROM food_donations WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$res = $stmt->get_result();
while ($row = $res->fetch_assoc()) $food[] = $row;
$stmt->close();

// 3. Fetch Volunteer Applications
$vols = [];
$stmt = $conn->prepare("SELECT * FROM volunteer_registrations WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$res = $stmt->get_result();
while ($row = $res->fetch_assoc()) $vols[] = $row;
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Dashboard - ServeKind</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>tailwind.config={theme:{extend:{colors:{primary:'#FF6B35',secondary:'#4A90E2'},borderRadius:{'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'}}}}</script>
    
    <style>
        .glass-card {
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.5);
            box-shadow: 0 8px 32px rgba(0,0,0,0.05);
        }
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans text-gray-800">

    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center">
                <a href="home.php" class="text-3xl font-['Pacifico'] text-primary mr-10">ServeKind</a>
                <nav class="hidden md:flex space-x-6">
                    <a href="home.php" class="text-gray-800 hover:text-primary font-medium">Back to Home</a>             
                </nav>
            </div>
            <div class="flex items-center gap-4">
                <span class="font-bold text-gray-700">Hi, <?php echo htmlspecialchars($user_name); ?></span>
                <a href="logout.php" class="text-red-500 hover:text-red-700 font-medium text-sm border border-red-200 px-4 py-2 rounded-button hover:bg-red-50 transition">Logout</a>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">My Dashboard</h1>
            <p class="text-gray-600">Thank you for being part of our mission.</p>
        </div>

        <div class="dashboard-grid mb-10">
            <div class="glass-card p-6 rounded-2xl flex items-center">
                <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center text-green-600 mr-4">
                    <i class="ri-money-rupee-circle-line ri-2x"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Donated</p>
                    <h3 class="text-2xl font-bold text-gray-800">₹<?php echo number_format($total_donated); ?></h3>
                </div>
            </div>

            <div class="glass-card p-6 rounded-2xl flex items-center">
                <div class="w-14 h-14 bg-orange-100 rounded-full flex items-center justify-center text-orange-600 mr-4">
                    <i class="ri-restaurant-line ri-2x"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Food Pickups</p>
                    <h3 class="text-2xl font-bold text-gray-800"><?php echo count($food); ?></h3>
                </div>
            </div>

            <div class="glass-card p-6 rounded-2xl flex items-center">
                <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 mr-4">
                    <i class="ri-hand-heart-line ri-2x"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Volunteer Status</p>
                    <h3 class="text-xl font-bold text-gray-800">
                        <?php echo !empty($vols) ? "Active Applicant" : "Not Registered"; ?>
                    </h3>
                </div>
            </div>
        </div>

        <section class="mb-10">
            <h2 class="text-xl font-bold mb-4 flex items-center"><i class="ri-history-line mr-2"></i> Donation History</h2>
            <div class="glass-card rounded-xl overflow-hidden">
                <?php if(empty($monetary)): ?>
                    <div class="p-8 text-center text-gray-500">
                        <i class="ri-inbox-line ri-3x mb-2 block opacity-30"></i>
                        You haven't made any monetary donations yet.
                        <br><a href="donate.php" class="text-primary hover:underline mt-2 inline-block">Make a donation</a>
                    </div>
                <?php else: ?>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wider">
                                <tr>
                                    <th class="p-4">Date</th>
                                    <th class="p-4">Transaction ID</th>
                                    <th class="p-4">Method</th>
                                    <th class="p-4 text-right">Amount</th>
                                    <th class="p-4 text-center">Receipt</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <?php foreach($monetary as $m): ?>
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="p-4 text-sm text-gray-600">
                                        <?php echo date('M d, Y', strtotime($m['created_at'])); ?>
                                    </td>
                                    <td class="p-4 text-sm font-mono text-gray-500"><?php echo $m['transaction_id']; ?></td>
                                    <td class="p-4 text-sm text-gray-700 capitalize"><?php echo $m['payment_method']; ?></td>
                                    <td class="p-4 text-right font-bold text-gray-800">₹<?php echo number_format($m['amount']); ?></td>
                                    <td class="p-4 text-center">
                                        <?php if($m['tax_receipt']): ?>
                                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Yes</span>
                                        <?php else: ?>
                                            <span class="text-gray-400 text-xs">-</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <div class="grid md:grid-cols-2 gap-8">
            <section>
                <h2 class="text-xl font-bold mb-4 flex items-center"><i class="ri-shopping-basket-line mr-2"></i> Food Requests</h2>
                <div class="glass-card rounded-xl p-6 min-h-[200px]">
                    <?php if(empty($food)): ?>
                        <p class="text-gray-500 text-sm">No food pickup requests found.</p>
                    <?php else: ?>
                        <div class="space-y-4">
                            <?php foreach($food as $f): ?>
                            <div class="border-b border-gray-100 pb-4 last:border-0 last:pb-0">
                                <div class="flex justify-between items-start mb-1">
                                    <h4 class="font-bold text-gray-800"><?php echo $f['donation_type']; ?></h4>
                                    <span class="text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded"><?php echo $f['pickup_date']; ?></span>
                                </div>
                                <p class="text-sm text-gray-600 mb-1 line-clamp-2"><?php echo htmlspecialchars($f['donation_details']); ?></p>
                                <div class="text-xs text-gray-400"><i class="ri-map-pin-line"></i> <?php echo htmlspecialchars($f['city']); ?></div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </section>

            <section>
                <h2 class="text-xl font-bold mb-4 flex items-center"><i class="ri-team-line mr-2"></i> Volunteer Applications</h2>
                <div class="glass-card rounded-xl p-6 min-h-[200px]">
                    <?php if(empty($vols)): ?>
                        <p class="text-gray-500 text-sm">You haven't applied to volunteer yet.</p>
                        <a href="volunteer.php" class="text-primary text-sm font-medium hover:underline mt-2 block">Apply Now &rarr;</a>
                    <?php else: ?>
                        <?php foreach($vols as $v): ?>
                        <div class="bg-gray-50 rounded-lg p-4 mb-3">
                            <div class="flex justify-between mb-2">
                                <span class="font-bold text-gray-800"><?php echo ucfirst($v['location']); ?></span>
                                <span class="text-xs text-gray-500"><?php echo date('M d, Y', strtotime($v['created_at'])); ?></span>
                            </div>
                           <div class="text-sm text-gray-600">
    <strong>Status:</strong> 
    <?php
        // Dynamically set status class and text based on the database value
        $status = $v['status'];
        $status_text = ucfirst($status);
        
        $status_class = 'text-orange-500'; // Default to Pending
        if ($status === 'approved') {
            $status_class = 'text-green-600';
        } elseif ($status === 'rejected') {
            $status_class = 'text-red-600';
        }
    ?>
    <span class="<?= $status_class ?> font-medium">
        <?php echo htmlspecialchars($status_text); ?>
    </span>
</div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </section>
        </div>

    </main>

</body>
</html>