<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body {
            font-family: 'Fira Code', monospace;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="grid grid-cols-1 md:grid-cols-2 w-full max-w-4xl bg-white rounded-xl border-2 border-black/50 shadow-lg shadow-[#212631] overflow-hidden">

        <div class="bg-gray-200 h-64 md:h-auto">
            <img src="https://i.pinimg.com/1200x/09/3f/67/093f6715d49d8f14a65c5c8a56050b34.jpg"
                alt="Students Illustration"
                class="w-full h-full object-cover">
        </div>

        <div class="flex items-center justify-center p-4 md:p-6">
            <div class="w-full max-w-sm">
                <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Update Student</h1>

                <form action="<?= site_url('students/update/' . $students['id']); ?>" method="post" class="space-y-4">
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-blue-700">Last Name</label>
                        <input type="text" id="last_name" name="last_name" value="<?= html_escape($students['last_name']); ?>"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">
                    </div>

                    <div>
                        <label for="first_name" class="block text-sm font-medium text-blue-700">First Name</label>
                        <input type="text" id="first_name" name="first_name" value="<?= html_escape($students['first_name']); ?>"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-blue-700">Email</label>
                        <input type="email" id="email" name="email" value="<?= html_escape($students['email']); ?>"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">
                    </div>

                    <div class="flex flex-col sm:flex-row justify-between items-stretch sm:items-center mt-4 gap-2">
                        <button type="submit"
                            onclick="return confirm('Are you sure you want to update this student?');"
                            class="w-full sm:w-auto px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 transition">
                            Update
                        </button>
                        <a href="<?= site_url('students/index'); ?>"
                            class="w-full sm:w-auto px-4 py-2 bg-gray-300 text-gray-800 font-semibold rounded-lg shadow hover:bg-gray-400 transition">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>

    </div>

</body>

</html>