# Clean Architecture e Domain Driven Design com PHP
Projeto feito para estudar e praticar conceitos de Clean Architecture e de 
Domain Driven Design utilizando PHP.<br>
<br>

---

# Study Notes

## Alguns conceitos arquiteturais

### Entidade
A entidade representa um elemento do domínio que possa que tenha algum identificador único.<br>
No caso, a classe Aluno é uma entidade, e possui como identificador único o CPF, este é preferível em relação
a um id, pois independe da infraestrutura (considerando ids gerados por bancos de dados).<br>
<br>

### ValueObject
Se temos duas classes que, caso todos os seus atributos sejam iguais, esses dois objetos serão iguais, temos um
value object.<br>
O value objet não precisa de um identificador único, ele será igual quando todos os seus atributos tiverem valor igual.<br>
Diferente da Entidade, em que podemos ter vários dados repetidos, mas apenas representará o mesmo objeto caso tenha o
identificador único repetido. Exemplo: um aluno pode ter o mesmo nome, data de nascimento, etc., mas só será considerado
a mesma pessoa, se houver coincidência de CPFs, ou seja, apenas representa o mesmo objeto se houver o mesmo
identificador único.<br>
Neste caso, podemos citar a classe Email, pois ela apenas tem um atributo ($endereco), e este já é seu identificador
único, pois não existem dois e-mails com o mesmo endereço; assim, a classe Email representa um value object.
<br>

### Modelo Infraestrutura -> Aplicação -> Domínio
Ao seguirmos este modelo, teremos dependência apenas de fora pra dentro, e é interessante
que a parte que fica mais interna (domínio) não tenha conhecimento do que ocorre nas partes
mais externas.<br>
No entanto, é comum ter dúvidas em como persistir uma classe de domínio, por exemplo, um novo Aluno,
se as nossas classes de domínio não tem conhecimento de como a infraestrutura ocorre (e com ela, as comunicações
com o banco de dados). Para isso, criamos, dentro do domínio, uma interface que representa o repository, e nela
especficamos tudo o que desejamos fazer com aquela entidade. A infraestrutura, camada mais externa e que vai se
comunicar com o banco de fato, poderá ter conhecimento dessa interface (pois está mais externa que o domínio)
e, assim, implementará uma classe de acordo com essa interface.<br>
Todas as relações da classe de domínio será com a sua interface Repository, assim, caso haja
necessidade de mudança de banco de dados ou qualquer outro recurso que represente um repositório,
será mais fácil adaptar, basta apenas implementar um novo repositório, e a camada de domínio não
será impactada.
<br>

### Services
Quando precisamos aplicar alguma regra que não seja exatamente uma regra das entidades/VO, precisamos
de um serviço. Ele poderá ser ums serviço de domínio, por exemplo, a interface `CifradorDeSenhaInterface`
seria um serviço de domínio (caso houvesse alguma regra aplicada), pois é uma regra do negócio que a senha seja cifrada. Já as implementações
dessa interface, como, por exemplo, `CifradorDeSenhaPhp` é um serviço de infraestrutura, pois
para o domínio, apenas precisamos ter uma senha cifrada, como isso será feito, não importa para
o domínio, é um detalhe de infraestrutura, podendo, inclusive, ter várias implementações diferentes.
<br>

---

## DDD

Domain Driven Design é sobre por o domínio da aplicação sempre no centro e como prioritário,
haja vista, que se trata de uma modelagem orientada ao domínio.<br>
Com isso, alguns detalhes podem ser citados como, por exemplo, na nossa classe Aluno, que
representa uma entidade, poderíamos ter um id, que seria gerado pelo banco de dados e
identificaria esse aluno. No entanto, isso estaria feriando os conceitos do DDD, pois,
para um especialista de negócio, um aluno não tem um id, mas sim um CPF, e pode ser
identificado por meio dele. Assim, o ideial é tentar blindar de toda forma o domínio de
conceitos de infraestrutura.<br>
Pos isso utilizamos a inversão de dependências, criando a interface d repository, por exemplo,
na camada de domínio, interagindo apenas com ela, e deixamos a implementação na camada
de interface.<br>
No entanto, é sempre importante pesar as vantagens e desvantagens de cada abordagem.
<br>

### Linguagem Ubíqua
Preferir por utilizar terminologia utilizada nas reuniões com negócio nas classes e códigos
para facilitar o entendimento em sistemas maiores.<br>
Os termos usados no negócio devem ser usados no código, independente da língua utilizada.
<br>

### Aggregate
Um aggregate é uma classe/entidade que possui objetos relacionados e estes objetos relacionados
são controlados por essa entidade.<br>
No nosso caso, Aluno pode ser considerado o aggregate root, e o Telefone é o relacionamento.
Pois um telefone só pode ser criado por meio de um método existente dentro da classe de Aluno;
assim os telefones são agregados da entidade Aluno.<br>
Alguns exemplos e literaturas consideram o aggregate como sendo uma collection da classe agregada.
Mas isso não é muito correto, pois a classe agregadora possui mais funcionalidades, propriedades
e regras além de ser unicamente uma coleção de telefones.
<br>
A raiz de agregação controla todo o acesso da classe agregada. Assim, caso precisássemos
remover/adicionar um telefone, não o faríamos por meio de um repositório de telefone,
mas sim por meio do repositório da aggregate root (no nosso exemplo, Aluno). A raiz de agregação
cuida da persistência dos objetos agregados.
<br>

### Evento de Domínio
Algo que acontece no domínio da aplicação e que alguém precisa ser notificado disso.<br>
Um evento de domínio deve ser imutável, nunca poderá ser alterado. E precisa ser identificado.<br>
No nosso caso, a classe AlunoMatricula é um evento que ocorre depois que o use case
MatricularAluno ocorre.<br>
Resumindo, sempre que for executada a ação de MatricularAluno, será configurado que o evente terá
um ouvinte, neste caso o ouvinte será LogDeAlunoMatriculado. Quando terminar de adicionar o aluno,
será publicado o evento AlunoMatriculado e o log vai ser criado.
<br>

Um domínio possui eventos. Ao ocorrer certa ação, podemos publicar o evento para que ouvintes
consigam tomar conhecimento e reagir ao evento.
<br>

### Contextos delimitados (Bounded Contexts)
Alguns sistemas possuem contextos que são independentes, ou quase independentes entre si.<br>
No nosso caso, o sistema de gamificação é um contexto que não precisa conhecer nada de aluno ou de
indicação (contexto Acadêmico). A única coisa que os Selos precisam é saber o Cpf do Aluno.<br>
Sendo assim, com o uso de uma Mapa de Contextos, podemos nos certificar de que o Cpf é a única informação
da intersecção entre os dois contextos, e que, a partir disso, podemos serguir com duas
abordagens: permitir que o Cpf seja um shared content entre os contextos, ou duplicar essa
classe para cada um dos contextos, o que faria com que eles se tornassem completamente
independentes. A melhor abordagem é aquela que melhor se adequa às necessidades do sistema.<br>
Dependendo do caso e do tamanho do projeto, a separação de contextos acaba por auxiliar na visualização
no desacoplamento de possíveis projetos, em micros-serviços com responsabilidades específicas.
<br>

Exemplos de use cases em contextos separados: `MatricularAluno` e `BuscarSelosDeUsuario`.
<br>

#### Contextos compartilhados (Shared Contexts)
Não havendo a intenção de separar em projetos distintos, podemos utilizar um módulo com
Shared Kernel, ou seja, com as classes que serão utilizadas por ambos os contextos.<br>
Isso cria, de certa forma, uma dependência entre os contextos, mas é uma solução simples,
permite a comunicação entre os contexos, e cabe ao nosso caso, embora tire a
flexibilidade. Vai de caso a caso.
<br>