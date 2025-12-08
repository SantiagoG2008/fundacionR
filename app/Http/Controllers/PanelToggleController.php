<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PanelConfig;

class PanelToggleController extends Controller
{
    public function toggle(Request $request)
    {
        $key = $request->input('key');
        
        if ($key !== 'ctrl_shift_p') {
            return response()->json(['error' => 'Acceso denegado'], 403);
        }

        $isActive = PanelConfig::isPanelActive();
        $newState = !$isActive;
        PanelConfig::setPanelActive($newState);

        return response()->json([
            'success' => true,
            'active' => $newState,
            'message' => $newState ? 'Panel activado' : 'Panel desactivado'
        ]);
    }

    public function status()
    {
        return response()->json([
            'active' => PanelConfig::isPanelActive()
        ]);
    }
}

