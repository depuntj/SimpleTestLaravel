<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Customer;
use App\Models\Contact;
use App\Models\Sale;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        // Create sample customers
        $customers = [
            [
                'name' => 'Acme Corporation',
                'email' => 'info@acme.com',
                'phone' => '555-123-4567',
                'address' => '123 Main St, Anytown, AT 12345',
                'location' => 'New York',
                'category' => 'Enterprise'
            ],
            [
                'name' => 'Wayne Enterprises',
                'email' => 'info@wayne.com',
                'phone' => '555-456-7890',
                'address' => '456 Gotham Ave, Gotham City, GC 67890',
                'location' => 'New York',
                'category' => 'Enterprise'
            ],
            [
                'name' => 'Stark Industries',
                'email' => 'info@stark.com',
                'phone' => '555-789-0123',
                'address' => '789 Tech Blvd, Malibu, CA 90210',
                'location' => 'California',
                'category' => 'Enterprise'
            ],
            [
                'name' => 'Small Business Ltd',
                'email' => 'info@smallbiz.com',
                'phone' => '555-321-7654',
                'address' => '321 Small St, Smallville, SV 54321',
                'location' => 'California',
                'category' => 'SMB'
            ],
            [
                'name' => 'Startup Inc',
                'email' => 'info@startup.com',
                'phone' => '555-987-6543',
                'address' => '987 Innovation Way, Tech Valley, TV 98765',
                'location' => 'Texas',
                'category' => 'Startup'
            ],
            [
                'name' => 'Tech Innovators',
                'email' => 'info@techinnovate.com',
                'phone' => '555-234-5678',
                'address' => '234 Innovation Dr, Silicon Valley, SV 23456',
                'location' => 'Texas',
                'category' => 'Startup'
            ],
        ];

        foreach ($customers as $customerData) {
            $customer = Customer::create($customerData);

            // Create contacts for each customer
            $contacts = [
                [
                    'name' => 'John Doe',
                    'email' => 'john@' . substr($customerData['email'], 5),
                    'phone' => $customerData['phone']
                ],
                [
                    'name' => 'Jane Smith',
                    'email' => 'jane@' . substr($customerData['email'], 5),
                    'phone' => str_replace('555', '444', $customerData['phone'])
                ]
            ];

            foreach ($contacts as $contactData) {
                $customer->contacts()->create($contactData);
            }

            // Create sales for each customer
            for ($i = 1; $i <= 3; $i++) {
                $date = now()->subMonths(rand(0, 5))->subDays(rand(1, 28));
                $customer->sales()->create([
                    'sale_date' => $date,
                    'quantity' => rand(1, 10),
                    'total_price' => rand(100, 1000) + (rand(0, 99) / 100),
                    'notes' => 'Sample sale ' . $i . ' for ' . $customerData['name']
                ]);
            }
        }
    }
}
