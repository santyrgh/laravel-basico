<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::paginate(5);
        return view('productos.index', compact('productos'));
    }

    /**
     * ! mostar vista para crear 
     */
    public function create()
    {
        return view('productos.crear');
    }

    /**
     * ! crear producto
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required', 'descripcion' => 'required', 'imagen' => 'required|image|mimes:jpeg,jpg,png,svg|max:1024'
        ]);

        $producto = $request->all();

        if($imagen = $request->file('imagen')) {
            $rutaGuardarImg = 'imagen/';
            $imagenProducto = date('YmdHis'). "." . $imagen->getClientOriginalExtension();
            $imagen->move($rutaGuardarImg, $imagenProducto);
            $producto['imagen'] = "$imagenProducto";             
        }
        Producto::create($producto);
        return redirect()->route('productos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * ! vista de editar y cargar registro.
     */
    public function edit(Producto $producto)
    {
        return view('productos.editar', compact('producto'));
    }

    /**
     * !actualizacion
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required', 'descripcion' => 'required'
        ]);
        $prod = $request->all();
        if($imagen = $request->file('imagen')){
            $rutaGuardarImg = 'imagen/';
            $imagenProducto = date('YmdHis') . "." . $imagen->getClientOriginalExtension(); 
            $imagen->move($rutaGuardarImg, $imagenProducto);
            $prod['imagen'] = "$imagenProducto";
        }else{
            unset($prod['imagen']);
        }
        $producto->update($prod);
        return redirect()->route('productos.index');
    }
    /**
     *!eliminar
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index');
    }
}
