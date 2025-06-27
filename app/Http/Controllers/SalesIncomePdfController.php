<?php

namespace App\Http\Controllers;

use App\Models\SalesIncomePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SalesIncomePdfController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pdfs = SalesIncomePdf::orderBy('report_date', 'desc')->paginate(10);
        return view('sales-income.index', compact('pdfs'));
    }

    public function create()
    {
        return view('sales-income.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|min:5|max:100',
        'description' => 'nullable|string|max:255',
        'pdf_file' => 'required|mimes:pdf|max:10240',
        'report_date' => 'required|date'
    ]);

    // Procesar el archivo
    $filename = time().'_'.str_replace(' ', '_', $request->file('pdf_file')->getClientOriginalName());
    Storage::disk('sales_pdfs')->put($filename, file_get_contents($request->file('pdf_file')));

    // Crear el registro
    SalesIncomePdf::create([
        'title' => $validated['title'],
        'description' => $validated['description'],
        'file_path' => $filename,
        'report_date' => $validated['report_date'], // Laravel automáticamente lo convertirá a formato fecha
        'user_id' => Auth::id()
    ]);

    return redirect()->route('sales-income.index')->with('success', 'PDF subido correctamente.');
}
    public function show(SalesIncomePdf $salesIncome)
    {
        return view('sales-income.show', compact('salesIncome'));
    }

    public function download(SalesIncomePdf $salesIncome)
    {
        $filePath = Storage::disk('sales_pdfs')->path($salesIncome->file_path);
        return response()->download($filePath, $salesIncome->title.'.pdf');
    }

    public function edit(SalesIncomePdf $salesIncome)
    {
        return view('sales-income.edit', compact('salesIncome'));
    }

    public function update(Request $request, SalesIncomePdf $salesIncome)
    {
        $request->validate([
            'title' => 'required|min:5|max:100',
            'description' => 'nullable|string|max:255',
            'pdf_file' => 'sometimes|mimes:pdf|max:10240',
            'report_date' => 'required|date'
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'report_date' => $request->report_date
        ];

        if ($request->hasFile('pdf_file')) {
            Storage::disk('sales_pdfs')->delete($salesIncome->file_path);
            
            $file = $request->file('pdf_file');
            $filename = time().'_'.str_replace(' ', '_', $file->getClientOriginalName());
            Storage::disk('sales_pdfs')->put($filename, file_get_contents($file));
            
            $data['file_path'] = $filename;
        }

        $salesIncome->update($data);

        return redirect()->route('sales-income.index')->with('success', 'PDF actualizado correctamente.');
    }

    public function destroy(SalesIncomePdf $salesIncome)
    {
        Storage::disk('sales_pdfs')->delete($salesIncome->file_path);
        $salesIncome->delete();
        return redirect()->route('sales-income.index')->with('success', 'PDF eliminado correctamente.');
    }
}