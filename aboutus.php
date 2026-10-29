<!DOCTYPE html>
<html lang="en">
<head>
<title>About ServeKind</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
<script src="https://cdn.tailwindcss.com/3.4.16"></script>
<script>tailwind.config={theme:{extend:{colors:{primary:'#FF6B35',secondary:'#4A90E2'},borderRadius:{'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'}}}}</script>
<link rel="stylesheet" href="style.css"> 

    <style>
        /* Glassmorphism effect (copied from home.php) */
        .glass {
            background: rgba(255,255,255,0.25);
            border-radius: 16px;
            box-shadow: 0 8px 32px 0 rgba(98, 105, 201, 0.18);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.42);
        }

        /* Fade-in animation for sections (copied from home.php) */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }
        .fade-in.visible {
            opacity: 1;
            transform: none;
        }

        /* Modal popups smooth scale (kept for consistency if modals are added) */
        .modal-animate {
            transform: scale(0.95);
            opacity: 0;
            transition: transform 0.3s cubic-bezier(.4,0,.2,1), opacity 0.3s;
        }
        .modal-animate.visible {
            transform: scale(1);
            opacity: 1;
        }
    </style>
</head>
<body>
<!-- Header & Navigation -->
    <header class="bg-white shadow-sm sticky top-0 z-50 glass">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center">
                <a href="#" class="text-3xl font-['Pacifico'] text-primary mr-10">ServeKind</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <nav class="hidden md:flex space-x-6">
                   <a href=home.php class="text-gray-800 hover:text-primary font-medium">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
                    <a href=programs.php class="text-gray-800 hover:text-primary font-medium">Programs</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href=donate.php class="text-gray-800 hover:text-primary font-medium">Donate</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href=volunteer.php class="text-gray-800 hover:text-primary font-medium">Volunteer</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href=blog.php class="text-gray-800 hover:text-primary font-medium">Blog</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="#" class="text-gray-800 hover:text-primary font-medium">About</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href=contactus.php class="text-gray-800 hover:text-primary font-medium">Contact</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </nav>
            </div>
            </div>
        </div>
    </header>
<section class="about-servekind glass">
    <div class="container mx-auto px-4 fade-in">
        <div class="content">
            <h2 class="text-3xl font-bold mb-6">About ServeKind</h2>
            <p>
                 ServeKind is a non-profit organization dedicated to fighting hungerand food insecurity
                 across India. We believe that access to nutritious food is a fundamental right, not a 
                 privilege. Our mission is to create sustainable solutions to hunger through food distribution
                 programs, education initiatives, and community empowerment projects. We work with local 
                 communities, businesses, and government agencies to maximize our impact. 
            </p>
        </div>
    </div>
</section>
    <section id="importance" class="py-16 bg-gray-50 glass">
  <div class="container mx-auto px-4 max-w-4xl text-center fade-in">
    <h2 class="text-3xl font-bold mb-6">Why ServeKind Matters</h2>
    <p class="text-gray-700 mb-4">
      Hunger is not just about empty stomachs—it affects education, health, and future opportunities. 
      In India, millions of children and families struggle to get even one nutritious meal a day. 
      Malnutrition leads to severe health problems, poor school attendance, and limits the potential 
      of entire communities.
    </p>
    <p class="text-gray-700 mb-6">
      ServeKind steps in to break this cycle. By providing healthy meals, creating sustainable 
      community gardens, and spreading nutrition education, we help families regain their health, 
      children return to school, and communities work towards self-sufficiency. Every meal served 
      is not just food—it’s hope, dignity, and a step toward a better future.
    </p>

    <!-- Highlights in Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left mt-8">
      <div class="bg-white p-6 rounded-lg shadow glass">
        <h4 class="font-medium text-lg mb-2 text-primary">Fighting Malnutrition</h4>
        <p class="text-gray-600 text-sm">Ensuring access to nutritious meals for vulnerable families.</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow glass">
        <h4 class="font-medium text-lg mb-2 text-primary">Restoring Dignity</h4>
        <p class="text-gray-600 text-sm">No one should be hungry—we bring hope with every meal.</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow glass">
        <h4 class="font-medium text-lg mb-2 text-primary">Promoting Self-Sufficiency</h4>
        <p class="text-gray-600 text-sm">Helping communities grow their own food through training and gardens.</p>
      </div>
    </div>
  </div>
</section>

<!-- What We Do -->
<section class="what-we-do glass">
    <div class="container mx-auto px-4 fade-in">
        <div class="image">
            <img src="program1.jpg" alt="Volunteers distributing food">
        </div>
        <div class="content">
            <h2>What We Do</h2>
            <p>
                ServeKind works to end hunger by combining immediate food relief with long-term 
                sustainable solutions. We serve nutritious meals to families in need, distribute 
                emergency food kits during crises, and set up community gardens to ensure fresh, 
                home-grown food for local communities. Additionally, we empower people with 
                knowledge by teaching healthy cooking practices and affordable nutrition choices. 
                Through partnerships with local farmers, volunteers, and government agencies, we 
                aim to build a hunger-free future.
            </p>
        </div>
    </div>
</section>

<!-- How You Can Help -->
<section class="how-you-can-help glass">
    <div class="container mx-auto px-4 fade-in">
        <div class="content">
            <h2>How You Can Help</h2>
            <p>
                Your support can change lives. A small donation can feed a family, while sponsoring 
                a garden can secure food for an entire community. Volunteers are always welcome to 
                help cook meals, deliver food, or teach nutrition workshops. Businesses can join 
                hands with us through CSR projects, and anyone can help by spreading awareness 
                about our cause. Together, every little effort adds up to big change.
            </p>
        </div>
        <div class="image">
            <img src="story4.jpg" alt="Volunteers helping in garden">
        </div>
    </div>
</section>


<!-- Add small script to trigger fade-in on scroll (same as home.php) -->
<script>
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