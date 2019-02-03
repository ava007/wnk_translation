CREATE TABLE wnk_translation (
                               id varchar(36) primary key,
                               msgid varchar(255) NOT NULL,
                               locale varchar(5) DEFAULT 'cs_CZ',
                               created timestamp,
                               last_used timestamp DEFAULT NOW(),
                              `status` varchar(24) default 'Original',
                                            msgstr text
                                 );

CREATE TABLE wnk_translation_proposed (
                                        id varchar(36) primary key,
                                        msgid varchar(255) NOT NULL,
                                        locale varchar(5) DEFAULT 'cs_CZ',
                                        `status` varchar(24) default 'ProposedByUser',
                                        created timestamp,
                                        createdbyip varchar(41),
                                        msgstr text
);
