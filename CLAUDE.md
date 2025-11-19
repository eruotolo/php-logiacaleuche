# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Development Commands

### TailwindCSS Build
Located in `app/` directory:
- Build with watch mode: `cd app && npm run build`
- Minify for production: `cd app && npm run minify`

### Docker Environment
- Start MySQL service: `docker-compose up -d`
- Stop services: `docker-compose down`
- MySQL: `localhost:3306` (user: root, pass: root, db: caleuche)

## Architecture Overview

PHP monolithic application serving as intranet for Logia Caleuche (Masonic Lodge). Built with PHP + MySQL + TailwindCSS.

### Application Structure

**Root Location**: `app/public/Admin/`
**Total Files**: 268 PHP files (~9,132 lines in application pages)

**Directory Structure**:
```
app/public/Admin/
├── apps-*.php           (47 files) - Application pages
├── auth-*.php           (4 files)  - Authentication
├── pages-*.php          (2 files)  - Error/recovery pages
├── index.php            - Dashboard
├── logout.php           - Session termination
├── assets/              - Frontend resources
├── controller/          (37 files) - Business logic
├── layouts/             (12 files) - Reusable components
├── uploads/             (8 subdirs) - User-uploaded files
├── vendor/              - Composer dependencies (PHPMailer)
├── template/            - Additional templates
└── unused/              - Legacy code (ignore)
```

### Authentication System

**Login Flow** (`auth-login.php`):
- Username: RUT (Chilean ID) without dots/dashes
- Password: Hashed with `password_hash()`, verified with `password_verify()`
- Uses mysqli prepared statements for security
- Stores 15+ fields in session upon successful login

**Session Variables**:
```php
$_SESSION['loggedin']      // true if authenticated
$_SESSION['id']            // User ID
$_SESSION['username']      // RUT
$_SESSION['name']          // First name
$_SESSION['lastname']      // Last name
$_SESSION['grado']         // 1=Aprendiz, 2=Compañero, 3=Maestro
$_SESSION['oficialidad']   // Lodge office position
$_SESSION['estado']        // Active/Inactive status
$_SESSION['category']      // User category
$_SESSION['image']         // Profile photo filename
```

**Session Guard**: `layouts/session.php` redirects to `auth-login.php` if not logged in

**Other Auth Files**:
- `auth-register.php` - Registration form (likely admin-only)
- `auth-recoverpw.php` - Password recovery
- `auth-lock-screen.php` - Screen lock

### Module Organization

**Naming Patterns**:

1. **`apps-[module]-[action].php`** - Main application pages
   - Examples: `apps-news-new.php`, `apps-news-list.php`, `apps-news-edit.php`

2. **`apps-[grado]-[module].php`** - Role-based pages
   - Examples: `apps-aprendiz-actas.php`, `apps-companero-biblioteca.php`

3. **`controller/[module]-[action].php`** - Form processors
   - Examples: `controller/usuario-new.php`, `controller/feed-remove.php`

**Content Modules**:
- **Feed/News**: `apps-news-*.php`, `apps-blog-*.php` - Social feed posts with comments
- **Events**: `apps-evento-*.php`, `apps-calendar.php` - Event scheduling with role visibility
- **Documents**: `apps-documentos-*.php` - General document management

**Role-Based Content** (each degree has 4 sub-modules):
- **Aprendiz** (Apprentice - Degree 1): `apps-aprendiz-[module].php`
- **Compañero** (Fellow - Degree 2): `apps-companero-[module].php`
- **Maestro** (Master - Degree 3): `apps-maestro-[module].php`

Sub-modules per degree:
- `actas` - Meeting minutes
- `biblioteca` - Library books
- `boletin` - Newsletters
- `trazados` - Masonic ritual documents

**Treasury System**:
- Income: `apps-tesoreria-entrada.php` + `apps-tesoreria-entrada-registro.php`
- Expenses: `apps-tesoreria-salida.php` + `apps-tesoreria-salida-registro.php`

**Internal Email System**:
- `apps-email-inbox.php` - Inbox
- `apps-email-send.php` - Compose
- `apps-email-draft.php` - Drafts
- `apps-email-read.php` - Read message
- `apps-email-view.php` - View details

**User Management**:
- `apps-contacts-list.php` - Member directory
- `apps-contacts-profile.php` - View member profile (36KB, largest file)
- `apps-contacts-profile-view.php` - Alternative profile view
- `apps-contacts-profile-edit.php` - Edit other user's profile
- `apps-perfile-edit.php` - Edit own profile
- `apps-contacts-register.php` - Register new member

### Controllers (37 files)

Located in `app/public/Admin/controller/`, these files process form submissions and handle business logic.

**User Management**:
- `usuario-new.php` - Create new user with photo upload
- `usuario-update.php` - Update user data
- `usuario-down.php` - Deactivate user
- `usuario-setadmin.php` - Grant admin privileges
- `usuario-passdefault.php` - Reset password to default
- `usuarios-grid.php` - Grid data processing

**Content Management**:
- `blog-new.php` - Create feed post
- `feed-remove.php` - Delete feed post
- `noticias.php` - News operations
- `delet-noticias.php` - Delete news
- `comments-new.php` - Add comment to post
- `acta-new.php`, `acta-remove.php` - Meeting minutes
- `boletin-new.php`, `boletin-remove.php` - Newsletters
- `libro-new.php`, `libro-remove.php` - Library books
- `trazado-new.php`, `trazado-remove.php` - Ritual documents
- `document-new.php`, `document-remove.php` - General documents

**Email System**:
- `email-new.php` - Send new message
- `email-replay.php` - Reply to message
- `email-draft.php` - Save draft
- `email-read.php` - Mark as read
- `email-reads.php` - Bulk read operations
- `email-deleted.php` - Delete message
- `email-cumple.php` - Automated birthday notifications
- `tarea-email.php` - Scheduled email tasks
- `enviar-boleta.php` - Send receipt

**Events**:
- `evento-new.php` - Create event
- `evento-remove.php` - Delete event

**Profile**:
- `perfil-update.php` - Update own profile
- `password-update.php` - Change password

**Treasury**:
- `registro-entrada.php` - Record income
- `registro-salida.php` - Record expense

**File Upload**:
- `upload.php` - Generic file upload handler

**Controller Pattern**:
```php
<?php
include ('../layouts/config.php');

if(isset($_POST['action'])){
    // 1. Receive POST data
    $field = $_POST['field'];

    // 2. Validate input
    if(empty(trim($_POST["field"]))){
        $field_err = "Error message";
    }

    // 3. Handle file upload (if applicable)
    $filename = rand(1000,10000)."-".$_FILES["file"]["name"];
    $tmp_name = $_FILES["file"]["tmp_name"];
    $upload_dir = '../uploads/[type]/';
    move_uploaded_file($tmp_name, $upload_dir.$filename);

    // 4. Database operation
    $query = "INSERT INTO table (fields) VALUES (values)";
    mysqli_query($link, $query);

    // 5. Redirect
    header('Location: ../success-page.php');
    // OR
    header('Location: ../error-page.php');
}
?>
```

### Layouts System (12 files)

Located in `app/public/Admin/layouts/`, these files are included in every page.

**Layout Files**:
- `session.php` - Authentication guard (included first)
- `config.php` - MySQL connection, creates `$link` variable
- `head-main.php` - Declares `$titulo` variable, starts HTML
- `head.php` - Meta tags, CSS links
- `head-style.php` - Additional page-specific styles
- `body.php` - Opening `<body>` tag with attributes
- `menu.php` - Includes `vertical-menu.php` (active) or `horizontal-menu.php`
- `vertical-menu.php` - Sidebar navigation
- `horizontal-menu.php` - Top navigation (currently disabled)
- `footer.php` - Page footer
- `vendor-scripts.php` - JavaScript libraries
- `right-sidebar.php` - Settings sidebar

**Standard Page Template**:
```php
<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include('layouts/config.php'); ?>
<?php
// Page-specific logic and queries
$query = "SELECT * FROM table";
$result = mysqli_query($link, $query);
?>
<head>
    <title><?php echo $titulo ?></title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
</head>
<?php include 'layouts/body.php'; ?>
<div id="layout-wrapper">
    <?php include 'layouts/menu.php'; ?>
    <div class="main-content">
        <div class="page-content">
            <!-- Page content here -->
        </div>
        <?php include 'layouts/footer.php'; ?>
    </div>
</div>
<?php include 'layouts/vendor-scripts.php'; ?>
</body>
</html>
```

### Database Schema

MySQL database `caleuche` located in `mysql/database/caleuche.sql`

**Key Tables**:
- `users` - Accounts with `grado` field (1=Aprendiz, 2=Compañero, 3=Maestro)
- `feed` - Social posts joined with `categoryfeed` and `users`
- `evento` - Events with `cat_Evento` for visibility control
- `message` - Internal messaging
- `acta`, `biblioteca`, `boletin`, `trazado` - Degree-restricted documents
- `entradadinero`, `salidadinero` - Treasury records with `entradamotivo`/`salidamotivo`
- `documents`, `files` - General file management

### Role-Based Access Control

Content visibility is controlled by `$_SESSION['grado']` throughout the application.

**Access Levels**:
- **Grado 1 (Aprendiz)**: Limited access to basic content
- **Grado 2 (Compañero)**: Access to Aprendiz + Compañero content
- **Grado 3 (Maestro)**: Full access to all content including Trazados

**Example from `index.php`** (events display):
```php
if ($_SESSION['grado'] == 1) {
    // Show only Aprendiz events
    $query = "SELECT * FROM evento WHERE cat_Evento = 1";
} elseif ($_SESSION['grado'] == 2) {
    // Show Aprendiz and Compañero events
    $query = "SELECT * FROM evento WHERE cat_Evento IN (1,2)";
} else {
    // Show all events (Maestro)
    $query = "SELECT * FROM evento";
}
```

**Document Access**:
All document tables (`acta`, `biblioteca`, `boletin`, `trazado`) have `grado_[Table]` field to filter by degree level.

### File Upload System

**Upload Directory Structure** (`app/public/Admin/uploads/`):
- `acta/` - Meeting minutes PDFs
- `biblioteca/` - Library books (PDFs)
- `boletin/` - Newsletter PDFs
- `documents/` - General documents
- `feed/` - Feed post images
- `noticias/` - News article images
- `trazado/` - Ritual documents (PDFs)
- `usuarios/` - User profile photos

**Security Pattern**:
```php
// Generate random filename to prevent conflicts and enumeration
$filename = rand(1000,10000)."-".$_FILES["file"]["name"];
// Example: 4567-document.pdf

$tmp_name = $_FILES["file"]["tmp_name"];
$upload_dir = '../uploads/usuarios/';
move_uploaded_file($tmp_name, $upload_dir.$filename);
```

**File Validation**: Handled in `controller/upload.php`

### Database Patterns

**Connection** (`layouts/config.php`):
```php
define('DB_SERVER', 'localhost:3306');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'caleuche');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
```

**Query Execution**:
```php
// Standard query
$query = "SELECT * FROM users WHERE estado = 1";
$result = mysqli_query($link, $query);

// Fetch results
while ($row = mysqli_fetch_Array($result)) {
    echo $row['name'];
}
```

**Prepared Statements** (used in auth):
```php
$sql = "SELECT id, username, password FROM users WHERE username = ?";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "s", $param_username);
mysqli_stmt_execute($stmt);
```

### Email System

**PHPMailer Integration** (Composer: `app/public/Admin/vendor/phpmailer/`):

**SMTP Configuration** (`layouts/config.php`):
```php
$gmailid = 'tesoreria@logiacaleuche.cl';
$gmailpassword = 'xsmtpsib-[key]';  // Sendinblue SMTP
$gmailusername = 'edgardoruotolo@gmail.com';
```

**Internal Messaging System**:
- Uses `message` table in database
- Features: inbox, sent, drafts, read/unread status
- Accessible via `apps-email-*.php` pages

**Automated Emails**:
- **Birthday notifications**: `controller/email-cumple.php` - Send birthday greetings to members
- **Task scheduler**: `controller/tarea-email.php` - Scheduled email operations
- **Receipts**: `controller/enviar-boleta.php` - Treasury receipt emails

### Frontend Stack

**Assets Location**: `app/public/Admin/assets/`

**Subdirectories**:
- `css/` - Compiled stylesheets including TailwindCSS output
- `fonts/` - Web fonts
- `images/` - UI images, logos, icons
- `js/` - Custom JavaScript files
- `lang/` - Language/translation files
- `libs/` - Third-party libraries (ApexCharts, jQuery plugins, Bootstrap, etc.)

**TailwindCSS Configuration**:
- Config: `app/tailwind.config.js`
- Input: `app/src/style.css`
- Output: `app/public/assets/css/style.css`
- Content scan: `./public/**/*.{html,js}`
- Custom breakpoints: `2xl: 1320px`
- Note: TailwindCSS is supplementary to main Bootstrap framework

**Admin Template**:
- Bootstrap-based responsive admin template
- Extensive JavaScript libraries in `assets/libs/`
- Icon fonts: Material Design Icons (mdi), Bootstrap Icons
- Charts: ApexCharts
- Vector maps: jQuery VectorMap

### Dashboard (`index.php`)

The main entry point displays:

1. **Recent Feed Posts** (6 most recent):
   - Shows posts from `feed` table joined with `categoryfeed` and `users`
   - Displays image, title, category, date, excerpt
   - Query: `ORDER BY fcreated_at DESC LIMIT 6`

2. **Upcoming Birthdays** (4 next):
   - Queries users with birthdays coming up this month
   - Shows avatar, name, date
   - Link to send birthday greeting via `controller/email-cumple.php`

3. **Upcoming Events**:
   - Filtered by user's `grado` level
   - Shows event name, work type, date, time
   - Icons differentiate event categories (Aprendiz, Compañero, Maestro)

**Custom Function**:
```php
function custom_echo($x, $length) {
    // Truncates text and adds "..." if longer than $length
    if (strlen($x) <= $length) {
        echo $x;
    } else {
        $y = substr($x, 0, $length) . '...';
        echo $y;
    }
}
```

### Important Notes

**Security Considerations**:
- Database credentials hardcoded in `layouts/config.php` (production credentials commented out)
- Session-based authentication without token-based API
- Most queries use direct SQL without prepared statements (except auth)
- File uploads use random number prefix for basic security
- No CSRF protection visible
- Passwords properly hashed with `password_hash()`

**Architecture Style**:
- Traditional monolithic PHP application
- No MVC framework (raw PHP with includes)
- Procedural mysqli database access
- Server-side rendered HTML with inline PHP
- Form submissions use POST to controller files
- Redirects used for flow control (no AJAX visible in core)

**Development Context**:
- Chilean Masonic Lodge (Logia Caleuche) intranet
- RUT (Chilean national ID) used as username
- Spanish language throughout
- Lodge hierarchy reflected in access control (Aprendiz < Compañero < Maestro)
- Ceremonial/ritual content managed with strict access levels
