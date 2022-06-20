#Cadastro de alunos com o CodeIgniter 4

## Requerimentos (retirado da documentação do CodeIgniter 4 (CI4))

PHP versão 7.4 or posterior, com as seguintes extensões instaladas:
 - [intl](http://php.net/manual/en/intl.requirements.php)
 - [libcurl](http://php.net/manual/en/curl.requirements.php) caso planeje usar a bibliteca HTTP\CURLRequest

 Adicionalmente, certifique-se de que estejam habilitadas as seguintes extensões em seu PHP:
 - json (habilitada por padrão - não desabilite)
 - [mbstring](http://php.net/manual/en/mbstring.installation.php)
 - [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
 - xml (habilitada por padrão - não desabilite)

## Como rodar o projeto:

 Renomeie o arquivo .env.copy para .env:
 - configure a opção app.baseURL caso achar necessário (no arquivo está como 'http://localhost:8050')
 - configure as opções do database.default, caso achar necessário (se atentar ao driver utilizado. O driver MySQLi serve também para o PhpMyAdmin)
 - crie no seu SGBD o banco de dados igual ao colocado da opção 'database.default.database'
 
 Após configurar o .env, será necessário criar as tabelas e popular o banco de dados. Abra um terminal de comando na raiz do projeto e digite os seguintes comandos:
 - "composer install" (sem aspas), para instalar as dependências do CodeIgniter 4;
 - "php spark migrate -g default" (sem aspas), para criar a tabela alunos;
 - "php spark db:seed AlunosSeeder -g default" (sem aspas), para popular a tabela alunos.
 
 Agora, basta o projeto com o servidor local embutido no CI4, o spark:
 - "php spark serve --port 8050" (atenção para a porta utilizada. Deve ser a mesma que foi colocada no app.baseURL, caso tenha colocado).
 
======================================================================================

# A ideia do projeto:

A proposta é uma tentativa inicial de aplicar o conceito de Clean Architecture (arquitetura limpa) no CodeIgniter 4.

A estrutura básica do projeto está em App/Components/Aluno. O componente aluno contempla praticamente todo o projeto, à exceção das views, helpers, migrations e seeders que estão nos respectivos diretórios do CI4. A estrutura possui basicamente 3 camadas, que são:
	* Domain (Domínio) - É a camada mais interna do sistema. Nela ficam as entidades e a regra de negócios. É a razão do sistema existir, que neste caso é o aluno.
	* Application (Aplicação) - É a camada que contém as regras da aplicação. Faz a orquestração das entidades e das regras de negócio.
	OBS: as camadas de domínio e de aplicação devem estar isoladas do mundo exterior, ou seja, não devem depender do framework utilizado, ou do banco de dados, ORM, ou coisa alguma que seja externa.
		Para conseguir tal objetivo, utilizamos interfaces para se comunicar com o mundo externo e o conceito SOLID, principalmente o Liskov Substitution Principle (Princípio da Subistituicao de Liskov) e Dependency Inversion Principle (Princípio de Inversão de Dependência).
		Assim, caso seja necessário mudar o banco de dados de MySQL para SQL Server, por exemplo, não deve ser necessário alterar nada nas camadas de domínio e de aplicação. Apenas implementar a interface AlunoRepositoryInferface e mudar o repositório chamado na hora de instanciar o serviço (service) no controller.
	* Infra (Camada de infraestrutura) - É a camada mais externa do sistema, onde ficam os controllers e o repositório que implementa a AlunoRepositoryInterface. O Controllers fazem a orquestração dos serviços (services) da camada de aplicação.

