<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Material;
use App\Models\Estilo;
use App\Models\Escandallo;
use App\Models\Operacion;
use App\Models\OrdenTrabajo;
use App\Models\ProduccionDiaria;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents; // Apaga los eventos automáticos para que la inserción sea súper rápida

    public function run(): void
    {
        // 1. Mantenemos tu usuario administrador para el futuro Login
        User::factory()->create([
            'name' => 'Admin ERP',
            'email' => 'admin@erp.com',
        ]);

        // 2. Crear un Cliente de prueba
        $cliente = Cliente::create([
            'nombre' => 'Boutique Gamarra VIP',
            'ruc' => '20123456789',
            'galeria_tienda' => 'Galeria Guizado, Tienda 104',
            'celular_whatsapp' => '987654321',
            'historial_pagos' => 'Cliente puntual. Crédito aprobado.'
        ]);

        // 3. Ingresar Materiales al inventario
        $tela = Material::create([
            'descripcion' => 'Tela Piqué 30/1 Algodón',
            'tipo' => 'Tela',
            'stock_total' => 500.00,
            'costo_unitario' => 15.50,
            'unidad_medida' => 'Kilos'
        ]);

        $hilo = Material::create([
            'descripcion' => 'Hilo Poliéster 40/2',
            'tipo' => 'Hilo',
            'stock_total' => 100.00,
            'costo_unitario' => 4.20,
            'unidad_medida' => 'Conos'
        ]);

        // 4. Crear un Estilo (Catálogo de Prenda)
        $estilo = Estilo::create([
            'nombre_estilo' => 'Polo Box Clásico',
            'categoria' => 'Polos',
            'cod_molde' => 'MOLDE-BOX-001'
        ]);

        // 5. Crear el Escandallo (La receta de la prenda)
        Escandallo::create([
            'estilo_id' => $estilo->id,
            'material_id' => $tela->id,
            'cantidad_consumo' => 0.250,
            'porcentaje_merma' => 5.00,
        ]);

        Escandallo::create([
            'estilo_id' => $estilo->id,
            'material_id' => $hilo->id,
            'cantidad_consumo' => 80.00,
            'porcentaje_merma' => 10.00,
            'largo_costura' => 1.50
        ]);

        // 6. Crear Operaciones (SAM)
        Operacion::create([
            'nombre' => 'Cerrar Hombros',
            'maquina_clase' => 'Remalle 504',
            'tiempo_sam_minutos' => 0.45
        ]);

        // 7. Ingresar una Orden de Trabajo real
        $orden = OrdenTrabajo::create([
            'cliente_id' => $cliente->id,
            'estilo_id' => $estilo->id,
            'cantidad_lote' => 1000,
            'fecha_ingreso' => now(),
            'fecha_compromiso' => now()->addDays(15),
            'estado_actual' => 'Corte'
        ]);

        // 8. Registrar avance de Producción Diaria
        ProduccionDiaria::create([
            'orden_trabajo_id' => $orden->id,
            'fecha' => now(),
            'operario_nombre' => 'Carlos Costura',
            'piezas_terminadas' => 150,
            'tiempo_empleado' => 8.00 
        ]);
    }
}