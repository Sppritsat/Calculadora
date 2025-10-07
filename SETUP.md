# 📚 Guía de Configuración para Colaboradores

Esta guía te ayudará a configurar tu entorno de desarrollo para trabajar en el proyecto de Calculadora Financiera.

## 📋 Requisitos Previos

Antes de comenzar, asegúrate de tener instalado:

- **Git**: [Descargar Git](https://git-scm.com/downloads)
- **Navegador web moderno**: Chrome, Firefox, Edge, o Safari
- **Editor de código** (recomendado): 
  - [Visual Studio Code](https://code.visualstudio.com/)
  - [Sublime Text](https://www.sublimetext.com/)
  - [Atom](https://atom.io/)

### Verificar Instalación de Git

```bash
git --version
# Deberías ver algo como: git version 2.x.x
```

## 🚀 Configuración Inicial

### 1. Configurar Git (Primera vez)

Si es tu primera vez usando Git, configura tu identidad:

```bash
git config --global user.name "Tu Nombre"
git config --global user.email "tu.email@ejemplo.com"
```

### 2. Configurar tu cuenta de GitHub

1. Crea una cuenta en [GitHub](https://github.com) si no tienes una
2. Configura una clave SSH (recomendado) o usa HTTPS

#### Opción A: SSH (Recomendado)

```bash
# Generar clave SSH
ssh-keygen -t ed25519 -C "tu.email@ejemplo.com"

# Copiar la clave pública (Linux/Mac)
cat ~/.ssh/id_ed25519.pub

# Copiar la clave pública (Windows PowerShell)
type $env:USERPROFILE\.ssh\id_ed25519.pub

# Agregar la clave a GitHub:
# 1. Ve a GitHub → Settings → SSH and GPG keys
# 2. Click "New SSH key"
# 3. Pega la clave pública
# 4. Click "Add SSH key"
```

#### Opción B: HTTPS (Más simple)

No requiere configuración adicional, pero te pedirá credenciales cada vez.

## 📥 Clonar el Repositorio

### Paso 1: Fork del Repositorio

1. Ve al repositorio: https://github.com/Sppritsat/Calculadora
2. Click en el botón "Fork" en la esquina superior derecha
3. Esto creará una copia en tu cuenta de GitHub

### Paso 2: Clonar tu Fork

```bash
# Con SSH (recomendado)
git clone git@github.com:TU-USUARIO/Calculadora.git

# Con HTTPS
git clone https://github.com/TU-USUARIO/Calculadora.git

# Entrar al directorio
cd Calculadora
```

### Paso 3: Agregar Remote del Repositorio Original

```bash
# Agregar el repositorio original como 'upstream'
git remote add upstream https://github.com/Sppritsat/Calculadora.git

# Verificar remotes
git remote -v
# Deberías ver:
# origin    https://github.com/TU-USUARIO/Calculadora.git (fetch)
# origin    https://github.com/TU-USUARIO/Calculadora.git (push)
# upstream  https://github.com/Sppritsat/Calculadora.git (fetch)
# upstream  https://github.com/Sppritsat/Calculadora.git (push)
```

## 🔧 Configuración del Entorno de Desarrollo

### Opción 1: Abrir Directamente (Más Simple)

```bash
# En Windows
start Calculadora_financiera/index.html

# En macOS
open Calculadora_financiera/index.html

# En Linux
xdg-open Calculadora_financiera/index.html
```

### Opción 2: Servidor Local (Recomendado)

#### Con Python 3

```bash
# Iniciar servidor
python -m http.server 8000

# Abrir en navegador: http://localhost:8000/Calculadora_financiera/
```

#### Con Python 2

```bash
python -m SimpleHTTPServer 8000
```

#### Con Node.js (http-server)

```bash
# Instalar http-server globalmente
npm install -g http-server

# Iniciar servidor
http-server -p 8000

# Abrir en navegador: http://localhost:8000/Calculadora_financiera/
```

#### Con PHP

```bash
php -S localhost:8000
```

#### Con Live Server (VS Code)

1. Instala la extensión "Live Server" en VS Code
2. Click derecho en `index.html`
3. Selecciona "Open with Live Server"

## 🛠️ Herramientas Recomendadas

### Visual Studio Code

Extensiones recomendadas:

```json
{
  "recommendations": [
    "esbenp.prettier-vscode",           // Formateo de código
    "dbaeumer.vscode-eslint",           // Linting JavaScript
    "ritwickdey.LiveServer",            // Servidor de desarrollo
    "formulahendry.auto-rename-tag",    // Renombrar etiquetas HTML
    "pranaygp.vscode-css-peek",         // Ver definiciones CSS
    "bradlc.vscode-tailwindcss"         // Soporte Tailwind CSS
  ]
}
```

### Configuración de VS Code (opcional)

Crea `.vscode/settings.json`:

```json
{
  "editor.formatOnSave": true,
  "editor.tabSize": 4,
  "editor.insertSpaces": true,
  "files.encoding": "utf8",
  "html.format.indentInnerHtml": true,
  "javascript.format.insertSpaceAfterFunctionKeywordForAnonymousFunctions": true
}
```

## 🎯 Flujo de Trabajo Básico

### 1. Mantener tu Fork Actualizado

```bash
# Cambiar a la rama main
git checkout main

# Obtener cambios del repositorio original
git fetch upstream

# Fusionar cambios
git merge upstream/main

# Actualizar tu fork en GitHub
git push origin main
```

### 2. Crear una Nueva Rama para Trabajar

```bash
# Crear y cambiar a nueva rama
git checkout -b feature/mi-funcionalidad

# O para un bugfix
git checkout -b fix/descripcion-bug
```

### 3. Hacer Cambios y Commit

```bash
# Ver estado de cambios
git status

# Agregar archivos modificados
git add .

# O agregar archivos específicos
git add Calculadora_financiera/js/app.js

# Hacer commit
git commit -m "feat: agregar nueva funcionalidad X"
```

### 4. Subir Cambios

```bash
# Push a tu fork
git push origin feature/mi-funcionalidad
```

### 5. Crear Pull Request

1. Ve a tu fork en GitHub
2. Click en "Compare & pull request"
3. Completa la descripción del PR
4. Click en "Create pull request"

## 🧪 Probar tus Cambios

### Checklist antes de hacer Push

- [ ] Abrir `index.html` en el navegador
- [ ] Verificar que no hay errores en la consola del navegador (F12)
- [ ] Probar la funcionalidad modificada
- [ ] Verificar que otras funcionalidades no se rompieron
- [ ] Probar en al menos 2 navegadores diferentes
- [ ] Verificar responsividad (mobile, tablet, desktop)

### Usar DevTools del Navegador

```
F12 - Abrir DevTools
Ctrl + Shift + I - Abrir DevTools (alternativo)
Ctrl + Shift + M - Toggle vista móvil
Ctrl + Shift + C - Selector de elementos
```

## 📱 Probar en Diferentes Dispositivos

### Usando DevTools

1. Abre DevTools (F12)
2. Click en el icono de dispositivo móvil (Ctrl+Shift+M)
3. Selecciona diferentes dispositivos del dropdown
4. Prueba la funcionalidad

### Tamaños de pantalla a probar

- **Móvil**: 375x667 (iPhone SE)
- **Tablet**: 768x1024 (iPad)
- **Desktop**: 1920x1080

## 🐛 Solución de Problemas Comunes

### Error: "Permission denied (publickey)"

**Problema**: No configuraste SSH correctamente.

**Solución**:
```bash
# Verifica que tu clave SSH esté agregada
ssh -T git@github.com

# Si falla, agrega tu clave SSH a GitHub (ver sección SSH)
```

### Error: "fatal: not a git repository"

**Problema**: No estás en el directorio del proyecto.

**Solución**:
```bash
cd Calculadora
```

### Error: CORS al abrir index.html

**Problema**: El navegador bloquea recursos por CORS.

**Solución**: Usa un servidor local (ver sección Servidor Local)

### Cambios no se reflejan en el navegador

**Problema**: Cache del navegador.

**Solución**:
```
Ctrl + F5 - Recarga forzada (Windows/Linux)
Cmd + Shift + R - Recarga forzada (Mac)
```

### Git pide credenciales constantemente

**Problema**: Usando HTTPS sin cache de credenciales.

**Solución**:
```bash
# Configurar cache de credenciales (15 min)
git config --global credential.helper cache

# O permanentemente en Windows
git config --global credential.helper wincred

# O cambiar a SSH
```

## 📚 Recursos de Aprendizaje

### Git y GitHub

- [Pro Git Book (Español)](https://git-scm.com/book/es/)
- [GitHub Guides](https://guides.github.com/)
- [Curso interactivo de Git](https://learngitbranching.js.org/?locale=es_ES)

### HTML/CSS/JavaScript

- [MDN Web Docs](https://developer.mozilla.org/es/)
- [W3Schools](https://www.w3schools.com/)
- [JavaScript.info](https://es.javascript.info/)

### Tailwind CSS

- [Documentación oficial](https://tailwindcss.com/docs)
- [Tailwind Cheat Sheet](https://nerdcave.com/tailwind-cheat-sheet)

## 🤝 Conseguir Ayuda

Si tienes problemas:

1. **Busca en Issues**: Puede que alguien ya lo haya resuelto
2. **Pregunta al equipo**: Abre un issue con la etiqueta `question`
3. **Documentación**: Revisa esta guía y CONTRIBUTING.md

## ✅ Verificación Final

Antes de empezar a contribuir, verifica:

- [ ] Git instalado y configurado
- [ ] Repositorio clonado correctamente
- [ ] Remote 'upstream' configurado
- [ ] index.html se abre correctamente
- [ ] DevTools del navegador funcionan
- [ ] Puedes crear una rama y hacer commit

## 🎉 ¡Listo para Contribuir!

Ahora estás listo para empezar a trabajar en el proyecto. Lee [CONTRIBUTING.md](CONTRIBUTING.md) para conocer el proceso de contribución.

---

**¿Encontraste un error en esta guía?** ¡Abre un Pull Request para corregirlo!
