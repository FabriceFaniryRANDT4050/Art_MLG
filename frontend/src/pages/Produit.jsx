import React, { useState, useEffect } from 'react';


const filterOptions = {
    qualities: ["Luxe", "Premium", "Standard"],
    categories: ["Tapis & Décor", "Linge de Maison", "Art & Artisanat"],
    prices: [
        { label: "Moins de 480 000 Ar", value: 'low' },
        { label: "480 000 Ar - 960 000 Ar", value: 'medium' },
        { label: "Plus de 960 000 Ar", value: 'high' },
    ]
};

const sidebarLinks = [
    "Nouveau Produit", "Top Ventes", "Qualité", "Taille", "Couleur", "Matière", "Prix"
];

const initialProductsData = [
    // Prix en Ariary (Ar)
    { id: 1, title: "Tapis Rond Médina", price: 864000, category: "Tapis & Décor", qualite: "Premium" }, // ~180€
    { id: 2, title: "Tapis Rond Fez", price: 696000, category: "Tapis & Décor", qualite: "Standard" }, // ~145€
    { id: 3, title: "Tapis Marrakech", price: 1416000, category: "Tapis & Décor", qualite: "Luxe" }, // ~295€
    { id: 4, title: "Housse de Couette", price: 456000, category: "Linge de Maison", qualite: "Standard" }, // ~95€
    { id: 5, title: "Tapis à motifs", price: 744000, category: "Tapis & Décor", qualite: "Premium" }, // ~155€
    { id: 6, title: "Miroir sculpté", price: 1008000, category: "Art & Artisanat", qualite: "Luxe" }, // ~210€
];

const customerReviewsData = [
    { id: 1, text: "Très satisfait de mon achat, le tissu est de très bonne qualité.", date: "2017/12/06" },
    { id: 2, text: "La qualité est irréprochable et la livraison a été rapide.", date: "2017/12/06" },
    { id: 3, text: "Je recommande ce site, les produits sont fidèles aux photos.", date: "2017/12/06" },
];


const ProductCard = ({ product }) => {
  return (
    <div className="group relative bg-white border border-gray-100 rounded-lg shadow-sm overflow-hidden">
      
      {/* Placeholder pour l'image */}
      <div className="aspect-h-1 aspect-w-1 w-full overflow-hidden group-hover:opacity-75 h-64 bg-gray-100 flex items-center justify-center text-gray-400 text-xs font-medium">
           
      </div>
      
      <div className="p-3">
        <div className="flex justify-between items-start mb-2">
          <h3 className="text-sm font-medium text-gray-700 truncate">
            <a href="#" className="hover:text-orange-500">
              {product.title}
            </a>
          </h3>
          {/* Mise à jour du symbole de devise */}
          <p className="text-sm font-semibold text-gray-900 ml-2 whitespace-nowrap">{product.price} Ar</p>
        </div>
        
        <button
          className="w-full bg-orange-500 text-white py-2 text-sm font-medium rounded-md hover:bg-orange-600 transition duration-150"
        >
          Détails
        </button>
      </div>
    </div>
  );
};

// ====================================================================
// III. COMPOSANT FilterSidebar
// ====================================================================

const FilterSidebar = ({ filters, onFilterChange }) => {
  
  const FilterGroup = ({ title, options, type, filterKey }) => (
    <div className="mb-6">
      <h3 className="text-sm font-semibold text-gray-900 mb-2 uppercase">{title}</h3>
      <ul className="space-y-2">
        {options.map((option, index) => {
          const value = typeof option === 'string' ? option : option.value;
          const label = typeof option === 'string' ? option : option.label;
          
          return (
            <li key={index} className="flex items-center">
              <input
                id={`filter-${filterKey}-${index}`}
                name={filterKey}
                type={type}
                value={value}
                // Logique de 'checked' simple
                checked={
                    type === 'radio' 
                    ? filters[filterKey] === value 
                    : filters[filterKey].includes(value)
                }
                onChange={(e) => {
                    if (type === 'checkbox') {
                        const newValues = e.target.checked
                            ? [...filters[filterKey], value]
                            : filters[filterKey].filter(v => v !== value);
                        onFilterChange(filterKey, newValues);
                    } else if (type === 'radio') {
                        onFilterChange(filterKey, value);
                    }
                }}
                className="h-4 w-4 text-orange-500 border-gray-300 rounded focus:ring-orange-500"
              />
              <label htmlFor={`filter-${filterKey}-${index}`} className="ml-2 text-sm text-gray-600 cursor-pointer">
                {label}
              </label>
            </li>
          );
        })}
      </ul>
    </div>
  );

  return (
    <div className="p-4 bg-white border border-gray-200 rounded-lg shadow-sm sticky top-4">
      <h3 className="text-lg font-bold text-gray-900 mb-4 border-b pb-2">ART MALAGASY</h3>
      
      {/* Liens de navigation latérale */}
      <ul className="space-y-2 text-sm mb-6 border-b pb-4 text-gray-600">
          {sidebarLinks.map((link, index) => (<li key={index} className='hover:text-orange-500 cursor-pointer'>{link}</li>))}
      </ul>

      {/* FILTRES DYNAMIQUES */}
      <FilterGroup 
          title="Qualité" 
          options={filterOptions.qualities} 
          type="checkbox" 
          filterKey="qualities" 
      />
      <FilterGroup 
          title="Catégories" 
          options={filterOptions.categories} 
          type="checkbox" 
          filterKey="categories" 
      />
      {/* Les labels de prix en Ariary sont mis à jour via filterOptions */}
      <FilterGroup 
          title="Prix" 
          options={filterOptions.prices} 
          type="radio" 
          filterKey="priceRange" 
      />
      
    </div>
  );
};

// ====================================================================
// IV. COMPOSANT ProductListingPage (Principal)
// La logique de prix est mise à jour ici pour les montants en Ar.
// ====================================================================

const ProductListingPage = () => {
    // 1. État des produits et des filtres
    const [products] = useState(initialProductsData);
    const [filteredProducts, setFilteredProducts] = useState(initialProductsData);
    const [filters, setFilters] = useState({
        qualities: [],
        categories: [],
        priceRange: null, 
    });

    // 2. Fonction de mise à jour des filtres
    const handleFilterChange = (filterName, value) => {
        setFilters(prev => ({ ...prev, [filterName]: value }));
    };

    // 3. Logique de filtrage (utilise les nouveaux montants en Ar)
    useEffect(() => {
        const newFiltered = products.filter(product => {
            // Helper pour le prix (limites en Ariary)
            const getPriceRange = (price) => {
                if (price < 480000) return 'low';
                if (price >= 480000 && price <= 960000) return 'medium';
                return 'high';
            };

            // a. Filtrage par Qualité
            const qualiteMatch = filters.qualities.length === 0 || filters.qualities.includes(product.qualite);
            
            // b. Filtrage par Catégorie
            const categoryMatch = filters.categories.length === 0 || filters.categories.includes(product.category);

            // c. Filtrage par Prix
            const priceMatch = filters.priceRange === null || getPriceRange(product.price) === filters.priceRange;
            
            return qualiteMatch && categoryMatch && priceMatch;
        });
        setFilteredProducts(newFiltered);
    }, [filters, products]);
    
    // 4. Scission des produits pour les sections de l'image
    const newProducts = filteredProducts.slice(0, 3);
    const otherProducts = filteredProducts.slice(3);

    return (
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 bg-gray-50">
            <div className="lg:grid lg:grid-cols-4 lg:gap-8">
                
                {/* ➡️ Barre Latérale des Filtres */}
                <aside className="lg:col-span-1 mb-8 lg:mb-0">
                    <FilterSidebar filters={filters} onFilterChange={handleFilterChange} />
                </aside>
                
                {/* ➡️ Contenu Principal */}
                <main className="lg:col-span-3">
                    
                    {/* Section: NOUVEAU PRODUIT */}
                    <h2 className="text-xl font-bold tracking-tight text-gray-900 mb-6 border-b pb-2">NOUVEAU PRODUIT</h2>
                    <div className="grid grid-cols-2 sm:grid-cols-3 gap-6">
                        {newProducts.map(product => (<ProductCard key={product.id} product={product} />))}
                    </div>

                    <hr className="my-10 border-gray-300" />
                    
                    {/* Section: AUTRES PRODUITS */}
                    <h2 className="text-xl font-bold tracking-tight text-gray-900 mb-6">AUTRES PRODUITS</h2>
                    <div className="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                        {otherProducts.map(product => (<ProductCard key={product.id} product={product} />))}
                    </div>

                    <div className="mt-8 text-center">
                        <button className="bg-gray-200 text-gray-800 py-2 px-4 rounded-md text-sm font-medium hover:bg-gray-300">
                            INFORMATIONS SUR LES PRODUITS EN GENERALE (Placeholder)
                        </button>
                    </div>

                    <hr className="my-10 border-gray-300" />
                </main>
            </div>

            {/* ➡️ Section: AVIS DES CLIENTS */}
            <section className="mt-12">
                <h2 className="text-center text-2xl font-bold mb-8 uppercase tracking-wider border-b-2 border-orange-500 inline-block pb-1">AVIS DES CLIENTS</h2>
                <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {customerReviewsData.map(review => (
                        <div key={review.id} className="p-6 border border-gray-200 rounded-lg shadow-md bg-white">
                            <p className="text-sm italic text-gray-600">"{review.text}"</p>
                            <p className="mt-4 text-xs text-gray-500">🗓️ {review.date}</p>
                        </div>
                    ))}
                </div>
            </section>
        </div>
    );
};

export default ProductListingPage;