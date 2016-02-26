
/* add 'locations' to all tables and concatonate existing values to fill it, then delete old city/state columns*/


ALTER TABLE supplier_ingredients ADD locations TEXT;
ALTER TABLE supplier_packaging ADD locations TEXT;
ALTER TABLE supplier_production ADD locations TEXT;
ALTER TABLE farms ADD locations TEXT;

update supplier_ingredients set locations = concat('[{"city":"' , city, '","state":"', state, '"}]');
update supplier_packaging set locations = concat('[{"city":"' , city, '","state":"', state, '"}]');
update supplier_production set locations = concat('[{"city":"' , city, '","state":"', state, '"}]');
update farms set locations = concat('[{"city":"' , city, '","state":"', state, '"}]');

ALTER TABLE supplier_ingredients DROP city;
ALTER TABLE supplier_ingredients DROP state;
ALTER TABLE supplier_packaging DROP city;
ALTER TABLE supplier_packaging DROP state;
ALTER TABLE supplier_production DROP city;
ALTER TABLE supplier_production DROP state;
ALTER TABLE farms DROP city;
ALTER TABLE farms DROP state;



