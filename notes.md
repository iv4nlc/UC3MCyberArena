# PLATAFORMA CTFs

IMPORTANTE: Para permitir la participación de los jugadores, la OVA resultante encargada de lanzar este servicio por el puerto 8000 deberá tener su red configurada como 
adaptador puente.

## IMPLEMENTACIÓN

- PLUGINS:

(No se han podido implementar multiquestions y/o multianswers (con pérdida de puntos tras fallo), matrix scoreboard, docker instances ni flags dinámicas -> plugins obsoletos. Se podría valorar intentar hacerlo manualmente, pero es complejo y hay otras opciones)

    - First Blood https://github.com/krzys-h/CTFd_first_blood/tree/d5bcc42efa142d9b98395a2b07effccdc2550d79 (Problema a la hora de borrar usuarios)
    - Themes
        - https://github.com/0xdevsachin/CTFD-crimson-theme/tree/9ec14862cbe51b76beaf4ad23359cf2feb9f56ac
        - https://github.com/apt-42/apt42_ctfd_themes (ftheme y wathcdogs)
        - https://github.com/hmrserver/CTFd-theme-pixo/tree/67abc2b8a444206061ad6f6070b5e5e17215336b
        
- Creación de la plataforma. Personalización, integración de plugins, challenges y demás configuraciones (pistas, puntos (valor, decoy, mínimo, máximo intentos, first blood), 
email check/server, registration code, recursos, descripciones e indicaciones...)