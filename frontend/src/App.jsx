import { useState, useEffect } from 'react';
import './App.css';

function App() {
  const [employes, setEmployes] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    fetch('http://127.0.0.1:8001/api/employes')
      .then((res) => {
        if (!res.ok) throw new Error('Erreur HTTP ' + res.status);
        return res.json();
      })
      .then((data) => setEmployes(data))
      .catch((err) => setError(err.message))
      .finally(() => setLoading(false));
  }, []);

  return (
    <div style={{ padding: 20 }}>
      <h1>Liste des employés</h1>

      {loading && <p>Chargement en cours...</p>}

      {error && <p style={{ color: 'red' }}>Erreur : {error}</p>}

        <ul>
          {employes.map((emp) => (
            <li key={emp.id}>
              <strong>{emp.nom}</strong> — {emp.poste}
            </li>
          ))}
        </ul>
    
    </div>
  );
}

export default App;
