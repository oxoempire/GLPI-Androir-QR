# Android Inventory QR para GLPI

Genera de forma local y segura códigos QR cifrados en Base64 para auto-configurar y vincular la aplicación Android de GLPI Inventory. Permite configurar la URL base, credenciales, tipo de activo y frecuencia de escaneo automático sin exponer datos.

## 🚀 Funcionalidades Principales

Este plugin añade una nueva pestaña en `Configuración > General` dentro de tu instancia GLPI, la cual contiene un "Generador de Códigos QR" que facilita de forma drástica la inicialización de escáneres Android en tu organización.

*   **Generación 100% Local**: Todo el ensamblado del JSON, la conversión a `Base64` y el renderizado del Código QR se realizan en el lado del cliente (Navegador) mediante JavaScript. Esto significa que **ninguna de tus contraseñas es enviada a un servidor externo** para crear la imagen.
*   **Parámetros Completos Personalizables**:
    *   **URL**: Define la ruta exacta de tu GLPI (si se deja en blanco asume automáticamente `URL_BASE/marketplace/glpiinventory`).
    *   **TAG**: Etiqueta identificativa de la máquina o red (Ej. `android_samsung`). Opcional.
    *   **LOGIN & PASSWORD**: Credenciales para casos donde tu endpoint de inventario requiera autenticación básica. Opcional.
    *   **ASSET_ITEMTYPE**: Define el tipo de activo (Soporta `Phone` o `Computer`). Requerido.
    *   **ANDROID_AUTOMATIC_INVENTORY**: Define si la aplicación deberá forzar inventarios en segundo plano de forma contínua (`Sí - 1` / `No - 0`).
    *   **ANDROID_FREQUENCY**: La frecuencia de estos chequeos (`Week` o `Day`).
*   **Interfaz Limpia y Segura**: La web genera el código QR instantáneamente bloqueando la visualización del texto plano (JSON y Base64) en pantalla por seguridad básica contra *shoulder-surfing*.
*   **Limpieza Rápida**: Botón de reseteo para ocultar el QR anterior y restaurar los formulatios de inmediato.

## ⚙️ Especificaciones Técnicas

*   Formato de salida del QR: Cadena JSON codificada en `Base64`.
*   Soporte UTF-8 codificado propiamente para evitar rupturas de sintaxis en Base64.
*   Librería Gráfica: `qrcode.js`.
*   Requisitos: GLPI >= 10.0.0.

## 📥 Instalación (How To)

Existen dos formas de llevar este plugin a tu servidor GLPI:

**Opción A: Usando Git (Recomendado)**
Accede por terminal a la carpeta de plugins de tu servidor GLPI y clona este repositorio directamente:
```bash
cd /var/www/html/glpi/plugins/
git clone https://github.com/oxoempire/GLPI-Androir-QR.git inventoryqr
```
*(Asegúrate de cambiar `/var/www/html/glpi/plugins/` por la ruta real de tu servidor)*.

**Opción B: Descarga Manual**
1. Descarga el repositorio en formato `.zip` desde GitHub.
2. Descomprímelo y renombra la carpeta resultante a `inventoryqr`.
3. Sube la carpeta al directorio `plugins/` de tu instalación de GLPI (Ej: `/var/www/html/glpi/plugins/inventoryqr`).

**Activación en GLPI:**
1. Inicia sesión en GLPI con una cuenta de *Super-Admin*.
4. Dirígete a **Configuración** > **Complementos** (o *Plugins*).
5. Verás en la lista el plugin **Android Inventory QR**, haz clic sobre el ícono de la carpeta gris para **Instalarlo**.
6. Haz clic en el círculo verde/rojo para **Activarlo**.
7. ¡Listo! Dirígete a **Configuración** > **General**, verás una nueva sub-pestaña para comenzar a generar los QRs.

## 👥 Créditos y Autores

*   **Idea Original y Diseño Funcional**: Manu Cabello
*   **Ejecución de código y Arquitectura**: Antigravity & Gemini Pro

## 📜 Licencia

Distribuido bajo la licencia **GPLv2+**, acorde al estándar de licenciamiento del núcleo de GLPI.
