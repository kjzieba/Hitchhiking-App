create table user_details
(
    id      serial
        primary key,
    name    varchar(64)  not null,
    surname varchar(128) not null
);

create table users
(
    id              serial
        primary key,
    email           varchar(256) not null,
    password        varchar(128) not null,
    id_user_details integer      not null
        constraint details_users___fk
            references user_details
            on update cascade on delete cascade
);

create table rides
(
    id              serial
        primary key,
    start           varchar(256) not null,
    destination     varchar(256) not null,
    number_of_seats integer      not null,
    date            date         not null,
    time            time         not null,
    id_added_by     integer      not null
        constraint driver___fk
            references users
            on update cascade on delete cascade
);

create table roles
(
    role    integer not null,
    id_user integer not null
        constraint user_roles___fk
            references users
            on update cascade on delete cascade
);

create table rides_passengers
(
    id_user integer not null
        constraint rides_passengers_users_id_fk
            references users
            on update cascade on delete cascade,
    id_ride integer not null
        constraint ride___fk
            references rides
            on update cascade on delete cascade
);

create view all_rides(id, start, destination, number_of_seats, date, time, id_added_by) as
SELECT rides.id,
       rides.start,
       rides.destination,
       rides.number_of_seats,
       rides.date,
       rides."time",
       rides.id_added_by
FROM rides;

create view users_rides (id_user, id_ride, id, start, destination, number_of_seats, date, time, id_added_by) as
SELECT rides_passengers.id_user,
       rides_passengers.id_ride,
       r.id,
       r.start,
       r.destination,
       r.number_of_seats,
       r.date,
       r."time",
       r.id_added_by
FROM rides_passengers
         FULL JOIN rides r ON r.id = rides_passengers.id_ride;

INSERT INTO public.rides (id, start, destination, number_of_seats, date, time, id_added_by) VALUES (8, 'Cracow', 'Warsaw', 4, '2023-02-28', '10:22:00', 10);
INSERT INTO public.rides (id, start, destination, number_of_seats, date, time, id_added_by) VALUES (9, 'Warsaw', 'Cracow', 2, '2023-03-08', '18:21:00', 10);
INSERT INTO public.rides (id, start, destination, number_of_seats, date, time, id_added_by) VALUES (10, 'Budapest', 'Prague', 2, '2023-03-12', '22:25:00', 10);

INSERT INTO public.rides_passengers (id_user, id_ride) VALUES (11, 10);

INSERT INTO public.roles (role, id_user) VALUES (0, 10);
INSERT INTO public.roles (role, id_user) VALUES (0, 11);

INSERT INTO public.user_details (id, name, surname) VALUES (17, 'John', 'Smith');
INSERT INTO public.user_details (id, name, surname) VALUES (18, 'Bob', 'Ross');

INSERT INTO public.users (id, email, password, id_user_details) VALUES (10, 'test@email.com', '$2y$10$VF3dTif4uNiZVr21zREuEOUoTeaXD0Y1UIGnwxZ2RGn8G6GgMKW0.', 17);
INSERT INTO public.users (id, email, password, id_user_details) VALUES (11, 'bob@email.com', '$2y$10$viej0.ILPBoCOTjjE6M4HOVtvW3IVg/b/GqWnH16.NH8JRRAAmT.y', 18);
