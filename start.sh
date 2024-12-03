#!/bin/bash'

echo "Iniciando o servidor NodeJS..."

cd backend
nodemon ./server.js

cd ..

echo "Iniciando o servidor ReactJS..."

cd ames
npm start

