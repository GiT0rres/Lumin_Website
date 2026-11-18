# 🌌 LUMIN
### Aprenda idiomas. Explore o mundo. Traduza a realidade.

<p align="center">
  <img src="https://img.shields.io/badge/STATUS-EM_DESENVOLVIMENTO-9D4EDD?style=for-the-badge" alt="Status: Em desenvolvimento" />
  <img src="https://img.shields.io/badge/PROJETO-TCC-7B2CBF?style=for-the-badge" alt="Projeto TCC" />
  <img src="https://img.shields.io/badge/PLATAFORMA-Mobile-5A189A?style=for-the-badge" alt="Aplicativo mobile" />
</p>

<p align="center">
  <strong>Transformando o mundo real em uma experiência de aprendizado de idiomas.</strong>
  <br />
  <em>Uma nova maneira de aprender vocabulário: observando, descobrindo e interagindo com o cotidiano.</em>
</p>

<p align="center">
  <a href="https://github.com/AntonioSena0/Lumin">Repositório do projeto</a>
</p>

---

## ✨ Sobre o projeto

O **Lumin** é um aplicativo de aprendizado de idiomas que utiliza a câmera do celular para identificar objetos do mundo real e apresentar suas traduções em tempo real.

A proposta é tornar o aprendizado mais **natural, visual e contextualizado**, conectando os objetos presentes no dia a dia ao vocabulário de outro idioma.

Em vez de depender exclusivamente de listas de palavras e métodos tradicionais, o usuário aprende a partir daquilo que vê ao seu redor.

> 💡 **Nossa ideia:** transformar qualquer ambiente em uma oportunidade de aprendizado.

## 🎯 Objetivo

Desenvolver uma ferramenta tecnológica que facilite a aquisição de vocabulário em outros idiomas por meio da identificação visual de objetos, aproximando o aprendizado da realidade do usuário.

## 🚀 Funcionalidades do aplicativo

| Funcionalidade | Descrição |
|:---|:---|
| 📷 **Detecção em tempo real** | Utiliza a câmera para identificar objetos do ambiente. |
| 🎯 **Foco inteligente** | Prioriza o objeto centralizado na tela. |
| 🌍 **Tradução de objetos** | Apresenta a tradução correspondente ao objeto identificado. |
| ⚡ **Controle de detecções** | Evita exibir múltiplas traduções simultaneamente. |

<sub>O aplicativo está em desenvolvimento e as funcionalidades podem evoluir durante a construção do MVP.</sub>

---

## 🛠️ Tecnologias utilizadas

As tecnologias estão organizadas de acordo com suas funções no projeto.

| Categoria | Tecnologias |
|:---|:---|
| 📱 Aplicativo mobile | Dart, Flutter |
| ⚙️ Backend / API | Java, Spring Boot |
| 🗄️ Banco de dados | PostgreSQL |
| 🐳 Ambiente e containers | Docker |
| 🎨 Site de apresentação | Laravel, Blade, Tailwind CSS |
| 🔐 Autenticação do site | Laravel Breeze |
| 🧰 Versionamento | Git e GitHub |

---

# 📱 Executando o aplicativo Lumin

## Pré-requisitos

Antes de começar, verifique se você possui:

- Flutter SDK instalado e configurado;
- Android Studio ou ferramentas necessárias para o Android SDK;
- Java compatível com a versão do backend;
- Docker e Docker Compose;
- Um dispositivo Android com depuração USB habilitada ou um emulador.

## 1. Configurando a API

A API é responsável pela estrutura de backend do aplicativo.

**Passo 1 — Configure as variáveis de ambiente**

Crie o arquivo `.env` dentro da pasta `api`, utilizando o `.env.example` como referência.

```shell
copy .env.example .env
```

**Passo 2 — Inicie os serviços**

Na raiz do projeto, execute:

```bash
docker compose up --build
```

Aguarde a construção das imagens e a inicialização dos serviços.

> ⚠️ Verifique se as variáveis de ambiente, as credenciais do banco e as portas estão configuradas corretamente antes de executar a API.

## 2. Configurando o aplicativo mobile

Entre na pasta `mobile` e execute os comandos abaixo:

```bash
# Instala as dependências do Flutter
flutter pub get

# Verifica os dispositivos disponíveis
flutter devices

# Executa o aplicativo
flutter run
```

### Gerando o APK

Para gerar uma versão de depuração do aplicativo:

```bash
flutter build apk --debug
```

O arquivo gerado normalmente estará em:

```text
build/app/outputs/flutter-apk/app-debug.apk
```

Para instalar ou atualizar o aplicativo em um dispositivo Android conectado e autorizado:

```bash
adb install -r build/app/outputs/flutter-apk/app-debug.apk
```

### 📌 Observações importantes

- A câmera precisa da permissão correspondente no Android.
- O aplicativo prioriza um objeto por vez, com foco no objeto centralizado.
- O dispositivo deve estar autorizado para depuração USB quando a execução ocorrer por meio do ADB.
- O plugin `ultralytics_yolo` pode apresentar avisos relacionados ao Kotlin Gradle Plugin durante a compilação. Verifique se o build realmente falhou antes de tratar o aviso como erro.

---

# 💻 Site de apresentação do TCC

Além do aplicativo mobile, o projeto possui um site desenvolvido para apresentar o Lumin, explicar sua proposta, demonstrar suas funcionalidades e documentar os aspectos técnicos do TCC.

**Tecnologias:** Laravel + Laravel Breeze + Blade + Tailwind CSS.

O conteúdo do site vem de `config/lumin.php`. O banco de dados é usado pela autenticação do Laravel Breeze e pelas **recomendações** enviadas pelo formulário de contato, que os administradores avaliam em um painel próprio.

## 📸 Demonstração do site

Os prints abaixo foram tirados com o site rodando localmente. Eles estão organizados em cinco partes:

1. [Site rodando em localhost](#1-site-rodando-em-localhost)
2. [Banco de dados: migrations e seeders](#2-banco-de-dados-migrations-e-seeders)
3. [Front-end: operações CRUD](#3-front-end-operações-crud)
4. [Back-end: operações CRUD](#4-back-end-operações-crud)
5. [Telas do site](#5-telas-do-site)

O CRUD do site é o das **recomendações**. Qualquer visitante pode enviar uma pelo formulário de contato (**Create**). Os administradores a veem no painel (**Read**), aprovam, rejeitam ou reabrem (**Update**) e podem excluí-la (**Delete**).

---

## 1. Site rodando em localhost

### 1.1 Landing page em `localhost:8000`

O site rodando com `php artisan serve` e aberto no navegador em `http://localhost:8000`.

![Landing page do Lumin aberta em localhost:8000](assets/screenshots/1-localhost/01-site-em-localhost.png)

### 1.2 Painel de administração em `localhost:8000/admin/recomendacoes`

O painel de recomendações aberto por um administrador logado.

![Painel de recomendações aberto em localhost](assets/screenshots/1-localhost/02-painel-admin-em-localhost.png)

---

## 2. Banco de dados: migrations e seeders

### 2.1 Migration das recomendações

Cria a tabela `recommendations` (nome, e-mail, mensagem, status e datas) e adiciona a coluna `is_admin` à tabela `users`. O método `down()` desfaz as duas alterações.

![Migration create_recommendations_table](assets/screenshots/2-banco-de-dados/01-migration-recommendations.png)

### 2.2 Model `Recommendation`

Define os campos que podem ser preenchidos e os três status possíveis: `pendente`, `aprovada` e `rejeitada`.

![Model Recommendation](assets/screenshots/2-banco-de-dados/02-model-recommendation.png)

### 2.3 Factory de usuários

Gera usuários com dados aleatórios. O estado `admin()` cria o usuário já como administrador.

![UserFactory com o estado admin](assets/screenshots/2-banco-de-dados/03-factory-user.png)

### 2.4 Seeder

Cria 10 usuários aleatórios pela factory e 4 administradores, um para cada integrante da equipe.

![DatabaseSeeder](assets/screenshots/2-banco-de-dados/04-seeder.png)

### 2.5 Migrations executadas

Conteúdo da tabela `migrations` depois de `php artisan migrate --seed`: as 3 migrations padrão do Laravel e a das recomendações.

![Tabela migrations no SQLite](assets/screenshots/2-banco-de-dados/05-tabela-migrations.png)

### 2.6 Usuários gerados pelo seeder

Conteúdo da tabela `users`: os 10 usuários aleatórios e os 4 administradores (destacados, com `is_admin = 1`).

![Tabela users no SQLite](assets/screenshots/2-banco-de-dados/06-tabela-users.png)

---

## 3. Front-end: operações CRUD

### 3.1 Create: formulário de contato preenchido

O visitante preenche nome, e-mail e a recomendação na seção *Contato* da landing page.

![Formulário de contato preenchido](assets/screenshots/3-frontend-crud/01-create-formulario-preenchido.png)

### 3.2 Create: recomendação enviada

Depois do envio, o site confirma que a recomendação foi recebida.

![Mensagem de recomendação enviada](assets/screenshots/3-frontend-crud/02-create-mensagem-enviada.png)

### 3.3 Read: painel do administrador

O administrador vê todas as recomendações, com a contagem por status.

![Painel com todas as recomendações](assets/screenshots/3-frontend-crud/03-read-painel-admin.png)

### 3.4 Read: filtro por status

As recomendações também podem ser filtradas por status. Aqui, só as pendentes.

![Painel filtrado por recomendações pendentes](assets/screenshots/3-frontend-crud/04-read-filtro-pendentes.png)

### 3.5 Update: recomendação aprovada

Ao clicar em **Aprovar**, o status da recomendação de Marina Alves muda para *Aprovada*, e os botões passam a ser **Rejeitar** e **Reabrir**.

![Recomendação aprovada no painel](assets/screenshots/3-frontend-crud/05-update-aprovada.png)

### 3.6 Delete: confirmação de exclusão

Ao clicar em **Excluir**, um modal pede a confirmação antes de apagar a recomendação.

![Modal de confirmação de exclusão](assets/screenshots/3-frontend-crud/06-delete-modal-confirmacao.png)

### 3.7 Delete: recomendação removida

Depois de confirmar, a recomendação de Lucas Pereira some da lista e a contagem é atualizada.

![Painel após a exclusão](assets/screenshots/3-frontend-crud/07-delete-removida.png)

---

## 4. Back-end: operações CRUD

### 4.1 Rotas

As rotas do CRUD em `routes/web.php`. O envio é público e limitado a 5 por minuto. As rotas do painel exigem login e permissão de administrador (`can:admin`).

![Rotas em routes/web.php](assets/screenshots/4-backend-crud/01-rotas-web.png)

### 4.2 Lista de rotas registradas

As 4 rotas do CRUD, com o método HTTP, o nome, a ação do controller e os middlewares de cada uma.

![Lista de rotas das recomendações](assets/screenshots/4-backend-crud/02-lista-de-rotas.png)

### 4.3 Controller

O `RecommendationController` faz as quatro operações: `store` (Create), `index` (Read), `update` (Update) e `destroy` (Delete). Os dados são validados antes de chegar ao banco.

![RecommendationController](assets/screenshots/4-backend-crud/03-controller.png)

### 4.4 Permissão de administrador

O Gate `admin`, definido no `AppServiceProvider`, libera o painel apenas para usuários com `is_admin` verdadeiro.

![Gate admin no AppServiceProvider](assets/screenshots/4-backend-crud/04-gate-admin.png)

### 4.5 Banco antes do Create

A tabela `recommendations` começa vazia.

![Tabela recommendations vazia](assets/screenshots/4-backend-crud/05-banco-antes-create.png)

### 4.6 Banco depois do Create

Depois dos envios pelo formulário (`POST /recomendacoes`), a tabela tem 3 registros com o status `pendente`.

![Tabela recommendations após o create](assets/screenshots/4-backend-crud/06-banco-apos-create.png)

### 4.7 Banco depois do Update

Depois da aprovação (`PATCH /admin/recomendacoes/1`), o registro de Marina Alves (destacado) está com o status `aprovada` e o `updated_at` atualizado.

![Tabela recommendations após o update](assets/screenshots/4-backend-crud/07-banco-apos-update.png)

### 4.8 Banco depois do Delete

Depois da exclusão (`DELETE /admin/recomendacoes/2`), o registro de Lucas Pereira não existe mais.

![Tabela recommendations após o delete](assets/screenshots/4-backend-crud/08-banco-apos-delete.png)

---

## 5. Telas do site

### 5.1 Início

Abertura da landing page, com a proposta do Lumin e as telas do app.

![Início da landing page](assets/screenshots/5-telas/01-inicio.png)

### 5.2 Sobre

O que é o Lumin e qual o objetivo do projeto.

![Seção Sobre](assets/screenshots/5-telas/02-sobre.png)

### 5.3 Telas do aplicativo

Carrossel com as telas do protótipo feito no Figma.

![Carrossel com as telas do protótipo](assets/screenshots/5-telas/03-telas-do-app.png)

### 5.4 Funcionalidades e tecnologias

As funcionalidades desta versão do app e as tecnologias usadas.

![Funcionalidades e tecnologias](assets/screenshots/5-telas/04-funcionalidades-e-tecnologias.png)

### 5.5 Como rodar

Passo a passo para executar a API e o app mobile.

![Passo a passo para rodar o projeto](assets/screenshots/5-telas/05-como-rodar.png)

### 5.6 Equipe

Os integrantes do projeto, com link para o GitHub de cada um.

![Equipe do projeto](assets/screenshots/5-telas/06-equipe.png)

### 5.7 Contato

Formulário para enviar recomendações à equipe.

![Formulário de contato](assets/screenshots/5-telas/07-contato.png)

### 5.8 Cadastro

Criação de conta pelo Laravel Breeze: nome de usuário, e-mail, senha e aceite dos termos.

![Tela de cadastro](assets/screenshots/5-telas/08-cadastro.png)

### 5.9 Login

Entrada com e-mail e senha, com opção de recuperar a senha.

![Tela de login](assets/screenshots/5-telas/09-login.png)

### 5.10 Dashboard

Área para usuários logados, com a demonstração técnica: protótipos, fluxo do usuário, fluxo técnico, rotas do Breeze e atribuições da equipe.

![Dashboard completo](assets/screenshots/5-telas/10-dashboard.png)

### 5.11 Erro 404

Página exibida quando o endereço não existe, com a identidade visual do Lumin.

![Página de erro 404](assets/screenshots/5-telas/11-erro-404.png)

### 5.12 Erro 403

Página exibida quando um usuário comum tenta abrir o painel de administração.

![Página de erro 403](assets/screenshots/5-telas/12-erro-403-usuario-comum.png)

## 📋 Requisitos do ambiente

- PHP 8.3 ou superior;
- Composer;
- Node.js 20 ou superior;
- npm;
- SQLite ou MySQL.

## ⚙️ Instalação e execução

**1. Instale as dependências do PHP**

```bash
composer install
```

**2. Configure o ambiente**

```bash
cp .env.example .env
php artisan key:generate
```

ou

```shell
php artisan key:generate
````

**3. Configure o banco de dados**

Para utilizar SQLite:

```bash
touch database/database.sqlite
php artisan migrate
```

**4. Instale as dependências do front-end**

```bash
npm install
npm run build
```

**5. Inicie a aplicação**

```bash
composer run dev
```

**6. Utilizar seeders**

```bash
php artisan db:seed
```

O seeder cria 10 usuários aleatórios e 4 administradores, um para cada integrante da equipe. Todos usam a senha `password`.

| Administrador | E-mail |
|:---|:---|
| Antonio Sena | `antonio@lumin.test` |
| Arthur Gutemberg | `arthur@lumin.test` |
| Beatriz Galdino | `beatriz@lumin.test` |
| Giovanna Torres | `giovanna@lumin.test` |

**7. Rodar os testes**

```bash
php artisan test
```

## 🖥️ Estrutura do site

| Área | Arquivo / Diretório | Descrição |
|:---|:---|:---|
| 🏠 Landing page | `resources/views/welcome.blade.php` | Apresentação do projeto, funcionalidades, tecnologias e equipe. |
| 📊 Dashboard | `resources/views/dashboard.blade.php` | Demonstração técnica, protótipos, fluxo e informações do desenvolvimento. |
| 🛡️ Painel admin | `resources/views/admin/recommendations.blade.php` | Avaliação das recomendações recebidas pelo formulário de contato. |
| 📨 Recomendações | `app/Http/Controllers/RecommendationController.php` | Recebe, lista, avalia e exclui recomendações. |
| 🚧 Páginas de erro | `resources/views/errors/` | Páginas de erro com a identidade visual do Lumin. |
| 📱 Protótipos | `public/images/screens/` | Imagens das telas desenvolvidas no Figma. |
| 📸 Prints do site | `assets/screenshots/` | Capturas de tela usadas neste README. |
| 🧩 Componentes | `resources/views/components/` | Componentes Blade reutilizáveis, incluindo ícones, dispositivos e campos de senha. |
| ⚙️ Conteúdo | `config/lumin.php` | Informações do projeto centralizadas em configuração, sem CRUD. |
| 🎨 Estilos | `tailwind.config.js` | Configuração da identidade visual do site. |

### 🎨 Identidade visual

O site utiliza uma interface com tema escuro, tipografia Poppins e uma paleta de tons violeta e magenta.

- **Tailwind CSS 3:** estilização e identidade visual;
- **Alpine.js:** interações, menu mobile, galeria e ampliação dos protótipos;
- **Laravel Breeze:** autenticação e páginas relacionadas.

## 🔐 Autenticação e rotas

O Laravel Breeze fornece as funcionalidades de autenticação utilizadas pelo site.

| Rota | Funcionalidade |
|:---|:---|
| `/login` | Login de usuários |
| `/register` | Cadastro de usuários |
| `/forgot-password` | Recuperação de senha |
| `/dashboard` | Painel de demonstração, com autenticação |
| `/profile` | Perfil do usuário |

Rotas das recomendações:

| Rota | Acesso | Funcionalidade |
|:---|:---|:---|
| `POST /recomendacoes` | Público | Envia uma recomendação pelo formulário de contato |
| `GET /admin/recomendacoes` | Admins | Lista e filtra as recomendações |
| `PATCH /admin/recomendacoes/{id}` | Admins | Altera o status (pendente, aprovada ou rejeitada) |
| `DELETE /admin/recomendacoes/{id}` | Admins | Exclui uma recomendação |

O acesso ao painel é controlado pela coluna `is_admin` da tabela `users` e pelo Gate `admin`, definido em `AppServiceProvider`.

**Importante:** o site não implementa CRUD de alunos, cursos ou outros recursos. As tabelas utilizadas são as de autenticação e perfil do usuário e a tabela `recommendations`, conforme as migrações presentes no projeto.

---

## 👥 Equipe de desenvolvimento

Conheça as pessoas envolvidas no desenvolvimento do Lumin e suas atribuições no site de apresentação.

| Integrante | GitHub | Atribuição |
|:---|:---|:---|
| **Antonio Sena** | [@AntonioSena0](https://github.com/AntonioSena0) | Diagramação e desenvolvimento back-end |
| **Arthur Gutemberg** | [@ArthurGutemberg9](https://github.com/ArthurGutemberg9) | Elaboração do artigo científico |
| **Beatriz Galdino** | [@Beatriz1505](https://github.com/Beatriz1505) | Branding e desenvolvimento mobile |
| **Giovanna Torres** | [@GiT0rres](https://github.com/GiT0rres) | Desenvolvimento mobile e front-end |

---

## 🌟 Nossa visão

Acreditamos que aprender um novo idioma pode ir além de decorar palavras.

Com o Lumin, queremos aproximar a tecnologia da rotina das pessoas e transformar situações comuns em oportunidades de descoberta, curiosidade e aprendizado.

**Lumin — o mundo ao seu redor também pode ensinar.**

---

<p align="center">
  Desenvolvido com 💜 pela equipe Lumin
  <br />
  <sub>Projeto de Trabalho de Conclusão de Curso (TCC)</sub>
</p>
