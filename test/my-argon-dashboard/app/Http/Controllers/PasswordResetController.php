<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Notifications\ForgotPassword;

class PasswordResetController extends Controller
{
    // Afficher le formulaire de demande de réinitialisation de mot de passe
    public function show()
    {
        return view('auth.reset-password');
    }

    // Envoyer l'email de réinitialisation avec lien signé
    public function send(Request $request)
    {
        $email = $request->validate(['email' => 'required|email']);
        $user = User::where('email', $email)->first();

        if ($user) {
            $user->notify(new ForgotPassword($user->id));
            return back()->with('success', 'Un email de réinitialisation a été envoyé à votre adresse.');
        }

        return back()->withErrors(['email' => 'Adresse email non trouvée.']);
    }

    // Afficher le formulaire de changement de mot de passe
    public function showChangePasswordForm($id)
    {
        return view('auth.change-password', ['token' => $id]);
    }

    // Traiter la mise à jour du mot de passe
    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);
    
        $user = User::findOrFail($id);
        
        // Hash the password before saving it
        $user->password = Hash::make($request->password);
        
        $user->save();
    
        return redirect()->route('login')->with('success', 'Mot de passe réinitialisé avec succès.');
    }
    
}
