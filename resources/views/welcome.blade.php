<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDIID Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <link rel="icon" href="/public/images/favicon-M-nobg-jaraknew.png" type="image/x-icon">


</head>

<body class="bg-gray-100">

    <!-- Header -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto flex items-center justify-between p-4">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <a href="/"><svg class="h-10 w-10 text-purple-600"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M17 8v-3a1 1 0 0 0 -1 -1h-10a2 2 0 0 0 0 4h12a1 1 0 0 1 1 1v3m0 4v3a1 1 0 0 1 -1 1h-12a2 2 0 0 1 -2 -2v-12" />  <path d="M20 12v4h-4a2 2 0 0 1 0 -4h4" /></svg></a>
                <a href="/"><span class="font-bold text-xl text-grey-900">MDIID</span>
                </a>
            </div>
            

            <!-- Search and Login -->
            <div class="flex items-center space-x-4">
                <button> <a href="/admin" class="text-purple-600 text-lg font-medium border border-purple-600 px-6 py-2 rounded-full shadow-lg transition-transform transform hover:scale-105 hover:bg-purple-100 hover:text-purple-700">Log In</a></button>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-100 via-green-50 to-yellow-50  ">
        <div class="container mx-auto flex flex-col lg:flex-row items-center p-6 lg:p-16">
            <!-- Text Content -->
            <div class="lg:w-1/2 space-y-6">
                <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                    Simplify Your Billing with <span class="text-purple-600 italic">MDIID</span>
                </h1>
                <p class="text-gray-600 text-lg mb-6">
                    More than a <span class="text-teal-500">wallet</span>. Easily Manage All Aspects of Billing and Financial Reporting with Our Integrated System. Featuring advanced security, global access, and in-depth reporting.
                </p>
                <div class="mt-8 flex space-x-4">
                    <a href="/admin" class="bg-purple-600 text-white px-8 py-4 rounded-full text-lg font-semibold shadow-lg transition-transform transform hover:scale-105 hover:bg-purple-700 hover:shadow-xl">
                        Get Started
                    </a>
                    {{-- <a href="#" class="text-purple-600 text-lg font-medium border border-purple-600 px-8 py-4 rounded-full shadow-lg transition-transform transform hover:scale-105 hover:bg-purple-100 hover:text-purple-700">
                        Learn More
                    </a> --}}
                </div>
            </div>

            <!-- Image Section -->
            <div class="flex justify-center lg:justify-end mt-4 lg:mt-2 ml-2">
                <img src="https://img.freepik.com/free-photo/shipping-document-laptop-connection-homepage_53876-138115.jpg?t=st=1724298894~exp=1724302494~hmac=1debbefaa5cf49bc988d90193517b8f2bd5577b73bc3acc37cbd96494d9fbb39&w=590" alt="Invoice Template" class="rounded-lg shadow-lg scale-110">
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-gradient-to-r from-blue-100 via-green-50 to-yellow-50 py-10">
        <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-white p-6 rounded-lg shadow-lg flex items-center transition-transform transform hover:scale-105" data-aos="fade-up" data-aos-duration="1000">
                <!-- Logo on the left -->
                <div class="flex-shrink-0">
                    <svg class="h-12 w-12 text-purple-600" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"/>
                        <path d="M9 12l2 2l4 -4" />
                        <path d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3" />
                    </svg>
                </div>
                
                <!-- Text on the right -->
                <div class="ml-4">
                    <h3 class="text-xl font-semibold text-gray-800">Secure Payments</h3>
                    <p class="text-gray-600 mt-2">
                        Our payment system is designed to safeguard your data and transactions.
                    </p>
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="bg-white p-6 rounded-lg shadow-lg flex items-center transition-transform transform hover:scale-105" data-aos="fade-up" data-aos-duration="1200">
                <div class="flex-shrink-0">
                    <svg class="h-12 w-12 text-purple-600" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"/>
                        <circle cx="12" cy="12" r="9" />
                        <path d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 0 0 0 4h2a2 2 0 0 1 0 4h-2a2 2 0 0 1 -1.8 -1" />
                        <path d="M12 6v2m0 8v2" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-xl font-semibold text-gray-800">Global Access</h3>
                    <p class="text-gray-600 mt-2">
                        Access billing dashboard and reports from anywhere and anytime with global access features.
                    </p>
                </div>
            </div>

            <!-- Feature 3 -->
            <div class="bg-white p-6 rounded-lg shadow-lg flex items-center transition-transform transform hover:scale-105" data-aos="fade-up" data-aos-duration="1400">
                <div class="flex-shrink-0">
                    <img src="https://img.icons8.com/?size=100&id=112546&format=png&color=7A05CB" alt="Report Icon" class="h-12 text-purple-600">
                </div>
                <div class="ml-4">
                    <h3 class="text-xl font-semibold text-gray-800">Reporting</h3>
                    <p class="text-gray-600 mt-2">
                        Gain deep insights with our comprehensive reporting system. Analyze transaction data in detail.
                    </p>
                </div>
            </div>
        </div>
    </section>
  

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-3">
        <div class="text-center text-gray-400 mt-2">
            &copy; 2024 MDIID. All Rights Reserved.
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
    AOS.init();
    </script>
</body>

</html>
