# ⚡ Guía Rápida de Uso

Esta guía te ayudará a usar la Calculadora Financiera de Proyectos en pocos minutos.

## 🚀 Inicio

### 1. Abrir la Aplicación

```bash
# Opción A: Abrir directamente
# Simplemente abre el archivo index.html en tu navegador

# Opción B: Usar servidor local (recomendado)
python -m http.server 8000
# Luego abre: http://localhost:8000/Calculadora_financiera/
```

## 📋 Flujo de Trabajo Básico

### Paso 1: Mercado Meta 🎯

1. Ve a la pestaña "Mercado Meta"
2. Ingresa los datos de tu mercado:
   - **Mercado Total**: Número total de clientes potenciales
   - **Penetración Año 1**: % del mercado que captarás el primer año
   - **Crecimiento Anual**: % de crecimiento en ventas cada año
3. Click en "Calcular Mercado Meta"
4. Revisa los resultados proyectados a 5 años

**Ejemplo**:
```
Mercado Total: 100,000 personas
Penetración Año 1: 5% (5,000 clientes)
Crecimiento: 15% anual
```

### Paso 2: Proyección de Ventas 📈

1. Ve a "Proyección Ventas"
2. Define:
   - **Mercado Potencial Inicial**: del paso anterior
   - **Tasa de Crecimiento**: % anual
   - **Años**: horizonte de proyección (1-10)
3. Click en "Calcular Proyección"
4. Observa las unidades proyectadas por año

### Paso 3: Presupuesto de Ingresos 💰

1. Ve a "Ingresos"
2. Ingresa:
   - **Precio Unitario**: precio de venta por unidad
   - Puedes usar precio variable por año si lo prefieres
3. Click en "Calcular Presupuesto de Ventas"
4. Revisa:
   - Unidades vendidas por año
   - Precio por año
   - Ingresos totales por año

### Paso 4: Condiciones Comerciales 📋

1. Ve a "Condiciones"
2. Define:
   - **% Ventas al contado**: qué % cobras inmediatamente
   - **% Ventas a crédito**: qué % cobras después
   - **Plazo de crédito**: en cuántos meses cobras
   - **% Compras al contado**: qué % pagas de inmediato
   - **% Compras a crédito**: qué % pagas después
   - **Plazo de pago**: en cuántos meses pagas
3. Click en "Calcular Condiciones"

### Paso 5: Inversiones 🏭

1. Ve a "Inversiones"
2. Para cada activo:
   - Click en "Agregar Inversión"
   - Ingresa:
     - **Concepto**: Ej. "Maquinaria", "Mobiliario"
     - **Monto**: valor del activo
     - **Vida Útil**: años de depreciación
     - **Valor Residual**: valor al final de la vida útil
3. Click en "Calcular Inversiones"
4. Revisa la depreciación anual

**Ejemplo**:
```
Concepto: Computadoras
Monto: $50,000
Vida Útil: 5 años
Valor Residual: $5,000
Depreciación anual: $9,000
```

### Paso 6: Presupuesto de Producción 🏭

1. Ve a "Producción"
2. Ingresa:
   - **Inventario Inicial**: unidades que ya tienes
   - **Inventarios Finales**: unidades que quieres tener al final de cada año
3. Click en "Calcular Presupuesto"
4. Revisa las unidades a producir por año

**Fórmula**:
```
Producción = Ventas + Inv.Final - Inv.Inicial
```

### Paso 7: Materia Prima 📦

1. Ve a "Materia Prima"
2. Ingresa:
   - **Materiales por Unidad**: cantidad de material para 1 producto
   - **Costo por Unidad de Material**: precio del material
   - **Inventario Inicial MP**: material que ya tienes
   - **Inventarios Finales MP**: material que quieres tener
3. Click en "Calcular Materia Prima"

### Paso 8: Revisar Estados Financieros 📊

#### Estado de Resultados
1. Ve a "Estado Resultados"
2. Revisa:
   - Ingresos por ventas
   - Costo de ventas
   - Utilidad bruta
   - Gastos operativos
   - Utilidad neta

#### Balance General
1. Ve a "Balance"
2. Analiza:
   - Activos (corrientes y no corrientes)
   - Pasivos
   - Capital

#### Flujo de Efectivo
1. Ve a "Flujo Efectivo"
2. Observa:
   - Flujo de operación
   - Flujo de inversión
   - Flujo de financiamiento
   - Flujo neto

## 💾 Guardar y Exportar

### Exportar Datos

1. Click en el botón 📊 (esquina inferior derecha)
2. Se descarga un archivo JSON con todos tus datos
3. Nombre: `analisis_financiero_completo_YYYY-MM-DD.json`

### Imprimir Reporte

1. Click en el botón 🖨️ (esquina inferior derecha)
2. O presiona `Ctrl+P` (Windows/Linux) o `Cmd+P` (Mac)
3. Selecciona "Guardar como PDF" si quieres un PDF

## 🎓 Consejos y Trucos

### ✅ Buenas Prácticas

1. **Sigue el orden de las pestañas**: Están diseñadas para fluir lógicamente
2. **Guarda frecuentemente**: Exporta tu progreso regularmente
3. **Usa datos realistas**: Los resultados serán más útiles
4. **Revisa todos los cálculos**: Verifica que los números tengan sentido
5. **Prueba escenarios**: Cambia variables para ver diferentes resultados

### ⚠️ Errores Comunes

**Problema**: "Los números no se actualizan"
- **Solución**: Asegúrate de hacer click en "Calcular" después de cambiar valores

**Problema**: "Aparecen valores negativos inesperados"
- **Solución**: Verifica que el inventario final no sea mayor que producción + inventario inicial

**Problema**: "El flujo de efectivo no cuadra"
- **Solución**: Revisa las condiciones comerciales y plazos

**Problema**: "No veo la depreciación"
- **Solución**: Asegúrate de haber agregado inversiones y calculado

## 📱 Atajos de Teclado

- `Ctrl+P` / `Cmd+P`: Imprimir reporte
- `Ctrl+S` / `Cmd+S`: Exportar datos (si está configurado)
- `F12`: Abrir DevTools (para debugging)
- `Ctrl+Shift+I`: DevTools alternativo

## 🎯 Ejemplo Completo

### Proyecto: Panadería Artesanal

**1. Mercado Meta**
```
Mercado total: 50,000 familias en la zona
Penetración año 1: 3% (1,500 clientes)
Crecimiento anual: 20%
```

**2. Proyección de Ventas**
```
Año 1: 1,500 clientes × 12 meses = 18,000 unidades
Año 2: 18,000 × 1.20 = 21,600 unidades
Año 3: 21,600 × 1.20 = 25,920 unidades
```

**3. Ingresos**
```
Precio por pan: $25
Año 1: 18,000 × $25 = $450,000
Año 2: 21,600 × $25 = $540,000
```

**4. Inversiones**
```
Horno industrial: $150,000 (vida útil 10 años)
Mobiliario: $30,000 (vida útil 5 años)
Equipo menor: $20,000 (vida útil 3 años)
```

**5. Producción**
```
Ventas proyectadas + inventario seguridad 5%
Año 1: 18,000 + 900 = 18,900 unidades
```

**6. Materia Prima**
```
Harina por pan: 200g = $5
Otros insumos: $3
Costo MP por unidad: $8
```

## 📊 Interpretación de Resultados

### Indicadores Clave

**Margen Bruto**
```
Margen Bruto = (Ingresos - Costo Ventas) / Ingresos × 100
Bueno: > 40%
Regular: 20-40%
Bajo: < 20%
```

**ROI (Return on Investment)**
```
ROI = (Utilidad Neta / Inversión Total) × 100
Excelente: > 30%
Bueno: 15-30%
Aceptable: 5-15%
```

**Punto de Equilibrio**
```
PE = Costos Fijos / (Precio - Costo Variable Unitario)
Indica cuántas unidades debes vender para no perder ni ganar
```

## 🆘 Ayuda Adicional

### Documentación Completa

- [README.md](README.md): Visión general del proyecto
- [CONTRIBUTING.md](CONTRIBUTING.md): Cómo contribuir
- [SETUP.md](SETUP.md): Configuración detallada

### Soporte

1. **FAQ**: Revisa preguntas frecuentes en README
2. **Issues**: Busca problemas similares en GitHub Issues
3. **Nuevo Issue**: Crea uno si no encuentras solución

## 📚 Recursos de Aprendizaje

### Conceptos Financieros

- **Depreciación**: Pérdida de valor de activos con el tiempo
- **Flujo de Efectivo**: Movimiento de dinero entrante y saliente
- **Capital de Trabajo**: Recursos para operar día a día
- **TIR**: Tasa Interna de Retorno
- **VPN**: Valor Presente Neto

### Tutoriales Recomendados

- Finanzas para Emprendedores (YouTube)
- Coursera: Fundamentos de Finanzas
- Khan Academy: Contabilidad y Finanzas

---

¿Necesitas más ayuda? Abre un issue en GitHub con la etiqueta `question` 🙋‍♂️
