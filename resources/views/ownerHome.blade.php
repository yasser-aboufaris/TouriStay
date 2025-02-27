<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HouseRent - Owner Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .property-form {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease-out;
        }
        .property-card:hover .property-overlay {
            opacity: 1;
        }
        .property-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .property-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
        /* Hide form content when collapsed */
        .property-form * {
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .property-form.active * {
            opacity: 1;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <i class="fas fa-home text-blue-600 text-3xl mr-2" aria-hidden="true"></i>
                <span class="text-2xl font-bold">
                    <span class="text-blue-600">House</span><span class="text-gray-800">Rent</span>
                </span>
            </div>
            <div class="hidden md:flex space-x-6 items-center">
                <a href="#" class="text-blue-600 font-medium border-b-2 border-blue-600 pb-1">My Properties</a>
                <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors duration-300 hover:border-b-2 hover:border-blue-600 pb-1">Tenants</a>
                <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors duration-300 hover:border-b-2 hover:border-blue-600 pb-1">Analytics</a>
                <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors duration-300 hover:border-b-2 hover:border-blue-600 pb-1">Support</a>
                <div class="flex items-center ml-4">
                    <div class="relative">
                        <img src="https://source.unsplash.com/100x100/?person" alt="Profile" class="w-10 h-10 rounded-full border-2 border-blue-600 cursor-pointer">
                    </div>
                </div>
            </div>
            <button id="mobileMenuButton" class="md:hidden text-gray-600 hover:text-blue-600 focus:outline-none" aria-label="Toggle mobile menu">
                <i class="fas fa-bars text-2xl" aria-hidden="true"></i>
            </button>
        </nav>
        <!-- Mobile menu -->
        <div id="mobileMenu" class="mobile-menu md:hidden bg-white border-t border-gray-100">
            <div class="container mx-auto px-6 py-2">
                <a href="#" class="block py-2 text-blue-600 font-medium">My Properties</a>
                <a href="#" class="block py-2 text-gray-600 hover:text-blue-600 transition-colors">Tenants</a>
                <a href="#" class="block py-2 text-gray-600 hover:text-blue-600 transition-colors">Analytics</a>
                <a href="#" class="block py-2 text-gray-600 hover:text-blue-600 transition-colors">Support</a>
                <div class="flex items-center py-2">
                    <img src="https://source.unsplash.com/100x100/?person" alt="Profile" class="w-8 h-8 rounded-full">
                    <span class="ml-2 text-gray-600">My Account</span>
                </div>
            </div>
        </div>
    </header>

    <!-- Property Management Section -->
    <section class="container mx-auto px-6 py-12">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-4 md:mb-0">My Properties</h2>
            <button id="addPropertyBtn" onclick="toggleForm()" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors duration-300 flex items-center focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                <i class="fas fa-plus mr-2" aria-hidden="true"></i> Add Property
            </button>
        </div>

        <!-- Add Property Form -->
        <div id="propertyForm" class="property-form bg-white p-6 rounded-xl shadow-lg mb-8">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Add New Property</h3>
            <form  action="{{route('houses.create')}}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @csrf
    <div>
        <label for="title" class="block text-gray-700 mb-2 font-medium">Property Title</label>
        <input type="text" id="title" name="title" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" placeholder="Enter property title">
    </div>
    <div>
        <label for="id_categorie" class="block text-gray-700 mb-2 font-medium">Property Category</label>
        <select id="id_categorie" name="id_categorie" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            <option value="" disabled selected>Select property category</option>
            <option value="1">Apartment</option>
            <option value="2">House</option>
            <option value="3">Villa</option>
            <option value="4">Commercial</option>
        </select>
    </div>
    <div>
        <label for="price" class="block text-gray-700 mb-2 font-medium">Price/Month ($)</label>
        <input type="number" id="price" name="price" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" placeholder="Enter monthly rent">
    </div>
    <div>
        <label for="image" class="block text-gray-700 mb-2 font-medium">Property Image</label>
        <input type="file" id="image" name="image" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
    </div>
    <div class="md:col-span-2">
        <label for="description" class="block text-gray-700 mb-2 font-medium">Description</label>
        <textarea id="description" name="description" class="w-full p-2 border rounded-lg h-32 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" placeholder="Describe your property..."></textarea>
    </div>
    <div class="md:col-span-2">
        <label class="block text-gray-700 mb-2 font-medium">Equipment</label>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="flex items-center">
                <input type="checkbox" id="wifi" name="equipements[]" value="1" class="mr-2">
                <label for="wifi">WiFi</label>
            </div>
            <div class="flex items-center">
                <input type="checkbox" id="ac" name="equipements[]" value="2" class="mr-2">
                <label for="ac">Air Conditioning</label>
            </div>
            <div class="flex items-center">
                <input type="checkbox" id="parking" name="equipements[]" value="3" class="mr-2">
                <label for="parking">Parking</label>
            </div>
            <div class="flex items-center">
                <input type="checkbox" id="pool" name="equipements[]" value="4" class="mr-2">
                <label for="pool">Pool</label>
            </div>
        </div>
    </div>
    <div class="md:col-span-2 flex justify-end space-x-4">
        <button type="button" onclick="toggleForm()" class="bg-gray-200 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-300 transition-colors">Cancel</button>
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Submit Property</button>
    </div>
</form>
        </div>

        <!-- Properties Counter -->
        <div class="flex flex-wrap items-center mb-6">
            <span class="bg-blue-100 text-blue-800 rounded-full px-3 py-1 text-sm font-medium mr-2">Total: 2 Properties</span>
            <span class="bg-green-100 text-green-800 rounded-full px-3 py-1 text-sm font-medium mr-2">Rented: 1</span>
            <span class="bg-yellow-100 text-yellow-800 rounded-full px-3 py-1 text-sm font-medium">Available: 1</span>
        </div>

        <!-- Properties Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Property Card 1 -->
            <div class="property-card bg-white rounded-xl shadow-lg overflow-hidden relative">
                <div class="property-overlay absolute inset-0 bg-black bg-opacity-40 opacity-0 transition-opacity duration-300 flex items-center justify-center">
                    <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                        <div class="flex justify-between items-center mb-2">
                            <span class="bg-blue-600 px-3 py-1 rounded-full text-sm font-medium">Active</span>
                            <div class="flex space-x-3">
                                <button class="hover:text-blue-400 transition-colors" aria-label="Edit property">
                                    <i class="fas fa-edit" aria-hidden="true"></i>
                                </button>
                                <button class="hover:text-red-400 transition-colors" aria-label="Delete property">
                                    <i class="fas fa-trash" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                        <button class="bg-white text-blue-600 w-full mt-2 py-2 rounded-lg font-medium hover:bg-blue-50 transition-colors">View Details</button>
                    </div>
                </div>
                <div class="absolute top-4 right-4 z-10">
                    <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-medium shadow-md">Available</span>
                </div>
                <img src="https://source.unsplash.com/400x300/?apartment" alt="Modern Downtown Apartment" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-xl mb-2 text-gray-800">Modern Downtown Apartment</h3>
                    <div class="flex items-center mb-2">
                        <i class="fas fa-map-marker-alt text-red-500 mr-2" aria-hidden="true"></i>
                        <span class="text-gray-600 text-sm">Downtown, City Center</span>
                    </div>
                    <p class="text-gray-600 mb-4">
                        <span class="inline-block mr-3"><i class="fas fa-bed mr-1" aria-hidden="true"></i> 2 beds</span>
                        <span class="inline-block mr-3"><i class="fas fa-bath mr-1" aria-hidden="true"></i> 2 baths</span>
                        <span class="inline-block"><i class="fas fa-ruler-combined mr-1" aria-hidden="true"></i> 1200 sqft</span>
                    </p>
                    <div class="flex justify-between items-center">
                        <span class="text-2xl font-bold text-blue-600">$2,400/mo</span>
                        <div class="flex items-center bg-yellow-50 px-2 py-1 rounded">
                            <i class="fas fa-star text-yellow-400 mr-1" aria-hidden="true"></i>
                            <span class="font-medium">4.8</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Property Card 2 -->
            <div class="property-card bg-white rounded-xl shadow-lg overflow-hidden relative">
                <div class="property-overlay absolute inset-0 bg-black bg-opacity-40 opacity-0 transition-opacity duration-300 flex items-center justify-center">
                    <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                        <div class="flex justify-between items-center mb-2">
                            <span class="bg-green-600 px-3 py-1 rounded-full text-sm font-medium">Rented</span>
                            <div class="flex space-x-3">
                                <button class="hover:text-blue-400 transition-colors" aria-label="Edit property">
                                    <i class="fas fa-edit" aria-hidden="true"></i>
                                </button>
                                <button class="hover:text-red-400 transition-colors" aria-label="Delete property">
                                    <i class="fas fa-trash" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                        <button class="bg-white text-blue-600 w-full mt-2 py-2 rounded-lg font-medium hover:bg-blue-50 transition-colors">View Details</button>
                    </div>
                </div>
                <div class="absolute top-4 right-4 z-10">
                    <span class="bg-green-600 text-white px-3 py-1 rounded-full text-sm font-medium shadow-md">Rented</span>
                </div>
                <img src="https://source.unsplash.com/400x300/?villa" alt="Luxury Beach Villa" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-bold text-xl mb-2 text-gray-800">Luxury Beach Villa</h3>
                    <div class="flex items-center mb-2">
                        <i class="fas fa-map-marker-alt text-red-500 mr-2" aria-hidden="true"></i>
                        <span class="text-gray-600 text-sm">Coastal Area, Beach Front</span>
                    </div>
                    <p class="text-gray-600 mb-4">
                        <span class="inline-block mr-3"><i class="fas fa-bed mr-1" aria-hidden="true"></i> 4 beds</span>
                        <span class="inline-block mr-3"><i class="fas fa-bath mr-1" aria-hidden="true"></i> 3 baths</span>
                        <span class="inline-block"><i class="fas fa-ruler-combined mr-1" aria-hidden="true"></i> 2800 sqft</span>
                    </p>
                    <div class="flex justify-between items-center">
                        <span class="text-2xl font-bold text-blue-600">$5,200/mo</span>
                        <div class="flex items-center bg-yellow-50 px-2 py-1 rounded">
                            <i class="fas fa-star text-yellow-400 mr-1" aria-hidden="true"></i>
                            <span class="font-medium">4.9</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between">
                <div class="mb-6 md:mb-0">
                    <div class="flex items-center">
                        <i class="fas fa-home text-blue-400 text-2xl mr-2" aria-hidden="true"></i>
                        <span class="text-xl font-bold">
                            <span class="text-blue-400">House</span><span class="text-white">Rent</span>
                        </span>
                    </div>
                    <p class="mt-4 text-gray-400 max-w-md">Simplifying property management for landlords and real estate investors.</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="font-semibold text-lg mb-4">Quick Links</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">My Properties</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">Tenants</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">Analytics</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg mb-4">Support</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">Help Center</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">FAQs</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400">© 2025 HouseRent. All rights reserved.</p>
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors"><i class="fab fa-facebook" aria-hidden="true"></i></a>
                    <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                    <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                    <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors"><i class="fab fa-linkedin" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Toggle property form

        function toggleForm() {
            const form = document.getElementById('propertyForm');
            if (form.style.maxHeight) {
                form.style.maxHeight = null;
                // Remove active class to hide content
                setTimeout(function() {
                    form.classList.remove('active');
                }, 200);
            } else {
                // Add active class to show content
                form.classList.add('active');
                form.style.maxHeight = `${form.scrollHeight}px`;
            }
        }

        // Mobile menu toggle
        document.getElementById('mobileMenuButton').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.style.maxHeight = mobileMenu.style.maxHeight ? null : `${mobileMenu.scrollHeight}px`;
        });
    </script>
</body>
</html>