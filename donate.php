<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate - ServeKind</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <script>tailwind.config={theme:{extend:{colors:{primary:'#FF6B35',secondary:'#4A90E2'},borderRadius:{'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'}}}}</script>
    
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
        
        /* Additional styles for donate page */
        .gradient-bg {
            background: white;
            min-height: 100vh;
        }
        
        /* Tab Button Styling */
        .tab-button {
            border-bottom: 3px solid transparent;
            padding: 1rem 0;
            transition: all 0.2s ease-in-out;
        }
        .tab-button.active {
            border-bottom-color: #FF6B35;
            color: #FF6B35;
            font-weight: 600;
            background: rgba(255, 107, 53, 0.05);
        }
        
        /* Tab Content Display */
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
        
        /* Amount Radio Button Style */
        .amount-option:checked + label {
            background: #FF6B35;
            color: white;
            border-color: #FF6B35;
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.4);
        }
        .amount-option + label:hover {
            opacity: 0.9;
        }

        /* Error Message Styles */
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: none;
        }

        .input-error {
            border-color: #ef4444 !important;
        }
        
        /* Smooth transitions */
        * {
            transition: all 0.3s ease-in-out;
        }
        
        /* Custom styles for form elements */
        .custom-checkbox {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid #d1d5db;
            border-radius: 4px;
            outline: none;
            cursor: pointer;
            position: relative;
        }
        
        .custom-checkbox:checked {
            background-color: #FF6B35;
            border-color: #FF6B35;
        }
        
        .custom-checkbox:checked::after {
            content: "✓";
            position: absolute;
            color: white;
            font-size: 12px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>
<body class="font-sans text-gray-800 bg-white">
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center">
                <a href="home.php" class="text-3xl font-['Pacifico'] text-primary mr-10">ServeKind</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <nav class="hidden md:flex space-x-6">
                   <a href="home.php" class="text-gray-800 hover:text-primary font-medium">Home</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="programs.php" class="text-gray-800 hover:text-primary font-medium">Programs</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="#" class="text-primary font-medium">Donate</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="volunteer.php" class="text-gray-800 hover:text-primary font-medium">Volunteer</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="blog.php" class="text-gray-800 hover:text-primary font-medium">Blog</a;>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="aboutus.php" class="text-gray-800 hover:text-primary font-medium">About</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="contactus.php" class="text-gray-800 hover:text-primary font-medium">Contact</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </nav>
            </div>
            <div>
            </div>
        </div>
    </header>
 <section class="donation-info py-16 glass-card mx-4 md:mx-10 my-8 rounded-2xl">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold text-primary mb-6">Your Donation Can Change a Life</h2>
            <p class="text-lg text-gray-700 leading-relaxed max-w-4xl mx-auto mb-8">
                Every day, millions of people struggle to get even a single meal. With your help, we can provide nutritious food and hope to children, families, and individuals in need. 
                Whether it's a small amount of money or a donation of food, your generosity can light up someone's day and fuel their future.
            </p>
            
            <h3 class="text-2xl font-semibold text-primary mb-4">How Your Donation Helps</h3>
            <ul class="text-left inline-block text-gray-700 space-y-2 mb-8">
                <li class="flex items-start">
                    <i class="ri-checkbox-circle-fill text-primary mt-1 mr-2"></i>
                    <span>₹100 can provide a week's worth of meals for a child.</span>
                </li>
                <li class="flex items-start">
                    <i class="ri-checkbox-circle-fill text-primary mt-1 mr-2"></i>
                    <span>₹500 helps us deliver food kits to families in rural areas.</span>
                </li>
                <li class="flex items-start">
                    <i class="ri-checkbox-circle-fill text-primary mt-1 mr-2"></i>
                    <span>Donated grains, vegetables, and packaged foods are distributed directly to those in need.</span>
                </li>
                <li class="flex items-start">
                    <i class="ri-checkbox-circle-fill text-primary mt-1 mr-2"></i>
                    <span>Donations also support logistics, transportation, and food safety management.</span>
                </li>
            </ul>

            <p class="text-lg text-gray-700 max-w-3xl mx-auto">
                Together, we can fight hunger and bring dignity to lives. No contribution is too small. Let's serve kindness — one plate at a time.
            </p>
        </div>
    </section>
    
    <section id="donate" class="py-16 px-4 bg-gray-50">
        <div class="container mx-auto">
            <div class="glass-card rounded-3xl p-8 max-w-5xl mx-auto fade-in">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-800 mb-4">Choose How You'd Like to Help</h2>
                    <p class="text-lg text-gray-600">Your contribution helps us provide nutritious meals and support to those in need</p>
                </div>
                
                <div class="glass-card--soft rounded-2xl overflow-hidden">
                    <div class="flex bg-white shadow-inner rounded-t-2xl">
                        <button class="tab-button active w-1/2 font-medium text-center text-gray-800 focus:outline-none" data-tab="monetary">Monetary Donation</button>
                        <button class="tab-button w-1/2 font-medium text-center text-gray-800 focus:outline-none" data-tab="food">Food Donation</button>
                    </div>
                    
                    <div id="monetary-tab" class="tab-content active p-6">
    <form id="monetary-donation-form" action="donate_process.php" method="POST" class="space-y-6">

        <?php 
        // Logged-in users only: send user_id
        if (isset($_SESSION['user_id'])) { 
        ?>
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
        <?php 
        } 

        // Pre-fill values for logged-in users
        $prefill_name  = isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : "";
        $prefill_email = isset($_SESSION['user_email']) ? htmlspecialchars($_SESSION['user_email']) : "";
        $prefill_phone = isset($_SESSION['user_phone']) ? htmlspecialchars($_SESSION['user_phone']) : "";
        $first = $prefill_name ? explode(" ", $prefill_name)[0] : "";
        $last  = $prefill_name ? (explode(" ", $prefill_name)[1] ?? "") : "";
        ?>

        <div>
            <label class="block text-gray-800 font-medium mb-2">
                Select Amount <span class="text-red-500">*</span>
            </label>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-4">
                <div>
                    <input type="radio" name="amount" id="amount-500" value="500" class="amount-option hidden">
                    <label for="amount-500" class="block w-full text-center border border-gray-300 text-gray-800 rounded-button py-3 cursor-pointer hover:bg-gray-100 transition">₹500</label>
                </div>
                <div>
                    <input type="radio" name="amount" id="amount-1000" value="1000" class="amount-option hidden">
                    <label for="amount-1000" class="block w-full text-center border border-gray-300 text-gray-800 rounded-button py-3 cursor-pointer hover:bg-gray-100 transition">₹1,000</label>
                </div>
                <div>
                    <input type="radio" name="amount" id="amount-2500" value="2500" class="amount-option hidden">
                    <label for="amount-2500" class="block w-full text-center border border-gray-300 text-gray-800 rounded-button py-3 cursor-pointer hover:bg-gray-100 transition">₹2,500</label>
                </div>
                
                <div>
                    <input type="radio" name="amount" id="amount-custom" value="custom" class="amount-option hidden">
                    <label for="amount-custom" class="block w-full text-center border border-gray-300 text-gray-800 rounded-button py-3 cursor-pointer hover:bg-gray-100 transition">Custom</label>
                </div>
            </div>

            <div id="amount-error" class="error-message">Please select or enter a valid donation amount.</div>
        </div>


        <div class="relative">
            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">₹</span>
            <input type="text" id="custom-amount-input" placeholder="Enter Custom Amount" autocomplete="off"
                   class="w-full pl-8 pr-4 py-3 border border-gray-300 bg-white text-gray-800 rounded-button 
                   focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent placeholder-gray-500">
        </div>

        <hr class="border-gray-200">


        <!-- ALWAYS SHOW CONTACT FORM FOR BOTH USERS -->
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Your Contact Details</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <input type="text" name="first_name" placeholder="First Name" required
                   value="<?= $first ?>"
                   class="w-full px-4 py-3 border border-gray-300 rounded-button 
                   focus:ring-2 focus:ring-primary">

            <input type="text" name="last_name" placeholder="Last Name" required
                   value="<?= $last ?>"
                   class="w-full px-4 py-3 border border-gray-300 rounded-button 
                   focus:ring-2 focus:ring-primary">

            <input type="email" name="email" placeholder="Email Address" required
                   value="<?= $prefill_email ?>"
                   class="w-full px-4 py-3 border border-gray-300 rounded-button 
                   focus:ring-2 focus:ring-primary">

            <input type="tel" name="phone" placeholder="Phone Number" required
                   value="<?= $prefill_phone ?>"
                   class="w-full px-4 py-3 border border-gray-300 rounded-button 
                   focus:ring-2 focus:ring-primary">
        </div>


        <div>
            <label class="block text-gray-800 font-medium mb-2">
                Select Payment Method <span class="text-red-500">*</span>
            </label>

            <input type="hidden" name="payment_method" id="payment-method-value">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <button type="button"
                        class="payment-method-btn w-full flex items-center justify-center p-4 border border-gray-300 
                        rounded-button hover:border-primary transition"
                        data-method="card">
                    <i class="ri-bank-card-line ri-xl mr-3 text-primary"></i>
                    Credit/Debit Card
                </button>

                <button type="button"
                        class="payment-method-btn w-full flex items-center justify-center p-4 border border-gray-300 
                        rounded-button hover:border-primary transition"
                        data-method="upi">
                    <i class="ri-smartphone-line ri-xl mr-3 text-primary"></i>
                    UPI/QR Code
                </button>
            </div>

            <div id="payment-method-error" class="error-message">Please select a payment method.</div>
        </div>


        <div class="py-2">
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="mb-6 border p-4 rounded-lg bg-yellow-50 border-yellow-200">
                    <label for="tax-receipt" class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" id="tax-receipt" name="tax_receipt" value="1" class="custom-checkbox h-5 w-5">
                        <span class="text-gray-700">I require an 80G Tax Exemption Receipt.</span>
                    </label>
                    <p class="text-sm text-white-700 mt-2">
                        Your receipt will be automatically generated using your registered details.
                    </p>
                </div>
            <?php else: ?>
                <div class="text-sm text-gray-600 mb-6 p-3 rounded-lg bg-gray-100">
                    Tax receipt is only available for 
                    <a href="home.php#signin" class="text-primary hover:underline font-semibold">registered or logged-in users</a>.
                </div>
            <?php endif; ?>
        </div>


        <button type="button" id="open-payment-modal"
                class="w-full bg-primary hover:bg-opacity-90 text-white py-4 rounded-button 
                font-medium text-lg transition duration-300 whitespace-nowrap">
            Donate Now
        </button>

    </form>
</div>

                    <div id="food-tab" class="tab-content p-6">
                        <form id="food-donation-form" action="food_donate_process.php" method="POST" class="space-y-6">
                            <input type="hidden" name="user_id" value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0; ?>">
                            <input type="hidden" name="donation_type" id="donation-type">
                            <div>
                                <label class="block text-gray-800 font-medium mb-2">Donation Type <span class="text-red-500">*</span></label>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="donation-card border border-gray-300 rounded-button p-4 flex flex-col items-center cursor-pointer hover:border-primary transition" data-type="Cooked Food"> <div class="w-12 h-12 flex items-center justify-center mb-3 text-primary"> <i class="ri-restaurant-line ri-2x"></i> </div> <h4 class="font-medium mb-1 text-gray-800">Cooked Food</h4> <p class="text-sm text-gray-600 text-center">Ready-to-eat meals, prepared today.</p> </div>
                                    <div class="donation-card border border-gray-300 rounded-button p-4 flex flex-col items-center cursor-pointer hover:border-primary transition" data-type="Raw Materials"> <div class="w-12 h-12 flex items-center justify-center mb-3 text-primary"> <i class="ri-bowl-line ri-2x"></i> </div> <h4 class="font-medium mb-1 text-gray-800">Raw Materials</h4> <p class="text-sm text-gray-600 text-center">Grains, pulses, fresh produce, etc.</p> </div>
                                    <div class="donation-card border border-gray-300 rounded-button p-4 flex flex-col items-center cursor-pointer hover:border-primary transition" data-type="Packaged Food"> <div class="w-12 h-12 flex items-center justify-center mb-3 text-primary"> <i class="ri-box-3-line ri-2x"></i> </div> <h4 class="font-medium mb-1 text-gray-800">Packaged Food</h4> <p class="text-sm text-gray-600 text-center">Sealed packets, canned goods, etc.</p> </div>
                                </div>
                                <div class="error-message" id="donation-type-error">Please select a donation type</div>
                            </div>

                            <div>
                                <label for="donation-details" class="block text-gray-800 font-medium mb-2">Details / Quantity <span class="text-red-500">*</span></label>
                                <textarea name="donation_details" id="donation-details" rows="3" required placeholder="E.g., 20 kgs rice and 10 kgs wheat, or 50 plates of vegetable curry and rotis."
                                    class="w-full px-4 py-3 border border-gray-300 rounded-button focus:ring-2 focus:ring-primary"></textarea>
                                <div class="error-message" id="donation-details-error">Details are required</div>
                            </div>
                            
                            <div>
                                <label class="block text-gray-800 font-medium mb-2">Pickup Address <span class="text-red-500">*</span></label>
                                <input type="text" name="address_line1" id="address-line1" required placeholder="Address Line 1" class="w-full px-4 py-3 border border-gray-300 rounded-button focus:ring-2 focus:ring-primary mb-3">
                                <input type="text" name="address_line2" id="address-line2" placeholder="Address Line 2 (Optional)" class="w-full px-4 py-3 border border-gray-300 rounded-button focus:ring-2 focus:ring-primary mb-3">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <input type="text" name="city" id="city" required placeholder="City" class="w-full px-4 py-3 border border-gray-300 rounded-button focus:ring-2 focus:ring-primary">
                                    <input type="text" name="pincode" id="pincode" required placeholder="Pincode" class="w-full px-4 py-3 border border-gray-300 rounded-button focus:ring-2 focus:ring-primary">
                                </div>
                                <div class="error-message" id="address-error">Address is incomplete</div>
                            </div>

                            <div>
                                <label class="block text-gray-800 font-medium mb-2">Preferred Pickup Date & Time <span class="text-red-500">*</span></label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <input type="date" name="pickup_date" id="pickup-date" required class="w-full px-4 py-3 border border-gray-300 rounded-button focus:ring-2 focus:ring-primary">
                                        <div class="error-message" id="pickup-date-error">Pickup date is required</div>
                                    </div>
                                    <div>
                                        <input type="time" name="pickup_time" id="pickup-time" required class="w-full px-4 py-3 border border-gray-300 rounded-button focus:ring-2 focus:ring-primary">
                                        <div class="error-message" id="pickup-time-error">Pickup time is required</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-gray-800 font-medium mb-2">Contact Information <span class="text-red-500">*</span></label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <input type="text" name="full_name" id="food-full-name" required placeholder="Full Name" class="w-full px-4 py-3 border border-gray-300 rounded-button focus:ring-2 focus:ring-primary">
                                    <input type="email" name="email" id="food-email" required placeholder="Email Address" class="w-full px-4 py-3 border border-gray-300 rounded-button focus:ring-2 focus:ring-primary">
                                    <input type="tel" name="phone" id="food-phone" required placeholder="Phone Number (10 digits)" class="w-full px-4 py-3 border border-gray-300 rounded-button focus:ring-2 focus:ring-primary">
                                </div>
                                <div class="error-message" id="contact-error">Contact information is incomplete</div>
                            </div>
                            
                            <div class="flex items-start pt-4">
                                <input type="checkbox" id="food-safety" name="food_safety" value="1" required class="custom-checkbox mt-1 h-5 w-5">
                                <label for="food-safety" class="ml-3 text-gray-700">I confirm the food is safe, properly stored/packaged, and has not expired. <span class="text-red-500">*</span></label>
                            </div>
                            <div id="safety-error" class="error-message">You must confirm food safety standards</div>

                            <button type="submit"
                                class="w-full bg-primary hover:bg-opacity-90 text-white py-4 rounded-button font-medium text-lg transition duration-300 whitespace-nowrap">
                                Schedule Food Pickup
                            </button>
                        </form>
                    </div> </div>
            </div>
        </div>
    </section>

    <div id="card-payment-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="glass-card w-full max-w-md p-6 rounded-xl relative">
            <button class="close-payment-modal absolute top-4 right-4 text-gray-600 hover:text-primary"><i class="ri-close-line ri-lg"></i></button>
            <h3 class="text-2xl font-bold mb-4 text-primary">Card Payment</h3>
            <p class="text-gray-700 mb-6">Donating <span class="font-bold text-lg text-gray-800" id="card-payment-amount">₹0.00</span></p>

            <form id="card-payment-form" class="space-y-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Card Number</label>
                    <input type="text" placeholder="XXXX XXXX XXXX XXXX" required class="w-full px-4 py-3 border border-gray-300 bg-white text-gray-800 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent placeholder-gray-500" id="card-number">
                    <div class="error-message" id="card-number-error">Valid 16-digit card number is required</div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Expiry (MM/YY)</label>
                        <input type="text" placeholder="MM/YY" required class="w-full px-4 py-3 border border-gray-300 bg-white text-gray-800 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent placeholder-gray-500" id="card-expiry">
                        <div class="error-message" id="card-expiry-error">Expiry date is required</div>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">CVV</label>
                        <input type="text" placeholder="123" required class="w-full px-4 py-3 border border-gray-300 bg-white text-gray-800 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent placeholder-gray-500" id="cvv">
                        <div class="error-message" id="cvv-error">CVV is required</div>
                    </div>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Cardholder Name</label>
                    <input type="text" placeholder="John Doe" required class="w-full px-4 py-3 border border-gray-300 bg-white text-gray-800 rounded-button focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent placeholder-gray-500" id="cardholder-name">
                    <div class="error-message" id="cardholder-name-error">Cardholder name is required</div>
                </div>
                <button type="submit" class="complete-payment w-full bg-primary hover:bg-opacity-90 text-white py-3 rounded-button font-medium transition duration-300 whitespace-nowrap">Complete Donation</button>
            </form>
        </div>
    </div>

    <div id="upi-payment-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="glass-card w-full max-w-md p-6 rounded-xl relative text-center">
            <button class="close-payment-modal absolute top-4 right-4 text-gray-600 hover:text-primary"><i class="ri-close-line ri-lg"></i></button>
            <h3 class="text-2xl font-bold mb-4 text-primary">UPI Payment</h3>
            <p class="text-gray-700 mb-6">You are donating <span class="font-bold text-lg text-gray-800" id="upi-payment-amount">₹0.00</span></p>

            <div class="mb-6">
                <p class="font-medium mb-2">Scan QR Code or Use UPI App</p>
                <div class="flex justify-center items-center p-4 bg-white rounded-lg border border-gray-200 shadow-md">
                    <i class="ri-qr-code-line ri-5x text-gray-400"></i>
                </div>
            </div>

            <form id="upi-payment-form" class="space-y-4">
                <input type="text" placeholder="Enter UPI Transaction ID" required class="w-full px-4 py-3 border border-gray-300 rounded-button focus:ring-2 focus:ring-primary">
                <button type="submit" class="complete-payment w-full bg-primary hover:bg-opacity-90 text-white py-3 rounded-button font-medium transition duration-300 whitespace-nowrap">Confirm & Complete Donation</button>
            </form>
        </div>
    </div>

    <div id="thank-you-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="glass-card w-full max-w-md p-6 rounded-xl relative text-center">
            <div class="mb-4">
                <i class="ri-check-circle-fill ri-5x text-primary"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Thank You for Your Donation!</h3>
            <p class="text-gray-600 mb-6">Your generosity will help provide nutritious meals and support to those in need.</p>
            <div class="bg-gray-50 p-4 rounded-lg mb-6">
                <h4 class="font-medium mb-2 text-gray-800">Donation Details</h4>
                <div class="flex justify-between mb-1">
                    <span class="text-gray-700">Amount:</span>
                    <span class="font-medium text-gray-800" id="donation-amount">₹0.00</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-700">Transaction ID:</span>
                    <span class="font-medium text-gray-800" id="donation-id">SK-PENDING</span>
                </div>
            </div>
            <button id="close-thank-you" class="bg-gray-200 border border-primary text-gray-800 hover:bg-primary hover:text-white transition duration-300 px-4 py-2 rounded-button whitespace-nowrap">Close</button>
        </div>
    </div>
    
    <div id="food-thank-you-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="glass-card w-full max-w-md p-6 rounded-xl relative text-center">
            <div class="mb-4">
                <i class="ri-check-circle-fill ri-5x text-primary"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Pickup Scheduled!</h3>
            <p class="text-gray-600 mb-6">Thank you for your generous food donation. A volunteer will contact you shortly to confirm the details.</p>
            <button id="close-food-thank-you" class="bg-gray-200 border border-primary text-gray-800 hover:bg-primary hover:text-white transition duration-300 px-4 py-2 rounded-button whitespace-nowrap">Close</button>
        </div>
    </div>


<script>
document.addEventListener('DOMContentLoaded', function() {

    /* ===========================================
       1. TAB SWITCHING LOGIC
       ============================================ */
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');

            tabButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            tabContents.forEach(content => {
                content.classList.remove('active');
                if (content.id === `${targetTab}-tab`) {
                    content.classList.add('active');
                }
            });
        });
    });

    /* ===========================================
       2. MONETARY AMOUNT SELECTION UI
       ============================================ */
    const monetaryForm = document.getElementById('monetary-donation-form');
    const amountRadios = monetaryForm.querySelectorAll('.amount-option');
    const customInput = document.getElementById('custom-amount-input');
    const customRadio = document.getElementById('amount-custom');

    // Listener for custom amount input field
    if (customInput) {
        customInput.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                // When user types, automatically select the custom radio button
                customRadio.checked = true;
                customRadio.parentElement.querySelector('label').click(); // to activate the CSS style
            }
        });

        // Add a listener to the custom radio label to focus the input when clicked
        if(customRadio) {
             customRadio.nextElementSibling.addEventListener('click', function() {
                customRadio.checked = true;
                customInput.focus();
            });
        }
    }
    
    // Listener for preset amounts - ensures custom is deselected
    amountRadios.forEach(radio => {
        if (radio.id !== 'amount-custom') {
            radio.addEventListener('change', function() {
                if (this.checked && customInput) {
                    customInput.value = ''; // Clear custom input when a preset is chosen
                }
            });
        }
    });

    /* ===========================================
       3. MODAL DISPLAY LOGIC (Payment Methods)
       ============================================ */
    const cardModal = document.getElementById('card-payment-modal');
    const upiModal = document.getElementById('upi-payment-modal');
    const openModalButton = document.getElementById('open-payment-modal');
    const paymentMethodValue = document.getElementById('payment-method-value');

    const paymentButtons = document.querySelectorAll('.payment-method-btn');

    // 3a. Handle selection of payment method (sets hidden field & button style)
    paymentButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const method = this.getAttribute('data-method');
            paymentMethodValue.value = method;

            paymentButtons.forEach(b => b.classList.remove('border-primary', 'shadow-md'));
            this.classList.add('border-primary', 'shadow-md');
            document.getElementById('payment-method-error').style.display = 'none';
        });
    });

    // 3b. Handle "Donate Now" button click (opens modal)
    openModalButton.addEventListener('click', function() {
        // --- 1. Validate AMOUNT selection ---
        const checkedAmountRadio = monetaryForm.querySelector('input[name="amount"][type="radio"]:checked');
        let finalAmount = 0;
        let amountValid = true;
        
        if (checkedAmountRadio) {
            if (checkedAmountRadio.value === 'custom') {
                // If custom is checked, validate and clean the input
                const rawAmount = customInput.value.replace(/[^0-9.]/g, '');
                finalAmount = parseFloat(rawAmount);
                if (isNaN(finalAmount) || finalAmount <= 0) {
                    amountValid = false;
                }
            } else {
                // Preset amount is selected
                finalAmount = parseFloat(checkedAmountRadio.value);
            }
        } else {
            // No radio button is checked
            amountValid = false;
        }

        if (!amountValid) {
            document.getElementById('amount-error').style.display = 'block';
            alert("Please select a donation amount or enter a valid custom amount.");
            return;
        } else {
            document.getElementById('amount-error').style.display = 'none';
        }
        
        // --- 2. Validate PAYMENT METHOD selection ---
        const method = paymentMethodValue.value;
        if (!method) {
            document.getElementById('payment-method-error').style.display = 'block';
            alert("Please select a payment method.");
            return;
        } else {
             document.getElementById('payment-method-error').style.display = 'none';
        }

        // --- 3. Open the correct modal and set the amount ---
        const displayAmount = "₹" + finalAmount.toLocaleString('en-IN', { minimumFractionDigits: 2 });

        if (method === 'card') {
            document.getElementById('card-payment-amount').innerText = displayAmount;
            cardModal.classList.remove('hidden');
        } else if (method === 'upi') {
            document.getElementById('upi-payment-amount').innerText = displayAmount;
            upiModal.classList.remove('hidden');
        }
    });


    /* ===========================================
       4. HANDLE "COMPLETE PAYMENT" BUTTONS (FINAL FIX)
       ============================================ */
    const completeButtons = document.querySelectorAll('.complete-payment');

    completeButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault(); 
            
            const modalForm = this.closest('form');
            const originalText = this.innerHTML; // Store original text for reset

            // 1. --- Client-Side Modal Form Validation (Card/UPI) ---
            let modalValid = true;
            const inputs = modalForm.querySelectorAll('input[required]');
            
            inputs.forEach(input => {
                if(!input.value.trim()) {
                    modalValid = false;
                    input.classList.add('input-error');
                } else {
                    input.classList.remove('input-error');
                }
            });

            if(!modalValid) {
                alert("Please fill in all payment details.");
                return;
            }

            // 2. --- Submit Logic ---
            
            // Critical Step: Find the currently selected radio button again
            const checkedAmountRadio = monetaryForm.querySelector('input[name="amount"][type="radio"]:checked');
            
            // If custom is selected, set the radio value to the clean numeric input value
            if (checkedAmountRadio && checkedAmountRadio.value === 'custom' && customInput) {
                // This ensures the submitted value for name="amount" is the clean numeric amount
                checkedAmountRadio.value = customInput.value.replace(/[^0-9.]/g, ''); 
            }
            
            // Change Button UI
            this.innerHTML = '<i class="ri-loader-4-line ri-spin"></i> Processing...';
            this.disabled = true; 
            this.classList.add('opacity-75', 'cursor-not-allowed');

            // Force Form Submission
            if (monetaryForm) {
                try {
                    // This bypasses any existing named submit element conflicts
                    HTMLFormElement.prototype.submit.call(monetaryForm);
                } catch (err) {
                    console.error("Submit failed:", err);
                    alert("A critical error occurred during submission. Please try again.");
                    // Reset button if it fails
                    this.innerHTML = originalText;
                    this.disabled = false;
                    this.classList.remove('opacity-75', 'cursor-not-allowed');
                }
            } else {
                // If the main form is missing, revert button state
                 this.innerHTML = originalText;
                 this.disabled = false;
                 this.classList.remove('opacity-75', 'cursor-not-allowed');
                 alert("Error: Main donation form not found.");
            }
        });
    });

    /* ===========================================
       5. FOOD DONATION FORM VALIDATION
       ============================================ */
    const foodDonationForm = document.getElementById('food-donation-form');
    const foodThankYouModal = document.getElementById('food-thank-you-modal');

    if (foodDonationForm) {
        foodDonationForm.addEventListener('submit', function(e) {
            let isValid = true;
            
            // 1. Basic Required Field Check
            const requiredFields = foodDonationForm.querySelectorAll('[required]');
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('input-error');
                } else {
                    field.classList.remove('input-error');
                }
            });

            // 2. Donation Type Check (Hidden input)
            if (!document.getElementById('donation-type').value) {
                isValid = false;
                document.getElementById('donation-type-error').style.display = 'block';
            } else {
                document.getElementById('donation-type-error').style.display = 'none';
            }


            // 3. Advanced: Check if pickup date is in the past
            const pickupDate = document.getElementById('pickup-date');
            if (pickupDate && pickupDate.value) {
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                const selectedDate = new Date(pickupDate.value);
                
                if (selectedDate < today) {
                    isValid = false;
                    pickupDate.classList.add('input-error');
                    alert("The pickup date cannot be in the past.");
                } else {
                    pickupDate.classList.remove('input-error');
                }
            }

            if (!isValid) {
                e.preventDefault(); 
                alert("Please fill in all required fields and check your date selection correctly before submitting.");
            }
        });
        
        // Donation Card Selection
        document.querySelectorAll('.donation-card').forEach(card => {
            card.addEventListener('click', function() {
                document.querySelectorAll('.donation-card').forEach(c => c.classList.remove('border-primary', 'shadow-md'));
                this.classList.add('border-primary', 'shadow-md');
                document.getElementById('donation-type').value = this.getAttribute('data-type');
            });
        });
    }

    /* ===========================================
       6. MODAL CLOSING & UI EFFECTS
       ============================================ */
    
    // Close Modals Logic
    const closeButtons = document.querySelectorAll('.close-payment-modal, #close-thank-you, #close-food-thank-you');
    closeButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Find closest parent with class fixed (the modal container)
            this.closest('.fixed').classList.add('hidden');
        });
    });
    
    window.addEventListener('click', function(e) {
        if (e.target.classList.contains('fixed')) { // Clicking the black backdrop
            e.target.classList.add('hidden');
        }
    });
    
    // Intersection Observer for Fade In (omitted for brevity)
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
    } catch (e) {}

});
</script>
</body>
</html>