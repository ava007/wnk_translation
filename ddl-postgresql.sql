CREATE TABLE wnk_translation (
    id character(36) primary key,
    msgid character varying(255) NOT NULL,
    locale character(2) DEFAULT 'en'::bpchar,
    created timestamp with time zone,
    last_used timestamp with time zone DEFAULT ('now'::text)::timestamp without time zone,
    status character varying(24) default 'Original',
    msgstr text
    CONSTRAINT status CHECK ( status IN ( 'Original', 'TranslatedByUser', 'TranslatedByMachine','NotTranslated') )   
) with (oids = false);

CREATE TABLE wnk_translation_proposed (
    id character(36) primary key,
    msgid character varying(255) NOT NULL,
    locale character(2) DEFAULT 'en'::bpchar,
    status character varying(24) default 'ProposedByUser',
    created timestamp with time zone,
    createdbyip character varying(41),
    msgstr text
    CONSTRAINT status CHECK ( status IN ( 'ProposedByUser', 'AcceptedByAdmin') )   
) with (oids = false);

create unique index wnk_translation_unique on wnk_translation (msgid,locale);
