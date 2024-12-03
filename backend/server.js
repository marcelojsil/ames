

const express = require('express');
const mysql = require('mysql2');
const cors = require('cors');
const bodyParser = require('body-parser');
const port = 5000;

// Configurar EXPRESS
const app = express();

// Configurar CORS
app.use(cors());

// Configurar PARSER para o corpo das requisições (JSON)
app.use(bodyParser.json());

// Configuração do banco de dados MySQL

const db = mysql.createConnection({
  host: 'localhost', // Ou o host do seu banco de dados
  user: 'root',      // Seu usuário MySQL
  password: '',      // Sua senha MySQL
  database: 'ames',  // Banco de dados 'ames'
});

// Verificar conexão com o MySQL
db.connect((err) => {
    if (err) {
      console.error('Erro ao conectar ao MySQL: ' + err.stack);
      return;
    }
    console.log('Conectado ao MySQL como id ' + db.threadId);
  });
  
  // =========== =========== =========== =========== ===========
  // == ROTAS == == ROTAS == == ROTAS == == ROTAS == == ROTAS ==
  // =========== =========== =========== =========== ===========

  app.get('/', (req, res) => {
    res.redirect('./App.js');
  })

  // Tela adicionar cidade
  app.post('/addCidade', (req, res) => {
    const { cidade, id_estado, populacao } = req.body; // Esperando os dados 'nome' e 'estado'
  
    const query = 'INSERT INTO cidades (cidade, id_estado, populacao) VALUES (?, ?, ?)';
    
    db.query(query, [cidade, id_estado, populacao], (err, results) => {
      if (err) {
        console.error(err);
        res.status(500).send('Erro ao adicionar cidade');
      } else {
        res.status(200).send('Cidade adicionada com sucesso');
      }
    });
  });

  // Lista do estados
  app.get('/estados', (req, res) => {
    const query = 'SELECT estado FROM estados'; 
    
    db.query(query, (err, results) => {
      if (err) {
        console.error(err);
        return res.status(500).send('Erro ao buscar estados');
      }
      res.json(results); // Retorna os estados como JSON
    });
  });
  


  // =====================
  // Iniciar o servidor ==
  // =====================
  app.listen(port, () => {
    console.log(`Servidor rodando em http://localhost:${port}`);
  });