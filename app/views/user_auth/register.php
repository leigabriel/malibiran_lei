<!DOCTYPE html>
<html lang="en" class="h-full bg-[#212631] text-[#ebebeb]">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body {
            font-family: 'JetBrains Mono', monospace;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center px-4">
    <main class="w-full max-w-sm bg-[#262b38] p-8 rounded-2xl shadow-lg border border-[#2e3443]">
        <h1 class="text-2xl font-bold tracking-wide text-center mb-6">REGISTER</h1>

        <?php if (isset($error)): ?>
            <div class="mb-4 text-sm text-red-400 bg-red-900/20 border border-red-700 px-4 py-2 rounded-md">
                <?= $error; ?>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('register'); ?>" method="post" class="space-y-5">
            <div>
                <label for="username" class="block text-sm font-medium mb-1">Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    required
                    class="w-full bg-[#1c2029] border border-[#353c4e] focus:border-[#5a6aff] focus:ring-2 focus:ring-[#5a6aff]/40 text-[#ebebeb] rounded-md px-3 py-2 text-sm outline-none transition" />
            </div>

            <div>
                <label for="email" class="block text-sm font-medium mb-1">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    class="w-full bg-[#1c2029] border border-[#353c4e] focus:border-[#5a6aff] focus:ring-2 focus:ring-[#5a6aff]/40 text-[#ebebeb] rounded-md px-3 py-2 text-sm outline-none transition" />
            </div>

            <div>
                <label for="password" class="block text-sm font-medium mb-1">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    class="w-full bg-[#1c2029] border border-[#353c4e] focus:border-[#5a6aff] focus:ring-2 focus:ring-[#5a6aff]/40 text-[#ebebeb] rounded-md px-3 py-2 text-sm outline-none transition" />
            </div>

            <div>
                <label for="role" class="block text-sm font-medium mb-1">Role</label>
                <select
                    id="role"
                    name="role"
                    required
                    class="w-full bg-[#1c2029] border border-[#353c4e] focus:border-[#5a6aff] focus:ring-2 focus:ring-[#5a6aff]/40 text-[#ebebeb] rounded-md px-3 py-2 text-sm outline-none transition cursor-pointer">
                    <option value="" disabled selected hidden>Select role</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <button
                type="submit"
                class="w-full bg-[#5a6aff] hover:bg-[#7383ff] text-white font-semibold rounded-md py-2 mt-2 transition focus:outline-none focus:ring-2 focus:ring-[#5a6aff]/50">
                Register
            </button>
        </form>

        <p class="text-sm text-center mt-6">
            <a href="<?= site_url('login'); ?>" class="text-[#9da4be] hover:text-white transition">Login</a>
        </p>
    </main>
</body>

</html>