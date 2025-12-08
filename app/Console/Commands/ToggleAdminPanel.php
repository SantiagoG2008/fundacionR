<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PanelConfig;

class ToggleAdminPanel extends Command
{
    protected $signature = 'panel:toggle {--on : Activar el panel} {--off : Desactivar el panel} {--status : Mostrar estado actual}';

    protected $description = 'Activa o desactiva la visibilidad del panel administrativo';

    public function handle()
    {
        if ($this->option('status')) {
            $isActive = PanelConfig::isPanelActive();
            $this->info('Estado del panel: ' . ($isActive ? 'ACTIVO' : 'INACTIVO'));
            return Command::SUCCESS;
        }

        if ($this->option('on')) {
            PanelConfig::setPanelActive(true);
            $this->info('✅ Panel administrativo ACTIVADO');
            return Command::SUCCESS;
        }

        if ($this->option('off')) {
            PanelConfig::setPanelActive(false);
            $this->info('❌ Panel administrativo DESACTIVADO');
            return Command::SUCCESS;
        }

        $isActive = PanelConfig::isPanelActive();
        $newState = !$isActive;
        PanelConfig::setPanelActive($newState);
        
        $this->info($newState ? '✅ Panel administrativo ACTIVADO' : '❌ Panel administrativo DESACTIVADO');
        return Command::SUCCESS;
    }
}
