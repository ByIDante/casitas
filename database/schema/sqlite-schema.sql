CREATE TABLE IF NOT EXISTS "migrations"(
  "id" integer primary key autoincrement not null,
  "migration" varchar not null,
  "batch" integer not null
);
CREATE TABLE IF NOT EXISTS "users"(
  "id" integer primary key autoincrement not null,
  "name" varchar not null,
  "email" varchar not null,
  "email_verified_at" datetime,
  "password" varchar not null,
  "role" varchar check("role" in('USER', 'ADMIN', 'GUEST')) not null,
  "remember_token" varchar,
  "created_at" datetime,
  "updated_at" datetime
);
CREATE UNIQUE INDEX "users_email_unique" on "users"("email");
CREATE TABLE IF NOT EXISTS "password_reset_tokens"(
  "email" varchar not null,
  "token" varchar not null,
  "created_at" datetime,
  primary key("email")
);
CREATE TABLE IF NOT EXISTS "sessions"(
  "id" varchar not null,
  "user_id" integer,
  "ip_address" varchar,
  "user_agent" text,
  "payload" text not null,
  "last_activity" integer not null,
  primary key("id")
);
CREATE INDEX "sessions_user_id_index" on "sessions"("user_id");
CREATE INDEX "sessions_last_activity_index" on "sessions"("last_activity");
CREATE TABLE IF NOT EXISTS "cache"(
  "key" varchar not null,
  "value" text not null,
  "expiration" integer not null,
  primary key("key")
);
CREATE TABLE IF NOT EXISTS "cache_locks"(
  "key" varchar not null,
  "owner" varchar not null,
  "expiration" integer not null,
  primary key("key")
);
CREATE TABLE IF NOT EXISTS "jobs"(
  "id" integer primary key autoincrement not null,
  "queue" varchar not null,
  "payload" text not null,
  "attempts" integer not null,
  "reserved_at" integer,
  "available_at" integer not null,
  "created_at" integer not null
);
CREATE INDEX "jobs_queue_index" on "jobs"("queue");
CREATE TABLE IF NOT EXISTS "job_batches"(
  "id" varchar not null,
  "name" varchar not null,
  "total_jobs" integer not null,
  "pending_jobs" integer not null,
  "failed_jobs" integer not null,
  "failed_job_ids" text not null,
  "options" text,
  "cancelled_at" integer,
  "created_at" integer not null,
  "finished_at" integer,
  primary key("id")
);
CREATE TABLE IF NOT EXISTS "failed_jobs"(
  "id" integer primary key autoincrement not null,
  "uuid" varchar not null,
  "connection" text not null,
  "queue" text not null,
  "payload" text not null,
  "exception" text not null,
  "failed_at" datetime not null default CURRENT_TIMESTAMP
);
CREATE UNIQUE INDEX "failed_jobs_uuid_unique" on "failed_jobs"("uuid");
CREATE TABLE IF NOT EXISTS "telescope_entries"(
  "sequence" integer primary key autoincrement not null,
  "uuid" varchar not null,
  "batch_id" varchar not null,
  "family_hash" varchar,
  "should_display_on_index" tinyint(1) not null default '1',
  "type" varchar not null,
  "content" text not null,
  "created_at" datetime
);
CREATE UNIQUE INDEX "telescope_entries_uuid_unique" on "telescope_entries"(
  "uuid"
);
CREATE INDEX "telescope_entries_batch_id_index" on "telescope_entries"(
  "batch_id"
);
CREATE INDEX "telescope_entries_family_hash_index" on "telescope_entries"(
  "family_hash"
);
CREATE INDEX "telescope_entries_created_at_index" on "telescope_entries"(
  "created_at"
);
CREATE INDEX "telescope_entries_type_should_display_on_index_index" on "telescope_entries"(
  "type",
  "should_display_on_index"
);
CREATE TABLE IF NOT EXISTS "telescope_entries_tags"(
  "entry_uuid" varchar not null,
  "tag" varchar not null,
  foreign key("entry_uuid") references "telescope_entries"("uuid") on delete cascade,
  primary key("entry_uuid", "tag")
);
CREATE INDEX "telescope_entries_tags_tag_index" on "telescope_entries_tags"(
  "tag"
);
CREATE TABLE IF NOT EXISTS "telescope_monitoring"(
  "tag" varchar not null,
  primary key("tag")
);
CREATE TABLE IF NOT EXISTS "features"(
  "id" integer primary key autoincrement not null,
  "name" varchar not null,
  "description" text,
  "created_at" datetime,
  "updated_at" datetime
);
CREATE TABLE IF NOT EXISTS "properties"(
  "id" integer primary key autoincrement not null,
  "user_id" integer not null,
  "title" varchar not null,
  "description" text not null,
  "price" numeric not null,
  "address" varchar not null,
  "city" varchar not null,
  "postal_code" varchar not null,
  "square_meters" integer not null,
  "bedrooms" integer not null,
  "bathrooms" integer not null,
  "type" varchar check("type" in('HOUSE', 'APARTMENT', 'STUDIO', 'LOFT', 'DUPLEX', 'PENTHOUSE')) not null,
  "for_sale" tinyint(1) not null default '0',
  "for_rent" tinyint(1) not null default '0',
  "status" varchar check("status" in('AVAILABLE', 'SOLD', 'RENTED', 'RESERVED')) not null default 'AVAILABLE',
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("user_id") references "users"("id") on delete cascade on update cascade
);
CREATE TABLE IF NOT EXISTS "property_images"(
  "id" integer primary key autoincrement not null,
  "property_id" integer not null,
  "path" varchar not null,
  "is_main" tinyint(1) not null default '0',
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("property_id") references "properties"("id") on delete cascade on update cascade
);
CREATE TABLE IF NOT EXISTS "property_ratings"(
  "id" integer primary key autoincrement not null,
  "property_id" integer not null,
  "user_id" integer not null,
  "rating" integer not null,
  "comment" text,
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("property_id") references "properties"("id") on delete cascade on update cascade,
  foreign key("user_id") references "users"("id") on delete cascade on update cascade
);
CREATE TABLE IF NOT EXISTS "feature_property"(
  "id" integer primary key autoincrement not null,
  "feature_id" integer not null,
  "property_id" integer not null,
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("feature_id") references "features"("id") on delete cascade on update cascade,
  foreign key("property_id") references "properties"("id") on delete cascade on update cascade
);

INSERT INTO migrations VALUES(1,'0001_01_01_000000_create_users_table',1);
INSERT INTO migrations VALUES(2,'0001_01_01_000001_create_cache_table',1);
INSERT INTO migrations VALUES(3,'0001_01_01_000002_create_jobs_table',1);
INSERT INTO migrations VALUES(4,'2025_03_11_175632_create_telescope_entries_table',1);
INSERT INTO migrations VALUES(5,'2025_03_18_175822_create_features_table',1);
INSERT INTO migrations VALUES(6,'2025_03_18_175852_create_properties_table',1);
INSERT INTO migrations VALUES(7,'2025_03_18_175912_create_properties_images_table',1);
INSERT INTO migrations VALUES(8,'2025_03_18_175937_create_property_ratings_table',1);
INSERT INTO migrations VALUES(9,'2025_03_18_180009_create_feature_property_table',1);
