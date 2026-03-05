<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Challenge;
use App\Models\Reward;
use App\Models\EnvironmentalImpact;
use App\Models\Communication;
use App\Models\Notification;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        Challenge::truncate();
        Reward::truncate();
        EnvironmentalImpact::truncate();
        Communication::truncate();
        Notification::truncate();
        DB::table('routes')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // ── Usuarios ──────────────────────────────────────────
        $admin = User::create([
            'name'      => 'Admin EcoRoute',
            'email'     => 'admin@ecoroute.com',
            'password'  => Hash::make('password'),
            'role'      => 'admin',
            'points'    => 500,
            'co2_saved' => 32.0,
            'is_active' => true,
        ]);
        dump('Usuario admin creado: ID ' . $admin->id);

        $maria = User::create([
            'name'      => 'María López',
            'email'     => 'maria@ecoroute.com',
            'password'  => Hash::make('password'),
            'role'      => 'user',
            'points'    => 320,
            'co2_saved' => 25.5,
            'is_active' => true,
        ]);
        dump('Usuario maria creado: ID ' . $maria->id);

        $carlos = User::create([
            'name'      => 'Carlos Ruiz',
            'email'     => 'carlos@ecoroute.com',
            'password'  => Hash::make('password'),
            'role'      => 'user',
            'points'    => 210,
            'co2_saved' => 18.0,
            'is_active' => true,
        ]);
        dump('Usuario carlos creado: ID ' . $carlos->id);

        // ── Challenges ────────────────────────────────────────
        Challenge::create([
            'title'               => 'Reto Bici Semanal',
            'description'         => 'Usa la bicicleta durante 5 días seguidos',
            'category'            => 'Transporte',
            'difficulty'          => 2,
            'points_reward'       => 150,
            'co2_saving_estimate' => 12.5,
            'target_participants' => 100,
            'is_active'           => true,
        ]);

        Challenge::create([
            'title'               => 'Sin Coche un Mes',
            'description'         => 'No uses el coche privado durante 30 días',
            'category'            => 'Movilidad',
            'difficulty'          => 5,
            'points_reward'       => 500,
            'co2_saving_estimate' => 85.0,
            'target_participants' => 50,
            'is_active'           => true,
        ]);
        dump('Challenges creados');

        // ── Rewards ───────────────────────────────────────────
        Reward::create([
            'name'            => 'Descuento Decathlon 10%',
            'description'     => 'Descuento en accesorios de ciclismo',
            'partner'         => 'Decathlon',
            'points_cost'     => 500,
            'stock'           => 20,
            'is_active'       => true,
            'estimated_value' => 15.00,
            'valid_from'      => now()->toDateString(),
            'valid_until'     => now()->addYear()->toDateString(),
        ]);

        Reward::create([
            'name'            => 'Casco de Bicicleta Gratis',
            'description'     => 'Canjea tus puntos por un casco',
            'partner'         => 'Bike24',
            'points_cost'     => 1000,
            'stock'           => 5,
            'is_active'       => true,
            'estimated_value' => 45.00,
            'valid_from'      => now()->toDateString(),
            'valid_until'     => now()->addYear()->toDateString(),
        ]);

        Reward::create([
            'name'            => 'Amazon Gifts',
            'description'     => 'Cascos de 100$',
            'partner'         => 'Amazon',
            'points_cost'     => 10000,
            'stock'           => 10,
            'is_active'       => true,
            'estimated_value' => 160.00,
            'valid_from'      => now()->toDateString(),
            'valid_until'     => now()->addMonths(3)->toDateString(),
        ]);
        dump('Rewards creadas');

        // ── Environmental Impacts ─────────────────────────────
        EnvironmentalImpact::create([
            'user_id'              => $admin->id,
            'scope'                => 'monthly',
            'year'                 => 2026,
            'month'                => 3,
            'co2_emitted'          => 45.5,
            'co2_saved'            => 32.0,
            'distance_sustainable' => 120.0,
            'trips_sustainable'    => 15,
            'sustainable_share'    => 70.00,
            'is_final'             => true,
            'notes'                => 'Marzo 2026',
        ]);
        dump('EnvironmentalImpact admin creado');

        EnvironmentalImpact::create([
            'user_id'              => $maria->id,
            'scope'                => 'monthly',
            'year'                 => 2026,
            'month'                => 3,
            'co2_emitted'          => 30.0,
            'co2_saved'            => 25.5,
            'distance_sustainable' => 95.0,
            'trips_sustainable'    => 12,
            'sustainable_share'    => 65.00,
            'is_final'             => false,
            'notes'                => 'Marzo 2026',
        ]);
        dump('EnvironmentalImpact maria creado');

        EnvironmentalImpact::create([
            'user_id'              => $carlos->id,
            'scope'                => 'monthly',
            'year'                 => 2026,
            'month'                => 3,
            'co2_emitted'          => 20.0,
            'co2_saved'            => 18.0,
            'distance_sustainable' => 60.0,
            'trips_sustainable'    => 8,
            'sustainable_share'    => 55.00,
            'is_final'             => false,
            'notes'                => 'Marzo 2026',
        ]);
        dump('EnvironmentalImpact carlos creado');

        // ── Communications ────────────────────────────────────
        Communication::create([
            'user_id'       => $admin->id,
            'title'         => 'Bienvenida a EcoRoute',
            'body'          => 'Bienvenido a la plataforma de movilidad sostenible.',
            'channel'       => 'email',
            'audience'      => 'all',
            'scheduled_at'  => null,
            'sent_at'       => null,
            'status'        => 'draft',
            'sent_count'    => 0,
            'opened_count'  => 0,
            'clicked_count' => 0,
        ]);

        Communication::create([
            'user_id'       => $admin->id,
            'title'         => 'Nuevo reto disponible',
            'body'          => 'Ya puedes participar en el reto Bici Semanal.',
            'channel'       => 'push',
            'audience'      => 'users',
            'scheduled_at'  => '2026-03-01 09:00:00',
            'sent_at'       => '2026-03-01 09:05:00',
            'status'        => 'sent',
            'sent_count'    => 150,
            'opened_count'  => 98,
            'clicked_count' => 45,
        ]);
        dump('Communications creadas');

        // ── Notifications ─────────────────────────────────────
        Notification::create([
            'user_id'  => $admin->id,
            'title'    => 'Bienvenido al sistema',
            'message'  => 'Tu cuenta de administrador ha sido configurada correctamente.',
            'type'     => 'success',
            'priority' => 'normal',
            'is_read'  => true,
        ]);

        Notification::create([
            'user_id'  => $maria->id,
            'title'    => 'Nuevo reto disponible',
            'message'  => 'Ya puedes participar en el reto Bici Semanal. ¡Anímate!',
            'type'     => 'info',
            'priority' => 'high',
            'is_read'  => false,
        ]);

        Notification::create([
            'user_id'  => $carlos->id,
            'title'    => 'Puntos acumulados',
            'message'  => 'Has acumulado 210 puntos este mes. ¡Sigue así!',
            'type'     => 'success',
            'priority' => 'low',
            'is_read'  => false,
        ]);

        Notification::create([
            'user_id'  => $admin->id,
            'title'    => 'Alerta de sistema',
            'message'  => 'Se detectó un acceso inusual en la plataforma. Revisa los logs.',
            'type'     => 'warning',
            'priority' => 'high',
            'is_read'  => false,
        ]);

        Notification::create([
            'user_id'  => $maria->id,
            'title'    => 'Recompensa disponible',
            'message'  => 'Tienes suficientes puntos para canjear el Descuento Decathlon 10%.',
            'type'     => 'info',
            'priority' => 'normal',
            'is_read'  => true,
        ]);

        Notification::create([
            'user_id'  => $carlos->id,
            'title'    => 'Error en ruta registrada',
            'message'  => 'La última ruta registrada no pudo procesarse. Inténtalo de nuevo.',
            'type'     => 'error',
            'priority' => 'high',
            'is_read'  => false,
        ]);
        dump('Notifications creadas');

        // ── Rutas ─────────────────────────────────────────────
        DB::table('routes')->insert([
            [
                'name'             => 'Ruta del Río Verde',
                'distance_km'      => 5.2,
                'duration_minutes' => 75,
                'co2_saved_kg'     => 1.8,
                'difficulty'       => 'easy',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'name'             => 'Sendero del Bosque',
                'distance_km'      => 8.7,
                'duration_minutes' => 120,
                'co2_saved_kg'     => 3.1,
                'difficulty'       => 'medium',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'name'             => 'Circuito de la Montaña',
                'distance_km'      => 14.3,
                'duration_minutes' => 200,
                'co2_saved_kg'     => 5.4,
                'difficulty'       => 'hard',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'name'             => 'Paseo del Parque Central',
                'distance_km'      => 3.1,
                'duration_minutes' => 45,
                'co2_saved_kg'     => 1.1,
                'difficulty'       => 'easy',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
        ]);
        dump('Rutas creadas');

        dump(' Seeder completado correctamente');
    }
}
