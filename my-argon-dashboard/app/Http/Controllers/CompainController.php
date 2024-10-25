<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use App\Models\Compain;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;

class CompainController extends Controller
{
    public function index()
    {
        // Retrieve all entries in the `compain` table
        $compains = Compain::all();
        return view('pages.dashboard', ['compains' => $compains]);
    }

    public function create()
    {
        return view('pages.create');
    }

    public function store(Request $request)
    {
        // Validate the submitted data
        $validatedData = $request->validate([
            'nom_compain' => 'required|string|max:255',
            'actif' => 'required|boolean',
        ]);

        // Create a new `compain`
        Compain::create([
            'nom_compain' => $validatedData['nom_compain'],
            'actif' => $validatedData['actif'],
        ]);

        // Redirect to the dashboard with a success message
        return redirect()->route('dashboard')->with('success', 'Compain ajoutée avec succès.');
    }

    public function edit($id_compain)
    {
        $compain = Compain::findOrFail($id_compain);
        return view('pages.edit', compact('compain'));
    }

    public function update(Request $request, $id_compain)
    {
        $compain = Compain::findOrFail($id_compain);
        $compain->nom_compain = $request->nom_compain;
        $compain->actif = $request->actif;
        $compain->save();

        return redirect()->route('dashboard')->with('success', 'Compain modifié avec succès.');
    }

    public function destroy($id_compain)
    {
        $compain = Compain::findOrFail($id_compain);
        $compain->delete();

        return redirect()->route('dashboard')->with('success', 'Compain supprimée avec succès.');
    }

    public function showContacts($id_compain)
    {
        // Find the `compain` with its contacts
        $compain = Compain::with('contacts')->findOrFail($id_compain);

        // Pass the data to the view
        return view('pages.contacts', compact('compain'));
    }

    public function deleteContact($compainId, $contactId)
    {
        $contact = Contact::where('id', $contactId)->where('compain_id', $compainId)->firstOrFail();
        $contact->delete();

        return redirect()->back()->with('success', 'Contact supprimé avec succès.');
    }

    public function exportContactsTemplate()
    {
        // En-têtes HTTP pour le téléchargement
        $headers = [
            'Content-Type' => 'application/csv',
            'Content-Disposition' => 'attachment; filename="contacts_template.csv"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];
    
        // Colonnes du fichier CSV
        $columns = ['nom', 'raison_social', 'ICF', 'RC', 'email1', 'email2', 'num1', 'num2', 'mobile1', 'mobile2', 'tel1', 'tel2', 'qualification'];
    
        // Génération du fichier CSV
        $callback = function () use ($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns); // Insérer les colonnes dans le fichier CSV
            fclose($file);
        };
    
        // Retourner la réponse avec en-têtes
        return response()->stream($callback, 200, $headers);
    }
    public function importContacts(Request $request)
{
    // Validation du fichier et de la présence du compain_id
    $request->validate([
        'file' => 'required|mimes:csv,txt',
        'compain_id' => 'required|exists:compain,id_compain'
    ]);

    $compainId = $request->input('compain_id');

    // Ouvrir le fichier CSV
    $file = fopen($request->file('file'), 'r');
    fgetcsv($file); // Ignorer la première ligne (en-tête)

    while ($row = fgetcsv($file)) {
        // Récupérer les données du CSV
        $validatedData = [
            'nom' => $row[0],
            'raison_social' => $row[1],
            'ICF' => $row[2],
            'RC' => $row[3],
            'email1' => $row[4],
            'email2' => $row[5],
            'num1' => $row[6], 
            'num2' => $row[7],
            'mobile1' => $row[8],
            'mobile2' => $row[9],
            'tel1' => $row[10],
            'tel2' => $row[11],
            'qualification' => $row[12],
            'compain_id' => $compainId,
        ];

        // Vérifier si le contact existe déjà pour cette compagne
        $contactExiste = Contact::where('compain_id', $compainId)->where('num1', $validatedData['num1'])->exists();

        if ($contactExiste) {
            // Si le contact existe déjà pour cette compagne, ignorer cet enregistrement
            continue;
        }

        // Insérer le contact s'il n'existe pas déjà
        Contact::create($validatedData);
    }

    fclose($file);

    return redirect()->back()->with('success', 'Contacts importés avec succès, doublons dans la même compagne ignorés.');
}

    

    


}
