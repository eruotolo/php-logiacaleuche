# ⚠️ ALERTA DE SEGURIDAD - ACCIONES URGENTES

## 🚨 Problema Detectado

El archivo `config.php` con credenciales sensibles está en el repositorio Git.

### Credenciales Expuestas:
- ❌ Usuario y contraseña de base de datos
- ❌ Contraseña SMTP de email
- ❌ Información de servidor

## ✅ Solución Implementada

### 1. Archivo de Ejemplo Creado
- ✅ `config.example.php` - Plantilla sin credenciales reales

### 2. .gitignore Actualizado
- ✅ `config.php` ahora está ignorado

### 3. Workflow Simplificado
- ✅ Solo hace checkout y deploy vía FTP
- ✅ `server-dir: /` (corregido para no duplicar public_html)

## 🔧 Acciones Requeridas URGENTEMENTE

### Paso 1: Cambiar Contraseñas
```bash
# CAMBIAR INMEDIATAMENTE:
# 1. Contraseña de base de datos en cPanel
# 2. Contraseña SMTP en tu proveedor de email
# 3. Contraseña de usuario FTP
```

### Paso 2: Limpiar Historial de Git (OPCIONAL pero recomendado)
```bash
# Eliminar config.php del historial completo
git filter-branch --force --index-filter \
  "git rm --cached --ignore-unmatch app/public/Admin/layouts/config.php" \
  --prune-empty --tag-name-filter cat -- --all

# Forzar push (⚠️ CUIDADO: reescribe el historial)
git push origin --force --all
```

### Paso 3: Mantener config.php Solo Localmente
```bash
# El archivo config.php con credenciales reales debe:
# 1. Existir SOLO en tu máquina local
# 2. Existir SOLO en el servidor de producción (vía FTP)
# 3. NUNCA estar en Git

# Para nuevos desarrolladores:
cp app/public/Admin/layouts/config.example.php app/public/Admin/layouts/config.php
# Luego editar config.php con credenciales reales
```

## 📝 Commit Pendiente

```bash
git add .gitignore app/public/Admin/layouts/config.example.php .github/workflows/deploy.yml
git commit -m "🔒 Security: Proteger credenciales y simplificar workflow

- Agregar config.example.php como plantilla
- Ignorar config.php en .gitignore
- Simplificar workflow: solo FTP deploy
- Corregir server-dir de /public_html/ a /
- Cambiar protocolo de ftps a ftp"
git push
```

## ⚠️ IMPORTANTE

Después del push:
1. **Cambiar TODAS las contraseñas expuestas**
2. Verificar que `config.php` no se suba al repositorio
3. El archivo `config.php` en producción se mantendrá vía FTP (no se borrará en deploys)

---
**Fecha:** 2025-12-18
**Prioridad:** 🔴 CRÍTICA

