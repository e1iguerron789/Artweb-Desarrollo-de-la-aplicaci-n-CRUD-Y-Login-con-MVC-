<?php

namespace App\Http\Controllers;

use App\Models\UserIntereses;
use Illuminate\Http\Request;

class UserInteresesController extends Controller
{

    public function __construct()
 {
    $this->middleware('auth'); //Se encarga de proteger el crud a continuacion
}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $user = auth()->user();

        // Obtener los intereses del usuario
        $intereses = UserIntereses::where('user_id', $user->id)->get();

        // Enviar a la vista con Inertia
        return inertia('UserIntereses/Index', [
            'intereses' => $intereses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('UserIntereses/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // 1. Validar los datos
    $validated = $request->validate([
        'edad' => 'nullable|integer',
        'estilo_artistico' => 'nullable|string|max:255',
        'fandom_favorito' => 'nullable|string|max:255',
        'nivel_artista' => 'nullable|string|max:255',
        'descripcion' => 'nullable|string',
    ]);

    // 2. Agregar el ID del usuario actual
    $validated['user_id'] = auth()->id();

    // 3. Crear el registro en la base de datos
    UserIntereses::create($validated);

    // 4. Redirigir al dashboard
    return redirect()->route('dashboard')->with('success', 'Intereses guardados correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserIntereses $userIntereses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserIntereses $userIntereses)
    {
         if ($userIntereses->user_id !== auth()->id()) {
        abort(403);
    }

    return inertia('UserIntereses/Edit', [
        'intereses' => $userIntereses
    ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserIntereses $userIntereses)
    {
        // Asegurar que el usuario solo puede editar sus propios intereses
    if ($userIntereses->user_id !== auth()->id()) {
        abort(403);
    }

    // Validar datos
    $validated = $request->validate([
        'edad' => 'nullable|integer',
        'estilo_artistico' => 'nullable|string|max:255',
        'fandom_favorito' => 'nullable|string|max:255',
        'nivel_artista' => 'nullable|string|max:255',
        'descripcion' => 'nullable|string',
    ]);

    // Actualizar
    $userIntereses->update($validated);

    // Redirigir
    return redirect()->route('profile.edit')->with('success', 'Intereses actualizados correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserIntereses $userIntereses)
    {
         // Seguridad: solo el dueño puede eliminar
    if ($userIntereses->user_id !== auth()->id()) {
        abort(403);
    }

    // Eliminar el registro
    $userIntereses->delete();

    // Redirigir al perfil con mensaje
    return redirect()->route('profile.edit')->with('success', 'Intereses eliminados correctamente.');
    }
}

