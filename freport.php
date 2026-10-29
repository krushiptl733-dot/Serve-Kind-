<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Financial Report - ServeKind</title>
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
    <h1 class="text-4xl font-bold">Financial Report</h1>
    <p class="text-sm mt-2">For the Year Ended: 31 March 2025</p>
  </header>

  <!-- Main Content -->
  <main class="max-w-6xl mx-auto px-6 py-12 bg-white rounded-xl shadow-lg mt-8 space-y-12">

    <!-- Intro -->
    <section>
      <h2 class="text-2xl font-semibold text-primary mb-3">Introduction</h2>
      <p>
        At <strong>ServeKind</strong>, we believe in complete financial transparency.  
        This financial report provides a summary of donations received, funds allocated, and expenses 
        made towards our humanitarian initiatives.
      </p>
    </section>

    <!-- Donations & Income -->
    <section>
      <h2 class="text-2xl font-semibold text-primary mb-3">1. Income Summary</h2>
      <table class="w-full border-collapse border border-gray-300 rounded-lg shadow-sm text-sm">
        <thead class="bg-gray-100 text-gray-700">
          <tr>
            <th class="border border-gray-300 px-4 py-2 text-left">Source</th>
            <th class="border border-gray-300 px-4 py-2 text-right">Amount (INR)</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="border border-gray-300 px-4 py-2">Individual Donations</td>
            <td class="border border-gray-300 px-4 py-2 text-right">₹ 8,50,000</td>
          </tr>
          <tr>
            <td class="border border-gray-300 px-4 py-2">Corporate Sponsorships</td>
            <td class="border border-gray-300 px-4 py-2 text-right">₹ 4,20,000</td>
          </tr>
          <tr>
            <td class="border border-gray-300 px-4 py-2">Grants & Aid</td>
            <td class="border border-gray-300 px-4 py-2 text-right">₹ 6,30,000</td>
          </tr>
          <tr class="bg-gray-100 font-semibold">
            <td class="border border-gray-300 px-4 py-2">Total Income</td>
            <td class="border border-gray-300 px-4 py-2 text-right">₹ 19,00,000</td>
          </tr>
        </tbody>
      </table>
    </section>

    <!-- Expenses -->
    <section>
      <h2 class="text-2xl font-semibold text-primary mb-3">2. Expense Summary</h2>
      <table class="w-full border-collapse border border-gray-300 rounded-lg shadow-sm text-sm">
        <thead class="bg-gray-100 text-gray-700">
          <tr>
            <th class="border border-gray-300 px-4 py-2 text-left">Category</th>
            <th class="border border-gray-300 px-4 py-2 text-right">Amount (INR)</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="border border-gray-300 px-4 py-2">Food Distribution</td>
            <td class="border border-gray-300 px-4 py-2 text-right">₹ 7,00,000</td>
          </tr>
          <tr>
            <td class="border border-gray-300 px-4 py-2">Medical Aid</td>
            <td class="border border-gray-300 px-4 py-2 text-right">₹ 3,50,000</td>
          </tr>
          <tr>
            <td class="border border-gray-300 px-4 py-2">Education Support</td>
            <td class="border border-gray-300 px-4 py-2 text-right">₹ 2,20,000</td>
          </tr>
          <tr>
            <td class="border border-gray-300 px-4 py-2">Operational Costs</td>
            <td class="border border-gray-300 px-4 py-2 text-right">₹ 2,80,000</td>
          </tr>
          <tr class="bg-gray-100 font-semibold">
            <td class="border border-gray-300 px-4 py-2">Total Expenses</td>
            <td class="border border-gray-300 px-4 py-2 text-right">₹ 15,50,000</td>
          </tr>
        </tbody>
      </table>
    </section>

    <!-- Allocation Chart (placeholder) -->
    <section>
      <h2 class="text-2xl font-semibold text-primary mb-3">3. Fund Allocation</h2>
      <p class="mb-4">The chart below shows how donations were utilized across our programs.</p>
      <div class="flex justify-center">
        <img src="FAC.jpg" alt="Fund Allocation Chart" class="rounded-lg shadow-md">
      </div>
    </section>

    <!-- Closing -->
    <section>
      <h2 class="text-2xl font-semibold text-primary mb-3">4. Closing Note</h2>
      <p>
        We thank all our donors, sponsors, and partners for their continued support.  
        Every contribution helps us take one step closer to our mission of feeding hope and serving humanity.  
        <br><br>
        For detailed audited statements, please contact our finance team.
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
