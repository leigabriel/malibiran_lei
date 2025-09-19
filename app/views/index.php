<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body {
            font-family: 'Fira Code', monospace;
        }
    </style>
</head>

<body class="min-h-screen bg-gray-200 flex items-center justify-center p-4 sm:p-6">

    <!--
    <div class="fixed top-3 right-3 sm:top-4 sm:right-4 z-50">
        <a href="<?= site_url('/'); ?>"
            onclick="return confirm('Are you sure you want to sign out?');"
            class="px-3 py-1.5 sm:px-4 sm:py-2 bg-red-600 text-white text-sm sm:text-base font-semibold rounded-lg shadow hover:bg-red-700 transition">
            Sign Out
        </a>
    </div>
    -->

    <div
        class="w-full max-w-7xl bg-white border-2 border-black/50 shadow-lg shadow-[#212631] rounded-lg p-4 sm:p-6 grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">

        <div class="flex items-center justify-center bg-blue-50 rounded-lg overflow-hidden border border-blue-100 md:h-auto h-64">
            <img src="https://i.pinimg.com/1200x/09/3f/67/093f6715d49d8f14a65c5c8a56050b34.jpg"
                alt="Student Illustration" class="w-full h-full object-cover">
        </div>

        <div class="md:col-span-2 flex flex-col gap-4 sm:gap-6">

            <div class="bg-blue-50 p-4 sm:p-6 rounded-lg border border-blue-100">
                <h1 class="text-2xl sm:text-3xl font-bold text-blue-700 mb-2">Manage Your Students</h1>
                <p class="text-gray-700 text-md sm:text-lg">
                    Easily view, update, or add student records. Keep track of your students’ details efficiently
                    and maintain a clean, organized database.
                </p>
            </div>

            <!-- Search and Add Student -->
            <form method="get" action="" class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
                <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-2/3">
                    <input name="search" type="text" value="<?= isset($search) ? htmlspecialchars($search) : '' ?>" placeholder="Enter name or email..."
                        class="flex-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <div class="flex gap-2 mt-2 sm:mt-0">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition">
                            Search
                        </button>
                        <a href="?"
                            class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">
                            Clear
                        </a>
                    </div>
                </div>
                <!-- Add Student Button -->
                <a href="<?= site_url('students/create'); ?>"
                    class="mt-2 sm:mt-0 px-4 py-2 bg-green-600 text-white font-semibold rounded hover:bg-green-700 transition">
                    Add Student
                </a>
            </form>

            <div class="bg-white p-2 sm:p-4 rounded-lg border border-gray-200 shadow-sm flex flex-col gap-4 overflow-x-auto">

                <table class="min-w-full divide-y divide-gray-300" id="studentTable">
                    <thead class="bg-blue-50">
                        <tr>
                            <th class="px-2 sm:px-4 py-2 text-left text-sm sm:text-lg font-medium text-blue-700 uppercase">ID</th>
                            <th class="px-2 sm:px-4 py-2 text-left text-sm sm:text-lg font-medium text-blue-700 uppercase">Last Name</th>
                            <th class="px-2 sm:px-4 py-2 text-left text-sm sm:text-lg font-medium text-blue-700 uppercase">First Name</th>
                            <th class="px-2 sm:px-4 py-2 text-left text-sm sm:text-lg font-medium text-blue-700 uppercase">Email</th>
                            <th class="px-2 sm:px-4 py-2 text-left text-sm sm:text-lg font-medium text-blue-700 uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="studentBody">
                        <?php foreach (html_escape($students) as $student): ?>
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-2 sm:px-4 py-2 text-sm sm:text-md text-gray-900"><?= $student['id']; ?></td>
                                <td class="px-2 sm:px-4 py-2 text-sm sm:text-md text-gray-900"><?= $student['last_name']; ?></td>
                                <td class="px-2 sm:px-4 py-2 text-sm sm:text-md text-gray-900"><?= $student['first_name']; ?></td>
                                <td class="px-2 sm:px-4 py-2 text-sm sm:text-md text-gray-900"><?= $student['email']; ?></td>
                                <td class="px-2 sm:px-4 py-2 text-sm sm:text-md text-gray-900 space-x-2">
                                    <a href="<?= site_url('students/update/' . $student['id']); ?>"
                                        class="text-blue-600 hover:text-blue-800 font-medium">Update</a>
                                    <span class="text-gray-400">|</span>
                                    <a href="<?= site_url('students/soft-delete/' . $student['id']); ?>"
                                        class="text-red-600 hover:text-red-800 font-medium"
                                        onclick="return confirm('Are you sure you want to delete this student?');">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Pagination Controls -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mt-2 sm:mt-4 gap-2">
                    <div class="flex gap-2">
                        <?php
                        $totalPages = ceil($total / $perPage);
                        $currentPage = isset($page) ? (int)$page : 1;
                        $searchParam = isset($search) && $search !== '' ? '&search=' . urlencode($search) : '';
                        ?>
                        <a href="?page=<?= max(1, $currentPage - 1) . $searchParam ?>"
                            class="px-3 py-1 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition <?= $currentPage <= 1 ? 'pointer-events-none opacity-50' : '' ?>">Previous</a>
                        <span class="text-gray-600 self-center">Page <?= $currentPage ?> of <?= $totalPages ?></span>
                        <a href="?page=<?= min($totalPages, $currentPage + 1) . $searchParam ?>"
                            class="px-3 py-1 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition <?= $currentPage >= $totalPages ? 'pointer-events-none opacity-50' : '' ?>">Next</a>
                    </div>
                </div>
                
            </div>

        </div>
    </div>


</body>

</html>