<x-app-layout>

    {{-- Required styles & fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            font-family: 'Material Symbols Outlined';
        }
    </style>

    <main class="flex-1 px-6 py-8 md:px-12 lg:px-20 bg-slate-50 min-h-screen">

        {{-- Dashboard Header --}}
        <div class="mb-8 flex flex-col gap-2 md:flex-row md:items-end md:justify-between">
            <div>
                <h1 class="text-3xl font-black tracking-tight text-slate-900">Dashboard Overview</h1>
                <p class="text-slate-500">Real-time analytics for your colocation network.</p>
            </div>
            <div class="flex items-center gap-3">
                <button class="flex items-center gap-2 rounded-lg bg-white border border-slate-200 px-4 py-2 text-sm font-semibold shadow-sm">
                    <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                    Last 30 Days
                </button>
                <button class="flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-blue-200">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    New Report
                </button>
            </div>
        </div>

        {{-- Stats Grid --}}
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            {{-- Card 1 --}}
            <div class="flex flex-col gap-3 rounded-2xl bg-white border border-slate-200 p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                        <span class="material-symbols-outlined">apartment</span>
                    </div>
                    <span class="flex items-center text-xs font-bold text-emerald-500">
                        <span class="material-symbols-outlined text-[14px]">arrow_upward</span>
                        5.2%
                    </span>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Total Colocations</p>
                    <p class="text-3xl font-bold text-slate-900">{{$totalColocations}}</p>
                </div>
            </div>

            {{-- Card 2 --}}
            <div class="flex flex-col gap-3 rounded-2xl bg-white border border-slate-200 p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-amber-500">
                        <span class="material-symbols-outlined">payments</span>
                    </div>
                    <span class="flex items-center text-xs font-bold text-emerald-500">
                        <span class="material-symbols-outlined text-[14px]">arrow_upward</span>
                        12.4%
                    </span>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Total Expenses</p>
                    <p class="text-3xl font-bold text-slate-900">{{$totalExpenses}}</p>
                </div>
            </div>

            {{-- Card 3 --}}
            <div class="flex flex-col gap-3 rounded-2xl bg-white border border-slate-200 p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-500">
                        <span class="material-symbols-outlined">groups</span>
                    </div>
                    <span class="flex items-center text-xs font-bold text-rose-500">
                        <span class="material-symbols-outlined text-[14px]">arrow_downward</span>
                        2.1%
                    </span>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Total Members</p>
                    <p class="text-3xl font-bold text-slate-900">{{$totalMembers}}</p>
                </div>
            </div>

            {{-- Card 4 --}}
            <div class="flex flex-col gap-3 rounded-2xl bg-white border border-slate-200 p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-rose-50 text-rose-500">
                        <span class="material-symbols-outlined">mail</span>
                    </div>
                    <span class="flex items-center text-xs font-bold text-emerald-500">
                        <span class="material-symbols-outlined text-[14px]">arrow_upward</span>
                        8.0%
                    </span>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Active Invitations</p>
                    <p class="text-3xl font-bold text-slate-900">{{ $activeInvitations }}</p>
                </div>
            </div>
        </div>

        {{-- Charts + Activity --}}
        <div class="mt-10 grid grid-cols-1 gap-8 lg:grid-cols-3">

            {{-- Bar Chart --}}
            <div class="lg:col-span-2 flex flex-col rounded-2xl bg-white border border-slate-200 shadow-sm overflow-hidden">
                <div class="flex items-center justify-between border-b border-slate-100 px-6 py-4">
                    <h3 class="text-lg font-bold text-slate-900">Financial Growth</h3>
                    <div class="flex items-center gap-2">
                        <span class="flex items-center gap-1 text-xs font-medium text-slate-500">
                            <span class="h-2 w-2 rounded-full bg-blue-600 inline-block"></span> Revenue
                        </span>
                        <span class="flex items-center gap-1 text-xs font-medium text-slate-500">
                            <span class="h-2 w-2 rounded-full bg-slate-300 inline-block"></span> Projections
                        </span>
                    </div>
                </div>
                <div class="flex-1 p-6 flex items-end justify-between gap-2 h-64">
                    <div class="w-full bg-blue-100 rounded-t-lg" style="height:40%"></div>
                    <div class="w-full bg-blue-100 rounded-t-lg" style="height:55%"></div>
                    <div class="w-full bg-blue-100 rounded-t-lg" style="height:45%"></div>
                    <div class="w-full bg-blue-100 rounded-t-lg" style="height:70%"></div>
                    <div class="w-full bg-blue-100 rounded-t-lg" style="height:65%"></div>
                    <div class="w-full bg-blue-600 rounded-t-lg" style="height:85%"></div>
                    <div class="w-full bg-blue-600 rounded-t-lg" style="height:95%"></div>
                    <div class="w-full bg-blue-600 rounded-t-lg" style="height:75%"></div>
                    <div class="w-full bg-blue-600 rounded-t-lg" style="height:80%"></div>
                    <div class="w-full bg-blue-600 rounded-t-lg" style="height:100%"></div>
                </div>
                <div class="grid grid-cols-10 px-6 pb-4 text-[10px] uppercase font-bold text-slate-400">
                    <div>JAN</div><div>FEB</div><div>MAR</div><div>APR</div><div>MAY</div>
                    <div>JUN</div><div>JUL</div><div>AUG</div><div>SEP</div><div>OCT</div>
                </div>
            </div>

            {{-- Recent Activity --}}
            <div class="flex flex-col rounded-2xl bg-white border border-slate-200 shadow-sm">
                <div class="border-b border-slate-100 px-6 py-4">
                    <h3 class="text-lg font-bold text-slate-900">Recent Activity</h3>
                </div>
                <div class="flex-1 divide-y divide-slate-100">
                    <div class="flex items-start gap-4 px-6 py-4">
                        <div class="mt-1 flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                            <span class="material-symbols-outlined text-[18px]">person_add</span>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-900">Alex Johnson joined "Sunset Loft"</p>
                            <p class="text-xs text-slate-500">2 minutes ago</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 px-6 py-4">
                        <div class="mt-1 flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-blue-50 text-blue-600">
                            <span class="material-symbols-outlined text-[18px]">receipt_long</span>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-900">New expense added: "Internet Bill"</p>
                            <p class="text-xs text-slate-500">1 hour ago</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 px-6 py-4">
                        <div class="mt-1 flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-amber-100 text-amber-600">
                            <span class="material-symbols-outlined text-[18px]">assignment_turned_in</span>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-900">Invitation accepted by Sarah Miller</p>
                            <p class="text-xs text-slate-500">4 hours ago</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 px-6 py-4">
                        <div class="mt-1 flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-slate-100 text-slate-600">
                            <span class="material-symbols-outlined text-[18px]">edit_document</span>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-900">Rules updated for "The Penthouse"</p>
                            <p class="text-xs text-slate-500">Yesterday</p>
                        </div>
                    </div>
                </div>
                <button class="w-full px-6 py-4 text-center text-sm font-semibold text-blue-600 hover:bg-slate-50 transition-colors">
                    View All Activity
                </button>
            </div>
        </div>

        {{-- Active Colocations Table --}}
        <div class="mt-10 rounded-2xl bg-white border border-slate-200 shadow-sm overflow-hidden">
            <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-900">Active Colocations</h3>
                <div class="flex items-center gap-4">
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.users') }}" class="text-sm font-medium text-indigo-600 hover:underline flex items-center gap-1">
                            <span class="material-symbols-outlined text-[18px]">manage_accounts</span>
                            Manage Users
                        </a>
                    @endif
                    <button class="text-sm font-medium text-blue-600 hover:underline">Manage all</button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50 text-[11px] uppercase tracking-wider text-slate-500">
                            <th class="px-6 py-3 font-bold">Colocation Name</th>
                            <th class="px-6 py-3 font-bold">Location</th>
                            <th class="px-6 py-3 font-bold">Members</th>
                            <th class="px-6 py-3 font-bold">Pending Expenses</th>
                            <th class="px-6 py-3 font-bold text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 font-semibold text-slate-900">Sunset Loft</td>
                            <td class="px-6 py-4 text-slate-500">Paris, France</td>
                            <td class="px-6 py-4">
                                <div class="flex -space-x-2">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-white bg-blue-100 text-[10px] font-bold text-blue-600">AJ</div>
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-white bg-indigo-100 text-[10px] font-bold text-indigo-600">SM</div>
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-white bg-slate-100 text-[10px] font-bold text-slate-600">+3</div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="rounded-full bg-rose-100 px-2.5 py-0.5 text-xs font-semibold text-rose-600">$1,240</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button class="text-slate-400 hover:text-blue-600 transition-colors">
                                    <span class="material-symbols-outlined">more_horiz</span>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 font-semibold text-slate-900">Garden Residence</td>
                            <td class="px-6 py-4 text-slate-500">Lyon, France</td>
                            <td class="px-6 py-4">
                                <div class="flex -space-x-2">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-white bg-emerald-100 text-[10px] font-bold text-emerald-600">MK</div>
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-white bg-amber-100 text-[10px] font-bold text-amber-600">PL</div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-semibold text-slate-600">$0</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button class="text-slate-400 hover:text-blue-600 transition-colors">
                                    <span class="material-symbols-outlined">more_horiz</span>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 font-semibold text-slate-900">The Penthouse</td>
                            <td class="px-6 py-4 text-slate-500">Marseille, France</td>
                            <td class="px-6 py-4">
                                <div class="flex -space-x-2">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-white bg-rose-100 text-[10px] font-bold text-rose-600">TR</div>
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-white bg-slate-100 text-[10px] font-bold text-slate-600">+6</div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="rounded-full bg-rose-100 px-2.5 py-0.5 text-xs font-semibold text-rose-600">$450</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button class="text-slate-400 hover:text-blue-600 transition-colors">
                                    <span class="material-symbols-outlined">more_horiz</span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Footer --}}
        <footer class="mt-12 border-t border-slate-200 py-8 text-center text-sm text-slate-400">
            <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </footer>

    </main>
</x-app-layout>