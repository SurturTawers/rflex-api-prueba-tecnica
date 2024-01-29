<?php

namespace Database\Seeders;

use App\Models\Currencies;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $currencies = [
            [
                'codigo' => 'dolar',
                'is_active' => 1,
                'nombre' => 'Dólar observado',
                'unidad_medida' => 'Pesos'
            ],
            [
                'codigo' => 'dolar_intercambio',
                'is_active' => 0,
                'nombre' => 'Dólar acuerdo',
                'unidad_medida' => 'Pesos'
            ],
            [
                'codigo' => 'uf',
                'is_active' => 0,
                'nombre' => 'Unidad de fomento (UF)',
                'unidad_medida' => 'Pesos'
            ],
            [
                'codigo' => 'ivp',
                'is_active' => 0,
                'nombre' => 'Indice de valor promedio (IVP)',
                'unidad_medida' => 'Pesos'
            ],
            [
                'codigo' => 'euro',
                'is_active' => 0,
                'nombre' => 'Euro',
                'unidad_medida' => 'Pesos'
            ],
            [
                'codigo' => 'ipc',
                'is_active' => 0,
                'nombre' => 'Indice de Precios al Consumidor (IPC)',
                'unidad_medida' => 'Porcentaje'
            ],
            [
                'codigo' => 'utm',
                'is_active' => 0,
                'nombre' => 'Unidad Tributaria Mensual',
                'unidad_medida' => 'Pesos'
            ],
            [
                'codigo' => 'imacec',
                'is_active' => 0,
                'nombre' => 'Imacec',
                'unidad_medida' => 'Porcentaje'
            ],
            [
                'codigo' => 'tpm',
                'is_active' => 0,
                'nombre' => 'Tasa Política Monetaria (TPM)',
                'unidad_medida' => 'Porcentaje'
            ],
            [
                'codigo' => 'libra_cobre',
                'is_active' => 0,
                'nombre' => 'Libra de Cobre',
                'unidad_medida' => 'Dólar'
            ],
            [
                'codigo' => 'tasa_desempleo',
                'is_active' => 0,
                'nombre' => 'Tasa de Desempleo',
                'unidad_medida' => 'Porcentaje'
            ],
            [
                'codigo' => 'bitcoin',
                'is_active' => 0,
                'nombre' => 'Bitcoin',
                'unidad_medida' => 'Dólar'
            ],
        ];
        foreach ($currencies as $currency){
            Currencies::create($currency);
        }
    }
}
