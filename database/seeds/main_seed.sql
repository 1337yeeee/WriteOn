SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- categories table
INSERT INTO `categories` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'Книги', NULL, NULL);

-- authors table
INSERT INTO `authors` (`id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'J. K. Rowling', 'Джоан Роулинг (J. K. Rowling) - британская писательница, автор знаменитой серии книг о Гарри Поттере, которая стала бестселлером во всем мире. Также известна под псевдонимами Роберт Гэлбрейт и Кеннет Роузенберг.', 'img/authors/j_k_rowling.jpg', NULL, NULL),
(2, 'Франц Кафка', 'Франц Кафка (Franz Kafka) - немецкоязычный писатель и романист чешского происхождения, автор ряда произведений, среди которых \"Процесс\", \"Замок\", \"Америка\". Его работы отличаются глубоким философским содержанием и загадочностью.', 'img/authors/franz_kafka.jpg', NULL, NULL),
(3, 'Джордж Оруэлл ', 'Джордж Оруэлл (George Orwell) - британский писатель и журналист, автор знаменитых романов \"1984\" и \"Скотный двор\". Его произведения знаменуются тонкой социальной и политической критикой, а также сильным чувством справедливости.', 'img/authors/george_orwell.jpg', NULL, NULL),
(4, 'Федор Достоевский', 'Русский писатель, чьи произведения изучают во всем мире. Его книги знаменуются умением разбираться в человеческой психологии и описывать моральные дилеммы.', 'img/authors/fyodor_dostoyevsky.jpg', NULL, NULL),
(5, 'Эрнест Хемингуэй', 'Американский писатель, известный своими простыми и ясными описаниями жизни и войны. Он также был известен своей экспериментальной прозой и сильным влиянием на литературу XX века.', 'img/authors/ernest_hemingway.jpg', NULL, NULL),
(6, 'Джейн Остин', 'Английская писательница, известная своими романами о высшем обществе. Ее произведения знаменуются юмором, остроумием и наблюдательностью за общественными проблемами того времени.', 'img/authors/jane_austen.jpg', NULL, NULL),
(7, 'Габриэль Гарсия Маркес', 'Колумбийский писатель и журналист, который получил Нобелевскую премию по литературе в 1982 году. Он был известен своим магическим реализмом и описанием жизни в Латинской Америке.', 'img/authors/gabriel_garcia_marquez.jpg', NULL, NULL),
(8, 'Вирджиния Вульф', 'Английская писательница, чьи произведения знаменуются экспериментальной прозой и вниманием к внутреннему миру человека. Она также была феминисткой и активисткой, боровшейся за права женщин.', 'img/authors/virginia_woolf.jpg', NULL, NULL),

-- genres table
INSERT INTO `genres` (`id`, `genre`) VALUES
(7, 'Антиутопия'),
(11, 'Военная проза'),
(16, 'Готическая проза'),
(4, 'Драма'),
(12, 'Инициация'),
(14, 'Комедия нравов'),
(17, 'Магический реализм'),
(23, 'Метафизическая проза'),
(5, 'Научная фантастика'),
(10, 'Повесть'),
(15, 'Психологическая драма'),
(9, 'Роман'),
(18, 'Роман-эпопея'),
(2, 'Сатира'),
(22, 'Современная проза'),
(21, 'Социальная проза'),
(3, 'Социальная фантастика'),
(1, 'Философский роман'),
(8, 'Фэнтези'),
(13, 'Художественный дневник'),
(19, 'Художественный роман'),
(6, 'Экономика'),
(20, 'Юмористическая проза');

-- books table
INSERT INTO `books` (`id`, `title`, `author_id`, `year`, `publisher`, `created_at`, `updated_at`) VALUES
(1, 'Harry Potter and the Philosopher\'s Stone', 1, 1997, 'Махон', NULL, NULL),
(2, 'Harry Potter and the Chamber of Secrets', 1, 1998, 'Махон', NULL, NULL),
(3, 'Harry Potter and the Prisoner of Azkaban', 1, 1999, 'Махон', NULL, NULL),
(4, 'Harry Potter and the Goblet of Fire', 1, 2000, 'Махон', NULL, NULL),
(5, 'Harry Potter and the Order of the Phoenix		', 1, 2003, 'Махон', NULL, NULL),
(6, 'Harry Potter and the Half-Blood Prince', 1, 2005, 'Махон', NULL, NULL),
(7, 'Harry Potter and the Deathly Hallows', 1, 2007, 'Махон', NULL, NULL),
(8, 'Замок', 2, 1926, 'АСТ', NULL, NULL),
(9, 'Процесс', 2, 1925, 'АСТ', NULL, NULL),
(10, '1984', 3, 1949, 'АСТ', NULL, NULL),
(11, 'Скотный двор', 3, 1945, 'Мартин', NULL, NULL),
(13, 'Братья Карамазовы', 4, 1880, 'Эксмо', '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(14, 'Идиот', 4, 1868, 'Азбука', '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(15, 'Записки из подполья', 4, 1864, 'Азбука', '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(16, 'Старик и море', 5, 1952, 'Азбука', '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(17, 'По ком звонит колокол', 5, 1940, 'Эксмо', '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(18, 'Над пропастью во ржи', 5, 1951, 'Рипол Классик', '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(19, 'Зеленые холмы Африки', 5, 1935, 'Рипол Классик', '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(20, 'Гордость и предубеждение', 6, 1813, 'Эксмо', '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(21, 'Разум и чувства', 6, 1811, 'Азбука', '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(22, 'Эмма', 6, 1815, 'Рипол Классик', '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(23, 'Ума и рассудка', 6, 1818, 'Рипол Классик', '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(24, 'Сто лет одиночества', 7, 1967, 'АСТ', '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(25, 'Любовь во время холеры', 7, 1985, 'Азбука', '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(26, 'Хроника объявленной смерти', 7, 1981, 'Иностранка', '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(27, 'Осенний патруль', 7, 1955, 'Эксмо', '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(28, 'К маяку', 8, 1927, 'Азбука', '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(29, 'Миссис Дэллоуэй', 8, 1925, 'Иностранка', '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(30, 'Орландо', 8, 1928, 'Азбука', '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(31, 'Волны', 8, 1931, 'Эксмо', '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(32, 'Преступление и наказание', 4, 1866, 'Азбука', '2023-04-26 19:56:19', '2023-04-26 19:56:19');

-- book_genre table
INSERT INTO `book_genre` (`book_id`, `genre_id`) VALUES
(1, 9),
(1, 8),
(1, 4),
(2, 9),
(2, 8),
(2, 4),
(3, 9),
(3, 8),
(3, 4),
(4, 9),
(4, 8),
(4, 4),
(5, 9),
(5, 8),
(5, 4),
(6, 9),
(6, 8),
(6, 4),
(7, 9),
(7, 8),
(7, 4),
(8, 9),
(9, 1),
(9, 7),
(10, 9),
(10, 7),
(10, 3),
(11, 7),
(11, 2),
(13, 9),
(14, 9),
(15, 9),
(16, 9),
(16, 10),
(17, 9),
(17, 11),
(18, 9),
(18, 12),
(19, 10),
(19, 13),
(20, 9),
(20, 14),
(21, 9),
(21, 15),
(22, 9),
(22, 14),
(23, 9),
(23, 16),
(24, 17),
(24, 18),
(25, 9),
(25, 17),
(26, 19),
(26, 20),
(27, 9),
(27, 21),
(28, 9),
(28, 22),
(29, 9),
(29, 22),
(30, 9),
(30, 8),
(31, 9),
(31, 23),
(32, 9);

-- products table
INSERT INTO `products` (`id`, `name`, `category_id`, `book_id`, `description`, `image`, `oldprice`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Harry Potter and the Philosopher\'s Stone', 1, 1, 'Первый роман в серии о Гарри Поттере, который рассказывает о его детстве, о том, как он узнал о своей магической способности, и о его первом годе обучения в Хогвартсе.', 'img/books/harry_potter_and_the_philosophers_stone.jpg', NULL, 786, NULL, NULL),
(2, 'Harry Potter and the Chamber of Secrets', 1, 2, 'Второй роман о Гарри Поттере, который рассказывает о его втором годе обучения в Хогвартсе, когда он пытается раскрыть тайну таинственных нападений на учеников школы.', 'img/books/harry_potter_and_the_chamber_of_secrets.jpg', NULL, 815, NULL, NULL),
(3, 'Harry Potter and the Prisoner of Azkaban', 1, 3, 'Третий роман о Гарри Поттере, который рассказывает о его третьем годе обучения в Хогвартсе и о том, как он помогает спастись из тюрьмы Сириусу Блэку.', 'img/books/harry_potter_and_the_prisoner_of_azkaban.jpg', 1023, 786, NULL, NULL),
(4, 'Harry Potter and the Goblet of Fire', 1, 4, 'Четвертый роман о Гарри Поттере, который рассказывает о его четвертом годе обучения в Хогвартсе, о турнире трёх волшебников, в котором он принимает участие, и о возвращении Волан-де-Морта.', 'img/books/harry_potter_and_the_goblet_of_fire.jpg', NULL, 946, NULL, NULL),
(5, 'Harry Potter and the Order of the Phoenix', 1, 5, 'Пятый роман о Гарри Поттере, который рассказывает о его пятом годе обучения в Хогвартсе и о том, как он вступает в борьбу с Министерством магии, которое отрицает возможность возвращения Волан-де-Морта.', 'img/books/harry_potter_and_the_order_of_the_phoenix.jpg', NULL, 1069, NULL, NULL),
(6, 'Harry Potter and the Half-Blood Prince', 1, 6, 'Шестой роман о Гарри Поттере, который рассказывает о его шестом годе обучения в Хогвартсе и о том, как он узнает больше о прошлом Волан-де-Морта и его личной связи с Альбусом Дамблдором.', 'img/books/harry_potter_and_the_half_blood_prince.jpg', NULL, 924, NULL, NULL),
(7, 'Harry Potter and the Deathly Hallows', 1, 7, 'Седьмой и последний роман о Гарри Поттере, который рассказывает о его седьмом годе обучения в Хогвартсе и о его окончательной битве с Волан-де-Мортом.', 'img/books/harry_potter_and_the_deathly_hallows.jpg', NULL, 946, NULL, NULL),
(8, 'Замок', 1, 8, 'роман-аллегория австрийского писателя Франца Кафки о невозможности человеческого познания окружающего мира и ощущения бессмысленности жизни.', 'img/books/kafka_das_schloss.jpg', NULL, 301, NULL, NULL),
(9, 'Процесс', 1, 9, 'роман-аллегория австрийского писателя Франца Кафки о невозможности человеческого познания окружающего мира и ощущения бессмысленности жизни.', 'img/books/kafka_der_process.jpg', NULL, 210, NULL, NULL),
(10, '1984', 1, 10, 'Роман-антиутопия английского писателя Джорджа Оруэлла о жестокой тоталитарной диктатуре, где всеобщее контролирующее государство подавляет любое проявление индивидуальности.', 'img/books/orwell_1984.jpg', NULL, 248, NULL, NULL),
(11, 'Скотный двор', 1, 11, 'антиутопическая сатира Джорджа Оруэлла, насмехающаяся над коммунистическим режимом и раскрывающая проблемы социального неравенства.', 'img/books/orwell_animal_farm.jpg', NULL, 390, NULL, NULL),
(12, 'Братья Карамазовы', 1, 13, 'История о трех братьях, которые борются за наследство своего отца и сталкиваются с моральными дилеммами, вопросами веры и человеческих отношений.', 'img/books/the_brothers_karamazov.jpg', NULL, 700, '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(13, 'Идиот', 1, 14, 'Рассказ о князе Мышкине, который возвращается в Россию после лечения в Швейцарии и сталкивается с темными силами общества.', 'img/books/the_idiot.jpg', NULL, 550, '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(14, 'Записки из подполья', 1, 15, 'Повествование о человеке, который изолировал себя от общества и презирает всех вокруг, и его размышлениях о смысле жизни и человеческой натуре.', 'img/books/notes_from_underground.jpg', NULL, 450, '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(15, 'Старик и море', 1, 16, 'История о старике Сантьяго, который выходит в море на рыбалку, и его борьбе с огромной рыбой и природой.', 'img/books/the_old_man_and_the_sea.jpg', NULL, 600, '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(16, 'По ком звонит колокол', 1, 17, 'Рассказ о Роберте Джордане, американском волонтере в Испанской гражданской войне, и его участии в операции сопротивления против нацистов.', 'img/books/for_whom_the_bell_tolls.jpg', NULL, 800, '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(17, 'Над пропастью во ржи', 1, 18, 'История о юноше Холдене Колфилде, который борется с душевными проблемами и отчаянно пытается сохранить свою невинность в мире, который ему кажется лицемерным и фальшивым.', 'img/books/the_catcher_in_the_rye.jpg', NULL, 550, '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(18, 'Зеленые холмы Африки', 1, 19, 'Рассказ о сафари Хемингуэя в Африке, и его переживаниях и размышлениях о природе, жизни и смерти.', 'img/books/green_hills_of_africa.jpg', NULL, 700, '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(19, 'Гордость и предубеждение', 1, 20, 'История о жизни семьи Беннет, особенно о ее старшей дочери Элизабете, и ее нелегком поиске любви и счастья.', 'img/books/pride_and_prejudice.jpg', NULL, 600, '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(20, 'Разум и чувства', 1, 21, 'История о двух сестрах - Элине и Марианне Дэшвуд, и их поиске счастья в любви и жизни, при различных подходах к жизненным проблемам.', 'img/books/sense_and_sensibility.jpg', NULL, 550, '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(21, 'Эмма', 1, 22, 'История о юной и богатой Эмме Вудхаус, ее неудачных попытках свести пары и ее собственных отношениях и поиске любви и счастья.', 'img/books/emma.jpg', NULL, 700, '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(22, 'Ума и рассудка', 1, 23, 'История о молодой Кэтрин Морленд, ее поездке в Бат и ее переживаниях в тайнах Нортенгер-Абби, которые она представляет по образцу готических романов, которые она любит читать.', 'img/books/northanger_abbey.jpg', NULL, 550, '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(23, 'Сто лет одиночества', 1, 24, 'Сага об истории рода Буэндиа в вымышленной стране Макондо, наполненной магией и фантастическими событиями.', 'img/books/one_hundred_years_of_solitude.jpg', NULL, 900, '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(24, 'Любовь во время холеры', 1, 25, 'История о любви Флорентина Аристизабал и Фермина Даса, которые встретились в молодости, но они не смогли быть вместе из-за обстоятельств, и их пути разошлись, но они продолжали любить друг друга на протяжении всей жизни.', 'img/books/love_in_the_time_of_cholera.jpg', NULL, 650, '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(26, 'Осенний патруль', 1, 27, 'История о жизни одной колумбийской семьи и их борьбе за выживание в условиях политической нестабильности и социальной бедности.', 'img/books/leaf_storm.jpg', NULL, 450, '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(27, 'К маяку', 1, 28, 'Роман о жизни семьи Рэмси во время и после Первой мировой войны, они отправляются на остров Скай, чтобы провести там лето и добраться до маяка.', 'img/books/to_the_lighthouse.jpg', NULL, 650, '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(28, 'Миссис Дэллоуэй', 1, 29, 'Роман, в котором автор следует за Миссис Дэллоуэй, когда она готовится к вечеринке, которую она устраивает того же дня, и за молодым ветераном, который готовит себя к своему дню.', 'img/books/mrs_dalloway.jpg', NULL, 500, '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(29, 'Орландо', 1, 30, 'Роман о мужчине по имени Орландо, который внезапно превращается в женщину и продолжает жить более чем триста лет, переживая различные эпохи и культуры.', 'img/books/orlando.jpg', NULL, 700, '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(30, 'Волны', 1, 31, 'Роман, написанный в форме монологов шести персонажей, который исследует темы времени, смерти и сознания, а также отражает настроение британского общества в 1930-е годы.', 'img/books/the_waves.jpg', NULL, 800, '2023-04-26 19:23:14', '2023-04-26 19:23:14'),
(31, 'Преступление и наказание', 1, 32, 'Рассказ о студенте Раскольникове, который убивает злодея, чтобы спасти других от его жестокости, но страдает от своего преступления.', 'img/books/crime_and_punishment.jpg', NULL, 500, '2023-04-26 19:56:19', '2023-04-26 19:56:19'),
(32, 'Хроника объявленной смерти', 1, 26, 'Рассказ о трагической судьбе Сантьяго Насарако, который был убит братьями Висенте и Педро Вискарреаль, но они предупредили всех о своих планах, и никто не смог предотвратить убийство.', 'img/books/chronicle_of_a_death_foretold.jpg', NULL, 600, NULL, NULL);