import './App.css';
import React, { Suspense, useEffect } from 'react';

// 3. Importer les outils de routage
import { Routes, Route, useNavigate } from "react-router-dom";

// 1. Importer les composants du layout
import Headers from './components/Headers';
import Footer from './components/Footer';

// 2. Importer les pages avec lazy loading
const Home = React.lazy(() => import('./pages/Home'));
const About = React.lazy(() => import('./pages/About'));
const Blog = React.lazy(() => import('./pages/Blog'));
const Contact = React.lazy(() => import('./pages/Contact'));
const Catalogue = React.lazy(() => import('./pages/Catalogue'));
const ProduitsPage = React.lazy(() => import('./pages/Produit'));
const Panier = React.lazy(() => import('./pages/Panier'));
const Compte = React.lazy(() => import('./pages/Compte'));
const LoginPage = React.lazy(() => import('./pages/Login'));
const Register = React.lazy(() => import('./pages/Register'));



// Loading component
const LoadingFallback = () => (
  <div className="flex justify-center items-center min-h-screen">
    <div className="text-center">
      <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-[#5C4033] mx-auto"></div>
      <p className="mt-4 text-[#5C4033]">Chargement...</p>
    </div>
  </div>
);

// Layout pour les pages normales
function Layout({ children }) {
  return (
    <>
      <Headers />
      <main>{children}</main>
      <Footer />
    </>
  );
}

// Composant pour gérer l'authentification
function AppContent() {
  return (
    <Suspense fallback={<LoadingFallback />}>
      <Routes>
  
        <Route
          path="/"
          element={
            <Layout>
              <Home />
            </Layout>
          }
        />

        <Route
          path="/contact"
          element={
            <Layout>
              <Contact />
            </Layout>
          }
        />

        <Route
          path="/catalogue"
          element={
            <Layout>
              <Catalogue />
            </Layout>
          }
        />

        <Route
          path="/produits"
          element={
            <Layout>
              <ProduitsPage />
            </Layout>
          }
        />

        <Route
          path="/blog"
          element={
            <Layout>
              <Blog />
            </Layout>
          }
        />

        <Route
          path="/panier"
          element={
            <Layout>
              <Panier />
            </Layout>
          }
        />

        <Route
          path="/a-propos"
          element={
            <Layout>
              <About />
            </Layout>
          }
        />

        <Route
          path="/profil"
          element={
            <Layout>
              <Compte />
            </Layout>
          }
        />

        {/* Routes spéciales sans Layout */}
        <Route path="/login" element={<LoginPage />} />
        <Route path="/register" element={<Register />} />
        <Route path="*" element={<Error />} />
      </Routes>
    </Suspense>
  );
}

function App() {
  return (
    <AppContent />
  );
}

export default App;
