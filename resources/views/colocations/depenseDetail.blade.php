<x-app-layout>
    <div class="relative flex min-h-screen w-full flex-col overflow-x-hidden pt-6">
        <div class="layout-container flex h-full grow flex-col">
            <div class="flex flex-1 flex-col lg:flex-row">
                
                <!-- Main Content -->
                <main class="flex-1 p-6 lg:p-10 space-y-8">
                    <!-- Page Header & Summary Cards -->
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-2xl font-bold">Owing List</h1>
                                <p class="text-slate-500 text-sm">Manage and track communal expense settlements.</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                                <p class="text-slate-500 text-sm font-medium">Total Outstanding</p>
                                <div class="flex items-end gap-2 mt-1">
                                    <h2 class="text-3xl font-bold">${{ number_format($totalOutstanding, 2) }}</h2>
                                    <span class="text-slate-400 text-xs font-medium mb-1.5 flex items-center">
                                        Total unpaid debts
                                    </span>
                                </div>
                            </div>
                            <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                                <p class="text-slate-500 text-sm font-medium">Pending Settlements</p>
                                <div class="flex items-end gap-2 mt-1">
                                    <h2 class="text-3xl font-bold">{{ $pendingSettlementsCount }}</h2>
                                    <span class="text-slate-400 text-xs font-medium mb-1.5">Across {{ $distinctUsersOwing }} users</span>
                                </div>
                            </div>
                        </div>
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
                                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider text-right">Settle</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                    @forelse($meaningfulShares->sortByDesc('id') as $share)
                                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition-colors">
                                            <td class="px-6 py-5">
                                                <div class="flex items-center gap-3">
                                                    <div class="h-8 w-8 overflow-hidden rounded-full ring-2 ring-slate-100 dark:ring-slate-800">
                                                        <img alt="{{ $share->user->name }}" class="h-full w-full object-cover" src="{{ $share->user->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($share->user->name).'&color=7F9CF5&background=EBF4FF' }}" />
                                                    </div>
                                                    <span class="text-sm font-medium text-slate-900 dark:text-white">{{ $share->user->id === auth()->id() ? 'You' : $share->user->name }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-5">
                                                <div class="flex items-center gap-3">
                                                    <div class="h-8 w-8 overflow-hidden rounded-full ring-2 ring-slate-100 dark:ring-slate-800">
                                                        <img alt="{{ $share->expense->payer->name }}" class="h-full w-full object-cover" src="{{ $share->expense->payer->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($share->expense->payer->name).'&color=7F9CF5&background=EBF4FF' }}" />
                                                    </div>
                                                    <span class="text-sm font-medium text-slate-900 dark:text-white">{{ $share->expense->payer->id === auth()->id() ? 'You' : $share->expense->payer->name }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-5">
                                                <div class="flex flex-col">
                                                    <span class="font-bold text-slate-900 dark:text-white">${{ number_format($share->share_amount, 2) }}</span>
                                                    <span class="text-[10px] text-slate-500">{{ $share->expense->title }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-5 text-right">
                                                @if($share->is_payed)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400">
                                                        Paid
                                                    </span>
                                                @elseif(auth()->id() === $colocation->owner_id)
                                                    <form action="{{ route('shares.settle', $share->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @if($share->expense->paid_by === auth()->id())
                                                            <button type="submit" title="Confirm that you received this payment" class="rounded-lg bg-emerald-500 px-3 py-1.5 text-[10px] font-bold uppercase tracking-wider text-white shadow-lg shadow-emerald-500/20 hover:bg-emerald-600 transition-all active:scale-95">
                                                                Confirm Receipt
                                                            </button>
                                                        @else
                                                            <button type="submit" title="Mark this debt as settled" class="rounded-lg bg-primary px-3 py-1.5 text-[10px] font-bold uppercase tracking-wider text-white shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all active:scale-95">
                                                                Settle Debt
                                                            </button>
                                                        @endif
                                                    </form>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400">
                                                        Pending
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                                <span class="material-symbols-outlined text-4xl opacity-20">payments</span>
                                                <p class="mt-2 text-sm">No settlements found</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>