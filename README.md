# 🎮 Number Guessing Game - PHP CLI 🎮

Este es un sencillo juego de adivinanza de números realizado en **PHP**, para ejecutarse en la **línea de comandos** (CLI).

El objetivo es adivinar un número secreto entre 1 y 100 en el menor número de intentos posible. El juego guarda tu récord por dificultad para que intentes superarlo en cada partida.

## 🔗 Enlace al reto original

👉 [Github Number Guessing Game en roadmap.sh](https://roadmap.sh/projects/number-guessing-game)

## 📋 Requisitos

- PHP 8.x o superior
- Acceso a una terminal (CMD, Terminal Linux/Mac, Git Bash en Windows...)

---

## 🚀 Cómo ejecutar el juego

1. Clona el repositorio:

```bash
git clone [https://github.com/tu_usuario/number-guessing-game.git](https://github.com/luishidalgoo27/RoadMap-Number-Guessing-Game)
Accede a la carpeta del proyecto:

cd RoadMap-Number-Guessing-Game
Ejecuta el juego con PHP: php Game.php

🎮 Cómo funciona el juego
Cuando inicies el juego, verás:

Welcome to the Number Guessing Game!
I'm thinking of a number between 1 and 100.
You have 5 chances to guess the correct number.
Luego te pedirá seleccionar el nivel de dificultad:

Please select the difficulty level:
1. Easy (10 chances)
2. Medium (5 chances)
3. Hard (3 chances)
Después, el juego mostrará el mejor jugador actual en ese nivel de dificultad (según los datos guardados) y comenzará la partida.

Durante la partida, deberás ingresar tus conjeturas. El juego te indicará si el número es mayor o menor que tu suposición.

Si deseas una pista, podrás pedir una una vez por partida.

Al adivinar el número o agotar tus intentos, el juego guardará tus resultados.

🕹️ Características adicionales
Puedes jugar múltiples rondas hasta que decidas salir.

Temporizador que muestra cuánto tiempo tardaste en adivinar el número.

Sistema de pistas para ayudarte si estás atascado.

Registro y visualización de los mejores resultados por dificultad (menor número de intentos y menor tiempo).

👤 Autor
Luis Hidalgo Santiago

📄 Licencia
Este proyecto es software libre y está disponible bajo la licencia MIT.
