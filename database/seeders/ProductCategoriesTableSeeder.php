<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class ProductCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('product_categories')->insert([
            [
                //1
                'name' => 'HARNESSES - Pro3',
                'name_fr' => 'HARNAIS – Pro3',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                //2
                'name' => 'HARNESSES - Delta Full Body Harnesses',
                'name_fr' => 'HARNAIS – Harnais de sécurité complet Delta',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                //3
                'name' => 'HARNESSES - Specialty Delta Full Body Harnesses',
                'name_fr' => 'HARNAIS – Harnais de sécurité complet spécialisé Delta',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                //4
                'name' => 'HARNESSES - Exofit Full Body Harnesses',
                'name_fr' => 'HARNAIS – Harnais de sécurité complet Exofit',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                //5
                'name' => 'HARNESSES - Exofit Plus Full Body Harnesses',
                'name_fr' => 'HARNAIS – Harnais de sécurité complet Exofit NEX',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                //6
                'name' => 'HARNESSES - Exofit NEX Full Body Harness',
                'name_fr' => 'HARNAIS – Harnais de sécurité complet Exofit NEX Plus',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                //7
                'name' => 'HARNESSES - Strata Full Body Harness',
                'name_fr' => 'HARNAIS – Harnais de sécurité complet Strata',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                //8
                'name' => 'LANYARDS-WORK POSITIONING',
                'name_fr' => 'LONGES – DE POSITIONNEMENT',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                //9
                'name' => 'LANYARDS-SHOCK ABSORBING',
                'name_fr' => 'LONGES – AVEC AMORTISSEUR DE CHOC',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                //10
                'name' => '2017 New Product - Lanyard with Comfort Grip Hook',
                'name_fr' => 'Nouveau produit en 2017 – Longe avec crochet à prise confortable',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                //11
                'name' => 'BELTS & SEATS',
                'name_fr' => 'CEINTURES ET SIÈGES',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                //12
                'name' => 'ANCHOR DEVICES & SYSTEMS',
                'name_fr' => 'SYSTÈMES ET DISPOSITIFS D’ANCRAGE',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                //13
                'name' => 'CONFINED SPACE - SUPPORT',
                'name_fr' => 'ESPACE CLOS – SUPPORT',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                //14
                'name' => 'CONFINED SPACE - WINCHES',
                'name_fr' => 'ESPACE CLOS – TREUILS',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                //15
                'name' => 'CONFINED SPACE - SYSTEMS',
                'name_fr' => 'ESPACE CLOS – SYSTÈMES',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                //16
                'name' => 'GUARD RAILS',
                'name_fr' => 'GARDE-CORPS',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                //17
                'name' => 'HOOKS & CARABINERS',
                'name_fr' => 'HARNAIS – Pro3',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                //18
                'name' => 'RESCUE AND DESCENT',
                'name_fr' => 'SAUVETAGE ET ÉVACUATION',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                //19
                'name' => 'ROPE GRABS',
                'name_fr' => 'COULISSEAUX',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                //20
                'name' => 'VERTICAL CABLE SYSTEMS',
                'name_fr' => 'SYSTÈMES DE CÂBLES VERTICAUX',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                //21
                'name' => 'SECURASPAN',
                'name_fr' => 'SECURASPAN',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                //22
                'name' => 'SAYFLINE',
                'name_fr' => 'SAYFLINE',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                //23
                'name' => "SRL'S - Smart Lock",
                'name_fr' => 'Lignes de vie autorétractables – À verrouillage intelligent',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                //24
                'name' => "SRL'S",
                'name_fr' => 'Lignes de vie autorétractables',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
