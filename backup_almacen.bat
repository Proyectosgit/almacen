set anio=%date:~6,4%
set mes=%date:~3,2%
set dia=%date:~0,2%
set hora=%time:~0,2%
set hora=%hora: =0%
set minuto=%time:~3,2%
set segundo=%time:~6,2%

set DATABASE=almacen
set USUARIO=root
set PASSWORD=""
set FINAL_OUTPUT=%DATABASE%%anio%-%mes%-%dia%.sql

C:\xampp\mysql\bin\mysqldump --user=%USUARIO% --password=%PASSWORD% %DATABASE% > %FINAL_OUTPUT%
