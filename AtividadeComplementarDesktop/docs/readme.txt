Os arquivos XML de configuração, como os cursos aceitos, as regras de cálculo de 
horas e qualquer outro que for necessário deve ser colocados no diretórios "conf"
e depois deve ser criada uma classe java mapeada com as anotações do JAXB no 
pacote de modelos. Caso as informações do XML sejam uma lista, seguir o exemplo 
das classes Curso.java e CursosXML.java, sendo que a primeira possui as 
informações de um curso específico e a segunda agrupa diversos cursos.