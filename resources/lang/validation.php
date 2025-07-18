<?php

return [

    'accepted' => 'Le champ :attribute doit être accepté.',
    'active_url' => 'Le champ :attribute n’est pas une URL valide.',
    'after' => 'Le champ :attribute doit être une date postérieure à :date.',
    'alpha' => 'Le champ :attribute ne peut contenir que des lettres.',
    'alpha_num' => 'Le champ :attribute ne peut contenir que des lettres et des chiffres.',
    'array' => 'Le champ :attribute doit être un tableau.',
    'before' => 'Le champ :attribute doit être une date antérieure à :date.',
    'between' => [
        'numeric' => 'La valeur de :attribute doit être comprise entre :min et :max.',
        'string' => 'Le champ :attribute doit contenir entre :min et :max caractères.',
    ],
    'confirmed' => 'La confirmation du champ :attribute ne correspond pas.',
    'email' => 'Le champ :attribute doit être une adresse email valide.',
    'required' => 'Le champ :attribute est obligatoire.',
    'min' => [
        'string' => 'Le champ :attribute doit contenir au moins :min caractères.',
    ],
    'max' => [
        'string' => 'Le champ :attribute ne peut pas dépasser :max caractères.',
    ],
    'unique' => 'Ce :attribute est déjà utilisé.',
    'string' => 'Le champ :attribute doit être une chaîne de caractères.',

    // Noms personnalisés
    'attributes' => [
        'name' => 'nom',
        'email' => 'adresse email',
        'password' => 'mot de passe',
        'password_confirmation' => 'confirmation du mot de passe',
    ],

];
