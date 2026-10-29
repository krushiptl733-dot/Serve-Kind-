<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FAQ - ServeKind</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com/3.4.16"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#FF6B35',
            secondary: '#4A90E2'
          },
          borderRadius: {
            'none':'0px','sm':'4px',DEFAULT:'8px','md':'12px','lg':'16px','xl':'20px','2xl':'24px','3xl':'32px','full':'9999px','button':'8px'
          }
        }
      }
    }
  </script>
  <link rel="stylesheet" href="style.css"> 
</head>
<body class="bg-gray-50 text-gray-800">

  <!-- Header -->
  <header class="bg-primary text-white py-8 text-center shadow-md">
    <h1 class="text-4xl font-bold">Frequently Asked Questions (FAQ)</h1>
    <p class="text-sm mt-2">Answers to common queries about ServeKind</p>
  </header>

  <!-- Main Content -->
  <main class="max-w-5xl mx-auto px-6 py-12 bg-white rounded-xl shadow-lg mt-8 space-y-6">

    <!-- FAQ Section -->
    <section class="space-y-4">
      <div class="faq-item border-b border-gray-200 pb-4">
        <button class="w-full text-left flex justify-between items-center faq-question font-semibold text-primary">
          What is ServeKind?
          <i class="ri-add-line faq-icon text-xl"></i>
        </button>
        <div class="faq-answer mt-2 hidden text-gray-700">
          ServeKind is a non-profit organization dedicated to fighting hunger, promoting education, 
          and empowering underprivileged communities through donations, volunteer programs, and social initiatives.
        </div>
      </div>

      <div class="faq-item border-b border-gray-200 pb-4">
        <button class="w-full text-left flex justify-between items-center faq-question font-semibold text-primary">
          How can I make a donation?
          <i class="ri-add-line faq-icon text-xl"></i>
        </button>
        <div class="faq-answer mt-2 hidden text-gray-700">
          Donations can be made securely online via our website using credit/debit cards or UPI. 
          You can also donate offline via bank transfer or cheque. Receipts will be provided for all donations.
        </div>
      </div>

      <div class="faq-item border-b border-gray-200 pb-4">
        <button class="w-full text-left flex justify-between items-center faq-question font-semibold text-primary">
          Are donations tax-deductible?
          <i class="ri-add-line faq-icon text-xl"></i>
        </button>
        <div class="faq-answer mt-2 hidden text-gray-700">
          Yes, ServeKind is registered under Section 80G and 12A of the Income Tax Act, 1961. 
          Donations are eligible for tax deductions in India. International donors should check local laws.
        </div>
      </div>

      <div class="faq-item border-b border-gray-200 pb-4">
        <button class="w-full text-left flex justify-between items-center faq-question font-semibold text-primary">
          Can I volunteer with ServeKind?
          <i class="ri-add-line faq-icon text-xl"></i>
        </button>
        <div class="faq-answer mt-2 hidden text-gray-700">
          Absolutely! You can register as a volunteer on our website. We organize events, awareness campaigns, 
          and community programs where volunteers are welcome.
        </div>
      </div>

      <div class="faq-item border-b border-gray-200 pb-4">
        <button class="w-full text-left flex justify-between items-center faq-question font-semibold text-primary">
          How is my donation used?
          <i class="ri-add-line faq-icon text-xl"></i>
        </button>
        <div class="faq-answer mt-2 hidden text-gray-700">
          Donations are used for food drives, education support, healthcare programs, operational costs, 
          and other initiatives to serve underprivileged communities transparently and efficiently.
        </div>
      </div>

      <div class="faq-item border-b border-gray-200 pb-4">
        <button class="w-full text-left flex justify-between items-center faq-question font-semibold text-primary">
          How can I contact ServeKind?
          <i class="ri-add-line faq-icon text-xl"></i>
        </button>
        <div class="faq-answer mt-2 hidden text-gray-700">
          You can reach us via email at <strong>info@servekind.org</strong>, call us at <strong>+91 98765 43210</strong>, 
          or visit our office at 12 Kindness Road, Chala, Vapi, Gujarat, India.
        </div>
      </div>
    </section>

  </main>

  <!-- Footer -->
  <footer class="bg-gray-900 text-gray-300 text-center py-6 mt-12">
    <p>© 2025 ServeKind NGO. All Rights Reserved.</p>
    <p class="mt-2">
      <a href="home.php" class="text-secondary hover:underline">Back to Home</a>
    </p>
  </footer>

  <!-- FAQ Toggle Script -->
  <script>
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
      const btn = item.querySelector('.faq-question');
      const answer = item.querySelector('.faq-answer');
      const icon = item.querySelector('.faq-icon');

      btn.addEventListener('click', () => {
        answer.classList.toggle('hidden');
        icon.classList.toggle('ri-add-line');
        icon.classList.toggle('ri-subtract-line');
      });
    });
  </script>

</body>
</html>
