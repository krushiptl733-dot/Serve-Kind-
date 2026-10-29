<!DOCTYPE html>
<html lang="en">
<head>
    <title>contact- ServeKind</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>tailwind.config={theme:{extend:{colors:{primary:'#FF6B35',secondary:'#4A90E2'},borderRadius:{'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'}}}}</script>
     <link rel="stylesheet" href="style.css"> 

    <!-- Glassmorphism + Fade-in styles -->
    <style>
      /* Glass card base */
      .glass-card{
        background: rgba(255,255,255,0.55);
        -webkit-backdrop-filter: blur(10px);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.35);
        box-shadow: 0 8px 30px rgba(2,6,23,0.08);
        color: #111827; /* ensure readable text */
      }

      /* Slightly stronger glass for contrasted blocks */
      .glass-card--soft{
        background: rgba(250,250,250,0.65);
      }

      /* Fade-in animation helper */
      .fade-in{
        opacity: 0;
        transform: translateY(16px);
        transition: opacity 700ms cubic-bezier(.2,.9,.3,1), transform 700ms cubic-bezier(.2,.9,.3,1);
        will-change: opacity, transform;
      }
      .fade-in.visible{
        opacity: 1;
        transform: none;
      }

      /* Improve card inner background so icons/text look sharp */
      .glass-card .info-text, .glass-card h2, .glass-card h3, .glass-card p {
        color: inherit;
      }

      /* Responsive: reduce blur on small screens */
      @media (max-width:640px){
        .glass-card{ -webkit-backdrop-filter: blur(6px); backdrop-filter: blur(6px); }
      }
    </style>
     
</head>
<body class="font-sans text-gray-800 bg-gray-50">
    <!-- Header & Navigation -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center">
                <a href="#" class="text-3xl font-['Pacifico'] text-primary mr-10">ServeKind</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <nav class="hidden md:flex space-x-6">
                    <a href=home.php class="text-gray-800 hover:text-primary font-medium">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
                    <a href=programs.php class="text-gray-800 hover:text-primary font-medium">Programs</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href=donate.php class="text-gray-800 hover:text-primary font-medium">Donate</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href=volunteer.php class="text-gray-800 hover:text-primary font-medium">Volunteer</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href=blog.php class="text-gray-800 hover:text-primary font-medium">Blog</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href=aboutus.php class="text-gray-800 hover:text-primary font-medium">About</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="#" class="text-gray-800 hover:text-primary font-medium">Contact</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </nav>
            </div>
            </div>
        </div>
    </header>
    <section id="contact-us" class="py-16 bg-gray-50">
  <div class="container mx-auto px-6 lg:px-20">
    
    <!-- Heading -->
    <div class="text-center mb-10">
      <h2 class="text-4xl font-bold text-gray-800">Get in Touch With Us</h2>
      <p class="text-gray-600 mt-3 max-w-2xl mx-auto">
        We’d love to hear from you! Whether you have questions, suggestions, or want to collaborate, 
        feel free to reach out. Our team will respond as soon as possible.
      </p>
    </div>

<!-- Apply glass-card + fade-in to the main contact layout -->
<div class="contact-container">

  <!-- 1. Contact Info & Offices in Two Columns -->
  <div class="card glass-card fade-in">
    <h2>Contact Information</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">

      <!-- Left Column: HQ Info -->
      <div>
        <div class="info-item">
          <div class="info-text">
            <strong>📍 Headquarters</strong><br>
            12 Kindness Road, Chala, Vapi<br>
            Gujarat, 396191, India
          </div>
        </div><br>

        <div class="info-item">
          <div class="info-text">
            <strong>☎ Phone</strong><br>
            +91 261 2245 678 (Main)<br>
            +91 98765 43210 (Donations)
          </div>
        </div><br>

        <div class="info-item">
          <div class="info-text">
            <strong>📩 Email</strong><br>
            info@servekind.org<br>
            donations@servekind.org
          </div>
        </div><br>

        <div class="info-item">
          <div class="info-text">
            <strong>🕒 Hours</strong><br>
            Mon – Fri: 9:00 AM – 6:00 PM<br>
            Saturday: 10:00 AM – 2:00 PM
          </div>
        </div>
      </div>

      <!-- Right Column: Regional Offices -->
      <div>
        <h3>Regional Offices</h3>
        <div class="regional-item">
          <div class="info-text">
            <strong>📍 Mumbai:</strong> 456 Charity Street, Bandra West
          </div>
        </div><br>
        <div class="regional-item">
          <div class="info-text">
            <strong>📍 Bangalore:</strong> 789 Hope Road, Koramangala
          </div>
        </div><br>
        <div class="regional-item">
          <div class="info-text">
            <strong>📍 Chennai:</strong> 101 Service Avenue, T. Nagar
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- 2. Map Section -->
  <div class="card glass-card fade-in">
    <h2>Find Us on Map</h2>
    <iframe 
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3721.708087541409!2d72.90619897446606!3d20.371883310728158!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04f0cb9b96eb1%3A0x9b0f807d68d9f7b1!2sVapi%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1721891420222!5m2!1sen!2sin" 
      width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy">
    </iframe>
  </div>

  <!-- 3. Team Reviews (Testimonial Section) -->
<section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-4">What Our Team & Community Say</h2>
            <p class="text-gray-600 text-center max-w-3xl mx-auto mb-12">Hear from our volunteers, donors, and the communities.</p>
            
            <div class="testimonial-slider relative h-80 max-w-4xl mx-auto fade-in">
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
    
<!-- Contact Section -->
    <section id="contact" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-4">Contact Us</h2>
            <p class="text-gray-600 text-center max-w-3xl mx-auto mb-12">Have questions or want to get involved? Reach out to us.</p>
            
            <div class="flex flex-col lg:flex-row gap-12 max-w-6xl mx-auto">
                <div class="lg:w-1/2">
                    <form method="post" action="contact_process.php" id="message-form" class="glass-card p-8 rounded-lg shadow-md fade-in">
    <h3 class="text-2xl font-bold mb-6">Send Us a Message</h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <input type="text" name="firstname" placeholder="First Name" required class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
        <input type="text" name="lastname" placeholder="Last Name" class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
    </div>

    <input type="email" name="emailaddress" placeholder="Email Address" required class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent mb-4">

    <input type="tel" name="phonenumber" placeholder="Phone Number" class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent mb-4">

    <div class="mb-4">
        <label for="subject" class="block text-gray-700 font-medium mb-2">Subject</label>
        <div class="relative">
            <select id="subject" name="subject" required class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent appearance-none pr-8">
                <option value="" disabled selected>Select a subject</option>
                <option value="Donation Inquiry">Donation Inquiry</option>
                <option value="Volunteer Information">Volunteer Information</option>
                <option value="Partnership Opportunities">Partnership Opportunities</option>
                <option value="General Question">General Question</option>
            </select>
            <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                <i class="ri-arrow-down-s-line text-gray-500"></i>
            </div>
        </div>
    </div>

    <textarea rows="4" name="message" placeholder="Your Message" required class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent mb-4"></textarea>

    <button type="submit" name="submit" class="w-full bg-primary hover:bg-opacity-90 text-white py-3 rounded-button font-medium transition duration-300 whitespace-nowrap">Send Message</button>
</form>

                </div>
                
                <div class="lg:w-1/2">
                    <div class="glass-card p-8 rounded-lg shadow-md mb-8 fade-in">
                        <h3 class="text-2xl font-bold mb-6">Contact Information</h3>
                        
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="w-10 h-10 flex-shrink-0 bg-primary bg-opacity-10 rounded-full flex items-center justify-center text-primary mr-4">
                                    <i class="ri-map-pin-line"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-lg">Headquarters</h4>
                                    <p class="text-gray-600">12 Kindness Road, Chala, Vapi<br> Gujarat, 396191, India</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="w-10 h-10 flex-shrink-0 bg-primary bg-opacity-10 rounded-full flex items-center justify-center text-primary mr-4">
                                    <i class="ri-phone-line"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-lg">Phone</h4>
                                    <p class="text-gray-600">+91 11 2345 6789 (Main)<br>+91 98765 43210 (Donations)</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-10 h-10 flex-shrink-0 bg-primary bg-opacity-10 rounded-full flex items-center justify-center text-primary mr-4">
                                    <i class="ri-mail-line"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-lg">Email</h4>
                                    <p class="text-gray-600">info@servekind.org<br>donations@servekind.org</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="w-10 h-10 flex-shrink-0 bg-primary bg-opacity-10 rounded-full flex items-center justify-center text-primary mr-4">
                                    <i class="ri-time-line"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-lg">Hours</h4>
                                    <p class="text-gray-600">Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 10:00 AM - 2:00 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                <!-- Social Media -->

<!-- ✅ Send Message Thank You Modal -->
<div id="message-thank-you-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="p-6 text-center">
            <div class="w-20 h-20 bg-primary bg-opacity-10 rounded-full flex items-center justify-center mx-auto mb-6">
                <div class="w-10 h-10 flex items-center justify-center text-primary">
                    <i class="ri-mail-check-fill ri-2x"></i>
                </div>
            </div>
            <h3 class="text-2xl font-bold mb-2">Message Sent Successfully!</h3>
            <p class="text-gray-600 mb-6">Thank you for reaching out to us. We will respond to your message as soon as possible.</p>
            <button id="close-message-thank-you" class="bg-primary hover:bg-opacity-90 text-white px-4 py-2 rounded-button transition duration-300">Close</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

    /* ------------------ COUNTER ANIMATION ------------------ */
    const counters = document.querySelectorAll('.counter-value');
    const counterSpeed = 200;

    function animateCounters() {
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            let count = +counter.innerText.replace(/,/g, '');
            const inc = target / counterSpeed;

            if (count < target) {
                counter.innerText = Math.ceil(count + inc).toLocaleString();
                setTimeout(animateCounters, 1);
            } else {
                counter.innerText = target.toLocaleString();
            }
        });
    }

    function isInViewport(element) {
        const rect = element.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    function checkCounterScroll() {
        if (counters.length > 0 && isInViewport(counters[0])) {
            animateCounters();
            window.removeEventListener('scroll', checkCounterScroll);
        }
    }

    window.addEventListener('scroll', checkCounterScroll);
    checkCounterScroll(); // initial check

    /* ------------------ TESTIMONIAL SLIDER ------------------ */
    const slides = document.querySelectorAll('.testimonial-slide');
    const dots = document.querySelectorAll('.testimonial-dot');
    let currentSlide = 0;

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

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => showSlide(index));
    });

    setInterval(nextSlide, 5000);

    /* ------------------ INTERSECTION OBSERVER FOR FADE-IN ------------------ */
    try {
        const io = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });

        document.querySelectorAll('.fade-in').forEach(el => io.observe(el));
    } catch (e) {
        document.querySelectorAll('.fade-in').forEach(el => el.classList.add('visible'));
    }

    /* ------------------ CONTACT FORM ------------------ */
    const messageForm = document.getElementById('message-form');
    const messageThankYou = document.getElementById('message-thank-you-modal');

    if (messageForm) {
        // Show modal if PHP redirect indicates success
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('status') === 'success') {
            messageThankYou.classList.remove('hidden');
        }

        messageForm.addEventListener('submit', (e) => {
            const firstname = messageForm.querySelector('input[name="firstname"]').value.trim();
            const email = messageForm.querySelector('input[name="emailaddress"]').value.trim();
            const message = messageForm.querySelector('textarea[name="message"]').value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!firstname || !emailRegex.test(email) || !message) {
                e.preventDefault(); // stop submission
                alert("Please fill all required fields correctly!");
            }
            // Otherwise, form submits normally to PHP
        });

        // Close modal button
        const closeBtn = document.getElementById('close-message-thank-you');
        if (closeBtn) {
            closeBtn.addEventListener('click', () => {
                messageThankYou.classList.add('hidden');
            });
        }

        // Close modal by clicking outside
        window.addEventListener('click', (e) => {
            if (e.target === messageThankYou) {
                messageThankYou.classList.add('hidden');
            }
        });
    }

});
</script>

</body>
</html>


