#!/bin/bash

# Erle Database Migration Cleanup Script
# This script replaces the messy migration files with clean, consolidated versions

echo "🧹 Starting Erle Database Migration Cleanup..."

# Check if we're in the right directory
if [ ! -f "artisan" ]; then
    echo "❌ Error: Please run this script from the Laravel root directory"
    exit 1
fi

# Backup current database
echo "📦 Creating database backup..."
php artisan db:backup

# Ask for confirmation
echo "⚠️  This will:"
echo "   - Drop all tables (migrate:fresh)"
echo "   - Replace current migrations with clean versions"
echo "   - Re-run all migrations"
echo ""
read -p "Are you sure you want to continue? (y/N): " -n 1 -r
echo ""
if [[ ! $REPLY =~ ^[Yy]$ ]]; then
    echo "❌ Operation cancelled"
    exit 1
fi

# Create backup of current migrations
echo "📂 Backing up current migrations..."
mkdir -p database/migrations_backup
cp database/migrations/*.php database/migrations_backup/

# Remove old migrations (keep Laravel core ones)
echo "🗑️  Removing old migrations..."
rm -f database/migrations/2024_01_08_000000_create_messages_table.php
rm -f database/migrations/2025_07_07_065103_create_tag_tables.php
rm -f database/migrations/2025_07_07_070004_add_roles_to_users_table.php
rm -f database/migrations/2025_07_07_070649_add_profile_fields_to_users_table.php
rm -f database/migrations/2025_07_07_095044_create_contacts_table.php
rm -f database/migrations/2025_07_07_100829_add_organization_number_to_contacts_table.php
rm -f database/migrations/2025_07_07_102325_add_contact_person_fields_to_contacts_table.php
rm -f database/migrations/2025_07_07_114759_replace_contact_person_fields_with_json.php
rm -f database/migrations/2025_07_08_071827_create_work_orders_table.php
rm -f database/migrations/2025_07_08_073818_create_projects_table.php
rm -f database/migrations/2025_07_08_074017_add_project_id_to_work_orders_table.php
rm -f database/migrations/2025_07_08_111151_create_notifications_table.php
rm -f database/migrations/2025_07_09_055225_create_document_categories_table.php
rm -f database/migrations/2025_07_09_055226_create_documents_table.php
rm -f database/migrations/2025_07_09_060955_create_post_categories_table.php
rm -f database/migrations/2025_07_09_060956_create_posts_table.php
rm -f database/migrations/2025_07_10_042435_add_locale_to_users_table.php
rm -f database/migrations/2025_07_10_043025_add_avatar_to_users_table.php

# Also replace the users table
rm -f database/migrations/0001_01_01_000000_create_users_table.php

# Copy new clean migrations
echo "📁 Installing clean migrations..."
cp database/migrations_clean/*.php database/migrations/

# Fresh migrate
echo "🚀 Running fresh migrations..."
php artisan migrate:fresh --seed

# Clear caches
echo "🧽 Clearing caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo "✅ Migration cleanup completed successfully!"
echo ""
echo "📊 Summary:"
echo "   - Old messy migrations backed up to database/migrations_backup/"
echo "   - New clean migrations installed"
echo "   - Database refreshed with clean schema"
echo "   - All caches cleared"
echo ""
echo "🎉 Your database is now clean and optimized!"
