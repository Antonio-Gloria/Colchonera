<?php

namespace App\Http\Controllers;

use App\Models\FinancialDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FinancialDocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $documents = FinancialDocument::orderBy('report_date', 'desc')->paginate(10);
        return view('financial-documents.index', compact('documents'));
    }

    public function create()
    {
        return view('financial-documents.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:5|max:100',
            'description' => 'nullable|string|max:255',
            'document_file' => 'required|mimes:pdf|max:10240',
            'report_date' => 'required|date',
            'document_type' => 'required|in:income,expense' // Tipo de documento: ingreso o salida
        ]);

        // Procesar el archivo
        $filename = time().'_'.str_replace(' ', '_', $request->file('document_file')->getClientOriginalName());
        Storage::disk('financial_documents')->put($filename, file_get_contents($request->file('document_file')));

        // Crear el registro
        FinancialDocument::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'file_path' => $filename,
            'report_date' => $validated['report_date'],
            'document_type' => $validated['document_type'],
            'user_id' => Auth::id()
        ]);

        return redirect()->route('financial-documents.index')->with('success', 'Documento subido correctamente.');
    }

    public function show(FinancialDocument $financialDocument)
    {
        return view('financial-documents.show', compact('financialDocument'));
    }

    public function download(FinancialDocument $financialDocument)
    {
        $filePath = Storage::disk('financial_documents')->path($financialDocument->file_path);
        $fileType = $financialDocument->document_type == 'income' ? 'Ingreso' : 'Salida';
        return response()->download($filePath, "[{$fileType}]_{$financialDocument->title}.pdf");
    }

    public function edit(FinancialDocument $financialDocument)
    {
        return view('financial-documents.edit', compact('financialDocument'));
    }

    public function update(Request $request, FinancialDocument $financialDocument)
    {
        $request->validate([
            'title' => 'required|min:5|max:100',
            'description' => 'nullable|string|max:255',
            'document_file' => 'sometimes|mimes:pdf|max:10240',
            'report_date' => 'required|date',
            'document_type' => 'required|in:income,expense'
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'report_date' => $request->report_date,
            'document_type' => $request->document_type
        ];

        if ($request->hasFile('document_file')) {
            Storage::disk('financial_documents')->delete($financialDocument->file_path);
            
            $file = $request->file('document_file');
            $filename = time().'_'.str_replace(' ', '_', $file->getClientOriginalName());
            Storage::disk('financial_documents')->put($filename, file_get_contents($file));
            
            $data['file_path'] = $filename;
        }

        $financialDocument->update($data);

        return redirect()->route('financial-documents.index')->with('success', 'Documento actualizado correctamente.');
    }

    public function destroy(FinancialDocument $financialDocument)
    {
        Storage::disk('financial_documents')->delete($financialDocument->file_path);
        $financialDocument->delete();
        return redirect()->route('financial-documents.index')->with('success', 'Documento eliminado correctamente.');
    }

    // Método adicional para filtrar por tipo de documento
    public function byType($type)
    {
        $documents = FinancialDocument::where('document_type', $type)
                      ->orderBy('report_date', 'desc')
                      ->paginate(10);
        
        $typeName = $type == 'income' ? 'Ingresos' : 'Salidas';
        
        return view('financial-documents.index', [
            'documents' => $documents,
            'typeFilter' => $typeName
        ]);
    }
}