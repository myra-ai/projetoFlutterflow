```markdown
# 📌 Event API - Laravel 10

Esta API foi desenvolvida para gerenciar eventos, incluindo funcionalidades para listar, criar, editar e excluir eventos. O projeto utiliza **Laravel 10** e segue boas práticas de desenvolvimento.

---

## 🚀 Tecnologias Utilizadas

- **PHP >= 8.1**
- **Laravel 10**
- Banco de Dados (MySQL, PostgreSQL ou outro compatível com Laravel)
- Composer
- Log para depuração (`Log` do Laravel)

---

## 📋 Pré-requisitos

1. **PHP 8.1 ou superior**.
2. **Composer** instalado.
3. Servidor local configurado (ex.: Laravel Sail, XAMPP, Laragon, etc.).
4. Banco de dados configurado e rodando.
5. **Git** (para clonar o repositório, se necessário).

---

## 🛠️ Instalação

1. **Clone o repositório:**
   ```bash
   git clone https://github.com/seu-usuario/event-api.git
   cd event-api
   ```

2. **Instale as dependências:**
   ```bash
   composer install
   ```

3. **Configure o arquivo `.env`:**
   - Copie o arquivo de exemplo:
     ```bash
     cp .env.example .env
     ```
   - Configure as informações do banco de dados:
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=nome_do_banco
     DB_USERNAME=seu_usuario
     DB_PASSWORD=sua_senha
     ```

4. **Gere a chave da aplicação:**
   ```bash
   php artisan key:generate
   ```

5. **Execute as migrações:**
   ```bash
   php artisan migrate
   ```

6. **Inicie o servidor local:**
   ```bash
   php artisan serve
   ```

A API estará disponível em [http://127.0.0.1:8000](http://127.0.0.1:8000).

---

## 📚 Endpoints

### **1. Listar eventos**
- **URL:** `GET /api/eventos`
- **Descrição:** Retorna todos os eventos cadastrados.
- **Exemplo de Resposta:**
  ```json
  [
      {
          "id": 1,
          "title": "Evento Teste",
          "date": "2024-12-10",
          "image": "http://example.com/image.jpg",
          "details": "Detalhes do evento",
          "valor": 100.0
      }
  ]
  ```

### **2. Criar evento**
- **URL:** `POST /api/eventos`
- **Descrição:** Cria um novo evento.
- **Parâmetros (Body):**
  ```json
  {
      "title": "Novo Evento",
      "date": "2024-12-15",
      "image": "http://example.com/image.jpg",
      "details": "Detalhes do evento",
      "valor": 150.0
  }
  ```
- **Exemplo de Resposta:**
  ```json
  {
      "message": "Evento criado com sucesso!",
      "event": {
          "id": 2,
          "title": "Novo Evento",
          "date": "2024-12-15",
          "image": "http://example.com/image.jpg",
          "details": "Detalhes do evento",
          "valor": 150.0
      }
  }
  ```

### **3. Editar evento**
- **URL:** `PUT /api/eventos/{id}`
- **Descrição:** Atualiza os dados de um evento existente.
- **Parâmetros (Body):**
  ```json
  {
      "title": "Título Atualizado",
      "date": "2024-12-20",
      "image": "http://example.com/new-image.jpg"
  }
  ```
- **Exemplo de Resposta:**
  ```json
  {
      "message": "Evento atualizado com sucesso!",
      "event": {
          "id": 1,
          "title": "Título Atualizado",
          "date": "2024-12-20",
          "image": "http://example.com/new-image.jpg",
          "details": "Detalhes do evento",
          "valor": 100.0
      }
  }
  ```

### **4. Deletar evento**
- **URL:** `DELETE /api/eventos/{id}`
- **Descrição:** Remove um evento pelo ID.
- **Exemplo de Resposta:**
  ```json
  {
      "message": "Evento deletado com sucesso!"
  }
  ```

---

## 🧰 Logs e Depuração

- Logs são gerados automaticamente para cada ação.
- Verifique os logs em: `storage/logs/laravel.log`.

---

## 🛡️ Validações

- **`title`**: obrigatório, string, máximo 255 caracteres.
- **`date`**: obrigatório, formato de data.
- **`image`**: obrigatório, string (URL da imagem).
- **`details`**: obrigatório, string.
- **`valor`**: obrigatório, numérico, mínimo 0.

---

## 🗂️ Estrutura de Arquivos Relevantes

- **Controllers:**
  - `app/Http/Controllers/EventController.php`
- **Model:**
  - `app/Models/Event.php`
- **Migrações:**
  - `database/migrations/2024_12_07_create_eventos_table.php`

---

## 🖋️ Contribuições

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues ou enviar pull requests.

---

## 📄 Licença

Este projeto está licenciado sob a [MIT License](LICENSE).
```
