<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management | User Data</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body {
            font-family: 'Fira Code', monospace;
        }

        /* Full-screen loading overlay */
        #loadingOverlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        /* Spinner animation */
        .spinner {
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="min-h-screen bg-[#212631] text-white">

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="flex">
        <div class="spinner"></div>
    </div>

    <!-- Navbar -->
    <nav class="w-full bg-[#2a2f3a] fixed top-0 left-0 border-b border-gray-700 z-50">
        <div class="min-screen mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

            <!-- Title (Left) -->
            <a href="<?= site_url('/'); ?>" class="text-center sm:text-left text-xl sm:text-2xl font-bold" onclick="showLoading(event)">User Management</a>

            <!-- Search + Buttons (Right) -->
            <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                <form action="<?= site_url('users/show'); ?>" method="get" class="flex flex-col sm:flex-row sm:items-center gap-2">
                    <?php $q = isset($_GET['q']) ? $_GET['q'] : ''; ?>
                    <input type="text" name="q" placeholder="Search records..." value="<?= html_escape($q); ?>"
                        class="px-3 py-2 rounded-md bg-[#212631] border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 text-white w-full sm:w-64">

                    <!-- Search + Clear buttons -->
                    <div class="flex gap-2">
                        <!-- Search Button -->
                        <button type="submit"
                            class="relative w-10 h-10 bg-blue-600 cursor-pointer rounded-full flex items-center justify-center transition group">
                            <img src="https://cdn-icons-png.flaticon.com/128/10947/10947920.png" alt="Search"
                                class="w-8 h-8">

                            <!-- Tooltip -->
                            <span
                                class="absolute top-full mb-2 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 whitespace-nowrap">
                                Search
                            </span>
                        </button>

                        <!-- Clear Button -->
                        <a href="<?= site_url('users/show'); ?>"
                            class="relative w-10 h-10 bg-white cursor-pointer rounded-full flex items-center justify-center transition group">
                            <img src="https://cdn-icons-png.flaticon.com/128/5249/5249162.png" alt="Clear"
                                class="w-8 h-8">

                            <!-- Tooltip -->
                            <span
                                class="absolute top-full mb-2 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 whitespace-nowrap">
                                Clear
                            </span>
                        </a>

                    </div>
                </form>

                <!-- Create New Button -->
                <a href="<?= site_url('users/create'); ?>"
                    class="relative w-10 h-10 bg-white cursor-pointer rounded-full flex items-center justify-center transition hover:bg-gray-400 group" onclick="showLoading(event)">
                    <img src="https://cdn-icons-png.flaticon.com/128/8377/8377219.png" alt="Create" class="w-8 h-8">

                    <!-- Tooltip -->
                    <span
                        class="absolute top-full mb-2 hidden group-hover:block bg-gray-800 text-white text-xs rounded px-2 py-1 whitespace-nowrap">
                        Create New
                    </span>
                </a>

            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <section class="w-full px-4 sm:px-6 pt-36 pb-10">
        
        <!-- Table -->
        <div class="overflow-x-auto shadow-xl shadow-gray-700/30">
            <table class="min-w-full border border-gray-700 border-collapse bg-[#212631] text-white">
                <thead class="bg-[#1b1f29]">
                    <tr>
                        <th class="px-4 py-3 text-left uppercase text-xs sm:text-sm font-semibold border-r border-gray-700">ID</th>
                        <th class="px-4 py-3 text-left uppercase text-xs sm:text-sm font-semibold border-r border-gray-700">Last Name</th>
                        <th class="px-4 py-3 text-left uppercase text-xs sm:text-sm font-semibold border-r border-gray-700">First Name</th>
                        <th class="px-4 py-3 text-left uppercase text-xs sm:text-sm font-semibold border-r border-gray-700">Email</th>
                        <th class="px-4 py-3 text-left uppercase text-xs sm:text-sm font-semibold">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    <?php
                    $colors = [
                        'bg-red-600',
                        'bg-green-600',
                        'bg-yellow-600',
                        'bg-blue-600',
                        'bg-pink-600',
                        'bg-purple-600',
                        'bg-orange-600',
                        'bg-teal-600'
                    ];
                    $i = 0;
                    foreach (html_escape($users) as $user):
                        $color = $colors[$i % count($colors)];
                    ?>
                        <tr class="hover:bg-[#2a2f3a] transition">
                            <!-- Random Color Badge for ID -->
                            <td class="px-4 py-3 border-r border-gray-700">
                                <span class="px-3 py-1 rounded-md text-white font-bold <?= $color ?>">
                                    <?= sprintf("%02d", $user['id']); ?>
                                </span>
                            </td>
                            <td class="px-4 py-3 border-r border-gray-700"><?= $user['last_name']; ?></td>
                            <td class="px-4 py-3 border-r border-gray-700"><?= $user['first_name']; ?></td>
                            <td class="px-4 py-3 border-r border-gray-700"><?= $user['email']; ?></td>
                            <td class="px-4 py-3 space-x-3">
                                <div class="flex gap-4">
                                    <!-- Update Button -->
                                    <a href="<?= site_url('users/update/' . $user['id']); ?>"
                                        onclick="showLoading(event)"
                                        class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center transition hover:bg-blue-600">
                                        <img src="https://cdn-icons-png.flaticon.com/512/1828/1828911.png" alt="Edit" class="w-5 h-5">
                                    </a>

                                    <!-- Delete Button -->
                                    <button type="button"
                                        onclick="openDeleteModal('<?= site_url('users/delete/' . $user['id']); ?>')"
                                        class="w-10 h-10 bg-red-500 cursor-pointer rounded-full flex items-center justify-center transition hover:bg-red-600">
                                        <img src="https://cdn-icons-png.flaticon.com/512/1214/1214428.png" alt="Delete" class="w-5 h-5">
                                    </button>

                                </div>

                                <!-- Delete Modal -->
                                <div id="deleteModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
                                    <div class="bg-[#212631] text-white p-6 rounded-lg w-80 text-center">
                                        <h2 class="text-lg font-bold mb-4">Confirm Deletion</h2>
                                        <p class="mb-6">Are you sure you want to delete this user?</p>
                                        <div class="flex justify-center gap-4">
                                            <a id="confirmDeleteBtn" href="#"
                                                class="px-4 py-2 bg-red-500 rounded-md font-semibold">Yes, Delete</a>
                                            <button onclick="closeDeleteModal()"
                                                class="px-4 py-2 bg-gray-700 rounded-md font-semibold">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php $i++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="fixed bottom-4 right-4 flex flex-wrap gap-2 z-50">
            <?php if (isset($page)) echo $page; ?>
        </div>

    </section>


    <script>
        // Delete Modal Function
        function openDeleteModal(url) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('confirmDeleteBtn').href = url;
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
        //
        
        function showLoading(event) {
            event.preventDefault(); // Stop default link navigation
            const url = event.currentTarget.href;

            // Show overlay
            document.getElementById('loadingOverlay').style.display = 'flex';

            // Redirect after a tiny delay to allow overlay to render
            setTimeout(() => {
                window.location.href = url;
            }, 300);
        }
    </script>
</body>

</html>