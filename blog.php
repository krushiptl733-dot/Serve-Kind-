<?php
// FILENAME: blog.php (Corrected: Header and Footer Included Inline)
session_start();
require_once 'connectionfile.php';

// Fetch all content items marked as 'blog' or 'story'
$blogs = [];
try {
    $stmt = $conn->prepare("SELECT * FROM content WHERE type IN ('blog', 'story') ORDER BY created_at DESC");
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $blogs[] = $row;
    }
    $stmt->close();
} catch (Exception $e) {
    $error_message = "Could not load content: Database Error.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blog & Stories - ServeKind</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>tailwind.config={theme:{extend:{colors:{primary:'#FF6B35',secondary:'#4A90E2'},borderRadius:{'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'}}}}</script>
    <link rel="stylesheet" href="style.css"> 
    <style>
        .glass {
            background: rgba(255,255,255,0.25);
            border-radius: 16px;
            box-shadow: 0 8px 32px 0 rgba(98, 105, 201, 0.18);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        .fade-in { opacity: 0; transform: translateY(20px); transition: all 0.6s ease-out; }
        .fade-in.visible { opacity: 1; transform: translateY(0); }
    </style>
</head>
<body class="bg-gray-50">

    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center">
                <a href="home.php" class="text-3xl font-['Pacifico'] text-primary mr-10">ServeKind</a>
                <nav class="hidden md:flex space-x-6">
                    <a href="home.php" class="text-gray-600 hover:text-primary transition duration-150">Home</a>
                    <a href="aboutus.php" class="text-gray-600 hover:text-primary transition duration-150">About Us</a>
                    <a href="blog.php" class="text-primary font-bold transition duration-150">Blog & Stories</a>
                    <a href="programs.php" class="text-gray-600 hover:text-primary transition duration-150">Programs</a>
                    <a href="contactus.php" class="text-gray-600 hover:text-primary transition duration-150">Contact Us</a>
                </nav>
            </div>
            <div class="flex items-center space-x-4">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="dashboard.php" class="px-4 py-2 bg-secondary text-white rounded-button hover:bg-blue-600 transition duration-150 text-sm font-medium">Dashboard</a>
                <?php else: ?>
                    <a href="home.php" class="px-4 py-2 bg-primary text-white rounded-button hover:bg-orange-700 transition duration-150 text-sm font-medium">Sign In</a> 
                <?php endif; ?>
            </div>
        </div>
    </header>
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-5xl font-extrabold text-primary text-center mb-4 fade-in">Our Latest Blogs & Stories</h1>
            <p class="text-center text-gray-600 mb-12 fade-in" style="transition-delay: 0.1s;">Insights, success stories, and updates from the field.</p>

            <?php if (isset($error_message)): ?>
                <div class="text-center text-red-500 p-4 border border-red-200 bg-red-50 rounded-lg"><?= $error_message ?></div>
            <?php elseif (empty($blogs)): ?>
                <div class="text-center text-gray-500 p-10 border border-gray-200 bg-white rounded-lg glass">
                    <i class="ri-article-line text-6xl mb-4 text-secondary"></i>
                    <p class="text-lg font-medium">No blog posts or stories found yet.</p>
                    <p class="text-sm">Check back soon for new content!</p>
                </div>
            <?php else: ?>
                <div class="grid md:grid-cols-3 gap-8">
                    <?php foreach ($blogs as $blog): ?>
                        <div class="blog-card glass rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-300 fade-in" style="transition-delay: 0.2s;">
                            <img src="<?= htmlspecialchars($blog['image_url'] ?? 'placeholder.jpg') ?>" alt="<?= htmlspecialchars($blog['title']) ?>" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <span class="text-xs font-semibold uppercase text-secondary"><?= htmlspecialchars(ucfirst($blog['type'])) ?></span>
                                <h2 class="text-xl font-bold text-gray-800 mt-2 mb-3"><?= htmlspecialchars($blog['title']) ?></h2>
                                <p class="text-gray-600 text-sm mb-4">
                                    <?= substr(strip_tags($blog['content_text']), 0, 150) ?>...
                                </p>
                                <div class="flex justify-between items-center text-xs text-gray-500 border-t pt-4">
                                    <span><i class="ri-calendar-line mr-1"></i> <?= date('M d, Y', strtotime($blog['created_at'])) ?></span>
                                    <a href="#" onclick="alert('Full content:\n\n<?= htmlspecialchars(addslashes($blog['content_text'])) ?>')" class="text-primary font-medium hover:underline">Read More <i class="ri-arrow-right-line"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p class="text-xl font-['Pacifico'] text-primary mb-3">ServeKind</p>
            <nav class="space-x-4 mb-4 text-sm">
                <a href="home.php" class="hover:text-primary transition">Home</a>
                <a href="aboutus.php" class="hover:text-primary transition">About</a>
                <a href="donate.php" class="hover:text-primary transition">Donate</a>
                <a href="contactus.php" class="hover:text-primary transition">Contact</a>
            </nav>
            <p class="text-xs text-gray-400">&copy; <?php echo date('Y'); ?> ServeKind. All rights reserved. | Built with purpose.</p>
        </div>
    </footer>
    <script>
        // Intersection Observer for Fade In
        document.addEventListener('DOMContentLoaded', function() {
            const fadeEls = document.querySelectorAll('.fade-in');
            function checkFadeIn() {
                fadeEls.forEach(el => {
                    const rect = el.getBoundingClientRect();
                    if (rect.top < window.innerHeight - 60) {
                        el.classList.add('visible');
                    }
                });
            }
            window.addEventListener('scroll', checkFadeIn);
            checkFadeIn();
        });
    </script>
</body>
</html>