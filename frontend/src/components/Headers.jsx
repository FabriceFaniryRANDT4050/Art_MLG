// Headers.jsx
import React from 'react';
// import { Search, ShoppingBag, User } from 'lucide-react'; // Utilisation d'icônes populaires

// Lien d'entete de navigation
const navLinks = [
  { label: "ACCUEIL", href: "/" },
  { label: "CATALOGUE", href: "catalogue" },
  { label: "PRODUITS", href: "produits" },
  { label: "BLOG", href: "blog" },
  { label: "A-PROPOS", href: "a-propos" },
  { label: "CONTACT", href: "contact" },
  { label: "PANIER", href: "panier" },
];

const Headers = () => {
  return (
    // Conteneur principal de la barre de navigation
    <header className="bg-white sticky top-0 z-50">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex justify-between items-center py-6">
          
          {/* 1. Logo (FIBER COLORS) */}
          <div className="flex items-center space-x-4">
            {/* Placeholder pour l'image du logo noir et blanc */}
            <div className="w-12 h-16 bg-gray-800 flex items-center justify-center">
                {/* Ceci est le style du rectangle noir de l'image */}
            </div>
            <div className="font-sans">
              <span className="block text-xl font-black text-gray-800 leading-none">FIBER</span>
              <span className="block text-2xl font-black text-gray-800 leading-none">COLORS</span>
            </div>
          </div>

          {/* 2. Liens de Navigation Centraux (Masqués sur mobile, visibles sur grand écran) */}
          <nav className="hidden lg:flex lg:space-x-8">
            {navLinks.map((link) => (
              <a
                key={link.label}
                href={link.href}
                className="text-sm font-medium text-gray-700 hover:text-black tracking-wider transition duration-150"
              >
                {link.label}
              </a>
            ))}
          </nav>

          {/* 3. Icônes d'Action à Droite */}
          <div className="flex items-center space-x-6">
            
            {/* Recherche */}
            <button aria-label="Recherche" className="p-2 text-gray-700 hover:text-gray-900 transition duration-150">
              {/* <Search className="h-6 w-6" /> */}
            </button>
            
            {/* Panier */}
            <button aria-label="Panier" className="relative p-2 text-gray-700 hover:text-gray-900 transition duration-150">
              {/* <ShoppingBag className="h-6 w-6" /> */}
              {/* Le badge du panier (Orange) */}
              <span className="absolute -top-1 -right-1 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-orange-500 rounded-full">
                6 {/* Le chiffre 6 est visible sur l'image */}
              </span>
            </button>
            
            {/* Compte Utilisateur */}
            <button aria-label="Compte utilisateur" className="p-2 text-gray-700 hover:text-gray-900 transition duration-150">
              {/* <User className="h-6 w-6" /> */}
            </button>
          </div>

        </div>
        
        {/* Ligne Séparatrice (celle sous la Headers dans l'image) */}
        <hr className="border-t border-gray-400 mt-2" />
        
      </div>
    </header>
  );
};

export default Headers;