# Administrador Fillament del Proyecto PetCare

## Docker

Esta aplicación corre en contenedores Docker con Docker Compose.

### Comandos Docker

```bash
# Iniciar contenedores
docker compose up -d

# Detener contenedores
docker compose down

# Ver logs
docker compose logs -f

# Ejecutar migraciones
docker compose exec app php artisan migrate

# Crear usuario admin
docker compose exec app php artisan make:filament-user

# Cualquier comando artisan
docker compose exec app php artisan [comando]

# Acceder al contenedor
docker compose exec app bash
```

## Usuarios de Prueba

| Usuario          | Email                   | Contraseña | Rol         |
|------------------|-------------------------|------------|-------------|
| Admin User       | admin@petcare.com       | admin123   | admin       |
| Veterinaria User | veterinaria@petcare.com | vet123     | veterinaria |

## Acceso al Panel

  - URL de Login: http://localhost:8086/admin/login
  - Gestión de Roles: http://localhost:8086/admin/shield/roles

## Características

  - Control de acceso basado en roles (RBAC)
  - Permisos granulares por recurso (view, create, update, delete, etc.)
  - Interfaz gráfica para gestionar roles y permisos
  - Políticas de autorización automáticas
  - Compatible con todos los recursos de Filament