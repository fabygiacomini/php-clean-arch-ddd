# Clean Architecture Notes

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
