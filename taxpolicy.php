<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tax Information - ServeKind</title>
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
    <h1 class="text-4xl font-bold">Tax Information</h1>
    <p class="text-sm mt-2">Effective Date: 16 September 2025</p>
  </header>

  <!-- Main Content -->
  <main class="max-w-5xl mx-auto px-6 py-12 bg-white rounded-xl shadow-lg mt-8 space-y-8">

    <section>
      <h2 class="text-2xl font-semibold text-primary mb-3">Introduction</h2>
      <p>
        At <strong>ServeKind</strong>, we are committed to transparency and compliance with all legal 
        requirements. This page provides details about tax exemption benefits for donors and our 
        organization’s registration under applicable laws in India.
      </p>
    </section>

    <section>
      <h2 class="text-2xl font-semibold text-primary mb-3">1. NGO Registration</h2>
      <ul class="list-disc list-inside space-y-2">
        <li><strong>Registered as:</strong> Non-Profit Organization (NGO).</li>
        <li><strong>Registration Number:</strong> [Enter NGO Registration Number].</li>
        <li><strong>Registered Address:</strong> 12 Kindness Road, Chala, Vapi, Gujarat, 396210, India.</li>
      </ul>
    </section>

    <section>
      <h2 class="text-2xl font-semibold text-primary mb-3">2. Income Tax Exemption (India)</h2>
      <p>
        ServeKind is registered under the Income Tax Act, which allows donors to claim tax 
        deductions on eligible donations.
      </p>
      <ul class="list-disc list-inside space-y-2">
        <li><strong>80G Certification:</strong> Donations to ServeKind are eligible for tax deduction 
            under Section 80G of the Income Tax Act, 1961.</li>
        <li><strong>12A Certification:</strong> ServeKind is exempt from paying income tax on its income.</li>
        <li>Donors will receive an official receipt with our NGO details to claim deductions.</li>
      </ul>
    </section>

    <section>
      <h2 class="text-2xl font-semibold text-primary mb-3">3. International Donations</h2>
      <p>
        For donors outside India, ServeKind accepts contributions in compliance with the 
        <strong>Foreign Contribution Regulation Act (FCRA)</strong>, where applicable.
      </p>
      <ul class="list-disc list-inside space-y-2">
        <li>International donations must comply with donor’s local tax regulations.</li>
        <li>Receipts will be issued, but tax benefits may vary depending on the donor’s country of residence.</li>
      </ul>
    </section>

    <section>
      <h2 class="text-2xl font-semibold text-primary mb-3">4. Receipts & Documentation</h2>
      <p>
        Donors will receive receipts via email or physical copy (on request) that include:
      </p>
      <ul class="list-disc list-inside space-y-2">
        <li>Donor’s name and contact details.</li>
        <li>Amount donated and payment details.</li>
        <li>ServeKind’s registration number and 80G certification details.</li>
      </ul>
      <p class="mt-2">
        Please retain these receipts to claim tax benefits when filing income tax returns.
      </p>
    </section>

    <section>
      <h2 class="text-2xl font-semibold text-primary mb-3">5. Disclaimer</h2>
      <p>
        ServeKind provides all necessary documentation to donors for tax purposes. However, we 
        recommend consulting with a tax advisor or financial expert for individual guidance 
        regarding deductions and exemptions.
      </p>
    </section>

    <section>
      <h2 class="text-2xl font-semibold text-primary mb-3">6. Contact Us</h2>
      <p>
        For any queries regarding tax exemption or receipts, please contact us:
      </p>
      <p class="mt-3">
        📧 info@servekind.org <br>
        📞 +91 98765 43210 <br>
        🏢 12 Kindness Road, Chala, Vapi, Gujarat, 396210, India
      </p>
    </section>

  </main>

  <!-- Footer -->
  <footer class="bg-gray-900 text-gray-300 text-center py-6 mt-12">
    <p>© 2025 ServeKind NGO. All Rights Reserved.</p>
    <p class="mt-2">
      <a href="home.php" class="text-secondary hover:underline">Back to Home</a>
    </p>
  </footer>

</body>
</html>
