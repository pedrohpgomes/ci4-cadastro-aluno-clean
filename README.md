# Cadastro de alunos com o CodeIgniter 4

## Requerimentos (retirado da documentação do CodeIgniter 4 - CI4)

PHP versão 7.4 or posterior, com as seguintes extensões instaladas:
 - [intl](http://php.net/manual/en/intl.requirements.php);
 - [libcurl](http://php.net/manual/en/curl.requirements.php) caso planeje usar a bibliteca HTTP\CURLRequest;

 Adicionalmente, certifique-se de que estejam habilitadas as seguintes extensões em seu PHP:
 - json (habilitada por padrão - não desabilite);
 - [mbstring](http://php.net/manual/en/mbstring.installation.php);
 - [mysqlnd](http://php.net/manual/en/mysqlnd.install.php);
 - xml (habilitada por padrão - não desabilite);

É necessário o composer para rodar este projeto.

===========================================================

## Como rodar o projeto:

 Renomeie o arquivo .env.copy para .env:
 - configure a opção app.baseURL caso achar necessário (no arquivo está como 'http://localhost:8050')
 - configure as opções do database.default, caso achar necessário (se atentar ao driver utilizado. O driver MySQLi serve também para o PhpMyAdmin)
 - crie no seu SGBD o banco de dados com nome igual ao colocado da opção 'database.default.database'
 
 Após configurar o .env, será necessário criar as tabelas e popular o banco de dados. Abra um terminal de comando na raiz do projeto e digite os seguintes comandos:
 - "composer install" (sem aspas), para instalar as dependências do CodeIgniter 4;
 - "php spark migrate -g default" (sem aspas), para criar a tabela alunos;
 - "php spark db:seed AlunosSeeder -g default" (sem aspas), para popular a tabela alunos.
 
 Agora, basta o projeto com o servidor local embutido no CI4, o spark:
 - "php spark serve --port 8050" (atenção para a porta utilizada. Deve ser a mesma que foi colocada no app.baseURL, caso tenha colocado).
 
===========================================================

# A ideia do projeto:

A proposta é uma tentativa inicial de aplicar o conceito de Clean Architecture (arquitetura limpa) no CodeIgniter 4.

A estrutura básica do projeto está em App/Components/Aluno. O componente aluno contempla praticamente todo o projeto, à exceção das views, helpers, migrations e seeders que estão nos respectivos diretórios do CI4. A estrutura possui basicamente 3 camadas, que são:  
<br />
	<p>* Domain (Domínio) - É a camada mais interna do sistema. Nela ficam as entidades e a regra de negócios. É a razão do sistema existir, que neste caso é o aluno.</p>
	<p>* Application (Aplicação) - É a camada que contém as regras da aplicação. Faz a orquestração das entidades e implementa as regras da aplicação.</p>
	OBS: as camadas de domínio e de aplicação devem estar isoladas do mundo exterior, ou seja, não devem depender do framework utilizado, ou do banco de dados, ORM, ou coisa alguma que seja externa.
	<p>Para conseguir tal objetivo, foram utilizadas interfaces para se comunicar com o mundo externo e o conceito SOLID, principalmente o Liskov Substitution Principle (Princípio da Subistituicao de Liskov) e Dependency Inversion Principle (Princípio de Inversão de Dependência).</p>
		<p>Assim, caso seja necessário mudar o banco de dados de MySQL para SQL Server, por exemplo, não deve ser necessário alterar nada nas camadas de domínio e de aplicação. Apenas implementar a interface AlunoRepositoryInferface e mudar o repositório chamado na hora de instanciar o serviço (service) no controller.</p>  
	<p>* Infra (Camada de infraestrutura) - É a camada mais externa do sistema, onde ficam os controllers e o repositório que implementa a AlunoRepositoryInterface. O Controllers fazem a orquestração dos serviços (services) da camada de aplicação.</p>
	
===========================================================

# Minhas Considerações

<p>OBS: esta parte poderá ser atualiza caso eu consiga melhorar ainda mais o código ou implementar nova funcionalidade</p>

## Experiência com o CodeIgniter 4
<p>Este foi meu primeiro projeto com o CodeIgniter 4. Já havia trabalhado com o CodeIgniter 3 e com o Laravel.</p>

## O que deu certo
<p>Desenvolver o sistema em camadas de forma a isolar as camdas de domínio e aplicação do resto do mundo.</p>
<p>Utilização do template AdminLTE 3 para o front-end.</p>

## O que pode melhorar no código
<p>A montagem do layout do front-end. Tem como criar o layout utilizando seção (section), para que cada página de conteúdo possa extender o layout.</p>
<p>A parte de testes (tanto de unidade como de integração) com o PhpUnit. Não consegui implementar utilizando SQLite, que é um banco de dados embutido que roda diretamente na memória. Ao que parece, sem utilizar o SQLite, seria necessário criar 02 banco de dados: um para a aplicação e outro os teste. Usando interface para o repositório, na hora de chamar o repositório que utiliza a model do codeigniter, ela grava no banco de dados default. Mesmo chamando ao repositório por meio de uma classe de teste, os dados são gravados no banco default e não no de tests. Tenho que ver como solucionar isso, senão vai ser necessário duplicar o repositório e a model, tendo um para o banco de dados default e outro para o de teste.</p>
<p>A parte de validação do formulário preciso ver como separar do restante das etapas para se gravar/excluir/editar o cadastro de um aluno, para melhor organização do código.</p>
<br />
<p>Pode parecer um pouco complexo programar em camadas como sugere o "uncle Bob", autor do livro "Arquitetura limpa: O guia do artesão para estrutura e design de software" (Clean Architecture: A Craftsman's Guide to Software Structure and Design), difícil no começo, e até um pouco mais demorado por causa dos testes. No entanto possui enormes ganhos, principalmente no quesito de testabilidade e manutenibilidade.</p>
<p>Preciso implementar a questão do teste, de preferência com algum banco de dados que rode em memória e não dependa de nenhum SGBD.</p>

===========================================================

## Em relação à Clean Architecture nete projeto

<p>Talvez seja necessário criar uma espécie de MainController para gerenciar os outros controles, pois o ideal é que os controllers não extendam o BaseController.</p>
<p>Preciso ver se o CI4 trabalha com algum tipo de container para inversão de dependência ou como ele lida com isso, se tem alguma forma melhor.</p>
<p>Para a arquitetura limpa, implementar os testes é fundamental, uma vez que o sistema é criado "de dentro para fora"), ou seja, da camada de Domínio, depois para a Aplicação e somente depois para a camada de Infra. Sem implementar os testes, não se consegue realizar a arquitetura limpa. Portanto, descobrir como rodar teste em um banco em memória é fundamental.</p>
<br />
<br />
<p>Por enquanto é isso. Á medida em que for me aperfeiçoando, o projeto poderá ser melhorado.</p>


