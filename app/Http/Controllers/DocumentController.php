<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::with('user')->latest()->get();
        return view('panel.document.index', compact('documents'));
    }

    public function create()
    {
        return view('panel.document.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|mimes:pdf,doc,docx,xlsx,jpg,jpeg,png|max:5120',
        ]);

        $path = $request->file('file')->store('documents');

        Document::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $path,
        ]);

        return redirect()->route('document.index')->with('success', 'Document uploaded successfully!');
    }

    public function download($id)
    {
        $document = Document::findOrFail($id);
        return Storage::download($document->file_path, $document->title . '.' . pathinfo($document->file_path, PATHINFO_EXTENSION));
    }

    public function destroy($id)
    {
        $document = Document::findOrFail($id);

        if (Storage::exists($document->file_path)) {
            Storage::delete($document->file_path);
        }

        $document->delete();

        return redirect()->route('document.index')->with('success', 'Document deleted successfully.');
    }
}
