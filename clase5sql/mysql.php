<?php 

/* comentarios de SQL


INSERT INTO 'TABLA'('CAMPO') VALUE ("aLGO"),("ALGO MAS")

insert into 'usuario' ('Nombre') values("Hernán")



UPDATE NECESITA UNA CONDICION (PUT)

UPDATE 'TABLA' SET 'CAMPO'= 'VALOR' WHERE (CONDICION)

UPDATE `usuario` SET `Nombre`="Juan" WHERE `Idusuario` = 1


DELETE , BORRA FILAS

DELETE FROM `usuario` WHERE `Idusuario`> 3


SELECT (ESTRUCTURAR BIEN LA CONSULTA)


1ª TENER EN CUENTA EL 'FROM'

ALIAS (PARA LA TABLA) Usarlos para diferenciar tablas

select analisis de las tablas 


where establecemos las relaciones


u.idusuario = ut.idusuario and t.idpuesto 0 ut.idpuesto


SELECT u.nombre as Usuario, t.descripción as Sistema
FROM `usuario-trabajo` as ut, `usuario` as u,`puestotrabajo` as t
WHERE u.idusuario = ut.idusuario and
t.idpuesto = ut.idpuesto
ORDER by u.nombre ASC







*/



 ?>