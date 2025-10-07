# 🤝 Guía de Contribución

¡Gracias por tu interés en contribuir a la Calculadora Financiera de Proyectos! Este documento proporciona las directrices para colaborar en el proyecto.

## 📋 Tabla de Contenidos

- [Código de Conducta](#código-de-conducta)
- [¿Cómo puedo contribuir?](#cómo-puedo-contribuir)
- [Proceso de Desarrollo](#proceso-de-desarrollo)
- [Guía de Estilo](#guía-de-estilo)
- [Estructura del Proyecto](#estructura-del-proyecto)

## 📜 Código de Conducta

### Nuestro Compromiso

Este es un proyecto académico y queremos que sea una experiencia positiva para todos. Esperamos que:

- Seas respetuoso y considerado con otros colaboradores
- Aceptes críticas constructivas
- Te enfoques en lo que es mejor para el proyecto
- Muestres empatía hacia otros miembros del equipo

### Comportamiento Esperado

✅ **SÍ**:
- Usa lenguaje acogedor e inclusivo
- Respeta diferentes puntos de vista
- Acepta críticas constructivas con gracia
- Ayuda a otros miembros del equipo

❌ **NO**:
- Uses lenguaje ofensivo o inapropiado
- Hagas ataques personales
- Publiques información privada de otros sin permiso
- Realices comportamiento que pueda considerarse acoso

## 🎯 ¿Cómo puedo contribuir?

### Reportar Bugs

Si encuentras un error:

1. **Verifica** que el bug no haya sido reportado anteriormente
2. **Abre un nuevo issue** con:
   - Título descriptivo
   - Pasos para reproducir el problema
   - Comportamiento esperado vs comportamiento actual
   - Capturas de pantalla (si aplica)
   - Navegador y versión

**Ejemplo**:
```
Título: Error al calcular depreciación en año 3

Descripción:
Cuando ingreso valores en la pestaña de Inversiones y llego al año 3,
la depreciación no se calcula correctamente.

Pasos para reproducir:
1. Ir a la pestaña "Inversiones"
2. Agregar un activo con valor de $100,000
3. Calcular depreciación
4. Observar que en año 3 el valor es incorrecto

Esperado: Depreciación de $20,000 por año
Actual: Muestra $0 en año 3

Navegador: Chrome 120
```

### Sugerir Mejoras

¿Tienes una idea para mejorar el proyecto?

1. **Abre un issue** con la etiqueta "enhancement"
2. **Describe** claramente la mejora propuesta
3. **Explica** por qué sería útil
4. **Proporciona** ejemplos si es posible

### Tu Primera Contribución

¿Es tu primera vez contribuyendo? ¡Genial! Aquí hay algunas sugerencias:

**Issues para principiantes**:
- Busca issues etiquetados como `good first issue` o `beginner-friendly`
- Mejoras en documentación
- Corrección de errores tipográficos
- Mejoras en comentarios del código

## 🔄 Proceso de Desarrollo

### 1. Fork y Clone

```bash
# Haz fork del repositorio en GitHub

# Clona tu fork
git clone https://github.com/TU-USUARIO/Calculadora.git

# Navega al directorio
cd Calculadora

# Agrega el repositorio original como remote
git remote add upstream https://github.com/Sppritsat/Calculadora.git
```

### 2. Crea una Rama

```bash
# Actualiza tu main
git checkout main
git pull upstream main

# Crea una nueva rama para tu característica
git checkout -b feature/mi-nueva-caracteristica

# O para un bugfix
git checkout -b fix/descripcion-del-bug
```

**Convención de nombres de ramas**:
- `feature/nombre-caracteristica` - Para nuevas características
- `fix/descripcion-bug` - Para correcciones de bugs
- `docs/descripcion` - Para cambios en documentación
- `refactor/descripcion` - Para refactorización de código

### 3. Realiza tus Cambios

#### Mejores Prácticas

- **Haz commits pequeños y frecuentes**
- **Escribe mensajes de commit claros**
- **Prueba tus cambios** antes de hacer commit

#### Formato de Commits

```bash
# Formato general
<tipo>: <descripción breve>

[Descripción detallada opcional]

# Ejemplos
feat: agregar validación de campos en pestaña de ingresos
fix: corregir cálculo de depreciación en año 3
docs: actualizar README con instrucciones de instalación
style: mejorar formato de tablas en estado de resultados
refactor: reorganizar funciones de cálculo en app.js
```

**Tipos de commit**:
- `feat`: Nueva característica
- `fix`: Corrección de bug
- `docs`: Cambios en documentación
- `style`: Cambios de formato (no afectan el código)
- `refactor`: Refactorización de código
- `test`: Agregar o modificar tests
- `chore`: Tareas de mantenimiento

### 4. Prueba tus Cambios

Antes de hacer push:

```bash
# Abre la aplicación en tu navegador
# Prueba la funcionalidad que modificaste
# Verifica que no hayas roto otras funcionalidades
# Prueba en diferentes navegadores si es posible
```

**Checklist de Pruebas**:
- [ ] La aplicación carga sin errores en consola
- [ ] La funcionalidad modificada funciona correctamente
- [ ] No se rompieron funcionalidades existentes
- [ ] El código es responsive (mobile/tablet/desktop)
- [ ] Los cálculos son precisos

### 5. Push y Pull Request

```bash
# Haz push de tus cambios
git push origin feature/mi-nueva-caracteristica
```

Luego en GitHub:

1. **Abre un Pull Request**
2. **Usa una descripción clara** del título
3. **Describe** los cambios realizados
4. **Referencia** issues relacionados (si aplica)

**Template de Pull Request**:
```markdown
## Descripción
Breve descripción de los cambios realizados.

## Tipo de cambio
- [ ] Bug fix
- [ ] Nueva característica
- [ ] Mejora de código
- [ ] Documentación

## ¿Cómo se ha probado?
Describe las pruebas que realizaste.

## Checklist
- [ ] Mi código sigue el estilo del proyecto
- [ ] He probado mis cambios
- [ ] He actualizado la documentación (si aplica)
- [ ] No he roto funcionalidades existentes
```

### 6. Revisión de Código

- Espera feedback de otros colaboradores
- Realiza cambios solicitados si es necesario
- Una vez aprobado, tus cambios serán fusionados

## 🎨 Guía de Estilo

### HTML

```html
<!-- ✅ CORRECTO -->
<div class="container">
    <h2 class="text-2xl font-bold">Título</h2>
    <p class="text-gray-600">Descripción</p>
</div>

<!-- ❌ INCORRECTO -->
<div class=container>
<h2 class=text-2xl>Título</h2><p>Descripción</p></div>
```

**Reglas**:
- Usa indentación de 4 espacios
- Cierra todas las etiquetas
- Usa comillas dobles para atributos
- Mantén la estructura semántica

### CSS

```css
/* ✅ CORRECTO */
.nav-button {
    transition: all 0.2s ease-in-out;
    background-color: #f3f4f6;
    color: #4b5563;
}

/* ❌ INCORRECTO */
.nav-button{transition:all 0.2s;background-color:#f3f4f6;color:#4b5563;}
```

**Reglas**:
- Una propiedad por línea
- Usa espacios después de `:` y antes de `{`
- Agrupa propiedades relacionadas
- Usa nombres de clase descriptivos

### JavaScript

```javascript
// ✅ CORRECTO
function calcularDepreciacion(valorInicial, vidaUtil) {
    const depreciacionAnual = valorInicial / vidaUtil;
    return depreciacionAnual;
}

// ❌ INCORRECTO
function calc(v,vu){const d=v/vu;return d}
```

**Reglas**:
- Usa `const` y `let`, evita `var`
- Nombres de funciones y variables en camelCase
- Funciones descriptivas y específicas
- Agrega comentarios para lógica compleja
- Maneja errores apropiadamente

**Comentarios**:
```javascript
// ✅ CORRECTO - Comentario útil
// Calcula la depreciación lineal para 5 años
function calcularDepreciacion(valor) {
    return valor / 5;
}

// ❌ INCORRECTO - Comentario obvio
// Esta función retorna el resultado
function calcularDepreciacion(valor) {
    return valor / 5;
}
```

### Nombres de Variables

```javascript
// ✅ CORRECTO
const precioUnitario = 100;
const unidadesVendidas = 50;
const ingresoTotal = precioUnitario * unidadesVendidas;

// ❌ INCORRECTO
const p = 100;
const u = 50;
const t = p * u;
```

## 📁 Estructura del Proyecto

### Archivos Principales

```
Calculadora_financiera/
├── index.html              # Punto de entrada principal
├── js/
│   └── app.js             # Lógica de negocio
├── style/
│   └── style.css          # Estilos personalizados
└── Ya funcional/          # Versiones alternativas
```

### Convenciones de Código

#### Variables Globales

```javascript
// Definidas al inicio de app.js
const globalData = {
    unidadesVenta: [],
    preciosVenta: [],
    // ...
};
```

#### Funciones de Cálculo

```javascript
// Patrón para funciones de cálculo
function calcularNombreCalculo() {
    // 1. Obtener datos de entrada
    const input = document.getElementById('input-id').value;
    
    // 2. Validar datos
    if (!input || input <= 0) {
        alert('Por favor ingrese un valor válido');
        return;
    }
    
    // 3. Realizar cálculos
    const resultado = /* cálculo */;
    
    // 4. Actualizar globalData
    globalData.campo = resultado;
    
    // 5. Mostrar resultados
    document.getElementById('resultado-id').innerHTML = resultado;
    
    // 6. Llamar funciones dependientes (si aplica)
    calcularSiguientePaso();
}
```

## 🔍 Recursos Útiles

### Aprendizaje

- **HTML/CSS**: [MDN Web Docs](https://developer.mozilla.org/es/)
- **JavaScript**: [JavaScript.info](https://es.javascript.info/)
- **Tailwind CSS**: [Documentación oficial](https://tailwindcss.com/docs)
- **Git**: [Git Book en español](https://git-scm.com/book/es/)

### Herramientas Recomendadas

- **Editor**: Visual Studio Code, Sublime Text, o similar
- **Navegador**: Chrome/Firefox con DevTools
- **Git GUI**: GitHub Desktop, GitKraken (opcional)

## ❓ Preguntas Frecuentes

### ¿Necesito experiencia previa?

No necesariamente. Si conoces HTML, CSS y JavaScript básico, puedes contribuir. ¡Todos empezamos siendo principiantes!

### ¿Cuánto tiempo toma que mi PR sea revisado?

Depende de la disponibilidad del equipo, pero generalmente en 1-3 días.

### ¿Puedo trabajar en múltiples issues a la vez?

Sí, pero recomendamos enfocarte en uno o dos para mantener la calidad.

### ¿Qué hago si mi PR tiene conflictos?

```bash
# Actualiza tu rama con los últimos cambios
git checkout main
git pull upstream main
git checkout tu-rama
git merge main
# Resuelve conflictos
git commit
git push
```

## 📞 Contacto

Si tienes preguntas que no están cubiertas aquí:

- Abre un issue con la etiqueta `question`
- Contacta a los mantenedores del proyecto

## 🎉 ¡Gracias!

Tu contribución hace que este proyecto sea mejor. ¡Gracias por tu tiempo y esfuerzo!

---

**Nota**: Esta guía es un documento vivo. Si tienes sugerencias para mejorarla, ¡no dudes en proponer cambios!
