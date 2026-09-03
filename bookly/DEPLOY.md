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

## Notas

- La base de datos SQLite se guarda en `storage/bookly.sqlite`
- Render free tier duerme después de 15 min de inactividad
- El primer request tarda ~30s en despertar
- Admin: `admin@demo.com` / `123456`
- Cambia el password después del primer login

## Dominio custom

En Render: Settings → Custom Domains → agregá tu dominio y configurá los DNS.
