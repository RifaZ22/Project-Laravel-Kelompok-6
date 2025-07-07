<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Nike Air Max 90',
                'description' => 'Sepatu lari ikonik dengan bantalan udara dan desain modern.',
                'price' => 1450000,
                'image' => 'https://via.placeholder.com/300?text=Nike+Air+Max+90',
                'stock' => 25,
            ],
            [
                'name' => 'Adidas Ultraboost 22',
                'description' => 'Teknologi boost untuk kenyamanan maksimal saat berlari.',
                'price' => 1800000,
                'image' => 'https://via.placeholder.com/300?text=Ultraboost+22',
                'stock' => 18,
            ],
            [
                'name' => 'Converse Chuck Taylor',
                'description' => 'Sneaker klasik dengan desain timeless dan fleksibel.',
                'price' => 790000,
                'image' => 'https://via.placeholder.com/300?text=Chuck+Taylor',
                'stock' => 30,
            ],
            [
                'name' => 'Vans Old Skool',
                'description' => 'Sepatu kasual anak muda dengan garis putih khas.',
                'price' => 850000,
                'image' => 'https://via.placeholder.com/300?text=Vans+Old+Skool',
                'stock' => 20,
            ],
            [
                'name' => 'New Balance 327',
                'description' => 'Gaya retro-modern untuk keseharian penuh gaya.',
                'price' => 1200000,
                'image' => 'https://via.placeholder.com/300?text=NB+327',
                'stock' => 16,
            ],
            [
                'name' => 'Puma RS-X Reinvent',
                'description' => 'Sneaker chunky bergaya futuristik dan nyaman.',
                'price' => 1100000,
                'image' => 'https://via.placeholder.com/300?text=Puma+RS-X',
                'stock' => 12,
            ],
            [
                'name' => 'Nike Dunk Low Retro',
                'description' => 'Sepatu hypebeast favorit dengan desain retro.',
                'price' => 1350000,
                'image' => 'https://via.placeholder.com/300?text=Nike+Dunk+Low',
                'stock' => 10,
            ],
            [
                'name' => 'Reebok Classic',
                'description' => 'Model klasik yang selalu trendi sepanjang zaman.',
                'price' => 950000,
                'image' => 'https://via.placeholder.com/300?text=Reebok+Classic',
                'stock' => 15,
            ],
            [
                'name' => 'Fila Disruptor II',
                'description' => 'Desain chunky dan bold untuk tampilan edgy.',
                'price' => 875000,
                'image' => 'https://via.placeholder.com/300?text=Fila+Disruptor',
                'stock' => 9,
            ],
            [
                'name' => 'Asics Gel-Kayano',
                'description' => 'Stabilitas premium untuk pelari profesional.',
                'price' => 1600000,
                'image' => 'https://via.placeholder.com/300?text=Asics+Kayano',
                'stock' => 11,
            ],
            [
                'name' => 'Air Jordan 1 Low',
                'description' => 'Sneaker legendaris dengan sentuhan modern.',
                'price' => 2000000,
                'image' => 'https://via.placeholder.com/300?text=Air+Jordan+1+Low',
                'stock' => 7,
            ],
            [
                'name' => 'Crocs Classic Clog',
                'description' => 'Nyaman, ringan, dan cocok untuk santai di rumah.',
                'price' => 480000,
                'image' => 'https://via.placeholder.com/300?text=Crocs+Classic',
                'stock' => 25,
            ],
        ]);
    }
}