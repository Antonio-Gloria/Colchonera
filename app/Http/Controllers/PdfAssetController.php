<?php

namespace App\Http\Controllers;

use App\Models\PdfAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

class PdfAssetController extends Controller
{
    public function index()
    {
        $pdfs = PdfAsset::all();
        return view('pdf.index', compact('pdfs'));
    }

    public function create()
    {
        return view('pdf.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5',
            'pdf_path' => 'required|mimes:pdf|max:10000'
        ]);

        $pdf = new PdfAsset();
        $pdf->title = $request->input('title');

        $file = $request->file('pdf_path');
        if ($file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            Storage::disk('pdfs')->put($filename, File::get($file));
            $pdf->pdf_path = $filename;
        }

        $pdf->save();

        return redirect()->route('pdf.index')->with('message', 'PDF subido correctamente.');
    }

    public function show($id)
    {
        $pdf = PdfAsset::findOrFail($id);
        return view('pdf.show', compact('pdf'));
    }

    public function getPdf($filename)
    {
        $file = Storage::disk('pdfs')->get($filename);
        return new Response($file, 200, [
            'Content-Type' => 'application/pdf'
        ]);
    }

    public function destroy($id)
    {
        $pdf = PdfAsset::findOrFail($id);
        Storage::disk('pdfs')->delete($pdf->pdf_path);
        $pdf->delete();

        return redirect()->route('pdf.index')->with('message', 'PDF eliminado.');
    }
}

