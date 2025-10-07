# 📋 Referencia Rápida - Calculadora Financiera

## 🚀 Comandos Rápidos

### Configuración Inicial (Solo una vez)
```bash
# Clonar el repositorio
git clone https://github.com/TU-USUARIO/Calculadora.git
cd Calculadora

# Configurar upstream
git remote add upstream https://github.com/Sppritsat/Calculadora.git

# Configurar tu identidad
git config user.name "Tu Nombre"
git config user.email "tu@email.com"
```

### Ejecutar la Aplicación
```bash
# Opción 1: Servidor Python
python -m http.server 8000
# Abrir: http://localhost:8000/Calculadora_financiera/

# Opción 2: Abrir directamente
# Windows: start Calculadora_financiera/index.html
# Mac: open Calculadora_financiera/index.html
# Linux: xdg-open Calculadora_financiera/index.html
```

### Actualizar tu Fork
```bash
git checkout main
git fetch upstream
git merge upstream/main
git push origin main
```

### Crear Nueva Rama
```bash
git checkout -b feature/nombre-feature
# o
git checkout -b fix/nombre-bug
```

### Hacer Cambios
```bash
# Ver estado
git status

# Agregar archivos
git add .

# Commit
git commit -m "tipo: descripción breve"

# Push
git push origin nombre-de-tu-rama
```

## 📚 Documentación Esencial

| Archivo | Propósito | ¿Cuándo leer? |
|---------|-----------|---------------|
| [TEAM_GUIDE.md](TEAM_GUIDE.md) | Guía completa de equipo | ¡Primero! |
| [README.md](README.md) | Visión general | Para entender el proyecto |
| [SETUP.md](SETUP.md) | Configuración técnica | Al configurar entorno |
| [CONTRIBUTING.md](CONTRIBUTING.md) | Cómo contribuir | Antes de hacer cambios |
| [QUICKSTART.md](QUICKSTART.md) | Uso de la app | Para usar la calculadora |
| [ROADMAP.md](ROADMAP.md) | Plan del proyecto | Para elegir tareas |
| [CODE_OF_CONDUCT.md](CODE_OF_CONDUCT.md) | Reglas | Para convivencia |

## 🔤 Tipos de Commit

```bash
feat:     Nueva característica
fix:      Corrección de bug
docs:     Cambios en documentación
style:    Formato, espacios (no código)
refactor: Refactorización
test:     Agregar tests
chore:    Tareas de mantenimiento
```

**Ejemplos:**
```bash
git commit -m "feat: agregar modo oscuro"
git commit -m "fix: corregir cálculo de depreciación"
git commit -m "docs: actualizar guía de inicio"
```

## 📁 Estructura de Archivos

```
Calculadora_financiera/
├── index.html         # App principal
├── js/app.js         # Lógica JavaScript
└── style/style.css   # Estilos CSS
```

## 🐛 Solución Rápida de Problemas

### Error: Permission denied
```bash
# Configura SSH o usa HTTPS
git remote set-url origin https://github.com/TU-USUARIO/Calculadora.git
```

### Error: Merge conflict
```bash
# Actualiza tu rama
git pull origin main
# Resuelve conflictos en el editor
git add .
git commit -m "fix: resolver conflictos"
```

### Los cambios no se ven
```bash
# Recarga el navegador sin caché
# Ctrl+F5 (Windows/Linux)
# Cmd+Shift+R (Mac)
```

## ✅ Checklist de PR

- [ ] El código funciona localmente
- [ ] Probado en Chrome y Firefox
- [ ] Sin errores en consola
- [ ] Código formateado correctamente
- [ ] Commit messages descriptivos
- [ ] Documentación actualizada (si aplica)
- [ ] Sin archivos innecesarios

## 🎯 Primeros Pasos

1. ⭐ **Star** el repositorio
2. 🍴 **Fork** el repositorio
3. 📥 **Clone** tu fork
4. 🔧 **Setup** tu entorno
5. 📖 **Lee** TEAM_GUIDE.md
6. 🎨 **Elige** una tarea del ROADMAP
7. 🌿 **Crea** una rama
8. 💻 **Codea** tu solución
9. 🧪 **Prueba** tus cambios
10. 📤 **Push** y crea PR

## 🔗 Links Útiles

- **Repositorio**: https://github.com/Sppritsat/Calculadora
- **Issues**: https://github.com/Sppritsat/Calculadora/issues
- **PRs**: https://github.com/Sppritsat/Calculadora/pulls
- **Git Docs**: https://git-scm.com/book/es/
- **MDN Web Docs**: https://developer.mozilla.org/es/

## 📞 Ayuda

1. 📖 Lee la documentación
2. 🔍 Busca en Issues cerrados
3. ❓ Abre un nuevo Issue
4. 💬 Pregunta al equipo

## 🎉 ¡Tips de Éxito!

✅ Haz commits pequeños y frecuentes
✅ Escribe mensajes descriptivos
✅ Pide ayuda cuando la necesites
✅ Revisa PRs de otros
✅ Sé paciente y amable
✅ Celebra los logros del equipo

---

**💡 Tip**: Imprime esta página o guárdala como favorito para acceso rápido.
