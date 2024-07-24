<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Insert data into provinces table
        DB::table('provinces')->insert([
            ['id' => 1, 'province_libelle' => 'Kinshasa', 'status' => 'actif'],
            ['id' => 2, 'province_libelle' => 'Kongo-Central', 'status' => 'actif'],
            ['id' => 3, 'province_libelle' => 'Kwango', 'status' => 'actif'],
            ['id' => 4, 'province_libelle' => 'Kwilu', 'status' => 'actif'],
            ['id' => 5, 'province_libelle' => 'Mai-Ndombe', 'status' => 'actif'],
            ['id' => 6, 'province_libelle' => 'Equateur', 'status' => 'actif'],
            ['id' => 7, 'province_libelle' => 'Nord-Ubangi', 'status' => 'actif'],
            ['id' => 8, 'province_libelle' => 'Sud-Ubangi', 'status' => 'actif'],
            ['id' => 9, 'province_libelle' => 'Mongala', 'status' => 'actif'],
            ['id' => 10, 'province_libelle' => 'Tshuapa', 'status' => 'actif'],
            ['id' => 11, 'province_libelle' => 'Tshopo', 'status' => 'actif'],
            ['id' => 12, 'province_libelle' => 'Bas-Uele', 'status' => 'actif'],
            ['id' => 13, 'province_libelle' => 'Haut-Uele', 'status' => 'actif'],
            ['id' => 14, 'province_libelle' => 'Ituri', 'status' => 'actif'],
            ['id' => 15, 'province_libelle' => 'Nord-Kivu', 'status' => 'actif'],
            ['id' => 16, 'province_libelle' => 'Sud-Kivu', 'status' => 'actif'],
            ['id' => 17, 'province_libelle' => 'Maniema', 'status' => 'actif'],
            ['id' => 18, 'province_libelle' => 'Haut-Katanga', 'status' => 'actif'],
            ['id' => 19, 'province_libelle' => 'Haut-Lomami', 'status' => 'actif'],
            ['id' => 20, 'province_libelle' => 'Lualaba', 'status' => 'actif'],
            ['id' => 21, 'province_libelle' => 'Tanganyka', 'status' => 'actif'],
            ['id' => 22, 'province_libelle' => 'Lomami', 'status' => 'actif'],
            ['id' => 23, 'province_libelle' => 'Sankuru', 'status' => 'actif'],
            ['id' => 24, 'province_libelle' => 'Kasai Oriental', 'status' => 'actif'],
            ['id' => 25, 'province_libelle' => 'Kasai', 'status' => 'actif'],
            ['id' => 26, 'province_libelle' => 'Tshuapa', 'status' => 'actif'],
            ['id' => 27, 'province_libelle' => 'Kasai Central', 'status' => 'actif'],
        ]);

        // Insert data into villes table
        DB::table('villes')->insert([
            ['id' => 1, 'ville_libelle' => 'Kinshasa', 'status' => 'actif', 'province_id' => 1],
        ]);

        // Insert data into communes table
        DB::table('communes')->insert([
            ['id' => 69, 'code'=>'KN', 'commune_libelle' => 'Kinshasa', 'status' => 'actif', 'ville_id' => 1],
            ['id' => 70, 'code'=>'BR', 'commune_libelle' => 'Barumbu', 'status' => 'actif', 'ville_id' => 1],
            ['id' => 71, 'code'=>'BB', 'commune_libelle' => 'Bumbu', 'status' => 'actif', 'ville_id' => 1],
            ['id' => 72,'code'=>'GB', 'commune_libelle' => 'Gombe', 'status' => 'actif', 'ville_id' => 1],
            ['id' => 73, 'code'=>'KL', 'commune_libelle' => 'Kalamu', 'status' => 'actif', 'ville_id' => 1],
            ['id' => 74, 'code'=>'KV','commune_libelle' => 'Kasa-Vubu', 'status' => 'actif', 'ville_id' => 1],
            ['id' => 75, 'code'=>'KK', 'commune_libelle' => 'Kimbanseke', 'status' => 'actif', 'ville_id' => 1],
            ['id' => 77,'code'=>'KT', 'commune_libelle' => 'Kintambo', 'status' => 'actif', 'ville_id' => 1],
            ['id' => 78, 'code'=>'KS', 'commune_libelle' => 'Kisenso', 'status' => 'actif', 'ville_id' => 1],
            ['id' => 79, 'code'=>'LB', 'commune_libelle' => 'Lemba', 'status' => 'actif', 'ville_id' => 1],
            ['id' => 80, 'code'=>'LT', 'commune_libelle' => 'Limete', 'status' => 'actif', 'ville_id' => 1],
            ['id' => 81, 'code'=>'LG', 'commune_libelle' => 'Lingwala', 'status' => 'actif', 'ville_id' => 1],
            ['id' => 82,'code'=>'MK', 'commune_libelle' => 'Makala', 'status' => 'actif', 'ville_id' => 1],
            ['id' => 83,'code'=>'ML', 'commune_libelle' => 'Maluku', 'status' => 'actif', 'ville_id' => 1],
            ['id' => 84,'code'=>'MS', 'commune_libelle' => 'Masina', 'status' => 'actif', 'ville_id' => 1],
            ['id' => 85,'code'=>'MT', 'commune_libelle' => 'Matete', 'status' => 'actif', 'ville_id' => 1],
            ['id' => 86,'code'=>'MN', 'commune_libelle' => 'Mont Ngafula', 'status' => 'actif', 'ville_id' => 1],
            ['id' => 87,'code'=>'NJ', 'commune_libelle' => 'Ndjili', 'status' => 'actif', 'ville_id' => 1],
            ['id' => 88,'code'=>'NB', 'commune_libelle' => 'Ngaba', 'status' => 'actif', 'ville_id' => 1],
            ['id' => 89,'code'=>'NM', 'commune_libelle' => 'Ngaliema', 'status' => 'actif', 'ville_id' => 1],
            ['id' => 90, 'code'=>'NG', 'commune_libelle' => 'Ngiri-Ngiri', 'status' => 'actif', 'ville_id' => 1],
            ['id' => 91,'code'=>'NS', 'commune_libelle' => 'Nsele', 'status' => 'actif', 'ville_id' => 1],
            ['id' => 92,'code'=>'SL', 'commune_libelle' => 'Selembao', 'status' => 'actif', 'ville_id' => 1],
            ['id' => 93,'code'=>'BD', 'commune_libelle' => 'Bandalungwa', 'status' => 'actif', 'ville_id' => 1],
        ]);

        // Insert data into quartiers table
        DB::table('quartiers')->insert([
            ['id' => 1, 'quartier_libelle' => 'Kingabwa', 'status' => 'actif', 'commune_id' => 80],
            ['id' => 2, 'quartier_libelle' => 'Sous region', 'status' => 'actif', 'commune_id' => 79],
            ['id' => 3, 'quartier_libelle' => 'Salongo', 'status' => 'actif', 'commune_id' => 79],
        ]);
    }
}
