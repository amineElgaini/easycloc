<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Models\Colocation;
use App\Models\Membership;
use App\Models\Category;
use App\Models\Expense;
use App\Models\ExpenseShare;
use App\Models\Invitation;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // 1Create Admin
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'role' => 'admin',
        ]);

        // Create Normal Users
        $users = User::factory(15)->create();

        // Create 3 Colocations
        for ($i = 0; $i < 3; $i++) {

            // Pick random owner
            $owner = $users->random();

            $colocation = Colocation::create([
                'name' => "Colocation " . ($i + 1),
                'owner_id' => $owner->id,
                'status' => 'active',
            ]);

            // Add owner as member
            Membership::create([
                'user_id' => $owner->id,
                'colocation_id' => $colocation->id,
            ]);

            // Add 3–5 random members
            $members = $users->where('id', '!=', $owner->id)
                ->random(rand(3, 5));

            foreach ($members as $member) {
                Membership::create([
                    'user_id' => $member->id,
                    'colocation_id' => $colocation->id,
                ]);
            }

            $allMembers = Membership::where('colocation_id', $colocation->id)->pluck('user_id');

            // Create Categories
            $categories = collect([
                'Food',
                'Electricity',
                'Water',
                'Internet',
                'Rent'
            ])->map(function ($name) use ($colocation) {
                return Category::create([
                    'colocation_id' => $colocation->id,
                    'name' => $name,
                ]);
            });

            // Create Expenses
            for ($e = 0; $e < 5; $e++) {

                $paidBy = $allMembers->random();
                $amount = rand(100, 1000);

                $expense = Expense::create([
                    'colocation_id' => $colocation->id,
                    'category_id' => $categories->random()->id,
                    'paid_by' => $paidBy,
                    'title' => 'Expense ' . ($e + 1),
                    'amount' => $amount,
                    'expense_date' => now()->subDays(rand(1, 30)),
                ]);

                // Split expense equally
                $share = round($amount / $allMembers->count(), 2);

                foreach ($allMembers as $userId) {
                    ExpenseShare::create([
                        'expense_id' => $expense->id,
                        'user_id' => $userId,
                        'share_amount' => $share,
                        'is_payed' => $userId == $paidBy, // payer already paid
                    ]);
                }
            }

            // Create Invitations for non-members
            $nonMembers = $users->whereNotIn('id', $allMembers);

            foreach ($nonMembers->take(2) as $user) {
                Invitation::create([
                    'colocation_id' => $colocation->id,
                    'email' => $user->email,
                    'token' => Str::random(32),
                    'is_accepted' => false,
                    'expires_at' => now()->addDays(7),
                ]);
            }
        }
    }
}
