<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>ServeKind - Feeding Hope, Serving Humanity</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>tailwind.config={theme:{extend:{colors:{primary:'#FF6B35',secondary:'#4A90E2'},borderRadius:{'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'}}}}</script>
     <link rel="stylesheet" href="style.css"> 
    <style>
/* Input error state */
.input-error {
    border-color: #ef4444 !important;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1) !important;
}
        /* Glassmorphism effect */
        .glass {
            background: rgba(255,255,255,0.25);
            border-radius: 16px;
            box-shadow: 0 8px 32px 0 rgba(98, 105, 201, 0.18);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.42);
        }
        /* Slide-in animation for impact cards */
        .slide-in {
            opacity: 0;
            transform: translateX(-60px);
            transition: opacity 0.8s cubic-bezier(.4,0,.2,1), transform 0.8s cubic-bezier(.4,0,.2,1);
        }
        .slide-in.visible {
            opacity: 1;
            transform: none;
        }

        /* Tab box / responsive tab buttons (glassy box effect, fits screen) */
        .tab-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem;
            box-sizing: border-box;
        }

        .tab-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }

        .tab-button {
            background: rgba(255,255,255,0.65);
            border: 1px solid rgba(255,255,255,0.18);
            padding: 0.5rem 0.9rem;
            border-radius: 12px;
            cursor: pointer;
            color: #1f2937; /* gray-800 */
            font-weight: 600;
            transition: transform .12s ease, box-shadow .12s ease, background .12s ease;
            box-shadow: 0 6px 18px rgba(31,38,135,0.04);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
        }

        .tab-button.active {
            background: rgba(255,107,53,1); /* primary */
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(255,107,53,0.14);
        }

        /* Panel / content box that fits the screen width inside its container */
        .tab-content,
        .blog-tab-content,
        .tab-panel {
            width: 100%;
            background: linear-gradient( rgba(255,255,255,0.6), rgba(255,255,255,0.5) );
            border-radius: 14px;
            padding: 1rem;
            box-shadow: 0 10px 30px rgba(31,38,135,0.06);
            border: 1px solid rgba(255,255,255,0.18);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            box-sizing: border-box;
        }

        /* Small-screen adjustments so buttons and panels fill available width */
        @media (max-width: 768px) {
            .tab-buttons { gap: 0.4rem; }
            .tab-button {
                flex: 1 1 auto;
                text-align: center;
                padding: 0.6rem 0.6rem;
                min-width: 0;
            }
            .tab-button + .tab-button { margin-left: 0; }
            .tab-content,
            .blog-tab-content,
            .tab-panel {
                padding: 0.75rem;
            }
        }

        /* Optionally ensure any container using .tab-container inherits the page glass look */
        .tab-container .tab-content.glass {
            /* when markup adds both classes, keep stronger glass styling */
            background: rgba(255,255,255,0.22);
        }
        /* Fade-in animation for sections */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }
        .fade-in.visible {
            opacity: 1;
            transform: none;
        }
        /* Modal popups smooth scale */
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
<body class="font-sans text-gray-800 bg-gray-50">
    <!-- Header & Navigation -->
    <header class="bg-white shadow-sm sticky top-0 z-50 glass">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center">
                <a href="#" class="text-3xl font-['Pacifico'] text-primary mr-10">ServeKind</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <nav class="hidden md:flex space-x-6">
                    <a href="#" class="text-gray-800 hover:text-primary font-medium">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                    <a href=programs.php class="text-gray-800 hover:text-primary font-medium">Programs</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href=donate.php class="text-gray-800 hover:text-primary font-medium">Donate</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href=volunteer.php class="text-gray-800 hover:text-primary font-medium">Volunteer</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href=blog.php class="text-gray-800 hover:text-primary font-medium">Blog</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href=aboutus.php class="text-gray-800 hover:text-primary font-medium">About</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href=contactus.php class="text-gray-800 hover:text-primary font-medium">Contact</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </nav>
            </div>
               
    <?php if (isset($_SESSION['user_name'])): ?>
    <div class="flex items-center space-x-4">
        <a href="dashboard.php" 
           class="px-6 py-3 bg-primary text-white rounded-button hover:bg-primary-dark transition">
           <?= htmlspecialchars($_SESSION['user_name']); ?>
        </a>
    </div>
<?php else: ?>
    <button id="join-us-btn"
        class="px-6 py-3 bg-primary text-white rounded-button hover:bg-opacity-90 transition">
        Join Us
    </button>
<?php endif; ?>
            </div>
        </div>
    </header>

    <!-- Hero Banner Section -->
    <section class="hero-slider relative glass">
        <div class="slide active" style="background-image: url('banner1.jpg')"></div>
        <div class="slide" style="background-image: url('banner2.jpg')"></div>
        <div class="slide" style="background-image: url('banner3.jpg')"></div>
        <div class="hero-overlay"></div>
    <div class="container mx-auto px-4 h-full flex items-center hero-content fade-in">
            <div class="max-w-2xl text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4"> <i>Feeding Hope, Serving Humanity</i></h1>
                <p class="text-xl mb-8">Join us in our mission to fight hunger and create a world where everyone has access to nutritious food. Together, we can make a difference.</p>
                <div class="flex flex-wrap gap-4">
                    <a href="donate.php" class="bg-primary hover:bg-opacity-90 text-white px-6 py-3 rounded-button font-medium text-lg shadow-lg transition duration-300 whitespace-nowrap">Donate Now</a>
                    <a href="volunteer.php" class="bg-white hover:bg-opacity-90 text-primary px-6 py-3 rounded-button font-medium text-lg shadow-lg transition duration-300 whitespace-nowrap">Become a Volunteer</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Impact Statistics -->
    <section class="py-16 bg-white glass">
    <div class="container mx-auto px-4 fade-in">
            <h2 class="text-3xl font-bold text-center mb-12">Our Impact</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-gray-50 rounded-lg p-8 text-center shadow-sm hover:shadow-md transition duration-300 slide-in">
                    <div class="w-16 h-16 mx-auto mb-4 text-primary flex items-center justify-center">
                        <i class="ri-restaurant-line ri-3x"></i>
                    </div>
                    <h3 class="text-4xl font-bold text-primary mb-2"><span class="counter-value" data-target="25000">0</span>+</h3>
                    <p class="text-gray-600">Meals Served</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-8 text-center shadow-sm hover:shadow-md transition duration-300 slide-in">
                    <div class="w-16 h-16 mx-auto mb-4 text-primary flex items-center justify-center">
                        <i class="ri-team-line ri-3x"></i>
                    </div>
                    <h3 class="text-4xl font-bold text-primary mb-2"><span class="counter-value" data-target="500">0</span>+</h3>
                    <p class="text-gray-600">Active Volunteers</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-8 text-center shadow-sm hover:shadow-md transition duration-300 slide-in">
                    <div class="w-16 h-16 mx-auto mb-4 text-primary flex items-center justify-center">
                        <i class="ri-community-line ri-3x"></i>
                    </div>
                    <h3 class="text-4xl font-bold text-primary mb-2"><span class="counter-value" data-target="120">0</span>+</h3>
                    <p class="text-gray-600">Communities Reached</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-8 text-center shadow-sm hover:shadow-md transition duration-300 slide-in">
                    <div class="w-16 h-16 mx-auto mb-4 text-primary flex items-center justify-center">
                        <i class="ri-heart-line ri-3x"></i>
                    </div>
                    <h3 class="text-4xl font-bold text-primary mb-2"><span class="counter-value" data-target="1200">0</span>+</h3>
                    <p class="text-gray-600">Lives Impacted</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about" class="py-16 bg-gray-50 glass">
    <div class="container mx-auto px-4 fade-in">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2">
                    <img src="about.jpg" alt="About ServeKind" class="rounded-lg shadow-lg w-full h-auto object-cover">
                </div>
                <div class="lg:w-1/2">
                    <h2 class="text-3xl font-bold mb-6">About ServeKind</h2>
                    <p class="text-gray-700 mb-4">Founded in 2015, ServeKind is a non-profit organization dedicated to fighting hunger and food insecurity across India. We believe that access to nutritious food is a fundamental right, not a privilege.</p>
                    <p class="text-gray-700 mb-6">Our mission is to create sustainable solutions to hunger through food distribution programs, education initiatives, and community empowerment projects. We work with local communities, businesses, and government agencies to maximize our impact.</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                        <div class="flex items-start">
                            <div class="w-10 h-10 flex-shrink-0 text-primary flex items-center justify-center">
                                <i class="ri-check-line ri-2x"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-medium text-lg">Food Distribution</h4>
                                <p class="text-gray-600">Providing meals to those in need</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-10 h-10 flex-shrink-0 text-primary flex items-center justify-center">
                                <i class="ri-check-line ri-2x"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-medium text-lg">Education</h4>
                                <p class="text-gray-600">Teaching nutrition and cooking skills</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-10 h-10 flex-shrink-0 text-primary flex items-center justify-center">
                                <i class="ri-check-line ri-2x"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-medium text-lg">Community Gardens</h4>
                                <p class="text-gray-600">Building sustainable food sources</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-10 h-10 flex-shrink-0 text-primary flex items-center justify-center">
                                <i class="ri-check-line ri-2x"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="font-medium text-lg">Advocacy</h4>
                                <p class="text-gray-600">Fighting for food security policies</p>
                            </div>
                        </div>
                    </div>
                    <a href=aboutus.php class="inline-block bg-primary hover:bg-opacity-90 text-white px-6 py-3 rounded-button font-medium transition duration-300 whitespace-nowrap">Learn More About Us</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs Showcase -->
    <section id="programs" class="py-8 bg-gray-50 glass">
    <div class="container mx-auto px-4 fade-in">
            <h2 class="text-3xl font-bold text-center mb-2">Our Programs</h2>
            <p class="text-gray-600 text-center max-w-3xl mx-auto mb-4">We run various programs to address hunger and food insecurity across communities.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <img src="program1.jpg" alt="Daily Meal Program" class="w-full h-52 object-cover object-top">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-1">Daily Meal Program</h3>
                        <p class="text-gray-600 mb-2">Providing nutritious meals to homeless and underprivileged communities across urban centers.</p>
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex items-center justify-center text-primary">
                                    <i class="ri-restaurant-line ri-lg"></i>
                                </div>
                                <span class="ml-2 text-gray-700">2,000+ meals daily</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex items-center justify-center text-primary">
                                    <i class="ri-map-pin-line ri-lg"></i>
                                </div>
                                <span class="ml-2 text-gray-700">15 locations</span>
                            </div>
                        </div>
                        <a href="#" class="inline-block bg-primary hover:bg-opacity-90 text-white px-4 py-2 rounded-button font-medium transition duration-300 whitespace-nowrap">Learn More</a>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <img src="program2.jpg" alt="Community Gardens" class="w-full h-52 object-cover object-top">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-1">Community Gardens</h3>
                        <p class="text-gray-600 mb-2">Establishing sustainable food sources in communities through shared garden spaces and education.</p>
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex items-center justify-center text-primary">
                                    <i class="ri-plant-line ri-lg"></i>
                                </div>
                                <span class="ml-2 text-gray-700">35 gardens</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex items-center justify-center text-primary">
                                    <i class="ri-user-line ri-lg"></i>
                                </div>
                                <span class="ml-2 text-gray-700">1,200+ participants</span>
                            </div>
                        </div>
                        <a href="#" class="inline-block bg-primary hover:bg-opacity-90 text-white px-4 py-2 rounded-button font-medium transition duration-300 whitespace-nowrap">Learn More</a>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <img src="program3.jpg" alt="Nutrition Education" class="w-full h-52 object-cover object-top">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-1">Nutrition Education</h3>
                        <p class="text-gray-600 mb-2">Teaching healthy cooking and eating habits to families to improve long-term health outcomes.</p>
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex items-center justify-center text-primary">
                                    <i class="ri-book-open-line ri-lg"></i>
                                </div>
                                <span class="ml-2 text-gray-700">50+ workshops monthly</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex items-center justify-center text-primary">
                                    <i class="ri-group-line ri-lg"></i>
                                </div>
                                <span class="ml-2 text-gray-700">5,000+ beneficiaries</span>
                            </div>
                        </div>
                        <a href="#" class="inline-block bg-primary hover:bg-opacity-90 text-white px-4 py-2 rounded-button font-medium transition duration-300 whitespace-nowrap">Learn More</a>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <img src="program4.jpg" alt="School Meal Program" class="w-full h-52 object-cover object-top">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-1">School Meal Program</h3>
                        <p class="text-gray-600 mb-2">Providing nutritious lunches to children in underprivileged schools to support learning.</p>
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex items-center justify-center text-primary">
                                    <i class="ri-school-line ri-lg"></i>
                                </div>
                                <span class="ml-2 text-gray-700">75 schools</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex items-center justify-center text-primary">
                                    <i class="ri-user-smile-line ri-lg"></i>
                                </div>
                                <span class="ml-2 text-gray-700">15,000+ children</span>
                            </div>
                        </div>
                        <a href="#" class="inline-block bg-primary hover:bg-opacity-90 text-white px-4 py-2 rounded-button font-medium transition duration-300 whitespace-nowrap">Learn More</a>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <img src="program5.jpg" alt="Food Bank Network" class="w-full h-52 object-cover object-top">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-1">Food Bank Network</h3>
                        <p class="text-gray-600 mb-2">Collecting, storing, and distributing food donations to partner organizations and communities in need.</p>
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex items-center justify-center text-primary">
                                    <i class="ri-store-2-line ri-lg"></i>
                                </div>
                                <span class="ml-2 text-gray-700">10 food banks</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex items-center justify-center text-primary">
                                    <i class="ri-building-line ri-lg"></i>
                                </div>
                                <span class="ml-2 text-gray-700">200+ partner NGOs</span>
                            </div>
                        </div>
                        <a href="#" class="inline-block bg-primary hover:bg-opacity-90 text-white px-4 py-2 rounded-button font-medium transition duration-300 whitespace-nowrap">Learn More</a>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <img src="program6.jpg" alt="Senior Nutrition" class="w-full h-52 object-cover object-top">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-1">Senior Nutrition</h3>
                        <p class="text-gray-600 mb-2">Delivering meals to elderly individuals who are unable to cook or access food independently.</p>
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex items-center justify-center text-primary">
                                    <i class="ri-user-heart-line ri-lg"></i>
                                </div>
                                <span class="ml-2 text-gray-700">3,500+ seniors</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex items-center justify-center text-primary">
                                    <i class="ri-home-heart-line ri-lg"></i>
                                </div>
                                <span class="ml-2 text-gray-700">25 care centers</span>
                            </div>
                        </div>
                        <a href="#" class="inline-block bg-primary hover:bg-opacity-90 text-white px-4 py-2 rounded-button font-medium transition duration-300 whitespace-nowrap">Learn More</a>
                    </div>
                </div>
            </div>
            <br>
            <div class="text-center mt-4">
                <a href=programs.php class="inline-block bg-white border border-primary text-primary hover:bg-primary hover:text-white transition duration-300 px-6 py-3 rounded-button font-medium whitespace-nowrap">View All Programs</a>
            </div>
        </div>
    </section>
    <!-- Testimonials -->
    <section class="py-16 bg-gray-50 glass">
    <div class="container mx-auto px-4 fade-in">
            <h2 class="text-3xl font-bold text-center mb-4">What People Say</h2>
            <p class="text-gray-600 text-center max-w-3xl mx-auto mb-12">Hear from our volunteers, donors, and the communities we serve.</p>
            
            <div class="testimonial-slider relative h-80 max-w-4xl mx-auto">
                <div class="testimonial-slide active">
                    <div class="bg-white p-8 rounded-lg shadow-md">
                        <div class="flex items-center mb-6">
                            <img src="priyasharma.jpg" alt="Priya Sharma" class="w-16 h-16 rounded-full object-cover mr-4">
                            <div>
                                <h4 class="font-bold text-lg">Priya Sharma</h4>
                                <p class="text-gray-600">Volunteer for 3 years</p>
                            </div>
                        </div>
                        <div class="mb-6">
                            <div class="flex text-yellow-400 mb-2">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                            </div>
                            <p class="text-gray-700 italic">"Volunteering with ServeKind has been one of the most rewarding experiences of my life. Seeing the direct impact we make in people's lives every day gives me immense satisfaction. The team is like family, and the organization is incredibly well-managed."</p>
                        </div>
                        <div class="flex justify-end">
                            <div class="w-6 h-6 flex items-center justify-center text-primary">
                                <i class="ri-double-quotes-r"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-slide">
                    <div class="bg-white p-8 rounded-lg shadow-md">
                        <div class="flex items-center mb-6">
                            <img src="rajeshmehta.jpg" alt="Rajesh Mehta" class="w-16 h-16 rounded-full object-cover mr-4">
                            <div>
                                <h4 class="font-bold text-lg">Rajesh Mehta</h4>
                                <p class="text-gray-600">Monthly Donor</p>
                            </div>
                        </div>
                        <div class="mb-6">
                            <div class="flex text-yellow-400 mb-2">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                            </div>
                            <p class="text-gray-700 italic">"I've been donating to ServeKind for over two years now, and I'm consistently impressed by their transparency and the impact they're making. The regular updates I receive show exactly how my contributions are helping communities in need."</p>
                        </div>
                        <div class="flex justify-end">
                            <div class="w-6 h-6 flex items-center justify-center text-primary">
                                <i class="ri-double-quotes-r"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-slide">
                    <div class="bg-white p-8 rounded-lg shadow-md">
                        <div class="flex items-center mb-6">
                            <img src="ananyapatel.jpg" alt="Ananya Patel" class="w-16 h-16 rounded-full object-cover mr-4">
                            <div>
                                <h4 class="font-bold text-lg">Ananya Patel</h4>
                                <p class="text-gray-600">Community Garden Participant</p>
                            </div>
                        </div>
                        <div class="mb-6">
                            <div class="flex text-yellow-400 mb-2">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                            </div>
                            <p class="text-gray-700 italic">"The community garden program has transformed our neighborhood. Not only do we now have access to fresh vegetables, but we've also built stronger community bonds. The ServeKind team provided excellent training and ongoing support."</p>
                        </div>
                        <div class="flex justify-end">
                            <div class="w-6 h-6 flex items-center justify-center text-primary">
                                <i class="ri-double-quotes-r"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-center mt-6 space-x-2">
                <button class="testimonial-dot active w-3 h-3 rounded-full bg-gray-300 focus:outline-none" data-index="0"></button>
                <button class="testimonial-dot w-3 h-3 rounded-full bg-gray-300 focus:outline-none" data-index="1"></button>
                <button class="testimonial-dot w-3 h-3 rounded-full bg-gray-300 focus:outline-none" data-index="2"></button>
            </div>
        </div>
    </section>

    <!-- Updates & News -->
    <section class="py-16 bg-gray-50 glass">
    <div class="container mx-auto px-4 fade-in">
            <h2 class="text-3xl font-bold text-center mb-12">Latest Updates</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition duration-300">
                    <div class="p-4 border-b border-gray-100">
                        <span class="text-xs font-medium bg-blue-100 text-blue-600 px-3 py-1 rounded-full">News</span>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2">ServeKind Expands to 5 New Cities</h3>
                        <p class="text-gray-600 text-sm mb-3">Our organization is expanding operations to Jaipur, Ahmedabad, Lucknow, Bhopal, and Chandigarh this month.</p>
                        <div class="flex items-center text-gray-500 text-sm">
                            <div class="w-4 h-4 flex items-center justify-center mr-1">
                                <i class="ri-calendar-line"></i>
                            </div>
                            <span>July 5, 2025</span>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition duration-300">
                    <div class="p-4 border-b border-gray-100">
                        <span class="text-xs font-medium bg-green-100 text-green-600 px-3 py-1 rounded-full">Event</span>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2">Annual Food Security Conference</h3>
                        <p class="text-gray-600 text-sm mb-3">Join us for our annual conference bringing together experts, volunteers, and community leaders.</p>
                        <div class="flex items-center text-gray-500 text-sm">
                            <div class="w-4 h-4 flex items-center justify-center mr-1">
                                <i class="ri-calendar-line"></i>
                            </div>
                            <span>August 12-14, 2025</span>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition duration-300">
                    <div class="p-4 border-b border-gray-100">
                        <span class="text-xs font-medium bg-purple-100 text-purple-600 px-3 py-1 rounded-full">Partnership</span>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2">New Corporate Partnership with Tata Group</h3>
                        <p class="text-gray-600 text-sm mb-3">We're excited to announce a major partnership to expand our school meal programs nationwide.</p>
                        <div class="flex items-center text-gray-500 text-sm">
                            <div class="w-4 h-4 flex items-center justify-center mr-1">
                                <i class="ri-calendar-line"></i>
                            </div>
                            <span>June 30, 2025</span>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition duration-300">
                    <div class="p-4 border-b border-gray-100">
                        <span class="text-xs font-medium bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full">Milestone</span>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2">25 Million Meals Served</h3>
                        <p class="text-gray-600 text-sm mb-3">We've reached a significant milestone in our mission to fight hunger across India.</p>
                        <div class="flex items-center text-gray-500 text-sm">
                            <div class="w-4 h-4 flex items-center justify-center mr-1">
                                <i class="ri-calendar-line"></i>
                            </div>
                            <span>June 25, 2025</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-12">
                <h3 class="text-2xl font-bold mb-6">Upcoming Events</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden p-6 flex">
                        <div class="w-16 h-16 bg-primary bg-opacity-10 rounded-lg flex flex-col items-center justify-center mr-4 flex-shrink-0">
                            <span class="text-primary font-bold text-xl">15</span>
                            <span class="text-primary text-sm">July</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-1">Volunteer Orientation</h4>
                            <p class="text-gray-600 text-sm mb-2">New volunteer training session for those interested in joining our team.</p>
                            <div class="flex items-center text-gray-500 text-sm">
                                <div class="w-4 h-4 flex items-center justify-center mr-1">
                                    <i class="ri-map-pin-line"></i>
                                </div>
                                <span>Delhi HQ & Online</span>
                                <div class="w-4 h-4 flex items-center justify-center ml-4 mr-1">
                                    <i class="ri-time-line"></i>
                                </div>
                                <span>10:00 AM - 12:00 PM</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden p-6 flex">
                        <div class="w-16 h-16 bg-primary bg-opacity-10 rounded-lg flex flex-col items-center justify-center mr-4 flex-shrink-0">
                            <span class="text-primary font-bold text-xl">22</span>
                            <span class="text-primary text-sm">July</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-1">Community Garden Workshop</h4>
                            <p class="text-gray-600 text-sm mb-2">Learn sustainable gardening techniques for urban environments.</p>
                            <div class="flex items-center text-gray-500 text-sm">
                                <div class="w-4 h-4 flex items-center justify-center mr-1">
                                    <i class="ri-map-pin-line"></i>
                                </div>
                                <span>Mumbai Community Center</span>
                                <div class="w-4 h-4 flex items-center justify-center ml-4 mr-1">
                                    <i class="ri-time-line"></i>
                                </div>
                                <span>4:00 PM - 6:00 PM</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden p-6 flex">
                        <div class="w-16 h-16 bg-primary bg-opacity-10 rounded-lg flex flex-col items-center justify-center mr-4 flex-shrink-0">
                            <span class="text-primary font-bold text-xl">29</span>
                            <span class="text-primary text-sm">July</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-1">Food Donation Drive</h4>
                            <p class="text-gray-600 text-sm mb-2">Major food collection event at multiple locations across Bangalore.</p>
                            <div class="flex items-center text-gray-500 text-sm">
                                <div class="w-4 h-4 flex items-center justify-center mr-1">
                                    <i class="ri-map-pin-line"></i>
                                </div>
                                <span>Multiple Locations</span>
                                <div class="w-4 h-4 flex items-center justify-center ml-4 mr-1">
                                    <i class="ri-time-line"></i>
                                </div>
                                <span>9:00 AM - 5:00 PM</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden p-6 flex">
                        <div class="w-16 h-16 bg-primary bg-opacity-10 rounded-lg flex flex-col items-center justify-center mr-4 flex-shrink-0">
                            <span class="text-primary font-bold text-xl">5</span>
                            <span class="text-primary text-sm">Aug</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-1">Nutrition Education Seminar</h4>
                            <p class="text-gray-600 text-sm mb-2">Expert-led session on nutrition basics for community health workers.</p>
                            <div class="flex items-center text-gray-500 text-sm">
                                <div class="w-4 h-4 flex items-center justify-center mr-1">
                                    <i class="ri-map-pin-line"></i>
                                </div>
                                <span>Hyderabad Office & Online</span>
                                <div class="w-4 h-4 flex items-center justify-center ml-4 mr-1">
                                    <i class="ri-time-line"></i>
                                </div>
                                <span>2:00 PM - 4:00 PM</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trust Elements -->
    <section class="py-16 bg-white glass">
    <div class="container mx-auto px-4 fade-in">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl font-bold text-center mb-12">Why Trust Us</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-primary bg-opacity-10 rounded-full flex items-center justify-center flex-shrink-0 mr-4">
                            <div class="w-6 h-6 flex items-center justify-center text-primary">
                                <i class="ri-shield-check-line"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-2">Transparency</h3>
                            <p class="text-gray-600">We publish detailed financial reports and impact assessments. Every donation is tracked and accounted for.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-primary bg-opacity-10 rounded-full flex items-center justify-center flex-shrink-0 mr-4">
                            <div class="w-6 h-6 flex items-center justify-center text-primary">
                                <i class="ri-award-line"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-2">Certifications</h3>
                            <p class="text-gray-600">Registered under the Indian Trusts Act and FCRA approved. Awarded 'Gold' standard by GuideStar India.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-primary bg-opacity-10 rounded-full flex items-center justify-center flex-shrink-0 mr-4">
                            <div class="w-6 h-6 flex items-center justify-center text-primary">
                                <i class="ri-team-line"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-2">Expert Team</h3>
                            <p class="text-gray-600">Our team includes nutritionists, community development experts, and experienced non-profit professionals.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-primary bg-opacity-10 rounded-full flex items-center justify-center flex-shrink-0 mr-4">
                            <div class="w-6 h-6 flex items-center justify-center text-primary">
                                <i class="ri-secure-payment-line"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-2">Secure Donations</h3>
                            <p class="text-gray-600">All transactions are encrypted and processed through secure payment gateways with multiple verification steps.</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-12 p-6 bg-gray-50 rounded-lg">
                    <h3 class="text-xl font-bold mb-4 text-center">Our Partners & Supporters</h3>
                    <div class="flex flex-wrap justify-center gap-8">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 flex items-center justify-center text-gray-700">
                                <i class="ri-building-4-line ri-3x"></i>
                            </div>
                            <span class="text-sm font-medium mt-2">Tata Trusts</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 flex items-center justify-center text-gray-700">
                                <i class="ri-bank-line ri-3x"></i>
                            </div>
                            <span class="text-sm font-medium mt-2">HDFC Bank</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 flex items-center justify-center text-gray-700">
                                <i class="ri-government-line ri-3x"></i>
                            </div>
                            <span class="text-sm font-medium mt-2">Ministry of Social Justice</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 flex items-center justify-center text-gray-700">
                                <i class="ri-global-line ri-3x"></i>
                            </div>
                            <span class="text-sm font-medium mt-2">United Nations WFP</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 flex items-center justify-center text-gray-700">
                                <i class="ri-store-2-line ri-3x"></i>
                            </div>
                            <span class="text-sm font-medium mt-2">Reliance Foundation</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white pt-16 pb-8">
    <div class="container mx-auto px-4 fade-in">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div>
                    <h3 class="text-2xl font-['Pacifico'] text-white mb-6">ServeKind</h3>
                    <p class="text-gray-300 mb-6">Feeding hope and serving humanity. We're committed to creating a hunger-free world through sustainable solutions and community empowerment.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center text-gray-300 hover:bg-primary hover:text-white transition duration-300">
                            <i class="ri-facebook-fill"></i>
                        </a>
                        <a href="#" class="w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center text-gray-300 hover:bg-primary hover:text-white transition duration-300">
                            <i class="ri-twitter-x-fill"></i>
                        </a>
                        <a href="#" class="w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center text-gray-300 hover:bg-primary hover:text-white transition duration-300">
                            <i class="ri-instagram-line"></i>
                        </a>
                        <a href="#" class="w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center text-gray-300 hover:bg-primary hover:text-white transition duration-300">
                            <i class="ri-linkedin-fill"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-lg font-bold mb-6">Quick Links</h4>
                        <ul class="space-y-1">
                        <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Home</a></li>
                        <li><a href="aboutus.php" class="text-gray-300 hover:text-white transition duration-300">About</a></li>
                        <li><a href="programs.php" class="text-gray-300 hover:text-white transition duration-300">Our Programs</a></li>
                        <li><a href="donate.php" class="text-gray-300 hover:text-white transition duration-300">Donate</a></li>
                        <li><a href="volunteer.php" class="text-gray-300 hover:text-white transition duration-300">Volunteer</a></li>
                        <li><a href="blog.php" class="text-gray-300 hover:text-white transition duration-300">Blog & Stories</a></li>
                        <li><a href="contactus.php" class="text-gray-300 hover:text-white transition duration-300">Contact Us</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-bold mb-6">Programs</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Daily Meal Program</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Community Gardens</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Nutrition Education</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">School Meal Program</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Food Bank Network</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Senior Nutrition</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-bold mb-6">Legal & Support</h4>
                    <ul class="space-y-3">
                        <li><a href="pp.php" class="text-gray-300 hover:text-white transition duration-300">Privacy Policy</a></li>
                        <li><a href="terms.php" class="text-gray-300 hover:text-white transition duration-300">Terms of Service</a></li>
                        <li><a href="dpolicy.php" class="text-gray-300 hover:text-white transition duration-300">Donation Policy</a></li>
                        <li><a href="taxpolicy.php" class="text-gray-300 hover:text-white transition duration-300">Tax Information</a></li>
                        <li><a href="freport.php" class="text-gray-300 hover:text-white transition duration-300">Financial Reports</a></li>
                        <li><a href="FAQ.php" class="text-gray-300 hover:text-white transition duration-300">FAQ</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="pt-8 border-t border-gray-700 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm mb-4 md:mb-0">&copy; 2025 ServeKind. All rights reserved. Registered Charity No. 1234567890</p>
                <div class="flex space-x-4">
                    <div class="w-8 h-8 flex items-center justify-center text-gray-400">
                        <i class="ri-visa-line"></i>
                    </div>
                    <div class="w-8 h-8 flex items-center justify-center text-gray-400">
                        <i class="ri-mastercard-line"></i>
                    </div>
                    <div class="w-8 h-8 flex items-center justify-center text-gray-400">
                        <i class="ri-paypal-line"></i>
                    </div>
                    <div class="w-8 h-8 flex items-center justify-center text-gray-400">
                        <i class="ri-secure-payment-line"></i>
                    </div>
                </div>
            </div>
        </div>
    </footer>

     <!-- Sign In / Sign Up Modal -->
<div id="sign-in-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 modal-animate glass">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-2xl font-bold" id="modal-title">Sign In</h3>
                <button id="close-sign-in" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                    <i class="ri-close-line ri-lg"></i>
                </button>
            </div>

            <!-- Sign In Form -->
            <form id="sign-in-form" method="post" action="signin.php" class="space-y-4">
                <input type="email" placeholder="Email Address"
                    class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary">
                
                <div class="relative">
                    <input type="password" placeholder="Password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary pr-10"
                        id="signin-password">

                </div>

                <button type="submit"
                    class="w-full bg-primary hover:bg-opacity-90 text-white py-3 rounded-button font-medium transition duration-300">
                    Sign In
                </button>
            </form>

            <!-- Sign Up Form (hidden by default) -->
            <form id="sign-up-form" method="post" action="signup.php" class="space-y-4 hidden">
                <input type="text" placeholder="Full Name"
                    class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary">
                <input type="email" placeholder="Email Address"
                    class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary">
                
                <div class="relative">
                    <input type="password" placeholder="Password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary pr-10"
                        id="signup-password">
                </div>

                <button type="submit"
                    class="w-full bg-primary hover:bg-opacity-90 text-white py-3 rounded-button font-medium transition duration-300">
                    Sign Up
                </button>
            </form>

            <p class="text-center text-gray-600 mt-4">
                <span id="toggle-text">Don’t have an account?</span>
                <button id="toggle-form" class="text-primary hover:underline font-medium">Sign Up</button>
            </p>
        </div>
    </div>
</div>

<!-- Thank You Modal (For Sign In / Sign Up) -->
<div id="auth-thank-you-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 modal-animate glass">
        <div class="p-6 text-center">
            <div class="w-20 h-20 bg-primary bg-opacity-10 rounded-full flex items-center justify-center mx-auto mb-6">
                <div class="w-10 h-10 flex items-center justify-center text-primary">
                    <i class="ri-user-smile-line ri-2x"></i>
                </div>
            </div>
            <h3 class="text-2xl font-bold mb-2" id="auth-thank-you-title">Welcome!</h3>
            <p class="text-gray-600 mb-6" id="auth-thank-you-message">
                You have successfully signed in.
            </p>
            <button id="close-auth-thank-you" 
                class="bg-primary hover:bg-opacity-90 text-white px-4 py-2 rounded-button transition duration-300">
                Close
            </button>
        </div>
    </div>
</div>
    <!-- Scripts -->
<script id="hero-slider-script">
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.slide');
        if (slides.length > 0) {
            let currentSlide = 0;
            
            function nextSlide() {
                slides[currentSlide].classList.remove('active');
                currentSlide = (currentSlide + 1) % slides.length;
                slides[currentSlide].classList.add('active');
            }
            
            // Start slider only if we have slides
            setInterval(nextSlide, 5000);
        }
    });
</script>

<script>
// Password toggle functionality
function setupPasswordToggle() {
    const passwordInputs = document.querySelectorAll('input[type="password"]');
    
    passwordInputs.forEach(input => {
        // Check if toggle already exists
        if (input.parentElement.querySelector('.password-toggle')) return;
        
        const toggleBtn = document.createElement('button');
        toggleBtn.type = 'button';
        toggleBtn.className = 'password-toggle absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700';
        toggleBtn.innerHTML = '<i class="ri-eye-line"></i>';
        
        const parent = input.parentElement;
        if (parent.classList.contains('relative')) {
            parent.appendChild(toggleBtn);
            
            toggleBtn.addEventListener('click', () => {
                const type = input.type === 'password' ? 'text' : 'password';
                input.type = type;
                toggleBtn.innerHTML = type === 'password' ? 
                    '<i class="ri-eye-line"></i>' : 
                    '<i class="ri-eye-off-line"></i>';
            });
        }
    });
}

// Slide-in animation for impact cards
document.addEventListener('DOMContentLoaded', function() {
    const impactCards = document.querySelectorAll('.slide-in');
    if (impactCards.length === 0) return;
    
    function checkSlideIn() {
        impactCards.forEach((card, i) => {
            const rect = card.getBoundingClientRect();
            if (rect.top < window.innerHeight - 60) {
                setTimeout(() => card.classList.add('visible'), i * 120);
            }
        });
    }
    window.addEventListener('scroll', checkSlideIn);
    checkSlideIn();
});

// Fade-in animation on scroll
document.addEventListener('DOMContentLoaded', function() {
    const fadeEls = document.querySelectorAll('.fade-in');
    if (fadeEls.length === 0) return;
    
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

// Modal animation
function showModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        const box = modal.querySelector('.modal-animate');
        if (box) {
            box.classList.add('visible');
        }
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }
}

function hideModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        const box = modal.querySelector('.modal-animate');
        if (box) {
            box.classList.remove('visible');
        }
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = ''; // Restore scrolling
        }, 250);
    }
}

// Counter animation
document.addEventListener('DOMContentLoaded', function() {
    const counters = document.querySelectorAll('.counter-value');
    if (counters.length === 0) return;
    
    const speed = 200;
    let animationStarted = false;
    
    const animateCounters = () => {
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            const count = +counter.innerText.replace(/,/g, '') || 0;
            
            const inc = target / speed;
            
            if (count < target) {
                counter.innerText = Math.ceil(count + inc).toLocaleString();
                setTimeout(animateCounters, 1);
            } else {
                counter.innerText = target.toLocaleString();
            }
        });
    };
    
    // Check if element is in viewport
    function isInViewport(element) {
        const rect = element.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }
    
    // Start animation when scrolled into view
    function checkScroll() {
        if (!animationStarted && counters.length > 0 && isInViewport(counters[0])) {
            animationStarted = true;
            animateCounters();
            window.removeEventListener('scroll', checkScroll);
        }
    }
    
    window.addEventListener('scroll', checkScroll);
    checkScroll(); // Check on load
});

// Testimonial slider
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.testimonial-slide');
    const dots = document.querySelectorAll('.testimonial-dot');
    
    if (slides.length === 0) return;
    
    let currentSlide = 0;
    let slideInterval;
    
    function showSlide(index) {
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active', 'bg-primary'));
        
        slides[index].classList.add('active');
        dots[index].classList.add('active', 'bg-primary');
        currentSlide = index;
    }
    
    function nextSlide() {
        showSlide((currentSlide + 1) % slides.length);
    }
    
    // Add click event to dots
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            showSlide(index);
            // Reset timer when manually changing slides
            clearInterval(slideInterval);
            slideInterval = setInterval(nextSlide, 5000);
        });
    });
    
    // Auto advance slides
    slideInterval = setInterval(nextSlide, 5000);
    
    // Pause on hover
    const slider = document.querySelector('.testimonial-slider');
    if (slider) {
        slider.addEventListener('mouseenter', () => clearInterval(slideInterval));
        slider.addEventListener('mouseleave', () => {
            slideInterval = setInterval(nextSlide, 5000);
        });
    }
});
</script>

<!-- SIGN IN / SIGN UP FUNCTIONALITY -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const signInModal = document.getElementById("sign-in-modal");
    const closeSignIn = document.getElementById("close-sign-in");
    const signInForm = document.getElementById("sign-in-form");
    const signUpForm = document.getElementById("sign-up-form");
    const toggleForm = document.getElementById("toggle-form");
    const toggleText = document.getElementById("toggle-text");
    const modalTitle = document.getElementById("modal-title");
    const authThankYouModal = document.getElementById("auth-thank-you-modal");
    const authThankYouTitle = document.getElementById("auth-thank-you-title");
    const authThankYouMessage = document.getElementById("auth-thank-you-message");
    const closeAuthThankYou = document.getElementById("close-auth-thank-you");

    // Initialize password toggles
    setupPasswordToggle();

    // Debug: Check if elements exist
    console.log('Join Us button:', document.getElementById("join-us-btn"));
    console.log('Sign In Modal:', signInModal);
    console.log('Sign In Form:', signInForm);

    // Join Us Button
    const joinUsBtn = document.getElementById("join-us-btn");
    if (joinUsBtn) {
        joinUsBtn.addEventListener("click", (e) => {
            e.preventDefault();
            console.log('Join Us button clicked');
            if (signInModal) {
                signInModal.classList.remove("hidden");
                setTimeout(() => {
                    const box = signInModal.querySelector('.modal-animate');
                    if (box) box.classList.add('visible');
                }, 10);
            } else {
                console.error('Sign in modal not found');
            }
        });
    } else {
        console.log('Join Us button not found (user might be logged in)');
    }

    // Close modal
    if (closeSignIn) {
        closeSignIn.addEventListener("click", () => {
            hideModal("sign-in-modal");
        });
    }

    // Toggle Sign In / Sign Up
    if (toggleForm) {
        toggleForm.addEventListener("click", (e) => {
            e.preventDefault();
            const isSignInVisible = !signInForm.classList.contains("hidden");

            if (isSignInVisible) {
                // Switch to Sign Up
                signInForm.classList.add("hidden");
                signUpForm.classList.remove("hidden");
                toggleText.textContent = "Already have an account?";
                toggleForm.textContent = "Sign In";
                modalTitle.textContent = "Sign Up";
            } else {
                // Switch to Sign In
                signInForm.classList.remove("hidden");
                signUpForm.classList.add("hidden");
                toggleText.textContent = "Don't have an account?";
                toggleForm.textContent = "Sign Up";
                modalTitle.textContent = "Sign In";
            }
            
            // Reinitialize password toggles for new form
            setTimeout(setupPasswordToggle, 100);
        });
    }

    // Enhanced Sign In Form Submission
    if (signInForm) {
        signInForm.addEventListener("submit", async function(e) {
            e.preventDefault();
            console.log('Sign In form submitted');
            
            const emailInput = this.querySelector('input[type="email"]');
            const passwordInput = this.querySelector('input[type="password"]');
            
            if (!emailInput.value || !passwordInput.value) {
                alert('Please fill in all fields');
                return;
            }
            
            const data = {
                email: emailInput.value,
                password: passwordInput.value
            };

            try {
                console.log('Sending signin request...');
                const response = await fetch('signin.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams(data)
                });

                // Handle both JSON and HTML responses
                const responseText = await response.text();
                console.log('Response:', responseText);
                
                let result;
                try {
                    result = JSON.parse(responseText);
                } catch {
                    // If not JSON, check for success indicators
                    if (responseText.includes('success') || response.ok) {
                        result = { success: true, message: 'Sign in successful' };
                    } else {
                        result = { success: false, message: 'Sign in failed' };
                    }
                }
                
                if (result.success || response.ok) {
                    authThankYouTitle.textContent = "Welcome!";
                    authThankYouMessage.textContent = "You have successfully signed in.";
                    hideModal("sign-in-modal");
                    authThankYouModal.classList.remove("hidden");
                    
                    // Reload page after 2 seconds to update header
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                } else {
                    alert(result.message || 'Sign in failed. Please check your credentials.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Sign in failed. Please try again.');
            }
        });
    }

    // Enhanced Sign Up Form Submission
if (signUpForm) {
    signUpForm.addEventListener("submit", async function(e) {
        e.preventDefault();
        console.log('Sign Up form submitted');
        
        const nameInput = this.querySelector('input[type="text"]');
        const emailInput = this.querySelector('input[type="email"]');
        const passwordInput = this.querySelector('input[type="password"]');
        
        // Basic client-side validation
        if (!nameInput.value.trim()) {
            alert('Please enter your name');
            nameInput.focus();
            return;
        }
        
        if (!emailInput.value.trim()) {
            alert('Please enter your email');
            emailInput.focus();
            return;
        }
        
        if (!passwordInput.value.trim()) {
            alert('Please enter a password');
            passwordInput.focus();
            return;
        }
        
        const data = {
            name: nameInput.value.trim(),
            email: emailInput.value.trim(),
            password: passwordInput.value
        };

        console.log('Sending signup data:', data);

        try {
            const response = await fetch('signup.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();
            console.log('Signup response:', result);
            
            if (response.ok && result.success) {
                authThankYouTitle.textContent = "Success!";
                authThankYouMessage.textContent = result.message || "Your account has been created successfully.";
                hideModal("sign-in-modal");
                authThankYouModal.classList.remove("hidden");
                
                // Switch back to sign in form after success
                setTimeout(() => {
                    signUpForm.classList.add("hidden");
                    signInForm.classList.remove("hidden");
                    toggleText.textContent = "Don't have an account?";
                    toggleForm.textContent = "Sign Up";
                    modalTitle.textContent = "Sign In";
                    authThankYouModal.classList.add("hidden");
                    
                    // Clear form
                    signUpForm.reset();
                    
                    // Reload to update header with user info
                    window.location.reload();
                }, 3000);
            } else {
                alert(result.message || 'Sign up failed. Please try again.');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Sign up failed. Please check your connection and try again.');
        }
    });
}
    // Close thank you modal
    if (closeAuthThankYou) {
        closeAuthThankYou.addEventListener("click", () => {
            authThankYouModal.classList.add("hidden");
        });
    }

    // Close modals on outside click and ESC key
    window.addEventListener('click', (e) => {
        if (e.target === signInModal) hideModal("sign-in-modal");
        if (e.target === authThankYouModal) authThankYouModal.classList.add("hidden");
    });
    
    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            hideModal("sign-in-modal");
            authThankYouModal.classList.add("hidden");
        }
    });
});
</script>

<script>
// Simple form validation for all forms
document.addEventListener('DOMContentLoaded', function() {
    const forms = ['volunteer-form', 'donation-form', 'food-donation-form'];
    
    forms.forEach(formId => {
        const form = document.getElementById(formId);
        if (form) {
            form.addEventListener('submit', function(e) {
                let isValid = true;
                const requiredFields = form.querySelectorAll('[required]');
                
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('input-error');
                        
                        // Add error message
                        let errorMsg = field.parentElement.querySelector('.error-message');
                        if (!errorMsg) {
                            errorMsg = document.createElement('div');
                            errorMsg.className = 'error-message text-red-500 text-sm mt-1';
                            field.parentElement.appendChild(errorMsg);
                        }
                        errorMsg.textContent = 'This field is required';
                    } else {
                        field.classList.remove('input-error');
                        const errorMsg = field.parentElement.querySelector('.error-message');
                        if (errorMsg) errorMsg.remove();
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                    // alert('Please fill all required fields.');
                }
                // Let form submit naturally if valid
            });
        }
    });
});
</script>
</body>
</html>