<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management | Update User</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body {
            font-family: 'Fira Code', monospace;
        }
    </style>
</head>

<body class="bg-[#212631] text-white font-mono min-h-screen flex items-center justify-center p-4">

    <div class="bg-[#2a2f3e] rounded-xl p-8 w-full max-w-md shadow-lg">
        <h1 class="text-2xl md:text-3xl font-bold mb-6 text-center text-blue-400">Update User</h1>

        <form id="updateForm" action="<?= site_url('users/update/' . $user['id']); ?>" method="post" class="flex flex-col gap-4">
            <div class="flex flex-col">
                <label for="last_name" class="text-blue-400 font-semibold mb-1">Last Name</label>
                <input type="text" id="last_name" name="last_name" value="<?= html_escape($user['last_name']); ?>" required
                    class="px-4 py-2 rounded-md bg-[#2d2d3d] border border-gray-600 focus:outline-none focus:border-blue-400 focus:ring-1 focus:ring-blue-400 text-white">
            </div>

            <div class="flex flex-col">
                <label for="first_name" class="text-blue-400 font-semibold mb-1">First Name</label>
                <input type="text" id="first_name" name="first_name" value="<?= html_escape($user['first_name']); ?>" required
                    class="px-4 py-2 rounded-md bg-[#2d2d3d] border border-gray-600 focus:outline-none focus:border-blue-400 focus:ring-1 focus:ring-blue-400 text-white">
            </div>

            <div class="flex flex-col">
                <label for="email" class="text-blue-400 font-semibold mb-1">Email</label>
                <input type="email" id="email" name="email" value="<?= html_escape($user['email']); ?>" required
                    class="px-4 py-2 rounded-md bg-[#2d2d3d] border border-gray-600 focus:outline-none focus:border-blue-400 focus:ring-1 focus:ring-blue-400 text-white">
            </div>

            <!-- Update Button -->
            <button type="button" onclick="openUpdateModal()"
                class="mt-4 py-2 bg-blue-500 text-[#212631] font-bold rounded-md transition">
                Update User
            </button>

            <!--Update Modal -->
            <div id="updateModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
                <div class="bg-[#212631] text-white p-6 rounded-lg w-80 text-center">
                    <h2 class="text-lg font-bold mb-4">Confirm Update</h2>
                    <p class="mb-6">Are you sure you want to update this user?</p>
                    <div class="flex justify-center gap-4">
                        <button type="button" onclick="submitUpdateForm()"
                            class="px-4 py-2 bg-blue-500 text-[#212631] rounded-md font-semibold">Yes, Update</button>
                        <button type="button" onclick="closeUpdateModal()"
                            class="px-4 py-2 bg-gray-700 rounded-md font-semibold">Cancel</button>
                    </div>
                </div>
            </div>
        </form>

        <a href="<?= site_url('users/show'); ?>"
            class="mt-4 inline-block text-center w-full py-2 border border-gray-500 rounded-md hover:border-blue-400 hover:text-blue-400 transition">
            ← Back to Management
        </a>
    </div>

    <script>
        // Update Modal Function
        function openUpdateModal() {
            document.getElementById('updateModal').classList.remove('hidden');
        }

        function closeUpdateModal() {
            document.getElementById('updateModal').classList.add('hidden');
        }

        function submitUpdateForm() {
            document.getElementById('updateForm').submit();
        }
        //
    </script>
</body>

</html>