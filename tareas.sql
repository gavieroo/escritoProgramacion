create database escritoProgramacion;
use escritoProgramacion;

create table Tareas(
    Id serial primary key not null, 
    Titulo varchar(16) not null, 
    Contenido varchar(64) not null, 
    Estado enum("Por hacer","Finalizado", "En Curso") not null, 
    autor varchar(16) not null, 
    created_at datetime, 
    updated_at datetime, 
    deleted_at datetime
);