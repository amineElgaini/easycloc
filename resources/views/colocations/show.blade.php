<x-app-layout>
    <main class="mx-auto w-full max-w-7xl grow px-4 py-8 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-8 lg:flex-row">
            <div class="flex flex-1 flex-col gap-6">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white">{{ $colocation->name }}</h1>
                        <p class="text-slate-500 dark:text-slate-400">
                            {{ $colocation->location }} • 
                            @if($selectedMonth)
                                {{ \Carbon\Carbon::parse($selectedMonth)->format('F Y') }} overview
                            @else
                                Monthly overview
                            @endif
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        @if($colocation->status === 'active')
                            @if(auth()->id() === $colocation->owner_id)
                                <button onclick="toggleCategoryModal(true)" class="flex items-center justify-center gap-2 rounded-lg bg-white border border-slate-200 dark:border-slate-700 px-6 py-3 text-sm font-bold text-slate-700 dark:text-white shadow-sm hover:bg-slate-50 dark:hover:bg-slate-800 transition-all active:scale-95">
                                    <span class="material-symbols-outlined">settings</span>
                                    Manage Categories
                                </button>

                                <form action="{{ route('colocations.cancel', $colocation->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this colocation? This will stop all active transactions and move it to previous colocations.')">
                                    @csrf
                                    <button type="submit" class="flex items-center justify-center gap-2 rounded-lg bg-white border border-rose-200 dark:border-rose-900/30 px-6 py-3 text-sm font-bold text-rose-600 dark:text-rose-400 shadow-sm hover:bg-rose-50 dark:hover:bg-rose-900/10 transition-all active:scale-95">
                                        <span class="material-symbols-outlined">cancel</span>
                                        Cancel Colocation
                                    </button>
                                </form>
                            @endif
                            <a href="{{ route('expenses.create', $colocation->id) }}" class="flex items-center justify-center gap-2 rounded-lg bg-primary px-6 py-3 text-sm font-bold text-white shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all active:scale-95">
                                <span class="material-symbols-outlined">add</span>
                                Create Expense
                            </a>
                        @else
                            <div class="rounded-lg bg-rose-50 dark:bg-rose-900/20 px-4 py-2 border border-rose-100 dark:border-rose-900/30 flex items-center gap-2 text-rose-600 dark:text-rose-400">
                                <span class="material-symbols-outlined text-sm">lock</span>
                                <span class="text-xs font-bold uppercase tracking-wider">Colocation Cancelled</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Category Management Modal -->
                <div id="categoryModal" class="fixed inset-0 z-50 hidden">
                    <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="toggleCategoryModal(false)"></div>
                    <div class="absolute left-1/2 top-1/2 w-full max-w-md -translate-x-1/2 -translate-y-1/2 p-4">
                        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-2xl dark:border-slate-800 dark:bg-slate-900">
                            <!-- Modal Header -->
                            <div class="flex items-center justify-between border-b border-slate-100 p-6 dark:border-slate-800">
                                <h3 class="text-xl font-bold text-slate-900 dark:text-white">Manage Categories</h3>
                                <button onclick="toggleCategoryModal(false)" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">
                                    <span class="material-symbols-outlined">close</span>
                                </button>
                            </div>

                            <!-- Modal Body -->
                            <div class="p-6">
                                <!-- Add Category Form -->
                                <div class="mb-6">
                                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-400">Add New Category</label>
                                    <div class="flex gap-2">
                                        <input type="text" id="newCategoryName" placeholder="Category name..." class="block w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2 text-sm text-slate-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 dark:border-slate-800 dark:bg-slate-800 dark:text-white" />
                                        <button onclick="addCategory()" class="rounded-lg bg-primary px-4 py-2 text-sm font-bold text-white hover:bg-primary/90 transition-all active:scale-95">Add</button>
                                    </div>
                                    <p id="categoryError" class="mt-2 text-xs text-red-500 hidden"></p>
                                </div>

                                <!-- Categories List -->
                                <div>
                                    <label class="mb-3 block text-xs font-bold uppercase tracking-wider text-slate-400">Current Categories</label>
                                    <ul id="categoriesList" class="flex flex-col gap-2 max-h-60 overflow-y-auto pr-2">
                                        @foreach($colocation->categories as $category)
                                            <li class="flex items-center justify-between rounded-xl border border-slate-100 bg-slate-50/50 p-3 dark:border-slate-800 dark:bg-slate-800/50" id="category-{{ $category->id }}">
                                                <span class="text-sm font-medium text-slate-700 dark:text-white">{{ $category->name }}</span>
                                                <button onclick="deleteCategory({{ $category->id }})" class="flex h-8 w-8 items-center justify-center rounded-lg text-slate-400 hover:bg-red-50 hover:text-red-500 transition-all dark:hover:bg-red-900/30">
                                                    <span class="material-symbols-outlined text-lg">delete</span>
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Invitation Modal -->
                <div id="inviteModal" class="fixed inset-0 z-50 hidden">
                    <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="toggleInviteModal(false)"></div>
                    <div class="absolute left-1/2 top-1/2 w-full max-w-md -translate-x-1/2 -translate-y-1/2 p-4">
                        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-2xl dark:border-slate-800 dark:bg-slate-900">
                            <div class="flex items-center justify-between border-b border-slate-100 p-6 dark:border-slate-800">
                                <h3 class="text-xl font-bold text-slate-900 dark:text-white">Invite new member</h3>
                                <button onclick="toggleInviteModal(false)" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">
                                    <span class="material-symbols-outlined">close</span>
                                </button>
                            </div>

                            <div class="p-6">
                                <div class="mb-6">
                                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-400">Email Address</label>
                                    <div class="flex gap-2">
                                        <input type="email" id="inviteEmail" placeholder="friend@example.com" class="block w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-2 text-sm text-slate-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 dark:border-slate-800 dark:bg-slate-800 dark:text-white" />
                                        <button onclick="sendInvitation()" class="rounded-lg bg-primary px-4 py-2 text-sm font-bold text-white hover:bg-primary/90 transition-all active:scale-95">Send</button>
                                    </div>
                                    <p id="inviteError" class="mt-2 text-xs text-red-500 hidden"></p>
                                    <p id="inviteSuccess" class="mt-2 text-xs text-emerald-500 hidden"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    function toggleInviteModal(show) {
                        const modal = document.getElementById('inviteModal');
                        if (show) {
                            modal.classList.remove('hidden');
                            document.body.style.overflow = 'hidden';
                        } else {
                            modal.classList.add('hidden');
                            document.body.style.overflow = 'auto';
                        }
                    }

                    async function sendInvitation() {
                        const emailInput = document.getElementById('inviteEmail');
                        const errorMsg = document.getElementById('inviteError');
                        const successMsg = document.getElementById('inviteSuccess');
                        const email = emailInput.value.trim();

                        if (!email) return;

                        errorMsg.classList.add('hidden');
                        successMsg.classList.add('hidden');

                        try {
                            const response = await fetch('{{ route('colocation.invite.send', $colocation->id) }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({ email: email })
                            });

                            const data = await response.json();

                            if (response.ok) {
                                successMsg.textContent = data.message;
                                successMsg.classList.remove('hidden');
                                emailInput.value = '';
                                setTimeout(() => toggleInviteModal(false), 2000);
                            } else {
                                errorMsg.textContent = data.message || 'Failed to send invitation';
                                errorMsg.classList.remove('hidden');
                            }
                        } catch (error) {
                            errorMsg.textContent = 'Network error. Please try again.';
                            errorMsg.classList.remove('hidden');
                        }
                    }

                    function toggleCategoryModal(show) {
                        const modal = document.getElementById('categoryModal');
                        if (show) {
                            modal.classList.remove('hidden');
                            document.body.style.overflow = 'hidden';
                        } else {
                            modal.classList.add('hidden');
                            document.body.style.overflow = 'auto';
                        }
                    }

                    async function addCategory() {
                        const nameInput = document.getElementById('newCategoryName');
                        const errorMsg = document.getElementById('categoryError');
                        const name = nameInput.value.trim();

                        if (!name) return;

                        errorMsg.classList.add('hidden');

                        try {
                            const response = await fetch('{{ route('categories.store') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({
                                    colocation_id: {{ $colocation->id }},
                                    name: name
                                })
                            });

                            const data = await response.json();

                            if (response.ok) {
                                // Add to list
                                const list = document.getElementById('categoriesList');
                                const li = document.createElement('li');
                                li.className = 'flex items-center justify-between rounded-xl border border-slate-100 bg-slate-50/50 p-3 dark:border-slate-800 dark:bg-slate-800/50';
                                li.id = `category-${data.category.id}`;
                                li.innerHTML = `
                                    <span class="text-sm font-medium text-slate-700 dark:text-white">${data.category.name}</span>
                                    <button onclick="deleteCategory(${data.category.id})" class="flex h-8 w-8 items-center justify-center rounded-lg text-slate-400 hover:bg-red-50 hover:text-red-500 transition-all dark:hover:bg-red-900/30">
                                        <span class="material-symbols-outlined text-lg">delete</span>
                                    </button>
                                `;
                                list.prepend(li);
                                nameInput.value = '';
                                
                                // Show success (optional, maybe color change)
                            } else {
                                errorMsg.textContent = data.message || data.error || 'Failed to add category';
                                errorMsg.classList.remove('hidden');
                            }
                        } catch (error) {
                            errorMsg.textContent = 'Network error. Please try again.';
                            errorMsg.classList.remove('hidden');
                        }
                    }

                    async function deleteCategory(id) {
                        if (!confirm('Are you sure you want to delete this category?')) return;

                        try {
                            const response = await fetch(`/categories/${id}`, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                }
                            });

                            const data = await response.json();

                            if (response.ok) {
                                document.getElementById(`category-${id}`).remove();
                            } else {
                                alert(data.error || 'Failed to delete category');
                            }
                        } catch (error) {
                            alert('Network error. Please try again.');
                        }
                    }
                </script>

                <div class="flex flex-col gap-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Recent Transactions</h3>
                        <div class="flex items-center gap-4">
                            <form action="{{ route('colocations.show', $colocation->id) }}" method="GET" id="monthFilterForm" class="flex items-center gap-2">
                                <label for="month" class="hidden sm:block text-xs font-bold text-slate-400 uppercase tracking-wider">Filter:</label>
                                <select name="month" id="month" onchange="document.getElementById('monthFilterForm').submit()" class="rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-bold text-slate-700 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 dark:border-slate-700 dark:bg-slate-800 dark:text-white transition-all cursor-pointer">
                                    <option value="">All Months</option>
                                    @foreach($availableMonths as $month)
                                        <option value="{{ $month }}" {{ $selectedMonth == $month ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::parse($month)->format('F Y') }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                            <a href="{{ route('colocations.debts', $colocation->id) }}" class="flex items-center gap-1.5 text-xs font-bold text-primary hover:text-primary/80 transition-colors">
                                <span class="material-symbols-outlined text-sm">payments</span>
                                See Settlements
                            </a>
                        </div>
                    </div>
                    
                    @forelse($filteredExpenses as $expense)
                        @php
                            $userShare = $expense->shares->where('user_id', auth()->id())->first();
                            $otherSharesTotal = $expense->shares->where('user_id', '!=', auth()->id())->sum('share_amount');
                            $isPayer = $expense->paid_by === auth()->id();
                        @endphp
                        <div class="group relative flex flex-col gap-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-4 shadow-sm transition-hover hover:shadow-md sm:flex-row sm:items-center sm:justify-between">
                            <div class="flex items-center gap-4">
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                                    <span class="material-symbols-outlined">
                                        @if($expense->category->name == 'Food') shopping_cart
                                        @elseif($expense->category->name == 'Utility') bolt
                                        @else payments @endif
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-slate-900 dark:text-white">{{ $expense->title }}</h4>
                                    <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-slate-500 dark:text-slate-400">
                                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">calendar_today</span> {{ $expense->expense_date->format('M d, Y') }}</span>
                                        <span class="flex items-center gap-1 rounded-full bg-slate-100 dark:bg-slate-800 px-2 py-0.5 font-medium">{{ $expense->category->name }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-end justify-between sm:flex-col sm:items-end">
                                <div class="text-right">
                                    <p class="text-lg font-bold text-slate-900 dark:text-white">${{ number_format($expense->amount, 2) }}</p>
                                    <p class="text-xs text-slate-500">Paid by <span class="font-semibold text-primary">{{ $isPayer ? 'You' : $expense->payer->name }}</span></p>
                                </div>
                                <div class="mt-1">
                                    @if($isPayer)
                                        <span class="rounded bg-emerald-100 dark:bg-emerald-900/30 px-2 py-1 text-[10px] font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">Others owe ${{ number_format($otherSharesTotal, 2) }}</span>
                                    @elseif($userShare)
                                        <span class="rounded bg-primary/10 px-2 py-1 text-[10px] font-bold uppercase tracking-wider text-primary">You owe ${{ number_format($userShare->share_amount, 2) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center py-12 text-slate-500">
                            <span class="material-symbols-outlined text-6xl opacity-20">receipt_long</span>
                            <p class="mt-4 font-medium">No expenses yet</p>
                            <p class="text-sm">
                                @if($selectedMonth)
                                    No expenses found for {{ \Carbon\Carbon::parse($selectedMonth)->format('F Y') }}.
                                @else
                                    Start by creating your first expense!
                                @endif
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>

            <aside class="w-full shrink-0 lg:w-80">
                <div class="flex flex-col gap-6">
                    <a href="{{ route('colocations.debts', $colocation->id) }}" class="group relative flex items-center justify-between rounded-xl bg-primary p-6 text-white shadow-lg shadow-primary/30 transition-transform hover:-translate-y-1">
                        <div>
                            <p class="text-sm font-medium opacity-80">Total you owe</p>
                            <p class="text-3xl font-black">${{ number_format($userOwes, 2) }}</p>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white/20">
                            <span class="material-symbols-outlined text-2xl">account_balance_wallet</span>
                        </div>
                    </a>

                    <div class="rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-6 shadow-sm">
                        <div class="mb-4 flex items-center justify-between">
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white">Members ({{ $membersCount }})</h3>
                            @if(auth()->id() === $colocation->owner_id)
                                <button onclick="toggleInviteModal(true)" class="text-primary hover:underline text-xs font-bold">Invite</button>
                            @endif
                        </div>
                        <ul class="flex flex-col gap-4">
                            @foreach($colocation->members as $member)
                                <li class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="h-10 w-10 overflow-hidden rounded-full ring-2 {{ $member->id === auth()->id() ? 'ring-emerald-500' : 'ring-slate-200 dark:ring-slate-700' }} ring-offset-2 dark:ring-offset-slate-900">
                                            <img class="h-full w-full object-cover" src="{{ $member->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($member->name).'&color=7F9CF5&background=EBF4FF' }}" />
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-900 dark:text-white">
                                                {{ $member->id === auth()->id() ? 'You' : $member->name }}
                                                @if($member->id === $colocation->owner_id)
                                                    <span class="text-[10px] ml-1 px-1.5 py-0.5 bg-slate-100 dark:bg-slate-800 rounded font-normal text-slate-500">Admin</span>
                                                @endif
                                            </p>
                                            <div class="flex items-center gap-2">
                                                <p class="text-[10px] text-emerald-500 font-bold uppercase">Online</p>
                                                <div class="flex items-center gap-0.5 text-amber-500">
                                                    <span class="material-symbols-outlined text-[12px] fill-1">star</span>
                                                    <span class="text-[10px] font-bold">{{ $member->reputation }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center gap-2">
                                        @if($colocation->status === 'active' && auth()->id() === $colocation->owner_id && $member->id !== $colocation->owner_id)
                                            <form action="{{ route('colocations.kick', [$colocation->id, $member->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to kick {{ $member->name }}? Their unpaid debts will be transferred to you.')">
                                                @csrf
                                                <button type="submit" class="flex h-8 w-8 items-center justify-center rounded-lg text-slate-400 hover:bg-rose-50 hover:text-rose-500 transition-all" title="Kick Member">
                                                    <span class="material-symbols-outlined text-lg">person_remove</span>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        @if(auth()->id() !== $colocation->owner_id)
                            </div>
                        @endif
                    </div>
                </div>
            </aside>
        </div>
    </main>
</x-app-layout>