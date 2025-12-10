<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CommonMainType;
use App\Models\CommonType;

class CommonTypesSeeder extends Seeder
{
    public function run(): void
    {
        // Create main types
        $mainTypes = [
            [
                'name' => 'Gender',
                'position' => 1,
                'description' => 'Gender types for residents'
            ],
            [
                'name' => 'Room Type',
                'position' => 2,
                'description' => 'Different types of rooms available'
            ],
            [
                'name' => 'Bed Type',
                'position' => 3,
                'description' => 'Types of beds in rooms'
            ],
            [
                'name' => 'Payment Method',
                'position' => 4,
                'description' => 'Available payment methods'
            ],
            [
                'name' => 'Complaint Type',
                'position' => 5,
                'description' => 'Types of complaints'
            ],
            [
                'name' => 'Attendance Status',
                'position' => 6,
                'description' => 'Attendance status types'
            ],
            [
                'name' => 'Inventory Category',
                'position' => 7,
                'description' => 'Inventory item categories'
            ],
            [
                'name' => 'Meal Type',
                'position' => 8,
                'description' => 'Types of meals served'
            ]
        ];

        foreach ($mainTypes as $mainType) {
            CommonMainType::create([
                'name' => $mainType['name'],
                'position' => $mainType['position'],
                'description' => $mainType['description'],
                'status' => true,
                'created_by' => 1, // Assuming admin user with ID 1
                'last_modified_by' => 1,
            ]);
        }

        // Get main types
        $genderType = CommonMainType::where('name', 'Gender')->first();
        $roomType = CommonMainType::where('name', 'Room Type')->first();
        $bedType = CommonMainType::where('name', 'Bed Type')->first();
        $paymentMethod = CommonMainType::where('name', 'Payment Method')->first();
        $complaintType = CommonMainType::where('name', 'Complaint Type')->first();

        // Add types for Gender
        if ($genderType) {
            $genderTypes = [
                ['name' => 'Male', 'position' => 1],
                ['name' => 'Female', 'position' => 2],
                ['name' => 'Other', 'position' => 3],
            ];

            foreach ($genderTypes as $type) {
                CommonType::create([
                    'type_id' => $genderType->id,
                    'name' => $type['name'],
                    'position' => $type['position'],
                    'status' => true,
                    'created_by' => 1,
                    'last_modified_by' => 1,
                ]);
            }
        }

        // Add types for Room Type
        if ($roomType) {
            $roomTypes = [
                ['name' => 'Single AC', 'position' => 1],
                ['name' => 'Single Non-AC', 'position' => 2],
                ['name' => 'Double AC', 'position' => 3],
                ['name' => 'Double Non-AC', 'position' => 4],
                ['name' => 'Deluxe AC', 'position' => 5],
                ['name' => 'Deluxe Non-AC', 'position' => 6],
            ];

            foreach ($roomTypes as $type) {
                CommonType::create([
                    'type_id' => $roomType->id,
                    'name' => $type['name'],
                    'position' => $type['position'],
                    'status' => true,
                    'created_by' => 1,
                    'last_modified_by' => 1,
                ]);
            }
        }

        // Add types for Bed Type
        if ($bedType) {
            $bedTypes = [
                ['name' => 'Single Bed', 'position' => 1],
                ['name' => 'Double Bed', 'position' => 2],
                ['name' => 'Bunk Bed', 'position' => 3],
                ['name' => 'Folding Bed', 'position' => 4],
            ];

            foreach ($bedTypes as $type) {
                CommonType::create([
                    'type_id' => $bedType->id,
                    'name' => $type['name'],
                    'position' => $type['position'],
                    'status' => true,
                    'created_by' => 1,
                    'last_modified_by' => 1,
                ]);
            }
        }

        // Add types for Payment Method
        if ($paymentMethod) {
            $paymentMethods = [
                ['name' => 'Cash', 'position' => 1],
                ['name' => 'bKash', 'position' => 2],
                ['name' => 'Nagad', 'position' => 3],
                ['name' => 'Bank Transfer', 'position' => 4],
                ['name' => 'Credit Card', 'position' => 5],
                ['name' => 'Debit Card', 'position' => 6],
            ];

            foreach ($paymentMethods as $type) {
                CommonType::create([
                    'type_id' => $paymentMethod->id,
                    'name' => $type['name'],
                    'position' => $type['position'],
                    'status' => true,
                    'created_by' => 1,
                    'last_modified_by' => 1,
                ]);
            }
        }

        // Add types for Complaint Type
        if ($complaintType) {
            $complaintTypes = [
                ['name' => 'Maintenance', 'position' => 1],
                ['name' => 'Cleanliness', 'position' => 2],
                ['name' => 'Food Quality', 'position' => 3],
                ['name' => 'Noise Complaint', 'position' => 4],
                ['name' => 'Security Issue', 'position' => 5],
                ['name' => 'WiFi Issue', 'position' => 6],
                ['name' => 'Water Issue', 'position' => 7],
                ['name' => 'Electricity Issue', 'position' => 8],
            ];

            foreach ($complaintTypes as $type) {
                CommonType::create([
                    'type_id' => $complaintType->id,
                    'name' => $type['name'],
                    'position' => $type['position'],
                    'status' => true,
                    'created_by' => 1,
                    'last_modified_by' => 1,
                ]);
            }
        }
    }
}