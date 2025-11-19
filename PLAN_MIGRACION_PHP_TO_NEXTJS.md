# Plan de Migración: PHP Logia Caleuche → Next.js 15 + Prisma ORM + PostgreSQL

**Proyecto:** Migración de Intranet Logia Caleuche
**Desde:** PHP 7.4 + MySQL + TailwindCSS (Monolítico)
**Hacia:** Next.js 15.3.3 + React 19 + TypeScript 5.7 + Prisma 6.2 + PostgreSQL
**Fecha:** Octubre 2025
**Versión del Plan:** 1.0

---

## 📋 Tabla de Contenidos

1. [Análisis de Sistemas](#1-análisis-de-sistemas)
2. [Estrategia de Migración](#2-estrategia-de-migración)
3. [Mapeo de Arquitecturas](#3-mapeo-de-arquitecturas)
4. [Migración de Base de Datos](#4-migración-de-base-de-datos)
5. [Plan de Migración por Fases](#5-plan-de-migración-por-fases)
6. [Consideraciones Técnicas](#6-consideraciones-técnicas)
7. [Cronograma Estimado](#7-cronograma-estimado)
8. [Riesgos y Mitigaciones](#8-riesgos-y-mitigaciones)

---

## 1. Análisis de Sistemas

### 1.1 Sistema Actual (PHP)

#### Stack Tecnológico
- **Backend:** PHP 7.4 monolítico sin framework
- **Base de Datos:** MySQL 5.7
- **Frontend:** HTML + TailwindCSS + jQuery
- **Autenticación:** Session-based con `$_SESSION`
- **Arquitectura:** Procedural con includes
- **Archivos:** 268 PHP files (~9,132 líneas)

#### Módulos Principales
1. **Autenticación:** RUT como username, password hasheado
2. **Usuarios:** Sistema de grados (1=Aprendiz, 2=Compañero, 3=Maestro)
3. **Documentos por Grado:**
   - Actas de reuniones
   - Biblioteca (libros)
   - Boletines
   - Trazados (rituales masónicos)
4. **Feed/Blog Social:** Posts con comentarios
5. **Eventos:** Calendario con visibilidad por grado
6. **Mensajería Interna:** Sistema tipo email
7. **Tesorería:** Registro de entradas y salidas de dinero

#### Control de Acceso
```php
// Control por grado en queries
if ($_SESSION['grado'] == 1) {
    $query = "SELECT * FROM evento WHERE cat_Evento = 1";
} elseif ($_SESSION['grado'] == 2) {
    $query = "SELECT * FROM evento WHERE cat_Evento IN (1,2)";
} else {
    $query = "SELECT * FROM evento";
}
```

### 1.2 Sistema Objetivo (Next.js)

#### Stack Tecnológico Existente
- **Framework:** Next.js 15.3.3 (App Router)
- **UI:** React 19 + TypeScript 5.7
- **Base de Datos:** PostgreSQL + Prisma ORM 6.2
- **Autenticación:** NextAuth.js 4.24 (ya implementado)
- **Estilos:** Tailwind CSS 4 + shadcn/ui
- **Formularios:** React Hook Form + Zod
- **Tablas:** TanStack Table v8 (sistema completo)
- **Estado:** Zustand
- **Analytics:** Google Analytics Data API

#### Sistema de Auth Existente ✅
```typescript
// NextAuth con Credentials Provider
- Login: email + password
- Roles: User → UserRole → Role → PermissionRole → Permission
- Páginas: Page → PageRole → Role
- Auditoría: AuditLog completa
- Companies: Validación de empresa
- Session: JWT (30 días)
```

#### Infraestructura Disponible ✅
```
✅ Sistema de usuarios completo
✅ Sistema de roles y permisos granular
✅ CRUD de empresas (Companies)
✅ Sistema de tickets de soporte
✅ Sistema de auditoría
✅ TanTable reutilizable (columnas + filtros + paginación + export)
✅ Sistema de formularios con validación Zod
✅ Rich Text Editor (TipTap)
✅ Google Maps integration
✅ Sistema de guardas (ProtectedRoute, PagePermissionGuard)
```

---

## 2. Estrategia de Migración

### 2.1 Principios Clave

1. **APROVECHAR infraestructura existente** - No reinventar la rueda
2. **ADAPTAR el sistema de auth** - Agregar soporte RUT sin romper lo existente
3. **MAPEAR grados → roles** - Usar sistema de roles/permisos de NextJS
4. **MIGRAR incremental** - Feature por feature, no big bang
5. **CONVIVENCIA temporal** - Ambos sistemas pueden coexistir durante migración

### 2.2 Ventajas del Sistema Nuevo

| Aspecto | PHP Actual | Next.js Objetivo |
|---------|-----------|------------------|
| **Performance** | Server-side render por request | SSR + ISR + Client optimizado |
| **Type Safety** | Sin tipos | TypeScript estricto |
| **Seguridad** | Session hijacking risk | JWT + CSRF protection + Zod validation |
| **Escalabilidad** | Monolito difícil escalar | Serverless-ready, edge functions |
| **Developer Experience** | Procedural, sin autocomplete | TypeScript + IntelliSense + Hot reload |
| **UI/UX** | jQuery + Bootstrap | React 19 + shadcn/ui moderno |
| **Testing** | No implementado | Jest + React Testing Library ready |
| **Deploy** | Manual FTP | CI/CD con Vercel/Docker |

---

## 3. Mapeo de Arquitecturas

### 3.1 Autenticación

#### Sistema PHP (Actual)
```php
// Login con RUT (sin puntos ni guiones)
$username = "12345678-9" // Se guarda sin formato
$password = password_hash($input, PASSWORD_BCRYPT);

$_SESSION['id'] = $row['id'];
$_SESSION['username'] = $row['username']; // RUT
$_SESSION['grado'] = $row['grado']; // 1, 2, 3
$_SESSION['oficialidad'] = $row['oficialidad'];
```

#### Sistema NextJS (Adaptado)
```typescript
// ADAPTAR User model existente
model User {
  id        String   @id @default(uuid())
  email     String   @unique
  rut       String?  @unique // ← NUEVO: RUT chileno (12345678-9)
  name      String
  lastName  String
  password  String   // bcrypt compatible
  // ... campos existentes
  roles     UserRole[]
}

// Login adaptado (soportar email O rut)
async authorize(credentials) {
  const userFound = await prisma.user.findFirst({
    where: {
      OR: [
        { email: credentials.identifier },
        { rut: credentials.identifier }
      ]
    },
    // ... resto del query existente
  });
}
```

### 3.2 Sistema de Grados → Roles

#### Mapeo de Conceptos

| PHP (Grados) | NextJS (Roles) | Descripción |
|--------------|----------------|-------------|
| `grado = 1` | Role: "Aprendiz" | Nivel básico de acceso |
| `grado = 2` | Role: "Compañero" | Acceso a contenido Aprendiz + Compañero |
| `grado = 3` | Role: "Maestro" | Acceso total (incluye Trazados) |
| `oficialidad` | Roles adicionales | "Venerable Maestro", "Tesorero", etc. |

#### Roles a Crear en Prisma
```typescript
// Roles base de grado
const baseRoles = [
  { name: "Aprendiz", description: "Primer grado masónico" },
  { name: "Compañero", description: "Segundo grado masónico" },
  { name: "Maestro", description: "Tercer grado masónico" },
];

// Roles de oficialidad (opcionales, adicionales al grado)
const officialityRoles = [
  { name: "Venerable Maestro", description: "Presidente de la logia" },
  { name: "Tesorero", description: "Administrador de finanzas" },
  { name: "Secretario", description: "Gestor de documentos" },
  { name: "Orador", description: "Vocero oficial" },
  // ... más según necesidad
];
```

#### Permisos por Módulo
```typescript
// Sistema de permisos granular
const permissions = [
  // Documentos
  "actas:read:grado1",
  "actas:read:grado2",
  "actas:read:grado3",
  "actas:create", // Solo secretario

  // Biblioteca
  "biblioteca:read:grado1",
  "biblioteca:read:grado2",
  "biblioteca:read:grado3",

  // Trazados (solo Maestros)
  "trazados:read",

  // Tesorería
  "tesoreria:read",
  "tesoreria:create", // Solo tesorero
  "tesoreria:edit",   // Solo tesorero

  // Feed
  "feed:read",
  "feed:create",
  "feed:comment",

  // Eventos
  "eventos:read",
  "eventos:create", // Solo oficiales

  // Mensajería
  "mensajes:send",
  "mensajes:read",
];
```

### 3.3 Control de Acceso

#### Patrón PHP (Query-based)
```php
// Control en cada query
if ($_SESSION['grado'] == 1) {
    $query = "SELECT * FROM acta WHERE grado_Acta = 1";
} elseif ($_SESSION['grado'] == 2) {
    $query = "SELECT * FROM acta WHERE grado_Acta IN (1,2)";
} else {
    $query = "SELECT * FROM acta";
}
```

#### Patrón NextJS (Role-based + Prisma)
```typescript
// Server Action con verificación
'use server';

import { verifySession } from '@/shared/lib/auth/verifySession';
import { hasPermission } from '@/shared/lib/auth/permissions';

export async function getActas() {
  // 1. Verificar autenticación
  const session = await verifySession();
  if (!session) unauthorized();

  // 2. Determinar grado del usuario
  const userRoles = session.user.roles;
  const grado = getUserGrado(userRoles); // helper function

  // 3. Filtrar con Prisma según grado
  const whereClause = grado === 1
    ? { gradoActa: 1 }
    : grado === 2
    ? { gradoActa: { in: [1, 2] } }
    : {}; // Maestro ve todo

  return await prisma.acta.findMany({
    where: whereClause,
    orderBy: { fechaActa: 'desc' }
  });
}

// Helper para determinar grado
function getUserGrado(roles: string[]): number {
  if (roles.includes('Maestro')) return 3;
  if (roles.includes('Compañero')) return 2;
  if (roles.includes('Aprendiz')) return 1;
  return 0; // Sin grado
}
```

### 3.4 Mapeo de Módulos

#### Tabla de Conversión

| Módulo PHP | Feature NextJS | Prisma Models | Componentes |
|------------|----------------|---------------|-------------|
| `apps-news-*.php` | `features/content/feed/` | `Feed`, `FeedCategory`, `FeedComment` | `FeedTable`, `NewFeedModal` |
| `apps-aprendiz-actas.php` | `features/documents/actas/` | `Acta` | `ActasTable`, `ActaModal` |
| `apps-companero-biblioteca.php` | `features/documents/biblioteca/` | `Biblioteca` | `BibliotecaTable` |
| `apps-maestro-trazados.php` | `features/documents/trazados/` | `Trazado` | `TrazadosTable` |
| `apps-evento-*.php` | `features/events/` | `Evento` | `EventosTable`, `Calendar` |
| `apps-email-*.php` | `features/messaging/` | `Message` | `InboxTable`, `ComposeModal` |
| `apps-tesoreria-*.php` | `features/treasury/` | `EntradaDinero`, `SalidaDinero` | `TreasuryTable`, `InformeModal` |

---

## 4. Migración de Base de Datos

### 4.1 Schema Prisma - Nuevos Modelos

**Nota:** Los modelos `Country`, `City` y `Airports` fueron removidos del schema ya que no son necesarios para este proyecto. Eran parte del template base.

```prisma
// ============================================
// MÓDULO: DOCUMENTOS POR GRADO
// ============================================

// Actas de Reuniones
model Acta {
  id          String   @id @default(uuid())
  nameActa    String
  fileName    String   // PDF en blob storage
  gradoActa   Int      // 1, 2, 3
  fechaActa   DateTime
  createdAt   DateTime @default(now())
  updatedAt   DateTime @updatedAt
  createdById String
  createdBy   User     @relation(fields: [createdById], references: [id])

  @@index([gradoActa])
  @@index([fechaActa])
}

// Biblioteca
model Biblioteca {
  id          String   @id @default(uuid())
  nombreLibro String
  autorLibro  String
  fileName    String   // PDF en blob storage
  gradoLibro  Int      // 1, 2, 3
  createdAt   DateTime @default(now())
  updatedAt   DateTime @updatedAt

  @@index([gradoLibro])
  @@index([nombreLibro])
}

// Boletines
model Boletin {
  id             String   @id @default(uuid())
  tituloBoletin  String
  fileName       String   // PDF en blob storage
  gradoBoletin   Int      // 1, 2, 3
  createdAt      DateTime @default(now())
  updatedAt      DateTime @updatedAt

  @@index([gradoBoletin])
}

// Trazados (solo Maestros)
model Trazado {
  id             String   @id @default(uuid())
  nombreTrazado  String
  fileName       String   // PDF en blob storage
  fechaTrazado   DateTime?
  createdAt      DateTime @default(now())
  updatedAt      DateTime @updatedAt

  @@index([fechaTrazado])
}

// ============================================
// MÓDULO: FEED/BLOG SOCIAL
// ============================================

model Feed {
  id              String        @id @default(uuid())
  title           String
  content         String        @db.Text
  image           String?
  categoryId      String
  category        FeedCategory  @relation(fields: [categoryId], references: [id])
  authorId        String
  author          User          @relation(fields: [authorId], references: [id])
  comments        FeedComment[]
  createdAt       DateTime      @default(now())
  updatedAt       DateTime      @updatedAt

  @@index([categoryId])
  @@index([authorId])
  @@index([createdAt])
}

model FeedCategory {
  id        String   @id @default(uuid())
  name      String   @unique
  color     String?  // Para UI
  feeds     Feed[]
  createdAt DateTime @default(now())
}

model FeedComment {
  id        String   @id @default(uuid())
  content   String   @db.Text
  feedId    String
  feed      Feed     @relation(fields: [feedId], references: [id], onDelete: Cascade)
  authorId  String
  author    User     @relation(fields: [authorId], references: [id])
  createdAt DateTime @default(now())
  updatedAt DateTime @updatedAt

  @@index([feedId])
  @@index([authorId])
}

// ============================================
// MÓDULO: EVENTOS
// ============================================

enum EventoGrado {
  APRENDIZ
  COMPANERO
  MAESTRO
  TODOS
}

model Evento {
  id              String       @id @default(uuid())
  nombreEvento    String
  descripcion     String?      @db.Text
  fechaEvento     DateTime
  horaEvento      String       // "19:30"
  tipoTrabajo     String?      // "Tenida", "Ceremonia", etc.
  categoriaEvento EventoGrado  @default(TODOS)
  createdAt       DateTime     @default(now())
  updatedAt       DateTime     @updatedAt

  @@index([fechaEvento])
  @@index([categoriaEvento])
}

// ============================================
// MÓDULO: MENSAJERÍA INTERNA
// ============================================

enum MessageStatus {
  UNREAD
  READ
  ARCHIVED
  DELETED
}

model Message {
  id          String        @id @default(uuid())
  subject     String
  body        String        @db.Text
  senderId    String
  sender      User          @relation("SentMessages", fields: [senderId], references: [id])
  recipientId String
  recipient   User          @relation("ReceivedMessages", fields: [recipientId], references: [id])
  status      MessageStatus @default(UNREAD)
  isDraft     Boolean       @default(false)
  createdAt   DateTime      @default(now())
  updatedAt   DateTime      @updatedAt

  @@index([senderId])
  @@index([recipientId])
  @@index([status])
  @@index([createdAt])
}

// ============================================
// MÓDULO: TESORERÍA
// ============================================

model EntradaDinero {
  id             String           @id @default(uuid())
  monto          Decimal          @db.Decimal(10, 2)
  fechaEntrada   DateTime
  descripcion    String?          @db.Text
  numeroRecibo   String?          @unique
  motivoId       String
  motivo         EntradaMotivo    @relation(fields: [motivoId], references: [id])
  registradoPor  String
  registrador    User             @relation(fields: [registradoPor], references: [id])
  createdAt      DateTime         @default(now())
  updatedAt      DateTime         @updatedAt

  @@index([fechaEntrada])
  @@index([motivoId])
}

model EntradaMotivo {
  id        String          @id @default(uuid())
  nombre    String          @unique
  entradas  EntradaDinero[]
  createdAt DateTime        @default(now())
}

model SalidaDinero {
  id             String         @id @default(uuid())
  monto          Decimal        @db.Decimal(10, 2)
  fechaSalida    DateTime
  descripcion    String?        @db.Text
  numeroComprobante String?     @unique
  motivoId       String
  motivo         SalidaMotivo   @relation(fields: [motivoId], references: [id])
  registradoPor  String
  registrador    User           @relation(fields: [registradoPor], references: [id])
  createdAt      DateTime       @default(now())
  updatedAt      DateTime       @updatedAt

  @@index([fechaSalida])
  @@index([motivoId])
}

model SalidaMotivo {
  id       String         @id @default(uuid())
  nombre   String         @unique
  salidas  SalidaDinero[]
  createdAt DateTime      @default(now())
}

// ============================================
// ACTUALIZACIÓN: User Model (agregar campo RUT)
// ============================================

model User {
  // Campos existentes...
  id        String     @id @default(uuid())
  email     String     @unique

  // ✨ NUEVO: Campo RUT para usuarios chilenos
  rut       String?    @unique

  name      String
  lastName  String
  password  String
  // ... resto de campos existentes

  // Nuevas relaciones para logia
  feeds            Feed[]            @relation("AuthorFeeds")
  feedComments     FeedComment[]     @relation("AuthorComments")
  sentMessages     Message[]         @relation("SentMessages")
  receivedMessages Message[]         @relation("ReceivedMessages")
  actas            Acta[]
  entradasDinero   EntradaDinero[]
  salidasDinero    SalidaDinero[]

  @@index([rut])
}
```

### 4.2 Script de Migración MySQL → PostgreSQL

```javascript
// prisma/migration-scripts/migrate-from-mysql.ts
import { PrismaClient } from '@prisma/client';
import mysql from 'mysql2/promise';

const prisma = new PrismaClient();

// Conexión MySQL (PHP DB)
const mysqlConnection = await mysql.createConnection({
  host: 'localhost',
  port: 3306,
  user: 'root',
  password: 'root',
  database: 'caleuche',
});

async function migrateData() {
  console.log('🚀 Iniciando migración de datos...\n');

  // 1. MIGRAR USUARIOS
  console.log('📥 Migrando usuarios...');
  const [mysqlUsers] = await mysqlConnection.execute(
    'SELECT * FROM users WHERE estado = 1'
  );

  for (const user of mysqlUsers) {
    // Determinar rol según grado
    const roleName = user.grado === 1 ? 'Aprendiz'
                   : user.grado === 2 ? 'Compañero'
                   : 'Maestro';

    const role = await prisma.role.findUnique({
      where: { name: roleName }
    });

    // Crear usuario en PostgreSQL
    const newUser = await prisma.user.create({
      data: {
        email: user.email || `${user.username}@logiacaleuche.cl`,
        rut: user.username, // RUT como identificador único
        name: user.name,
        lastName: user.lastname,
        password: user.password, // Ya está hasheado con bcrypt
        phone: user.telefono,
        address: user.direccion,
        city: user.ciudad,
        image: user.image,
        state: user.estado,
        birthdate: user.fecha_nacimiento,
        // Asignar rol
        roles: {
          create: {
            roleId: role.id
          }
        }
      }
    });

    console.log(`✅ Usuario migrado: ${newUser.name} (${roleName})`);
  }

  // 2. MIGRAR ACTAS
  console.log('\n📥 Migrando actas...');
  const [mysqlActas] = await mysqlConnection.execute(
    'SELECT * FROM acta'
  );

  for (const acta of mysqlActas) {
    // Buscar usuario creador (puede ser primer admin)
    const admin = await prisma.user.findFirst({
      where: { roles: { some: { role: { name: 'Maestro' } } } }
    });

    await prisma.acta.create({
      data: {
        nameActa: acta.name_Acta,
        fileName: acta.file_name,
        gradoActa: acta.grado_Acta,
        fechaActa: new Date(acta.fecha_Acta),
        createdById: admin.id
      }
    });
  }

  // 3. MIGRAR BIBLIOTECA
  console.log('\n📥 Migrando biblioteca...');
  const [mysqlLibros] = await mysqlConnection.execute(
    'SELECT * FROM biblioteca'
  );

  for (const libro of mysqlLibros) {
    await prisma.biblioteca.create({
      data: {
        nombreLibro: libro.nombre_Libro,
        autorLibro: libro.autor_Libro,
        fileName: libro.file_name,
        gradoLibro: libro.grado_Libro
      }
    });
  }

  // 4. MIGRAR BOLETINES
  console.log('\n📥 Migrando boletines...');
  const [mysqlBoletines] = await mysqlConnection.execute(
    'SELECT * FROM boletin'
  );

  for (const boletin of mysqlBoletines) {
    await prisma.boletin.create({
      data: {
        tituloBoletin: boletin.titulo_Boletin,
        fileName: boletin.file_name,
        gradoBoletin: boletin.grado_Boletin
      }
    });
  }

  // 5. MIGRAR TRAZADOS
  console.log('\n📥 Migrando trazados...');
  const [mysqlTrazados] = await mysqlConnection.execute(
    'SELECT * FROM trazado'
  );

  for (const trazado of mysqlTrazados) {
    await prisma.trazado.create({
      data: {
        nombreTrazado: trazado.nombre_Trazado,
        fileName: trazado.file_name,
        fechaTrazado: trazado.fecha_Trazado ? new Date(trazado.fecha_Trazado) : null
      }
    });
  }

  // 6. MIGRAR FEED/NOTICIAS
  console.log('\n📥 Migrando feed...');
  const [mysqlFeed] = await mysqlConnection.execute(`
    SELECT f.*, u.id as user_id
    FROM feed f
    LEFT JOIN users u ON f.id_user = u.id
  `);

  for (const post of mysqlFeed) {
    // Buscar usuario en nueva DB
    const user = await prisma.user.findFirst({
      where: { rut: post.username }
    });

    if (!user) continue;

    const feed = await prisma.feed.create({
      data: {
        title: post.ftitulo,
        content: post.fdescripcion,
        image: post.fimage,
        categoryId: await getCategoryId(post.id_catfeed),
        authorId: user.id
      }
    });

    // Migrar comentarios
    const [comments] = await mysqlConnection.execute(
      'SELECT * FROM commentsfeed WHERE id_feed = ?',
      [post.id_feed]
    );

    for (const comment of comments) {
      const commentAuthor = await prisma.user.findFirst({
        where: { rut: comment.username }
      });

      if (commentAuthor) {
        await prisma.feedComment.create({
          data: {
            content: comment.comment,
            feedId: feed.id,
            authorId: commentAuthor.id
          }
        });
      }
    }
  }

  // 7. MIGRAR EVENTOS
  console.log('\n📥 Migrando eventos...');
  const [mysqlEventos] = await mysqlConnection.execute(
    'SELECT * FROM evento'
  );

  for (const evento of mysqlEventos) {
    const categoriaEvento = evento.cat_Evento === 1 ? 'APRENDIZ'
                          : evento.cat_Evento === 2 ? 'COMPANERO'
                          : evento.cat_Evento === 3 ? 'MAESTRO'
                          : 'TODOS';

    await prisma.evento.create({
      data: {
        nombreEvento: evento.name_evento,
        descripcion: evento.descripcion,
        fechaEvento: new Date(evento.fecha_evento),
        horaEvento: evento.hora_evento,
        tipoTrabajo: evento.trabajo,
        categoriaEvento: categoriaEvento
      }
    });
  }

  // 8. MIGRAR TESORERÍA
  console.log('\n📥 Migrando tesorería...');

  // Entradas
  const [mysqlEntradas] = await mysqlConnection.execute(`
    SELECT e.*, u.id as user_id
    FROM entradadinero e
    LEFT JOIN users u ON e.id_user = u.id
  `);

  for (const entrada of mysqlEntradas) {
    const user = await prisma.user.findFirst({
      where: { rut: entrada.username }
    });

    if (!user) continue;

    // Crear motivo si no existe
    let motivo = await prisma.entradaMotivo.findUnique({
      where: { nombre: entrada.motivo }
    });

    if (!motivo) {
      motivo = await prisma.entradaMotivo.create({
        data: { nombre: entrada.motivo }
      });
    }

    await prisma.entradaDinero.create({
      data: {
        monto: parseFloat(entrada.monto),
        fechaEntrada: new Date(entrada.fecha),
        descripcion: entrada.descripcion,
        motivoId: motivo.id,
        registradoPor: user.id
      }
    });
  }

  console.log('\n✅ Migración completada exitosamente!');
}

// Helper: Mapear categorías de feed
async function getCategoryId(mysqlCategoryId: number): Promise<string> {
  // Lógica para mapear categorías antiguas a nuevas
  const categoryMap = {
    1: 'Noticias',
    2: 'Eventos',
    3: 'Anuncios',
    // ... más según tu DB
  };

  const categoryName = categoryMap[mysqlCategoryId] || 'General';

  let category = await prisma.feedCategory.findUnique({
    where: { name: categoryName }
  });

  if (!category) {
    category = await prisma.feedCategory.create({
      data: { name: categoryName }
    });
  }

  return category.id;
}

// Ejecutar migración
migrateData()
  .catch(console.error)
  .finally(async () => {
    await prisma.$disconnect();
    await mysqlConnection.end();
  });
```

### 4.3 Seeder de Roles Iniciales

```typescript
// prisma/seed.ts
import { PrismaClient } from '@prisma/client';
import bcrypt from 'bcrypt';

const prisma = new PrismaClient();

async function main() {
  console.log('🌱 Iniciando seed de base de datos...\n');

  // 1. CREAR ROLES BASE
  console.log('📝 Creando roles base...');

  const roles = [
    { name: 'Aprendiz', description: 'Primer grado masónico - Acceso básico' },
    { name: 'Compañero', description: 'Segundo grado masónico - Acceso intermedio' },
    { name: 'Maestro', description: 'Tercer grado masónico - Acceso completo' },
    { name: 'Venerable Maestro', description: 'Presidente de la logia' },
    { name: 'Tesorero', description: 'Administrador de finanzas' },
    { name: 'Secretario', description: 'Gestor de actas y documentos' },
  ];

  for (const role of roles) {
    await prisma.role.upsert({
      where: { name: role.name },
      update: {},
      create: role
    });
  }

  console.log('✅ Roles creados\n');

  // 2. CREAR PERMISOS
  console.log('📝 Creando permisos...');

  const permissions = [
    // Actas
    { name: 'actas:read:grado1' },
    { name: 'actas:read:grado2' },
    { name: 'actas:read:grado3' },
    { name: 'actas:create' },
    { name: 'actas:edit' },
    { name: 'actas:delete' },

    // Biblioteca
    { name: 'biblioteca:read:grado1' },
    { name: 'biblioteca:read:grado2' },
    { name: 'biblioteca:read:grado3' },
    { name: 'biblioteca:upload' },

    // Trazados (solo maestros)
    { name: 'trazados:read' },
    { name: 'trazados:upload' },

    // Tesorería
    { name: 'tesoreria:read' },
    { name: 'tesoreria:create' },
    { name: 'tesoreria:edit' },
    { name: 'tesoreria:report' },

    // Feed
    { name: 'feed:read' },
    { name: 'feed:create' },
    { name: 'feed:comment' },
    { name: 'feed:moderate' },

    // Eventos
    { name: 'eventos:read' },
    { name: 'eventos:create' },
    { name: 'eventos:edit' },

    // Mensajería
    { name: 'mensajes:send' },
    { name: 'mensajes:read' },
  ];

  for (const perm of permissions) {
    await prisma.permission.upsert({
      where: { name: perm.name },
      update: {},
      create: perm
    });
  }

  console.log('✅ Permisos creados\n');

  // 3. ASIGNAR PERMISOS A ROLES
  console.log('📝 Asignando permisos a roles...');

  const aprendizRole = await prisma.role.findUnique({ where: { name: 'Aprendiz' } });
  const companeroRole = await prisma.role.findUnique({ where: { name: 'Compañero' } });
  const maestroRole = await prisma.role.findUnique({ where: { name: 'Maestro' } });
  const tesoreroRole = await prisma.role.findUnique({ where: { name: 'Tesorero' } });

  // Permisos Aprendiz
  const aprendizPerms = [
    'actas:read:grado1',
    'biblioteca:read:grado1',
    'feed:read',
    'feed:create',
    'feed:comment',
    'eventos:read',
    'mensajes:send',
    'mensajes:read',
  ];

  for (const permName of aprendizPerms) {
    const perm = await prisma.permission.findUnique({ where: { name: permName } });
    await prisma.permissionRole.upsert({
      where: {
        roleId_permissionId: {
          roleId: aprendizRole.id,
          permissionId: perm.id
        }
      },
      update: {},
      create: {
        roleId: aprendizRole.id,
        permissionId: perm.id
      }
    });
  }

  // Permisos Compañero (hereda Aprendiz + agrega más)
  const companeroPerms = [
    ...aprendizPerms,
    'actas:read:grado2',
    'biblioteca:read:grado2',
  ];

  for (const permName of companeroPerms) {
    const perm = await prisma.permission.findUnique({ where: { name: permName } });
    await prisma.permissionRole.upsert({
      where: {
        roleId_permissionId: {
          roleId: companeroRole.id,
          permissionId: perm.id
        }
      },
      update: {},
      create: {
        roleId: companeroRole.id,
        permissionId: perm.id
      }
    });
  }

  // Permisos Maestro (acceso total)
  const maestroPerms = [
    ...companeroPerms,
    'actas:read:grado3',
    'biblioteca:read:grado3',
    'trazados:read',
    'tesoreria:read',
    'feed:moderate',
    'eventos:create',
    'eventos:edit',
  ];

  for (const permName of maestroPerms) {
    const perm = await prisma.permission.findUnique({ where: { name: permName } });
    await prisma.permissionRole.upsert({
      where: {
        roleId_permissionId: {
          roleId: maestroRole.id,
          permissionId: perm.id
        }
      },
      update: {},
      create: {
        roleId: maestroRole.id,
        permissionId: perm.id
      }
    });
  }

  // Permisos especiales Tesorero
  const tesoreroPerms = ['tesoreria:create', 'tesoreria:edit', 'tesoreria:report'];
  for (const permName of tesoreroPerms) {
    const perm = await prisma.permission.findUnique({ where: { name: permName } });
    await prisma.permissionRole.upsert({
      where: {
        roleId_permissionId: {
          roleId: tesoreroRole.id,
          permissionId: perm.id
        }
      },
      update: {},
      create: {
        roleId: tesoreroRole.id,
        permissionId: perm.id
      }
    });
  }

  console.log('✅ Permisos asignados\n');

  // 4. CREAR USUARIO DE PRUEBA
  console.log('📝 Creando usuario de prueba...');

  const hashedPassword = await bcrypt.hash('password123', 10);

  const testUser = await prisma.user.upsert({
    where: { email: 'maestro@logiacaleuche.cl' },
    update: {},
    create: {
      email: 'maestro@logiacaleuche.cl',
      rut: '12345678-9',
      name: 'Juan',
      lastName: 'Pérez',
      password: hashedPassword,
      state: 1,
      roles: {
        create: {
          roleId: maestroRole.id
        }
      }
    }
  });

  console.log('✅ Usuario de prueba creado\n');
  console.log('   Email: maestro@logiacaleuche.cl');
  console.log('   RUT: 12345678-9');
  console.log('   Password: password123\n');

  console.log('🎉 Seed completado exitosamente!');
}

main()
  .catch((e) => {
    console.error('❌ Error en seed:', e);
    process.exit(1);
  })
  .finally(async () => {
    await prisma.$disconnect();
  });
```

---

## 5. Plan de Migración por Fases

### Fase 0: Preparación y Configuración
**Duración:** 1-2 semanas
**Objetivo:** Preparar infraestructura base

#### Tareas:
1. ✅ **Setup PostgreSQL**
   ```bash
   # Docker Compose
   docker-compose up -d postgres
   ```

2. ✅ **Actualizar Schema Prisma**
   - Agregar campo `rut` a User
   - Crear modelos nuevos (Acta, Biblioteca, Feed, Evento, etc.)
   - Ejecutar migraciones
   ```bash
   npx prisma migrate dev --name add_logia_models
   npx prisma generate
   ```

3. ✅ **Ejecutar Seeders**
   ```bash
   npx prisma db seed
   ```

4. ✅ **Configurar Vercel Blob Storage**
   - Para archivos PDF (reemplaza uploads/ de PHP)
   ```typescript
   // .env
   BLOB_READ_WRITE_TOKEN="vercel_blob_xxx"
   ```

5. ✅ **Crear helper de permisos**
   ```typescript
   // src/shared/lib/auth/permissions.ts
   export function getUserGrado(roles: string[]): number {
     if (roles.includes('Maestro')) return 3;
     if (roles.includes('Compañero')) return 2;
     if (roles.includes('Aprendiz')) return 1;
     return 0;
   }

   export function hasPermission(
     userPermissions: string[],
     required: string
   ): boolean {
     return userPermissions.includes(required);
   }
   ```

#### Entregables:
- [ ] Base de datos PostgreSQL operativa
- [ ] Schema Prisma completo
- [ ] Roles y permisos seedeados
- [ ] Helper functions de autorización

---

### Fase 1: Migración de Usuarios PHP → PostgreSQL
**Duración:** 1 semana
**Objetivo:** Migrar usuarios del sistema PHP preservando passwords y asignando roles
**Nota de Seguridad:** Login solo con EMAIL (más seguro que RUT público)

#### Tareas:

**Decisión de Seguridad:** ✅ Login solo con EMAIL (más seguro que RUT público)

1. **Verificar conexión a MySQL**
   ```bash
   # MySQL ya está configurado en docker-compose.yml
   docker-compose ps
   mysql -h localhost -P 3306 -u root -proot caleuche
   ```

2. **Ejecutar script de migración**
   ```bash
   # El script ya está creado: prisma/migrate-from-mysql.js
   node prisma/migrate-from-mysql.js
   ```

3. **Generación automática de emails**
   ```javascript
   // Para usuarios sin email en PHP
   const email = user.email || `${user.username}@logiacaleuche.cl`;
   // Ejemplo: RUT "12345678-9" → Email: "12345678-9@logiacaleuche.cl"
   ```

4. **Asignación automática de roles**
   ```javascript
   // Mapeo grado → rol
   const roleMap = {
     1: 'Aprendiz',
     2: 'Compañero',
     3: 'Maestro'
   };
   ```

5. **Preservación de passwords**
   ```javascript
   // Los passwords de PHP (bcrypt) se preservan tal cual
   password: user.password // Ya hasheado, funciona directamente
   ```

6. **Verificación post-migración**
   ```bash
   # Ver usuarios migrados en Prisma Studio
   npx prisma studio
   ```

#### Testing:
- [ ] Usuarios migrados con email único
- [ ] Login funciona con emails originales
- [ ] Login funciona con emails generados
- [ ] Roles asignados según grado (1→Aprendiz, 2→Compañero, 3→Maestro)
- [ ] Passwords preservados correctamente
- [ ] RUT disponible en perfil (no para login)

#### Entregables:
- [ ] Todos los usuarios PHP migrados a PostgreSQL
- [ ] Login operativo con email para todos
- [ ] Roles y permisos funcionando según grado

---

### Fase 2: Sistema de Documentos por Grado
**Duración:** 2-3 semanas
**Objetivo:** Implementar los 4 sub-módulos de documentos

#### 2.1 Actas de Reuniones

**Estructura:**
```
src/features/documents/actas/
├── actions/
│   ├── index.ts
│   ├── mutations.ts
│   └── queries.ts
├── components/
│   ├── modals/
│   │   ├── NewActaModal.tsx
│   │   └── EditActaModal.tsx
│   └── table/
│       ├── ActasColumns.tsx
│       └── ActasTable.tsx
├── schemas/
│   └── actaSchemas.ts
└── types/
    └── ActasInterface.ts
```

**Server Actions:**
```typescript
// src/features/documents/actas/actions/queries.ts
'use server';

import { verifySession } from '@/shared/lib/auth/verifySession';
import { getUserGrado } from '@/shared/lib/auth/permissions';
import prisma from '@/shared/lib/db/db';

export async function getActas() {
  const session = await verifySession();
  if (!session) return { success: false, error: 'No autorizado' };

  const grado = getUserGrado(session.user.roles);

  // Filtrar según grado del usuario
  const whereClause = grado === 1
    ? { gradoActa: 1 }
    : grado === 2
    ? { gradoActa: { in: [1, 2] } }
    : {}; // Maestro ve todo

  const actas = await prisma.acta.findMany({
    where: whereClause,
    include: {
      createdBy: {
        select: { name: true, lastName: true }
      }
    },
    orderBy: { fechaActa: 'desc' }
  });

  return { success: true, data: actas };
}
```

```typescript
// src/features/documents/actas/actions/mutations.ts
'use server';

import { put } from '@vercel/blob';
import { revalidatePath } from 'next/cache';

import { ActaSchema } from '../schemas/actaSchemas';

export async function createActa(formData: FormData) {
  const session = await verifySession();
  if (!session) return { success: false, error: 'No autorizado' };

  // Validar permisos (solo Secretario o Maestro)
  if (!session.user.permissions.includes('actas:create')) {
    return { success: false, error: 'Sin permisos' };
  }

  // Validar datos
  const validated = ActaSchema.safeParse({
    nameActa: formData.get('nameActa'),
    gradoActa: parseInt(formData.get('gradoActa')),
    fechaActa: new Date(formData.get('fechaActa')),
  });

  if (!validated.success) {
    return { success: false, error: validated.error.message };
  }

  // Upload PDF a Vercel Blob
  const file = formData.get('file') as File;
  const blob = await put(`actas/${file.name}`, file, {
    access: 'public',
  });

  // Crear en DB
  const acta = await prisma.acta.create({
    data: {
      ...validated.data,
      fileName: blob.url,
      createdById: session.user.id
    }
  });

  revalidatePath('/admin/documents/actas');
  return { success: true, data: acta };
}
```

**Componentes:**
```typescript
// src/features/documents/actas/components/table/ActasTable.tsx
'use client';

import { TanTable } from '@/components/TanTable';
import { ActasColumns } from './ActasColumns';

export function ActasTable({ data }) {
  return (
    <TanTable
      data={data}
      columns={ActasColumns}
      searchColumn="nameActa"
      searchPlaceholder="Buscar actas..."
    />
  );
}
```

**Página:**
```typescript
// src/app/(admin)/admin/documents/actas/page.tsx
import { getActas } from '@/features/documents/actas/actions/queries';
import { ActasTable } from '@/features/documents/actas/components/table/ActasTable';

export default async function ActasPage() {
  const { data } = await getActas();

  return (
    <div className="p-6">
      <h1>Actas de Reuniones</h1>
      <ActasTable data={data} />
    </div>
  );
}
```

#### 2.2 Biblioteca (Similar a Actas)
#### 2.3 Boletines (Similar a Actas)
#### 2.4 Trazados (Solo Maestros)

**Diferencia clave:**
```typescript
// Solo maestros pueden ver trazados
export async function getTrazados() {
  const session = await verifySession();

  if (!session.user.permissions.includes('trazados:read')) {
    return { success: false, error: 'Acceso denegado' };
  }

  // No hay filtro por grado - todos los trazados para maestros
  const trazados = await prisma.trazado.findMany({
    orderBy: { fechaTrazado: 'desc' }
  });

  return { success: true, data: trazados };
}
```

#### Testing Fase 2:
- [ ] Aprendiz solo ve docs grado 1
- [ ] Compañero ve grado 1 y 2
- [ ] Maestro ve todos los grados
- [ ] Upload de PDFs funciona
- [ ] Descarga de PDFs funciona
- [ ] CRUD completo por tipo de documento
- [ ] Trazados solo accesibles por Maestros

---

### Fase 3: Feed/Blog Social
**Duración:** 2 semanas
**Objetivo:** Sistema de posts con comentarios

#### Estructura:
```
src/features/content/feed/
├── actions/
│   ├── mutations.ts
│   ├── queries.ts
│   └── comments/
│       ├── mutations.ts
│       └── queries.ts
├── components/
│   ├── FeedCard.tsx
│   ├── FeedList.tsx
│   ├── CommentSection.tsx
│   └── modals/
│       └── NewPostModal.tsx
├── schemas/
│   └── feedSchemas.ts
└── types/
    └── FeedInterface.ts
```

#### Server Actions:
```typescript
// src/features/content/feed/actions/queries.ts
'use server';

export async function getFeedPosts(page: number = 1, limit: number = 10) {
  const session = await verifySession();
  if (!session) return { success: false, error: 'No autorizado' };

  const posts = await prisma.feed.findMany({
    skip: (page - 1) * limit,
    take: limit,
    include: {
      author: {
        select: { name: true, lastName: true, image: true }
      },
      category: true,
      comments: {
        include: {
          author: {
            select: { name: true, lastName: true, image: true }
          }
        },
        orderBy: { createdAt: 'desc' },
        take: 3 // Últimos 3 comentarios
      },
      _count: {
        select: { comments: true }
      }
    },
    orderBy: { createdAt: 'desc' }
  });

  return { success: true, data: posts };
}
```

#### Componentes:
```typescript
// src/features/content/feed/components/FeedCard.tsx
'use client';

import Image from 'next/image';
import { Card } from '@/components/ui/card';
import { CommentSection } from './CommentSection';

export function FeedCard({ post }) {
  return (
    <Card className="p-6">
      <div className="flex gap-4">
        <Image
          src={post.author.image || '/default-avatar.png'}
          width={48}
          height={48}
          className="rounded-full"
        />
        <div className="flex-1">
          <h3 className="font-semibold">{post.title}</h3>
          <p className="text-sm text-muted-foreground">
            {post.author.name} {post.author.lastName}
          </p>
          <p className="mt-2">{post.content}</p>

          {post.image && (
            <Image
              src={post.image}
              width={600}
              height={400}
              className="mt-4 rounded"
            />
          )}

          <CommentSection postId={post.id} comments={post.comments} />
        </div>
      </div>
    </Card>
  );
}
```

#### Testing:
- [ ] Crear post con imagen
- [ ] Listar posts con paginación
- [ ] Comentar en posts
- [ ] Editar/eliminar propio post
- [ ] Moderación (solo usuarios con permiso)

---

### Fase 4: Sistema de Eventos
**Duración:** 1-2 semanas
**Objetivo:** Calendario con filtrado por grado

#### Server Actions:
```typescript
// src/features/events/actions/queries.ts
'use server';

export async function getEventos() {
  const session = await verifySession();
  if (!session) return { success: false, error: 'No autorizado' };

  const grado = getUserGrado(session.user.roles);

  // Filtrar eventos según grado
  let categoriaFilter: EventoGrado[];
  if (grado === 1) {
    categoriaFilter = ['APRENDIZ', 'TODOS'];
  } else if (grado === 2) {
    categoriaFilter = ['APRENDIZ', 'COMPANERO', 'TODOS'];
  } else {
    categoriaFilter = ['APRENDIZ', 'COMPANERO', 'MAESTRO', 'TODOS'];
  }

  const eventos = await prisma.evento.findMany({
    where: {
      categoriaEvento: { in: categoriaFilter },
      fechaEvento: { gte: new Date() } // Solo futuros
    },
    orderBy: { fechaEvento: 'asc' }
  });

  return { success: true, data: eventos };
}
```

#### Componentes:
```typescript
// src/features/events/components/Calendar.tsx
'use client';

import { Calendar } from '@/components/ui/calendar';
import { EventCard } from './EventCard';

export function EventCalendar({ eventos }) {
  const [selectedDate, setSelectedDate] = useState(new Date());

  const eventosDelDia = eventos.filter(e =>
    isSameDay(parseISO(e.fechaEvento), selectedDate)
  );

  return (
    <div className="grid grid-cols-2 gap-6">
      <Calendar
        mode="single"
        selected={selectedDate}
        onSelect={setSelectedDate}
        modifiers={{
          hasEvent: eventos.map(e => parseISO(e.fechaEvento))
        }}
      />

      <div>
        <h3>Eventos del {format(selectedDate, 'dd/MM/yyyy')}</h3>
        {eventosDelDia.map(evento => (
          <EventCard key={evento.id} evento={evento} />
        ))}
      </div>
    </div>
  );
}
```

---

### Fase 5: Mensajería Interna
**Duración:** 2 semanas
**Objetivo:** Sistema tipo email entre miembros

#### Estructura:
```
src/features/messaging/
├── actions/
│   ├── mutations.ts
│   └── queries.ts
├── components/
│   ├── Inbox.tsx
│   ├── MessageComposer.tsx
│   ├── MessageThread.tsx
│   └── table/
│       └── MessagesTable.tsx
├── schemas/
│   └── messageSchemas.ts
└── types/
    └── MessageInterface.ts
```

#### Server Actions:
```typescript
// src/features/messaging/actions/queries.ts
'use server';

export async function getInbox() {
  const session = await verifySession();
  if (!session) return { success: false, error: 'No autorizado' };

  const messages = await prisma.message.findMany({
    where: {
      recipientId: session.user.id,
      status: { not: 'DELETED' }
    },
    include: {
      sender: {
        select: { name: true, lastName: true, image: true }
      }
    },
    orderBy: { createdAt: 'desc' }
  });

  return { success: true, data: messages };
}

export async function getSent() {
  const session = await verifySession();

  const messages = await prisma.message.findMany({
    where: {
      senderId: session.user.id,
      isDraft: false
    },
    include: {
      recipient: {
        select: { name: true, lastName: true }
      }
    },
    orderBy: { createdAt: 'desc' }
  });

  return { success: true, data: messages };
}
```

```typescript
// src/features/messaging/actions/mutations.ts
'use server';

export async function sendMessage(formData: FormData) {
  const session = await verifySession();

  const validated = MessageSchema.safeParse({
    subject: formData.get('subject'),
    body: formData.get('body'),
    recipientId: formData.get('recipientId'),
  });

  if (!validated.success) {
    return { success: false, error: validated.error.message };
  }

  const message = await prisma.message.create({
    data: {
      ...validated.data,
      senderId: session.user.id,
      status: 'UNREAD'
    }
  });

  revalidatePath('/admin/messaging/inbox');
  return { success: true, data: message };
}

export async function markAsRead(messageId: string) {
  const session = await verifySession();

  const message = await prisma.message.update({
    where: {
      id: messageId,
      recipientId: session.user.id // Solo el destinatario
    },
    data: { status: 'READ' }
  });

  revalidatePath('/admin/messaging/inbox');
  return { success: true };
}
```

---

### Fase 6: Tesorería
**Duración:** 2 semanas
**Objetivo:** Registro de ingresos/egresos + informes

#### Estructura:
```
src/features/treasury/
├── actions/
│   ├── entries/
│   │   ├── mutations.ts
│   │   └── queries.ts
│   ├── exits/
│   │   ├── mutations.ts
│   │   └── queries.ts
│   └── reports/
│       └── queries.ts
├── components/
│   ├── EntriesTable.tsx
│   ├── ExitsTable.tsx
│   ├── TreasuryDashboard.tsx
│   └── modals/
│       ├── NewEntryModal.tsx
│       ├── NewExitModal.tsx
│       └── ReportModal.tsx
├── schemas/
│   └── treasurySchemas.ts
└── types/
    └── TreasuryInterface.ts
```

#### Server Actions:
```typescript
// src/features/treasury/actions/entries/mutations.ts
'use server';

export async function createEntrada(formData: FormData) {
  const session = await verifySession();

  // Solo Tesorero puede registrar
  if (!session.user.permissions.includes('tesoreria:create')) {
    return { success: false, error: 'Sin permisos' };
  }

  const validated = EntradaSchema.safeParse({
    monto: parseFloat(formData.get('monto')),
    fechaEntrada: new Date(formData.get('fechaEntrada')),
    descripcion: formData.get('descripcion'),
    motivoId: formData.get('motivoId'),
  });

  if (!validated.success) {
    return { success: false, error: validated.error.message };
  }

  const entrada = await prisma.entradaDinero.create({
    data: {
      ...validated.data,
      registradoPor: session.user.id
    }
  });

  // Auditar
  await logAuditEvent({
    action: 'TREASURY_ENTRY_CREATE',
    entity: 'EntradaDinero',
    entityId: entrada.id,
    description: `Entrada registrada: ${validated.data.monto}`,
    userId: session.user.id
  });

  revalidatePath('/admin/treasury/entries');
  return { success: true, data: entrada };
}
```

#### Componente de Informe:
```typescript
// src/features/treasury/components/TreasuryReport.tsx
'use client';

import { Card } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { exportToPDF } from '@/shared/lib/pdf/exportToPDF';

export function TreasuryReport({ startDate, endDate }) {
  const { data: entradas } = useSWR(
    `/treasury/entries?from=${startDate}&to=${endDate}`,
    getEntradas
  );

  const { data: salidas } = useSWR(
    `/treasury/exits?from=${startDate}&to=${endDate}`,
    getSalidas
  );

  const totalEntradas = entradas?.reduce((sum, e) => sum + e.monto, 0) || 0;
  const totalSalidas = salidas?.reduce((sum, s) => sum + s.monto, 0) || 0;
  const balance = totalEntradas - totalSalidas;

  const handleExportPDF = () => {
    exportToPDF({
      title: 'Informe de Tesorería',
      data: {
        period: `${format(startDate, 'dd/MM/yyyy')} - ${format(endDate, 'dd/MM/yyyy')}`,
        totalEntradas,
        totalSalidas,
        balance,
        entries: entradas,
        exits: salidas
      }
    });
  };

  return (
    <Card className="p-6">
      <h2>Informe de Tesorería</h2>

      <div className="grid grid-cols-3 gap-4 mt-4">
        <Card className="p-4 bg-green-50">
          <h3 className="text-sm">Total Ingresos</h3>
          <p className="text-2xl font-bold text-green-600">
            ${totalEntradas.toLocaleString()}
          </p>
        </Card>

        <Card className="p-4 bg-red-50">
          <h3 className="text-sm">Total Egresos</h3>
          <p className="text-2xl font-bold text-red-600">
            ${totalSalidas.toLocaleString()}
          </p>
        </Card>

        <Card className="p-4 bg-blue-50">
          <h3 className="text-sm">Balance</h3>
          <p className={`text-2xl font-bold ${balance >= 0 ? 'text-blue-600' : 'text-red-600'}`}>
            ${balance.toLocaleString()}
          </p>
        </Card>
      </div>

      <Button onClick={handleExportPDF} className="mt-4">
        Exportar PDF
      </Button>
    </Card>
  );
}
```

---

### Fase 7: Funcionalidades Complementarias
**Duración:** 1-2 semanas

#### 7.1 Dashboard Principal
- Próximos cumpleaños (ya existe lógica en PHP)
- Últimos posts del feed
- Próximos eventos
- Balance de tesorería (solo para tesorero)

#### 7.2 Email Automatizado
```typescript
// Emails de cumpleaños (cron job)
// src/app/api/cron/birthday-emails/route.ts

export async function GET(request: Request) {
  // Verificar cron secret
  const authHeader = request.headers.get('authorization');
  if (authHeader !== `Bearer ${process.env.CRON_SECRET}`) {
    return new Response('Unauthorized', { status: 401 });
  }

  const today = new Date();
  const users = await prisma.user.findMany({
    where: {
      birthdate: {
        not: null
      }
    }
  });

  const birthdayUsers = users.filter(u => {
    const bday = new Date(u.birthdate!);
    return bday.getDate() === today.getDate() &&
           bday.getMonth() === today.getMonth();
  });

  for (const user of birthdayUsers) {
    await sendBirthdayEmail(user);
  }

  return Response.json({ sent: birthdayUsers.length });
}
```

#### 7.3 Notificaciones
- Nuevos mensajes
- Nuevos eventos
- Nuevos posts en feed

---

### Fase 8: Testing y Deploy
**Duración:** 1-2 semanas

#### 8.1 Testing
```typescript
// __tests__/auth/login.test.ts
describe('Login con RUT', () => {
  it('debe permitir login con RUT válido', async () => {
    const result = await authorize({
      identifier: '12345678-9',
      password: 'password123'
    });

    expect(result).toBeDefined();
    expect(result.rut).toBe('12345678-9');
  });

  it('debe rechazar RUT inválido', async () => {
    const result = await authorize({
      identifier: '12345678-0', // DV incorrecto
      password: 'password123'
    });

    expect(result).toBeNull();
  });
});
```

#### 8.2 Deploy

**Opción 1: Vercel (Recomendado)**
```bash
# .env.production
DATABASE_URL="postgresql://user:pass@host/db"
NEXTAUTH_SECRET="xxx"
NEXTAUTH_URL="https://intranet.logiacaleuche.cl"
BLOB_READ_WRITE_TOKEN="vercel_blob_xxx"

# Deploy
vercel --prod
```

**Opción 2: Docker**
```dockerfile
# Dockerfile
FROM node:20-alpine

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .
RUN npx prisma generate
RUN npm run build

EXPOSE 3000

CMD ["npm", "start"]
```

---

## 6. Consideraciones Técnicas

### 6.1 Estrategia de Convivencia

Durante la migración, ambos sistemas pueden coexistir:

```nginx
# nginx.conf
location /admin/new/ {
    proxy_pass http://nextjs:3000;
}

location /admin/ {
    root /var/www/php-app;
    index index.php;
}
```

### 6.2 Migración de Archivos

Los PDFs en `app/public/Admin/uploads/` deben migrarse a Vercel Blob:

```typescript
// scripts/migrate-files.ts
import { put } from '@vercel/blob';
import fs from 'fs';
import path from 'path';

const uploadDir = '/path/to/php/uploads';
const folders = ['acta', 'biblioteca', 'boletin', 'trazado', 'feed', 'noticias'];

for (const folder of folders) {
  const files = fs.readdirSync(path.join(uploadDir, folder));

  for (const file of files) {
    const filePath = path.join(uploadDir, folder, file);
    const fileBuffer = fs.readFileSync(filePath);

    const blob = await put(`${folder}/${file}`, fileBuffer, {
      access: 'public',
    });

    console.log(`✅ Uploaded: ${blob.url}`);

    // Actualizar URL en DB
    await updateFileUrl(folder, file, blob.url);
  }
}
```

### 6.3 Seguridad

**Validaciones en Server Actions:**
```typescript
// Siempre verificar sesión
const session = await verifySession();
if (!session) unauthorized();

// Validar permisos
if (!hasPermission(session.user.permissions, 'actas:create')) {
  return { success: false, error: 'Sin permisos' };
}

// Validar inputs con Zod
const validated = Schema.safeParse(data);
if (!validated.success) {
  return { success: false, error: validated.error.message };
}

// Auditar acciones sensibles
await logAuditEvent({
  action: 'DOCUMENT_CREATE',
  entity: 'Acta',
  entityId: acta.id,
  userId: session.user.id
});
```

### 6.4 Performance

**Optimizaciones:**
- Server Components por defecto
- ISR para contenido semi-estático
- Paginación server-side
- Lazy loading de imágenes
- Caching con React cache()

```typescript
import { cache } from 'react';

export const getActas = cache(async () => {
  // Solo se ejecuta una vez por request
  return await prisma.acta.findMany();
});
```

---

## 7. Cronograma Estimado

| Fase | Duración | Fecha Inicio | Fecha Fin |
|------|----------|--------------|-----------|
| Fase 0: Preparación | 2 semanas | Semana 1 | Semana 2 |
| Fase 1: Auth | 1 semana | Semana 3 | Semana 3 |
| Fase 2: Documentos | 3 semanas | Semana 4 | Semana 6 |
| Fase 3: Feed | 2 semanas | Semana 7 | Semana 8 |
| Fase 4: Eventos | 2 semanas | Semana 9 | Semana 10 |
| Fase 5: Mensajería | 2 semanas | Semana 11 | Semana 12 |
| Fase 6: Tesorería | 2 semanas | Semana 13 | Semana 14 |
| Fase 7: Complementos | 2 semanas | Semana 15 | Semana 16 |
| Fase 8: Testing/Deploy | 2 semanas | Semana 17 | Semana 18 |

**Total:** ~18 semanas (4.5 meses)

---

## 8. Riesgos y Mitigaciones

### Riesgos Identificados

| Riesgo | Probabilidad | Impacto | Mitigación |
|--------|--------------|---------|------------|
| Pérdida de datos en migración | Media | Alto | Backups completos antes de migrar, validación post-migración |
| Incompatibilidad de permisos | Alta | Medio | Testing exhaustivo con usuarios de cada grado |
| Usuarios no adoptan nueva interfaz | Media | Medio | Capacitación previa, período de convivencia |
| Problemas de performance | Baja | Medio | Profiling, optimización incremental |
| Errores en validación RUT | Media | Bajo | Testing con RUTs reales, validación robusta |

### Plan de Rollback

En caso de fallo crítico:

1. **Mantener PHP operativo** durante toda la migración
2. **Backup diario** de PostgreSQL
3. **Feature flags** para habilitar/deshabilitar módulos
4. **Rollback de DNS** si es necesario

---

## 9. Próximos Pasos

### Inmediatos (Esta Semana)

1. ✅ Revisar y aprobar este plan
2. ⬜ Setup PostgreSQL en ambiente local
3. ⬜ Ejecutar schema Prisma inicial
4. ⬜ Ejecutar seeders de roles y permisos
5. ⬜ Crear branch `migration/logia-caleuche`

### Corto Plazo (Próximas 2 Semanas)

1. ⬜ Implementar campo RUT en User
2. ⬜ Adaptar LoginForm para RUT
3. ⬜ Migrar usuarios PHP → PostgreSQL
4. ⬜ Testing de login dual (email/RUT)

### Medio Plazo (Mes 1-2)

1. ⬜ Implementar módulo de Actas
2. ⬜ Implementar módulo de Biblioteca
3. ⬜ Implementar módulo de Boletines
4. ⬜ Implementar módulo de Trazados

---

## 10. Recursos y Referencias

### Documentación Técnica
- [Next.js 15 Docs](https://nextjs.org/docs)
- [Prisma ORM Docs](https://www.prisma.io/docs)
- [NextAuth.js Docs](https://next-auth.js.org/)
- [TanStack Table v8](https://tanstack.com/table/latest)
- [Vercel Blob Storage](https://vercel.com/docs/storage/vercel-blob)

### Proyectos de Referencia
- `nextjs-caleuche/` - Infraestructura base ya implementada
- `app/public/Admin/` - Sistema PHP actual

### Contactos Clave
- **Desarrollador Lead:** [Tu nombre]
- **Venerable Maestro:** [Contacto logia]
- **Tesorero:** [Contacto tesorero]

---

**Última actualización:** Octubre 2025
**Autor:** Claude + Equipo Logia Caleuche
**Versión:** 1.0
