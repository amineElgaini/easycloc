<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <div class="bg-slate-50 min-h-screen py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Page Header --}}
            <div class="mb-8 flex items-center gap-4">
                <a href="{{ route('colocations.show', $colocation->id) }}"
                   class="flex items-center justify-center h-9 w-9 rounded-lg bg-white border border-slate-200 text-slate-500 hover:text-slate-900 hover:bg-slate-50 transition-all shadow-sm">
                    <span class="material-symbols-outlined" style="font-size:20px">arrow_back</span>
                </a>
                <div>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900">Add New Expense</h1>
                    <p class="text-sm text-slate-500 mt-0.5">Record a shared expense for <strong>{{ $colocation->name }}</strong>.</p>
                </div>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('expenses.store') }}" class="space-y-6">
                @csrf
                <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    
                    <div class="px-6 py-5 border-b border-slate-100">
                        <h2 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Expense Details</h2>
                    </div>

                    <div class="px-6 py-6 space-y-5">
                        {{-- Title --}}
                        <div class="space-y-1.5">
                            <label for="title" class="block text-sm font-semibold text-slate-700">Description <span class="text-red-500">*</span></label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                                    <span class="material-symbols-outlined" style="font-size:18px">receipt_long</span>
                                </div>
                                <input id="title" type="text" name="title" value="{{ old('title') }}" required placeholder="e.g. Weekly Groceries, Electricity Bill..."
                                    class="block w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 placeholder:text-slate-400 focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all text-sm @error('title') border-red-400 bg-red-50 @enderror" />
                            </div>
                            @error('title') <p class="text-xs text-red-500 flex items-center gap-1"><span class="material-symbols-outlined" style="font-size:14px">error</span>{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            {{-- Amount --}}
                            <div class="space-y-1.5">
                                <label for="amount" class="block text-sm font-semibold text-slate-700">Amount <span class="text-red-500">*</span></label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                                        <span class="material-symbols-outlined" style="font-size:18px">payments</span>
                                    </div>
                                    <input id="amount" type="number" step="0.01" name="amount" value="{{ old('amount') }}" required placeholder="0.00"
                                        class="block w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 placeholder:text-slate-400 focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all text-sm @error('amount') border-red-400 bg-red-50 @enderror" />
                                </div>
                                @error('amount') <p class="text-xs text-red-500 flex items-center gap-1"><span class="material-symbols-outlined" style="font-size:14px">error</span>{{ $message }}</p> @enderror
                            </div>

                            {{-- Date --}}
                            <div class="space-y-1.5">
                                <label for="expense_date" class="block text-sm font-semibold text-slate-700">Date <span class="text-red-500">*</span></label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                                        <span class="material-symbols-outlined" style="font-size:18px">calendar_today</span>
                                    </div>
                                    <input id="expense_date" type="date" name="expense_date" value="{{ old('expense_date', date('Y-m-d')) }}" required
                                        class="block w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all text-sm @error('expense_date') border-red-400 bg-red-50 @enderror" />
                                </div>
                                @error('expense_date') <p class="text-xs text-red-500 flex items-center gap-1"><span class="material-symbols-outlined" style="font-size:14px">error</span>{{ $message }}</p> @enderror
                            </div>
                        </div>

                        {{-- Category --}}
                        <div class="space-y-1.5">
                            <label for="category_id" class="block text-sm font-semibold text-slate-700">Category <span class="text-red-500">*</span></label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                                    <span class="material-symbols-outlined" style="font-size:18px">category</span>
                                </div>
                                <select id="category_id" name="category_id" required
                                    class="block w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all text-sm @error('category_id') border-red-400 bg-red-50 @enderror">
                                    <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category_id') <p class="text-xs text-red-500 flex items-center gap-1"><span class="material-symbols-outlined" style="font-size:14px">error</span>{{ $message }}</p> @enderror
                        </div>

                        <div class="pt-4 flex items-center gap-3 bg-blue-50 p-4 rounded-xl border border-blue-100">
                            <div class="flex-shrink-0 flex h-8 w-8 items-center justify-center rounded-full bg-blue-100 text-blue-600">
                                <span class="material-symbols-outlined" style="font-size:18px">info</span>
                            </div>
                            <p class="text-xs text-blue-700 leading-relaxed">
                                This expense will be <strong>split equally</strong> among all current members of "{{ $colocation->name }}". 
                                Your share will be marked as paid automatically.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center justify-between gap-3 pb-8">
                    <a href="{{ route('colocations.show', $colocation->id) }}"
                       class="inline-flex items-center gap-2 rounded-xl px-5 py-2.5 text-sm font-bold text-slate-600 bg-white border border-slate-200 hover:bg-slate-50 shadow-sm transition-all">
                        <span class="material-symbols-outlined" style="font-size:18px">close</span>
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-6 py-2.5 text-sm font-bold text-white shadow-lg shadow-blue-200 hover:bg-blue-700 transition-all">
                        <span class="material-symbols-outlined" style="font-size:18px">add_circle</span>
                        Save Expense
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
