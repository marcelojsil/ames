import React, { useState } from 'react';
import axios from 'axios';

const AddCidade = () => {
  const [cidade, setNome] = useState('');
  const [id_estado, setEstado] = useState('');
  const [populacao, setPopulacao] = useState('');
  const [message, setMessage] = useState('');

  const handleSubmit = async (e) => {
    e.preventDefault();

    // Verifica os campos obrigatórios
    if (!cidade || !id_estado) {
      setMessage('Todos os campos são obrigatórios!');
      return;
    }

    try {
      const response = await axios.post('http://localhost:5000/addCidade', {
        cidade,
        id_estado,
        populacao,
      });
      setMessage('Cidade adicionada com sucesso!');
      setNome('');
      setEstado('');
    } catch (error) {
      setMessage('Erro ao adicionar cidade');
    }
  };

  return (
    <div>
      <h2>Adicionar Cidade</h2>
      <form onSubmit={handleSubmit}>
        <div>
          <label>Nome da Cidade:</label>
          <input
            type="text"
            value={cidade}
            onChange={(e) => setNome(e.target.value)}
            required
          />
        </div>
        <div>
          <label>Estado:</label>
          <input
            type="text"
            value={id_estado}
            onChange={(e) => setEstado(e.target.value)}
            required
          />
  
        </div>
        <div>
        <label>População:</label>
          <input
            type="text"
            value={populacao}
            onChange={(e) => setPopulacao(e.target.value)}
          />
        </div>
        <button type="submit">Adicionar</button>
      </form>
      {message && <p>{message}</p>}

      <a href="/addCidade"><div class="button">Outra Cidade</div></a>
      <a href="/"><div class="button">Voltar</div></a>

    </div>
  );
};

export default AddCidade;
