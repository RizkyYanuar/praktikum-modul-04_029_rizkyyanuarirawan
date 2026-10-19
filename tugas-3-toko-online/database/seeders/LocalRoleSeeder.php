<?php

// namespace Database\Seeders;

// use App\Models\User;
// use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\Hash;

// class LocalRoleSeeder extends Seeder
// {
//     public function run(): void
//     {
//         $accounts = [
//             [
//                 'nama_lengkap' => 'Admin Lokal',
//                 'email' => 'admin@example.test',
//                 'role' => 'admin',
//             ],
//             [
//                 'nama_lengkap' => 'Staff Lokal',
//                 'email' => 'staff@example.test',
//                 'role' => 'staff',
//             ],
//             [
//                 'nama_lengkap' => 'Customer Lokal',
//                 'email' => 'customer@example.test',
//                 'role' => 'customer',
//             ],
//         ];

//         foreach ($accounts as $account) {
//             $user = User::firstOrNew([
//                 'email' => $account['email'],
//             ]);

//             $user->nama_lengkap = $account['nama_lengkap'];
//             $user->password = Hash::make(
//                 'GantiPasswordLokal123!'
//             );
//             $user->role = $account['role'];
//             $user->save();
//         }
//     }
// }