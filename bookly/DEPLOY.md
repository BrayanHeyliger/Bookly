# Deploy Bookly en Render

## Pasos

1. Subí este proyecto a GitHub
2. En Render, creá un nuevo **Web Service**
3. Conectá el repo de GitHub
4. Configurá:
   - **Runtime:** PHP
   - **Build Command:** `echo "No build step"`
   - **Start Command:** `php -S 0.0.0.0:$PORT -t public`
   - **Plan:** Free (o Starter si querés persistencia garantizada)
5. En **Environment** agregá:
   - `APP_ENV=production`
6. En **Disks** agregá un disk persistente:
   - **Mount path:** `/opt/render/project/src/storage`
   - **Size:** 1 GB
7. Deploy

## Primer acceso

El instalador corre en el primer request. En el paso **Admin** vas a crear tu
usuario con la contraseña que elijas.

**No hay credenciales por defecto.** El instalador exige una contraseña de al
menos 12 caracteres, con mayúsculas, minúsculas y números, y rechaza las
contraseñas comunes. Guardala en tu gestor de contraseñas: no se puede recuperar
sin acceso a `storage/bookly.sqlite`.

## Notas

- La base de datos SQLite se guarda en `storage/bookly.sqlite`
- Render free tier duerme después de 15 min de inactividad
- El primer request tarda ~30s en despertar
- Los usuarios de demo del staff (`alex@bookly.app`, `jamie@bookly.app`,
  `rita@bookly.app`) existen solo para asignarles turnos: no tienen contraseña
  válida y no se puede iniciar sesión con ellos.
- Con `APP_ENV=production` se activan cookies de sesión `HttpOnly` + `Secure` +
  `SameSite=Lax`, cabeceras de seguridad y el registro de errores en el log en
  lugar de mostrarlos en pantalla.

## Dominio custom

En Render: Settings → Custom Domains → agregá tu dominio y configurá los DNS.
