<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AgendaController extends Controller
{
    // Frontend: index agenda
    public function index()
    {
        $agendas = Agenda::orderBy('tanggal_mulai', 'desc')->paginate(10);
        $upcomingAgendas = Agenda::where('tanggal_mulai', '>=', now())
            ->orderBy('tanggal_mulai', 'asc')
            ->limit(5)
            ->get();
        
        return view('agenda.index', compact('agendas', 'upcomingAgendas'));
    }
    
    // Admin: index agenda
    public function adminIndex()
    {
        $agendas = Agenda::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.agenda.index', compact('agendas'));
    }
    
    // Admin: form create
    public function create()
    {
        return view('admin.agenda.create');
    }
    
    // Admin: store agenda
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'tempat' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tipe' => 'nullable|string|max:50',
        ]);
        
        $data = $request->all();
        
        // Set default tipe jika kosong
        if (empty($data['tipe'])) {
            $data['tipe'] = 'Umum';
        }
        
        Agenda::create($data);
        
        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil ditambahkan');
    }
    
    // Admin: form edit
    public function edit($id)
    {
        $agenda = Agenda::findOrFail($id);
        return view('admin.agenda.edit', compact('agenda'));
    }
    
    // Admin: update agenda
    public function update(Request $request, $id)
    {
        $agenda = Agenda::findOrFail($id);
        
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'tempat' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tipe' => 'nullable|string|max:50',
        ]);
        
        $data = $request->all();
        
        $agenda->update($data);
        
        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil diperbarui');
    }
    
    // Admin: delete agenda
    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);
        $agenda->delete();
        
        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil dihapus');
    }
}