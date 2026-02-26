<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>ColoManager Admin - User Management</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#135bec",
                        "background-light": "#f6f6f8",
                        "background-dark": "#101622",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 font-display">
    <div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden">
        <!-- Top Navigation Bar -->
        <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 px-6 py-3 lg:px-10">
            <div class="flex items-center gap-8">
                <div class="flex items-center gap-3 text-primary">
                    <span class="material-symbols-outlined text-3xl font-bold">domain</span>
                    <h2 class="text-slate-900 dark:text-slate-100 text-lg font-bold leading-tight tracking-tight">ColoManager Admin</h2>
                </div>
                <nav class="hidden md:flex items-center gap-6">
                    <a class="text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary text-sm font-medium transition-colors" href="#">Dashboard</a>
                    <a class="text-primary text-sm font-semibold border-b-2 border-primary pb-1" href="#">Users</a>
                    <a class="text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary text-sm font-medium transition-colors" href="#">Servers</a>
                    <a class="text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary text-sm font-medium transition-colors" href="#">Network</a>
                    <a class="text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-primary text-sm font-medium transition-colors" href="#">Billing</a>
                </nav>
            </div>
            <div class="flex flex-1 justify-end gap-4 items-center">
                <label class="hidden sm:flex flex-col min-w-40 h-10 max-w-64">
                    <div class="flex w-full flex-1 items-stretch rounded-lg h-full bg-slate-100 dark:bg-slate-800">
                        <div class="text-slate-500 flex items-center justify-center pl-4">
                            <span class="material-symbols-outlined text-xl">search</span>
                        </div>
                        <input class="form-input flex w-full min-w-0 flex-1 border-none bg-transparent focus:ring-0 text-sm placeholder:text-slate-500" placeholder="Global search..." value="" />
                    </div>
                </label>
                <div class="relative">
                    <span class="material-symbols-outlined text-slate-600 dark:text-slate-400 cursor-pointer">notifications</span>
                    <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white dark:ring-slate-900"></span>
                </div>
                <div class="bg-primary/10 border border-primary/20 rounded-full size-10 flex items-center justify-center overflow-hidden">
                    <img alt="Avatar" data-alt="Admin user profile avatar" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCP8fzLhyBqoXTHQmso3cW7ARbga7l1is5x4Bi-JqCLtqE1B_U81WMuXWmB-TFRQf_pSNBwRkVoulYJhlfzDxobh_T7cgLEownenS24X7IsAkfy3lcLrx6SfakPf8zqygDisJl3sqU3eBtcfJPo5wcF-Cj8-mYmOkas15lYZBL5KI-_dctEImzPrU3cAqSHsDwEClNCjd31ci_az64lrT9reYQKv08Vpo_dursFkiBh9cYfMPZwcuut6ITCmomQ2MT6fABnwobmgBc" />
                </div>
            </div>
        </header>
        <main class="flex-1 max-w-7xl mx-auto w-full p-4 lg:p-10 flex flex-col gap-8">
            <!-- Page Header & Actions -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div class="flex flex-col gap-2">
                    <div class="flex items-center gap-2 text-primary font-semibold text-sm uppercase tracking-wider">
                        <span class="material-symbols-outlined text-lg">group</span>
                        <span>Access Management</span>
                    </div>
                    <h1 class="text-slate-900 dark:text-slate-100 text-4xl font-black leading-tight tracking-tight">User Directory</h1>
                    <p class="text-slate-500 dark:text-slate-400 text-base max-w-2xl">Manage system access, assign administrative roles, and monitor user reputation scores across all registered colocation clients.</p>
                </div>
                <div class="flex gap-3">
                    <button class="flex items-center gap-2 px-4 py-2 bg-slate-200 dark:bg-slate-800 text-slate-700 dark:text-slate-200 rounded-lg font-bold text-sm hover:bg-slate-300 transition-colors">
                        <span class="material-symbols-outlined text-lg">file_download</span>
                        Export CSV
                    </button>
                    <button class="flex items-center gap-2 px-6 py-2 bg-primary text-white rounded-lg font-bold text-sm hover:opacity-90 transition-opacity shadow-lg shadow-primary/20">
                        <span class="material-symbols-outlined text-lg">person_add</span>
                        Add New User
                    </button>
                </div>
            </div>
            <!-- Filters Section -->
            <div class="bg-white dark:bg-slate-900 rounded-xl p-4 shadow-sm border border-slate-200 dark:border-slate-800 flex flex-col lg:flex-row gap-4">
                <div class="flex-1">
                    <label class="relative block w-full">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                            <span class="material-symbols-outlined">search</span>
                        </span>
                        <input class="form-input block w-full pl-11 pr-4 py-2.5 bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-lg text-sm focus:border-primary focus:ring-1 focus:ring-primary transition-all" placeholder="Search by name, email, or role..." type="text" />
                    </label>
                </div>
                <div class="flex flex-wrap items-center gap-3">
                    <div class="flex items-center gap-2 bg-slate-50 dark:bg-slate-800 px-3 py-2 rounded-lg border border-slate-200 dark:border-slate-700">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-tighter">Status</span>
                        <select class="bg-transparent border-none p-0 text-sm font-medium focus:ring-0">
                            <option>All Statuses</option>
                            <option>Active</option>
                            <option>Suspended</option>
                            <option>Pending</option>
                        </select>
                    </div>
                    <div class="flex items-center gap-2 bg-slate-50 dark:bg-slate-800 px-3 py-2 rounded-lg border border-slate-200 dark:border-slate-700">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-tighter">Role</span>
                        <select class="bg-transparent border-none p-0 text-sm font-medium focus:ring-0">
                            <option>All Roles</option>
                            <option>Administrator</option>
                            <option>Operator</option>
                            <option>Client</option>
                            <option>Guest</option>
                        </select>
                    </div>
                    <button class="flex items-center gap-2 px-4 py-2 text-slate-500 hover:text-primary text-sm font-semibold transition-colors">
                        <span class="material-symbols-outlined text-lg">filter_alt_off</span>
                        Clear
                    </button>
                </div>
            </div>
            <!-- Users Table -->
            <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800">
                                <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">User Details</th>
                                <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Role</th>
                                <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Reputation</th>
                                <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Last Activity</th>
                                <th class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            <!-- Row 1 -->
                            <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/30 transition-colors group">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="h-10 w-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">JD</div>
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold text-slate-900 dark:text-slate-100">John Doe</span>
                                            <span class="text-xs text-slate-500">john.doe@datacenter.net</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-primary/10 text-primary">Administrator</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <div class="w-16 bg-slate-200 dark:bg-slate-700 rounded-full h-1.5 overflow-hidden">
                                            <div class="bg-green-500 h-full w-[95%]"></div>
                                        </div>
                                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">98%</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                                    2 mins ago
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button class="p-2 text-slate-400 hover:text-primary transition-colors">
                                            <span class="material-symbols-outlined text-xl">edit</span>
                                        </button>
                                        <button class="flex items-center gap-1 px-3 py-1.5 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 rounded-lg text-xs font-bold border border-red-100 dark:border-red-900/30 hover:bg-red-100 transition-colors">
                                            <span class="material-symbols-outlined text-sm">block</span>
                                            Ban
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Row 2 -->
                            <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/30 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="h-10 w-10 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-slate-600 dark:text-slate-300 font-bold">SM</div>
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold text-slate-900 dark:text-slate-100">Sarah Miller</span>
                                            <span class="text-xs text-slate-500">sarah@cloudscale.io</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400">Operator</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <div class="w-16 bg-slate-200 dark:bg-slate-700 rounded-full h-1.5 overflow-hidden">
                                            <div class="bg-primary h-full w-[72%]"></div>
                                        </div>
                                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">72%</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                                    4 hours ago
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button class="p-2 text-slate-400 hover:text-primary transition-colors">
                                            <span class="material-symbols-outlined text-xl">edit</span>
                                        </button>
                                        <button class="flex items-center gap-1 px-3 py-1.5 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 rounded-lg text-xs font-bold border border-red-100 dark:border-red-900/30 hover:bg-red-100 transition-colors">
                                            <span class="material-symbols-outlined text-sm">block</span>
                                            Ban
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Row 3 -->
                            <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/30 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="h-10 w-10 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-slate-600 dark:text-slate-300 font-bold">RK</div>
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold text-slate-900 dark:text-slate-100">Robert King</span>
                                            <span class="text-xs text-slate-500">rking@velocity.com</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400">Client</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <div class="w-16 bg-slate-200 dark:bg-slate-700 rounded-full h-1.5 overflow-hidden">
                                            <div class="bg-yellow-500 h-full w-[45%]"></div>
                                        </div>
                                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">45%</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                                    1 day ago
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button class="p-2 text-slate-400 hover:text-primary transition-colors">
                                            <span class="material-symbols-outlined text-xl">edit</span>
                                        </button>
                                        <button class="flex items-center gap-1 px-3 py-1.5 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 rounded-lg text-xs font-bold border border-red-100 dark:border-red-900/30 hover:bg-red-100 transition-colors">
                                            <span class="material-symbols-outlined text-sm">block</span>
                                            Ban
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Row 4 -->
                            <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/30 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div class="h-10 w-10 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-slate-600 dark:text-slate-300 font-bold">AL</div>
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold text-slate-900 dark:text-slate-100">Anna Lee</span>
                                            <span class="text-xs text-slate-500">anna@leehost.net</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400">Client</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <div class="w-16 bg-slate-200 dark:bg-slate-700 rounded-full h-1.5 overflow-hidden">
                                            <div class="bg-green-500 h-full w-[88%]"></div>
                                        </div>
                                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">88%</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                                    3 days ago
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button class="p-2 text-slate-400 hover:text-primary transition-colors">
                                            <span class="material-symbols-outlined text-xl">edit</span>
                                        </button>
                                        <button class="flex items-center gap-1 px-3 py-1.5 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 rounded-lg text-xs font-bold border border-red-100 dark:border-red-900/30 hover:bg-red-100 transition-colors">
                                            <span class="material-symbols-outlined text-sm">block</span>
                                            Ban
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-200 dark:border-slate-800 flex items-center justify-between">
                    <span class="text-xs font-medium text-slate-500">Showing 1 to 4 of 284 results</span>
                    <div class="flex items-center gap-2">
                        <button class="p-1.5 rounded bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-400 cursor-not-allowed">
                            <span class="material-symbols-outlined text-lg">chevron_left</span>
                        </button>
                        <button class="px-3 py-1 rounded bg-primary text-white text-xs font-bold">1</button>
                        <button class="px-3 py-1 rounded bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 text-xs font-bold hover:bg-slate-50 transition-colors">2</button>
                        <button class="px-3 py-1 rounded bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 text-xs font-bold hover:bg-slate-50 transition-colors">3</button>
                        <button class="p-1.5 rounded bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 hover:bg-slate-50 transition-colors">
                            <span class="material-symbols-outlined text-lg">chevron_right</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- System Alert / Information Card -->
            <div class="bg-primary/5 border border-primary/10 rounded-xl p-6 flex flex-col md:flex-row items-center gap-6">
                <div class="flex-shrink-0 size-12 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined text-3xl">info</span>
                </div>
                <div class="flex-1 text-center md:text-left">
                    <h4 class="text-slate-900 dark:text-slate-100 font-bold mb-1">Automated Policy Update</h4>
                    <p class="text-slate-600 dark:text-slate-400 text-sm">Users with a reputation score below 30% are automatically flagged for review. A "Ban" action will revoke all access keys and suspend active VPS instances immediately.</p>
                </div>
                <button class="text-primary font-bold text-sm underline decoration-2 underline-offset-4 hover:text-primary/80 transition-colors">
                    View Policy Docs
                </button>
            </div>
        </main>
        <!-- Footer Area -->
        <footer class="mt-auto px-6 py-8 border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900">
            <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-4 text-slate-500 text-xs">
                <div class="flex items-center gap-4">
                    <span>© 2024 ColoManager Systems Inc.</span>
                    <a class="hover:text-primary" href="#">Privacy Policy</a>
                    <a class="hover:text-primary" href="#">Terms of Service</a>
                </div>
                <div class="flex items-center gap-4">
                    <span class="flex items-center gap-1">
                        <span class="block h-2 w-2 rounded-full bg-green-500"></span>
                        Systems Operational
                    </span>
                    <span class="font-medium">v2.4.0-stable</span>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>