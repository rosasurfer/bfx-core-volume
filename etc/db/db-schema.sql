/*
Created     27.07.2018
Project     bfx-volume
Model       Main model
Author      Peter Walther
Database    SQLite3
*/


.open --new "bfx-empty.db"


-- drop all database objects
.bail on
pragma writable_schema = 1;
delete from sqlite_master;
pragma writable_schema = 0;
vacuum;
pragma foreign_keys = on;


-- Licenses
create table t_license (
   id       integer        not null,
   created  text[datetime] not null default (datetime('now')),   -- GMT
   modified text[datetime],                                      -- GMT
   primary key (id)
);

create trigger tr_license_after_update after update on t_license
when (new.modified = old.modified || new.modified is null)
begin
   -- update version timestamp if not yet done by the application layer
   update t_license set modified = datetime('now') where id = new.id;
end;


-- check schema
.lint fkey-indexes
