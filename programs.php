<?php
// FILENAME: programs.php (Corrected: Header and Footer Included Inline)
session_start();
require_once 'connectionfile.php';

// Fetch all programs
$programs = [];
$categories = [];
$locations = [];

try {
    $stmt = $conn->prepare("SELECT * FROM programs ORDER BY created_at DESC");
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $programs[] = $row;
        // Collect unique categories and locations for filtering
        $categories[] = $row['category'];
        $locations[] = $row['location'];
    }
    $stmt->close();
    $categories = array_unique(array_filter($categories));
    $locations = array_unique(array_filter($locations));

} catch (Exception $e) {
    $error_message = "Could not load programs: Database Error.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>All Programs - ServeKind</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <link rel="stylesheet" href="style.css"> 
    <script>tailwind.config = {theme: {extend: {colors: {primary: '#FF6B35',secondary: '#4A90E2' }, borderRadius: {'button': '8px' }}}};</script>
</head>
<body class="bg-gray-50">

    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center">
                <a href="home.php" class="text-3xl font-['Pacifico'] text-primary mr-10">ServeKind</a>
                <nav class="hidden md:flex space-x-6">
                    <a href="home.php" class="text-gray-600 hover:text-primary transition duration-150">Home</a>
                    <a href="aboutus.php" class="text-gray-600 hover:text-primary transition duration-150">About Us</a>
                    <a href="blog.php" class="text-gray-600 hover:text-primary transition duration-150">Blog & Stories</a>
                    <a href="programs.php" class="text-primary font-bold transition duration-150">Programs</a>
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
            <h1 class="text-5xl font-extrabold text-primary text-center mb-4">Our Programs & Initiatives</h1>
            <p class="text-center text-gray-600 mb-12">Find a program near you and see how you can help.</p>

            <div class="grid lg:grid-cols-4 gap-8">
                <aside class="lg:col-span-1 p-6 bg-white rounded-xl shadow-lg h-fit sticky top-20">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Filter Programs</h3>
                    <button id="clearBtn" class="text-sm text-red-500 hover:text-red-700 mb-4 float-right">Clear All</button>

                    <div class="mb-6">
                        <label for="search-input" class="block text-sm font-medium text-gray-700 mb-2">Search by Title</label>
                        <input type="text" id="search-input" placeholder="e.g., Cooking Class" class="w-full p-2 border border-gray-300 rounded-md">
                    </div>

                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-800 mb-2">Category</h4>
                        <?php foreach ($categories as $cat): ?>
                            <div class="flex items-center mb-1">
                                <input id="cat-<?= urlencode($cat) ?>" type="checkbox" value="<?= htmlspecialchars($cat) ?>" data-filter="category" class="filter-checkbox w-4 h-4 text-primary rounded">
                                <label for="cat-<?= urlencode($cat) ?>" class="ml-2 text-sm text-gray-700"><?= htmlspecialchars($cat) ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-800 mb-2">Location</h4>
                        <?php foreach ($locations as $loc): ?>
                            <div class="flex items-center mb-1">
                                <input id="loc-<?= urlencode($loc) ?>" type="checkbox" value="<?= htmlspecialchars($loc) ?>" data-filter="location" class="filter-checkbox w-4 h-4 text-primary rounded">
                                <label for="loc-<?= urlencode($loc) ?>" class="ml-2 text-sm text-gray-700"><?= htmlspecialchars($loc) ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </aside>

                <div class="lg:col-span-3">
                    <?php if (isset($error_message)): ?>
                        <div class="text-center text-red-500 p-4 border border-red-200 bg-red-50 rounded-lg"><?= $error_message ?></div>
                    <?php elseif (empty($programs)): ?>
                        <div class="text-center text-gray-500 p-10 border border-gray-200 bg-white rounded-xl shadow-lg">
                            <i class="ri-compasses-2-line text-6xl mb-4 text-secondary"></i>
                            <p class="text-lg font-medium">No programs are currently running.</p>
                            <p class="text-sm">Please check back later or contact us for more information.</p>
                        </div>
                    <?php else: ?>
                        <div class="grid md:grid-cols-2 gap-6">
                            <?php foreach ($programs as $program): ?>
                                <div class="program-card bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition duration-300"
                                     data-title="<?= htmlspecialchars($program['title']) ?>"
                                     data-category="<?= htmlspecialchars($program['category']) ?>"
                                     data-location="<?= htmlspecialchars($program['location']) ?>">
                                    <img src="<?= htmlspecialchars($program['image_url'] ?? 'placeholder-program.jpg') ?>" alt="<?= htmlspecialchars($program['title']) ?>" class="w-full h-56 object-cover">
                                    <div class="p-6">
                                        <div class="flex justify-between items-center mb-3">
                                            <span class="text-xs font-semibold uppercase px-3 py-1 rounded-full bg-primary/10 text-primary"><?= htmlspecialchars($program['category']) ?></span>
                                            <span class="text-sm text-gray-500"><i class="ri-map-pin-line mr-1"></i> <?= htmlspecialchars($program['location']) ?></span>
                                        </div>
                                        <h2 class="text-2xl font-bold text-gray-800 mb-3"><?= htmlspecialchars($program['title']) ?></h2>
                                        <p class="text-gray-600 mb-4">
                                            <?= substr(strip_tags($program['description']), 0, 100) ?>...
                                        </p>
                                        <a href="#" onclick="alert('Full description:\n\n<?= htmlspecialchars(addslashes($program['description'])) ?>')" class="text-secondary font-medium hover:underline flex items-center">
                                            Learn More <i class="ri-arrow-right-line ml-1"></i>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div id="noResult" class="text-center text-gray-500 p-10 mt-6 hidden">
                            <i class="ri-filter-off-line text-6xl mb-4"></i>
                            <p class="text-lg font-medium">No programs match your current filters.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
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
      // Filtering Logic
      const searchInput = document.getElementById("search-input");
      const checkboxes = document.querySelectorAll(".filter-checkbox");
      const cards = document.querySelectorAll(".program-card");
      const noResult = document.getElementById("noResult");
      const clearBtn = document.getElementById("clearBtn");

      function filterPrograms() {
        const searchText = searchInput.value.toLowerCase();
        const selectedCategories = [...checkboxes].filter(cb => cb.checked && cb.dataset.filter === "category").map(cb => cb.value);
        const selectedLocations = [...checkboxes].filter(cb => cb.checked && cb.dataset.filter === "location").map(cb => cb.value);

        let visibleCount = 0;

        cards.forEach(card => {
          const title = card.dataset.title.toLowerCase();
          const category = card.dataset.category;
          const location = card.dataset.location;

          const matchesSearch = title.includes(searchText);
          const matchesCategory = selectedCategories.length === 0 || selectedCategories.includes(category);
          const matchesLocation = selectedLocations.length === 0 || selectedLocations.includes(location);

          if (matchesSearch && matchesCategory && matchesLocation) {
            card.style.display = "block";
            visibleCount++;
          } else {
            card.style.display = "none";
          }
        });

        noResult.classList.toggle("hidden", visibleCount > 0);
      }

      searchInput.addEventListener("input", filterPrograms);
      checkboxes.forEach(cb => cb.addEventListener("change", filterPrograms));
      clearBtn.addEventListener("click", () => {
        searchInput.value = "";
        checkboxes.forEach(cb => cb.checked = false);
        filterPrograms();
      });
      
      // Run filter on load to ensure proper state
      document.addEventListener('DOMContentLoaded', filterPrograms);
    </script>
</body>
</html>