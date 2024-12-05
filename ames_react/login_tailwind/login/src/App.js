import React, { useState } from 'react';

function App() {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault();

    if (!email || !password) {
      setError('Por favor, preencha todos os campos.');
      return;
    }

    // Aqui você pode fazer a autenticação (exemplo fictício)
    alert(`Email: ${email}, Senha: ${password}`);
    setError('');
  };

  return (
    <div className="d-flex justify-content-center align-items-center min-vh-100 bg-light">
      <div className="card shadow-lg p-4" style={{ width: '350px' }}>
        <h2 className="text-center mb-4">Login</h2>
        {error && <div className="alert alert-danger">{error}</div>}
        <form onSubmit={handleSubmit}>
          <div className="mb-3">
            <label htmlFor="email" className="form-label">Email</label>
            <input
              type="email"
              id="email"
              className="form-control"
              placeholder="Digite seu email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              required
            />
          </div>

          <div className="mb-3">
            <label htmlFor="password" className="form-label">Senha</label>
            <input
              type="password"
              id="password"
              className="form-control"
              placeholder="Digite sua senha"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              required
            />
          </div>

          <button type="submit" className="btn btn-primary w-100">Entrar</button>
        </form>
      </div>
    </div>
  );
}

export default App;

/*
Bootstrap Classes:

d-flex justify-content-center align-items-center min-vh-100 bg-light: Estas classes do Bootstrap são usadas para centralizar o formulário na tela e dar um fundo claro.

card: A classe card cria um contêiner estilizado para o formulário.

form-control: Esta classe é usada para estilizar os campos de entrada (email e senha).

btn btn-primary w-100: Esta classe é usada para o botão, que será estilizado com o Bootstrap.

alert alert-danger: Exibe mensagens de erro, caso o formulário não seja preenchido corretamente.

*/
