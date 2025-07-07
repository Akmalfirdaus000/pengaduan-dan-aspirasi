<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Complaint;
use App\Models\ComplaintStatusHistory;
use App\Models\User;
use Auth;
use Illuminate\Database\Seeder;

class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $categories = Category::all();

        foreach ($categories as $category) {
            $complaint = Complaint::create([
                'user_id' => $user->id,
                'category_id' => $category->id,
                'title' => 'Masalah '. $category->name . ' di Sumatera',
                'description' => 'Terjadi masalah serius di Sumatera terkait ' . $category->name,
                'status' => 'pending',
                'photo' => '/complaints/9d88a7b8-2503-4e23-b6b9-c4ae263f7df1-1732103379.webp',
                'location' => 'Jl. Akbardokoni, Kecamatan Ambatukam'
            ]);

            ComplaintStatusHistory::create([
                'complaint_id' => $complaint->id,
                'changed_by' => $user->id,
                'status' => 'pending',
                'note' => 'Aduan Dikirim Oleh User'. $user->name
            ]);
        }
    }
}