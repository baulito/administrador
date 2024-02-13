<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Contents;
use Illuminate\Support\Facades\Storage;
use App\Services\upload\ImageUpload;

class ContentsController extends Controller
{
    public function index()
    {
        $contents = Contents::orderBy('order')->get();
        $sections = $this->getSections();
        return view('admin.contents.index', compact('contents','sections'));
    }

    public function create()
    {
        $sections = $this->getSections();
        return view('admin.contents.create', compact('sections'));
    }

    public function store(Request $request)
    {
        $messages = [
            'title.required' => 'El título es obligatorio.',
            'url.required' => 'La url es obligatoria',
            'url.unique' => 'Ya hay un contenido usando esta url',
        ];
        $request->validate([
            'title' => 'required',
            'url' => 'required|unique:contents',
        ],$messages);

        // Manejo de carga de archivos (imagen)
        if ($request->hasFile('image')) {
            $imagePath = ImageUpload::uploadImage('image',$request);
        }

        $order = Contents::max('order') + 1;
        Contents::create([
            'title' => $request->input('title'),
            'subtitle' => $request->input('subtitle'),
            'url' => $request->input('url'),
            'introduction' => $request->input('introduction'),
            'description' => $request->input('description'),
            'image' => $imagePath ?? null,
            'videourl' => $request->input('videourl'),
            'section' => $request->input('section'),
            'link' => $request->input('link'),
            'order' => $order,
        ]);

        return redirect()->route('contents.index')
            ->with('success', 'Contenido creado exitosamente.');
    }

    public function show(Contents $content)
    {
        return view('admin.contents.show', compact('content'));
    }

    public function edit(Contents $content)
    {
        $sections = $this->getSections();
        return view('admin.contents.edit', compact('content','sections'));
    }

    public function update(Request $request, Contents $content)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required',
            // Agrega otras validaciones según tus necesidades
        ]);

        // Manejo de carga de archivos (imagen)
        if ($request->hasFile('image')) {
            if($content->image != ''){
                Storage::disk('public')->delete($content->image);
            }
            $imagePath = ImageUpload::uploadImage('image',$request);
        }
        
        $content->update([
            'title' => $request->input('title'),
            'subtitle' => $request->input('subtitle'),
            'url' => $request->input('url'),
            'introduction' => $request->input('introduction'),
            'description' => $request->input('description'),
            'image' => $imagePath ?? $content->image,
            'videourl' => $request->input('videourl'),
            'section' => $request->input('section'),
            'link' => $request->input('link'),
            'order' => $request->input('order'),
        ]);
        return redirect()->route('contents.index')
            ->with('success', 'Contenido actualizado exitosamente.');
    }

    public function destroy(Contents $content)
    {
        // Eliminar la imagen del almacenamiento público si existe
        if ($content->image) {
            Storage::disk('public')->delete($content->image);
        }

        $content->delete();

        return redirect()->route('contents.index')
            ->with('success', 'Contenido eliminado exitosamente.');
    }

    public function updateOrder(Request $request)
    {
        $orderId = $request->input('order_id');
        $currentOrder = $request->input('current_order');
        $direction = $request->input('direction');

        $content = Contents::find($orderId);
        

        if ($content) {
            $currentOrder = $content->order;
            $adjacentContent = null;

            if ($direction === 'up') {
                $adjacentContent = Contents::where('order', '<', $currentOrder)
                    ->orderBy('order', 'desc')
                    ->first();
            } else {
                $adjacentContent = Contents::where('order', '>', $currentOrder)
                    ->orderBy('order')
                    ->first();
            }

            if ($adjacentContent) {
                // Intercambia los valores de order entre los dos registros
                $tempOrder = $content->order;
                $content->update(['order' => $adjacentContent->order]);
                $adjacentContent->update(['order' => $tempOrder]);

                return response()->json(['success' => true, 'message' => 'Orden actualizado correctamente.']);
            } else {
                return response()->json(['success' => false, 'error' => 'No se encontró el contenido adyacente.']);
            }
        } else {
            return response()->json(['success' => false, 'error' => 'Contenido no encontrado.']);
        }
    }

    public function getSections(){
        $array = [];
        $array[''] = "Seleccione...";
        $array[1] = "Por qúe";
        $array[2] = "Seguro";
        $array[3] = "Preguntas";
        return $array;
    }
}
