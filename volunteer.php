<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Volunteer with ServeKind</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>tailwind.config={theme:{extend:{colors:{primary:'#FF6B35',secondary:'#4A90E2'},borderRadius:{'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'}}}}</script>
     <style>
        .glass-card, .glassmorphism {
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

/* 2. HERO Section style */
.hero {
    background: #f7f7f7; /* Light background for the hero section */
    color: #333;
    border: 1px solid #eee;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

/* 3. CUSTOM CHECKBOX FIX (This is often the culprit for layout issues) */
.custom-checkbox {
    /* Hides the default browser checkbox */
    appearance: none;
    -webkit-appearance: none;
    
    /* Base style */
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 4px; /* Matches the input fields */
    cursor: pointer;
    position: relative;
    /* Ensure they have a proper size */
    height: 1.25rem; /* h-5 */
    width: 1.25rem;  /* w-5 */
}

.custom-checkbox:checked {
    background-color: #FF6B35; /* Primary color when checked */
    border-color: #FF6B35;
}

/* Custom Checkmark */
.custom-checkbox:checked::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: translate(-50%, -60%) rotate(45deg);
}

/* 4. Error Message Style (Ensure it is hidden by default) */
.error-message {
    color: #ef4444; /* Tailwind red-500 */
    font-size: 0.875rem; /* text-sm */
    margin-top: 0.25rem; /* mt-1 */
    display: none; /* Crucial: hide by default */
}
        .glassmorphism {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .hero {
            background: linear-gradient(135deg, rgba(255, 107, 53, 0.1) 0%, rgba(74, 144, 226, 0.1) 100%);
        }
        
        .card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .error-message {
            color: #e53e3e;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: none;
        }
        
        .input-error {
            border-color: #e53e3e !important;
        }
     </style>
</head>
<body class="font-sans text-gray-800 bg-gray-50">
    <!-- Header & Navigation -->
    <header class="glassmorphism shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center">
                <a href="#" class="text-3xl font-['Pacifico'] text-primary mr-10">ServeKind</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <nav class="hidden md:flex space-x-6">
                   <a href=home.php class="text-gray-800 hover:text-primary font-medium">Home</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
                    <a href=programs.php class="text-gray-800 hover:text-primary font-medium">Programs</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href=donate.php class="text-gray-800 hover:text-primary font-medium">Donate</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="#" class="text-gray-800 hover:text-primary font-medium">Volunteer</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href=blog.php class="text-gray-800 hover:text-primary font-medium">Blog</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href=aboutus.php class="text-gray-800 hover:text-primary font-medium">About</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href=contactus.php class="text-gray-800 hover:text-primary font-medium">Contact</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </nav>
            </div>
            </div>
        </div>
    </header>
    
    <div class="container mx-auto px-4">
    <div class="hero py-16 px-4 rounded-lg my-6 text-center">
        <h1 class="text-4xl font-bold mb-4 text-primary">Become a Volunteer at ServeKind</h1>
        <p class="text-xl max-w-3xl mx-auto">Join hands with us in creating a hunger-free community. Your time and compassion can nourish lives and inspire change.</p>
    </div>

    <section class="my-12 max-w-4xl mx-auto">
        <h2 class="text-3xl font-bold mb-6 text-center">How You Make a Difference</h2>
        <div class="card glass-card text-center p-8 mb-12">
            <p class="mb-4">When you volunteer with ServeKind, you directly impact lives — by preparing, packing, and distributing meals to the elderly, children, and families who need them the most.</p>
            <ul class="list-disc pl-5 space-y-2 text-left max-w-2xl mx-auto">
                <li>Feed undernourished children in local schools</li>
                <li>Support senior citizens with daily nutrition</li>
                <li>Distribute grocery kits to low-income households</li>
                <li>Help during food drives and emergency relief</li>
            </ul>
        </div>
        
        <h2 class="text-3xl font-bold mb-6 text-center">What You Will Learn</h2>
        <div class="card glass-card text-center p-8 mb-12">
            <p class="mb-4">Volunteering is not just about giving — it's also about growing. At ServeKind, you'll gain:</p>
            <ul class="list-disc pl-5 space-y-2 text-left max-w-2xl mx-auto">
                <li>Teamwork and leadership skills</li>
                <li>Real-life experience in community service</li>
                <li>Insights into food distribution and logistics</li>
                <li>Empathy, gratitude, and a deeper social understanding</li>
            </ul>
        </div>
    </section>

    <section class="my-12 max-w-4xl mx-auto" id="volunteer-form-section">
        <h2 class="text-3xl font-bold mb-6 text-center text-primary">Volunteer Registration</h2>
        
        <div class="glass-card p-8 shadow-xl rounded-lg"> 

            <form id="volunteer-form" action="volunteer_process.php" method="POST" class="space-y-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6"> 
                    <div>
                        <input type="text" id="vol-first-name" name="first_name" placeholder="First Name" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        <div id="first-name-error" class="error-message">First name is required</div>
                    </div>

                    <div>
                        <input type="text" id="vol-last-name" name="last_name" placeholder="Last Name" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        <div id="last-name-error" class="error-message">Last name is required</div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6"> 
                    <div>
                        <input type="email" id="vol-email" name="email" placeholder="Email Address" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        <div id="email-error" class="error-message">Valid email is required</div>
                    </div>

                    <div>
                        <input type="tel" id="vol-phone" name="phone" placeholder="Phone Number" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        <div id="phone-error" class="error-message">Valid 10-digit phone number is required</div>
                    </div>
                </div>

                <div>
                    <label for="vol-location" class="block text-gray-700 font-medium mb-2">Location <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select id="vol-location" name="location" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent appearance-none pr-8">
                            <option value="" disabled selected>Select your city</option>
                            <option value="delhi">Delhi</option>
                            <option value="mumbai">Mumbai</option>
                            <option value="bangalore">Bangalore</option>
                            <option value="hyderabad">Hyderabad</option>
                            <option value="chennai">Chennai</option>
                            <option value="kolkata">Kolkata</option>
                            <option value="pune">Pune</option>
                            <option value="other">Other</option>
                        </select>
                        <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                            <i class="ri-arrow-down-s-line text-gray-500"></i>
                        </div>
                    </div>
                    <div id="location-error" class="error-message">Please select a location</div>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Areas of Interest <span class="text-red-500">*</span></label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-y-3 gap-x-6 p-4 rounded-lg bg-gray-50 border border-gray-200">
                        <div class="flex items-center">
                            <input type="checkbox" id="food-prep" name="interests[]" value="Food Preparation"  class="custom-checkbox h-5 w-5">
                            <label for="food-prep" class="ml-3 text-gray-700">Food Preparation</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="interests[]" value="Food Distribution" id="food-distribution" class="custom-checkbox h-5 w-5">
                            <label for="food-distribution" class="ml-3 text-gray-700">Food Distribution</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="interests[]" value="Delivery" id="delivery"  class="custom-checkbox h-5 w-5">
                            <label for="delivery" class="ml-3 text-gray-700">Delivery</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="interests[]" value="Education Programs" id="education" class="custom-checkbox h-5 w-5">
                            <label for="education" class="ml-3 text-gray-700">Education Programs</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="interests[]" value="Administrative Support" id="admin"  class="custom-checkbox h-5 w-5">
                            <label for="admin" class="ml-3 text-gray-700">Administrative Support</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="interests[]" value="Event Coordination" id="events"  class="custom-checkbox h-5 w-5">
                            <label for="events" class="ml-3 text-gray-700">Event Coordination</label>
                        </div>
                    </div>
                    <div id="interests-error" class="error-message">Please select at least one area of interest</div>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Availability</label>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-y-3 gap-x-6 p-4 rounded-lg bg-gray-50 border border-gray-200">
                        <div class="flex items-center">
                            <input type="checkbox" name="availability[]" value="Weekdays" id="weekdays" class="custom-checkbox h-5 w-5">
                            <label for="weekdays" class="ml-3 text-gray-700">Weekdays</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="availability[]" value="Weekends" id="weekends" class="custom-checkbox h-5 w-5">
                            <label for="weekends" class="ml-3 text-gray-700">Weekends</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="availability[]" value="Special Events Only" id="events-only" class="custom-checkbox h-5 w-5">
                            <label for="events-only" class="ml-3 text-gray-700">Special Events Only</label>
                        </div>
                    </div>
                    <div id="availability-error" class="error-message">Please select at least one availability option</div>
                </div>

                <div>
                    <label for="vol-message" class="block text-gray-700 font-medium mb-2">Why do you want to volunteer with us? <span class="text-red-500">*</span></label>
                    <textarea id="vol-message" name="message" rows="3" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"></textarea>
                    <div id="message-error" class="error-message">Please tell us why you want to volunteer</div>
                </div>

                <div class="flex items-start pt-4">
                    <input type="checkbox" id="vol-terms" name="terms" required class="custom-checkbox mt-1 h-5 w-5">
                    <label for="vol-terms" class="ml-3 text-gray-700">I agree to the volunteer terms and conditions <span class="text-red-500">*</span></label>
                </div>
                <div id="terms-error" class="error-message">You must agree to the terms and conditions</div>

                <button type="submit"
                    class="w-full bg-primary hover:bg-opacity-90 text-white py-3 rounded-button font-medium transition duration-300 whitespace-nowrap">
                    Submit Application
                </button>
            </form>

        </div> </section>
    
    </div>

<div id="volunteer-thank-you-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="glassmorphism rounded-lg p-8 max-w-md mx-4">
        <div class="text-center">
            <i class="ri-checkbox-circle-fill text-5xl text-primary mb-4"></i>
            <h3 class="text-2xl font-bold mb-4">Thank You!</h3>
            <p class="text-gray-700 mb-6">Your volunteer application has been submitted successfully. Our team will contact you shortly.</p>
            <button id="close-volunteer-thank-you" class="bg-primary hover:bg-opacity-90 text-white py-2 px-6 rounded-button font-medium transition duration-300">Close</button>
        </div>
    </div>
</div>
    <!--script-->
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const volunteerForm = document.getElementById('volunteer-form');
    const volunteerThankYou = document.getElementById('volunteer-thank-you-modal');
    const closeVolunteerThankYou = document.getElementById('close-volunteer-thank-you');

    // Function to validate email
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Function to validate phone number (10 digits)
    function isValidPhone(phone) {
        const phoneRegex = /^\d{10}$/;
        return phoneRegex.test(phone.replace(/\D/g, ''));
    }

    // Function to show error
    function showError(inputId, messageId, message) {
        if (inputId) {
            const input = document.getElementById(inputId);
            if (input) input.classList.add('input-error');
        }
        const errorElement = document.getElementById(messageId);
        if (errorElement) {
            errorElement.textContent = message;
            errorElement.style.display = 'block';
        }
    }

    // Function to hide error
    function hideError(inputId, messageId) {
        if (inputId) {
            const input = document.getElementById(inputId);
            if (input) input.classList.remove('input-error');
        }
        const errorElement = document.getElementById(messageId);
        if (errorElement) errorElement.style.display = 'none';
    }

    // Function to check if at least one checkbox in a group is checked
    function isCheckboxGroupChecked(name) {
        const checkboxes = document.querySelectorAll(`input[name="${name}"]`);
        return Array.from(checkboxes).some(checkbox => checkbox.checked);
    }

    if (volunteerForm) {
        volunteerForm.addEventListener('submit', (e) => {
            e.preventDefault();
            let isValid = true;

            /* ------------------ VALIDATE FIRST NAME ------------------ */
            const firstName = document.getElementById('vol-first-name')?.value.trim() || '';
            if (!firstName) {
                showError('vol-first-name', 'first-name-error', 'First name is required');
                isValid = false;
            } else {
                hideError('vol-first-name', 'first-name-error');
            }

            /* ------------------ VALIDATE LAST NAME ------------------ */
            const lastName = document.getElementById('vol-last-name')?.value.trim() || '';
            if (!lastName) {
                showError('vol-last-name', 'last-name-error', 'Last name is required');
                isValid = false;
            } else {
                hideError('vol-last-name', 'last-name-error');
            }

            /* ------------------ VALIDATE EMAIL ------------------ */
            const email = document.getElementById('vol-email')?.value.trim() || '';
            if (!email) {
                showError('vol-email', 'email-error', 'Email is required');
                isValid = false;
            } else if (!isValidEmail(email)) {
                showError('vol-email', 'email-error', 'Please enter a valid email');
                isValid = false;
            } else {
                hideError('vol-email', 'email-error');
            }

            /* ------------------ VALIDATE PHONE ------------------ */
            const phone = document.getElementById('vol-phone')?.value.trim() || '';
            if (!phone) {
                showError('vol-phone', 'phone-error', 'Phone number is required');
                isValid = false;
            } else if (!isValidPhone(phone)) {
                showError('vol-phone', 'phone-error', 'Please enter a valid 10-digit phone number');
                isValid = false;
            } else {
                hideError('vol-phone', 'phone-error');
            }

            /* ------------------ VALIDATE LOCATION ------------------ */
            const location = document.getElementById('vol-location')?.value || '';
            if (!location) {
                showError('vol-location', 'location-error', 'Please select your city');
                isValid = false;
            } else {
                hideError('vol-location', 'location-error');
            }

            /* ------------------ VALIDATE INTERESTS ------------------ */
            if (!isCheckboxGroupChecked('interests[]')) {
                showError('', 'interests-error', 'Please select at least one area of interest');
                isValid = false;
            } else {
                hideError('', 'interests-error');
            }

            /* ------------------ VALIDATE AVAILABILITY ------------------ */
            if (!isCheckboxGroupChecked('availability[]')) {
                showError('', 'availability-error', 'Please select at least one availability option');
                isValid = false;
            } else {
                hideError('', 'availability-error');
            }

            /* ------------------ VALIDATE MESSAGE ------------------ */
            const message = document.getElementById('vol-message')?.value.trim() || '';
            if (!message) {
                showError('vol-message', 'message-error', 'Please tell us why you want to volunteer');
                isValid = false;
            } else {
                hideError('vol-message', 'message-error');
            }

            /* ------------------ VALIDATE TERMS ------------------ */
            const terms = document.getElementById('vol-terms')?.checked || false;
            if (!terms) {
                showError('vol-terms', 'terms-error', 'You must agree to the terms and conditions');
                isValid = false;
            } else {
                hideError('vol-terms', 'terms-error');
            }

            /* ------------------ IF EVERYTHING IS VALID ------------------ */
            if (isValid) {
                // Show thank you modal and submit form
                if (volunteerThankYou) {
                    volunteerThankYou.classList.remove('hidden');
                }
                
                // Submit the form
                volunteerForm.submit();
            }
        });
    }

    // Close volunteer thank you modal
    if (closeVolunteerThankYou) {
        closeVolunteerThankYou.addEventListener('click', () => {
            if (volunteerThankYou) {
                volunteerThankYou.classList.add('hidden');
            }
        });
    }

    // Close modal when clicking outside
    window.addEventListener('click', (e) => {
        if (e.target === volunteerThankYou) {
            volunteerThankYou.classList.add('hidden');
        }
    });

    // Ensure all form fields have proper names (backup in case HTML is missing them)
    const fieldMappings = [
        { id: 'vol-first-name', name: 'first_name' },
        { id: 'vol-last-name', name: 'last_name' },
        { id: 'vol-email', name: 'email' },
        { id: 'vol-phone', name: 'phone' },
        { id: 'vol-location', name: 'location' },
        { id: 'vol-message', name: 'message' },
        { id: 'vol-terms', name: 'agreed_terms' }
    ];

    fieldMappings.forEach(mapping => {
        const element = document.getElementById(mapping.id);
        if (element && !element.getAttribute('name')) {
            element.setAttribute('name', mapping.name);
        }
    });

    // Ensure checkboxes have proper names
    const interestCheckboxes = ['food-prep', 'food-distribution', 'delivery', 'education', 'admin', 'events'];
    interestCheckboxes.forEach(id => {
        const checkbox = document.getElementById(id);
        if (checkbox && !checkbox.getAttribute('name')) {
            checkbox.setAttribute('name', 'interests[]');
        }
    });

    const availabilityCheckboxes = ['weekdays', 'weekends', 'events-only'];
    availabilityCheckboxes.forEach(id => {
        const checkbox = document.getElementById(id);
        if (checkbox && !checkbox.getAttribute('name')) {
            checkbox.setAttribute('name', 'availability[]');
        }
    });
});
</script>
  </body>
</html>