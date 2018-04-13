echo off
mysqldump.exe --defaults-file="C:\Users\Administrador\Documents\dumps\2222.sql"  --user=root --password=root --host=192.168.10.70 --protocol=tcp --port=3306 --default-character-set=utf8 --single-transaction=TRUE --skip-triggers "pfg_bifrost"
exit