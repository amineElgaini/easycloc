<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Owing List - ColoManager</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet" />
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
                        "display": ["Inter"]
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
            font-size: 24px;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen">
    <div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">
        <div class="layout-container flex h-full grow flex-col">
            <!-- Header/TopNavBar -->
            <header class="flex items-center justify-between border-b border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 px-6 py-4 lg:px-10">
                <div class="flex items-center gap-4">
                    <div class="flex items-center justify-center size-10 rounded-lg bg-primary text-white">
                        <span class="material-symbols-outlined">account_balance_wallet</span>
                    </div>
                    <h2 class="text-xl font-bold tracking-tight">ColoManager</h2>
                </div>
                <div class="flex flex-1 justify-end items-center gap-4 lg:gap-8">
                    <label class="hidden md:flex flex-col min-w-40 max-w-64 w-full">
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                            <input class="form-input w-full rounded-lg border-none bg-slate-100 dark:bg-slate-800 pl-10 pr-4 py-2 text-sm focus:ring-2 focus:ring-primary" placeholder="Search settlements..." />
                        </div>
                    </label>
                    <button class="flex items-center justify-center rounded-lg h-10 w-10 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300">
                        <span class="material-symbols-outlined">filter_list</span>
                    </button>
                    <div class="size-10 rounded-full border-2 border-primary overflow-hidden" data-alt="User profile avatar portrait">
                        <img alt="User Profile" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC_n6O2vTMEpUYAltUJeh2m4T0vVSWiPtpvwjIT7m7f_yT4ZDGGlCEhdU9ENOJoJDsv47saLKWD9W5sjILmqkIujmaAH5nvKsGK3bOepKTN-XeJFsE5LLnLuZdX58hrFfo_ZW5sTEguw9s0ZSPps88Pud2YfXXG0OTj0NAWnIBFINigUG0mgMEm4YWkS2i6p5P7kYYnXVdSjBl52L0qFO3xEeF_4fpkoS8xGafSPxtoTqUyjvKm5cYTyCoOV_6U7Y9ZCchclSQ-SAA" />
                    </div>
                </div>
            </header>
            <div class="flex flex-1 flex-col lg:flex-row">
                <!-- Sidebar -->
                <aside class="w-full lg:w-64 border-r border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-4 shrink-0">
                    <div class="flex flex-col gap-1">
                        <div class="px-3 py-4">
                            <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Unit 402 Dashboard</h3>
                        </div>
                        <nav class="space-y-1">
                            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors" href="#">
                                <span class="material-symbols-outlined">dashboard</span>
                                <span class="text-sm font-medium">Dashboard</span>
                            </a>
                            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors" href="#">
                                <span class="material-symbols-outlined">receipt_long</span>
                                <span class="text-sm font-medium">Expenses</span>
                            </a>
                            <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/10 text-primary" href="#">
                                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1">credit_card</span>
                                <span class="text-sm font-bold">Owing List</span>
                            </a>
                            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors" href="#">
                                <span class="material-symbols-outlined">group</span>
                                <span class="text-sm font-medium">Roommates</span>
                            </a>
                            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors mt-auto" href="#">
                                <span class="material-symbols-outlined">settings</span>
                                <span class="text-sm font-medium">Settings</span>
                            </a>
                        </nav>
                    </div>
                </aside>
                <!-- Main Content -->
                <main class="flex-1 p-6 lg:p-10 space-y-8">
                    <!-- Page Header & Summary Cards -->
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-2xl font-bold">Owing List</h1>
                                <p class="text-slate-500 text-sm">Manage and track communal expense settlements.</p>
                            </div>
                            <button class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-primary/90 transition-all flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm">add</span>
                                New Settlement
                            </button>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                                <p class="text-slate-500 text-sm font-medium">Total Outstanding</p>
                                <div class="flex items-end gap-2 mt-1">
                                    <h2 class="text-3xl font-bold">$1,240.00</h2>
                                    <span class="text-red-500 text-xs font-bold mb-1.5 flex items-center">
                                        <span class="material-symbols-outlined text-xs">trending_up</span>
                                        12%
                                    </span>
                                </div>
                            </div>
                            <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                                <p class="text-slate-500 text-sm font-medium">Pending Settlements</p>
                                <div class="flex items-end gap-2 mt-1">
                                    <h2 class="text-3xl font-bold">8</h2>
                                    <span class="text-slate-400 text-xs font-medium mb-1.5">Across 4 users</span>
                                </div>
                            </div>
                            <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm md:col-span-2 lg:col-span-1">
                                <p class="text-slate-500 text-sm font-medium">Settled this month</p>
                                <div class="flex items-end gap-2 mt-1">
                                    <h2 class="text-3xl font-bold">$850.20</h2>
                                    <span class="text-emerald-500 text-xs font-bold mb-1.5 flex items-center">
                                        <span class="material-symbols-outlined text-xs">check_circle</span>
                                        Completed
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tabs -->
                    <div class="border-b border-slate-200 dark:border-slate-800">
                        <nav class="flex gap-8">
                            <button class="border-b-2 border-primary text-primary px-1 pb-4 text-sm font-bold">Unpaid</button>
                            <button class="text-slate-500 dark:text-slate-400 px-1 pb-4 text-sm font-medium hover:text-slate-700">Settled</button>
                            <button class="text-slate-500 dark:text-slate-400 px-1 pb-4 text-sm font-medium hover:text-slate-700">Disputed</button>
                        </nav>
                    </div>
                    <!-- Settlements Table -->
                    <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800">
                                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Debtor</th>
                                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Creditor</th>
                                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Amount</th>
                                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                    <!-- Row 1 -->
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition-colors">
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-3">
                                                <div class="size-8 rounded-full bg-slate-200" data-alt="Avatar portrait of debtor Alex">
                                                    <img alt="Alex" class="rounded-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC3cPljR5vTfXFIZBDooVwnXEb6fzo1HsQ-Isd5WxXHSdudkV5qeuOXCyh3BGHgtiW2r6NKevB_cI7SARscuqUfhkVGHZzrePx2EId01nZwylwiiuYH-96tadw7V3VWRsiHp7nuKBrmJpO8oz4pvFS0GduxfmzYbPWIoav1B4mLnZ3iStklalbWK3c-blvk5lJDjSISArWg2i8o6O5Wj5F4czRobSu3wTyc1LZCwKWbwRG-5wfLz8mZYBEpDvyDZRKf-2ZzNzHcoKM" />
                                                </div>
                                                <span class="text-sm font-medium">Alex Johnson</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-3">
                                                <div class="size-8 rounded-full bg-slate-200" data-alt="Avatar portrait of creditor Sarah">
                                                    <img alt="Sarah" class="rounded-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCTde9VUIznbx9g4vuuDlOkInIl9pjKG3QsLyi-cwqSbSXBskyUcttJgyXt7dc7XO6EHdaVGVjfY1GPicXjhbWOOf57lMZUebh7DIxs6ngHOFuMyva5LAt9Ur81Rl5843HHJhHOr2yA8XibKGZmBZZ2_qu8cT121uSkfe3ha7qpH52aYBypTopb7djBL_sZ_yJ5BdauoCNVLDF7OrVK70XAVjrh16fS9o4B3kDBFN2471x0wHLeGF9ZsCADizYRlPtftfVPvu7_CA4" />
                                                </div>
                                                <span class="text-sm font-medium">Sarah Chen</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 font-semibold text-slate-700 dark:text-slate-300">$45.00</td>
                                        <td class="px-6 py-5">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400">
                                                Pending
                                            </span>
                                        </td>
                                        <td class="px-6 py-5 text-right">
                                            <button class="text-primary hover:text-primary/80 text-sm font-bold transition-colors">
                                                Mark as Paid
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Row 2 -->
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition-colors">
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-3">
                                                <div class="size-8 rounded-full bg-slate-200" data-alt="Avatar portrait of debtor Jordan">
                                                    <img alt="Jordan" class="rounded-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDs35gy9FT-GpFM6M2rQvINDCMiIRmR5CrE-GU-U2-7-xODGdySCj5ORf6QrV7f5X6RlkxTUcqd6HqttINknF1dXUH43esc_x-MHnfj-po55Sffbzcy5oIsK0QzSigQL2MdS68EXCSrTpPBOVUhjGJyQ2akNMr4Q_n5fW3pmrSCfJq5KY7iNEKnaFQ1ceK9_jyYHoyohQ2_GKe7U1ToyaK6nncUSw__Cg2LOe0R86-lKadhblZNC278VBocUiemOoGpugrbdaQkG_U" />
                                                </div>
                                                <span class="text-sm font-medium">Jordan Smith</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-3">
                                                <div class="size-8 rounded-full bg-slate-200" data-alt="Avatar portrait of creditor Sarah">
                                                    <img alt="Sarah" class="rounded-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC4eovaUNYgDDn40R2YnSOjmFO2-hgRLgfWDgfG8k9ykCZcJbbJTgWetoTUq4ipI_RqX9szuJdcXvWXPY5hwETRz6y6pv9_HRRCmqHrIRc4eNWrMqUjLIMY4NjQaDpLEQ99aV3ygcEO41VoLvf4oR9RgwdWOdkx7vnvWuE8qNR-sZYXI2VBRKWjj5FdvU3BBfHbaWf8_tGXc3_QV8RJsitR1Ch2YJuAVv6TXkdYfzIXsnzgmVsSb4810BjOap-nstjsyHhr_WsPvDs" />
                                                </div>
                                                <span class="text-sm font-medium">Sarah Chen</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 font-semibold text-slate-700 dark:text-slate-300">$120.00</td>
                                        <td class="px-6 py-5">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400">
                                                Pending
                                            </span>
                                        </td>
                                        <td class="px-6 py-5 text-right">
                                            <button class="text-primary hover:text-primary/80 text-sm font-bold transition-colors">
                                                Mark as Paid
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Row 3 -->
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition-colors">
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-3">
                                                <div class="size-8 rounded-full bg-slate-200" data-alt="Avatar portrait of debtor Mike">
                                                    <img alt="Mike" class="rounded-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDrR5WAiMt2nXsoLsk2G71uwAMGzcI4vlaWWTAiaaM867wOCpJuwEtRZhgho0yvCF9oigCOkmMUUXXbRmAU7QIlC0mF80Mz-4754SVvNWt0-MptLnsRVzcayThmF72xQOKQWzyZ1GW4UpJoUGq8940NfyZN5J4YDlZ_div1Gm5EdP-v8pCVbLMh8l3eIofcNBPJwf_Wznrjl1-ckPCzcZt7jPJY9HS8fvAa5ogLuJdQGMRkwq539TNCC-XZdRd08P-b3i0FsYstDsg" />
                                                </div>
                                                <span class="text-sm font-medium">Mike Ross</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-3">
                                                <div class="size-8 rounded-full bg-slate-200" data-alt="Avatar portrait of debtor Alex">
                                                    <img alt="Alex" class="rounded-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBgP_WFtMmCj1iZVLFkQbd6DklrGtyeHJdnLVauWnUUjRYu_NITMwJDrVNgUSj0OeV1Bf-_sIlfKYRs5Oo2sIXGj0KHxGbULz8NMCINoQzRJg-4zkCn5bCwCSdnaxqQ4hhgXkvbD4gx0j30O2Xm1zN2BP0XvzCHnOqyNNa0-_MQR5YckMXcHnwLAeZrTlRGj5I0XoyTJg_QN3q8nqhdpqD_cTNj0uYTmlGJy53U8elsIWnE_t4fwgC4svZkJ__qj_qbtwUnNxjUd3E" />
                                                </div>
                                                <span class="text-sm font-medium">Alex Johnson</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 font-semibold text-slate-700 dark:text-slate-300">$30.00</td>
                                        <td class="px-6 py-5">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400">
                                                Pending
                                            </span>
                                        </td>
                                        <td class="px-6 py-5 text-right">
                                            <button class="text-primary hover:text-primary/80 text-sm font-bold transition-colors">
                                                Mark as Paid
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Row 4 -->
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition-colors">
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-3">
                                                <div class="size-8 rounded-full bg-slate-200" data-alt="Avatar portrait of creditor Sarah">
                                                    <img alt="Sarah" class="rounded-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAlk80YkZxykkuo41ME1X8SVnxvl-VLc7qpnQdyVMadkO3cep5sxOlVftkh3U_afQYQSaKAygMR83SVT_7w5L2nBc9PNdnx2DWuEeCkA7tVg7IupM7m5k-CzuluM_5QE3rdUVALagsmHkGQIRzF2tYe0FNrbkcgC_k3D4l6NqGeSSksOGjyAIoPcBp_ysVIpX8O8icw9SwB96k2W2n6FCsyM1UbCZ_5QdcUFFB3-JdmHI88ujdCQaiBjKTb-YzHhq3Ov0xPLAMP5ck" />
                                                </div>
                                                <span class="text-sm font-medium">Sarah Chen</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-3">
                                                <div class="size-8 rounded-full bg-slate-200" data-alt="Avatar portrait of debtor Jordan">
                                                    <img alt="Jordan" class="rounded-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAemrTF5dXmwhGc6UajWVeLZgmEqDIDCKnXkIorqBvMLQElbOVpS5fVLEt1_KSUEFevwlWIzXPTrQHL09DmtmksQ2xf6MmUZrKHcSPOUd3MBFWtJqstFw8WKX9Ds7vktoyTXTas6EX8kt3fKdOJkXVQnOjETGr0b5CZaUiMh98-U3LwymDIm6R4z5Vl-kSacWGuayuwajrqQAox8GqlEtCHPCVHY0Ug4xr9zLKuwTDxGPkVrhCLnOaaskpbbfAyvIG-giCGqGLzKjk" />
                                                </div>
                                                <span class="text-sm font-medium">Jordan Smith</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 font-semibold text-slate-700 dark:text-slate-300">$15.00</td>
                                        <td class="px-6 py-5">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400">
                                                Pending
                                            </span>
                                        </td>
                                        <td class="px-6 py-5 text-right">
                                            <button class="text-primary hover:text-primary/80 text-sm font-bold transition-colors">
                                                Mark as Paid
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination/Footer -->
                        <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                            <p class="text-xs text-slate-500">Showing 4 of 8 pending settlements</p>
                            <div class="flex gap-2">
                                <button class="p-1 rounded border border-slate-200 dark:border-slate-800 text-slate-400 cursor-not-allowed">
                                    <span class="material-symbols-outlined">chevron_left</span>
                                </button>
                                <button class="p-1 rounded border border-slate-200 dark:border-slate-800 hover:bg-slate-50 dark:hover:bg-slate-800">
                                    <span class="material-symbols-outlined">chevron_right</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Roommate Debt Summary (Card Layout Alternative) -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-bold">Quick Payroom</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div class="bg-white dark:bg-slate-900 p-4 rounded-lg border-l-4 border-primary shadow-sm flex items-center justify-between">
                                <div>
                                    <p class="text-xs text-slate-500 font-medium">Alex Johnson owes you</p>
                                    <p class="text-lg font-bold">$75.00</p>
                                </div>
                                <span class="material-symbols-outlined text-primary/40">arrow_circle_right</span>
                            </div>
                            <div class="bg-white dark:bg-slate-900 p-4 rounded-lg border-l-4 border-red-500 shadow-sm flex items-center justify-between">
                                <div>
                                    <p class="text-xs text-slate-500 font-medium">You owe Sarah</p>
                                    <p class="text-lg font-bold">$12.50</p>
                                </div>
                                <span class="material-symbols-outlined text-red-500/40">arrow_circle_left</span>
                            </div>
                            <div class="bg-white dark:bg-slate-900 p-4 rounded-lg border-l-4 border-primary shadow-sm flex items-center justify-between">
                                <div>
                                    <p class="text-xs text-slate-500 font-medium">Mike Ross owes you</p>
                                    <p class="text-lg font-bold">$124.00</p>
                                </div>
                                <span class="material-symbols-outlined text-primary/40">arrow_circle_right</span>
                            </div>
                            <div class="bg-white dark:bg-slate-900 p-4 rounded-lg border-l-4 border-slate-300 shadow-sm flex items-center justify-between">
                                <div>
                                    <p class="text-xs text-slate-500 font-medium">Jordan Smith owes you</p>
                                    <p class="text-lg font-bold">$0.00</p>
                                </div>
                                <span class="material-symbols-outlined text-slate-300">check_circle</span>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</body>

</html>