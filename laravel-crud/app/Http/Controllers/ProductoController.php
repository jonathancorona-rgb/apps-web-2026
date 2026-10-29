<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(Request $request)
{
    $productos = \App\Models\Producto::query();

    if ($buscar = $request->query('buscar')) {
        $productos->where('nombre', 'like', "%$buscar%");
    }

    if ($categoria = $request->query('categoria')) {
        // Si agregas campo categoría: $productos->where('categoria', $categoria);
    }

    return view('productos.index', [
        'productos' => $productos->latest()->get()
    ]);
}

    public function create()
    {
        return view('productos.create');
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'nombre' => 'required|string|min:3|max:255',
        'precio' => 'required|numeric|min:0',
        'cantidad' => 'required|integer|min:1',
    ], [
        'nombre.required' => 'El nombre es obligatorio.',
        'nombre.min' => 'El nombre debe tener al menos 3 caracteres.',
        'precio.numeric' => 'El precio debe ser un número.',
    ]);

    Producto::create($validated);
    return redirect()->route('productos.index')->with('ok', 'Producto creado correctamente.');
}

    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, Producto $producto)
{
   $validated = $request->validate([
    'nombre' => 'required|string|min:3|max:255',
    'precio' => 'required|numeric|min:0',
    'cantidad' => 'required|integer|min:1',
], [
    'nombre.required' => 'El nombre es obligatorio.',
    'nombre.min' => 'El nombre debe tener al menos 3 caracteres.',
    'precio.required' => 'El precio es obligatorio.',
    'precio.numeric' => 'El precio debe ser un número.',
    'cantidad.required' => 'La cantidad es obligatoria.',
    'cantidad.integer' => 'La cantidad debe ser un número entero.',
]);

    $producto->update($validated);
    return redirect()->route('productos.index')->with('ok', 'Producto actualizado correctamente.');
}

    public function destroy(Producto $producto)
{
    $producto->delete();
    return redirect()->route('productos.index')->with('ok', 'Producto eliminado correctamente.');
}
}