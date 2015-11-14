# Change Data Structure
Restructuración de una estructura de datos con la menos complejidad ciclomática posible.

Esto problema viene dado por una serie de retos compartidos por @okrmartin , @emanzipado y @carlhm en un principio y abierto a cualquier que quiera participar.

## Descripción del problema
El reto consiste en hacer una transformación de estructura de los datos con la menor complejidad ciclomática posible. Otros atributos como la velocidad de ejecución, la testeabilidad, extensibilidad y mantenibilidad pueden ser discutidos en un debriefing del ejercicio y ser propuestos para repetir el reto con un nuevo objetivo.

En la hoja de cálculo junto a esta descripción hay ejemplos que pretenden ilustrar en qué consiste la transformación. Tenemos objetos definidos con un código que no puede ser 0. 

Estos pueden ser de tipo A, A+x, B, B+x. Como la estructura de entrada desaprovecha mucho espacio, se quiere transformar en la estructura de salida que pretende emparejar objetos por su tipo primario.

Por tanto. Nuestro programa deberá leer un archivo Csv con la estructura descrita en el ejemplo como "In" y deberá escribir un Csv con la estructura descrita en el ejemplo como "Out"

## Ejecución

Suponemos que existe un fichero del tipo `FICHERO_INPUT.csv` con el formato correcto, esto es que existan valores númericos que representen la matriz p.e. (10,Ax,Ay,Bx,By). El fichero de salida `FICHERO_OUTPUR.csv` será el segundo argumento en la ejecución y no es necesario que exista previamente. Es recomendable usar el directorio files para almacenar estos ficheros, como se especifica en el ejemplo, pero no necesario para su ejecución.

`> php reto_1/reto.php file/FICHERO_INPUT.csv file/FICHERO_OUTPUT.csv`

## Ejemplo de entrada FICHERO_INPUT.csv

Existe un ejemplo de entrada en el directorio files con el nombre input.csv. 

```
10,TRUE,,,
20,,TRUE,,
30,,,TRUE,
40,,,,TRUE
```

## Ejemplo de salida FICHERO_OUTPUT.csv

```
X,Y,A/B
10,,A
20,30,B
40,,B
```

### Complejidad Ciclomática de la solución propuesta

Según la herramienta `PDEPEND` en su salida por pantalla nos muestra :

``
Executing CyclomaticComplexity-Analyzer: 4
``

Que mide la complejidad de nuestro código principal. 

Así, la página http://ars.altervista.org/lint_php/lint_php.php nos informa de que la complejidad es de 

``
The McCabe complexity is 4.
The McCabe complexity of 'combinar' is 1.
The McCabe complexity of 'printcsv' is 1.
The McCabe complexity of 'printlines' is 1.
``

Con lo cual, podemos deducir, que la complejidad ciclomática total es de 7.

